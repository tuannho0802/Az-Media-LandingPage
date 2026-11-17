<?php
/**
 * Title: AZ About Team
 * Slug: az-media/about-team
 * Categories: az-media
 * Description: Đội ngũ: badge + H2 căn giữa; lưới 2 cột thẻ thành viên (ảnh đại diện + chức danh dạng badge, tên, mô tả) lấy từ CPT team_member.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"az-section az-team","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull az-section az-team"><!-- wp:group {"className":"az-head az-head--center"} -->
<div class="wp-block-group az-head az-head--center"><!-- wp:paragraph {"className":"az-eyebrow"} -->
<p class="az-eyebrow">Đội ngũ</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"az-h2"} -->
<h2 class="wp-block-heading az-h2">Những chuyên gia đứng sau thành công của bạn</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":16,"query":{"perPage":4,"pages":0,"offset":0,"postType":"team_member","order":"asc","orderBy":"menu_order","author":"","search":"","exclude":[],"sticky":"","inherit":false},"className":"az-team__query"} -->
<div class="wp-block-query az-team__query"><!-- wp:post-template {"className":"az-team__list"} -->
<!-- wp:group {"className":"az-member"} -->
<div class="wp-block-group az-member"><!-- wp:group {"className":"az-member__photo"} -->
<div class="wp-block-group az-member__photo"><!-- wp:post-featured-image {"isLink":false,"className":"az-member__img"} /-->

<!-- wp:paragraph {"className":"az-eyebrow az-member__role","metadata":{"bindings":{"content":{"source":"core/post-meta","args":{"key":"az_role"}}}}} -->
<p class="az-eyebrow az-member__role"></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"az-member__body"} -->
<div class="wp-block-group az-member__body"><!-- wp:post-title {"level":3,"isLink":false,"className":"az-member__name"} /-->

<!-- wp:post-excerpt {"excerptLength":30,"className":"az-member__text"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></section>
<!-- /wp:group -->
