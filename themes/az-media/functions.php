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
