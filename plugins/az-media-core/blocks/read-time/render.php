<?php
/**
 * Render block az-media/read-time: "N phút đọc" theo số từ nội dung bài.
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Nội dung block.
 * @var WP_Block $block      Block instance (có context postId).
 *
 * @package az-media-core
 */

defined( 'ABSPATH' ) || exit;

$post_id = (int) ( $block->context['postId'] ?? get_the_ID() );
$post    = $post_id ? get_post( $post_id ) : null;
if ( ! $post ) {
	return;
}

printf(
	'<div %1$s>%2$s</div>',
	get_block_wrapper_attributes( array( 'class' => 'az-read-time' ) ), // phpcs:ignore WordPress.Security.EscapeOutput
	esc_html( az_core_read_time_label( $post->post_content ) )
);
