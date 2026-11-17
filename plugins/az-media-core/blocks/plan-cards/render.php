<?php
/**
 * Render block az-media/plan-cards.
 *
 * @var array $attributes Block attributes.
 *
 * @package az-media-core
 */

defined( 'ABSPATH' ) || exit;

$plans = az_core_get_plans( (int) ( $attributes['limit'] ?? 3 ) );
if ( ! $plans ) {
	return;
}

$items = '';
foreach ( $plans as $plan ) {
	$features = '';
	foreach ( $plan['features'] as $feature ) {
		$features .= '<li class="az-plan__feature">' . esc_html( $feature['label'] );
		if ( '' !== $feature['value'] ) {
			$features .= ': <strong>' . esc_html( $feature['value'] ) . '</strong>';
		}
		$features .= '</li>';
	}

	$items .= sprintf(
		'<li><div class="wp-block-group az-plan">%1$s%2$s<div class="wp-block-group az-plan__price">%3$s%4$s</div>%5$s%6$s<div class="wp-block-buttons az-plan__action"><div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="%7$s" aria-label="%8$s">Chọn gói này</a></div></div></div></li>',
		'<h3 class="wp-block-heading az-plan__name">' . esc_html( $plan['name'] ) . '</h3>',
		'' !== $plan['tag'] ? '<p class="az-plan__tag">' . esc_html( $plan['tag'] ) . '</p>' : '',
		'<p class="az-plan__amount">' . esc_html( $plan['price'] ) . '</p>',
		'' !== $plan['period'] ? '<p class="az-plan__period">' . esc_html( $plan['period'] ) . '</p>' : '',
		'' !== $plan['summary'] ? '<p class="az-plan__summary">' . esc_html( $plan['summary'] ) . '</p>' : '',
		$features ? '<ul class="az-plan__features">' . $features . '</ul>' : '', // Đã esc từng mục.
		esc_url( add_query_arg( 'plan', $plan['slug'], home_url( '/contact/' ) ) ),
		/* translators: %s: tên gói */
		esc_attr( sprintf( 'Chọn gói %s và liên hệ tư vấn', $plan['name'] ) )
	);
}

printf(
	'<ul %1$s>%2$s</ul>',
	get_block_wrapper_attributes( array( 'class' => 'az-pricing__list' ) ), // phpcs:ignore WordPress.Security.EscapeOutput
	$items // phpcs:ignore WordPress.Security.EscapeOutput
);
