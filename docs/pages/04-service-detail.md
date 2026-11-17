# Plan trang: Chi tiết dịch vụ

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `/services/{slug}/` |
| Template WordPress | `templates/single-service.html` |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/all-services/ (mở một dịch vụ bất kỳ để lấy URL chi tiết) |
| Độ tin cậy nguồn | ⚠️ Chưa đọc; chưa biết URL chi tiết của demo |
| Pattern dùng | `az-page-hero`, `az-benefits`, `az-process`, `az-faq`, `az-cta` |
| Dữ liệu (CPT/plugin) | CPT `service`, Contact Form 7 (form báo giá) |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☐ Chờ review · ☐ Đạt |
| Ngày truy cập demo | 17/11/2026 |

> **Cần xác minh trước khi dựng.** Chưa đọc được nội dung trang này của demo, nên mục 2 là cấu trúc đề xuất theo chuẩn trang agency. Việc đầu tiên: mở link demo ở trên, chụp full-page lưu vào `docs/references/service-detail-demo.png`, sửa bảng mục 2 cho khớp demo, rồi đổi cột "Xác minh" từ ⚠️ sang ✅.

## 1. Mục đích

Giải thích sâu một dịch vụ và thu lead qua form báo giá.

## 2. Cấu trúc section (thứ tự từ trên xuống)

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | Page hero | Tên dịch vụ + breadcrumb | az-page-hero | `service` title | ⚠️ |
| 2 | Tổng quan | Ảnh + mô tả dịch vụ | Content block | `service` content | ⚠️ |
| 3 | Lợi ích | Lưới icon box (3–6 mục) | az-benefits | Meta `service` | ⚠️ |
| 4 | Quy trình | Các bước thực hiện | az-process | Meta/pattern | ⚠️ |
| 5 | Form báo giá | Form CF7: tên, email, điện thoại, nhu cầu | CF7 shortcode | CF7 | ⚠️ |
| 6 | Dịch vụ liên quan | 2–3 card dịch vụ khác | Query loop | `service` | ⚠️ |
| 7 | FAQ + CTA | FAQ của dịch vụ, CTA cuối | az-faq, az-cta | `faq` | ⚠️ |

## 3. Nội dung AZ Media cần chuẩn bị

- Mô tả, lợi ích, quy trình cho từng dịch vụ.
- Nội dung email nhận lead.

## 4. Tương tác và hành vi

- Form: kiểm tra hợp lệ, thông báo thành công/lỗi, chống spam (honeypot hoặc reCAPTCHA).
- Điền sẵn dịch vụ đang xem vào form.

## 5. Responsive

Kiểm tra ở 1200 / 1024 / 768 / 480: không cuộn ngang, ảnh không méo, chữ không tràn, nút cao tối thiểu 44px.

- Cột đôi chuyển thành một cột ở dưới 768px, thứ tự đọc: tiêu đề, nội dung, ảnh.

## 6. SEO và hiệu năng

- Một thẻ H1 duy nhất, thứ tự heading không nhảy cấp.
- Meta title và description riêng cho trang.
- Ảnh WebP, có `width`/`height`, `loading="lazy"` trừ ảnh đầu trang.
- Canonical và Open Graph qua plugin SEO.
- Schema Service.

## 7. Kiểm tra bám sát thiết kế (Design Fidelity Review)

Mở song song: demo (https://reachout.nexmotivedemo.com/all-services/ (mở một dịch vụ bất kỳ để lấy URL chi tiết)) và trang AZ Media local. Tích ☑ khi khớp, ghi chênh lệch vào cột ghi chú.

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
| ☐ | Bố cục cột nội dung/form | So với demo | |

Ảnh đối chiếu: lưu `docs/references/service-detail-demo.png` và `docs/references/service-detail-az.png`.

## 8. Tiêu chí nghiệm thu

- [ ] Tạo dịch vụ mới là có sẵn trang chi tiết đúng template.
- [ ] Form gửi được, email về đúng hộp thư.
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [ ] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[service-detail]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| | | |
