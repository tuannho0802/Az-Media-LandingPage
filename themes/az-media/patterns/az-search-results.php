<?php
/**
 * Title: AZ Search Results
 * Slug: az-media/search-results
 * Categories: az-media
 * Description: Lưới 2 cột thẻ kết quả (bài viết và dịch vụ), phân trang, trạng thái không có kết quả kèm gợi ý. Dùng lại thẻ az-post-card.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"az-section az-blog-recent az-search-results","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull az-section az-blog-recent az-search-results"><!-- wp:query {"queryId":22,"query":{"perPage":8,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"className":"az-blog-recent__query"} -->
<div class="wp-block-query az-blog-recent__query"><!-- wp:post-template {"className":"az-blog-recent__list"} -->
<!-- wp:group {"className":"az-post-card"} -->
<div class="wp-block-group az-post-card"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"3/2","className":"az-post-card__img"} /-->

<!-- wp:group {"className":"az-post-card__body"} -->
<div class="wp-block-group az-post-card__body"><!-- wp:post-title {"level":3,"isLink":true,"className":"az-post-card__title"} /-->

<!-- wp:post-excerpt {"excerptLength":24,"showMoreOnNewLine":false,"className":"az-post-card__text"} /-->

<!-- wp:read-more {"content":"Đọc thêm","className":"az-post-card__more"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex","justifyContent":"center"}} -->
<!-- wp:query-pagination-previous {"label":"Trước"} /-->

<!-- wp:query-pagination-numbers /-->

<!-- wp:query-pagination-next {"label":"Sau"} /-->
<!-- /wp:query-pagination -->

<!-- wp:query-no-results -->
<!-- wp:group {"className":"az-search-empty"} -->
<div class="wp-block-group az-search-empty"><!-- wp:heading {"level":2,"className":"az-h2"} -->
<h2 class="wp-block-heading az-h2">Không có kết quả phù hợp</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"az-head__lead"} -->
<p class="az-head__lead">Hãy kiểm tra chính tả, thử từ khóa ngắn hơn hoặc dùng từ đồng nghĩa. Bạn cũng có thể xem các trang gợi ý bên dưới.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/">Về trang chủ</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/all-services/">Dịch vụ</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/contact/">Liên hệ</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query --></section>
<!-- /wp:group -->
