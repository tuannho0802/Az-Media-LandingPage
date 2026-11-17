<?php
/**
 * AZ Media theme setup.
 *
 * @package az-media
 */

defined( 'ABSPATH' ) || exit;

define( 'AZ_MEDIA_VERSION', '0.1.0' );

/**
 * Theme supports và style cho editor.
 */
add_action( 'after_setup_theme', function () {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_editor_style( 'assets/css/az.css' );
} );

/**
 * Pattern category.
 */
add_action( 'init', function () {
	register_block_pattern_category( 'az-media', array( 'label' => __( 'AZ Media', 'az-media' ) ) );
} );

/**
 * WordPress (6.4+) cache danh sách pattern của theme và chỉ làm mới khi số phiên bản theme đổi.
 * Thêm hoặc sửa file trong patterns/ mà không đổi version thì pattern mới KHÔNG được đăng ký:
 * template gọi pattern đó sẽ hiện rỗng (trang Bảng giá chỉ còn khối CTA). Tự xóa cache khi
 * danh sách hoặc thời gian sửa file pattern thay đổi, để git pull xong là chạy ngay.
 */
add_action( 'after_setup_theme', function () {
	$files = glob( get_theme_file_path( 'patterns/*.php' ) );
	$files = $files ? $files : array();
	$mtime = 0;
	foreach ( $files as $file ) {
		$mtime = max( $mtime, (int) filemtime( $file ) );
	}
	$signature = count( $files ) . '|' . $mtime;
	if ( get_option( 'az_media_pattern_sig' ) === $signature ) {
		return;
	}
	$theme = wp_get_theme();
	if ( method_exists( $theme, 'delete_pattern_cache' ) ) {
		$theme->delete_pattern_cache();
	}
	update_option( 'az_media_pattern_sig', $signature, true );
}, 1 );

/**
 * CSS và JS. Font tự host qua theme.json (fontFace), không dùng CDN.
 */
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'az-media', get_theme_file_uri( 'assets/css/az.css' ), array(), AZ_MEDIA_VERSION );
	wp_enqueue_script(
		'az-media',
		get_theme_file_uri( 'assets/js/az.js' ),
		array(),
		AZ_MEDIA_VERSION,
		array( 'strategy' => 'defer', 'in_footer' => true )
	);
} );

/**
 * Preload font chính (latin + vietnamese) và ẩn announcement bar trước khi vẽ nếu đã đóng.
 */
add_action( 'wp_head', function () {
	foreach ( array( 'latin', 'vietnamese' ) as $subset ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( get_theme_file_uri( "assets/fonts/plus-jakarta-sans-{$subset}-wght-normal.woff2" ) )
		);
	}
	echo '<script>try{if(localStorage.getItem("az_announce_closed")==="1"){document.documentElement.classList.add("az-announce-closed")}}catch(e){}</script>' . "\n";
}, 1 );

/**
 * Query Loop của core tự đổi post type chưa đăng ký về "post", nên khi plugin az-media-core chưa bật,
 * Pricing và Testimonials sẽ hiện nhầm bài "Hello world". Chặn lại để các khối này hiển thị rỗng thay vì sai dữ liệu.
 */
add_filter( 'query_loop_block_query_vars', function ( $query, $block ) {
	$wanted = $block->context['query']['postType'] ?? '';
	if ( $wanted && ! post_type_exists( $wanted ) ) {
		$query['post__in'] = array( 0 );
	}
	return $query;
}, 10, 2 );

/**
 * Nhắc quản trị viên bật plugin dữ liệu và chạy seed.
 */
add_action( 'admin_notices', function () {
	if ( ! current_user_can( 'activate_plugins' ) || post_type_exists( 'pricing_plan' ) ) {
		return;
	}
	echo '<div class="notice notice-warning"><p><strong>AZ Media:</strong> hãy kích hoạt plugin <em>AZ Media Core</em>, rồi vào Công cụ → AZ Media Seed (hoặc chạy <code>wp az seed</code>) để Bảng giá, Nhận xét và FAQ hiển thị dữ liệu.</p></div>';
} );
