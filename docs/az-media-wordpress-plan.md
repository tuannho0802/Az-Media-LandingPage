# AZ Media – Kế hoạch dựng WordPress Theme (tham chiếu Reachout)

Bộ tài liệu cho Ngan · Phiên bản 0.1 · Nguồn tham chiếu: reachout.nexmotivedemo.com (trang chủ đã đọc; trang con chưa đọc được, xem mục 1.3)

## 1. Tổng quan

### 1.1 Mục tiêu

- Dựng website marketing agency **AZ Media** trên WordPress, chạy local bằng Local WP, theo cấu trúc và bố cục tương tự demo Reachout.
- Đổi tông màu chủ đạo từ tím sang **xanh đậm**, đổi toàn bộ thương hiệu và nội dung sang AZ Media.
- Kiến trúc dễ mở rộng: thêm trang Blog, bài viết, trang dịch vụ, tuyển dụng nhanh mà không phải sửa code nhiều.

### 1.2 Nguyên tắc bản quyền

- Chỉ tham chiếu **cấu trúc, thứ tự section, luồng người dùng**. Tự viết HTML/CSS/JS của mình.
- **Không** dùng lại logo, ảnh, icon, bản sao nội dung, tên khách hàng và lời nhận xét trong demo (đều là dữ liệu mẫu của tác giả). Dùng ảnh, icon, copy của AZ Media hoặc nguồn có license rõ ràng.
- Không tải theme từ các trang chia sẻ không chính thức. Nếu muốn dùng code gốc, mua license trên ThemeForest.

### 1.3 Phạm vi dữ liệu đã xác minh

| Hạng mục | Trạng thái |
|---|---|
| Trang chủ (thứ tự section, nội dung, menu, footer) | Đã đọc từ demo |
| Ảnh chụp hero (bố cục, kích thước tương đối, màu) | Đã xem qua ảnh bạn gửi |
| Các trang con (Pricing, Services, About, Blog, FAQs, Career, Contact, Maintenance, pháp lý) | **Chưa đọc được** (công cụ chặn URL con). Mục 5 là cấu trúc đề xuất, cần đối chiếu khi bạn gửi ảnh chụp hoặc HTML |
| Mã màu, font, spacing chính xác | **Chưa có**. Mục 3 là giá trị đề xuất cho AZ Media, cần đo lại bằng DevTools nếu muốn bám sát |

Theme gốc dựng bằng Elementor. Danh sách widget được nhà bán nêu gồm: Accordion, Advanced Tabs, Blog Posts, Button, FAQ, Heading, Icon Box, List, Business Hours, Clients Logo, Contact Form 7, Google Maps. Dùng làm gợi ý về các thành phần giao diện cần có.

## 2. Kiến trúc kỹ thuật đề xuất

### 2.1 Lựa chọn nền tảng

| Phương án | Ưu điểm | Nhược điểm | Khuyến nghị |
|---|---|---|---|
| **Block theme** (theme.json + block patterns + template HTML) | Chuẩn WordPress hiện đại, Site Editor, pattern tái sử dụng, nhẹ | Cần làm quen block markup | **Chọn mặc định** |
| Classic theme (PHP template) + ACF | Kiểm soát markup hoàn toàn, quen với dev | Chỉnh nội dung kém linh hoạt hơn | Dùng nếu muốn markup thuần PHP |
| Headless (WordPress + Next.js) | Hợp stack của bạn (Next.js) | Phức tạp, SEO/preview/form phải tự xử lý | Để giai đoạn sau nếu cần |

Tài liệu dưới đây viết theo **block theme**. Nếu chọn classic, mapping tương ứng: pattern → template-part, theme.json → CSS variables trong `style.css`.

### 2.2 Cấu trúc thư mục

```
wp-content/
  themes/az-media/
    theme.json              # màu, font, spacing, layout, style từng block
    style.css               # header theme + CSS bổ sung
    functions.php           # enqueue, hỗ trợ theme, đăng ký pattern category
    templates/              # front-page, home, single, page, archive, search, 404, page-contact...
    parts/                  # header, footer, announcement-bar
    patterns/               # hero, logos, why-us, solutions, pricing, testimonials, cta, faq...
    assets/
      css/ js/ img/ fonts/  # font self-host, không tải CDN
      src/                  # nguồn SCSS/JS nếu có build
    inc/                    # block-variations, shortcodes, helper nhỏ
  plugins/az-media-core/
    az-media-core.php       # đăng ký CPT, taxonomy, meta fields
    includes/
```

