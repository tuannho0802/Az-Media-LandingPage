<?php
/**
 * Title: AZ Career Jobs
 * Slug: az-media/career-jobs
 * Categories: az-media
 * Description: Vị trí đang tuyển: badge + H2 căn giữa, lưới 2 cột thẻ việc làm lấy từ CPT career (hình thức, mức lương, mô tả, thời gian cập nhật dạng "2 ngày trước"). Chưa có vị trí thì hiện thông báo.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"az-section az-jobs","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull az-section az-jobs"><!-- wp:group {"className":"az-head az-head--center"} -->
<div class="wp-block-group az-head az-head--center"><!-- wp:paragraph {"className":"az-eyebrow"} -->
<p class="az-eyebrow">Vị trí đang tuyển</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"az-h2"} -->
<h2 class="wp-block-heading az-h2">Các vị trí đang mở</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":31,"query":{"perPage":6,"pages":0,"offset":0,"postType":"career","order":"asc","orderBy":"menu_order","author":"","search":"","exclude":[],"sticky":"","inherit":false},"className":"az-jobs__query"} -->
<div class="wp-block-query az-jobs__query"><!-- wp:post-template {"className":"az-jobs__list"} -->
<!-- wp:group {"className":"az-job"} -->
<div class="wp-block-group az-job"><!-- wp:post-title {"level":3,"isLink":false,"className":"az-job__title"} /-->

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

<!-- wp:az-media/post-updated /--></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"className":"az-jobs__empty"} -->
<p class="az-jobs__empty">Hiện chưa có vị trí nào đang tuyển. Bạn vẫn có thể gửi CV tự do cho chúng tôi qua trang Liên hệ.</p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query --></section>
<!-- /wp:group -->
