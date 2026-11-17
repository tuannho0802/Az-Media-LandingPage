<?php
/**
 * Title: AZ Post Header
 * Slug: az-media/post-header
 * Categories: az-media
 * Description: Đầu bài viết: danh mục, H1, ngày đăng, tác giả, thời gian đọc, ảnh đại diện.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"az-section az-post-head","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull az-section az-post-head"><!-- wp:group {"className":"az-post-head__inner"} -->
<div class="wp-block-group az-post-head__inner"><!-- wp:post-terms {"term":"category","className":"az-eyebrow"} /-->

<!-- wp:post-title {"level":1,"className":"az-page-hero__title"} /-->

<!-- wp:group {"className":"az-post-card__meta az-post-head__meta","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
<div class="wp-block-group az-post-card__meta az-post-head__meta"><!-- wp:post-author-name /-->

<!-- wp:post-date {"format":"d/m/Y"} /-->

<!-- wp:az-media/read-time /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:post-featured-image {"aspectRatio":"16/9","className":"az-post-head__img"} /--></section>
<!-- /wp:group -->
