# Plan trang: Bảng giá

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `/pricing/` |
| Template WordPress | `templates/page-pricing.html` (WordPress tự chọn theo slug `pricing`) |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/pricing/ |
| Ảnh ref | `docs/reference-images/OG-Pricing.png` (chỉ chứa ảnh demo, không đặt ảnh của project vào thư mục này) |
| Độ tin cậy nguồn | ✅ Dựng theo ảnh ref `OG-Pricing.png` do chủ dự án cung cấp |
| Pattern dùng | `az-pricing-hero` (mới), `az-logos` (dùng lại), `az-pricing-list` (mới, chỉ 3 thẻ gói), `az-why-us` (dùng lại), `az-faq` (dùng lại) |
| Dữ liệu (CPT/plugin) | CPT `pricing_plan` (cùng dữ liệu với trang chủ), `faq`; không có block riêng |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☑ Chờ review · ☐ Đạt (đã dựng lại theo ref, chờ chủ dự án so trên Local WP) |
| Ngày cập nhật | 17/11/2026 |

> **Lưu ý lịch sử.** Bản dựng đầu (commit `b526076`) làm khi chưa có ảnh ref nên tự thêm breadcrumb, danh sách tính năng, bảng so sánh, FAQ về giá và CTA cuối. Demo không có các phần đó. Đã gỡ toàn bộ và dựng lại đúng thứ tự section của ref.

## 1. Mục đích

Cho người xem chọn gói dịch vụ; các section dưới thẻ gói (Why choose us, FAQ) giữ người xem lại và dẫn tới liên hệ.

## 2. Cấu trúc section (thứ tự từ trên xuống, khớp ref)

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | Hero trang | Badge "Gói dịch vụ", H1, đoạn mô tả, căn giữa, nền tint có lưới | az-pricing-hero | Văn bản trong pattern | ✅ |
| 2 | Trusted by | Nhãn trái + 6 logo trong thẻ, nền tint (dùng lại nguyên trang chủ) | az-logos | Logo placeholder | ✅ |
| 3 | Thẻ gói | 3 thẻ căn giữa: tên, mô tả ngắn, giá + chu kỳ, đoạn mô tả, nút. Thẻ thường nền tint, gói giữa nền đậm. Không có phần đầu (eyebrow/H2) | az-pricing-list | `pricing_plan` | ✅ |
| 4 | Why choose us | Nền đậm có lưới, ảnh + 3 counter, 4 card đánh số (dùng lại trang chủ) | az-why-us | Nội dung pattern | ✅ |
| 5 | FAQ | Cột trái "Câu hỏi thường gặp" + nút xem FAQs, cột phải accordion 5 câu (dùng lại trang chủ) | az-faq + block `az-media/faq-list` | `faq` | ✅ |

Không có CTA cuối trang, không có breadcrumb, không có bảng so sánh (ref không có).

## 3. Nội dung AZ Media cần chuẩn bị

- Tên gói, giá, chu kỳ, mô tả ngắn, đoạn mô tả (nhập ở panel **Thông tin hiển thị**, thanh bên phải khi sửa gói). Dùng chung với trang chủ nên sửa một nơi là đổi cả hai trang.
- Câu hỏi FAQ (dùng chung với trang chủ).
- Văn bản hero và logo thật. Toàn bộ là **placeholder**, thay trước khi public.

## 4. Tương tác và hành vi

- Nút mỗi thẻ gói hiện dẫn tới `/contact/` (giống ref là nút "Learn More"). Khi có form Liên hệ có thể thêm `?plan={slug}`.
- Accordion FAQ dùng lại `az.js`. Không có công tắc tháng/năm (ref không có).

## 5. Responsive

Kiểm tra ở 1200 / 1024 / 768 / 480: không cuộn ngang, chữ không tràn, nút cao tối thiểu 44px. Thẻ gói: 3 cột, 2 cột dưới 900px, 1 cột dưới 600px (cùng quy tắc trang chủ).

## 6. SEO và hiệu năng

- Một H1 duy nhất (trong hero), thứ tự heading không nhảy cấp.
- Meta title/description, canonical, Open Graph: đặt bằng plugin SEO khi cài.
- Schema FAQPage đã có sẵn trong block FAQ.

## 7. Kiểm tra bám sát thiết kế (Design Fidelity Review)

Mở song song demo và trang local. Tích ☑ khi khớp, ghi chênh lệch vào cột ghi chú.

| ☐ | Hạng mục | Cách đối chiếu | Ghi chú |
|---|---|---|---|
| ☑ | Thứ tự section khớp demo | Hero, Trusted by, 3 gói, Why choose us, FAQ | Đã so với `OG-Pricing.png` |
| ☐ | Bố cục cột và tỉ lệ | Hai cửa sổ cạnh nhau ở 1440px | |
| ☐ | Khoảng cách trong và giữa các khối | Đo bằng DevTools | |
| ☐ | Typography (cỡ, độ đậm, line-height) | DevTools, tab Computed | |
| ☑ | Màu đã đổi từ tím sang xanh đậm theo token | Không còn mã tím | Chỉ dùng token |
| ☐ | Component (nút, card, badge) và hover/focus | Di chuột và Tab | |
| ☐ | Tương tác (accordion) | So hành vi với demo | |
| ☐ | Responsive 1200 / 1024 / 768 / 480 | Thu nhỏ trình duyệt | Đã đo 1440 và 390 trên WordPress thật: không cuộn ngang, không lỗi JS. Chưa đo 1200/1024/768/480 |
| ☑ | Không dùng lại ảnh, logo, tên, nội dung của demo | Rà ảnh, alt, số liệu | Chữ tiếng Việt tự viết, số liệu placeholder |
| ☑ | Gói giữa nền đậm, hai gói còn lại nền tint | So với ref | |

## 8. Tiêu chí nghiệm thu

- [x] Giá lấy từ CPT, không hard-code.
- [x] Pattern mới hiện ngay sau `git pull` mà không cần đổi version theme (xem nhật ký).
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [x] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[pricing]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| 17/11/2026 | Dựng lần đầu (không có ảnh ref): có breadcrumb, bảng so sánh, FAQ về giá, CTA | `b526076` |
| 17/11/2026 | Dựng lại theo `OG-Pricing.png`: gỡ breadcrumb, bảng so sánh, FAQ về giá, CTA, danh sách tính năng; thêm `az-pricing-hero`, `az-pricing-list`; sửa lỗi trang chỉ hiện CTA do cache pattern | |

### Ghi chú triển khai

- **Vì sao local chỉ hiện CTA:** WordPress cache danh sách pattern của theme và chỉ làm mới khi số version theme đổi. Pattern mới thêm bằng `git pull` mà không đổi version thì không được đăng ký, template gọi pattern đó hiện rỗng. Đã tái hiện trên WordPress thật. Theme giờ tự xóa cache khi danh sách hoặc thời gian sửa file trong `patterns/` đổi (`functions.php`), nên các lần thêm pattern sau không gặp lại.
- Seed không còn tạo dữ liệu riêng cho trang này. Trang `/pricing/` đã có sẵn từ lần seed trước nên dùng ngay template mới. Nếu local đã có 5 FAQ nhóm `bang-gia` và ô "Tính năng của gói" từ bản trước, chúng vô hại và có thể xóa tay.