Tách **az-media-core** thành plugin riêng để dữ liệu (Services, Testimonials, Team, FAQ, Careers, Pricing) không mất khi đổi theme.

### 2.3 Custom Post Type

| CPT | Dùng cho | Trường chính | Hiển thị tại |
|---|---|---|---|
| `service` | Danh sách dịch vụ | icon, mô tả ngắn, thứ tự | Trang Services, trang chủ |
| `testimonial` | Lời nhận xét | tên, vai trò, avatar, nội dung | Slider trang chủ, About |
| `pricing_plan` | Gói giá | giá, chu kỳ, danh sách tính năng, nổi bật | Trang chủ, Pricing |
| `faq` | Câu hỏi thường gặp | câu hỏi, trả lời, nhóm | Trang chủ, FAQs |
| `team_member` | Thành viên | tên, chức danh, ảnh, social | About |
| `career` | Vị trí tuyển dụng | địa điểm, hình thức, hạn nộp | Trang Career |
| `post` (có sẵn) | Blog | taxonomy category, tag | Blog |

Trường meta: dùng ACF (nhanh) hoặc Meta Box/code thuần (nhẹ, không phụ thuộc). Với dự án local và scale lâu dài, ưu tiên đăng ký bằng code trong `az-media-core`.

### 2.4 Plugin

| Plugin | Mục đích | Bắt buộc |
|---|---|---|
| Contact Form 7 (hoặc Fluent Forms) | Form liên hệ, tuyển dụng, báo giá | Có |
| Rank Math hoặc Yoast SEO | Meta, schema, sitemap | Có |
| ACF (tùy chọn) | Trường meta cho CPT | Tùy |
| WP Super Cache / LiteSpeed Cache | Cache (khi lên host) | Khi deploy |
| Query Monitor | Debug khi dev | Dev |
| All-in-One WP Migration hoặc Duplicator | Chuyển local lên host | Khi deploy |

Tránh page builder để giữ theme nhẹ. Tất cả section là block pattern.

## 3. Design System (đề xuất cho AZ Media)

### 3.1 Bảng màu

Giá trị dưới đây là **đề xuất**, thay cho tông tím của demo. Có thể tinh chỉnh khi bạn có logo AZ Media.

| Token | Vai trò | Giá trị đề xuất | Thay cho (demo) |
|---|---|---|---|
| `--az-primary` | Nút chính, tiêu đề nhấn | `#0A2A66` | Tím đậm / gần đen |
| `--az-primary-dark` | Announcement bar, footer, nút hover | `#06173D` | Tím rất đậm |
| `--az-accent` | Link, highlight, icon | `#2F6BFF` | Tím sáng |
| `--az-tint` | Nền badge, card nhạt | `#E8EEFB` | Tím nhạt |
| `--az-text` | Chữ chính | `#0F172A` | Đen |
| `--az-muted` | Chữ phụ | `#475569` | Xám |
| `--az-border` | Viền | `#E2E8F0` | Xám nhạt |
| `--az-bg` | Nền trang | `#FFFFFF` | Trắng |

Kiểm tra tương phản chữ trắng trên `--az-primary` đạt WCAG AA trở lên.

### 3.2 Typography

- Font heading và body: một họ sans hình học (đề xuất Plus Jakarta Sans hoặc Inter), **tự host** file woff2, `font-display: swap`. Cần xác nhận font của demo qua DevTools nếu muốn giống hơn.
- Heading hero: rất đậm (700–800), cỡ lớn khoảng 56–64px desktop, 36–40px mobile (từ ảnh chụp). Dùng `clamp()` trong theme.json.
- Đoạn mô tả: cỡ 16–18px, line-height rộng (khoảng 1.7).

### 3.3 Layout và spacing

- Container tối đa khoảng 1200px, padding ngang 20–24px.
- Breakpoint: 1200 / 1024 / 768 / 480.
- Khoảng cách section dọc: 80–120px desktop, 56–72px mobile.
- Bo góc nút và card: 8–12px. Viền mảnh `--az-border`, đổ bóng nhẹ.

### 3.4 Thành phần giao diện

