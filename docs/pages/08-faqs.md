# Plan trang: FAQs

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `/faqs/` |
| Template WordPress | `templates/page-faqs.html` |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/faqs/ |
| Ảnh ref | `docs/reference-images/OG-FAQ.png` |
| Độ tin cậy nguồn | ✅ Cấu trúc đọc từ ảnh ref · ⚠️ màu, font, kích thước là đề xuất |
| Pattern dùng | `az-faqs-hero`, `az-faqs-list` (block `az-media/faq-list`, 2 cột), `az-blog-recent` |
| Dữ liệu (CPT/plugin) | CPT `faq`, taxonomy `faq_group` |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☑ Chờ review · ☐ Đạt |
| Ngày truy cập demo | 17/11/2026 |

> Cấu trúc ở mục 2 đọc từ ảnh ref `OG-FAQ.png` (chưa mở trang demo trực tiếp). Ref không có khối CTA trước footer nên trang không dùng `az-cta`.

## 1. Mục đích

Giải đáp thắc mắc thường gặp, giảm số câu hỏi lặp lại.

## 2. Cấu trúc section (thứ tự từ trên xuống)

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | Page hero | Badge "FAQs", H1 hai dòng căn giữa, mô tả 3 dòng; nền tint có lưới | az-faqs-hero | — | ✅ |
| 2 | Lưới FAQ | Accordion 2 cột, ô câu hỏi nền nhạt có viền, số thứ tự "01." trước câu hỏi, câu đầu mỗi cột mở sẵn và câu trả lời hiện dưới ô | az-faqs-list | `faq` (tối đa 10) | ✅ |
| 3 | Bài viết mới nhất | Badge "Blog", H2, thẻ bài viết: ảnh lớn, tiêu đề, trích đoạn ngắn, nút "Đọc thêm" | az-blog-recent | `post` (2 bài mới nhất) | ✅ |

## 3. Nội dung AZ Media cần chuẩn bị

- 10 câu hỏi (seed đã có 10 câu mẫu, cần thay bằng nội dung thật), trả lời ngắn gọn.
- Ít nhất 1 bài viết có ảnh đại diện để mục "Bài viết mới nhất" có nội dung.

## 4. Tương tác và hành vi

- Accordion mở/đóng, hỗ trợ bàn phím.
- Ref không có tab, mỗi câu hỏi là một ô accordion độc lập (mở nhiều ô cùng lúc được).

## 5. Responsive

Kiểm tra ở 1200 / 1024 / 768 / 480: không cuộn ngang, ảnh không méo, chữ không tràn, nút cao tối thiểu 44px.

- Cột đôi chuyển thành một cột ở dưới 768px, thứ tự đọc: tiêu đề, nội dung, ảnh.
- Dưới 768px lưới FAQ 2 cột thành 1 cột; thẻ bài viết cũng 1 cột.

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

Ảnh đối chiếu: `docs/reference-images/OG-FAQ.png` (demo); lưu bản chụp AZ Media vào `docs/reference-images/` khi review.

## 8. Tiêu chí nghiệm thu

- [ ] Thêm câu hỏi ở wp-admin tự xuất hiện đúng nhóm.
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [ ] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[faqs]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| 17/11/2026 | Dựng trang theo ảnh ref: template `page-faqs`, 3 pattern, block FAQ hỗ trợ 2 cột, seed 10 FAQ. Chưa kiểm trên WordPress thật | |
