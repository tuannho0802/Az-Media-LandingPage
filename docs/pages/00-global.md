# Plan trang: Thành phần dùng chung (Header, Footer, Announcement, Component)

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `(mọi trang)` |
| Template WordPress | `parts/header.html, parts/footer.html, parts/announcement-bar.html` |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/ |
| Độ tin cậy nguồn | ✅ Cấu trúc đã đọc từ trang chủ demo · ⚠️ màu, font, kích thước là đề xuất |
| Pattern dùng | `az-announcement`, `az-cta`, `az-faq` |
| Dữ liệu (CPT/plugin) | Menu WordPress (Primary, Footer 1-4), Customizer/Site Options cho email, điện thoại, social |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☑ Chờ review · ☐ Đạt |
| Ngày truy cập demo | 17/11/2026 |

## 1. Mục đích

Các thành phần xuất hiện ở mọi trang. Làm và nghiệm thu trước, vì sai ở đây sẽ lỗi đồng loạt.

## 2. Cấu trúc section (thứ tự từ trên xuống)

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | Announcement bar | Thanh mỏng trên cùng, nền đậm, một dòng chữ sáng căn giữa, không có nút đóng | az-announcement | Option bật/tắt + nội dung | ✅ |
| 2 | Header | Logo trái, menu **căn trái ngay cạnh logo**: Home, Pricing, Services, Pages (dropdown: Blog, FAQs, Career, Contact; trang Bảo trì không đưa vào menu công khai), About; hai nút phải: Pricing (viền) và Contact (đặc). Sticky, nền trắng trong suốt có blur; announcement bar cũng dính trên cùng, header dính ngay dưới bar | parts/header | Menu Primary | ✅ |
| 3 | Hero trang con | Mỗi trang con có hero riêng theo ref demo (Bảng giá: `az-pricing-hero`). Không có pattern/breadcrumb dùng chung | az-pricing-hero | — | ✅ |
| 4 | CTA cuối trang | Eyebrow, H2, mô tả, nút, ảnh bên cạnh. Tái sử dụng nhiều trang | az-cta | Nội dung pattern | ✅ |
| 5 | Footer | Dải trên nền nhạt: tagline trái, email + điện thoại (icon tròn) phải; lưới 5 cột link có mũi tên (Công ty, Hỗ trợ, Liên kết nhanh, Tài nguyên, Mạng xã hội); thanh dưới nền đậm: copyright trái, 3 link pháp lý phải | parts/footer | Menu Footer 1-4 | ✅ |

## 3. Nội dung AZ Media cần chuẩn bị

- Logo AZ Media (SVG, bản sáng/tối), favicon.
- Menu chính thức và 4 cột link footer.
- Email, điện thoại, địa chỉ, kênh social thật.
- Câu announcement.

## 4. Tương tác và hành vi

- Header sticky, thu nhỏ nhẹ khi cuộn (nếu demo có).
- Dropdown Pages mở bằng hover (desktop) và chạm (mobile), hỗ trợ bàn phím.
- Announcement bar không có nút đóng (theo ref), luôn hiển thị và dính trên cùng cùng header.
- Nút: primary nền đậm chữ trắng; secondary viền; có trạng thái hover/focus rõ.

## 5. Responsive

Kiểm tra ở 1200 / 1024 / 768 / 480: không cuộn ngang, ảnh không méo, chữ không tràn, nút cao tối thiểu 44px.

- Dưới 1024px: menu thành hamburger, hai nút phải xuống cuối menu.
- Footer: 5 cột thành 3 cột (1100px), 2 cột (600px) rồi 1 cột (480px).

## 6. SEO và hiệu năng

- Header/footer dùng thẻ `header`, `nav`, `footer` đúng ngữ nghĩa.
- Link footer trỏ tới trang thật, không để `#`.

## 7. Kiểm tra bám sát thiết kế (Design Fidelity Review)

