<?php
/**
 * Title: AZ Testimonials
 * Slug: az-media/testimonials
 * Categories: az-media
 * Description: Hàng đầu (badge + H2, mô tả, nút) và lưới 3 cột x 2 hàng lời nhận xét lấy từ CPT testimonial. Mobile: vuốt ngang.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"az-section az-testimonials","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull az-section az-testimonials"><!-- wp:group {"className":"az-test__head"} -->
<div class="wp-block-group az-test__head"><!-- wp:group {"className":"az-head"} -->
<div class="wp-block-group az-head"><!-- wp:paragraph {"className":"az-eyebrow"} -->
<p class="az-eyebrow">Khách hàng nói gì</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"az-h2"} -->
<h2 class="wp-block-heading az-h2">Những câu chuyện tăng trưởng từ khách hàng</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"az-head__lead"} -->
<p class="az-head__lead">Lắng nghe trải nghiệm từ những thương hiệu đã đồng hành cùng AZ Media và kết quả họ đạt được.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/about/">Về chúng tôi</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":12,"query":{"perPage":6,"pages":0,"offset":0,"postType":"testimonial","order":"asc","orderBy":"menu_order","author":"","search":"","exclude":[],"sticky":"","inherit":false},"className":"az-testimonials__query"} -->
<div class="wp-block-query az-testimonials__query"><!-- wp:post-template {"className":"az-quotes"} -->
<!-- wp:group {"className":"az-quote"} -->
<div class="wp-block-group az-quote"><!-- wp:group {"className":"az-quote__body"} -->
<div class="wp-block-group az-quote__body"><!-- wp:post-excerpt {"excerptLength":60,"className":"az-quote__text"} /-->

<!-- wp:group {"className":"az-quote__person"} -->
<div class="wp-block-group az-quote__person">
<!-- wp:paragraph {"className":"az-quote__avatar","metadata":{"bindings":{"content":{"source":"core/post-meta","args":{"key":"az_initials"}}}}} -->
<p class="az-quote__avatar"></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"az-quote__meta"} -->
<div class="wp-block-group az-quote__meta"><!-- wp:post-title {"level":4,"isLink":false,"className":"az-quote__name"} /-->

<!-- wp:paragraph {"className":"az-quote__role","metadata":{"bindings":{"content":{"source":"core/post-meta","args":{"key":"az_role"}}}}} -->
<p class="az-quote__role"></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"az-quote__stars"} -->
<p class="az-quote__stars" aria-label="Đánh giá 5 trên 5">★★★★★</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></section>
<!-- /wp:group -->
