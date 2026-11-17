# Plan trang: Bảo trì (Maintenance Mode)

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `/maintenance-mode/` |
| Template WordPress | `templates/page-maintenance.html (ẩn header/footer đầy đủ)` |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/maintenance-mode/ |
| Độ tin cậy nguồn | ⚠️ Chưa đọc nội dung trang |
| Pattern dùng | `az-maintenance` |
| Dữ liệu (CPT/plugin) | Tùy chọn bật/tắt (plugin hoặc code), form đăng ký nhận tin (tùy chọn) |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☐ Chờ review · ☐ Đạt |
| Ngày truy cập demo | 17/11/2026 |

> **Cần xác minh trước khi dựng.** Chưa đọc được nội dung trang này của demo, nên mục 2 là cấu trúc đề xuất theo chuẩn trang agency. Việc đầu tiên: mở link demo ở trên, chụp full-page lưu vào `docs/references/maintenance-demo.png`, sửa bảng mục 2 cho khớp demo, rồi đổi cột "Xác minh" từ ⚠️ sang ✅.

## 1. Mục đích

Trang thông báo khi site bảo trì. Khác trang demo: cần cơ chế bật/tắt thật cho khách truy cập.

## 2. Cấu trúc section (thứ tự từ trên xuống)

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | Khung bảo trì | Logo, tiêu đề, thông điệp, thời gian dự kiến, kênh liên hệ | az-maintenance | Option | ⚠️ |
| 2 | Đăng ký nhận tin (tùy chọn) | Ô email (xác minh demo có không) | CF7/Newsletter | — | ⚠️ |

## 3. Nội dung AZ Media cần chuẩn bị

- Thông điệp bảo trì, thời gian dự kiến, kênh liên hệ khẩn.

## 4. Tương tác và hành vi

- Chế độ bật thật: trả HTTP 503 kèm `Retry-After`, thẻ `noindex`.
- Quản trị viên đã đăng nhập vẫn xem được site bình thường.
- Trang xem trước ở `/maintenance-mode/` để kiểm tra giao diện.

## 5. Responsive

Kiểm tra ở 1200 / 1024 / 768 / 480: không cuộn ngang, ảnh không méo, chữ không tràn, nút cao tối thiểu 44px.

- Nội dung căn giữa, vừa một màn hình ở mọi breakpoint.

## 6. SEO và hiệu năng

- `noindex` cho trang xem trước.
- Chế độ bật thật trả 503 để công cụ tìm kiếm không lập chỉ mục trang bảo trì.

## 7. Kiểm tra bám sát thiết kế (Design Fidelity Review)

Mở song song: demo (https://reachout.nexmotivedemo.com/maintenance-mode/) và trang AZ Media local. Tích ☑ khi khớp, ghi chênh lệch vào cột ghi chú.

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
| ☐ | Bố cục căn giữa, khoảng cách logo-tiêu đề-nội dung | So với demo | |

Ảnh đối chiếu: lưu `docs/references/maintenance-demo.png` và `docs/references/maintenance-az.png`.

## 8. Tiêu chí nghiệm thu

- [ ] Bật chế độ bảo trì: khách thấy trang này, admin vào bình thường.
- [ ] Tắt chế độ: site trở lại ngay.
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [ ] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[maintenance]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| | | |
