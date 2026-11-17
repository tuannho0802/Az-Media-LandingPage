<?php
/**
 * Title: AZ Contact Form
 * Slug: az-media/contact-form
 * Categories: az-media
 * Description: Khối nền nhạt bo góc: trái ảnh cao, phải badge, H2 và form liên hệ (block az-media/contact-form).
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"az-section az-contact-form","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull az-section az-contact-form"><!-- wp:group {"className":"az-contact-box"} -->
<div class="wp-block-group az-contact-box"><!-- wp:image {"sizeSlug":"large","className":"az-contact-box__img"} -->
<figure class="wp-block-image size-large az-contact-box__img"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/placeholder-team.svg' ) ); ?>" alt="Ảnh đội ngũ AZ Media trao đổi với khách hàng (ảnh tạm, thay bằng ảnh thật)"/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"az-head az-contact-box__main"} -->
<div class="wp-block-group az-head az-contact-box__main"><!-- wp:paragraph {"className":"az-eyebrow"} -->
<p class="az-eyebrow">Gửi tin nhắn</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"az-h2"} -->
<h2 class="wp-block-heading az-h2">Cùng trao đổi về mục tiêu mạng xã hội của bạn</h2>
<!-- /wp:heading -->

<!-- wp:az-media/contact-form /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
