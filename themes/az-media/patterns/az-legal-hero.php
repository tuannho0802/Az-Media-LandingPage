<?php
/**
 * Title: AZ Legal Hero
 * Slug: az-media/legal-hero
 * Categories: az-media
 * Description: Đầu trang pháp lý: badge, tiêu đề trang (H1) và dòng "Cập nhật lần cuối" lấy từ ngày sửa gần nhất của trang.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"az-section az-page-hero","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull az-section az-page-hero"><!-- wp:group {"className":"az-page-hero__inner"} -->
<div class="wp-block-group az-page-hero__inner"><!-- wp:paragraph {"className":"az-eyebrow"} -->
<p class="az-eyebrow">Pháp lý</p>
<!-- /wp:paragraph -->

<!-- wp:post-title {"level":1,"isLink":false,"className":"az-page-hero__title"} /-->

<!-- wp:group {"className":"az-legal__updated"} -->
<div class="wp-block-group az-legal__updated"><!-- wp:paragraph -->
<p>Cập nhật lần cuối:</p>
<!-- /wp:paragraph -->

<!-- wp:post-date {"displayType":"modified","format":"d/m/Y"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
