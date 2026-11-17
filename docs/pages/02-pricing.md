# Plan trang: Bảng giá

| Thuộc tính | Giá trị |
|---|---|
| Slug AZ Media | `/pricing/` |
| Template WordPress | `templates/page-pricing.html` (WordPress tự chọn theo slug `pricing`) |
| Trang demo tham chiếu | https://reachout.nexmotivedemo.com/pricing/ |
| Độ tin cậy nguồn | ⚠️ Chưa đọc nội dung trang; URL lấy từ menu demo |
| Pattern dùng | `az-page-hero` (mới, dùng chung mọi trang con), `az-pricing-plans` (mới), `az-compare` (mới), `az-faq-pricing` (mới), `az-cta` (dùng lại) |
| Dữ liệu (CPT/plugin) | CPT `pricing_plan` (meta mới `az_features`), `faq` (nhóm `bang-gia`); block `az-media/plan-cards`, `az-media/plan-compare` (plugin), `az-media/breadcrumb` (theme) |
| Trạng thái | ☐ Chưa bắt đầu · ☐ Đang làm · ☑ Chờ review · ☐ Đạt (đã dựng và kiểm trên WordPress thật; chưa đối chiếu với demo) |
| Ngày truy cập demo | 17/11/2026 |

> **Cần xác minh với demo.** Chưa đọc được nội dung trang này của demo (17/11/2026), nên trang đã dựng theo cấu trúc đề xuất chuẩn trang agency, **chưa đối chiếu với demo**. Việc cần làm: mở link demo ở trên, chụp full-page lưu vào `docs/reference-images/pricing-demo.png`, so với `pricing-az.png`, sửa bảng mục 2 và CSS cho khớp, rồi đổi cột "Xác minh" từ ⚠️ sang ✅. Chỗ nhiều khả năng lệch: có hay không bảng so sánh, công tắc tháng/năm, nhãn gói nổi bật, bố cục page hero.

## 1. Mục đích

Trình bày các gói dịch vụ rõ ràng để người xem chọn gói và liên hệ.

## 2. Cấu trúc section (thứ tự từ trên xuống)

| # | Section | Nội dung / hành vi | Pattern | Dữ liệu | Xác minh |
|---|---|---|---|---|---|
| 1 | Page hero | Breadcrumb tự động (Trang chủ / Bảng giá) + H1 lấy từ tiêu đề trang; nền tint có lưới, căn giữa | az-page-hero + block `az-media/breadcrumb` | Tiêu đề trang | ⚠️ |
| 2 | Gói giá | Eyebrow, H2, mô tả; 3 thẻ gói: tên, mô tả ngắn, giá/chu kỳ, đoạn mô tả, danh sách tính năng có dấu tích, nút "Chọn gói này" dẫn tới `/contact/?plan={slug}`. Gói giữa nền đậm (cùng quy ước trang chủ). Không có công tắc tháng/năm | az-pricing-plans + block `az-media/plan-cards` | `pricing_plan` (meta `az_features`) | ⚠️ |
| 3 | So sánh tính năng | Bảng hàng là tính năng, cột là gói, cột gói giữa tô nổi; ô có giá trị hiện giá trị, có tên mà không có giá trị hiện dấu tích, gói không có hiện dấu gạch. Cuộn ngang trong khung riêng, cột tên tính năng dính trái | az-compare + block `az-media/plan-compare` | `pricing_plan` (cùng meta `az_features`, tự ghép) | ⚠️ |
| 4 | FAQ về giá | Cột trái eyebrow, H2, mô tả, nút View FAQs; cột phải 5 câu accordion về VAT, ngân sách quảng cáo, hợp đồng, thanh toán, gói riêng | az-faq-pricing + block `az-media/faq-list` (nhóm `bang-gia`) | `faq` nhóm `bang-gia` | ⚠️ |
| 5 | CTA | Khối đậm có lưới, mời đặt lịch tư vấn (dùng lại nguyên pattern trang chủ) | az-cta | Nội dung pattern | ⚠️ |

## 3. Nội dung AZ Media cần chuẩn bị

