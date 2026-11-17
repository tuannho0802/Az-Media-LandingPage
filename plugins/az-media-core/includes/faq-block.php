<?php
/**
 * Block az-media/faq-list (server-side render) + schema FAQPage.
 *
 * @package az-media-core
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', function () {
	register_block_type( AZ_CORE_DIR . 'blocks/faq-list' );
} );