| Thành phần | Mô tả (từ demo) |
|---|---|
| Announcement bar | Thanh mỏng trên cùng, nền đậm, một dòng chữ sáng căn giữa, có nút đóng |
| Header | Logo trái, menu giữa (có dropdown Pages), 2 nút phải: Pricing (viền) và Contact (đặc). Sticky |
| Badge | Nhãn nhỏ chữ hoa trên H1 (nền nhạt, viền trái đậm) |
| Nút | Primary (nền đậm, chữ trắng), Secondary (nền trắng, viền) |
| Hero visual | Ảnh người ở bên phải, card nổi chồng lên (số liệu "24K Happy customers", rating) |
| Hero background | Lưới ô vuông rất nhạt phía sau |
| Stat counter | Số đếm tăng dần khi cuộn tới |
| Card đánh số | Số 01–04, tiêu đề, mô tả |
| Pricing card | Tên gói, giá/tháng, mô tả, nút Learn more |
| Testimonial slider | Trích dẫn lớn, avatar, tên, vai trò |
| Accordion FAQ | Câu hỏi đánh số 01–05, mở/đóng |
| Footer | Giới thiệu + liên hệ, 4 cột link, social, copyright, link pháp lý |

## 4. Trang chủ – đặc tả từng section

Nội dung mẫu dưới đây là **bản nháp cho AZ Media** (tiếng Việt, sửa tùy ý). Thứ tự section bám theo demo.

### 4.1 Announcement bar

- Nội dung: một dòng khuyến mãi hoặc thông điệp (ví dụ: "Tăng tốc thương hiệu của bạn cùng AZ Media").
- Có nút đóng, nhớ trạng thái bằng localStorage.
- Pattern: `az-announcement`.

### 4.2 Header

- Menu: Trang chủ, Bảng giá, Dịch vụ, Trang (Blog, FAQs, Tuyển dụng, Liên hệ), Giới thiệu.
- Nút phải: Bảng giá (outline), Liên hệ (solid).
- Mobile: menu hamburger, các nút xuống cuối menu.
- Part: `parts/header.html`.

### 4.3 Hero

- Badge, H1, mô tả, 2 nút, 3 điểm tin cậy (dùng thử, demo, hỗ trợ).
- Cột phải: ảnh, card nổi số liệu khách hàng, rating (4.8/5).
- Layout: 2 cột (khoảng 55/45), mobile xếp dọc.
- Pattern: `az-hero`.

### 4.4 Trusted by

- Tiêu đề nhỏ + hàng 6 logo khách hàng (grayscale, hover có màu). Mobile cuộn ngang hoặc lưới 3 cột.
- Dùng logo khách hàng thật của AZ Media (cần được phép) hoặc để placeholder trung tính.
- Pattern: `az-logos`.

### 4.5 Why choose us

- Eyebrow + H2 + nút.
- 3 stat counter (năm kinh nghiệm, quy mô đội, giải thưởng).
- 4 card đánh số 01–04 (chuyên môn, dữ liệu, nội dung, hỗ trợ).
- Lưu ý: demo có card "Healthcare expertise" lạc đề so với agency chung, nên bỏ hoặc đổi.
- Pattern: `az-why-us`.

### 4.6 Specialization (Vision và Mission)

- Eyebrow, H2, nút Liên hệ.
- Khối Tầm nhìn (đoạn văn) và Sứ mệnh (4 gạch đầu dòng ngắn).
- Pattern: `az-specialization`.

### 4.7 Our solutions

- Eyebrow, H2, đoạn mô tả.
- Lưới 6 thẻ số liệu (có counter): ví dụ lượt theo dõi, bài đăng, dự án, việc làm...
- Với AZ Media nên đổi sang số liệu thật (số dự án, khách hàng, lượt hiển thị).
- Pattern: `az-solutions` (hoặc lấy từ CPT `service` nếu muốn thẻ dịch vụ thay cho số liệu).

### 4.8 Pricing

- Eyebrow, H2, mô tả, 3 card gói (Starter, Standard, Premium) lấy từ CPT `pricing_plan`.
- Gói giữa nổi bật. Mỗi card: giá/tháng, mô tả, nút.
- Pattern: `az-pricing` (query loop `pricing_plan`).

### 4.9 Testimonials

