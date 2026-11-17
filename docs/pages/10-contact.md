# Plan trang: Liên hệ

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `/contact/` |
| Template WordPress | `templates/page-contact.html` |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/contact/ · ảnh ref `docs/reference-images/OG-Contact.png` (bản chủ dự án chỉnh tay phần bản đồ vì công cụ chụp trang không chụp được Google Maps) |
| Độ tin cậy nguồn | ✅ Dựng theo ảnh ref do chủ dự án cung cấp |
| Pattern dùng | `az-contact-hero`, `az-contact-form`, `az-contact-info` (3 pattern mới) |
| Dữ liệu (CPT/plugin) | Plugin `az-media-core`: block `az-media/contact-form`, CPT `contact_message` (menu **Tin nhắn liên hệ**), option `az_contact_to` |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☑ Chờ review · ☐ Đạt |
| Ngày cập nhật | 17/11/2026 |

## 1. Mục đích

Trang chuyển đổi chính: nhận liên hệ từ khách hàng, đồng thời cho biết kênh liên hệ trực tiếp và vị trí văn phòng.

## 2. Cấu trúc section (thứ tự từ trên xuống)

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | Hero | Badge, H1 "Liên hệ AZ Media", mô tả; nền tint có lưới | az-contact-hero | — | ✅ |
| 2 | Form liên hệ | Khối nền nhạt bo góc: trái ảnh cao; phải badge, H2, form (Họ tên, Email, Chủ đề, Lời nhắn không bắt buộc, nút Gửi tin nhắn) | az-contact-form | block `az-media/contact-form` | ✅ |
| 3 | Thông tin liên hệ | Badge + H2 căn trái; 3 thẻ có icon: Gọi cho đội ngũ, Email, Giờ làm việc | az-contact-info | Tĩnh | ✅ |
| 4 | Bản đồ + địa chỉ | Thanh địa chỉ (icon ghim, địa chỉ là link Google) và bản đồ Google nhúng, tải lười | az-contact-info | Tĩnh | ✅ (địa chỉ thêm theo yêu cầu, ref chỉ có bản đồ) |

Ref **không có** breadcrumb, CTA hay FAQ ở trang này nên không dựng (khác bản đề xuất ban đầu có breadcrumb, bảng giờ làm việc riêng và Site Options).

