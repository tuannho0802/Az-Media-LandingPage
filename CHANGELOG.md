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
- [theme] Khung block theme `az-media`: `theme.json` (palette xanh đậm, font Plus Jakarta Sans tự host kèm subset tiếng Việt), `functions.php`, `assets/css/az.css`, `assets/js/az.js`, template `front-page`, `index`, `page`, `single`, `404`.
- [global] Part `announcement-bar` (nút đóng, nhớ trạng thái bằng localStorage), `header` (sticky, dropdown Trang, hamburger dưới 1024px), `footer` (dải tagline + liên hệ, lưới 5 cột link, thanh copyright và link pháp lý).
- [home] 9 pattern trang chủ: `az-hero`, `az-logos`, `az-why-us`, `az-specialization`, `az-solutions`, `az-pricing`, `az-testimonials`, `az-cta`, `az-faq`, kèm counter và accordion `<details>`.
- [core] Plugin `az-media-core`: CPT `pricing_plan`, `testimonial`, `faq` (+ taxonomy `faq_group`), meta box, block `az-media/faq-list` (kèm schema FAQPage), lệnh `wp az seed` tạo dữ liệu mẫu và các trang rỗng.
- [docs] Plan riêng cho từng trang trong `docs/pages/` (00-global đến 13-404-search) kèm bảng kiểm tra bám sát thiết kế.
- [docs] File `CHANGELOG.md`.

### Changed
- [home] Làm lại layout theo ảnh ref `docs/reference-images/OG-Home.png`: hero (ảnh chạm đáy, card khách hàng và card rating chồng góc), Trusted by (nền tint, logo trong thẻ), Why choose us (nền đậm có lưới, ảnh kèm 3 counter, 4 card 2×2), Specialization (tầm nhìn trái, 4 thẻ sứ mệnh có icon phải), Solutions (ảnh trái, lưới 2×3 thẻ có icon mạng xã hội), Pricing (thẻ căn giữa, gói giữa nền đậm, không nâng lên), Testimonials (lưới 3×2, sao ở đáy thẻ, mobile vuốt ngang), CTA (khối đậm không ảnh), FAQ (ô câu hỏi nền nhạt, câu trả lời bên dưới).
- [global] Footer làm lại theo ref: dải tagline + email/điện thoại, lưới 5 cột link có mũi tên (thêm cột Mạng xã hội), thanh copyright nền đậm.
- [theme] Badge/eyebrow đổi sang kiểu nền nhạt viền trái đậm; nút viền đổi sang nền trắng viền xám.
- [theme] Ảnh tạm: thêm `placeholder-team.svg`, `placeholder-solutions.svg` cho các chỗ cần ảnh.

### Fixed
- [home] 4 card đánh số ở Why us bị trắng, chữ trắng trên nền trắng nên không đọc được: selector `.az-section .az-why-us .az-card` không khớp (cùng một phần tử). Đổi thành `.az-why-us .az-card`.
- [global] Header bị xuống dòng (logo "az-/media", menu hai hàng, nút gãy chữ) và nút Bảng giá/Liên hệ dành cho mobile hiện nhầm ở desktop.
- [theme] Khi plugin `az-media-core` chưa bật, Query Loop của core tự đổi post type về `post` nên Pricing/Testimonials hiện nhầm bài "Hello world". Thêm filter `query_loop_block_query_vars` để hiển thị rỗng, và admin notice nhắc bật plugin + chạy `wp az seed`.
- [core] CPT đặt `publicly_queryable` để Query Loop nhận đúng post type, không bật rewrite nên không sinh URL công khai.
- [theme] Chữ nhấn dùng token `accent-text` (`#1D4ED8`) thay vì `accent` để đạt WCAG AA (accent chỉ dùng cho nền, icon, trang trí).

### Removed
- [home] Code slider testimonials trong `az.js` và CSS tương ứng (ref dùng lưới 3×2).
- [home] Ảnh `cta-visual.svg` (CTA của ref không có ảnh).
- [home] Icon +/- của accordion FAQ (ref không có).

### Known issues
- [home] Toàn bộ số liệu, lời nhận xét, giá, logo, email, điện thoại là PLACEHOLDER, cần thay bằng dữ liệu thật trước khi public.
- [home] Layout đã làm lại theo ref nhưng chưa được xem bằng trình duyệt: các mục khoảng cách, typography, hover, responsive (đặc biệt 600–1023px) trong Design Fidelity Review của `01-home.md` còn để trống, chờ bạn xác nhận.
- [home] CTA vẫn giữ nút "Đặt lịch tư vấn" dù ref không có nút.

## [0.0.1] - 2026-11-17

### Added
- [docs] Khởi tạo repo: `.gitignore` dạng whitelist cho `wp-content`, `README.md`, `docs/plan.md`.
- [docs] Bổ sung nguồn tham chiếu thiết kế (demo Reachout) vào plan và README.
