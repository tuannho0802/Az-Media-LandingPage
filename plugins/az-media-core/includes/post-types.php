<?php
/**
 * CPT và meta field.
 *
 * @package az-media-core
 */

defined( 'ABSPATH' ) || exit;

/**
 * Khai báo meta cho từng CPT. Dùng chung cho register_post_meta và meta box.
 *
 * @return array<string, array<string, array>>
 */
function az_core_meta_fields() {
	return array(
		'pricing_plan' => array(
			'az_price'   => array( 'label' => 'Giá (hiển thị)', 'placeholder' => '4.900.000đ' ),
			'az_period'  => array( 'label' => 'Chu kỳ', 'placeholder' => '/tháng' ),
			'az_summary' => array( 'label' => 'Đoạn mô tả gói', 'type' => 'textarea' ),
		),
		'testimonial'  => array(
			'az_role'     => array( 'label' => 'Vai trò / công ty', 'placeholder' => 'Giám đốc Marketing, Công ty A' ),
			'az_initials' => array( 'label' => 'Chữ cái avatar', 'placeholder' => 'NA' ),
		),
	);
}

add_action( 'init', function () {
	$common = array(
		'public'              => false,
		// Query Loop của core chỉ nhận post type "viewable" (publicly_queryable). Không bật rewrite/query_var
		// và loại khỏi tìm kiếm để không sinh URL công khai riêng cho từng gói/nhận xét/FAQ.
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'query_var'           => false,
		'show_in_nav_menus'   => false,
		'show_ui'             => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'has_archive'        => false,
		'rewrite'            => false,
		'supports'           => array( 'title', 'editor', 'excerpt', 'page-attributes', 'custom-fields', 'thumbnail' ),
	);

	register_post_type( 'pricing_plan', array_merge( $common, array(
		'labels'    => array( 'name' => 'Gói giá', 'singular_name' => 'Gói giá', 'add_new_item' => 'Thêm gói giá', 'edit_item' => 'Sửa gói giá' ),
		'menu_icon' => 'dashicons-money-alt',
	) ) );

	register_post_type( 'service', array_merge( $common, array(
		'labels'    => array( 'name' => 'Dịch vụ', 'singular_name' => 'Dịch vụ', 'add_new_item' => 'Thêm dịch vụ', 'edit_item' => 'Sửa dịch vụ' ),
		'menu_icon' => 'dashicons-megaphone',
		// Dịch vụ có trang chi tiết /services/{slug}/ (template single-service). Không có trang lưu trữ /services/.
		'rewrite'   => array( 'slug' => 'services', 'with_front' => false ),
	) ) );

	register_post_type( 'testimonial', array_merge( $common, array(
		'labels'    => array( 'name' => 'Nhận xét', 'singular_name' => 'Nhận xét', 'add_new_item' => 'Thêm nhận xét', 'edit_item' => 'Sửa nhận xét' ),
		'menu_icon' => 'dashicons-format-quote',
	) ) );

	register_post_type( 'faq', array_merge( $common, array(
		'labels'    => array( 'name' => 'FAQs', 'singular_name' => 'FAQ', 'add_new_item' => 'Thêm câu hỏi', 'edit_item' => 'Sửa câu hỏi' ),
		'menu_icon' => 'dashicons-editor-help',
		'taxonomies' => array( 'faq_group' ),
	) ) );

	register_taxonomy( 'faq_group', 'faq', array(
		'labels'            => array( 'name' => 'Nhóm FAQ', 'singular_name' => 'Nhóm FAQ' ),
		'public'            => false,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'hierarchical'      => false,
		'rewrite'           => false,
	) );

	foreach ( az_core_meta_fields() as $post_type => $fields ) {
		foreach ( array_keys( $fields ) as $key ) {
			register_post_meta( $post_type, $key, array(
				'type'              => 'string',
				'single'            => true,
				'show_in_rest'      => true,
				// Ô nhiều dòng giữ xuống dòng; sanitize_text_field sẽ gộp mọi dòng thành một.
				'sanitize_callback' => 'textarea' === ( $fields[ $key ]['type'] ?? '' ) ? 'sanitize_textarea_field' : 'sanitize_text_field',
				'auth_callback'     => function () {
					return current_user_can( 'edit_posts' );
				},
			) );
		}
	}
} );

/**
 * Làm mới rewrite rules đúng một lần khi đổi cấu hình URL của CPT (ví dụ /services/{slug}/),
 * để git pull xong là chạy ngay, không cần vào Settings → Permalinks bấm Save.
 * Tăng số phiên bản khi lại đổi rewrite.
 */
add_action( 'init', function () {
	if ( '1' !== get_option( 'az_core_rewrite_ver' ) ) {
		flush_rewrite_rules( false );
		update_option( 'az_core_rewrite_ver', '1', true );
	}
}, 99 );
