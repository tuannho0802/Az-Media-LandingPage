<?php
/**
 * Title: AZ Site Logo
 * Slug: az-media/site-logo
 * Categories: az-media
 * Inserter: false
 * Description: Logo AZ Media (ảnh) ở header, bấm về trang chủ. Dùng bằng pattern vì template part .html không chạy PHP nên không lấy được URL ảnh của theme.
 */
?>
<!-- wp:html -->
<a class="az-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/logo-az-media.png' ) ); ?>" alt="AZ Media" width="1200" height="205" decoding="async" fetchpriority="high"></a>
<!-- /wp:html -->
