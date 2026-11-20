# Plan trang: Bảo trì (Maintenance Mode)

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `/maintenance-mode/` |
| Template WordPress | `templates/page-maintenance-mode.html` (không có announcement, header, footer; tên file theo slug trang) |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/maintenance-mode/ · chỉ để tham khảo, **không dựng theo** |
| Độ tin cậy nguồn | ✅ Đã xem ảnh chụp demo do chủ dự án gửi; chủ dự án yêu cầu làm khác demo |
| Pattern dùng | `az-maintenance` (mới) |
| Dữ liệu (CPT/plugin) | Plugin `az-media-core` (`includes/maintenance.php`): option `az_maintenance_on`, trang Công cụ → AZ Media Bảo trì |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☑ Chờ review · ☐ Đạt |
| Ngày cập nhật | 17/11/2026 |

> **Quyết định thiết kế (khác demo, có chủ đích).** Demo là một trang giới thiệu "Maintenance Mode" có đủ header, footer, ảnh minh họa và ô liên hệ: nó mô tả tính năng chứ không phải trang để khách thấy lúc site đang bảo trì. AZ Media làm theo hướng dùng thật:
> - Trang **độc lập, toàn màn hình**: không announcement, header, footer, không menu để khách bấm đi chỗ khác (khi bật bảo trì thì các trang khác cũng đang ngừng).
> - Nền đậm có lưới (cùng ngôn ngữ với khối CTA và Why choose us), nội dung căn giữa, **không dùng ảnh**.
> - Có nội dung giúp khách yên tâm: trạng thái đang bảo trì, thời gian dự kiến quay lại, tiến độ 3 bước, kênh liên hệ gấp.
> - Có **cơ chế bật/tắt thật** (mục 4), demo không có.
> - Gỡ mục "Bảo trì" khỏi menu Trang ở header.

## 1. Mục đích

Khi site ngừng để cập nhật, khách và công cụ tìm kiếm thấy một trang rõ ràng: chuyện gì đang xảy ra, bao lâu nữa quay lại, liên hệ ai nếu gấp. Trang xem trước ở `/maintenance-mode/` để kiểm tra giao diện khi chưa bật.

## 2. Cấu trúc section (thứ tự từ trên xuống)

Một pattern duy nhất `az-maintenance`, căn giữa theo chiều dọc và ngang, rộng tối đa 640px.

| # | Thành phần | Nội dung / hành vi | Dữ liệu | Xác minh |
|---|---|---|---|---|
| 1 | Logo | Tên site (trắng) dẫn về trang chủ | Site title | Tự thiết kế |
| 2 | Nhãn trạng thái | Viên thuốc "Đang bảo trì hệ thống" có chấm xanh nhấp nháy (`role="status"`) | Tĩnh | Tự thiết kế |
| 3 | Tiêu đề + mô tả | H1 "Chúng tôi đang nâng cấp website để phục vụ bạn tốt hơn", 2 câu trấn an | Tĩnh | Tự thiết kế |
| 4 | Thẻ thông tin | Dòng "Dự kiến hoạt động trở lại" + giá trị; danh sách 3 bước: Sao lưu dữ liệu (hoàn tất), Nâng cấp hệ thống (đang thực hiện), Kiểm tra lần cuối (sắp tới) | Tĩnh, sửa theo từng đợt bảo trì | Tự thiết kế |
| 5 | Hỗ trợ gấp | Câu "Cần hỗ trợ gấp...?" và 2 nút viền: email, điện thoại | Tĩnh | Tự thiết kế |
| 6 | Dòng cuối | "© AZ Media. Cảm ơn bạn đã kiên nhẫn chờ đợi." | Tĩnh | Tự thiết kế |

Không có ô đăng ký nhận tin (bản đề xuất ban đầu có "tùy chọn"): không có hạ tầng gửi mail, thêm vào thì form không hoạt động.

## 3. Nội dung AZ Media cần chuẩn bị

- Thời gian dự kiến, 3 bước tiến độ và trạng thái từng bước cho **mỗi đợt bảo trì**. Hiện là nội dung mẫu, sửa trong `patterns/az-maintenance.php` (thời gian ở khối đoạn văn, danh sách bước ở khối HTML tùy chỉnh) hoặc sửa template trong Site Editor.
- Email và số điện thoại liên hệ gấp (đang là `hello@azmedia.example`, `+84 000 000 000`, cùng placeholder với footer).

