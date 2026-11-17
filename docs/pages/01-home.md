# Plan trang: Trang chủ

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `/` |
| Template WordPress | `templates/front-page.html` |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/ |
| Độ tin cậy nguồn | ✅ Thứ tự section và nội dung đã đọc · ⚠️ màu, font, kích thước là đề xuất, cần đo lại bằng DevTools |
| Pattern dùng | `az-hero`, `az-logos`, `az-why-us`, `az-specialization`, `az-solutions`, `az-pricing`, `az-testimonials`, `az-cta`, `az-faq` |
| Dữ liệu (CPT/plugin) | CPT `pricing_plan`, `testimonial`, `faq`; plugin: Contact Form 7 (nếu hero có form) |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☑ Chờ review · ☐ Đạt |
| Ngày truy cập demo | 17/11/2026 |

## 1. Mục đích

Giới thiệu AZ Media, thuyết phục và dẫn người xem tới Liên hệ hoặc Bảng giá.

## 2. Cấu trúc section (thứ tự từ trên xuống)

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | Announcement bar + Header | Xem `00-global.md` | az-announcement, header | — | ✅ |
| 2 | Hero | Badge nhỏ chữ hoa; H1 lớn 2 dòng; đoạn mô tả; 2 nút (Contact, Pricing); 3 điểm tin cậy (dùng thử, demo, hỗ trợ); cột phải: ảnh người, card nổi chồng góc dưới phải (số khách hàng), rating dạng điểm/5; nền lưới ô vuông nhạt | az-hero | Nội dung pattern | ✅ |
| 3 | Trusted by | Tiêu đề nhỏ + hàng 6 logo khách hàng | az-logos | Ảnh logo | ✅ |
| 4 | Why choose us | Eyebrow + H2 + nút; 3 counter (năm kinh nghiệm, đội ngũ, giải thưởng); 4 card đánh số 01–04 | az-why-us | Nội dung pattern | ✅ |
| 5 | Specialization | Eyebrow + H2 + nút Contact; khối Vision (đoạn văn) và Mission (4 mục ngắn) | az-specialization | Nội dung pattern | ✅ |
| 6 | Our solutions | Eyebrow + H2 + mô tả; lưới 6 thẻ số liệu có counter (demo lặp nhãn "Followers" 3 lần, nên đặt nhãn khác nhau) | az-solutions | Nội dung pattern | ✅ |
| 7 | Pricing | Eyebrow + H2 + mô tả; 3 card gói (Starter, Standard, Premium); mỗi card: tên, mô tả ngắn, giá/tháng, đoạn mô tả, nút Learn more | az-pricing | `pricing_plan` (3 bài) | ✅ |
| 8 | Testimonials | Eyebrow + H2 + mô tả + nút About Us; slider 6 lời nhận xét (trích dẫn lớn, avatar, tên, vai trò) | az-testimonials | `testimonial` (6 bài) | ✅ |
| 9 | CTA | Eyebrow + H2 + mô tả + ảnh minh họa | az-cta | Nội dung pattern | ✅ |
| 10 | FAQ | Cột trái: eyebrow, H2, mô tả, nút View FAQs; cột phải: 5 câu accordion đánh số 01–05 | az-faq | `faq` (5 bài) | ✅ |
| 11 | Footer | Xem `00-global.md` | footer | — | ✅ |

## 3. Nội dung AZ Media cần chuẩn bị

- H1, đoạn mô tả hero, 3 điểm tin cậy; ảnh hero (có quyền sử dụng); số liệu thật cho card nổi và rating.
- 6 logo khách hàng (cần được phép) hoặc placeholder trung tính.
- Nội dung 4 card Why choose us (bỏ ý "Healthcare" của demo nếu không đúng ngành AZ Media).
- Vision, Mission, 6 số liệu solutions.
- 3 gói giá, 6 lời nhận xét thật, 5 câu FAQ.

## 4. Tương tác và hành vi

