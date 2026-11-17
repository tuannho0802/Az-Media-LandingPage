# Plan trang: FAQs

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `/faqs/` |
| Template WordPress | `templates/page-faqs.html` |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/faqs/ |
| Độ tin cậy nguồn | ⚠️ Chưa đọc nội dung trang |
| Pattern dùng | `az-page-hero`, `az-faq`, `az-cta` |
| Dữ liệu (CPT/plugin) | CPT `faq`, taxonomy `faq_group` |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☐ Chờ review · ☐ Đạt |
| Ngày truy cập demo | 17/11/2026 |

> **Cần xác minh trước khi dựng.** Chưa đọc được nội dung trang này của demo, nên mục 2 là cấu trúc đề xuất theo chuẩn trang agency. Việc đầu tiên: mở link demo ở trên, chụp full-page lưu vào `docs/references/faqs-demo.png`, sửa bảng mục 2 cho khớp demo, rồi đổi cột "Xác minh" từ ⚠️ sang ✅.

## 1. Mục đích

Giải đáp thắc mắc thường gặp, giảm số câu hỏi lặp lại.

## 2. Cấu trúc section (thứ tự từ trên xuống)

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | Page hero | Tiêu đề + breadcrumb | az-page-hero | — | ⚠️ |
| 2 | Nhóm FAQ | Tab hoặc nhóm tiêu đề theo chủ đề (Dịch vụ, Thanh toán, Kỹ thuật...); accordion đánh số | az-faq (tabs) | `faq` + `faq_group` | ⚠️ |
| 3 | CTA hỗ trợ | "Vẫn cần hỗ trợ?" + nút liên hệ | az-cta | — | ⚠️ |

## 3. Nội dung AZ Media cần chuẩn bị

- 10–20 câu hỏi chia nhóm, trả lời ngắn gọn.

## 4. Tương tác và hành vi

- Accordion mở/đóng, hỗ trợ bàn phím.
- Chuyển tab không tải lại trang (hoặc dùng anchor).

## 5. Responsive

Kiểm tra ở 1200 / 1024 / 768 / 480: không cuộn ngang, ảnh không méo, chữ không tràn, nút cao tối thiểu 44px.

- Cột đôi chuyển thành một cột ở dưới 768px, thứ tự đọc: tiêu đề, nội dung, ảnh.
- Tab chuyển thành danh sách cuộn ngang hoặc dropdown ở mobile.

## 6. SEO và hiệu năng

- Một thẻ H1 duy nhất, thứ tự heading không nhảy cấp.
- Meta title và description riêng cho trang.
- Ảnh WebP, có `width`/`height`, `loading="lazy"` trừ ảnh đầu trang.
- Canonical và Open Graph qua plugin SEO.
- Schema FAQPage.

## 7. Kiểm tra bám sát thiết kế (Design Fidelity Review)

Mở song song: demo (https://reachout.nexmotivedemo.com/faqs/) và trang AZ Media local. Tích ☑ khi khớp, ghi chênh lệch vào cột ghi chú.

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
| ☐ | Kiểu accordion (số thứ tự, icon +/−, viền) | So với demo | |

Ảnh đối chiếu: lưu `docs/references/faqs-demo.png` và `docs/references/faqs-az.png`.

## 8. Tiêu chí nghiệm thu

- [ ] Thêm câu hỏi ở wp-admin tự xuất hiện đúng nhóm.
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [ ] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[faqs]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| | | |
