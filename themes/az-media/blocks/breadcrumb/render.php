<?php
/**
 * Render block az-media/breadcrumb: Trang chủ / (trang cha) / trang hiện tại.
 * Bài viết (post) thêm cấp trang Blog nếu đã đặt trang bài viết.
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Nội dung.
 * @var WP_Block $block      Block instance.
 *
 * @package az-media
 */

defined( 'ABSPATH' ) || exit;

$post_id = (int) ( $block->context['postId'] ?? get_the_ID() );
if ( ! $post_id ) {
	return;
}

$crumbs = array( array( 'label' => __( 'Trang chủ', 'az-media' ), 'url' => home_url( '/' ) ) );

if ( 'post' === get_post_type( $post_id ) ) {
	$blog_id = (int) get_option( 'page_for_posts' );
	if ( $blog_id ) {
		$crumbs[] = array( 'label' => get_the_title( $blog_id ), 'url' => get_permalink( $blog_id ) );
	}
} else {
	foreach ( array_reverse( get_post_ancestors( $post_id ) ) as $ancestor_id ) {
		$crumbs[] = array( 'label' => get_the_title( $ancestor_id ), 'url' => get_permalink( $ancestor_id ) );
	}
}

$items = '';
foreach ( $crumbs as $crumb ) {
	$items .= sprintf( '<li><a href="%1$s">%2$s</a></li>', esc_url( $crumb['url'] ), esc_html( $crumb['label'] ) );
}
$items .= '<li aria-current="page">' . esc_html( get_the_title( $post_id ) ) . '</li>';

printf(
	'<nav %1$s aria-label="%2$s"><ol class="az-breadcrumb__list">%3$s</ol></nav>',
	get_block_wrapper_attributes( array( 'class' => 'az-breadcrumb' ) ), // phpcs:ignore WordPress.Security.EscapeOutput
	esc_attr__( 'Đường dẫn', 'az-media' ),
	$items // phpcs:ignore WordPress.Security.EscapeOutput
);
