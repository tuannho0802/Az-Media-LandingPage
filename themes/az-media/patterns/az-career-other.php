<?php
/**
 * Title: AZ Career Other
 * Slug: az-media/career-other
 * Categories: az-media
 * Description: Tối đa 2 vị trí khác (loại trừ vị trí đang xem) dạng thẻ việc làm, link tới trang chi tiết.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"az-section az-section--tint az-jobs az-career-other","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull az-section az-section--tint az-jobs az-career-other"><!-- wp:group {"className":"az-head az-head--center"} -->
<div class="wp-block-group az-head az-head--center"><!-- wp:paragraph {"className":"az-eyebrow"} -->
<p class="az-eyebrow">Vị trí khác</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"az-h2"} -->
<h2 class="wp-block-heading az-h2">Có thể bạn cũng quan tâm</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":32,"query":{"perPage":2,"pages":0,"offset":0,"postType":"career","order":"asc","orderBy":"menu_order","author":"","search":"","exclude":[],"sticky":"","inherit":false},"className":"az-jobs__query"} -->
<div class="wp-block-query az-jobs__query"><!-- wp:post-template {"className":"az-jobs__list"} -->
<!-- wp:group {"className":"az-job"} -->
<div class="wp-block-group az-job"><!-- wp:post-title {"level":3,"isLink":true,"className":"az-job__title"} /-->

<!-- wp:group {"className":"az-job__meta"} -->
<div class="wp-block-group az-job__meta">
<!-- wp:paragraph {"className":"az-job__tag az-job__tag--type","metadata":{"bindings":{"content":{"source":"core/post-meta","args":{"key":"az_job_type"}}}}} -->
<p class="az-job__tag az-job__tag--type"></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"az-job__tag az-job__tag--salary","metadata":{"bindings":{"content":{"source":"core/post-meta","args":{"key":"az_salary"}}}}} -->
<p class="az-job__tag az-job__tag--salary"></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:post-excerpt {"excerptLength":40,"className":"az-job__text"} /-->

<!-- wp:group {"className":"az-job__foot"} -->
<div class="wp-block-group az-job__foot"><!-- wp:az-media/post-updated /-->

<!-- wp:read-more {"content":"Xem chi tiết","className":"az-job__more"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></section>
<!-- /wp:group -->