- Eyebrow, H2, mô tả, nút About Us.
- Slider 6 lời nhận xét lấy từ CPT `testimonial`. Mỗi mục: trích dẫn, avatar, tên, vai trò.
- Slider dùng thư viện nhẹ tự host (Splide hoặc Swiper), hoặc CSS scroll-snap.
- Pattern: `az-testimonials`.

### 4.10 CTA

- Eyebrow, H2 "Don't get left behind" (viết lại), mô tả, ảnh bên cạnh.
- Pattern: `az-cta` (tái sử dụng được ở nhiều trang).

### 4.11 FAQ

- Cột trái: eyebrow, H2, mô tả, nút View FAQs.
- Cột phải: 5 câu accordion lấy từ CPT `faq`.
- Dùng `<details>` chuẩn, kèm JS tối thiểu để chỉ mở một mục nếu muốn.
- Pattern: `az-faq`. Thêm schema FAQPage.

### 4.12 Footer

- Cột 1: tagline, email, điện thoại.
- 4 cột link: Company, Support, Quick Links, Resources.
- Social: Behance, Instagram, Meta, X (đổi theo kênh thật của AZ Media).
- Hàng cuối: copyright và Refund Policy, Privacy Policy, Terms.
- Part: `parts/footer.html`.

## 5. Sitemap và các trang con (đề xuất, cần xác minh)

Danh sách trang lấy từ menu demo. Nội dung từng trang dưới đây là cấu trúc đề xuất theo chuẩn trang agency, chưa đối chiếu với demo.

| Trang | Slug | Section đề xuất | Dữ liệu |
|---|---|---|---|
| Trang chủ | `/` | Mục 4 | Pattern + CPT |
| Bảng giá | `/pricing/` | Hero nhỏ, bảng gói, so sánh tính năng, FAQ, CTA | `pricing_plan`, `faq` |
| Dịch vụ | `/all-services/` | Hero nhỏ, lưới dịch vụ, quy trình làm việc, CTA | `service` |
| Chi tiết dịch vụ | `/services/{slug}/` | Mô tả, lợi ích, quy trình, form báo giá, dịch vụ liên quan | `service` |
| Giới thiệu | `/about/` | Câu chuyện, tầm nhìn/sứ mệnh, số liệu, đội ngũ, đối tác, CTA | `team_member`, `testimonial` |
| Blog | `/blog/` | Hero nhỏ, bài nổi bật, lưới bài, lọc category, phân trang | `post` |
| Bài viết | `/{slug}/` | Ảnh, tiêu đề, meta, nội dung, tác giả, bài liên quan, CTA | `post` |
| FAQs | `/faqs/` | Nhóm câu hỏi theo chủ đề, tìm nhanh, CTA liên hệ | `faq` |
| Tuyển dụng | `/career/` | Văn hóa, phúc lợi, danh sách vị trí, form ứng tuyển | `career` |
| Liên hệ | `/contact/` | Form, thông tin, giờ làm việc, bản đồ | CF7 |
| Bảo trì | `/maintenance-mode/` | Trang thông báo đơn giản | Page |
| Pháp lý | `/privacy-policy/`, `/terms/`, `/refund-policy/` | Văn bản dài, layout hẹp | Page |
| 404 và Tìm kiếm | — | Thông báo, ô tìm kiếm, gợi ý link | Template |

Mọi trang con dùng chung: header, footer, **page-hero** (tiêu đề + breadcrumb) và pattern CTA để thêm trang mới chỉ mất vài phút.

## 6. Kế hoạch scale Blog

- Template: `home` (danh sách), `single`, `archive` (category/tag/tác giả), `search`.
- Pattern bài viết: ảnh đại diện, tiêu đề, thời gian đọc, tác giả, TOC (mục lục tự động), chia sẻ, bài liên quan, CTA cuối bài.
- Taxonomy: category cho chủ đề (Social Media, SEO, Content, Case Study), tag tự do.
- SEO: breadcrumb, schema Article, canonical, Open Graph. Dùng Rank Math hoặc Yoast.
- Hiệu năng: ảnh WebP, lazy-load, kích thước ảnh khai báo sẵn trong theme.
- Quy trình viết: editor dùng block pattern "Bài viết chuẩn" để đồng bộ giao diện.

## 7. Thiết lập Local WP

### 7.1 Tạo site

