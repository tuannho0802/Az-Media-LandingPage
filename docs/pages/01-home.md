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
| 2 | Hero | Badge nhỏ chữ hoa; H1 lớn 2 dòng; đoạn mô tả; 2 nút (Contact, Pricing); 3 điểm tin cậy (dùng thử, demo, hỗ trợ); cột phải: ảnh (placeholder) chạm đáy section, card số khách hàng kèm avatar chồng giữa-phải, card rating chồng dưới-trái; nền lưới ô vuông nhạt | az-hero | Nội dung pattern | ✅ |
| 3 | Trusted by | Nền tint; nhãn bên trái, hàng 6 logo (placeholder) trong thẻ bên phải | az-logos | Ảnh logo | ✅ |
| 4 | Why choose us | Nền xanh đậm có lưới; badge + H2 trái, nút phải; hàng dưới: ảnh (placeholder) kèm 3 counter chồng đáy ảnh bên trái, 4 card đánh số 01–04 xếp 2×2 bên phải | az-why-us | Nội dung pattern | ✅ |
| 5 | Specialization | Nền trắng; badge + H2 + nút viền; hàng dưới: Vision (đoạn văn) bên trái, Mission là 4 thẻ có icon bên phải | az-specialization | Nội dung pattern | ✅ |
| 6 | Our solutions | Cột trái ảnh (placeholder); cột phải badge + H2 + mô tả + lưới 2×3 thẻ có icon mạng xã hội và counter (nhãn đã đặt khác nhau, demo lặp "Followers") | az-solutions | Nội dung pattern | ✅ |
| 7 | Pricing | Eyebrow + H2 + mô tả; 3 card gói (Starter, Standard, Premium); mỗi card: tên, mô tả ngắn, giá/tháng, đoạn mô tả, nút Learn more | az-pricing | `pricing_plan` (3 bài) | ✅ |
| 8 | Testimonials | Hàng đầu: badge + H2 / mô tả / nút About Us; lưới 3×2 gồm 6 lời nhận xét (trích dẫn, avatar, tên, vai trò, sao ở đáy thẻ). Mobile: vuốt ngang | az-testimonials | `testimonial` (6 bài) | ✅ |
| 9 | CTA | Khối nền đậm có lưới: badge + H2 + mô tả (+ nút Đặt lịch tư vấn). Không có ảnh, giống ref | az-cta | Nội dung pattern | ✅ |
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
- Testimonials: lưới 3×2 như ref (không còn slider). Dưới 768px chuyển thành dải vuốt ngang bằng CSS scroll-snap, không cần JS.
- Accordion FAQ: `<details>`, mở một mục tại một thời điểm, mục đầu mở sẵn; không có icon +/- để giống ref.
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
| ☑ | Thứ tự section khớp demo | Mở demo, đếm và so từ trên xuống dưới | 9 section đúng thứ tự `OG-Home.png`; kiểm bằng HTML render trên WordPress thật |
| ☐ | Bố cục cột và tỉ lệ | Đặt hai cửa sổ cạnh nhau ở 1440px, so cột trái/phải | Đã chỉnh theo `OG-Home.png` (hero 55/45, Why us ảnh + 2×2, Specialization 5/7, Solutions 1/1, Testimonials 3×2, FAQ 5/7). Cần so bằng mắt ở 1440px |
| ☐ | Khoảng cách trong và giữa các khối | Đo padding/margin bằng DevTools | Chưa đo |
| ☐ | Typography (cỡ, độ đậm, line-height) | DevTools, tab Computed | Chưa đo. Font ref trông như DM Sans, AZ dùng Plus Jakarta Sans (có subset tiếng Việt) nên khác nét chữ là chủ ý |
| ☑ | Màu đã đổi từ tím sang xanh đậm theo token | Không còn mã màu tím nào trong CSS của trang | Đã rà `themes/`, không còn mã tím; section đậm dùng `primary-dark` |
| ☐ | Component (nút, card, badge) và trạng thái hover/focus | Di chuột và Tab qua từng phần tử | Chưa thử. Badge đã đổi sang kiểu nền nhạt + viền trái như ref; nút viền đổi sang nền trắng viền xám |
| ☐ | Tương tác và animation | So hành vi với demo (counter, slider, accordion...) | Counter, accordion, nút đóng announcement chạy đúng trên HTML thật (jsdom). Chưa thử trên trình duyệt |
| ☐ | Responsive 1200 / 1024 / 768 / 480 | Thu nhỏ trình duyệt, không cuộn ngang, nút đủ lớn | Chưa thử. Cần kiểm kỹ 600–1023px (hamburger) |
| ☑ | Không dùng lại ảnh, logo, tên, nội dung của demo | Rà ảnh, alt, tên người, số liệu | Ảnh là SVG tự vẽ (placeholder), nội dung tiếng Việt tự viết |
| ☐ | Hero: tỉ lệ cột chữ/ảnh, cỡ H1, vị trí card nổi | So ảnh chụp ở 1440px | Ảnh chạm đáy section, card khách hàng giữa-phải, card rating dưới-trái như ref. Cần xác nhận bằng mắt |
| ☐ | Lưới nền hero (độ đậm, kích thước ô) | Phóng to ảnh chụp | Ô 56px, đã thêm lưới cho Pricing, Testimonials, Why us, CTA, footer. Cần xác nhận bằng mắt |
| ☐ | Card đánh số 01–04 (cỡ số, viền, khoảng cách) | Đo trong DevTools | Đã đổi sang ô số nhỏ + card nền đậm xếp 2×2 như ref. Chưa đo |
| ☑ | Pricing: gói nổi bật có phân biệt không | So với demo, ghi chênh lệch | Demo: gói giữa nền đậm, thẻ căn giữa, không nâng lên. AZ làm giống (chọn theo vị trí `:nth-child(2)`) |
| ☑ | Testimonials: số slide hiển thị mỗi lần | So ở 1440 và 768 | Demo là lưới 3×2, không phải slider. AZ đã đổi sang lưới 3×2 (1023px: 2 cột; 768px: vuốt ngang) |

