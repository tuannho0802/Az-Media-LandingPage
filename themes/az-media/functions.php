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
	// Phiên bản theo thời gian sửa file: deploy FTP xong là trình duyệt/CDN lấy ngay az.css/az.js mới,
	// không phải nhớ tăng AZ_MEDIA_VERSION (hằng số chỉ còn là giá trị dự phòng).
	$ver = static function ( $rel ) {
		$path = get_theme_file_path( $rel );
		return file_exists( $path ) ? (string) filemtime( $path ) : AZ_MEDIA_VERSION;
	};
	wp_enqueue_style( 'az-media', get_theme_file_uri( 'assets/css/az.css' ), array(), $ver( 'assets/css/az.css' ) );
	wp_enqueue_script(
		'az-media',
		get_theme_file_uri( 'assets/js/az.js' ),
		array(),
		$ver( 'assets/js/az.js' ),
		array( 'strategy' => 'defer', 'in_footer' => true )
	);
} );

/**
 * Đặt class sớm trên <html> (trước khi trình duyệt vẽ) để CSS biết có JS và có View Transitions hay không:
 * - az-js: bật animation vào trang cho hero, không bị nháy vì class có trước lần vẽ đầu.
 * - az-no-vt: trình duyệt chưa hỗ trợ View Transitions đa tài liệu → dùng fade-in dự phòng.
 * Không tải được az.js thì reveal không bao giờ ẩn nội dung (class ẩn do az.js gắn).
 */
add_action( 'wp_head', function () {
	echo "<script>(function(r){r.classList.add('az-js');if(!('CSSViewTransitionRule' in window)){r.classList.add('az-no-vt');}})(document.documentElement);</script>\n";
}, 0 );

/**
 * Favicon mặc định bằng biểu tượng AZ Media khi chưa đặt Site Icon trong Customizer / Site Editor.
 * Đã đặt Site Icon thì WordPress tự xuất thẻ icon, không in thêm ở đây.
 */
add_action( 'wp_head', function () {
	if ( has_site_icon() ) {
		return;
	}
	printf(
		'<link rel="icon" href="%1$s" type="image/png" sizes="192x192">' . "\n" . '<link rel="apple-touch-icon" href="%2$s">' . "\n",
		esc_url( get_theme_file_uri( 'assets/img/az-media-icon-192.png' ) ),
		esc_url( get_theme_file_uri( 'assets/img/az-media-icon-512.png' ) )
	);
}, 2 );

/**
 * Preload font chính (latin + vietnamese).
 */
add_action( 'wp_head', function () {
	foreach ( array( 'latin', 'vietnamese' ) as $subset ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( get_theme_file_uri( "assets/fonts/plus-jakarta-sans-{$subset}-wght-normal.woff2" ) )
		);
	}
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
	// Pattern az-media/career-other (queryId 32): loại vị trí đang xem khỏi danh sách "Vị trí khác".
	if ( 32 === (int) ( $block->context['queryId'] ?? 0 ) && is_singular( 'career' ) ) {
		$query['post__not_in'] = array( get_queried_object_id() );
	}
	// Pattern az-media/blog-related (queryId 33): loại bài đang xem khỏi danh sách "Bài viết liên quan".
	if ( 33 === (int) ( $block->context['queryId'] ?? 0 ) && is_singular( 'post' ) ) {
		$query['post__not_in'] = array( get_queried_object_id() );
	}
	// Pattern az-media/service-related (queryId 15): loại dịch vụ đang xem khỏi danh sách "Dịch vụ khác".
	if ( 15 === (int) ( $block->context['queryId'] ?? 0 ) && is_singular( 'service' ) ) {
		$query['post__not_in'] = array( get_queried_object_id() );
	}
	return $query;
}, 10, 2 );

/**
 * Schema Service (JSON-LD) cho trang chi tiết dịch vụ.
 */
add_action( 'wp_head', function () {
	if ( ! is_singular( 'service' ) ) {
		return;
	}
	$post = get_queried_object();
	if ( ! $post instanceof WP_Post ) {
		return;
	}
	$data = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'Service',
		'name'        => get_the_title( $post ),
		'description' => wp_strip_all_tags( get_the_excerpt( $post ) ),
		'url'         => get_permalink( $post ),
		'provider'    => array(
			'@type' => 'Organization',
			'name'  => 'AZ Media',
			'url'   => home_url( '/' ),
		),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG ) . "</script>\n";
}, 5 );

/**
 * Nhắc quản trị viên bật plugin dữ liệu và chạy seed.
 */
add_action( 'admin_notices', function () {
	if ( ! current_user_can( 'activate_plugins' ) || post_type_exists( 'pricing_plan' ) ) {
		return;
	}
	echo '<div class="notice notice-warning"><p><strong>AZ Media:</strong> hãy kích hoạt plugin <em>AZ Media Core</em>, rồi vào Công cụ → AZ Media Seed (hoặc chạy <code>wp az seed</code>) để Bảng giá, Nhận xét và FAQ hiển thị dữ liệu.</p></div>';
} );