- Counter đếm tăng khi cuộn tới, chỉ chạy một lần, dừng khi `prefers-reduced-motion`.
- Slider testimonials: vuốt trên mobile, nút điều hướng/chấm, tự chạy tùy chọn (có nút dừng).
- Accordion FAQ: `<details>` hoặc button + `aria-expanded`.
- Card nổi trong hero chồng lên ảnh, không che nội dung quan trọng ở mobile.

## 5. Responsive

Kiểm tra ở 1200 / 1024 / 768 / 480: không cuộn ngang, ảnh không méo, chữ không tràn, nút cao tối thiểu 44px.

- Cột đôi chuyển thành một cột ở dưới 768px, thứ tự đọc: tiêu đề, nội dung, ảnh.
- Hero: ảnh xuống dưới nội dung ở dưới 768px, card nổi dời vào trong khung ảnh.
- Hàng logo: lưới 3 cột ở 480px hoặc cuộn ngang.
- Pricing: 3 card thành 1 cột, thứ tự Starter → Standard → Premium (hoặc gói nổi bật lên đầu, ghi rõ trong ghi chú).

## 6. SEO và hiệu năng

- Một thẻ H1 duy nhất, thứ tự heading không nhảy cấp.
- Meta title và description riêng cho trang.
- Ảnh WebP, có `width`/`height`, `loading="lazy"` trừ ảnh đầu trang.
- Canonical và Open Graph qua plugin SEO.
- Schema FAQPage cho khối FAQ.
- Schema Organization (logo, social).

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
| ☐ | Hero: tỉ lệ cột chữ/ảnh, cỡ H1, vị trí card nổi | So ảnh chụp ở 1440px | |
| ☐ | Lưới nền hero (độ đậm, kích thước ô) | Phóng to ảnh chụp | |
| ☐ | Card đánh số 01–04 (cỡ số, viền, khoảng cách) | Đo trong DevTools | |
| ☐ | Pricing: gói nổi bật có phân biệt không | So với demo, ghi chênh lệch | |
| ☐ | Slider testimonial: số slide hiển thị mỗi lần | So ở 1440 và 768 | |

Ảnh đối chiếu: lưu `docs/references/home-demo.png` và `docs/references/home-az.png`.

## 8. Tiêu chí nghiệm thu

- [ ] Đủ 9 section nội dung (từ Hero đến FAQ) cùng header, footer, đúng thứ tự demo.
- [ ] Counter, slider, accordion hoạt động.
- [ ] Pricing, Testimonials, FAQ lấy dữ liệu từ CPT, sửa nội dung không cần sửa code.
- [ ] Lighthouse mobile ≥ 90 (Performance, SEO, Accessibility).
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [ ] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[home]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| 17/11/2026 | Dựng khung theme, phần dùng chung (00-global) và 9 section trang chủ, plugin `az-media-core`, script seed. Chờ review thiết kế | |

### Ghi chú triển khai (cần bạn xác nhận khi review)

- Ngôn ngữ nội dung mẫu: tiếng Việt. Nếu chốt site tiếng Anh hoặc song ngữ thì đổi text trong `patterns/` và `parts/`.
- Mọi số liệu, giá, lời nhận xét, logo, email, điện thoại là **placeholder**. Hero có "120+ thương hiệu" và "4,9/5" là số giả lập, thay số thật trước khi public.
- Slider testimonial: tôi chọn 2 slide mỗi lần ở desktop, 1 slide ở ≤768px. Demo chưa xác minh, đối chiếu ở hạng mục cuối mục 7.
- Pricing: gói giữa (`:nth-child(2)`) được làm nổi bật bằng CSS. Nếu muốn chọn gói nổi bật tùy ý cần thêm meta `az_featured` và class riêng.
- Avatar testimonial hiện là chữ cái đầu (meta `az_initials`), chưa dùng ảnh thật.
- Hamburger đổi ở 1024px bằng CSS ghi đè breakpoint 600px mặc định của block Navigation. Kiểm tra kỹ ở 600–1023px.
- Link trong menu/footer là đường dẫn tương đối (`/pricing/`), đúng khi site chạy ở gốc domain (Local WP). Nếu đặt trong thư mục con cần đổi.
- Logo hiện là tên site kèm ô vuông CSS. Thay bằng logo thật qua block Site Logo khi có file.
