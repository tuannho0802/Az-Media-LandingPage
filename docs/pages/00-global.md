# Plan trang: Thành phần dùng chung (Header, Footer, Announcement, Component)

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `(mọi trang)` |
| Template WordPress | `parts/header.html, parts/footer.html, parts/announcement-bar.html` |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/ |
| Độ tin cậy nguồn | ✅ Cấu trúc đã đọc từ trang chủ demo · ⚠️ màu, font, kích thước là đề xuất |
| Pattern dùng | `az-announcement`, `az-page-hero`, `az-cta`, `az-faq` |
| Dữ liệu (CPT/plugin) | Menu WordPress (Primary, Footer 1-4), Customizer/Site Options cho email, điện thoại, social |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☐ Chờ review · ☐ Đạt |
| Ngày truy cập demo | 17/11/2026 |

## 1. Mục đích

Các thành phần xuất hiện ở mọi trang. Làm và nghiệm thu trước, vì sai ở đây sẽ lỗi đồng loạt.

## 2. Cấu trúc section (thứ tự từ trên xuống)

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | Announcement bar | Thanh mỏng trên cùng, nền đậm, một dòng chữ sáng căn giữa, có nút đóng | az-announcement | Option bật/tắt + nội dung | ✅ |
| 2 | Header | Logo trái; menu: Home, Pricing, Services, Pages (dropdown: Blog, FAQs, Career, Contact, Maintenance Mode), About; hai nút phải: Pricing (viền) và Contact (đặc). Sticky | parts/header | Menu Primary | ✅ |
| 3 | Page hero (trang con) | Tiêu đề trang + breadcrumb, nền nhạt/lưới. Dùng cho mọi trang con | az-page-hero | Tiêu đề trang | ✅ |
| 4 | CTA cuối trang | Eyebrow, H2, mô tả, nút, ảnh bên cạnh. Tái sử dụng nhiều trang | az-cta | Nội dung pattern | ✅ |
| 5 | Footer | Giới thiệu + email + điện thoại; 4 cột link (Company, Support, Quick Links, Resources); social (Behance, Instagram, Meta, X); hàng cuối copyright và 3 link pháp lý | parts/footer | Menu Footer 1-4 | ✅ |

## 3. Nội dung AZ Media cần chuẩn bị

- Logo AZ Media (SVG, bản sáng/tối), favicon.
- Menu chính thức và 4 cột link footer.
- Email, điện thoại, địa chỉ, kênh social thật.
- Câu announcement.

## 4. Tương tác và hành vi

- Header sticky, thu nhỏ nhẹ khi cuộn (nếu demo có).
- Dropdown Pages mở bằng hover (desktop) và chạm (mobile), hỗ trợ bàn phím.
- Announcement bar ghi nhớ trạng thái đóng bằng localStorage.
- Nút: primary nền đậm chữ trắng; secondary viền; có trạng thái hover/focus rõ.

## 5. Responsive

Kiểm tra ở 1200 / 1024 / 768 / 480: không cuộn ngang, ảnh không méo, chữ không tràn, nút cao tối thiểu 44px.

- Dưới 1024px: menu thành hamburger, hai nút phải xuống cuối menu.
- Footer: 4 cột thành 2 cột (768px) rồi 1 cột (480px).

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
| ☐ | Bố cục 4 cột footer và hàng copyright | So ở 1440px và 768px | |

Ảnh đối chiếu: lưu `docs/references/global-demo.png` và `docs/references/global-az.png`.

## 8. Tiêu chí nghiệm thu

- [ ] Header/footer/announcement giống nhau trên mọi trang.
- [ ] Menu quản lý được trong Appearance → Editor (Navigation).
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [ ] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[global]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| | | |
