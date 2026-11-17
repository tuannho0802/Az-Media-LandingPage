<?php
/**
 * Trang wp-admin "Công cụ → AZ Media Seed": tạo dữ liệu mẫu bằng một nút bấm, thay cho `wp az seed`
 * khi môi trường không có WP-CLI (ví dụ Local WP trên Windows).
 *
 * Idempotent: bấm nhiều lần không nhân đôi dữ liệu.
 *
 * @package az-media-core
 */

defined( 'ABSPATH' ) || exit;

add_action( 'admin_menu', function () {
	add_management_page( 'AZ Media Seed', 'AZ Media Seed', 'manage_options', 'az-media-seed', 'az_core_seed_page' );
} );

/**
 * Nội dung trang.
 */
function az_core_seed_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$lines = array();
	if ( isset( $_GET['done'] ) ) {
		$key   = 'az_core_seed_log_' . get_current_user_id();
		$lines = get_transient( $key );
		$lines = is_array( $lines ) ? $lines : array();
		delete_transient( $key );
	}
	echo '<div class="wrap"><h1>AZ Media Seed</h1>';
	echo '<p>Tạo dữ liệu mẫu: 3 gói giá, 6 dịch vụ, 6 nhận xét, 10 FAQ, 4 vị trí tuyển dụng, 5 bài blog và các trang rỗng cho menu (đặt Trang chủ tĩnh). Nội dung là placeholder, cần thay bằng nội dung thật trước khi public. Bấm nhiều lần không bị nhân đôi.</p>';
	if ( isset( $_GET['done'] ) ) {
		echo '<div class="notice notice-success inline"><p><strong>Seed xong.</strong> <a href="' . esc_url( home_url( '/' ) ) . '">Xem trang chủ</a></p></div>';
		if ( $lines ) {
			echo '<ul style="list-style:disc;margin-left:1.5em">';
			foreach ( $lines as $line ) {
				echo '<li>' . esc_html( $line ) . '</li>';
			}
			echo '</ul>';
		}
	}
	echo '<form method="post" action="' . esc_url( admin_url( 'admin-post.php' ) ) . '">';
	echo '<input type="hidden" name="action" value="az_core_seed">';
	wp_nonce_field( 'az_core_seed' );
	submit_button( 'Tạo dữ liệu mẫu' );
	echo '</form></div>';
}

add_action( 'admin_post_az_core_seed', function () {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Bạn không có quyền thực hiện thao tác này.', 'az-media-core' ), 403 );
	}
	check_admin_referer( 'az_core_seed' );
	$lines = ( new AZ_Core_Seed_Command() )->run();
	set_transient( 'az_core_seed_log_' . get_current_user_id(), $lines, 5 * MINUTE_IN_SECONDS );
	wp_safe_redirect( admin_url( 'tools.php?page=az-media-seed&done=1' ) );
	exit;
} );

/**
 * Nhắc khi plugin đã bật nhưng chưa có gói giá nào.
 */
add_action( 'admin_notices', function () {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	if ( $screen && 'tools_page_az-media-seed' === $screen->id ) {
		return;
	}
	$counts = wp_count_posts( 'pricing_plan' );
	if ( $counts && (int) $counts->publish > 0 ) {
		return;
	}
	printf(
		'<div class="notice notice-info"><p><strong>AZ Media:</strong> chưa có dữ liệu mẫu cho Bảng giá, Nhận xét và FAQ. <a href="%s">Tạo dữ liệu mẫu</a></p></div>',
		esc_url( admin_url( 'tools.php?page=az-media-seed' ) )
	);
} );
