# Plan trang: Dịch vụ (danh sách)

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `/all-services/` (giữ theo demo và theo menu hiện có) |
| Template WordPress | `templates/page-all-services.html` (WordPress tự chọn theo slug `all-services`) |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/all-services/ |
| Ảnh ref | `docs/reference-images/OG-Services.png` |
| Độ tin cậy nguồn | ✅ Dựng theo ảnh ref do chủ dự án cung cấp |
| Pattern dùng | `az-services-hero`, `az-services-why`, `az-services-features`, `az-services-grid` (4 pattern mới), `az-cta`, `az-faq` (dùng lại) |
| Dữ liệu (CPT/plugin) | CPT `service` (mới, menu **Dịch vụ**), `faq` |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☑ Chờ review · ☐ Đạt (chờ chủ dự án so trên Local WP) |
| Ngày cập nhật | 17/11/2026 |

## 1. Mục đích

Giới thiệu toàn bộ dịch vụ của AZ Media và lý do chọn AZ Media.

## 2. Cấu trúc section (thứ tự từ trên xuống, khớp ref)

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | Hero trang | Badge "Tất cả dịch vụ", H1, mô tả, căn giữa, nền tint có lưới | az-services-hero | Văn bản trong pattern | ✅ |
| 2 | Why choose us | Khối đậm bo góc có lưới. Trái: badge, H2, mô tả, nút Xem FAQs, thẻ trích dẫn. Phải: 3 thẻ lợi ích xếp dọc | az-services-why | Văn bản trong pattern | ✅ |
| 3 | Hai hàng xen kẽ | Ảnh trái + chữ phải ("Cam kết chất lượng"), chữ trái + ảnh phải ("Tương tác sâu"); mỗi hàng có 2 ý có dấu tích | az-services-features | Văn bản trong pattern, ảnh tạm | ✅ |
| 4 | Lưới dịch vụ | Badge, H2 giữa trang, mô tả; 6 thẻ 3×2 có icon, tên, mô tả. Thẻ không có link | az-services-grid | `service` | ✅ |
| 5 | CTA | Khối đậm "Đừng để thương hiệu bị bỏ lại phía sau" (dùng lại trang chủ) | az-cta | Nội dung pattern | ✅ |
| 6 | FAQ | Dùng lại trang chủ | az-faq | `faq` | ✅ |

## 3. Nội dung AZ Media cần chuẩn bị

- Dịch vụ: menu **Dịch vụ** → mỗi mục gồm tiêu đề, **Trích dẫn (Excerpt)** là mô tả ngắn hiện trên thẻ, thứ tự theo ô Thứ tự (Order). Lưới lấy 6 mục đầu.
- Icon gán theo vị trí thẻ (6 icon xoay vòng), chưa gán theo từng dịch vụ.
- Văn bản hero, khối Why choose us, hai hàng xen kẽ nằm trong pattern (sửa ở Site Editor → template `page-all-services`). Ảnh hai hàng là ảnh tạm, thay bằng ảnh thật.
- Toàn bộ nội dung là **placeholder**.

## 4. Tương tác và hành vi

- Thẻ dịch vụ hover: nâng nhẹ, viền và icon đổi sang màu nhấn.
- Chưa có link từ thẻ sang trang chi tiết (ref không có link). Làm cùng trang `04-service-detail` nếu demo có.

## 5. Responsive

Kiểm tra ở 1200 / 1024 / 768 / 480: không cuộn ngang, ảnh không méo, chữ không tràn, nút cao tối thiểu 44px.

- Khối Why choose us và hai hàng xen kẽ chuyển một cột dưới 900px.
- Lưới dịch vụ: 3 cột, 2 cột dưới 900px, 1 cột dưới 600px.

## 6. SEO và hiệu năng

- Một H1 duy nhất (hero). Hai tiêu đề hàng xen kẽ dùng H2, thẻ dịch vụ dùng H3.
- Meta title/description, canonical, Open Graph: đặt bằng plugin SEO khi cài.
- Ảnh tạm là SVG; ảnh thật nên là WebP có `width`/`height`, `loading="lazy"`.

## 7. Kiểm tra bám sát thiết kế (Design Fidelity Review)

| ☐ | Hạng mục | Cách đối chiếu | Ghi chú |
|---|---|---|---|
| ☑ | Thứ tự section khớp demo | So với `OG-Services.png` | Hero, Why, 2 hàng, lưới, CTA, FAQ |
| ☐ | Bố cục cột và tỉ lệ | Hai cửa sổ cạnh nhau ở 1440px | |
| ☐ | Khoảng cách trong và giữa các khối | DevTools | |
| ☐ | Typography | DevTools, tab Computed | |
| ☑ | Màu đã đổi từ tím sang xanh đậm theo token | Không còn mã tím | Chỉ dùng token |
| ☐ | Component (nút, card, badge) và hover/focus | Di chuột và Tab | |
| ☐ | Responsive 1200 / 1024 / 768 / 480 | Thu nhỏ trình duyệt | Đã đo 1440/1024/768/390 trên WordPress thật: không cuộn ngang, không lỗi JS. Chưa đo 1200/480 |
| ☑ | Không dùng lại ảnh, logo, tên, nội dung của demo | Rà ảnh, alt, số liệu | Chữ tự viết, ảnh tạm SVG |
| ☐ | Cỡ icon và khoảng cách trong thẻ | DevTools | Icon tự vẽ (nét đơn giản), không phải icon của ref |
| ☐ | Số cột và gutter lưới | So ở 1440px | |

## 8. Tiêu chí nghiệm thu

- [x] Thêm một dịch vụ mới ở wp-admin tự xuất hiện trong lưới (tối đa 6 thẻ).
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [x] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[services]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| 17/11/2026 | Dựng trang theo `OG-Services.png`: CPT `service`, 4 pattern mới, template `page-all-services.html`, seed 6 dịch vụ | |

### Ghi chú triển khai

- Sau khi áp patch: vào wp-admin → Công cụ → AZ Media Seed → **Tạo dữ liệu mẫu** một lần để tạo 6 dịch vụ. Chưa bấm thì lưới trống. Trang `/all-services/` đã có từ lần seed trước.
- Ảnh ref bị lỗi chụp: thanh header lặp giữa trang. Đã bỏ qua, chỉ dùng một header.
- Ref không có link ở thẻ dịch vụ nên chưa bật `has_archive`/URL công khai cho CPT; sẽ chỉnh khi làm trang chi tiết.