1. Cài Local, tạo site mới **az-media** (môi trường tùy chỉnh: PHP 8.2 trở lên, MySQL 8, nginx).
2. Đăng nhập wp-admin, đặt permalink dạng **Post name**.
3. Bật `WP_DEBUG` và `WP_DEBUG_LOG` trong `wp-config.php` khi dev.
4. Xóa theme, plugin mặc định không dùng.

### 7.2 Quản lý code

- `git init` ở thư mục `wp-content/themes/az-media` và `wp-content/plugins/az-media-core` (hai repo hoặc một monorepo).
- Ignore: `node_modules`, `.env`, cache build.
- Nếu dùng build: `@wordpress/scripts` hoặc Vite cho SCSS/JS, output vào `assets/`.

### 7.3 WP-CLI (mở bằng Site Shell của Local)

```
wp theme activate az-media
wp plugin activate az-media-core contact-form-7
wp rewrite structure '/%postname%/' --hard
wp post generate --count=12 --post_type=post    # dữ liệu blog thử
```

Viết một script seed (WP-CLI hoặc PHP) tạo sẵn trang, menu và CPT mẫu, để dựng lại site sạch bất cứ lúc nào.

### 7.4 Sao lưu và chuyển lên host

- Local có tính năng Export hoặc dùng All-in-One WP Migration / Duplicator.
- Khi lên host: đổi URL (`wp search-replace`), bật cache, bật HTTPS, kiểm tra sitemap.

## 8. Lộ trình triển khai

| Giai đoạn | Việc chính | Kết quả |
|---|---|---|
| 0. Chuẩn bị | Thu thập ảnh chụp/HTML các trang con, chốt logo, màu, font, nội dung | Bộ tài sản thương hiệu AZ Media |
| 1. Nền móng | Local WP, repo, theme khung, theme.json (màu, font, spacing), header/footer | Khung theme chạy được |
| 2. Trang chủ | Pattern 4.1–4.12, counter, slider, accordion | Trang chủ hoàn chỉnh desktop |
| 3. CPT và dữ liệu | az-media-core, CPT, nhập nội dung mẫu | Pricing, FAQ, Testimonial lấy từ CPT |
| 4. Trang con | About, Services, Pricing, FAQs, Career, Contact, pháp lý | Toàn bộ sitemap |
| 5. Blog | Template blog, single, archive, search, 404 | Blog dùng được, thêm bài nhanh |
| 6. Responsive và A11y | Kiểm tra 4 breakpoint, bàn phím, tương phản | Đạt checklist mục 9 |
| 7. SEO và hiệu năng | Meta, schema, sitemap, tối ưu ảnh, cache | Lighthouse ≥ 90 |
| 8. Deploy | Chuyển lên host/staging, kiểm thử cuối | Site live |

## 9. Checklist nghiệm thu

- [ ] Màu chủ đạo là xanh đậm trên toàn site, không còn sắc tím.
- [ ] Không còn chữ "Reachout", "envato" hay nội dung mẫu của demo.
- [ ] Không dùng ảnh, logo, avatar của demo.
- [ ] Responsive đúng ở 1200 / 1024 / 768 / 480.
- [ ] Menu, dropdown, hamburger hoạt động bằng chuột và bàn phím.
- [ ] Counter, slider, accordion chạy, tôn trọng `prefers-reduced-motion`.
- [ ] Form gửi được, có chống spam.
- [ ] Mọi ảnh có alt, tương phản chữ đạt WCAG AA.
- [ ] Lighthouse (mobile) Performance, SEO, Accessibility ≥ 90.
- [ ] Thêm một bài blog mới chỉ bằng editor, đúng giao diện, không sửa code.
- [ ] Thêm một trang mới từ pattern CTA và page-hero chỉ mất vài phút.

## 10. Việc cần bạn cung cấp hoặc quyết định

1. Logo AZ Media (SVG nếu có) và bảng màu chính thức (nếu đã có thì thay mục 3.1).
2. Ngôn ngữ site: tiếng Việt, tiếng Anh hay song ngữ (ảnh hưởng plugin đa ngôn ngữ và slug).
3. Ảnh chụp full-page hoặc HTML các trang con của demo để hoàn thiện mục 5.
4. Chọn nền tảng: block theme (khuyến nghị) hay classic theme.
5. Danh sách dịch vụ, bảng giá, số liệu thật của AZ Media.
