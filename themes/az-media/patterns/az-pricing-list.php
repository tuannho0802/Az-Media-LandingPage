<?php
/**
 * Title: AZ Pricing List
 * Slug: az-media/pricing-list
 * Categories: az-media
 * Description: Trang Bảng giá: chỉ 3 thẻ gói lấy từ CPT pricing_plan, nền trắng, không có phần đầu (theo ref OG-Pricing.png).
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"az-section az-pricing az-pricing--page","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull az-section az-pricing az-pricing--page"><!-- wp:query {"queryId":13,"query":{"perPage":3,"pages":0,"offset":0,"postType":"pricing_plan","order":"asc","orderBy":"menu_order","author":"","search":"","exclude":[],"sticky":"","inherit":false},"className":"az-pricing__query"} -->
<div class="wp-block-query az-pricing__query"><!-- wp:post-template {"className":"az-pricing__list"} -->
<!-- wp:group {"className":"az-plan"} -->
<div class="wp-block-group az-plan"><!-- wp:post-title {"level":3,"isLink":false,"className":"az-plan__name"} /-->

<!-- wp:post-excerpt {"excerptLength":24,"className":"az-plan__tag"} /-->

<!-- wp:group {"className":"az-plan__price"} -->
<div class="wp-block-group az-plan__price">
<!-- wp:paragraph {"className":"az-plan__amount","metadata":{"bindings":{"content":{"source":"core/post-meta","args":{"key":"az_price"}}}}} -->
<p class="az-plan__amount"></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"az-plan__period","metadata":{"bindings":{"content":{"source":"core/post-meta","args":{"key":"az_period"}}}}} -->
<p class="az-plan__period"></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"az-plan__summary","metadata":{"bindings":{"content":{"source":"core/post-meta","args":{"key":"az_summary"}}}}} -->
<p class="az-plan__summary"></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"az-plan__action"} -->
<div class="wp-block-buttons az-plan__action"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/contact/">Tìm hiểu thêm</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></section>
<!-- /wp:group -->
