<?php
/**
 * Render block az-media/contact-form.
 *
 * @package az-media-core
 */

defined( 'ABSPATH' ) || exit;

$status  = isset( $_GET['az_contact'] ) ? sanitize_key( wp_unslash( $_GET['az_contact'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
$notices = array(
	'ok'    => array( 'ok', 'Cảm ơn bạn! Chúng tôi đã nhận được tin nhắn và sẽ phản hồi trong vòng một ngày làm việc.' ),
	'error' => array( 'error', 'Chưa gửi được. Vui lòng kiểm tra họ tên, email, chủ đề rồi thử lại.' ),
	'rate'  => array( 'error', 'Bạn đã gửi nhiều lần trong thời gian ngắn. Vui lòng thử lại sau hoặc liên hệ qua email, điện thoại.' ),
);
$page_id = get_queried_object_id();
$action  = esc_url( admin_url( 'admin-post.php' ) );
$self    = $page_id ? get_permalink( $page_id ) : home_url( '/contact/' );
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'az-form', 'id' => 'az-contact-form' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>>
	<?php if ( isset( $notices[ $status ] ) ) : ?>
		<p class="az-form__note az-form__note--<?php echo esc_attr( $notices[ $status ][0] ); ?>" role="<?php echo 'ok' === $notices[ $status ][0] ? 'status' : 'alert'; ?>"><?php echo esc_html( $notices[ $status ][1] ); ?></p>
	<?php endif; ?>
	<form class="az-form__form" method="post" action="<?php echo $action; // phpcs:ignore WordPress.Security.EscapeOutput ?>">
		<input type="hidden" name="action" value="az_contact">
		<input type="hidden" name="az_redirect" value="<?php echo esc_url( $self ); ?>">
		<input type="hidden" name="az_ts" value="<?php echo esc_attr( (string) time() ); ?>">
		<?php wp_nonce_field( 'az_contact', 'az_nonce', false ); ?>

		<div class="az-form__field">
			<label class="az-form__label" for="az-f-name">Họ tên</label>
			<input class="az-form__control" type="text" id="az-f-name" name="az_name" required maxlength="100" autocomplete="name">
		</div>
		<div class="az-form__field">
			<label class="az-form__label" for="az-f-email">Email</label>
			<input class="az-form__control" type="email" id="az-f-email" name="az_email" required autocomplete="email">
		</div>
		<div class="az-form__field">
			<label class="az-form__label" for="az-f-subject">Chủ đề</label>
			<input class="az-form__control" type="text" id="az-f-subject" name="az_subject" required maxlength="150">
		</div>
		<div class="az-form__field">
			<label class="az-form__label" for="az-f-message">Lời nhắn (không bắt buộc)</label>
			<textarea class="az-form__control" id="az-f-message" name="az_message" rows="5" maxlength="3000"></textarea>
		</div>
		<div class="az-form__hp" aria-hidden="true">
			<label>Để trống ô này <input type="text" name="az_website" tabindex="-1" autocomplete="off"></label>
		</div>
		<p class="az-form__consent">Khi gửi tin nhắn, bạn đồng ý để AZ Media xử lý thông tin theo <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Chính sách bảo mật</a>.</p>
		<button type="submit" class="wp-block-button__link wp-element-button az-form__submit">Gửi tin nhắn</button>
	</form>
</div>
