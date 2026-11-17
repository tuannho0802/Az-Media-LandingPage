# Plan trang: Trang pháp lý (Privacy, Terms, Refund) và trang tổng /legal/

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `/legal/` (trang tổng, mới), `/privacy-policy/`, `/terms/`, `/refund-policy/` (đúng với link ở footer và seed; plan cũ ghi `/terms-and-conditions/`, đã sửa lại theo thực tế) |
| Template WordPress | `templates/page-legal.html`, đăng ký trong `theme.json` (`customTemplates`) với tên "Trang pháp lý"; seed tự gán cho 3 trang. Trang pháp lý mới chọn template này ở thanh bên của trình soạn thảo |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/privacy-policy (chỉ tham khảo) |
| Độ tin cậy nguồn | ⚠️ Chưa có ảnh ref của trang này. Dựng theo cấu trúc đề xuất, tối giản, dùng lại hero trang con |
| Pattern dùng | `az-legal-hero`, `az-legal-nav`, `az-legal-body` (văn bản); `az-legal-hub-hero`, `az-legal-hub-list` (trang tổng) |
| Dữ liệu (CPT/plugin) | Page thường; nội dung mẫu ở plugin `az-media-core` (`includes/legal-content.php`); block `az-media/legal-nav` (`includes/legal-nav-block.php`) |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☑ Chờ review · ☐ Đạt |
| Ngày cập nhật | 17/11/2026 (thêm trang tổng, thanh điều hướng, nội dung mở rộng) |

> **Nội dung pháp lý là bản nháp mẫu (PLACEHOLDER).** Văn bản do AZ Media tự soạn để dựng giao diện, **chưa qua rà soát pháp lý**, không sao chép của demo hay theme khác. Mỗi trang có một dòng nghiêng ở đầu nhắc điều này; cần AZ Media hoặc đơn vị tư vấn pháp lý duyệt (số ngày, tỷ lệ hoàn tiền, thông tin pháp nhân) rồi xóa dòng đó trước khi công bố.

## 1. Mục đích

Văn bản pháp lý bắt buộc, đọc dễ, liên kết từ footer.

## 2. Cấu trúc section (thứ tự từ trên xuống)

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | Hero | Badge "Pháp lý", tiêu đề trang (H1), dòng "Cập nhật lần cuối: dd/mm/yyyy"; nền tint có lưới | az-legal-hero | Tiêu đề và ngày sửa của Page | Đề xuất |
| 2 | Nội dung | Cột đọc hẹp 760px; heading H2 tự đánh số 1., 2., 3...; danh sách, đoạn văn | az-legal-body | Nội dung Page (trình soạn thảo) | Đề xuất |

### Trang tổng `/legal/` và điều hướng (thêm 17/11/2026, ngoài plan ban đầu)

- Lý do: gõ `/legal` trước đây ra 404 vì không có trang nào. Nay `/legal/` là trang tổng: hero (badge, H1, một câu giới thiệu), 3 thẻ (cả thẻ bấm được) dẫn tới 3 văn bản kèm mô tả ngắn và “Cập nhật lần cuối”, và lời mời liên hệ. `/legal` (không có `/`) tự chuyển về `/legal/`.
- Template riêng `page-legal-hub.html` (custom template “Trang tổng pháp lý”). Template này được **gán tường minh** vì WordPress tự dùng `page-legal.html` cho trang có slug `legal` nếu không gán.
- Thanh nút dưới hero mỗi văn bản: `Tất cả | Chính sách bảo mật | Điều khoản | Chính sách hoàn tiền`, trang đang xem được tô đậm và có `aria-current="page"`. Nút “Tất cả” chỉ hiện khi `/legal/` đã tồn tại.
- Danh sách văn bản định nghĩa ở `az_core_legal_docs()` (`includes/legal-nav-block.php`); chỉ trang đã xuất bản mới được liệt kê. Thêm văn bản pháp lý mới: tạo trang, gán template “Trang pháp lý”, thêm một dòng vào hàm này.
- Chân trang: cột **Hỗ trợ** có link “Pháp lý” tới `/legal/`; hàng cuối giữ 3 link tới từng văn bản.
- Form liên hệ có dòng đồng ý kèm link Chính sách bảo mật (cơ sở xử lý dữ liệu nêu trong chính sách).

