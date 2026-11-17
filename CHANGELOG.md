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
- [global] Part `announcement-bar` (nút đóng, nhớ trạng thái bằng localStorage), `header` (sticky, dropdown Trang, hamburger dưới 1024px), `footer` (giới thiệu, 4 cột link, social, copyright, link pháp lý).
- [home] 9 pattern trang chủ: `az-hero`, `az-logos`, `az-why-us`, `az-specialization`, `az-solutions`, `az-pricing`, `az-testimonials`, `az-cta`, `az-faq`, kèm counter, slider scroll-snap, accordion `<details>`.
- [core] Plugin `az-media-core`: CPT `pricing_plan`, `testimonial`, `faq` (+ taxonomy `faq_group`), meta box, block `az-media/faq-list` (kèm schema FAQPage), lệnh `wp az seed` tạo dữ liệu mẫu và các trang rỗng.
- [docs] Plan riêng cho từng trang trong `docs/pages/` (00-global đến 13-404-search) kèm bảng kiểm tra bám sát thiết kế.
- [docs] File `CHANGELOG.md`.

### Changed
- (chưa có)

### Fixed
- [core] CPT đặt `publicly_queryable` để Query Loop nhận đúng post type, không bật rewrite nên không sinh URL công khai.
- [theme] Chữ nhấn dùng token `accent-text` (`#1D4ED8`) thay vì `accent` để đạt WCAG AA (accent chỉ dùng cho nền, icon, trang trí).

### Known issues
- [home] Toàn bộ số liệu, lời nhận xét, giá, logo, email, điện thoại là PLACEHOLDER, cần thay bằng dữ liệu thật trước khi public.
- [home] Chưa có ảnh đối chiếu trong `docs/references/`, mục Design Fidelity Review của `01-home.md` chưa được tích.

## [0.0.1] - 2026-11-17

### Added
- [docs] Khởi tạo repo: `.gitignore` dạng whitelist cho `wp-content`, `README.md`, `docs/plan.md`.
- [docs] Bổ sung nguồn tham chiếu thiết kế (demo Reachout) vào plan và README.
