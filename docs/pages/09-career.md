# Plan trang: Tuyển dụng

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `/career/` (danh sách) · `/career/{slug}/` (chi tiết từng vị trí) |
| Template WordPress | `templates/page-career.html` · `templates/single-career.html` |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/career/ |
| Ảnh ref | `docs/reference-images/OG-Career.png` |
| Độ tin cậy nguồn | ✅ Cấu trúc đọc từ ảnh ref · ⚠️ màu, font, kích thước là đề xuất |
| Pattern dùng | Danh sách: `az-career-hero`, `az-career-jobs`, `az-career-apply` (dùng lại style `.az-values`) · Chi tiết: `az-career-detail-hero`, `az-career-detail-body`, `az-career-other` |
| Dữ liệu (CPT/plugin) | CPT `career` (meta `az_job_type`, `az_salary`, `az_location`, `az_deadline`), block `az-media/post-updated` |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☑ Chờ review · ☐ Đạt |
| Ngày truy cập demo | 17/11/2026 |

> Cấu trúc ở mục 2 đọc từ ảnh ref `OG-Career.png` (chưa mở trang demo trực tiếp). Ref không có form ứng tuyển, khối phúc lợi hay CTA cuối trang nên trang không dùng `az-benefits`, Contact Form 7 và `az-cta`.

## 1. Mục đích

Thu hút ứng viên, liệt kê vị trí đang mở và nhận hồ sơ.

## 2. Cấu trúc section (thứ tự từ trên xuống)

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | Page hero | Badge "Gia nhập AZ Media", H1 một dòng "Tuyển dụng", mô tả 2 dòng; căn giữa, nền tint có lưới | az-career-hero | — | ✅ |
| 2 | Vị trí đang tuyển | Badge + H2 căn giữa; lưới 2 cột thẻ nền nhạt: tên vị trí, hình thức (icon đồng hồ), mức lương (icon tiền), mô tả ngắn, "Cập nhật N ngày trước" (block `az-media/post-updated`) | az-career-jobs | `career` (tối đa 6) | ✅ |
| 3 | Cách ứng tuyển | Badge + H2 căn trái, nút viền bên phải; dưới là 3 thẻ đánh số 01-03 bên trái, ảnh cao bên phải | az-career-apply | Nội dung pattern | ✅ |

### 2b. Trang chi tiết vị trí `/career/{slug}/` (single-career)

Ref `OG-Career.png` chỉ có trang danh sách, nên cấu trúc dưới đây là đề xuất, dùng lại style trang chi tiết dịch vụ.

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | Hero | Badge "Tuyển dụng", tên vị trí (H1 duy nhất), hàng chip hình thức / mức lương / địa điểm, tóm tắt (excerpt), nút "Ứng tuyển ngay" (→ `/contact/`) và "Xem tất cả vị trí" (→ `/career/`) | az-career-detail-hero | `career` + meta | ⚠️ đề xuất |
| 2 | Thân trang | Cột trái: nội dung bài (Mô tả công việc, Yêu cầu ứng viên, Quyền lợi). Cột phải (dính khi cuộn ở desktop): thẻ Thông tin vị trí (hình thức, lương, địa điểm, hạn nộp, "Cập nhật N ngày trước") và nút Ứng tuyển. Hàng nào trống thì tự ẩn | az-career-detail-body | `career` + meta | ⚠️ đề xuất |
| 3 | Vị trí khác | Tối đa 2 vị trí khác (loại trừ vị trí đang xem), thẻ bấm được, nền tint | az-career-other | `career` | ⚠️ đề xuất |

- Thẻ việc làm ở trang `/career/` bấm được toàn khung (tiêu đề là link, kèm "Xem chi tiết →") và dẫn tới trang chi tiết.
- Schema `JobPosting` (JSON-LD) in tự động ở `functions.php`: tên, mô tả, ngày đăng, đơn vị tuyển (AZ Media), loại hình (nhận từ ô Hình thức: toàn thời gian, bán thời gian, hợp đồng, thời vụ, thực tập), địa điểm và hạn nộp nếu có. Ô Hạn nộp theo dạng `dd/mm/yyyy`; để trống nếu nhận hồ sơ liên tục.
- Nút Ứng tuyển hiện trỏ về `/contact/`. Khi làm trang `10-contact`, nối form để điền sẵn tên vị trí.
- Thêm vị trí mới: wp-admin → Tuyển dụng → Thêm mới, điền tiêu đề, nội dung (dùng Heading + List như mẫu), Trích đoạn (hiện ở thẻ danh sách) và 4 ô thông tin ở thanh bên.
- Sau khi cập nhật code: chạy lại Công cụ → AZ Media Seed. Seed bổ sung nội dung chi tiết, địa điểm, hạn nộp cho 4 vị trí đã có (chỉ điền khi đang trống, giữ nguyên nội dung bạn đã sửa và không đổi ngày cập nhật). URL `/career/{slug}/` tự làm mới một lần, không cần bấm Save Permalinks.

## 3. Nội dung AZ Media cần chuẩn bị

- Vị trí tuyển thật (seed có 4 vị trí mẫu kèm nội dung chi tiết): tên, hình thức, mức lương, địa điểm, hạn nộp, mô tả ngắn (ô Trích đoạn) và nội dung Mô tả / Yêu cầu / Quyền lợi.
- Ảnh thật cho khối Cách ứng tuyển (đang dùng `placeholder-team.svg`).
- Quy trình ứng tuyển thật cho 3 bước.

## 4. Tương tác và hành vi

- Ref không có nút Ứng tuyển, form hay upload CV: thẻ việc làm chỉ hiển thị thông tin, nút "Liên hệ" ở khối Cách ứng tuyển dẫn tới `/contact/`.
- "Cập nhật 2 ngày trước" do block `az-media/post-updated` tính từ thời gian sửa gần nhất của từng vị trí (`post_modified`), tiếng Việt: vừa xong, N phút/giờ/ngày/tuần/tháng/năm trước. Bấm Cập nhật ở wp-admin là thời gian tự mới lại; rê chuột lên chữ để xem ngày giờ chính xác. Nếu site dùng plugin cache trang, thời gian tương đối chỉ làm mới khi cache được xóa.
- Seed tạo 4 vị trí với ngày lùi 2, 4, 6, 1 ngày để thấy hiển thị tương đối. Vị trí đã seed từ trước giữ nguyên ngày tạo.
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
| 17/11/2026 | Sửa lỗi dòng "Cập nhật:" trống ở thẻ việc làm: thay `core/post-date` bằng block `az-media/post-updated`, hiển thị thời gian tương đối tiếng Việt từ `post_modified`, seed ngày mẫu | |
| 17/11/2026 | Thêm trang chi tiết `/career/{slug}/` (template `single-career`, 3 pattern, schema JobPosting), thẻ danh sách có link, meta `az_location` và `az_deadline`, seed bổ sung nội dung chi tiết cho vị trí đã có. Chưa kiểm trên WordPress thật | |