- Tên gói, giá, chu kỳ, danh sách tính năng từng gói; gói nổi bật.
- FAQ về giá và thanh toán.
- Cách nhập tính năng (mở gói trong wp-admin, thanh bên phải, panel **Thông tin hiển thị**, ô **Tính năng của gói**): mỗi dòng một tính năng. Dòng dạng `Tên: giá trị` (có dấu cách sau dấu hai chấm) hiện giá trị riêng ở bảng so sánh; dòng chỉ có tên hiện dấu tích. Cùng một tính năng ở các gói phải gõ tên giống hệt nhau thì mới nằm chung một hàng. Gói không có dòng đó hiện dấu gạch.
- Toàn bộ giá, tính năng, câu FAQ do seed tạo là **placeholder**, thay bằng số liệu thật trước khi public.

## 4. Tương tác và hành vi

- Công tắc tháng/năm: **chưa làm** vì chưa xác minh được demo có hay không. Giá là chuỗi tự do (`az_price`) nên nếu làm cần thêm meta giá năm.
- Nút mỗi gói dẫn tới `/contact/?plan={slug}`. Form Liên hệ (trang 10) cần đọc tham số `plan` để điền sẵn.
- Accordion FAQ dùng lại `az.js` có sẵn (mở một mục một lúc). Bảng so sánh không dùng JS.

## 5. Responsive

Kiểm tra ở 1200 / 1024 / 768 / 480: không cuộn ngang, ảnh không méo, chữ không tràn, nút cao tối thiểu 44px.

- Cột đôi chuyển thành một cột ở dưới 768px, thứ tự đọc: tiêu đề, nội dung, ảnh.
- Bảng so sánh cuộn ngang trong khung riêng, cột tên tính năng cố định bên trái (đã dùng `position: sticky`, khung cuộn focus được bằng bàn phím).
- Thẻ gói: 3 cột ở trên 900px, 1 cột (tối đa 520px, căn giữa) từ 900px trở xuống, thứ tự Starter → Standard → Premium.

## 6. SEO và hiệu năng

- Một thẻ H1 duy nhất, thứ tự heading không nhảy cấp.
- Meta title và description riêng cho trang.
- Ảnh WebP, có `width`/`height`, `loading="lazy"` trừ ảnh đầu trang.
- Canonical và Open Graph qua plugin SEO.
- Schema Offer/Product cho từng gói (tùy chọn): **chưa làm**, vì giá là chuỗi tự do nên chưa có số và đơn vị tiền tệ chuẩn. Schema FAQPage đã có sẵn trong block FAQ.
- Meta title/description riêng: đặt bằng plugin SEO khi cài, theme không tự sinh.

## 7. Kiểm tra bám sát thiết kế (Design Fidelity Review)

