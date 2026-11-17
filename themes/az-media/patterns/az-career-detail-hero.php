<?php
/**
 * Title: AZ Career Detail Hero
 * Slug: az-media/career-detail-hero
 * Categories: az-media
 * Description: Đầu trang chi tiết vị trí tuyển dụng: badge, tên vị trí (H1), hình thức, mức lương, địa điểm, tóm tắt từ excerpt, nút Ứng tuyển và Xem tất cả vị trí.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"az-section az-page-hero az-career-hero","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull az-section az-page-hero az-career-hero"><!-- wp:group {"className":"az-page-hero__inner"} -->
<div class="wp-block-group az-page-hero__inner"><!-- wp:paragraph {"className":"az-eyebrow"} -->
<p class="az-eyebrow">Tuyển dụng</p>
<!-- /wp:paragraph -->

<!-- wp:post-title {"level":1,"isLink":false,"className":"az-page-hero__title"} /-->

<!-- wp:group {"className":"az-career-meta"} -->
<div class="wp-block-group az-career-meta">
<!-- wp:paragraph {"className":"az-job__tag az-job__tag--type","metadata":{"bindings":{"content":{"source":"core/post-meta","args":{"key":"az_job_type"}}}}} -->
<p class="az-job__tag az-job__tag--type"></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"az-job__tag az-job__tag--salary","metadata":{"bindings":{"content":{"source":"core/post-meta","args":{"key":"az_salary"}}}}} -->
<p class="az-job__tag az-job__tag--salary"></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"az-job__tag az-job__tag--location","metadata":{"bindings":{"content":{"source":"core/post-meta","args":{"key":"az_location"}}}}} -->
<p class="az-job__tag az-job__tag--location"></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:post-excerpt {"excerptLength":40,"className":"az-head__lead"} /-->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/contact/">Ứng tuyển ngay</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/career/">Xem tất cả vị trí</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
