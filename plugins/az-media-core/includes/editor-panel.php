<?php
/**
 * Đưa các ô thông tin (giá, chu kỳ, mô tả gói, vai trò, chữ avatar) lên thanh bên phải của trình soạn thảo.
 *
 * Meta đã đăng ký show_in_rest trong post-types.php nên panel đọc và ghi trực tiếp qua REST.
 *
 * @package az-media-core
 */

defined( 'ABSPATH' ) || exit;

add_action( 'enqueue_block_editor_assets', function () {
	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	$fields = az_core_meta_fields();
	if ( ! $screen || ! isset( $fields[ $screen->post_type ] ) ) {
		return;
	}

	$config = array();
	foreach ( $fields as $post_type => $items ) {
		foreach ( $items as $key => $field ) {
			$config[ $post_type ][] = array(
				'key'         => $key,
				'label'       => $field['label'],
				'placeholder' => $field['placeholder'] ?? '',
				'type'        => $field['type'] ?? 'text',
			);
		}
	}

	wp_enqueue_script(
		'az-core-editor-panel',
		plugins_url( 'assets/js/editor-panel.js', AZ_CORE_DIR . 'az-media-core.php' ),
		array( 'wp-plugins', 'wp-editor', 'wp-element', 'wp-components', 'wp-data' ),
		AZ_CORE_VERSION,
		true
	);
	wp_add_inline_script( 'az-core-editor-panel', 'window.azCoreFields = ' . wp_json_encode( $config ) . ';', 'before' );
} );
