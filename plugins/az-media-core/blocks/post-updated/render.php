<?php
/**
 * Render block az-media/post-updated: "Cập nhật 2 ngày trước" theo post_modified của bài.
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Nội dung block.
 * @var WP_Block $block      Block instance (có context postId trong Query Loop).
 *
 * @package az-media-core
 */

defined( 'ABSPATH' ) || exit;

$post_id = (int) ( $block->context['postId'] ?? get_the_ID() );
$post    = $post_id ? get_post( $post_id ) : null;
if ( ! $post ) {
	return;
}

$modified = (int) get_post_modified_time( 'U', true, $post );
if ( $modified <= 0 ) {
	return;
}

printf(
	'<div %1$s><time datetime="%2$s" title="%3$s">Cập nhật %4$s</time></div>',
	get_block_wrapper_attributes( array( 'class' => 'az-job__updated' ) ), // phpcs:ignore WordPress.Security.EscapeOutput
	esc_attr( gmdate( 'c', $modified ) ),
	esc_attr( wp_date( 'd/m/Y H:i', $modified ) ),
	esc_html( az_core_time_ago_vi( $modified ) )
);
