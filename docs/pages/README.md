# Plan từng trang

Mỗi trang có một file riêng trong thư mục này. Mỗi file gồm: thông tin trang, mục đích, bảng section theo thứ tự, nội dung cần chuẩn bị, tương tác, responsive, SEO, **bảng kiểm tra bám sát thiết kế** và tiêu chí nghiệm thu.

Nguồn tham chiếu và URL gốc xem `docs/plan.md`, mục 11.

## Danh sách trang

| File | Trang | Slug | Nguồn demo | Review |
|---|---|---|---|---|
| [00](00-global.md) | Thành phần dùng chung (Header, Footer, Announcement, Component) | `(mọi trang)` | ✅ đã đọc | ☐ |
| [01](01-home.md) | Trang chủ | `/` | ✅ đã đọc | ✅ Đạt (17/11) |
| [02](02-pricing.md) | Bảng giá | `/pricing/` | ✅ có ảnh ref `OG-Pricing.png` | ◐ dựng lại theo ref, chờ review (17/11) |
| [03](03-services.md) | Dịch vụ (danh sách) | `/all-services/` | ✅ có ảnh ref `OG-Services.png` | ✅ Đạt (17/11) |
| [04](04-service-detail.md) | Chi tiết dịch vụ | `/services/{slug}/` | ⚠️ dựng theo cấu trúc đề xuất (chưa có ảnh ref) | ✅ Đạt (17/11) |
| [05](05-about.md) | Giới thiệu | `/about/` | ✅ có ảnh ref `OG-About.png` | ◐ đã dựng, chờ review (17/11) |
| [06](06-blog.md) | Blog (danh sách bài viết) | `/blog/` | ⚠️ cần xác minh | ☐ |
| [07](07-blog-single.md) | Bài viết (chi tiết) | `/{slug}/` | ⚠️ cần xác minh | ☐ |
| [08](08-faqs.md) | FAQs | `/faqs/` | ⚠️ cần xác minh | ☐ |
| [09](09-career.md) | Tuyển dụng | `/career/` | ⚠️ cần xác minh | ☐ |
| [10](10-contact.md) | Liên hệ | `/contact/` | ⚠️ cần xác minh | ☐ |
| [11](11-maintenance.md) | Bảo trì (Maintenance Mode) | `/maintenance-mode/` | ⚠️ cần xác minh | ☐ |
| [12](12-legal.md) | Trang pháp lý (Privacy, Terms, Refund) | `/privacy-policy/, /terms-and-conditions/, /refund-policy/` | ⚠️ cần xác minh | ☐ |
| [13](13-404-search.md) | 404 và Tìm kiếm | `(tự động)` | ⚠️ cần xác minh | ☐ |

Chú thích: ✅ đã đọc nội dung từ demo · ⚠️ URL lấy từ menu demo nhưng chưa đọc được nội dung, mục 2 của file là cấu trúc đề xuất.

## Thứ tự làm đề xuất

1. `00-global` (header, footer, announcement, component dùng chung)
2. `01-home`
3. CPT và dữ liệu (`az-media-core`), sau đó `02-pricing`, `03-services`, `04-service-detail`
4. `05-about`, `08-faqs`, `09-career`, `10-contact`
5. `06-blog`, `07-blog-single`
6. `11-maintenance`, `12-legal`, `13-404-search`

## Quy trình review bám sát thiết kế (mỗi trang)

1. Mở demo và trang local cạnh nhau ở 1440px.
2. Với trang ⚠️: chụp full-page demo vào `docs/references/<tên>-demo.png`, sửa bảng section cho khớp, đổi ⚠️ thành ✅.
3. Dựng trang, chụp lại vào `docs/references/<tên>-az.png`.
4. Điền bảng "Design Fidelity Review" (mục 7 của file trang): tích khi khớp, ghi chênh lệch.
5. Chuyển trạng thái: Chưa bắt đầu → Đang làm → Chờ review → Đạt.
6. Ghi thay đổi vào `CHANGELOG.md` với tag trang, ví dụ `[home]`.

## Quy tắc

- Màu: chỉ dùng token trong `theme.json`, không hard-code mã màu trong từng trang.
- Section dùng lại ở nhiều trang phải là pattern dùng chung, không nhân bản markup.
- Không dùng ảnh, logo, tên, nội dung của demo.
