<?php
/**
 * Title: AZ Testimonials
 * Slug: az-media/testimonials
 * Categories: az-media
 * Description: Slider lời nhận xét lấy từ CPT testimonial.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"az-section az-testimonials","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull az-section az-testimonials"><!-- wp:group {"className":"az-split az-split--end"} -->
<div class="wp-block-group az-split az-split--end"><!-- wp:group {"className":"az-split__main"} -->
<div class="wp-block-group az-split__main"><!-- wp:paragraph {"className":"az-eyebrow"} -->
<p class="az-eyebrow">Khách hàng nói gì</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"az-h2"} -->
<h2 class="wp-block-heading az-h2">Những câu chuyện tăng trưởng từ khách hàng</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"az-head__lead"} -->
<p class="az-head__lead">Lắng nghe trải nghiệm từ những thương hiệu đã đồng hành cùng AZ Media.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/about/">Về chúng tôi</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":12,"query":{"perPage":6,"pages":0,"offset":0,"postType":"testimonial","order":"asc","orderBy":"menu_order","author":"","search":"","exclude":[],"sticky":"","inherit":false},"className":"az-slider"} -->
<div class="wp-block-query az-slider"><!-- wp:post-template {"className":"az-slider__track"} -->
<!-- wp:group {"className":"az-quote"} -->
<div class="wp-block-group az-quote"><!-- wp:post-excerpt {"excerptLength":60,"className":"az-quote__text"} /-->

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
<!-- /wp:post-template --></div>
<!-- /wp:query --></section>
<!-- /wp:group -->
