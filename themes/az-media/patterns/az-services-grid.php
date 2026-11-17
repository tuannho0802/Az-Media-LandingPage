<?php
/**
 * Title: AZ Services Grid
 * Slug: az-media/services-grid
 * Categories: az-media
 * Description: Lưới 3x2 thẻ dịch vụ (icon, tên, mô tả) lấy từ CPT service.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"az-section az-svc-grid","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull az-section az-svc-grid"><!-- wp:group {"className":"az-head az-head--center"} -->
<div class="wp-block-group az-head az-head--center"><!-- wp:paragraph {"className":"az-eyebrow"} -->
<p class="az-eyebrow">Dịch vụ</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"az-h2"} -->
<h2 class="wp-block-heading az-h2">Nâng tầm thương hiệu của bạn trong thế giới số</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"az-head__lead"} -->
<p class="az-head__lead">Chiến lược sáng tạo, số liệu rõ ràng và chiến dịch hiệu quả giúp thương hiệu tăng trưởng đo được.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":14,"query":{"perPage":6,"pages":0,"offset":0,"postType":"service","order":"asc","orderBy":"menu_order","author":"","search":"","exclude":[],"sticky":"","inherit":false},"className":"az-svc-grid__query"} -->
<div class="wp-block-query az-svc-grid__query"><!-- wp:post-template {"className":"az-svc-grid__list"} -->
<!-- wp:group {"className":"az-service"} -->
<div class="wp-block-group az-service"><!-- wp:post-title {"level":3,"isLink":false,"className":"az-service__title"} /-->

<!-- wp:post-excerpt {"excerptLength":30,"className":"az-service__text"} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></section>
<!-- /wp:group -->