Không có mục lục neo (bản đề xuất ghi "tùy chọn"): mỗi văn bản chỉ 4–7 mục, trang ngắn.

## 3. Nội dung AZ Media cần chuẩn bị

- Rà soát pháp lý và thay 3 văn bản mẫu bằng bản chính thức (có thể sửa ngay trong trình soạn thảo của từng trang). Bản nháp hiện có: Chính sách bảo mật 11 mục, Điều khoản 14 mục, Chính sách hoàn tiền 7 mục.
- Điền các chỗ trong ngoặc vuông `[ ]`: tên pháp nhân, mã số doanh nghiệp, địa chỉ, thời gian lưu trữ dữ liệu, số ngày yêu cầu hoàn tiền, thời gian phản hồi, số lần chỉnh sửa miễn phí, tòa án giải quyết tranh chấp.
- Chính sách bảo mật mô tả đúng website **hiện tại**: không cookie quảng cáo, không công cụ phân tích, phông chữ tự host, form liên hệ lưu họ tên/email/chủ đề/lời nhắn. Nếu thêm Google Analytics, Meta Pixel, chat widget hay form mới, phải cập nhật mục Cookie và Thông tin thu thập.
- Căn cứ pháp luật dùng trong bản nháp: Luật Bảo vệ dữ liệu cá nhân, hiệu lực 01/01/2026 (Nghị định 13/2023/NĐ-CP đã được thay thế từ ngày này). Cần luật sư xác nhận trước khi công bố, kể cả quy định về chuyển dữ liệu ra nước ngoài và thời hạn phản hồi quyền của chủ thể dữ liệu.
- Thông tin pháp nhân (tên công ty, mã số thuế, địa chỉ) nếu muốn đưa vào văn bản.
- Email nhận yêu cầu về dữ liệu cá nhân (đang là `hello@azmedia.example`, placeholder).

## 4. Tương tác và hành vi

- "Cập nhật lần cuối" lấy từ ngày sửa gần nhất của trang, tự đổi khi biên tập viên lưu.
- Đánh số heading bằng CSS (`counter`), biên tập viên chỉ cần dùng khối Heading H2, không gõ số.
- Seed (Công cụ → AZ Media Seed hoặc `wp az seed`) tạo `/legal/`, điền nội dung mẫu và gán template, **chỉ khi trang đang trống, đang là dòng “Trang đang được xây dựng”, là văn bản mẫu tiếng Anh mặc định của WordPress, hoặc là bản nháp của AZ Media còn nguyên dòng “Bản nháp mẫu (PLACEHOLDER)”** (để nâng cấp lên bản nháp mới). Đã duyệt và xóa dòng nháp thì seed không đụng tới. Bấm seed nhiều lần không đổi ngày “Cập nhật lần cuối”.
- Seed đổi tiêu đề “Privacy Policy” (trang WordPress tạo sẵn) thành “Chính sách bảo mật”, chỉ khi còn tiêu đề mặc định.

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

- [x] 3 link ở footer mở đúng 3 trang, không 404, đúng template (không còn dòng "Trang đang được xây dựng"). Đã kiểm trên WordPress thật 17/11/2026.
- [x] `/legal/` mở được (200), `/legal` chuyển về `/legal/`, footer có link “Pháp lý”.
- [ ] Văn bản đã được rà soát pháp lý và đã xóa dòng "Bản nháp mẫu".
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [x] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[legal]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| 17/11/2026 | Thêm trang tổng `/legal/` (sửa lỗi 404), thanh điều hướng giữa các văn bản, link Pháp lý ở footer, dòng đồng ý ở form liên hệ; viết lại nội dung 3 văn bản đầy đủ hơn. Kiểm trên WordPress thật (Chromium 1440 và 390px): không cuộn ngang, không lỗi JS | |
| 17/11/2026 | Dựng template `page-legal.html` (đăng ký custom template), 2 pattern mới, seed nội dung mẫu 3 văn bản và gán template. Chưa xem bằng trình duyệt/WordPress thật | |