Ảnh đối chiếu: ảnh demo đã có ở `docs/reference-images/OG-Home.png`. Ảnh trang AZ local: lưu `docs/reference-images/home-az.png` sau khi chụp lại.

## 8. Tiêu chí nghiệm thu

- [x] Đủ 9 section nội dung (từ Hero đến FAQ) cùng header, footer, đúng thứ tự demo.
- [ ] Counter, accordion hoạt động (đã chạy đúng trên jsdom, cần thử trên trình duyệt). Slider đã đổi thành lưới 3×2 theo ref.
- [x] Pricing, Testimonials, FAQ lấy dữ liệu từ CPT, sửa nội dung không cần sửa code. (Đã kiểm: 3 gói, 6 nhận xét, 5 FAQ. Nếu plugin chưa bật, các khối rỗng và admin thấy cảnh báo.)
- [ ] Lighthouse mobile ≥ 90 (Performance, SEO, Accessibility).
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [x] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[home]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| 17/11/2026 | Dựng khung theme, phần dùng chung (00-global) và 9 section trang chủ, plugin `az-media-core`, script seed. Chờ review thiết kế | |
| 17/11/2026 | Làm lại layout theo `OG-Home.png`: hero, Trusted by, Why us (nền đậm), Specialization, Solutions (icon), Pricing, Testimonials (lưới 3×2), CTA (không ảnh), FAQ, footer. Sửa header bị xuống dòng. Thêm guard khi plugin chưa bật | |

### Ghi chú triển khai (cần bạn xác nhận khi review)

- Ngôn ngữ nội dung mẫu: tiếng Việt. Nếu chốt site tiếng Anh hoặc song ngữ thì đổi text trong `patterns/` và `parts/`.
- Mọi số liệu, giá, lời nhận xét, logo, email, điện thoại là **placeholder**. Hero có "120+ thương hiệu" và "4,9/5" là số giả lập, thay số thật trước khi public.
- Testimonials: demo là lưới 3×2 nên AZ đã bỏ slider, dùng lưới 3 cột (1023px: 2 cột, 768px: vuốt ngang bằng CSS). Đã xóa code slider trong `az.js`.
- Solutions: 6 thẻ chuyển sang theo nền tảng (Facebook, X, Instagram, LinkedIn, Behance, TikTok) để có icon như ref. Số liệu là placeholder.
- CTA: ref không có nút và không có ảnh. AZ bỏ ảnh nhưng giữ nút "Đặt lịch tư vấn" để có hành động; muốn giống tuyệt đối thì xóa khối `wp:buttons` trong `patterns/az-cta.php`.
- Chỗ cần ảnh (hero, Why us, Solutions) đang dùng placeholder SVG trong `assets/img/`. Thay bằng ảnh thật khi có.
- Nếu Pricing/Testimonials/FAQ trống: bật plugin `az-media-core` rồi chạy `wp az seed`. Admin sẽ thấy cảnh báo, và Query Loop không còn hiện nhầm bài "Hello world".
- Pricing: gói giữa (`:nth-child(2)`) được làm nổi bật bằng CSS. Nếu muốn chọn gói nổi bật tùy ý cần thêm meta `az_featured` và class riêng.
- Avatar testimonial hiện là chữ cái đầu (meta `az_initials`), chưa dùng ảnh thật.
- Hamburger đổi ở 1024px bằng CSS ghi đè breakpoint 600px mặc định của block Navigation. Kiểm tra kỹ ở 600–1023px.
- Link trong menu/footer là đường dẫn tương đối (`/pricing/`), đúng khi site chạy ở gốc domain (Local WP). Nếu đặt trong thư mục con cần đổi.
- Logo hiện là tên site kèm ô vuông CSS. Thay bằng logo thật qua block Site Logo khi có file.