Mở song song: demo (https://reachout.nexmotivedemo.com/pricing/) và trang AZ Media local. Tích ☑ khi khớp, ghi chênh lệch vào cột ghi chú.

| ☐ | Hạng mục | Cách đối chiếu | Ghi chú |
|---|---|---|---|
| ☐ | Thứ tự section khớp demo | Mở demo, đếm và so từ trên xuống dưới | |
| ☐ | Bố cục cột và tỉ lệ | Đặt hai cửa sổ cạnh nhau ở 1440px, so cột trái/phải | |
| ☐ | Khoảng cách trong và giữa các khối | Đo padding/margin bằng DevTools | |
| ☐ | Typography (cỡ, độ đậm, line-height) | DevTools, tab Computed | |
| ☑ | Màu đã đổi từ tím sang xanh đậm theo token | Không còn mã màu tím nào trong CSS của trang | Chỉ dùng token trong `theme.json`, không có mã tím |
| ☐ | Component (nút, card, badge) và trạng thái hover/focus | Di chuột và Tab qua từng phần tử | |
| ☐ | Tương tác và animation | So hành vi với demo (counter, slider, accordion...) | Accordion FAQ chạy đúng (mở một mục một lúc). Chưa so với demo nên chưa tích |
| ☐ | Responsive 1200 / 1024 / 768 / 480 | Thu nhỏ trình duyệt, không cuộn ngang, nút đủ lớn | Đã đo Chromium trên WordPress thật ở 1440/1024/768/390: không cuộn ngang, nút cao 46–48px. Chưa đo 1200 và 480; chưa thử trên thiết bị thật nên chưa tích |
| ☑ | Không dùng lại ảnh, logo, tên, nội dung của demo | Rà ảnh, alt, tên người, số liệu | Không có ảnh; chữ tiếng Việt tự viết, số liệu là placeholder |
| ☑ | Card gói: độ cao bằng nhau, nút căn đáy | Kiểm tra khi số tính năng khác nhau | Đã đo trên WordPress thật: ở 1440 và 1024px 3 thẻ cao bằng nhau (653px, 672px), nút căn đáy dù Starter có 4 tính năng, Premium có 7. Từ 900px trở xuống là 1 cột nên mỗi thẻ cao theo nội dung |
| ☐ | Gói nổi bật: nhãn, viền, màu | So với demo | |

Ảnh đối chiếu: `docs/reference-images/pricing-az.png` (chụp 17/11 trên WordPress thật dựng trong môi trường thử, 1440px, dữ liệu seed). Ảnh demo: lưu `docs/reference-images/pricing-demo.png`. Các mục còn ☐ cần demo để so, chờ chủ dự án chụp demo hoặc xác nhận.

## 8. Tiêu chí nghiệm thu

- [x] Giá lấy từ CPT, không hard-code. (Đã kiểm trên WordPress thật: sửa meta thì thẻ và bảng đổi theo.)
- [x] Hiển thị đúng khi một gói có nhiều hơn hoặc ít hơn tính năng. (Starter 4, Standard 5, Premium 7 tính năng.)
- [ ] Toàn bộ mục 7 đã tích hoặc có ghi chú lý do chênh lệch.
- [x] Đã ghi thay đổi vào `CHANGELOG.md` với tag `[pricing]`.

## 9. Nhật ký trang

| Ngày | Thay đổi | Commit/PR |
|---|---|---|
| 17/11/2026 | Dựng trang: template `page-pricing.html`, 4 pattern mới (`az-page-hero`, `az-pricing-plans`, `az-compare`, `az-faq-pricing`), block `plan-cards`, `plan-compare`, `breadcrumb`, meta `az_features`, seed tính năng và 5 FAQ về giá. Kiểm trên WordPress thật (Chromium 1440/1024/768/390). Chưa đối chiếu demo | |

### Ghi chú triển khai (cần bạn xác nhận khi review)

- Sau khi áp patch, vào wp-admin → Công cụ → AZ Media Seed, bấm **Tạo dữ liệu mẫu** một lần nữa. Seed sẽ thêm tính năng cho 3 gói đã có (chỉ khi ô còn trống, không ghi đè chỗ bạn đã sửa) và tạo 5 FAQ về giá. Trang `/pricing/` đã được seed trước đó nên dùng ngay template mới, không cần sửa nội dung trang.
- Gói giữa luôn là gói nổi bật theo vị trí (menu order), cùng quy ước trang chủ. Chưa có nhãn "Phổ biến" vì chưa biết demo có không.
- Block FAQ trang này lọc theo nhóm `bang-gia`; FAQ ở trang chủ không lọc nhóm nên vẫn chỉ lấy 5 câu đầu theo thứ tự, không lẫn câu về giá.
- Chỉ thêm FAQ mới vào nhóm `bang-gia` (mục FAQs → chọn Nhóm FAQ), trang tự cập nhật.
- Bảng so sánh ở mobile chỉ thấy cột tên tính năng và một cột gói cho tới khi vuốt ngang; câu mô tả trên bảng có nhắc điều này. Có thể thêm bóng mờ ở mép phải nếu muốn gợi ý rõ hơn.
- `az-faq-pricing` có markup gần giống `az-faq` vì pattern không nhận tham số; chỉ khác nội dung và nhóm dữ liệu. Nếu thêm trang cần FAQ theo nhóm khác, cân nhắc tách thành tham số của block.
