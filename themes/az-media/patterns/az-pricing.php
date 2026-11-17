<?php
/**
 * Title: AZ Pricing
 * Slug: az-media/pricing
 * Categories: az-media
 * Description: 3 gói giá lấy từ CPT pricing_plan.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"az-section az-section--tint az-pricing","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull az-section az-section--tint az-pricing"><!-- wp:group {"className":"az-head az-head--center"} -->
<div class="wp-block-group az-head az-head--center"><!-- wp:paragraph {"className":"az-eyebrow"} -->
<p class="az-eyebrow">Bảng giá</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"az-h2"} -->
<h2 class="wp-block-heading az-h2">Gói dịch vụ linh hoạt cho mọi quy mô</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"az-head__lead"} -->
<p class="az-head__lead">Chọn gói phù hợp với giai đoạn hiện tại, nâng cấp bất cứ lúc nào khi thương hiệu lớn lên.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":11,"query":{"perPage":3,"pages":0,"offset":0,"postType":"pricing_plan","order":"asc","orderBy":"menu_order","author":"","search":"","exclude":[],"sticky":"","inherit":false},"className":"az-pricing__query"} -->
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
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/pricing/">Tìm hiểu thêm</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></section>
<!-- /wp:group -->
