<?php
/**
 * Form liên hệ (không phụ thuộc Contact Form 7): block az-media/contact-form + xử lý gửi.
 *
 * - Mỗi tin nhắn được lưu thành bài CPT `contact_message` (menu "Tin nhắn liên hệ" trong wp-admin) và gửi email thông báo.
 *   Lưu trước khi gửi mail để không mất lead khi máy chủ (ví dụ Local WP) chưa cấu hình gửi email.
 * - Chống spam: nonce, honeypot, thời gian điền tối thiểu, giới hạn số lần gửi theo IP.
 * - Email nhận: Cài đặt → Chung → "Email nhận liên hệ (AZ Media)"; mặc định là email quản trị.
 *
 * @package az-media-core
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', function () {
	register_block_type( AZ_CORE_DIR . 'blocks/contact-form' );

	register_post_type( 'contact_message', array(
		'labels'       => array(
			'name'          => 'Tin nhắn liên hệ',
			'singular_name' => 'Tin nhắn liên hệ',
			'edit_item'     => 'Xem tin nhắn',
			'not_found'     => 'Chưa có tin nhắn nào',
		),
		'public'       => false,
		'show_ui'      => true,
		'show_in_menu' => true,
		'show_in_rest' => false,
		'menu_icon'    => 'dashicons-email',
		'supports'     => array( 'title', 'editor' ),
		'map_meta_cap' => true,
		'capabilities' => array( 'create_posts' => 'do_not_allow' ), // chỉ nhận từ form, không tạo tay.
	) );
} );

/**
 * Kiểm tra và làm sạch dữ liệu form. Hàm thuần, không đụng tới DB.
 *
 * @param array $input Dữ liệu thô (đã wp_unslash).
 * @return array{0: array<string,string>, 1: string[]} [dữ liệu sạch, danh sách trường lỗi]
 */
function az_core_contact_validate( array $input ) {
	$clean = array(
		'name'    => sanitize_text_field( $input['az_name'] ?? '' ),
		'email'   => sanitize_email( $input['az_email'] ?? '' ),
		'subject' => sanitize_text_field( $input['az_subject'] ?? '' ),
		'message' => sanitize_textarea_field( $input['az_message'] ?? '' ),
	);
	$errors = array();
	if ( '' === $clean['name'] || mb_strlen( $clean['name'] ) > 100 ) {
		$errors[] = 'name';
	}
	if ( ! is_email( $clean['email'] ) ) {
		$errors[] = 'email';
	}
	if ( '' === $clean['subject'] || mb_strlen( $clean['subject'] ) > 150 ) {
		$errors[] = 'subject';
	}
	if ( mb_strlen( $clean['message'] ) > 3000 ) {
		$errors[] = 'message';
	}
	return array( $clean, $errors );
}

/**
 * Chuyển về trang form kèm kết quả (ok | error | rate).
 */
function az_core_contact_redirect( $status ) {
	$fallback = home_url( '/contact/' );
	$target   = isset( $_POST['az_redirect'] ) ? esc_url_raw( wp_unslash( $_POST['az_redirect'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
	$target   = $target ? wp_validate_redirect( $target, $fallback ) : $fallback;
	$target   = add_query_arg( 'az_contact', $status, remove_query_arg( 'az_contact', $target ) );
	wp_safe_redirect( $target . '#az-contact-form' );
	exit;
}

function az_core_contact_submit() {
	if ( ! isset( $_POST['az_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['az_nonce'] ) ), 'az_contact' ) ) {
		az_core_contact_redirect( 'error' );
	}

	// Bot: ô ẩn bị điền, hoặc gửi nhanh bất thường (dưới 3 giây). Báo thành công giả để bot không dò được.
	$rendered_at = isset( $_POST['az_ts'] ) ? (int) $_POST['az_ts'] : 0;
	if ( ! empty( $_POST['az_website'] ) || $rendered_at <= 0 || ( time() - $rendered_at ) < 3 ) {
		az_core_contact_redirect( 'ok' );
	}

	// Tối đa 5 lần mỗi giờ cho một IP.
	$ip    = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	$key   = 'az_contact_rl_' . md5( $ip );
	$count = (int) get_transient( $key );
	if ( $count >= 5 ) {
		az_core_contact_redirect( 'rate' );
	}

	list( $data, $errors ) = az_core_contact_validate( wp_unslash( $_POST ) );
	if ( $errors ) {
		az_core_contact_redirect( 'error' );
	}
	set_transient( $key, $count + 1, HOUR_IN_SECONDS );

	$body = sprintf( "Họ tên: %s\nEmail: %s\nChủ đề: %s\n\n%s", $data['name'], $data['email'], $data['subject'], $data['message'] );
	wp_insert_post( array(
		'post_type'    => 'contact_message',
		'post_status'  => 'publish',
		'post_title'   => sprintf( '%s — %s', $data['subject'], $data['name'] ),
		'post_content' => $body,
		'meta_input'   => array( 'az_contact_name' => $data['name'], 'az_contact_email' => $data['email'] ),
	) );

	$to = sanitize_email( (string) get_option( 'az_contact_to', '' ) );
	$to = apply_filters( 'az_core_contact_recipient', is_email( $to ) ? $to : get_option( 'admin_email' ) );
	wp_mail(
		$to,
		'[' . wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES ) . '] Liên hệ mới: ' . $data['subject'],
		$body,
		array( 'Reply-To: ' . $data['name'] . ' <' . $data['email'] . '>' )
	);

	az_core_contact_redirect( 'ok' );
}
add_action( 'admin_post_nopriv_az_contact', 'az_core_contact_submit' );
add_action( 'admin_post_az_contact', 'az_core_contact_submit' );

/**
 * Cột Email / Họ tên trong danh sách tin nhắn.
 */
add_filter( 'manage_contact_message_posts_columns', function ( $columns ) {
	$date = $columns['date'] ?? 'Ngày';
	unset( $columns['date'] );
	$columns['az_name']  = 'Họ tên';
	$columns['az_email'] = 'Email';
	$columns['date']     = $date;
	return $columns;
} );
add_action( 'manage_contact_message_posts_custom_column', function ( $column, $post_id ) {
	if ( 'az_name' === $column ) {
		echo esc_html( get_post_meta( $post_id, 'az_contact_name', true ) );
	} elseif ( 'az_email' === $column ) {
		$email = get_post_meta( $post_id, 'az_contact_email', true );
		echo $email ? '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>' : '';
	}
}, 10, 2 );

/**
 * Ô "Email nhận liên hệ" ở Cài đặt → Chung.
 */
add_action( 'admin_init', function () {
	register_setting( 'general', 'az_contact_to', array(
		'type'              => 'string',
		'sanitize_callback' => 'sanitize_email',
		'default'           => '',
	) );
	add_settings_field(
		'az_contact_to',
		'Email nhận liên hệ (AZ Media)',
		function () {
			printf(
				'<input type="email" name="az_contact_to" id="az_contact_to" class="regular-text" value="%s" placeholder="%s"><p class="description">Form ở trang Liên hệ gửi thông báo tới đây. Để trống thì dùng email quản trị. Mọi tin nhắn cũng được lưu ở menu Tin nhắn liên hệ.</p>',
				esc_attr( get_option( 'az_contact_to', '' ) ),
				esc_attr( get_option( 'admin_email' ) )
			);
		},
		'general'
	);
} );
