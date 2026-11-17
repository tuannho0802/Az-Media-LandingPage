<?php
/**
 * Chế độ bảo trì thật.
 *
 * Khi bật (Công cụ → AZ Media Bảo trì, hoặc `wp option update az_maintenance_on 1`), khách truy cập thấy
 * trang /maintenance-mode/ với HTTP 503, `Retry-After` và `noindex`. Quản trị viên (manage_options) vẫn xem site bình thường.
 * Khi tắt, /maintenance-mode/ chỉ là trang xem trước (có noindex).
 *
 * @package az-media-core
 */

defined( 'ABSPATH' ) || exit;

/**
 * Chế độ bảo trì đang bật?
 */
function az_core_maintenance_on() {
	return '1' === get_option( 'az_maintenance_on', '0' );
}

/**
 * Trả trang bảo trì (503) cho khách khi chế độ đang bật.
 */
add_action( 'template_redirect', function () {
	if ( ! az_core_maintenance_on() || current_user_can( 'manage_options' ) ) {
		return;
	}
	// Không chặn các yêu cầu không phải trang giao diện.
	if ( is_admin() || wp_doing_ajax() || wp_doing_cron() || ( defined( 'WP_CLI' ) && WP_CLI ) || is_robots() || is_favicon() || is_feed() ) {
		return;
	}
	$page = get_page_by_path( 'maintenance-mode' );
	if ( ! $page ) {
		return; // Chưa tạo trang (chưa chạy seed): không khóa khách ngoài site.
	}

	$GLOBALS['az_core_maintenance_active'] = true;
	status_header( 503 );
	header( 'Retry-After: ' . HOUR_IN_SECONDS );
	nocache_headers();

	// Mọi URL đều hiển thị trang bảo trì (template page-maintenance-mode).
	if ( ! is_page( $page->ID ) ) {
		query_posts( array( 'page_id' => $page->ID, 'post_type' => 'page' ) );
	}
}, 0 );

/**
 * noindex cho trang bảo trì (cả khi chỉ xem trước) và cho mọi phản hồi 503 do chế độ bảo trì.
 */
add_filter( 'wp_robots', function ( $robots ) {
	if ( ! empty( $GLOBALS['az_core_maintenance_active'] ) || is_page( 'maintenance-mode' ) ) {
		return wp_robots_no_robots( $robots );
	}
	return $robots;
} );

/**
 * Trang cài đặt: Công cụ → AZ Media Bảo trì.
 */
add_action( 'admin_menu', function () {
	add_management_page( 'AZ Media Bảo trì', 'AZ Media Bảo trì', 'manage_options', 'az-media-maintenance', 'az_core_maintenance_page' );
} );

add_action( 'admin_init', function () {
	register_setting( 'az_core_maintenance', 'az_maintenance_on', array(
		'type'              => 'string',
		'default'           => '0',
		'sanitize_callback' => function ( $value ) {
			return '1' === $value ? '1' : '0';
		},
	) );
} );

function az_core_maintenance_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$page    = get_page_by_path( 'maintenance-mode' );
	$preview = $page ? get_permalink( $page ) : '';
	echo '<div class="wrap"><h1>AZ Media Bảo trì</h1>';
	if ( ! $page ) {
		echo '<div class="notice notice-warning inline"><p>Chưa có trang <code>/maintenance-mode/</code>. Vào Công cụ → AZ Media Seed để tạo trang trước khi bật, nếu không chế độ bảo trì sẽ không có tác dụng.</p></div>';
	}
	echo '<form method="post" action="options.php">';
	settings_fields( 'az_core_maintenance' );
	echo '<table class="form-table" role="presentation"><tr><th scope="row">Chế độ bảo trì</th><td>';
	echo '<label><input type="checkbox" name="az_maintenance_on" value="1"' . checked( az_core_maintenance_on(), true, false ) . '> Bật: khách thấy trang bảo trì (HTTP 503, noindex)</label>';
	echo '<p class="description">Quản trị viên đã đăng nhập vẫn xem site bình thường. Nên mở site ở cửa sổ ẩn danh để kiểm tra như khách.</p>';
	if ( $preview ) {
		echo '<p><a href="' . esc_url( $preview ) . '" target="_blank" rel="noopener">Xem trước trang bảo trì</a></p>';
	}
	echo '</td></tr></table>';
	submit_button();
	echo '</form></div>';
}

/**
 * Nhắc quản trị viên khi chế độ đang bật (họ vẫn thấy site bình thường nên dễ quên).
 */
add_action( 'admin_notices', function () {
	if ( ! az_core_maintenance_on() || ! current_user_can( 'manage_options' ) ) {
		return;
	}
	printf(
		'<div class="notice notice-warning"><p><strong>AZ Media:</strong> chế độ bảo trì đang <strong>BẬT</strong>, khách truy cập thấy trang bảo trì. <a href="%s">Tắt chế độ bảo trì</a></p></div>',
		esc_url( admin_url( 'tools.php?page=az-media-maintenance' ) )
	);
} );

add_action( 'admin_bar_menu', function ( $bar ) {
	if ( ! az_core_maintenance_on() || ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$bar->add_node( array(
		'id'    => 'az-maintenance',
		'title' => 'Đang bảo trì',
		'href'  => admin_url( 'tools.php?page=az-media-maintenance' ),
	) );
}, 100 );
