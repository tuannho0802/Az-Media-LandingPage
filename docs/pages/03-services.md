# Plan trang: Dịch vụ (danh sách)

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `/all-services/ (đề xuất đổi thành /services/)` |
| Template WordPress | `templates/archive-service.html` |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/all-services/ |
| Độ tin cậy nguồn | ⚠️ Chưa đọc nội dung trang; URL lấy từ menu demo |
| Pattern dùng | `az-page-hero`, `az-services-grid`, `az-process`, `az-cta` |
| Dữ liệu (CPT/plugin) | CPT `service` |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☐ Chờ review · ☐ Đạt |
| Ngày truy cập demo | 17/11/2026 |

> **Cần xác minh trước khi dựng.** Chưa đọc được nội dung trang này của demo, nên mục 2 là cấu trúc đề xuất theo chuẩn trang agency. Việc đầu tiên: mở link demo ở trên, chụp full-page lưu vào `docs/references/services-demo.png`, sửa bảng mục 2 cho khớp demo, rồi đổi cột "Xác minh" từ ⚠️ sang ✅.

## 1. Mục đích

Liệt kê toàn bộ dịch vụ của AZ Media và dẫn tới trang chi tiết.

## 2. Cấu trúc section (thứ tự từ trên xuống)

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | Page hero | Tiêu đề + breadcrumb | az-page-hero | — | ⚠️ |
| 2 | Lưới dịch vụ | Card: icon, tên, mô tả ngắn, link Xem thêm; 3 cột desktop | az-services-grid | `service` | ⚠️ |
| 3 | Quy trình làm việc | 3–5 bước đánh số | az-process | Nội dung pattern | ⚠️ |
| 4 | Số liệu/Trusted by | Xác minh demo có không | az-logos / counter | — | ⚠️ |
| 5 | CTA | Mời liên hệ | az-cta | — | ⚠️ |

## 3. Nội dung AZ Media cần chuẩn bị

- Danh sách dịch vụ: tên, icon, mô tả ngắn, mô tả đầy đủ.
- Các bước quy trình làm việc.

## 4. Tương tác và hành vi

- Card hover: nâng nhẹ, đổi màu viền/icon.
- Sắp xếp theo thứ tự meta `menu_order`.

## 5. Responsive

Kiểm tra ở 1200 / 1024 / 768 / 480: không cuộn ngang, ảnh không méo, chữ không tràn, nút cao tối thiểu 44px.

- Cột đôi chuyển thành một cột ở dưới 768px, thứ tự đọc: tiêu đề, nội dung, ảnh.
- Lưới 3 → 2 → 1 cột ở 1024 / 768 / 480.

## 6. SEO và hiệu năng

- Một thẻ H1 duy nhất, thứ tự heading không nhảy cấp.
- Meta title và description riêng cho trang.
- Ảnh WebP, có `width`/`height`, `loading="lazy"` trừ ảnh đầu trang.
- Canonical và Open Graph qua plugin SEO.
- Slug dịch vụ ngắn, có từ khóa.

## 7. Kiểm tra bám sát thiết kế (Design Fidelity Review)

Mở song song: demo (https://reachout.nexmotivedemo.com/all-services/) và trang AZ Media local. Tích ☑ khi khớp, ghi chênh lệch vào cột ghi chú.

| ☐ | Hạng mục | Cách đối chiếu | Ghi chú |
|---|---|---|---|
| ☐ | Thứ tự section khớp demo | Mở demo, đếm và so từ trên xuống dưới | |
| ☐ | Bố cục cột và tỉ lệ | Đặt hai cửa sổ cạnh nhau ở 1440px, so cột trái/phải | |
| ☐ | Khoảng cách trong và giữa các khối | Đo padding/margin bằng DevTools | |
| ☐ | Typography (cỡ, độ đậm, line-height) | DevTools, tab Computed | |
| ☐ | Màu đã đổi từ tím sang xanh đậm theo token | Không còn mã màu tím nào trong CSS của trang | |
| ☐ | Component (nút, card, badge) và trạng thái hover/focus | Di chuột và Tab qua từng phần tử | |
| ☐ | Tương tác và animation | So hành vi với demo (counter, slider, accordion...) | |
| ☐ | Responsive 1200 / 1024 / 768 / 480 | Thu nhỏ trình duyệt, không cuộn ngang, nút đủ lớn | |
| ☐ | Không dùng lại ảnh, logo, tên, nội dung của demo | Rà ảnh, alt, tên người, số liệu | |
| ☐ | Cỡ icon và khoảng cách trong card | Đo trong DevTools | |
| ☐ | Số cột và gutter lưới | So ở 1440px | |

Ảnh đối chiếu: lưu `docs/references/services-demo.png` và `docs/references/services-az.png`.

## 8. Tiêu chí nghiệm thu

- [ ] Thêm một dịch vụ mới ở wp-admin tự xuất hiện trong lưới.
- [ ] Card dẫn đúng tới trang chi tiết.
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [ ] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[services]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| | | |