**Địa chỉ văn phòng:** [27 Đinh Bộ Lĩnh, Phường 24, Quận Bình Thạnh, TP. Hồ Chí Minh](https://www.google.com/search?kgmid=%2Fg%2F11rk_16qlj). Bản đồ nhúng tìm theo chính địa chỉ này.

> **Quyết định dựng.** (1) Form **tự viết trong plugin** thay vì Contact Form 7: cấu hình CF7 nằm trong database, không đi theo git nên pull về là mất, còn block tự viết chạy ngay sau khi pull. (2) Giờ làm việc là thẻ thứ 3 như ref, không làm bảng theo ngày. (3) Chưa có Site Options: email, điện thoại, giờ làm việc là chữ trong pattern (cùng placeholder với footer).

## 3. Nội dung AZ Media cần chuẩn bị

- Email, điện thoại, giờ làm việc thật (đang là `hello@azmedia.example`, `+84 000 000 000`, "Hằng ngày | 8:00 – 17:00").
- Ảnh đội ngũ/văn phòng thật cho khối form (đang là ảnh tạm SVG).
- Email nhận liên hệ: Cài đặt → Chung → "Email nhận liên hệ (AZ Media)".

## 4. Tương tác và hành vi

- **Gửi form:** gửi tới `admin-post.php`, chuyển về trang với thông báo thành công/lỗi ngay trên form (`#az-contact-form`). Trường bắt buộc kiểm tra ở trình duyệt và lại ở server: Họ tên (tối đa 100 ký tự), Email hợp lệ, Chủ đề (tối đa 150); Lời nhắn tối đa 3000 ký tự.
- **Lưu và thông báo:** mỗi tin nhắn được lưu thành bài `contact_message` (xem ở menu Tin nhắn liên hệ) rồi gửi email tới địa chỉ nhận, có `Reply-To` là người gửi. Lưu trước khi gửi mail nên không mất lead khi máy chủ chưa gửi được email (Local WP mặc định không gửi mail).
- **Chống spam:** nonce, ô ẩn (honeypot), phải điền tối thiểu 3 giây, tối đa 5 lần gửi mỗi giờ cho một IP. Bot trúng honeypot hoặc gửi quá nhanh vẫn thấy "thành công" giả.
- **Bản đồ:** iframe Google tải lười (`loading="lazy"`), cao tối thiểu 300px.

## 5. Responsive

Kiểm tra ở 1200 / 1024 / 768 / 480: không cuộn ngang, ảnh không méo, chữ không tràn, nút cao tối thiểu 44px.

- Dưới 900px khối form thành một cột, **form lên trước, ảnh xuống sau**. Dưới 768px 3 thẻ thông tin xếp một cột.
- Bản đồ cao `clamp(300px, 40vw, 460px)`.

## 6. SEO và hiệu năng

- Một thẻ H1 duy nhất; H2 → H3 theo thứ tự.
- Meta title và description riêng cho trang (qua plugin SEO).
- Schema `LocalBusiness` (tên, URL, địa chỉ) trong `functions.php`. Chưa khai báo điện thoại, email, giờ làm việc vì đang là placeholder.
- Bản đồ là nội dung bên thứ ba (Google), tải lười để không chặn hiển thị trang. Theme vẫn không tải font hay thư viện từ CDN.

## 7. Kiểm tra bám sát thiết kế (Design Fidelity Review)

Mở song song ảnh `OG-Contact.png` và trang AZ Media local ở 1440px. Tích ☑ khi khớp, ghi chênh lệch vào cột ghi chú.

| ☐ | Hạng mục | Cách đối chiếu | Ghi chú |
|---|---|---|---|
| ☑ | Thứ tự section khớp ref | So với `OG-Contact.png` | Hero, khối form, thông tin + 3 thẻ, bản đồ; thêm thanh địa chỉ |
| ☐ | Bố cục cột và tỉ lệ | Hai cửa sổ cạnh nhau ở 1440px | Ảnh trái / form phải chia 1:1 |
| ☐ | Khoảng cách trong và giữa các khối | DevTools | |
| ☐ | Typography (cỡ, độ đậm, line-height) | DevTools, tab Computed | |
| ☑ | Màu đã đổi từ tím sang xanh đậm theo token | Không còn mã tím | Chỉ dùng token; riêng màu báo lỗi `#B42318` |
| ☐ | Component (nút, card, badge) và hover/focus | Di chuột và Tab | Nút Gửi dùng style nút của theme |
| ☐ | Style trường form (viền, bo góc, focus, lỗi) | Gửi form rỗng để xem trạng thái lỗi | Focus có vòng xanh; lỗi viền đỏ sau khi nhập sai |
| ☐ | Responsive 1200 / 1024 / 768 / 480 | Thu nhỏ trình duyệt | |
| ☑ | Không dùng lại ảnh, logo, tên, nội dung của demo | Rà ảnh, alt, số liệu | Chữ tự viết, ảnh tạm SVG |
| ☐ | Bản đồ hiển thị đúng vị trí | Mở trang, so với link Google | |
| ☐ | Cỡ icon và khoảng cách trong thẻ | DevTools | Icon tự vẽ (nét đơn giản), không phải icon của ref |

Ảnh đối chiếu của AZ Media: `docs/references/contact-az.png` (chưa chụp).

## 8. Tiêu chí nghiệm thu

- [ ] Form gửi được: có thông báo thành công, tin nhắn xuất hiện ở menu Tin nhắn liên hệ, email về đúng hộp thư (khi máy chủ gửi được mail).
- [ ] Gửi thiếu trường bắt buộc hoặc email sai: báo lỗi, không lưu.
- [ ] Bản đồ hiển thị đúng vị trí; địa chỉ bấm được.
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [x] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[contact]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| 17/11/2026 | Dựng trang theo `OG-Contact.png` (bản chỉnh tay phần bản đồ): template `page-contact.html`, 3 pattern mới, block form `az-media/contact-form`, CPT `contact_message`, thêm địa chỉ 27 Đinh Bộ Lĩnh và bản đồ Google. Chưa xem bằng trình duyệt/WordPress thật | |