## 4. Tương tác và hành vi

- **Bật/tắt:** Công cụ → AZ Media Bảo trì (tích chọn), hoặc WP-CLI `wp option update az_maintenance_on 1` / `0`.
- **Khi bật, với khách:** mọi URL của giao diện trả trang này kèm HTTP **503**, header `Retry-After: 3600` và không cache; có `noindex`. `robots.txt`, feed, favicon, AJAX, cron, REST và WP-CLI không bị chặn.
- **Quản trị viên** (quyền `manage_options`) vào site bình thường. Có thanh nhắc ở wp-admin và mục "Đang bảo trì" trên admin bar để không quên tắt.
- **Chưa seed:** nếu trang `/maintenance-mode/` chưa tồn tại thì bật cũng không khóa khách (tránh khóa nhầm), trang cài đặt có cảnh báo.
- **Khi tắt:** `/maintenance-mode/` là trang xem trước, vẫn có `noindex`.
- Chấm trạng thái nhấp nháy tắt khi người dùng bật `prefers-reduced-motion`.

## 5. Responsive

Kiểm tra ở 1200 / 1024 / 768 / 480: không cuộn ngang, chữ không tràn, nút cao tối thiểu 44px.

- Một cột ở mọi breakpoint, nền phủ kín chiều cao màn hình (`100dvh`), nội dung giữa màn hình.
- Dòng thời gian dự kiến xuống dòng khi hẹp; nút liên hệ tự xuống hàng, cho phép chữ xuống dòng.

## 6. SEO và hiệu năng

- Phản hồi 503 + `Retry-After` + `noindex` để công cụ tìm kiếm không lập chỉ mục trang bảo trì và quay lại sau.
- Không có ảnh, không dùng thư viện ngoài; chỉ dùng CSS của theme.
- Một thẻ H1 duy nhất.

## 7. Kiểm tra thiết kế (Design Fidelity Review)

Trang này **cố ý khác demo**, nên không đối chiếu từng mục với demo. Kiểm tra theo tiêu chí tự thiết kế:

| ☐ | Hạng mục | Cách đối chiếu | Ghi chú |
|---|---|---|---|
| ☐ | Không còn bố cục demo (ảnh bên phải, ô liên hệ trái) | So với ảnh chụp demo | Bố cục mới căn giữa, không ảnh |
| ☐ | Bố cục căn giữa, khoảng cách logo, nhãn, tiêu đề, thẻ, nút | DevTools ở 1440px | |
| ☐ | Typography (H1, mô tả, nhãn) | DevTools, tab Computed | |
| ☐ | Chỉ dùng token màu trong `theme.json` | Không mã tím; chỉ `#fff` và rgba trắng trên nền đậm | |
| ☐ | Component (nút viền, thẻ) và hover/focus | Di chuột và Tab | Nút viền đảo màu khi hover |
| ☐ | Chấm nhấp nháy và `prefers-reduced-motion` | Bật giảm chuyển động trong hệ điều hành | |
| ☐ | Responsive 1200 / 1024 / 768 / 480 | Thu nhỏ trình duyệt | |
| ☐ | Không dùng lại ảnh, logo, tên, nội dung của demo | Rà chữ, alt | Chữ tự viết, không ảnh |
| ☐ | Không có header, footer, announcement | Mở trang | |

## 8. Tiêu chí nghiệm thu

- [ ] Bật chế độ bảo trì: cửa sổ ẩn danh thấy trang này ở mọi URL, mã phản hồi 503, có `Retry-After`; admin vào bình thường.
- [ ] Tắt chế độ: site trở lại ngay; `/maintenance-mode/` vẫn xem trước được (200, có `noindex`).
- [ ] `robots.txt` và đăng nhập `/wp-admin/` vẫn truy cập được khi đang bật.
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [ ] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[maintenance]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| 17/11/2026 | Làm lại plan: khác demo có chủ đích (trang độc lập, nền đậm, không ảnh, có tiến độ + thời gian dự kiến), thêm cơ chế bật/tắt thật. Dựng template `page-maintenance-mode.html`, pattern `az-maintenance`, `includes/maintenance.php`. Gỡ mục Bảo trì khỏi menu header. Chưa xem bằng trình duyệt/WordPress thật | |
| 20/11/2026 | Logo AZ Media bản trắng thay chữ site-title ở đầu trang. Chưa xem bằng trình duyệt/WordPress thật | |
