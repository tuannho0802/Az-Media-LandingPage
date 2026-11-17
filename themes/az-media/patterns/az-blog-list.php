<?php
/**
 * Title: AZ Blog List
 * Slug: az-media/blog-list
 * Categories: az-media
 * Description: Danh sách bài viết: chip danh mục, bài mới nhất nổi bật ở trang 1, lưới 3 cột thẻ bài (ảnh, danh mục, tiêu đề, trích đoạn, ngày, thời gian đọc), phân trang. Dùng cho trang Blog và trang danh mục.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"az-section az-blog-grid","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull az-section az-blog-grid"><!-- wp:group {"className":"az-blog-chips","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
<div class="wp-block-group az-blog-chips"><!-- wp:paragraph {"className":"az-blog-chips__all"} -->
<p class="az-blog-chips__all"><a href="/blog/">Tất cả</a></p>
<!-- /wp:paragraph -->

<!-- wp:categories {"showPostCounts":false,"className":"az-blog-chips__list"} /--></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":31,"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"className":"az-blog-grid__query"} -->
<div class="wp-block-query az-blog-grid__query"><!-- wp:post-template {"className":"az-blog-grid__list"} -->
<!-- wp:group {"className":"az-post-card az-post-card--blog"} -->
<div class="wp-block-group az-post-card az-post-card--blog"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"3/2","className":"az-post-card__img"} /-->

<!-- wp:group {"className":"az-post-card__body"} -->
<div class="wp-block-group az-post-card__body"><!-- wp:post-terms {"term":"category","className":"az-post-card__cat"} /-->

<!-- wp:post-title {"level":3,"isLink":true,"className":"az-post-card__title"} /-->

<!-- wp:post-excerpt {"excerptLength":24,"showMoreOnNewLine":false,"className":"az-post-card__text"} /-->

<!-- wp:group {"className":"az-post-card__meta","layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group az-post-card__meta"><!-- wp:post-date {"format":"d/m/Y"} /-->

<!-- wp:az-media/read-time /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex","justifyContent":"center"}} -->
<!-- wp:query-pagination-previous {"label":"Trước"} /-->

<!-- wp:query-pagination-numbers /-->

<!-- wp:query-pagination-next {"label":"Sau"} /-->
<!-- /wp:query-pagination -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"align":"center","className":"az-head__lead"} -->
<p class="has-text-align-center az-head__lead">Chưa có bài viết nào trong mục này.</p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query --></section>
<!-- /wp:group -->
