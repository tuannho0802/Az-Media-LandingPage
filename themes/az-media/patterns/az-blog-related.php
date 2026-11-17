<?php
/**
 * Title: AZ Blog Related
 * Slug: az-media/blog-related
 * Categories: az-media
 * Description: Bài viết liên quan cuối bài: 3 bài mới nhất (trừ bài đang xem).
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"az-section az-section--tint az-blog-grid az-blog-related","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull az-section az-section--tint az-blog-grid az-blog-related"><!-- wp:group {"className":"az-head"} -->
<div class="wp-block-group az-head"><!-- wp:paragraph {"className":"az-eyebrow"} -->
<p class="az-eyebrow">Blog</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"az-h2"} -->
<h2 class="wp-block-heading az-h2">Bài viết liên quan</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":33,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"className":"az-blog-grid__query"} -->
<div class="wp-block-query az-blog-grid__query"><!-- wp:post-template {"className":"az-blog-grid__list"} -->
<!-- wp:group {"className":"az-post-card az-post-card--blog"} -->
<div class="wp-block-group az-post-card az-post-card--blog"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"3/2","className":"az-post-card__img"} /-->

<!-- wp:group {"className":"az-post-card__body"} -->
<div class="wp-block-group az-post-card__body"><!-- wp:post-terms {"term":"category","className":"az-post-card__cat"} /-->

<!-- wp:post-title {"level":3,"isLink":true,"className":"az-post-card__title"} /-->

<!-- wp:group {"className":"az-post-card__meta","layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group az-post-card__meta"><!-- wp:post-date {"format":"d/m/Y"} /-->

<!-- wp:az-media/read-time /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></section>
<!-- /wp:group -->