/**
 * Schema JobPosting (JSON-LD) cho trang chi tiết vị trí tuyển dụng.
 * Địa điểm và hạn nộp lấy từ meta az_location, az_deadline (dd/mm/yyyy); thiếu thì bỏ trường tương ứng.
 */
add_action( 'wp_head', function () {
	if ( ! is_singular( 'career' ) ) {
		return;
	}
	$post = get_queried_object();
	if ( ! $post instanceof WP_Post ) {
		return;
	}
	$data = array(
		'@context'           => 'https://schema.org',
		'@type'              => 'JobPosting',
		'title'              => get_the_title( $post ),
		'description'        => wp_kses_post( apply_filters( 'the_content', $post->post_content ) ),
		'datePosted'         => get_the_date( 'c', $post ),
		'hiringOrganization' => array(
			'@type'  => 'Organization',
			'name'   => 'AZ Media',
			'sameAs' => home_url( '/' ),
		),
	);
	$type = mb_strtolower( (string) get_post_meta( $post->ID, 'az_job_type', true ) );
	$map  = array(
		'toàn thời gian' => 'FULL_TIME',
		'bán thời gian'  => 'PART_TIME',
		'hợp đồng'       => 'CONTRACTOR',
		'thời vụ'        => 'TEMPORARY',
		'thực tập'       => 'INTERN',
	);
	foreach ( $map as $needle => $code ) {
		if ( false !== mb_strpos( $type, $needle ) ) {
			$data['employmentType'] = $code;
			break;
		}
	}
	$location = trim( (string) get_post_meta( $post->ID, 'az_location', true ) );
	if ( '' !== $location ) {
		$data['jobLocation'] = array(
			'@type'   => 'Place',
			'address' => array(
				'@type'           => 'PostalAddress',
				'addressLocality' => $location,
				'addressCountry'  => 'VN',
			),
		);
	}
	$deadline = DateTime::createFromFormat( 'd/m/Y', trim( (string) get_post_meta( $post->ID, 'az_deadline', true ) ) );
	if ( $deadline ) {
		$data['validThrough'] = $deadline->format( 'Y-m-d' ) . 'T23:59:59+07:00';
	}
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG ) . "</script>\n";
}, 5 );

/**
 * Schema LocalBusiness (JSON-LD) cho trang Liên hệ. Chỉ khai báo dữ liệu thật (tên, địa chỉ, URL);
 * điện thoại, email và giờ làm việc đang là placeholder nên chưa đưa vào.
 */
add_action( 'wp_head', function () {
	if ( ! is_page( 'contact' ) ) {
		return;
	}
	$data = array(
		'@context' => 'https://schema.org',
		'@type'    => 'LocalBusiness',
		'name'     => 'AZ Media',
		'url'      => home_url( '/' ),
		'address'  => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => '27 Đinh Bộ Lĩnh, Phường 24',
			'addressLocality' => 'Quận Bình Thạnh',
			'addressRegion'   => 'TP. Hồ Chí Minh',
			'addressCountry'  => 'VN',
		),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG ) . "</script>\n";
}, 5 );

/**
 * Tìm kiếm: bài viết và dịch vụ (mặc định WordPress tìm cả Page, kéo theo các trang pháp lý, trang trống).
 * Dịch vụ khai báo exclude_from_search nên phải chỉ định post_type rõ ràng ở đây.
 */
add_action( 'pre_get_posts', function ( $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! $query->is_search() ) {
		return;
	}
	$types = array( 'post' );
	if ( post_type_exists( 'service' ) ) {
		$types[] = 'service';
	}
	$query->set( 'post_type', $types );
} );

/**
 * noindex cho trang 404. (Trang kết quả tìm kiếm đã được WordPress tự gắn noindex.)
 */
add_filter( 'wp_robots', function ( $robots ) {
	return is_404() ? wp_robots_no_robots( $robots ) : $robots;
} );

/**
 * Ảnh đại diện dự phòng cho bài viết (post) chưa gán ảnh: dùng ảnh tạm của theme để thẻ bài không bị trống.
 * Bài đã gán ảnh đại diện thì dùng ảnh thật. Chỉ áp dụng cho bài viết ở giao diện công khai.
 */
add_filter( 'post_thumbnail_html', function ( $html, $post_id ) {
	if ( $html || is_admin() || 'post' !== get_post_type( $post_id ) ) {
		return $html;
	}
	$n = ( (int) $post_id % 6 ) + 1;
	return sprintf(
		'<img src="%s" alt="" class="attachment-post-thumbnail wp-post-image az-thumb-fallback" style="aspect-ratio:3/2;object-fit:cover;width:100%%;height:100%%" loading="lazy" decoding="async" />',
		esc_url( get_theme_file_uri( "assets/img/blog-placeholder-$n.svg" ) )
	);
}, 10, 2 );
