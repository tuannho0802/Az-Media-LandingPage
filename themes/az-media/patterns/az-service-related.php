<?php
/**
 * Title: AZ Service Related
 * Slug: az-media/service-related
 * Categories: az-media
 * Description: 3 dịch vụ khác (loại trừ dịch vụ đang xem) dạng thẻ, link tới trang chi tiết. Tái dùng lưới az-svc-grid.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"az-section az-section--tint az-svc-grid az-svc-related","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull az-section az-section--tint az-svc-grid az-svc-related"><!-- wp:group {"className":"az-head az-head--center"} -->
<div class="wp-block-group az-head az-head--center"><!-- wp:paragraph {"className":"az-eyebrow"} -->
<p class="az-eyebrow">Dịch vụ khác</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"az-h2"} -->
<h2 class="wp-block-heading az-h2">Có thể bạn cũng quan tâm</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":15,"query":{"perPage":3,"pages":0,"offset":0,"postType":"service","order":"asc","orderBy":"menu_order","author":"","search":"","exclude":[],"sticky":"","inherit":false},"className":"az-svc-grid__query"} -->
<div class="wp-block-query az-svc-grid__query"><!-- wp:post-template {"className":"az-svc-grid__list"} -->
<!-- wp:group {"className":"az-service"} -->
<div class="wp-block-group az-service"><!-- wp:post-title {"level":3,"isLink":true,"className":"az-service__title"} /-->

<!-- wp:post-excerpt {"excerptLength":30,"className":"az-service__text"} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></section>
<!-- /wp:group -->
