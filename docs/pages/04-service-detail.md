# Plan trang: Chi tiết dịch vụ

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `/services/{slug}/` |
| Template WordPress | `templates/single-service.html` |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/all-services/ (mở một dịch vụ bất kỳ để lấy URL chi tiết) |
| Độ tin cậy nguồn | ⚠️ Chưa đọc; chưa biết URL chi tiết của demo |
| Pattern dùng | `az-service-hero`, `az-service-body`, `az-service-related` (mới); dùng lại `az-cta`, `az-faq` |
| Dữ liệu (CPT/plugin) | CPT `service` (nay có URL `/services/{slug}/`); form báo giá chờ trang Liên hệ |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☑ Chờ review · ☐ Đạt |
| Ngày truy cập demo | 17/11/2026 |

> **Cần xác minh trước khi dựng.** Chưa đọc được nội dung trang này của demo, nên mục 2 là cấu trúc đề xuất theo chuẩn trang agency. Việc đầu tiên: mở link demo ở trên, chụp full-page lưu vào `docs/references/service-detail-demo.png`, sửa bảng mục 2 cho khớp demo, rồi đổi cột "Xác minh" từ ⚠️ sang ✅.

## 1. Mục đích

Giải thích sâu một dịch vụ và thu lead qua form báo giá.

## 2. Cấu trúc section (thứ tự từ trên xuống)

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | Hero | Badge "Dịch vụ", tên dịch vụ (H1), tóm tắt, nút "Nhận báo giá" → `/contact/` | az-service-hero | `service` title + excerpt | ⚠️ |
| 2 | Thân bài | Ảnh đại diện (nếu có) + nội dung: giới thiệu, **Lợi ích**, **Quy trình thực hiện** | az-service-body | `service` content + ảnh đại diện | ⚠️ |
| 3 | Dịch vụ khác | 3 thẻ dịch vụ khác, bấm vào sang trang chi tiết | az-service-related | `service` (loại trừ bài đang xem) | ⚠️ |
| 4 | CTA | Khối CTA đậm | az-cta | tĩnh | ⚠️ |
| 5 | FAQ | Accordion 5 câu | az-faq | `faq` | ⚠️ |

> Quyết định dựng (chưa có ảnh ref, không xem được demo): Lợi ích và Quy trình nằm **trong nội dung bài** (editor sửa từng dịch vụ), không tạo meta field hay pattern riêng. Không có breadcrumb (bản dựng đầu của trang Bảng giá từng bị gỡ vì demo không có). **Form báo giá chưa dựng**: cần Contact Form 7 và trang Liên hệ (`10-contact`); tạm dùng nút "Nhận báo giá" và CTA dẫn tới `/contact/`. Điền sẵn dịch vụ vào form làm cùng trang Liên hệ.

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
| 17/11/2026 | Dựng lần đầu theo cấu trúc đề xuất (chưa có ảnh ref): template `single-service.html`, 3 pattern mới, CPT `service` có URL `/services/{slug}/`, nội dung mẫu seed, link từ lưới trang Dịch vụ, schema Service. Chưa xem bằng trình duyệt. | |
