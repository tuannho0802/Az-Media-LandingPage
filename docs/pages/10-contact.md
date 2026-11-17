# Plan trang: Liên hệ

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `/contact/` |
| Template WordPress | `templates/page-contact.html` |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/contact/ |
| Độ tin cậy nguồn | ⚠️ Chưa đọc nội dung trang (nhà bán nêu theme có Contact Form 7, Business Hours, Google Maps) |
| Pattern dùng | `az-page-hero`, `az-contact-info`, `az-hours`, `az-map` |
| Dữ liệu (CPT/plugin) | Contact Form 7, Site Options (email, điện thoại, địa chỉ, giờ làm việc) |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☐ Chờ review · ☐ Đạt |
| Ngày truy cập demo | 17/11/2026 |

> **Cần xác minh trước khi dựng.** Chưa đọc được nội dung trang này của demo, nên mục 2 là cấu trúc đề xuất theo chuẩn trang agency. Việc đầu tiên: mở link demo ở trên, chụp full-page lưu vào `docs/references/contact-demo.png`, sửa bảng mục 2 cho khớp demo, rồi đổi cột "Xác minh" từ ⚠️ sang ✅.

## 1. Mục đích

Trang chuyển đổi chính: nhận liên hệ từ khách hàng.

## 2. Cấu trúc section (thứ tự từ trên xuống)

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | Page hero | Tiêu đề + breadcrumb | az-page-hero | — | ⚠️ |
| 2 | Thẻ thông tin | Email, điện thoại, địa chỉ, (3 card icon) | az-contact-info | Site Options | ⚠️ |
| 3 | Form liên hệ | Họ tên, email, điện thoại, chủ đề, lời nhắn, nút Gửi | CF7 | CF7 | ⚠️ |
| 4 | Giờ làm việc | Bảng giờ theo ngày | az-hours | Site Options | ⚠️ |
| 5 | Bản đồ | Google Maps nhúng (xác minh vị trí trên demo) | az-map | Site Options | ⚠️ |

## 3. Nội dung AZ Media cần chuẩn bị

- Email, điện thoại, địa chỉ, giờ làm việc thật.
- Nội dung email xác nhận gửi cho khách.

## 4. Tương tác và hành vi

- Kiểm tra hợp lệ phía client và server, thông báo thành công/lỗi rõ.
- Chống spam (honeypot, reCAPTCHA hoặc Turnstile).
- Bản đồ tải lười (chỉ tải khi cuộn tới) để không làm chậm trang.

## 5. Responsive

Kiểm tra ở 1200 / 1024 / 768 / 480: không cuộn ngang, ảnh không méo, chữ không tràn, nút cao tối thiểu 44px.

- Cột đôi chuyển thành một cột ở dưới 768px, thứ tự đọc: tiêu đề, nội dung, ảnh.
- Bản đồ cao tối thiểu 300px ở mobile.

## 6. SEO và hiệu năng

- Một thẻ H1 duy nhất, thứ tự heading không nhảy cấp.
- Meta title và description riêng cho trang.
- Ảnh WebP, có `width`/`height`, `loading="lazy"` trừ ảnh đầu trang.
- Canonical và Open Graph qua plugin SEO.
- Schema LocalBusiness/Organization (địa chỉ, điện thoại, giờ).

## 7. Kiểm tra bám sát thiết kế (Design Fidelity Review)

Mở song song: demo (https://reachout.nexmotivedemo.com/contact/) và trang AZ Media local. Tích ☑ khi khớp, ghi chênh lệch vào cột ghi chú.

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
| ☐ | Style trường form (viền, bo góc, focus, lỗi) | Gửi form rỗng để xem trạng thái lỗi | |
| ☐ | Bố cục form + thông tin (cột/tỉ lệ) | So ở 1440px | |

Ảnh đối chiếu: lưu `docs/references/contact-demo.png` và `docs/references/contact-az.png`.

## 8. Tiêu chí nghiệm thu

- [ ] Form gửi được, email về đúng, có trang/thông báo thành công.
- [ ] Bản đồ hiển thị đúng vị trí.
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [ ] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[contact]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| | | |
