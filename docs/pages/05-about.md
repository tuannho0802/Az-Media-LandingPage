# Plan trang: Giới thiệu

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `/about/` |
| Template WordPress | `templates/page-about.html` |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/about/ · ảnh ref `docs/reference-images/OG-About.png` |
| Độ tin cậy nguồn | ✅ Dựng theo ảnh ref do chủ dự án cung cấp |
| Pattern dùng | `az-about-hero`, `az-about-intro`, `az-vision-mission`, `az-about-stats`, `az-about-values`, `az-about-team` (6 pattern mới) |
| Dữ liệu (CPT/plugin) | CPT `team_member` (mới, menu **Đội ngũ**, meta `az_role`) |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☑ Chờ review · ☐ Đạt |
| Ngày truy cập demo | 17/11/2026 |

> Đã có ảnh ref `OG-About.png` (bản chụp không dính header sticky). Bảng mục 2 theo đúng ảnh ref. Ref **không có** logo đối tác, testimonials và CTA ở trang này nên không dựng (khác bản đề xuất ban đầu), cũng không có breadcrumb.

## 1. Mục đích

Kể câu chuyện AZ Media, tạo niềm tin bằng đội ngũ và số liệu.

## 2. Cấu trúc section (thứ tự từ trên xuống)

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | Hero | Badge, H1 "Về AZ Media", mô tả; nền tint có lưới | az-about-hero | — | ✅ |
| 2 | Chúng tôi là ai | Trái: badge, H2, nút Bảng giá; phải: ảnh ngang | az-about-intro | — | ✅ |
| 3 | Tầm nhìn và Sứ mệnh | Tầm nhìn trái; 4 thẻ sứ mệnh có icon phải | az-vision-mission (trong az-about-intro) | — | ✅ |
| 4 | Số liệu | Thanh nền nhạt bo góc, 4 counter | az-about-stats | — | ✅ |
| 5 | Giá trị cốt lõi | Badge + H2 căn trái; trái 3 thẻ đánh số 01–03, phải ảnh cao | az-about-values | — | ✅ |
| 6 | Đội ngũ | Badge + H2 căn giữa; lưới 2×2 thẻ: ảnh, badge chức danh, tên, mô tả | az-about-team | `team_member` | ✅ |

> Ghi chú dựng: ref là slider 2 thẻ/lượt có chấm phân trang; bản dựng là lưới 2×2 cố định (4 thành viên đầu theo thứ tự `menu_order`), không có slider, theo hướng đã gỡ slider ở trang chủ. Thành viên chưa có ảnh đại diện hiện ảnh tạm `placeholder-person.svg`. Không có link social trên thẻ vì ref không có. `az-vision-mission` có cùng nội dung với khối ở `az-specialization` (trang chủ, chưa đổi); có thể cho trang chủ dùng lại sau.

## 3. Nội dung AZ Media cần chuẩn bị

- Câu chuyện thương hiệu, ảnh văn phòng/đội ngũ thật.
- Danh sách thành viên: tên, chức danh, ảnh, link social.

## 4. Tương tác và hành vi

- Ref không có hover social trên ảnh thành viên.
- Counter như trang chủ.

## 5. Responsive

Kiểm tra ở 1200 / 1024 / 768 / 480: không cuộn ngang, ảnh không méo, chữ không tràn, nút cao tối thiểu 44px.

- Cột đôi chuyển thành một cột ở dưới 768px, thứ tự đọc: tiêu đề, nội dung, ảnh.
- Lưới đội ngũ 4 → 2 → 1 cột.

## 6. SEO và hiệu năng

- Một thẻ H1 duy nhất, thứ tự heading không nhảy cấp.
- Meta title và description riêng cho trang.
- Ảnh WebP, có `width`/`height`, `loading="lazy"` trừ ảnh đầu trang.
- Canonical và Open Graph qua plugin SEO.
- Schema Organization và Person (tùy chọn).

## 7. Kiểm tra bám sát thiết kế (Design Fidelity Review)

Mở song song: demo (https://reachout.nexmotivedemo.com/about/) và trang AZ Media local. Tích ☑ khi khớp, ghi chênh lệch vào cột ghi chú.

| ☐ | Hạng mục | Cách đối chiếu | Ghi chú |
|---|---|---|---|
| ☑ | Thứ tự section khớp demo | So với `OG-About.png` | Hero, Who we are + Vision/Mission, Stats, Core values, Team |
| ☐ | Bố cục cột và tỉ lệ | Đặt hai cửa sổ cạnh nhau ở 1440px, so cột trái/phải | |
| ☐ | Khoảng cách trong và giữa các khối | Đo padding/margin bằng DevTools | |
| ☐ | Typography (cỡ, độ đậm, line-height) | DevTools, tab Computed | |
| ☑ | Màu đã đổi từ tím sang xanh đậm theo token | Không còn mã màu tím nào trong CSS của trang | Chỉ dùng token |
| ☐ | Component (nút, card, badge) và trạng thái hover/focus | Di chuột và Tab qua từng phần tử | |
| ☐ | Tương tác và animation | So hành vi với demo (counter, slider, accordion...) | |
| ☐ | Responsive 1200 / 1024 / 768 / 480 | Thu nhỏ trình duyệt, không cuộn ngang, nút đủ lớn | |
| ☑ | Không dùng lại ảnh, logo, tên, nội dung của demo | Rà ảnh, alt, tên người, số liệu | Chữ tự viết, tên thành viên là PLACEHOLDER, ảnh tạm SVG |
| ☐ | Tỉ lệ ảnh thành viên và bo góc | So với demo | Ảnh thẻ chiếm 2/5 chiều rộng thẻ, ảnh phủ kín |

Ảnh ref: `docs/reference-images/OG-About.png`. Ảnh dựng lại để đối chiếu: `docs/references/about-az.png` (chưa chụp).

## 8. Tiêu chí nghiệm thu

- [ ] Thêm thành viên ở wp-admin tự xuất hiện.
- [x] Các khối tái sử dụng giống trang chủ. (Vision/Mission, counter, eyebrow, nút dùng chung class với trang chủ.)
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [x] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[about]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| | | |
| 17/11/2026 | Dựng trang theo `OG-About.png`: CPT `team_member` + seed 4 thành viên, 6 pattern mới, template `page-about.html`. Chưa xem bằng trình duyệt | |
