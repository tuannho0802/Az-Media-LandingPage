<?php
/**
 * Render block az-media/legal-nav.
 *
 * @var array $attributes Block attributes.
 *
 * @package az-media-core
 */

defined( 'ABSPATH' ) || exit;

$mode    = 'cards' === ( $attributes['mode'] ?? 'tabs' ) ? 'cards' : 'tabs';
$current = (int) get_queried_object_id();
$items   = array();
foreach ( az_core_legal_docs() as $slug => $doc ) {
	$page = az_core_published_page( $slug );
	if ( $page ) {
		$items[] = array(
			'page'  => $page,
			'label' => get_the_title( $page ) ? get_the_title( $page ) : $doc['label'],
			'desc'  => $doc['desc'],
		);
	}
}
if ( ! $items ) {
	return;
}

if ( 'cards' === $mode ) {
	$html = '';
	foreach ( $items as $item ) {
		$html .= sprintf(
			'<li class="az-legal-card"><h2 class="az-legal-card__title"><a class="az-legal-card__link" href="%1$s">%2$s</a></h2><p class="az-legal-card__desc">%3$s</p><p class="az-legal-card__meta">Cập nhật lần cuối: %4$s</p></li>',
			esc_url( get_permalink( $item['page'] ) ),
			esc_html( $item['label'] ),
			esc_html( $item['desc'] ),
			esc_html( get_the_modified_date( 'd/m/Y', $item['page'] ) )
		);
	}
	printf(
		'<ul %1$s>%2$s</ul>',
		get_block_wrapper_attributes( array( 'class' => 'az-legal-cards' ) ), // phpcs:ignore WordPress.Security.EscapeOutput
		$html // phpcs:ignore WordPress.Security.EscapeOutput
	);
	return;
}

// Dạng thanh nút: thêm "Tất cả" nếu trang tổng /legal/ đã có.
$links = array();
$hub   = az_core_published_page( 'legal' );
if ( $hub ) {
	$links[] = array( 'id' => $hub->ID, 'label' => 'Tất cả', 'url' => get_permalink( $hub ) );
}
foreach ( $items as $item ) {
	$links[] = array( 'id' => $item['page']->ID, 'label' => $item['label'], 'url' => get_permalink( $item['page'] ) );
}

$html = '';
foreach ( $links as $link ) {
	$is_current = $current === (int) $link['id'];
	$html      .= sprintf(
		'<li><a class="az-legal-nav__link%1$s" href="%2$s"%3$s>%4$s</a></li>',
		$is_current ? ' is-current' : '',
		esc_url( $link['url'] ),
		$is_current ? ' aria-current="page"' : '',
		esc_html( $link['label'] )
	);
}

printf(
	'<nav %1$s aria-label="%2$s"><ul class="az-legal-nav__list">%3$s</ul></nav>',
	get_block_wrapper_attributes( array( 'class' => 'az-legal-nav' ) ), // phpcs:ignore WordPress.Security.EscapeOutput
	esc_attr__( 'Văn bản pháp lý', 'az-media-core' ),
	$html // phpcs:ignore WordPress.Security.EscapeOutput
);
