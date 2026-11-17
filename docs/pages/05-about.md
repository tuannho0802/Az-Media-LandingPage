# Plan trang: Giới thiệu

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `/about/` |
| Template WordPress | `templates/page-about.html` |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/about/ |
| Độ tin cậy nguồn | ⚠️ Chưa đọc nội dung trang |
| Pattern dùng | `az-page-hero`, `az-specialization`, `az-why-us` (counter), `az-team`, `az-logos`, `az-testimonials`, `az-cta` |
| Dữ liệu (CPT/plugin) | CPT `team_member`, `testimonial` |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☐ Chờ review · ☐ Đạt |
| Ngày truy cập demo | 17/11/2026 |

> **Cần xác minh trước khi dựng.** Chưa đọc được nội dung trang này của demo, nên mục 2 là cấu trúc đề xuất theo chuẩn trang agency. Việc đầu tiên: mở link demo ở trên, chụp full-page lưu vào `docs/references/about-demo.png`, sửa bảng mục 2 cho khớp demo, rồi đổi cột "Xác minh" từ ⚠️ sang ✅.

## 1. Mục đích

Kể câu chuyện AZ Media, tạo niềm tin bằng đội ngũ và số liệu.

## 2. Cấu trúc section (thứ tự từ trên xuống)

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | Page hero | Tiêu đề + breadcrumb | az-page-hero | — | ⚠️ |
| 2 | Câu chuyện | Ảnh + đoạn văn giới thiệu | Content block | — | ⚠️ |
| 3 | Vision và Mission | Tái sử dụng khối từ trang chủ | az-specialization | — | ⚠️ |
| 4 | Số liệu | 3–4 counter | az-why-us (counter) | — | ⚠️ |
| 5 | Đội ngũ | Lưới thành viên: ảnh, tên, chức danh, social | az-team | `team_member` | ⚠️ |
| 6 | Đối tác/Khách hàng | Hàng logo | az-logos | — | ⚠️ |
| 7 | Testimonials + CTA | Tái sử dụng từ trang chủ | az-testimonials, az-cta | `testimonial` | ⚠️ |

## 3. Nội dung AZ Media cần chuẩn bị

- Câu chuyện thương hiệu, ảnh văn phòng/đội ngũ thật.
- Danh sách thành viên: tên, chức danh, ảnh, link social.

## 4. Tương tác và hành vi

- Ảnh thành viên hover hiện social (nếu demo có).
- Counter như trang chủ.

## 5. Responsive

Kiểm tra ở 1200 / 1024 / 768 / 480: không cuộn ngang, ảnh không méo, chữ không tràn, nút cao tối thiểu 44px.

- Cột đôi chuyển thành một cột ở dưới 768px, thứ tự đọc: tiêu đề, nội dung, ảnh.
- Lưới đội ngũ 4 → 2 → 1 cột.

## 6. SEO và hiệu năng

- Một thẻ H1 duy nhất, thứ tự heading không nhảy cấp.
- Meta title và description riêng cho trang.
- Ảnh WebP, có `width`/`height`, `loading="lazy"` trừ ảnh đầu trang.
- Canonical và Open Graph qua plugin SEO.
- Schema Organization và Person (tùy chọn).

## 7. Kiểm tra bám sát thiết kế (Design Fidelity Review)

Mở song song: demo (https://reachout.nexmotivedemo.com/about/) và trang AZ Media local. Tích ☑ khi khớp, ghi chênh lệch vào cột ghi chú.

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
| ☐ | Tỉ lệ ảnh thành viên và bo góc | So với demo | |

Ảnh đối chiếu: lưu `docs/references/about-demo.png` và `docs/references/about-az.png`.

## 8. Tiêu chí nghiệm thu

- [ ] Thêm thành viên ở wp-admin tự xuất hiện.
- [ ] Các khối tái sử dụng giống trang chủ.
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [ ] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[about]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| | | |
