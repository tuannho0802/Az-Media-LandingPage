<?php
/**
 * Title: AZ Career Detail Body
 * Slug: az-media/career-detail-body
 * Categories: az-media
 * Description: Thân trang chi tiết vị trí: nội dung bài (mô tả, yêu cầu, quyền lợi) bên trái; thẻ Thông tin vị trí (hình thức, lương, địa điểm, hạn nộp, cập nhật) và nút Ứng tuyển bên phải.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"az-section az-career-detail","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull az-section az-career-detail"><!-- wp:group {"className":"az-career-detail__grid"} -->
<div class="wp-block-group az-career-detail__grid"><!-- wp:group {"className":"az-career-detail__main"} -->
<div class="wp-block-group az-career-detail__main"><!-- wp:post-content {"className":"az-svc-content"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"tagName":"aside","className":"az-career-aside"} -->
<aside class="wp-block-group az-career-aside"><!-- wp:heading {"level":2,"className":"az-career-aside__title"} -->
<h2 class="wp-block-heading az-career-aside__title">Thông tin vị trí</h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"az-career-aside__row"} -->
<div class="wp-block-group az-career-aside__row"><!-- wp:paragraph {"className":"az-career-aside__label"} -->
<p class="az-career-aside__label">Hình thức</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"az-career-aside__value","metadata":{"bindings":{"content":{"source":"core/post-meta","args":{"key":"az_job_type"}}}}} -->
<p class="az-career-aside__value"></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"az-career-aside__row"} -->
<div class="wp-block-group az-career-aside__row"><!-- wp:paragraph {"className":"az-career-aside__label"} -->
<p class="az-career-aside__label">Mức lương</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"az-career-aside__value","metadata":{"bindings":{"content":{"source":"core/post-meta","args":{"key":"az_salary"}}}}} -->
<p class="az-career-aside__value"></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"az-career-aside__row"} -->
<div class="wp-block-group az-career-aside__row"><!-- wp:paragraph {"className":"az-career-aside__label"} -->
<p class="az-career-aside__label">Địa điểm</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"az-career-aside__value","metadata":{"bindings":{"content":{"source":"core/post-meta","args":{"key":"az_location"}}}}} -->
<p class="az-career-aside__value"></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"az-career-aside__row"} -->
<div class="wp-block-group az-career-aside__row"><!-- wp:paragraph {"className":"az-career-aside__label"} -->
<p class="az-career-aside__label">Hạn nộp hồ sơ</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"az-career-aside__value","metadata":{"bindings":{"content":{"source":"core/post-meta","args":{"key":"az_deadline"}}}}} -->
<p class="az-career-aside__value"></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:az-media/post-updated /-->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/contact/">Ứng tuyển ngay</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></aside>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
