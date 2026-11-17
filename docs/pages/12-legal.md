# Plan trang: Trang pháp lý (Privacy, Terms, Refund)

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `/privacy-policy/`, `/terms/`, `/refund-policy/` (đúng với link ở footer và seed; plan cũ ghi `/terms-and-conditions/`, đã sửa lại theo thực tế) |
| Template WordPress | `templates/page-legal.html`, đăng ký trong `theme.json` (`customTemplates`) với tên "Trang pháp lý"; seed tự gán cho 3 trang. Trang pháp lý mới chọn template này ở thanh bên của trình soạn thảo |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/privacy-policy (chỉ tham khảo) |
| Độ tin cậy nguồn | ⚠️ Chưa có ảnh ref của trang này. Dựng theo cấu trúc đề xuất, tối giản, dùng lại hero trang con |
| Pattern dùng | `az-legal-hero`, `az-legal-body` (2 pattern mới) |
| Dữ liệu (CPT/plugin) | Page thường; nội dung mẫu ở plugin `az-media-core` (`includes/legal-content.php`) |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☑ Chờ review · ☐ Đạt |
| Ngày cập nhật | 17/11/2026 |

> **Nội dung pháp lý là bản nháp mẫu (PLACEHOLDER).** Văn bản do AZ Media tự soạn để dựng giao diện, **chưa qua rà soát pháp lý**, không sao chép của demo hay theme khác. Mỗi trang có một dòng nghiêng ở đầu nhắc điều này; cần AZ Media hoặc đơn vị tư vấn pháp lý duyệt (số ngày, tỷ lệ hoàn tiền, thông tin pháp nhân) rồi xóa dòng đó trước khi công bố.

## 1. Mục đích

Văn bản pháp lý bắt buộc, đọc dễ, liên kết từ footer.

## 2. Cấu trúc section (thứ tự từ trên xuống)

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | Hero | Badge "Pháp lý", tiêu đề trang (H1), dòng "Cập nhật lần cuối: dd/mm/yyyy"; nền tint có lưới | az-legal-hero | Tiêu đề và ngày sửa của Page | Đề xuất |
| 2 | Nội dung | Cột đọc hẹp 760px; heading H2 tự đánh số 1., 2., 3...; danh sách, đoạn văn | az-legal-body | Nội dung Page (trình soạn thảo) | Đề xuất |

Không có mục lục neo (bản đề xuất ghi "tùy chọn"): mỗi văn bản chỉ 4–7 mục, trang ngắn.

## 3. Nội dung AZ Media cần chuẩn bị

- Rà soát và thay 3 văn bản mẫu bằng bản chính thức (có thể sửa ngay trong trình soạn thảo của từng trang).
- Thông tin pháp nhân (tên công ty, mã số thuế, địa chỉ) nếu muốn đưa vào văn bản.
- Email nhận yêu cầu về dữ liệu cá nhân (đang là `hello@azmedia.example`, placeholder).

## 4. Tương tác và hành vi

- "Cập nhật lần cuối" lấy từ ngày sửa gần nhất của trang, tự đổi khi biên tập viên lưu.
- Đánh số heading bằng CSS (`counter`), biên tập viên chỉ cần dùng khối Heading H2, không gõ số.
- Seed (Công cụ → AZ Media Seed hoặc `wp az seed`) điền nội dung mẫu và gán template, **chỉ khi trang đang trống, đang là dòng "Trang đang được xây dựng" hoặc là văn bản mẫu tiếng Anh mặc định của WordPress**; không ghi đè nội dung đã sửa.

## 5. Responsive

Kiểm tra ở 1200 / 1024 / 768 / 480: không cuộn ngang, chữ không tràn.

- Cột đọc rộng tối đa 760px, cỡ chữ nội dung 17px (≥ 16px).
- Dòng "Cập nhật lần cuối" tự xuống dòng khi hẹp.

## 6. SEO và hiệu năng

- Một thẻ H1 duy nhất (tiêu đề trang), H2 theo thứ tự.
- Meta title và description riêng cho từng trang (qua plugin SEO).
- Không có ảnh, không có script riêng.

## 7. Kiểm tra bám sát thiết kế (Design Fidelity Review)

Chưa có ảnh ref nên không đối chiếu với demo; kiểm tra tính nhất quán với các trang con khác (Bảng giá, Dịch vụ, FAQs).

| ☐ | Hạng mục | Cách đối chiếu | Ghi chú |
|---|---|---|---|
| ☐ | Hero giống hero các trang con | So với trang Bảng giá/Dịch vụ | Dùng chung `az-page-hero` |
| ☐ | Cột đọc hẹp, khoảng cách heading và đoạn | DevTools ở 1440px | |
| ☐ | Typography (cỡ, độ đậm, line-height) | DevTools, tab Computed | Chữ nội dung 17px, line-height 1.7 |
| ☑ | Màu chỉ dùng token trong `theme.json` | Không mã màu tím | Số thứ tự heading dùng `accent-text` |
| ☐ | Đánh số heading đúng thứ tự | Mở cả 3 trang | |
| ☐ | Dòng "Cập nhật lần cuối" | Sửa và lưu trang, tải lại | |
| ☐ | Responsive 1200 / 1024 / 768 / 480 | Thu nhỏ trình duyệt | |
| ☑ | Không dùng lại ảnh, logo, tên, nội dung của demo | Rà chữ | Văn bản tự soạn, không ảnh |

## 8. Tiêu chí nghiệm thu

- [ ] 3 link ở footer mở đúng 3 trang, không 404, đúng template (không còn dòng "Trang đang được xây dựng").
- [ ] Văn bản đã được rà soát pháp lý và đã xóa dòng "Bản nháp mẫu".
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [x] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[legal]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| 17/11/2026 | Dựng template `page-legal.html` (đăng ký custom template), 2 pattern mới, seed nội dung mẫu 3 văn bản và gán template. Chưa xem bằng trình duyệt/WordPress thật | |
