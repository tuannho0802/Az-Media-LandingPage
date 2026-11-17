<?php
/**
 * Plugin Name: AZ Media Core
 * Description: Custom post type, meta field và block dữ liệu cho website AZ Media (Pricing, Testimonial, FAQ). Tách khỏi theme để dữ liệu không mất khi đổi theme.
 * Version: 0.1.0
 * Requires at least: 6.6
 * Requires PHP: 8.0
 * Text Domain: az-media-core
 *
 * @package az-media-core
 */

defined( 'ABSPATH' ) || exit;

define( 'AZ_CORE_VERSION', '0.1.0' );
define( 'AZ_CORE_DIR', plugin_dir_path( __FILE__ ) );

require_once AZ_CORE_DIR . 'includes/post-types.php';
require_once AZ_CORE_DIR . 'includes/meta-boxes.php';
require_once AZ_CORE_DIR . 'includes/faq-block.php';

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	require_once AZ_CORE_DIR . 'cli/seed.php';
}
