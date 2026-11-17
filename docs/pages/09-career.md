# Plan trang: Tuyển dụng

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `/career/` |
| Template WordPress | `templates/page-career.html` |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/career/ |
| Ảnh ref | `docs/reference-images/OG-Career.png` |
| Độ tin cậy nguồn | ✅ Cấu trúc đọc từ ảnh ref · ⚠️ màu, font, kích thước là đề xuất |
| Pattern dùng | `az-career-hero`, `az-career-jobs`, `az-career-apply` (dùng lại style `.az-values`) |
| Dữ liệu (CPT/plugin) | CPT `career` (meta `az_job_type`, `az_salary`) |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☑ Chờ review · ☐ Đạt |
| Ngày truy cập demo | 17/11/2026 |

> Cấu trúc ở mục 2 đọc từ ảnh ref `OG-Career.png` (chưa mở trang demo trực tiếp). Ref không có form ứng tuyển, khối phúc lợi hay CTA cuối trang nên trang không dùng `az-benefits`, Contact Form 7 và `az-cta`.

## 1. Mục đích

Thu hút ứng viên, liệt kê vị trí đang mở và nhận hồ sơ.

## 2. Cấu trúc section (thứ tự từ trên xuống)

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | Page hero | Badge "Gia nhập AZ Media", H1 một dòng "Tuyển dụng", mô tả 2 dòng; căn giữa, nền tint có lưới | az-career-hero | — | ✅ |
| 2 | Vị trí đang tuyển | Badge + H2 căn giữa; lưới 2 cột thẻ nền nhạt: tên vị trí, hình thức (icon đồng hồ), mức lương (icon tiền), mô tả ngắn, "Cập nhật: ngày" | az-career-jobs | `career` (tối đa 6) | ✅ |
| 3 | Cách ứng tuyển | Badge + H2 căn trái, nút viền bên phải; dưới là 3 thẻ đánh số 01-03 bên trái, ảnh cao bên phải | az-career-apply | Nội dung pattern | ✅ |

## 3. Nội dung AZ Media cần chuẩn bị

- Vị trí tuyển thật (seed có 4 vị trí mẫu): tên, hình thức, mức lương, mô tả ngắn (dùng ô Trích đoạn).
- Ảnh thật cho khối Cách ứng tuyển (đang dùng `placeholder-team.svg`).
- Quy trình ứng tuyển thật cho 3 bước.

## 4. Tương tác và hành vi

- Ref không có nút Ứng tuyển, form hay upload CV: thẻ việc làm chỉ hiển thị thông tin, nút "Liên hệ" ở khối Cách ứng tuyển dẫn tới `/contact/`.
- Ngày "Cập nhật" là ngày sửa gần nhất của bài (định dạng dd/mm/yyyy), ref hiển thị dạng "2 ngày trước".
- Khi không có vị trí nào: hiện thông báo thay vì danh sách trống.

## 5. Responsive

Kiểm tra ở 1200 / 1024 / 768 / 480: không cuộn ngang, ảnh không méo, chữ không tràn, nút cao tối thiểu 44px.

- Dưới 768px lưới thẻ việc làm thành 1 cột; dưới 900px khối Cách ứng tuyển thành 1 cột (3 thẻ rồi ảnh).

## 6. SEO và hiệu năng

- Một thẻ H1 duy nhất, thứ tự heading không nhảy cấp.
- Meta title và description riêng cho trang.
- Ảnh WebP, có `width`/`height`, `loading="lazy"` trừ ảnh đầu trang.
- Canonical và Open Graph qua plugin SEO.
- Schema JobPosting chưa làm (cần địa điểm, ngày hết hạn, đơn vị tuyển dụng). Thêm khi có dữ liệu thật.

## 7. Kiểm tra bám sát thiết kế (Design Fidelity Review)

Mở song song: demo (https://reachout.nexmotivedemo.com/career/) và trang AZ Media local. Tích ☑ khi khớp, ghi chênh lệch vào cột ghi chú.

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
| ☐ | Hàng vị trí tuyển: bố cục tên/địa điểm/nút | So với demo | |

Ảnh đối chiếu: `docs/reference-images/OG-Career.png` (demo); lưu bản chụp AZ Media vào `docs/reference-images/` khi review.

## 8. Tiêu chí nghiệm thu

- [ ] Thêm vị trí ở wp-admin tự xuất hiện.
- [ ] Form nhận được CV về đúng email.
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [ ] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[career]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| 17/11/2026 | Dựng trang theo ảnh ref: template `page-career`, 3 pattern, CPT `career` + seed 4 vị trí. Chưa kiểm trên WordPress thật | |
