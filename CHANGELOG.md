# Changelog

Mọi thay đổi đáng chú ý của dự án AZ Media được ghi tại đây.
Định dạng theo [Keep a Changelog](https://keepachangelog.com/vi/1.1.0/), đánh số phiên bản theo [Semantic Versioning](https://semver.org/lang/vi/).

## Cách ghi

- Mỗi thay đổi một dòng, bắt đầu bằng tag phạm vi trong ngoặc vuông: `[global]`, `[home]`, `[pricing]`, `[services]`, `[service-detail]`, `[about]`, `[blog]`, `[blog-single]`, `[faqs]`, `[career]`, `[contact]`, `[maintenance]`, `[legal]`, `[404-search]`, `[core]` (plugin), `[theme]` (theme chung), `[docs]`, `[ci]`.
- Nhóm theo: **Added** (thêm mới), **Changed** (thay đổi), **Fixed** (sửa lỗi), **Removed** (gỡ bỏ), **Security** (bảo mật).
- Thay đổi chưa release ghi ở mục `[Unreleased]`. Khi gắn tag, đổi thành mục phiên bản kèm ngày (`YYYY-MM-DD`).
- Số phiên bản trong `themes/az-media/style.css` phải khớp tag.
- Với trang đã review thiết kế, ghi thêm kết quả: `[home] Đạt design review`.

## [Unreleased]

### Added
- [about] Trang `/about/` dựng theo `docs/reference-images/OG-About.png`: hero, Chúng tôi là ai (ảnh ngang) kèm Tầm nhìn và Sứ mệnh, thanh 4 số liệu có counter, Giá trị cốt lõi (3 thẻ đánh số + ảnh cao), Đội ngũ (lưới 2×2). Template `page-about.html`; pattern mới `az-about-hero`, `az-about-intro`, `az-vision-mission`, `az-about-stats`, `az-about-values`, `az-about-team`. Theo ref, trang không có logo đối tác, testimonials, CTA.
- [core] CPT `team_member` (menu Đội ngũ, meta `az_role` chức danh, ảnh đại diện) và seed 4 thành viên mẫu; lưới đội ngũ tự lấy từ CPT.
- [theme] Ảnh tạm `placeholder-person.svg` cho thành viên chưa có ảnh đại diện.
- [service-detail] Trang chi tiết dịch vụ `/services/{slug}/` dựng theo cấu trúc đề xuất trong `docs/pages/04-service-detail.md` (chưa có ảnh ref): hero (badge, H1, tóm tắt, nút Nhận báo giá), thân bài (ảnh đại diện + nội dung gồm giới thiệu, lợi ích, quy trình), 3 dịch vụ khác, CTA, FAQ. Template `single-service.html`; pattern mới `az-service-hero`, `az-service-body`, `az-service-related`; dùng lại `az-cta`, `az-faq`.
- [service-detail] Schema Service (JSON-LD) trong `functions.php`.
- [core] Seed nội dung mẫu cho 6 dịch vụ (giới thiệu, lợi ích, quy trình); dịch vụ đã seed từ trước được điền khi nội dung đang trống, không ghi đè nội dung đã sửa.
- [services] Trang `/all-services/` dựng theo `docs/reference-images/OG-Services.png`: hero, khối Why choose us (thẻ trích dẫn + 3 thẻ lợi ích), 2 hàng ảnh xen kẽ, lưới 6 dịch vụ có icon, CTA, FAQ. Template `page-all-services.html`; pattern mới `az-services-hero`, `az-services-why`, `az-services-features`, `az-services-grid`.
- [core] CPT `service` (menu Dịch vụ) và seed 6 dịch vụ mẫu; lưới dịch vụ tự lấy từ CPT.
- [pricing] Trang `/pricing/` dựng theo ảnh ref `docs/reference-images/OG-Pricing.png`: hero (badge, H1, mô tả), Trusted by, 3 thẻ gói (gói giữa nền đậm), Why choose us, FAQ. Template `page-pricing.html`; pattern mới `az-pricing-hero`, `az-pricing-list`, dùng lại `az-logos`, `az-why-us`, `az-faq`.
- [core] Trang wp-admin Công cụ → AZ Media Seed: tạo dữ liệu mẫu bằng một nút bấm khi không có WP-CLI (Local WP trên Windows), kèm nhắc khi chưa có gói giá. Logic seed tách khỏi WP-CLI, `wp az seed` vẫn dùng được.
- [theme] Khung block theme `az-media`: `theme.json` (palette xanh đậm, font Plus Jakarta Sans tự host kèm subset tiếng Việt), `functions.php`, `assets/css/az.css`, `assets/js/az.js`, template `front-page`, `index`, `page`, `single`, `404`.
- [global] Part `announcement-bar` (nút đóng, nhớ trạng thái bằng localStorage), `header` (sticky, dropdown Trang, hamburger dưới 1024px), `footer` (dải tagline + liên hệ, lưới 5 cột link, thanh copyright và link pháp lý).
- [home] 9 pattern trang chủ: `az-hero`, `az-logos`, `az-why-us`, `az-specialization`, `az-solutions`, `az-pricing`, `az-testimonials`, `az-cta`, `az-faq`, kèm counter và accordion `<details>`.
- [core] Plugin `az-media-core`: CPT `pricing_plan`, `testimonial`, `faq` (+ taxonomy `faq_group`), meta box, block `az-media/faq-list` (kèm schema FAQPage), lệnh `wp az seed` tạo dữ liệu mẫu và các trang rỗng.
- [docs] Plan riêng cho từng trang trong `docs/pages/` (00-global đến 13-404-search) kèm bảng kiểm tra bám sát thiết kế.
- [docs] File `CHANGELOG.md`.

### Changed
- [global] Header làm lại theo ref: nền trắng trong suốt có blur (đặt ở `::before` để menu mobile `position: fixed` không bị ảnh hưởng), announcement bar và header cùng dính trên cùng khi cuộn (JS đo chiều cao bar vào `--az-announce-h`, xử lý cả khi đóng bar và có admin bar), menu căn trái cạnh logo thay vì căn giữa, chiều cao 70px cố định (bỏ co khi cuộn), mũi tên dropdown "Trang" sát chữ. Ảnh hưởng mọi trang.
- [docs] `[service-detail] Đạt design review`: chủ dự án xác nhận hoàn thành trang Chi tiết dịch vụ (17/11/2026). Các mục review tích theo xác nhận, chưa có số đo; xem `docs/pages/04-service-detail.md`.
- [docs] Thay `OG-About.png` bằng bản chụp không dính header sticky.
- [core] CPT `service` có rewrite `/services/{slug}/` (không có trang lưu trữ). Rewrite rules tự làm mới một lần khi cập nhật (option `az_core_rewrite_ver`), không cần Save lại Permalinks.
- [services] Tên dịch vụ trong lưới `az-services-grid` giờ là link tới trang chi tiết (xử lý known issue "thẻ chưa có link").
- [docs] `[services] Đạt design review`: chủ dự án xác nhận hoàn thành trang Dịch vụ (17/11/2026). Các mục review tích theo xác nhận, chưa có số đo; xem `docs/pages/03-services.md`.
- [docs] `[home] Đạt design review`: chủ dự án xác nhận hoàn thành trang chủ (17/11/2026). 5 mục review và Lighthouse tích theo xác nhận, chưa có số đo; xem `docs/pages/01-home.md`.
- [core] Giá, chu kỳ, mô tả gói (Gói giá) và vai trò, chữ avatar (Nhận xét) chuyển từ meta box ở đáy màn hình lên panel "Thông tin hiển thị" ở thanh bên phải trình soạn thảo. Meta box cũ chỉ còn dùng cho Classic Editor.
- [home] Làm lại layout theo ảnh ref `docs/reference-images/OG-Home.png`: hero (ảnh chạm đáy, card khách hàng và card rating chồng góc), Trusted by (nền tint, logo trong thẻ), Why choose us (nền đậm có lưới, ảnh kèm 3 counter, 4 card 2×2), Specialization (tầm nhìn trái, 4 thẻ sứ mệnh có icon phải), Solutions (ảnh trái, lưới 2×3 thẻ có icon mạng xã hội), Pricing (thẻ căn giữa, gói giữa nền đậm, không nâng lên), Testimonials (lưới 3×2, sao ở đáy thẻ, mobile vuốt ngang), CTA (khối đậm không ảnh), FAQ (ô câu hỏi nền nhạt, câu trả lời bên dưới).
- [global] Footer làm lại theo ref: dải tagline + email/điện thoại, lưới 5 cột link có mũi tên (thêm cột Mạng xã hội), thanh copyright nền đậm.
- [theme] Badge/eyebrow đổi sang kiểu nền nhạt viền trái đậm; nút viền đổi sang nền trắng viền xám.
- [theme] Ảnh tạm: thêm `placeholder-team.svg`, `placeholder-solutions.svg` cho các chỗ cần ảnh.

### Fixed
- [pricing] Local chỉ hiện khối CTA: WordPress cache danh sách pattern theo version theme, nên pattern mới thêm bằng `git pull` không được đăng ký. `functions.php` tự xóa cache khi danh sách hoặc thời gian sửa file trong `patterns/` đổi. Đã tái hiện và kiểm trên WordPress thật.
- [core] Ô nhiều dòng (mô tả gói) bị `sanitize_text_field` gộp thành một dòng khi lưu. Dùng `sanitize_textarea_field` cho ô loại textarea, cả ở REST lẫn meta box Classic Editor.
- [global] Dưới 1024px, 2 nút Bảng giá/Liên hệ ở header không ẩn (`.is-layout-flex` của core đè `display: none`), làm mọi trang tràn ngang trên mobile. Tăng độ ưu tiên selector. Phát hiện khi kiểm trang Bảng giá trên WordPress thật; ảnh hưởng cả trang chủ.
- [home] 4 card đánh số ở Why us bị trắng, chữ trắng trên nền trắng nên không đọc được: selector `.az-section .az-why-us .az-card` không khớp (cùng một phần tử). Đổi thành `.az-why-us .az-card`.
- [global] Header bị xuống dòng (logo "az-/media", menu hai hàng, nút gãy chữ) và nút Bảng giá/Liên hệ dành cho mobile hiện nhầm ở desktop.
- [theme] Khi plugin `az-media-core` chưa bật, Query Loop của core tự đổi post type về `post` nên Pricing/Testimonials hiện nhầm bài "Hello world". Thêm filter `query_loop_block_query_vars` để hiển thị rỗng, và admin notice nhắc bật plugin + chạy `wp az seed`.
- [core] CPT đặt `publicly_queryable` để Query Loop nhận đúng post type, không bật rewrite nên không sinh URL công khai.
- [theme] Chữ nhấn dùng token `accent-text` (`#1D4ED8`) thay vì `accent` để đạt WCAG AA (accent chỉ dùng cho nền, icon, trang trí).

### Removed
- [pricing] Phần bản dựng đầu tự thêm khi chưa có ảnh ref mà demo không có: breadcrumb, danh sách tính năng trong thẻ gói, bảng so sánh, FAQ về giá, CTA cuối. Gỡ pattern `az-page-hero`, `az-pricing-plans`, `az-compare`, `az-faq-pricing`, block `az-media/breadcrumb`, `az-media/plan-cards`, `az-media/plan-compare`, meta `az_features` và phần seed tương ứng.
- [home] Code slider testimonials trong `az.js` và CSS tương ứng (ref dùng lưới 3×2).
- [home] Ảnh `cta-visual.svg` (CTA của ref không có ảnh).
- [home] Icon +/- của accordion FAQ (ref không có).

### Known issues
- [global] Header mới (nền mờ, bar dính) chưa xem bằng trình duyệt/WordPress thật: cần kiểm blur khi cuộn qua ảnh/khối đậm, menu mobile mở hết màn hình, bar 2 dòng trên mobile, và khi đăng nhập có admin bar.
- [about] Chưa xem bằng trình duyệt/WordPress thật (khoảng cách, typography, responsive 1200/1024/768/480). Ref dùng slider đội ngũ có chấm phân trang, bản dựng là lưới 2×2 tĩnh. Số liệu, tên thành viên, mô tả, ảnh là PLACEHOLDER.
- [service-detail] Bố cục theo plan đề xuất (không có ảnh ref). Chưa có form báo giá (chờ Contact Form 7 và trang Liên hệ). Nội dung dịch vụ là PLACEHOLDER.
- [services] Icon gán theo vị trí thẻ (6 icon xoay vòng), không theo từng dịch vụ; ảnh hai hàng xen kẽ là ảnh tạm; thẻ chưa có link tới trang chi tiết. Nội dung là PLACEHOLDER.
- [pricing] Mục 7 trong `02-pricing.md` còn vài hạng mục chờ so bằng mắt trên Local WP (khoảng cách, typography, responsive 1200/1024/768/480). Giá, mô tả, logo là PLACEHOLDER.
- [home] Toàn bộ số liệu, lời nhận xét, giá, logo, email, điện thoại là PLACEHOLDER, cần thay bằng dữ liệu thật trước khi public.
- [home] Layout đã làm lại theo ref nhưng chưa được xem bằng trình duyệt: các mục khoảng cách, typography, hover, responsive (đặc biệt 600–1023px) trong Design Fidelity Review của `01-home.md` còn để trống, chờ bạn xác nhận.
- [home] CTA vẫn giữ nút "Đặt lịch tư vấn" dù ref không có nút.

## [0.0.1] - 2026-11-17

### Added
- [docs] Khởi tạo repo: `.gitignore` dạng whitelist cho `wp-content`, `README.md`, `docs/plan.md`.
- [docs] Bổ sung nguồn tham chiếu thiết kế (demo Reachout) vào plan và README.