Mở song song: demo (https://reachout.nexmotivedemo.com/) và trang AZ Media local. Tích ☑ khi khớp, ghi chênh lệch vào cột ghi chú.

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
| ☐ | Chiều cao header và khoảng cách logo-menu-nút | Đo bằng DevTools ở 1440px | |
| ☐ | Dropdown Pages (độ rộng, bóng, khoảng cách mục) | Mở dropdown và so | |
| ☐ | Bố cục 5 cột footer, dải tagline và hàng copyright | So ở 1440px và 768px | Đã làm lại theo `OG-Home.png`, cần xác nhận bằng mắt |

Ảnh đối chiếu: lưu `docs/references/global-demo.png` và `docs/references/global-az.png`.

## 8. Tiêu chí nghiệm thu

- [ ] Header/footer/announcement giống nhau trên mọi trang.
- [ ] Menu quản lý được trong Appearance → Editor (Navigation).
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [ ] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[global]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| 17/11/2026 | Dựng announcement bar, header, footer. Chờ review thiết kế | |
| 17/11/2026 | Header: logo và menu không xuống dòng, ẩn nút Bảng giá/Liên hệ dành cho mobile ở desktop. Footer làm lại theo ref (dải tagline + 5 cột + thanh đậm) | |
| 17/11/2026 | Sửa header theo ref: nền trong suốt (trắng 78%) có blur 10px, announcement bar và header cùng dính khi cuộn (header nằm dưới bar), menu căn trái cạnh logo thay vì căn giữa, chiều cao 70px không co khi cuộn, mũi tên dropdown sát chữ. Chưa xem bằng trình duyệt | |
| 17/11/2026 | Gỡ mục "Bảo trì" khỏi dropdown Trang: trang bảo trì chỉ hiện khi bật chế độ bảo trì hoặc xem trước bằng URL, xem `11-maintenance.md` | |

## Con trỏ chuột tuỳ biến

- Tạo bằng `az.js` (`initCursor`) và CSS `.az-cursor*`. Thứ tự di chuyển: con trỏ gốc (0ms) → dot → vòng tròn 40px. `DOT_DELAY` / `RING_DELAY` là tổng độ trễ so với con trỏ gốc; `DOT_EASE` / `RING_EASE` là độ "trôi" (càng lớn càng chậm và mượt, ví dụ 45 và 80). Chỉnh độ mượt thì đổi EASE, không cần đổi DELAY.
- Chỉ chạy khi `(hover: hover) and (pointer: fine)` và không bật `prefers-reduced-motion`. Trên cảm ứng không có gì được thêm vào trang.
- Trạng thái: rê vào link/nút/input thì vòng phóng 1.5×; nhấn chuột thì vòng thu nhỏ; trên `.az-why-us`, `.az-cta__box`, footer dưới, announcement thì đổi sang màu trắng.

## Nút lên đầu trang

- Tạo bằng `az.js` (`initBackToTop`) và CSS `.az-top*`, nên có trên mọi trang mà không cần sửa template. Cố định góc phải dưới (32px, 16px trên điện thoại).
- Hiện khi cuộn quá `SHOW_AFTER` (240px). Vòng ngoài là tiến độ cuộn: rỗng ở đầu trang, đầy ở cuối trang.
- Bấm: cuộn mượt về đầu (tức thì nếu bật `prefers-reduced-motion`) và trượt ra khuất góc phải. Nút ở yên đó đến khi người dùng cuộn lại (lăn chuột, chạm, phím) hoặc về tới đầu trang rồi cuộn xuống.
- Khi ẩn, nút `visibility: hidden` và `tabindex=-1` nên không bị focus bằng bàn phím.
- Trạng thái hover của con trỏ (vòng phóng to trên link/nút, màu trắng trên nền tối) được lưu cùng từng mẫu vị trí và áp theo độ trễ của dot và vòng, nên không xảy ra cảnh vòng đã phóng to khi còn cách link một khoảng.

## Hover ở header (desktop ≥1024px)

- Link cấp 1: gạch chân `::after` chạy từ trái (`scaleX`), đổi màu .3s. Mũi tên dropdown xoay 180°.
- Dropdown: ghi đè kiểu ẩn của core (height/width 0) về `auto` để animate được; đóng thì trong suốt, nhích xuống 10px; mở thì trượt lên + hiện dần. Trễ mở 80ms, trễ đóng 150ms (hover intent); có cầu nối vô hình 8px để rê chuột từ link xuống menu không bị đóng. Các mục hiện lần lượt cách nhau 40ms (tối đa 5 mục).
- Chỉnh độ nhanh: các `transition` và `--az-ease` trong khối "Hover header" của `az.css`. Mobile (hamburger) giữ nguyên hành vi của core.
- Lưu ý khi sửa con trỏ: vị trí phải đặt bằng thuộc tính `translate` chứ không dùng `transform`, vì độ phóng dùng thuộc tính `scale` riêng; trộn `transform` với `scale` sẽ làm toạ độ bị nhân theo độ phóng và vòng lệch khỏi con trỏ.

## Hiệu ứng hover trang chủ

- Khối "7.x HOVER TRANG CHỦ" trong `az.css`, dùng biến `--az-ease` (cùng đường cong với header). Toàn bộ nằm trong `@media (hover: hover) and (pointer: fine)`, nên cảm ứng không bị kẹt hover.
- Thẻ (Why us, Sứ mệnh, Solutions, Nhận xét): nhấc 4px + bóng + viền xanh. Gói giá: nhấc 6px (gói giữa nền đậm chỉ nhấc và đổ bóng). Thẻ nền tối: sáng nền, ô số đổi xanh và phóng 1.1×.
- Ảnh lớn (Why us, Solutions): zoom 1.045× trong khung `overflow: hidden`. FAQ: ô nhích 4px phải. Footer: link nhích 4px phải, icon liên hệ phóng 1.1×.
- Chỉnh độ mạnh: đổi `translateY(-4px)` / `-6px`, `scale(...)` và thời gian `.45s` trong khối đó. `prefers-reduced-motion` bỏ nhấc/zoom/nhích, giữ đổi màu.

