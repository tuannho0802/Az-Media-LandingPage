<?php
/**
 * Block az-media/read-time + hàm ước tính thời gian đọc.
 *
 * @package az-media-core
 */

defined( 'ABSPATH' ) || exit;

/**
 * "N phút đọc" từ nội dung bài (tốc độ khoảng 200 từ/phút, tối thiểu 1 phút).
 *
 * @param string $content Nội dung bài (có thể chứa block markup).
 * @return string
 */
function az_core_read_time_label( $content ) {
	$plain = wp_strip_all_tags( preg_replace( '/<!--.*?-->/s', '', (string) $content ) );
	$words = preg_match_all( '/[\p{L}\p{N}]+/u', $plain );
	$min = max( 1, (int) ceil( (int) $words / 200 ) );
	return $min . ' phút đọc';
}

add_action( 'init', function () {
	register_block_type( AZ_CORE_DIR . 'blocks/read-time' );
} );
