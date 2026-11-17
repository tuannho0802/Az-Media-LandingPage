# Plan trang: Bài viết (chi tiết)

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `/{slug}/` |
| Template WordPress | `templates/single.html` |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/blog/ (mở một bài bất kỳ để lấy URL chi tiết) |
| Độ tin cậy nguồn | ⚠️ Chưa đọc; chưa biết URL bài viết của demo |
| Pattern dùng | `az-post-header`, `az-toc`, `az-author-box`, `az-related-posts`, `az-cta` |
| Dữ liệu (CPT/plugin) | `post`, tác giả, category/tag |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☐ Chờ review · ☐ Đạt |
| Ngày truy cập demo | 17/11/2026 |

> **Cần xác minh trước khi dựng.** Chưa đọc được nội dung trang này của demo, nên mục 2 là cấu trúc đề xuất theo chuẩn trang agency. Việc đầu tiên: mở link demo ở trên, chụp full-page lưu vào `docs/references/blog-single-demo.png`, sửa bảng mục 2 cho khớp demo, rồi đổi cột "Xác minh" từ ⚠️ sang ✅.

## 1. Mục đích

Hiển thị bài viết dễ đọc, tốt cho SEO và dẫn người đọc tới liên hệ.

## 2. Cấu trúc section (thứ tự từ trên xuống)

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | Page hero / Header bài | Category, tiêu đề, ngày, thời gian đọc, tác giả | az-post-header | `post` meta | ⚠️ |
| 2 | Ảnh đại diện | Ảnh lớn bo góc | Featured image | `post` | ⚠️ |
| 3 | Nội dung | Cột đọc hẹp (~720px), heading, trích dẫn, ảnh, bảng, code | Post content | `post` | ⚠️ |
| 4 | Mục lục (TOC) | Tự sinh từ H2/H3, cố định bên cạnh ở desktop (nếu làm) | az-toc | Block/JS | ⚠️ |
| 5 | Chia sẻ + Tag | Nút chia sẻ, danh sách tag | Share, Post terms | — | ⚠️ |
| 6 | Hộp tác giả | Ảnh, tên, mô tả ngắn | az-author-box | User profile | ⚠️ |
| 7 | Bài liên quan | 3 card cùng category | az-related-posts | Query loop | ⚠️ |
| 8 | CTA | Mời liên hệ | az-cta | — | ⚠️ |

## 3. Nội dung AZ Media cần chuẩn bị

- Bài mẫu dài có đủ heading, ảnh, trích dẫn, danh sách để thử typography.
- Hồ sơ tác giả.

## 4. Tương tác và hành vi

- Thời gian đọc tính tự động.
- TOC làm nổi mục đang đọc (tùy chọn).
- Bình luận: quyết định có bật không (mặc định tắt).

## 5. Responsive

Kiểm tra ở 1200 / 1024 / 768 / 480: không cuộn ngang, ảnh không méo, chữ không tràn, nút cao tối thiểu 44px.

- Cột đôi chuyển thành một cột ở dưới 768px, thứ tự đọc: tiêu đề, nội dung, ảnh.
- Cột đọc rộng tối đa ~720px; TOC chuyển thành khối thu gọn phía trên ở mobile.

## 6. SEO và hiệu năng

- Một thẻ H1 duy nhất, thứ tự heading không nhảy cấp.
- Meta title và description riêng cho trang.
- Ảnh WebP, có `width`/`height`, `loading="lazy"` trừ ảnh đầu trang.
- Canonical và Open Graph qua plugin SEO.
- Schema Article, breadcrumb, ngày đăng/cập nhật.
- Ảnh đại diện có kích thước chuẩn Open Graph (1200×630).

## 7. Kiểm tra bám sát thiết kế (Design Fidelity Review)

Mở song song: demo (https://reachout.nexmotivedemo.com/blog/ (mở một bài bất kỳ để lấy URL chi tiết)) và trang AZ Media local. Tích ☑ khi khớp, ghi chênh lệch vào cột ghi chú.

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
| ☐ | Typography nội dung bài (heading, blockquote, list, code) | Dùng bài mẫu đủ phần tử | |

Ảnh đối chiếu: lưu `docs/references/blog-single-demo.png` và `docs/references/blog-single-az.png`.

## 8. Tiêu chí nghiệm thu

- [ ] Bài mới viết bằng editor hiển thị đúng, không sửa code.
- [ ] Điểm Lighthouse bài viết ≥ 90.
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [ ] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[blog-single]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| | | |
