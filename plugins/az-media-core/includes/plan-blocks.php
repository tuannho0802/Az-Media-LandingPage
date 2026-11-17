<?php
/**
 * Block az-media/plan-cards (thẻ gói kèm danh sách tính năng) và az-media/plan-compare (bảng so sánh).
 * Cả hai render phía server từ CPT pricing_plan, nên sửa giá hay tính năng không cần sửa code.
 *
 * @package az-media-core
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', function () {
	register_block_type( AZ_CORE_DIR . 'blocks/plan-cards' );
	register_block_type( AZ_CORE_DIR . 'blocks/plan-compare' );
} );

/**
 * Tách ô "Tính năng của gói" thành danh sách. Mỗi dòng là "Tên" hoặc "Tên: giá trị".
 * Chỉ tách ở dấu hai chấm có dấu cách theo sau, để chuỗi như "8:00-17:00" không bị cắt nhầm.
 *
 * @param string $text Nội dung meta az_features.
 * @return array<int, array{label: string, value: string}>
 */
function az_core_parse_features( $text ) {
	$features = array();
	foreach ( preg_split( '/\r\n|\r|\n/', (string) $text ) as $line ) {
		$line = trim( $line );
		if ( '' === $line ) {
			continue;
		}
		if ( preg_match( '/^(.+?):\s+(.+)$/u', $line, $m ) ) {
			$features[] = array( 'label' => trim( $m[1] ), 'value' => trim( $m[2] ) );
		} else {
			$features[] = array( 'label' => rtrim( $line, ': ' ), 'value' => '' );
		}
	}
	return array_slice( $features, 0, 30 );
}

/**
 * Lấy các gói đã xuất bản theo thứ tự menu_order (cùng thứ tự với Query Loop ở trang chủ).
 *
 * @param int $limit Số gói tối đa.
 * @return array<int, array<string, mixed>>
 */
function az_core_get_plans( $limit = 3 ) {
	$posts = get_posts( array(
		'post_type'      => 'pricing_plan',
		'post_status'    => 'publish',
		'posts_per_page' => max( 1, min( 6, (int) $limit ) ),
		'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
		'no_found_rows'  => true,
	) );
	$plans = array();
	foreach ( $posts as $post ) {
		$plans[] = array(
			'id'       => $post->ID,
			'name'     => get_the_title( $post ),
			'slug'     => $post->post_name,
			'tag'      => wp_strip_all_tags( $post->post_excerpt ),
			'price'    => (string) get_post_meta( $post->ID, 'az_price', true ),
			'period'   => (string) get_post_meta( $post->ID, 'az_period', true ),
			'summary'  => (string) get_post_meta( $post->ID, 'az_summary', true ),
			'features' => az_core_parse_features( get_post_meta( $post->ID, 'az_features', true ) ),
		);
	}
	return $plans;
}
