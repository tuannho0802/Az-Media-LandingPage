# Plan trang: Blog (danh sách bài viết)

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `/blog/` |
| Template WordPress | `templates/home.html (+ archive.html cho category/tag)` |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/blog/ |
| Độ tin cậy nguồn | ⚠️ Chưa đọc nội dung trang |
| Pattern dùng | `az-page-hero`, `az-post-card`, `az-cta` |
| Dữ liệu (CPT/plugin) | `post`, taxonomy category/tag |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☐ Chờ review · ☐ Đạt |
| Ngày truy cập demo | 17/11/2026 |

> **Cần xác minh trước khi dựng.** Chưa đọc được nội dung trang này của demo, nên mục 2 là cấu trúc đề xuất theo chuẩn trang agency. Việc đầu tiên: mở link demo ở trên, chụp full-page lưu vào `docs/references/blog-demo.png`, sửa bảng mục 2 cho khớp demo, rồi đổi cột "Xác minh" từ ⚠️ sang ✅.

## 1. Mục đích

Trang tin/nội dung SEO. Phải dễ mở rộng: thêm bài chỉ cần viết trong editor.

## 2. Cấu trúc section (thứ tự từ trên xuống)

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | Page hero | Tiêu đề + breadcrumb | az-page-hero | — | ⚠️ |
| 2 | Bài nổi bật | 1 bài mới nhất/được ghim, ảnh lớn (xác minh demo có không) | az-post-featured | `post` sticky | ⚠️ |
| 3 | Bộ lọc category | Tab/chip lọc theo chủ đề | Link taxonomy | category | ⚠️ |
| 4 | Lưới bài viết | Card: ảnh, category, tiêu đề, trích đoạn, ngày, tác giả; 3 cột | az-post-card | `post` (query loop) | ⚠️ |
| 5 | Phân trang | Số trang hoặc nút Tải thêm | Pagination block | — | ⚠️ |
| 6 | CTA/Newsletter | Mời liên hệ hoặc đăng ký nhận tin | az-cta | — | ⚠️ |

## 3. Nội dung AZ Media cần chuẩn bị

- Ít nhất 6–9 bài mẫu để kiểm tra lưới và phân trang.
- Danh sách category (Social Media, SEO, Content, Case Study).

## 4. Tương tác và hành vi

- Lọc category theo URL (`/category/<slug>/`), không dùng JS bắt buộc.
- Card hover nhẹ, toàn bộ card bấm được.

## 5. Responsive

Kiểm tra ở 1200 / 1024 / 768 / 480: không cuộn ngang, ảnh không méo, chữ không tràn, nút cao tối thiểu 44px.

- Cột đôi chuyển thành một cột ở dưới 768px, thứ tự đọc: tiêu đề, nội dung, ảnh.
- Lưới 3 → 2 → 1 cột.

## 6. SEO và hiệu năng

- Một thẻ H1 duy nhất, thứ tự heading không nhảy cấp.
- Meta title và description riêng cho trang.
- Ảnh WebP, có `width`/`height`, `loading="lazy"` trừ ảnh đầu trang.
- Canonical và Open Graph qua plugin SEO.
- Trang phân trang có `rel=prev/next` hoặc canonical đúng.
- Archive category có tiêu đề/mô tả riêng.

## 7. Kiểm tra bám sát thiết kế (Design Fidelity Review)

Mở song song: demo (https://reachout.nexmotivedemo.com/blog/) và trang AZ Media local. Tích ☑ khi khớp, ghi chênh lệch vào cột ghi chú.

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
| ☐ | Card bài viết: tỉ lệ ảnh, số dòng trích đoạn, vị trí meta | Kiểm tra với tiêu đề dài ngắn khác nhau | |

Ảnh đối chiếu: lưu `docs/references/blog-demo.png` và `docs/references/blog-az.png`.

## 8. Tiêu chí nghiệm thu

- [ ] Thêm bài mới tự lên đầu danh sách, đúng giao diện.
- [ ] Phân trang và lọc category hoạt động.
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [ ] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[blog]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| | | |
