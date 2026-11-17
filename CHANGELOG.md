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
- [docs] Plan riêng cho từng trang trong `docs/pages/` (00-global đến 13-404-search) kèm bảng kiểm tra bám sát thiết kế.
- [docs] File `CHANGELOG.md`.

### Changed
- (chưa có)

### Fixed
- (chưa có)

## [0.0.1] - 2026-11-17

### Added
- [docs] Khởi tạo repo: `.gitignore` dạng whitelist cho `wp-content`, `README.md`, `docs/plan.md`.
- [docs] Bổ sung nguồn tham chiếu thiết kế (demo Reachout) vào plan và README.
