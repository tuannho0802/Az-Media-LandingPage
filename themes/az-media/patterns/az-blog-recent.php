<?php
/**
 * Title: AZ Blog Recent
 * Slug: az-media/blog-recent
 * Categories: az-media
 * Description: Bài viết mới nhất: badge, H2, lưới 2 cột thẻ bài (ảnh, tiêu đề, trích đoạn, nút Đọc thêm). Dùng ở cuối trang FAQs.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"az-section az-blog-recent","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull az-section az-blog-recent"><!-- wp:group {"className":"az-head"} -->
<div class="wp-block-group az-head"><!-- wp:paragraph {"className":"az-eyebrow"} -->
<p class="az-eyebrow">Blog</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"az-h2"} -->
<h2 class="wp-block-heading az-h2">Bài viết mới nhất</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":21,"query":{"perPage":2,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"className":"az-blog-recent__query"} -->
<div class="wp-block-query az-blog-recent__query"><!-- wp:post-template {"className":"az-blog-recent__list"} -->
<!-- wp:group {"className":"az-post-card"} -->
<div class="wp-block-group az-post-card"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"3/2","className":"az-post-card__img"} /-->

<!-- wp:group {"className":"az-post-card__body"} -->
<div class="wp-block-group az-post-card__body"><!-- wp:post-title {"level":3,"isLink":true,"className":"az-post-card__title"} /-->

<!-- wp:post-excerpt {"excerptLength":24,"showMoreOnNewLine":false,"className":"az-post-card__text"} /-->

<!-- wp:read-more {"content":"Đọc thêm","className":"az-post-card__more"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></section>
<!-- /wp:group -->
