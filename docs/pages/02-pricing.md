# Plan trang: Bảng giá

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `/pricing/` |
| Template WordPress | `templates/page-pricing.html (hoặc page.html + pattern)` |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/pricing/ |
| Độ tin cậy nguồn | ⚠️ Chưa đọc nội dung trang; URL lấy từ menu demo |
| Pattern dùng | `az-page-hero`, `az-pricing`, `az-faq`, `az-cta` |
| Dữ liệu (CPT/plugin) | CPT `pricing_plan`, `faq` |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☐ Chờ review · ☐ Đạt |
| Ngày truy cập demo | 17/11/2026 |

> **Cần xác minh trước khi dựng.** Chưa đọc được nội dung trang này của demo, nên mục 2 là cấu trúc đề xuất theo chuẩn trang agency. Việc đầu tiên: mở link demo ở trên, chụp full-page lưu vào `docs/references/pricing-demo.png`, sửa bảng mục 2 cho khớp demo, rồi đổi cột "Xác minh" từ ⚠️ sang ✅.

## 1. Mục đích

Trình bày các gói dịch vụ rõ ràng để người xem chọn gói và liên hệ.

## 2. Cấu trúc section (thứ tự từ trên xuống)

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | Page hero | Tiêu đề + breadcrumb | az-page-hero | Tiêu đề trang | ⚠️ |
| 2 | Gói giá | 3 card gói; gói nổi bật nếu demo có; có thể có công tắc tháng/năm (chỉ làm nếu demo có) | az-pricing | `pricing_plan` | ⚠️ |
| 3 | So sánh tính năng | Bảng tính năng theo gói (xác minh demo có không) | az-compare (nếu có) | Meta `pricing_plan` | ⚠️ |
| 4 | FAQ về giá | 4–5 câu liên quan thanh toán, hợp đồng | az-faq | `faq` nhóm "pricing" | ⚠️ |
| 5 | CTA | Mời liên hệ / báo giá | az-cta | — | ⚠️ |

## 3. Nội dung AZ Media cần chuẩn bị

- Tên gói, giá, chu kỳ, danh sách tính năng từng gói; gói nổi bật.
- FAQ về giá và thanh toán.

## 4. Tương tác và hành vi

- Nếu có công tắc tháng/năm: đổi giá không tải lại trang, hiển thị mức tiết kiệm.
- Nút mỗi gói dẫn tới `/contact/` kèm tham số gói (điền sẵn trong form).

## 5. Responsive

Kiểm tra ở 1200 / 1024 / 768 / 480: không cuộn ngang, ảnh không méo, chữ không tràn, nút cao tối thiểu 44px.

- Cột đôi chuyển thành một cột ở dưới 768px, thứ tự đọc: tiêu đề, nội dung, ảnh.
- Bảng so sánh cuộn ngang trong khung riêng, cột tên tính năng cố định bên trái.

## 6. SEO và hiệu năng

- Một thẻ H1 duy nhất, thứ tự heading không nhảy cấp.
- Meta title và description riêng cho trang.
- Ảnh WebP, có `width`/`height`, `loading="lazy"` trừ ảnh đầu trang.
- Canonical và Open Graph qua plugin SEO.
- Schema Offer/Product cho từng gói (tùy chọn).

## 7. Kiểm tra bám sát thiết kế (Design Fidelity Review)

Mở song song: demo (https://reachout.nexmotivedemo.com/pricing/) và trang AZ Media local. Tích ☑ khi khớp, ghi chênh lệch vào cột ghi chú.

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
| ☐ | Card gói: độ cao bằng nhau, nút căn đáy | Kiểm tra khi số tính năng khác nhau | |
| ☐ | Gói nổi bật: nhãn, viền, màu | So với demo | |

Ảnh đối chiếu: lưu `docs/references/pricing-demo.png` và `docs/references/pricing-az.png`.

## 8. Tiêu chí nghiệm thu

- [ ] Giá lấy từ CPT, không hard-code.
- [ ] Hiển thị đúng khi một gói có nhiều hơn hoặc ít hơn tính năng.
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [ ] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[pricing]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| | | |
