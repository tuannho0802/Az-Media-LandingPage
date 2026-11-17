# Plan trang: 404 và Tìm kiếm

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `(tự động)` |
| Template WordPress | `templates/404.html, templates/search.html` |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/ (thêm đường dẫn không tồn tại để xem 404, và `/?s=test` để xem tìm kiếm) |
| Độ tin cậy nguồn | ⚠️ Chưa đọc; cần kiểm tra thủ công trên demo |
| Pattern dùng | `az-page-hero`, `az-post-card` |
| Dữ liệu (CPT/plugin) | WP_Query mặc định |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☐ Chờ review · ☐ Đạt |
| Ngày truy cập demo | 17/11/2026 |

> **Cần xác minh trước khi dựng.** Chưa đọc được nội dung trang này của demo, nên mục 2 là cấu trúc đề xuất theo chuẩn trang agency. Việc đầu tiên: mở link demo ở trên, chụp full-page lưu vào `docs/references/404-search-demo.png`, sửa bảng mục 2 cho khớp demo, rồi đổi cột "Xác minh" từ ⚠️ sang ✅.

## 1. Mục đích

Giữ người dùng ở lại khi lạc đường hoặc tìm nội dung.

## 2. Cấu trúc section (thứ tự từ trên xuống)

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | 404 | Thông điệp, ô tìm kiếm, nút về trang chủ, gợi ý link (Dịch vụ, Blog, Liên hệ) | 404.html | — | ⚠️ |
| 2 | Kết quả tìm kiếm | Tiêu đề "Kết quả cho ...", danh sách card bài viết, phân trang, trạng thái không có kết quả | search.html | Truy vấn tìm kiếm | ⚠️ |

## 3. Nội dung AZ Media cần chuẩn bị

- Câu thông báo 404 và trạng thái rỗng khi không có kết quả.

## 4. Tương tác và hành vi

- 404 trả đúng HTTP 404.
- Tìm kiếm giữ lại từ khóa trong ô nhập.

## 5. Responsive

Kiểm tra ở 1200 / 1024 / 768 / 480: không cuộn ngang, ảnh không méo, chữ không tràn, nút cao tối thiểu 44px.

- Cột đôi chuyển thành một cột ở dưới 768px, thứ tự đọc: tiêu đề, nội dung, ảnh.

## 6. SEO và hiệu năng

- 404 và trang tìm kiếm `noindex`.

## 7. Kiểm tra bám sát thiết kế (Design Fidelity Review)

Mở song song: demo (https://reachout.nexmotivedemo.com/ (thêm đường dẫn không tồn tại để xem 404, và `/?s=test` để xem tìm kiếm)) và trang AZ Media local. Tích ☑ khi khớp, ghi chênh lệch vào cột ghi chú.

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
| ☐ | Trạng thái không có kết quả | Tìm một từ khóa không tồn tại | |

Ảnh đối chiếu: lưu `docs/references/404-search-demo.png` và `docs/references/404-search-az.png`.

## 8. Tiêu chí nghiệm thu

- [ ] 404 và tìm kiếm cùng giao diện với site.
- [ ] Không có kết quả vẫn hiển thị gợi ý hữu ích.
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [ ] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[404-search]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| | | |
