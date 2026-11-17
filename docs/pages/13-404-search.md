# Plan trang: 404 và Tìm kiếm

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `(tự động)`: 404 cho mọi URL không tồn tại; tìm kiếm ở `/?s=từ-khóa` |
| Template WordPress | `templates/404.html`, `templates/search.html` |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/ (thêm đường dẫn không tồn tại để xem 404, và `/?s=test` để xem tìm kiếm) |
| Độ tin cậy nguồn | ⚠️ Chưa có ảnh ref. Dựng theo cấu trúc đề xuất, dùng lại hero trang con, thẻ bài viết và nút của theme |
| Pattern dùng | `az-404`, `az-search-hero`, `az-search-results` (3 pattern mới); dùng lại thẻ `az-post-card` |
| Dữ liệu (CPT/plugin) | Truy vấn tìm kiếm mặc định của WordPress, giới hạn ở bài viết và dịch vụ |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☑ Chờ review · ☐ Đạt |
| Ngày cập nhật | 17/11/2026 |

## 1. Mục đích

Giữ người dùng ở lại khi lạc đường hoặc tìm nội dung.

## 2. Cấu trúc section (thứ tự từ trên xuống)

**404** (`az-404`), một khối nền tint có lưới, căn giữa:

| # | Thành phần | Nội dung / hành vi |
|---|---|---|
| 1 | Số 404 lớn | Trang trí (`aria-hidden`) |
| 2 | H1 | "Rất tiếc, chúng tôi không tìm thấy trang bạn cần" |
| 3 | Mô tả | Đường dẫn có thể đã đổi hoặc trang không còn tồn tại |
| 4 | Ô tìm kiếm | Block Search của WordPress |
| 5 | Nút | Về trang chủ (đặc), Dịch vụ, Blog, Liên hệ (viền) |

**Tìm kiếm**:

| # | Section | Nội dung / hành vi | Pattern |
|---|---|---|---|
| 1 | Hero | Badge "Kết quả tìm kiếm", từ khóa trong H1, ô tìm kiếm giữ lại từ khóa | az-search-hero |
| 2 | Kết quả | Lưới 2 cột thẻ (ảnh, tiêu đề, trích đoạn, nút Đọc thêm), 8 kết quả mỗi trang, phân trang Trước / số / Sau | az-search-results |
| 3 | Không có kết quả | Thông báo, gợi ý kiểm tra chính tả, nút Về trang chủ / Dịch vụ / Liên hệ | trong az-search-results |

## 3. Nội dung AZ Media cần chuẩn bị

- Duyệt câu thông báo 404 và trạng thái rỗng.
- Khi có bài blog (trang `06-blog`), kiểm tra thẻ kết quả với ảnh đại diện thật.

## 4. Tương tác và hành vi

- 404 trả đúng HTTP 404 (WordPress tự xử lý) và có `noindex` (thêm bằng bộ lọc `wp_robots` trong `functions.php`).
- Trang tìm kiếm có `noindex` do WordPress tự gắn.
- Ô tìm kiếm giữ lại từ khóa; ô tìm kiếm có nhãn ẩn cho trình đọc màn hình.
- **Phạm vi tìm kiếm:** bài viết (`post`) và dịch vụ (`service`). Mặc định WordPress còn tìm cả Page, sẽ lẫn các trang pháp lý và trang trống nên loại ra. Giới hạn đặt trong `pre_get_posts` ở `functions.php`; muốn thêm loại nội dung thì thêm vào mảng ở đó.

## 5. Responsive

Kiểm tra ở 1200 / 1024 / 768 / 480: không cuộn ngang, chữ không tràn, nút cao tối thiểu 44px.

- Số 404 co theo `clamp()`; các nút xuống dòng khi hẹp.
- Lưới kết quả một cột dưới 600px (dùng lại quy tắc của khối bài viết).

## 6. SEO và hiệu năng

- 404 và tìm kiếm đều `noindex`.
- Một thẻ H1 duy nhất ở mỗi trang.
- Không có ảnh riêng, không có script riêng.

## 7. Kiểm tra bám sát thiết kế (Design Fidelity Review)

Chưa có ảnh ref; kiểm tra tính nhất quán với các trang con khác.

| ☐ | Hạng mục | Cách đối chiếu | Ghi chú |
|---|---|---|---|
| ☐ | Hero 404 và tìm kiếm giống hero các trang con | So với trang Bảng giá/Dịch vụ | Dùng chung `az-page-hero` |
| ☐ | Bố cục căn giữa, khoảng cách số 404, H1, ô tìm kiếm, nút | DevTools ở 1440px | |
| ☐ | Typography (cỡ, độ đậm, line-height) | DevTools, tab Computed | |
| ☑ | Màu chỉ dùng token trong `theme.json` | Không mã màu tím | |
| ☐ | Ô tìm kiếm và nút (viền, bo góc, focus) | Bấm Tab vào ô | Cùng kiểu ô nhập với form Liên hệ |
| ☐ | Thẻ kết quả, hover, phân trang (số hiện tại, hover) | Di chuột, đổi trang | Thẻ dùng lại `az-post-card` |
| ☐ | Trạng thái không có kết quả | Tìm một từ khóa không tồn tại | |
| ☐ | Tìm theo tên dịch vụ ra thẻ dịch vụ, bấm vào đúng trang | Tìm "nội dung" | |
| ☐ | Responsive 1200 / 1024 / 768 / 480 | Thu nhỏ trình duyệt | |
| ☑ | Không dùng lại ảnh, logo, tên, nội dung của demo | Rà chữ | Chữ tự viết, không ảnh |

## 8. Tiêu chí nghiệm thu

- [ ] Mở một URL không tồn tại: thấy trang 404 cùng giao diện với site, mã phản hồi 404.
- [ ] Tìm một từ khóa có kết quả: ra thẻ, phân trang hoạt động, từ khóa còn trong ô.
- [ ] Tìm một từ khóa không có kết quả: hiện gợi ý hữu ích.
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [x] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[404-search]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| 17/11/2026 | Dựng lại `404.html` (trước đó chỉ có tiêu đề và ô tìm), thêm `search.html`, 3 pattern mới, giới hạn tìm kiếm ở bài viết và dịch vụ, `noindex` cho 404. Chưa xem bằng trình duyệt/WordPress thật | |
