<?php
/**
 * Meta box đơn giản để sửa meta field trong wp-admin.
 *
 * @package az-media-core
 */

defined( 'ABSPATH' ) || exit;

add_action( 'add_meta_boxes', function () {
	foreach ( array_keys( az_core_meta_fields() ) as $post_type ) {
		add_meta_box( 'az_core_fields', 'Thông tin hiển thị', 'az_core_render_meta_box', $post_type, 'normal', 'high' );
	}
} );

/**
 * @param WP_Post $post Bài đang sửa.
 */
function az_core_render_meta_box( $post ) {
	wp_nonce_field( 'az_core_save', 'az_core_nonce' );
	$fields = az_core_meta_fields()[ $post->post_type ] ?? array();
	echo '<table class="form-table" role="presentation"><tbody>';
	foreach ( $fields as $key => $field ) {
		$value = get_post_meta( $post->ID, $key, true );
		printf( '<tr><th scope="row"><label for="%1$s">%2$s</label></th><td>', esc_attr( $key ), esc_html( $field['label'] ) );
		if ( ( $field['type'] ?? '' ) === 'textarea' ) {
			printf( '<textarea id="%1$s" name="%1$s" rows="3" class="large-text">%2$s</textarea>', esc_attr( $key ), esc_textarea( $value ) );
		} else {
			printf(
				'<input type="text" id="%1$s" name="%1$s" value="%2$s" placeholder="%3$s" class="regular-text">',
				esc_attr( $key ),
				esc_attr( $value ),
				esc_attr( $field['placeholder'] ?? '' )
			);
		}
		echo '</td></tr>';
	}
	echo '</tbody></table>';
}

add_action( 'save_post', function ( $post_id ) {
	if ( ! isset( $_POST['az_core_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['az_core_nonce'] ) ), 'az_core_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$fields = az_core_meta_fields()[ get_post_type( $post_id ) ] ?? array();
	foreach ( array_keys( $fields ) as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
		}
	}
} );
