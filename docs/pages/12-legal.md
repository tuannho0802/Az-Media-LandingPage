# Plan trang: Trang pháp lý (Privacy, Terms, Refund)

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `/privacy-policy/, /terms-and-conditions/, /refund-policy/` |
| Template WordPress | `templates/page-legal.html` |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/privacy-policy (và /refund-policy, /terms-and-onditions) |
| Độ tin cậy nguồn | ⚠️ Chưa đọc; link demo `terms-and-onditions` có lỗi chính tả, AZ Media dùng `terms-and-conditions` |
| Pattern dùng | `az-page-hero` |
| Dữ liệu (CPT/plugin) | Page thường |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☐ Chờ review · ☐ Đạt |
| Ngày truy cập demo | 17/11/2026 |

> **Cần xác minh trước khi dựng.** Chưa đọc được nội dung trang này của demo, nên mục 2 là cấu trúc đề xuất theo chuẩn trang agency. Việc đầu tiên: mở link demo ở trên, chụp full-page lưu vào `docs/references/legal-demo.png`, sửa bảng mục 2 cho khớp demo, rồi đổi cột "Xác minh" từ ⚠️ sang ✅.

## 1. Mục đích

Văn bản pháp lý bắt buộc, đọc dễ, liên kết từ footer.

## 2. Cấu trúc section (thứ tự từ trên xuống)

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | Page hero | Tiêu đề + ngày cập nhật | az-page-hero | — | ⚠️ |
| 2 | Nội dung | Cột đọc hẹp, heading đánh số, danh sách; mục lục tùy chọn | Post content | Page | ⚠️ |

## 3. Nội dung AZ Media cần chuẩn bị

- Chính sách Quyền riêng tư, Điều khoản, Hoàn tiền do AZ Media soạn hoặc luật sư/đơn vị tư vấn duyệt. **Không sao chép văn bản của demo hay theme khác.**

## 4. Tương tác và hành vi

- Mục lục neo đến heading (tùy chọn).
- Hiển thị "Cập nhật lần cuối".

## 5. Responsive

Kiểm tra ở 1200 / 1024 / 768 / 480: không cuộn ngang, ảnh không méo, chữ không tràn, nút cao tối thiểu 44px.

- Cột đọc rộng tối đa ~760px, chữ ≥ 16px.

## 6. SEO và hiệu năng

- Một thẻ H1 duy nhất, thứ tự heading không nhảy cấp.
- Meta title và description riêng cho trang.
- Ảnh WebP, có `width`/`height`, `loading="lazy"` trừ ảnh đầu trang.
- Canonical và Open Graph qua plugin SEO.

## 7. Kiểm tra bám sát thiết kế (Design Fidelity Review)

Mở song song: demo (https://reachout.nexmotivedemo.com/privacy-policy (và /refund-policy, /terms-and-onditions)) và trang AZ Media local. Tích ☑ khi khớp, ghi chênh lệch vào cột ghi chú.

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
| ☐ | Cột đọc hẹp, khoảng cách heading | So với demo | |

Ảnh đối chiếu: lưu `docs/references/legal-demo.png` và `docs/references/legal-az.png`.

## 8. Tiêu chí nghiệm thu

- [ ] 3 trang có nội dung thật và link từ footer đúng.
- [ ] Có chính sách cookie nếu dùng analytics/bản đồ nhúng.
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [ ] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[legal]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| | | |
