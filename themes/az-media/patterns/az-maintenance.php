<?php
/**
 * Title: AZ Maintenance
 * Slug: az-media/maintenance
 * Categories: az-media
 * Description: Trang bảo trì toàn màn hình, nền đậm: logo, trạng thái, tiêu đề, thời gian dự kiến, 3 bước tiến độ, kênh liên hệ gấp. Không có header/footer.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"az-maint__section","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull az-maint__section"><!-- wp:group {"className":"az-maint__inner"} -->
<div class="wp-block-group az-maint__inner"><!-- wp:site-title {"level":0,"className":"az-logo az-maint__logo"} /-->

<!-- wp:html -->
<p class="az-maint__status" role="status"><span class="az-maint__dot" aria-hidden="true"></span>Đang bảo trì hệ thống</p>
<!-- /wp:html -->

<!-- wp:heading {"level":1,"className":"az-maint__title"} -->
<h1 class="wp-block-heading az-maint__title">Chúng tôi đang nâng cấp website để phục vụ bạn tốt hơn</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"az-maint__lead"} -->
<p class="az-maint__lead">Website AZ Media tạm ngừng hoạt động trong ít phút để cập nhật và tối ưu. Dữ liệu của bạn vẫn an toàn, chúng tôi sẽ quay lại sớm nhất có thể.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"az-maint__card"} -->
<div class="wp-block-group az-maint__card"><!-- wp:group {"className":"az-maint__eta"} -->
<div class="wp-block-group az-maint__eta"><!-- wp:paragraph {"className":"az-maint__eta-label"} -->
<p class="az-maint__eta-label">Dự kiến hoạt động trở lại</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"az-maint__eta-value"} -->
<p class="az-maint__eta-value">Trong vòng 2 giờ (thời gian mẫu, sửa theo thực tế)</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:html -->
<ol class="az-maint__steps" aria-label="Tiến độ bảo trì">
	<li class="is-done"><span class="az-maint__step-title">Sao lưu dữ liệu</span><span class="az-maint__step-note">Hoàn tất</span></li>
	<li class="is-active" aria-current="step"><span class="az-maint__step-title">Nâng cấp hệ thống</span><span class="az-maint__step-note">Đang thực hiện</span></li>
	<li><span class="az-maint__step-title">Kiểm tra lần cuối</span><span class="az-maint__step-note">Sắp tới</span></li>
</ol>
<!-- /wp:html --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"az-maint__help"} -->
<div class="wp-block-group az-maint__help"><!-- wp:paragraph {"className":"az-maint__help-text"} -->
<p class="az-maint__help-text">Cần hỗ trợ gấp trong lúc bảo trì?</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="mailto:hello@azmedia.example">hello@azmedia.example</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="tel:+84000000000">+84 000 000 000</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"az-maint__copy"} -->
<p class="az-maint__copy">© AZ Media. Cảm ơn bạn đã kiên nhẫn chờ đợi.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
