<?php
/**
 * Render block az-media/faq-list.
 *
 * @var array $attributes Block attributes.
 *
 * @package az-media-core
 */

defined( 'ABSPATH' ) || exit;

$limit   = max( 1, min( 50, (int) ( $attributes['limit'] ?? 5 ) ) );
$columns = 2 === (int) ( $attributes['columns'] ?? 1 ) ? 2 : 1;
$args  = array(
	'post_type'      => 'faq',
	'post_status'    => 'publish',
	'posts_per_page' => $limit,
	'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
	'no_found_rows'  => true,
);
if ( ! empty( $attributes['group'] ) ) {
	$args['tax_query'] = array( array( 'taxonomy' => 'faq_group', 'field' => 'slug', 'terms' => sanitize_title( $attributes['group'] ) ) );
}
$faqs = get_posts( $args );
if ( ! $faqs ) {
	return;
}

$schema  = array();
$entries = array();
foreach ( $faqs as $i => $faq ) {
	$answer_html = wpautop( wp_kses_post( $faq->post_content ) );
	$schema[]    = array(
		'@type'          => 'Question',
		'name'           => wp_strip_all_tags( get_the_title( $faq ) ),
		'acceptedAnswer' => array( '@type' => 'Answer', 'text' => wp_strip_all_tags( $answer_html ) ),
	);
	$entries[]   = array(
		'num'    => str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ),
		'title'  => get_the_title( $faq ),
		'answer' => $answer_html, // Đã qua wp_kses_post.
	);
}

// Chia cột: số thứ tự đánh liên tục, câu đầu của mỗi cột mở sẵn (theo ref).
$chunks = 2 === $columns && count( $entries ) > 1 ? array_chunk( $entries, (int) ceil( count( $entries ) / 2 ) ) : array( $entries );
$items  = '';
foreach ( $chunks as $chunk ) {
	$col = '';
	foreach ( $chunk as $j => $entry ) {
		$col .= sprintf(
			'<details class="az-faq__item"%1$s><summary class="az-faq__summary"><span class="az-faq__num">%2$s.</span><span class="az-faq__q">%3$s</span></summary><div class="az-faq__a">%4$s</div></details>',
			0 === $j ? ' open' : '',
			esc_html( $entry['num'] ),
			esc_html( $entry['title'] ),
			$entry['answer'] // phpcs:ignore WordPress.Security.EscapeOutput
		);
	}
	$items .= 2 === $columns ? '<div class="az-faq__col">' . $col . '</div>' : $col;
}

// JSON-LD FAQPage: chỉ in một lần mỗi trang. Nếu dùng Rank Math/Yoast có sẵn schema FAQ thì tắt dòng này.
static $schema_printed = false;
$json_ld = '';
if ( ! $schema_printed ) {
	$schema_printed = true;
	$json_ld        = '<script type="application/ld+json">' . wp_json_encode(
		array( '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $schema ),
		JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG
	) . '</script>';
}

printf(
	'<div %1$s>%2$s%3$s</div>',
	get_block_wrapper_attributes( array( 'class' => 'az-faq__list' . ( 2 === $columns ? ' az-faq__list--cols' : '' ) ) ), // phpcs:ignore WordPress.Security.EscapeOutput
	$items, // phpcs:ignore WordPress.Security.EscapeOutput
	$json_ld // phpcs:ignore WordPress.Security.EscapeOutput
);
