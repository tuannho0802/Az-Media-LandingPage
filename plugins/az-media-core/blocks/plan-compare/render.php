<?php
/**
 * Render block az-media/plan-compare: hàng là tính năng, cột là gói.
 * Một tính năng có giá trị thì hiện giá trị; có tên mà không có giá trị thì hiện dấu tích; gói không có thì hiện dấu gạch.
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

// label => [ chỉ số gói => giá trị | true ]. Thứ tự hàng theo lần xuất hiện đầu tiên.
$rows = array();
foreach ( $plans as $i => $plan ) {
	foreach ( $plan['features'] as $feature ) {
		$rows[ $feature['label'] ][ $i ] = '' !== $feature['value'] ? $feature['value'] : true;
	}
}
if ( ! $rows ) {
	return;
}

// Gói thứ hai là gói nổi bật (cùng quy ước với thẻ gói ở trang chủ).
$col_class = static function ( $i ) {
	return 1 === $i ? ' class="is-featured"' : '';
};

$head = '<th scope="col" class="az-compare__corner">Tính năng</th>';
foreach ( $plans as $i => $plan ) {
	$price = trim( $plan['price'] . ' ' . $plan['period'] );
	$head .= sprintf(
		'<th scope="col"%1$s>%2$s%3$s</th>',
		$col_class( $i ), // phpcs:ignore WordPress.Security.EscapeOutput
		esc_html( $plan['name'] ),
		'' !== $price ? '<span class="az-compare__price">' . esc_html( $price ) . '</span>' : ''
	);
}

$body = '';
foreach ( $rows as $label => $cells ) {
	$body .= '<tr><th scope="row">' . esc_html( $label ) . '</th>';
	foreach ( $plans as $i => $plan ) {
		if ( ! isset( $cells[ $i ] ) ) {
			$cell = '<span class="az-compare__no" aria-hidden="true">&mdash;</span><span class="az-sr">Không có</span>';
		} elseif ( true === $cells[ $i ] ) {
			$cell = '<span class="az-compare__yes" aria-hidden="true"></span><span class="az-sr">Có</span>';
		} else {
			$cell = esc_html( $cells[ $i ] );
		}
		$body .= '<td' . $col_class( $i ) . '>' . $cell . '</td>'; // phpcs:ignore WordPress.Security.EscapeOutput
	}
	$body .= '</tr>';
}

printf(
	'<div %1$s><div class="az-compare__scroll" role="region" aria-label="%2$s" tabindex="0"><table class="az-compare__table"><thead><tr>%3$s</tr></thead><tbody>%4$s</tbody></table></div></div>',
	get_block_wrapper_attributes( array( 'class' => 'az-compare' ) ), // phpcs:ignore WordPress.Security.EscapeOutput
	esc_attr__( 'Bảng so sánh tính năng các gói', 'az-media-core' ),
	$head, // phpcs:ignore WordPress.Security.EscapeOutput
	$body // phpcs:ignore WordPress.Security.EscapeOutput
);
