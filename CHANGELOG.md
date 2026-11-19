# Changelog

Mọi thay đổi đáng chú ý của dự án AZ Media được ghi tại đây.
Định dạng theo [Keep a Changelog](https://keepachangelog.com/vi/1.1.0/), đánh số phiên bản theo [Semantic Versioning](https://semver.org/lang/vi/).

## Cách ghi

- Mỗi thay đổi một dòng, bắt đầu bằng tag phạm vi trong ngoặc vuông: `[global]`, `[home]`, `[pricing]`, `[services]`, `[service-detail]`, `[about]`, `[blog]`, `[blog-single]`, `[faqs]`, `[career]`, `[contact]`, `[maintenance]`, `[legal]`, `[404-search]`, `[core]` (plugin), `[theme]` (theme chung), `[docs]`, `[ci]`.
- Nhóm theo: **Added** (thêm mới), **Changed** (thay đổi), **Fixed** (sửa lỗi), **Removed** (gỡ bỏ), **Security** (bảo mật).
- Thay đổi chưa release ghi ở mục `[Unreleased]`. Khi gắn tag, đổi thành mục phiên bản kèm ngày (`YYYY-MM-DD`).
- Số phiên bản trong `themes/az-media/style.css` phải khớp tag.
- Với trang đã review thiết kế, ghi thêm kết quả: `[home] Đạt design review`.

## [Unreleased]

### Added
- [global] Scroll reveal: các khối dưới màn hình đầu (tiêu đề, thẻ, ảnh lớn) mờ → rõ và trượt lên nhẹ khi cuộn tới; các khối cùng lượt hiện nối nhau (tối đa 6 bậc, 80ms). `az.js` tự gắn class theo danh sách selector nên không phải sửa pattern; khối đã thấy lúc tải, đã cuộn qua hoặc nhảy neo thì hiện luôn, không nháy. Xong animation thì gỡ hết class, hover của thẻ không đổi. Tắt khi `prefers-reduced-motion`.
- [global] Animation vào trang cho hero, hero trang con và đầu bài viết bằng CSS thuần (class `az-js` đặt sớm trong `<head>`).
- [global] Chuyển trang mượt: CSS View Transitions đa tài liệu (`@view-transition`), crossfade 0,3s; trình duyệt chưa hỗ trợ (`az-no-vt`) thì nội dung chính fade-in 0,45s.
- [blog] Trang Blog mới: `templates/home.html` + `archive.html`, pattern `az-blog-hero`, `az-blog-list` (chip danh mục, bài nổi bật trang 1, lưới 3 cột, phân trang), CSS thẻ bài.
- [blog-single] Bài chi tiết: `single.html`, pattern `az-post-header`, `az-blog-related`, cột đọc 760px.
- [core] Block `az-media/read-time` ("N phút đọc").
- [theme] 6 ảnh placeholder SVG, tự gán theo ID bài khi chưa có ảnh đại diện.
- [blog] Dữ liệu mẫu 5 bài blog (PLACEHOLDER) về marketing và truyền thông, có chuyên mục Marketing và Truyền thông, ngày đăng rải 3–28 ngày trước: mô hình AIDA, lịch sử mạng xã hội, 6 chỉ số đo hiệu quả, video ngắn, 5 sự thật về thương hiệu. Tạo bằng `wp az seed` hoặc nút ở Công cụ → AZ Media Seed; chạy lại không nhân đôi.
- [theme] Ảnh đại diện dự phòng cho bài viết chưa gán ảnh (3 ảnh tạm `blog-placeholder-1..3.svg`, chọn theo ID bài) để thẻ bài ở Blog, FAQs và kết quả tìm kiếm không bị trống. Bài có ảnh thật thì dùng ảnh thật.
- [home] Hiệu ứng hover cho các phần trang chủ, cùng đường cong chuyển động với header: thẻ Why us, Sứ mệnh, Solutions, Nhận xét nhấc 4px kèm bóng và viền xanh; thẻ nền tối sáng nền, ô số đổi xanh; Gói giá nhấc 6px; icon mạng xã hội phóng và đổi xanh; avatar phóng nhẹ; card nổi ở hero nhấc; ô logo nhấc; ảnh Why us và Solutions zoom chậm; ô FAQ nhích phải và đổi nền; link footer nhích phải. Chỉ bật khi có chuột; bỏ nhấc/zoom khi người dùng chọn giảm chuyển động.
- [theme] Nút lên đầu trang ở mọi trang: ẩn ở đầu trang, cuộn quá 240px thì trượt vào từ góc phải dưới, vòng ngoài tô dần theo tiến độ cuộn. Bấm nút thì cuộn mượt về đầu và trượt ra khuất góc phải, chỉ hiện lại khi người dùng cuộn xuống tiếp.
- [theme] Con trỏ chuột tuỳ biến: con trỏ gốc giữ nguyên, dot trễ 20ms, vòng tròn trễ 40ms (trễ theo thời gian thực). Vòng phóng to khi rê vào link/nút, đổi sang màu trắng trên nền tối. Chỉ bật với chuột (hover + pointer: fine) và tắt khi người dùng chọn giảm chuyển động.
- [legal] Trang tổng `/legal/` (trước đây 404): H1 + 3 thẻ dẫn tới Chính sách bảo mật, Điều khoản, Chính sách hoàn tiền (kèm mô tả và ngày cập nhật), nút Liên hệ. Template mới `page-legal-hub.html` (custom template “Trang tổng pháp lý”), pattern `az-legal-hub-hero`, `az-legal-hub-list`. `/legal` (không có dấu `/`) tự chuyển về `/legal/`.
- [legal] Thanh nút chuyển giữa các văn bản (Tất cả | Chính sách bảo mật | Điều khoản | Chính sách hoàn tiền) dưới hero của mỗi trang pháp lý, đánh dấu trang đang xem (`aria-current`). Pattern mới `az-legal-nav`.
- [core] Block `az-media/legal-nav` (dạng `tabs` và `cards`): chỉ liệt kê trang đã xuất bản nên không có link chết.
- [global] Chân trang: thêm link “Pháp lý” (`/legal/`) ở cột Hỗ trợ.
- [contact] Dòng “Khi gửi tin nhắn, bạn đồng ý để AZ Media xử lý thông tin theo Chính sách bảo mật” (có link) dưới form liên hệ.
- [legal] 3 trang pháp lý `/privacy-policy/`, `/terms/`, `/refund-policy/`: hero (badge, H1, "Cập nhật lần cuối" theo ngày sửa trang), cột đọc 760px, heading H2 tự đánh số bằng CSS. Template `page-legal.html` đăng ký là custom template "Trang pháp lý" trong `theme.json`; pattern mới `az-legal-hero`, `az-legal-body`.
- [core] Nội dung mẫu 3 văn bản pháp lý (`includes/legal-content.php`) và seed điền khi trang đang trống, đang là "Trang đang được xây dựng" hoặc là văn bản mẫu mặc định của WordPress; seed gán template Trang pháp lý. **Bản nháp mẫu chưa qua rà soát pháp lý.**
- [404-search] Trang 404 dựng lại (số 404 lớn, H1, ô tìm kiếm, nút về trang chủ/Dịch vụ/Blog/Liên hệ) và trang kết quả tìm kiếm mới `search.html` (hero giữ từ khóa, lưới thẻ 2 cột, phân trang, trạng thái không có kết quả). Pattern mới `az-404`, `az-search-hero`, `az-search-results`; dùng lại `az-post-card`.
- [theme] Tìm kiếm giới hạn ở bài viết và dịch vụ (`pre_get_posts`); `noindex` cho trang 404 (`wp_robots`).
- [contact] Trang `/contact/` dựng theo `docs/reference-images/OG-Contact.png`: hero, khối form (ảnh trái, form phải), 3 thẻ thông tin (điện thoại, email, giờ làm việc), bản đồ Google nhúng kèm địa chỉ 27 Đinh Bộ Lĩnh, Phường 24, Quận Bình Thạnh, TP. Hồ Chí Minh (link Google). Template `page-contact.html`; pattern mới `az-contact-hero`, `az-contact-form`, `az-contact-info`; icon `phone`, `mail`, `clock`, `pin`. Schema LocalBusiness (tên, URL, địa chỉ).
- [core] Block `az-media/contact-form` + xử lý gửi (`includes/contact-form.php`): kiểm tra server, nonce, honeypot, tối thiểu 3 giây, tối đa 5 lần/giờ/IP; lưu tin nhắn vào CPT `contact_message` (menu Tin nhắn liên hệ) rồi gửi email thông báo; email nhận đặt ở Cài đặt → Chung. Dùng form tự viết thay Contact Form 7 vì cấu hình CF7 nằm trong database, không đi theo git.
- [maintenance] Trang bảo trì `/maintenance-mode/` làm **khác demo có chủ đích**: toàn màn hình, nền đậm có lưới, căn giữa, không ảnh, không announcement/header/footer; gồm nhãn trạng thái nhấp nháy, H1, thời gian dự kiến, tiến độ 3 bước, nút liên hệ gấp. Template `page-maintenance-mode.html`, pattern mới `az-maintenance`.
- [maintenance] Chế độ bảo trì thật trong plugin `az-media-core` (`includes/maintenance.php`): bật/tắt ở Công cụ → AZ Media Bảo trì hoặc `wp option update az_maintenance_on 1`; khách thấy trang bảo trì với HTTP 503, `Retry-After`, `noindex`; quản trị viên vào bình thường; có nhắc ở wp-admin và admin bar.
- [career] Trang chi tiết vị trí `/career/{slug}/` (template `single-career.html`): hero (tên vị trí, chip hình thức/lương/địa điểm, nút Ứng tuyển), thân trang (nội dung bài + thẻ Thông tin vị trí dính khi cuộn), mục Vị trí khác. Pattern `az-career-detail-hero`, `az-career-detail-body`, `az-career-other`. Cấu trúc theo đề xuất (ref chỉ có trang danh sách).
- [career] Schema JobPosting (JSON-LD) trong `functions.php`, lấy địa điểm và hạn nộp từ meta.
- [core] Meta `az_location` (địa điểm) và `az_deadline` (hạn nộp dd/mm/yyyy) cho CPT `career`.
- [core] Seed vị trí tuyển có nội dung chi tiết (Mô tả công việc, Yêu cầu, Quyền lợi), địa điểm và hạn nộp; với vị trí đã seed từ trước, chạy lại Seed sẽ bổ sung phần còn thiếu, giữ nguyên nội dung đã sửa và ngày cập nhật.
- [core] Block `az-media/post-updated` (dùng trong Query Loop) hiện "Cập nhật 2 ngày trước" theo thời gian sửa gần nhất của bài, có `<time datetime>` và title là ngày giờ chính xác; hàm `az_core_time_ago_vi()` diễn đạt tiếng Việt (vừa xong, phút, giờ, ngày, tuần, tháng, năm).
- [career] Trang `/career/` dựng theo `docs/reference-images/OG-Career.png`: hero (badge, H1 "Tuyển dụng", mô tả), lưới 2 cột thẻ việc làm (hình thức, mức lương, mô tả, ngày cập nhật; hiện thông báo khi chưa có vị trí), khối Cách ứng tuyển (3 thẻ đánh số + ảnh, nút Liên hệ). Template `page-career.html`, pattern `az-career-hero`, `az-career-jobs`, `az-career-apply`. Ref không có form ứng tuyển, phúc lợi, CTA nên bỏ khỏi plan.
- [core] CPT `career` (menu Tuyển dụng, meta `az_job_type` hình thức và `az_salary` mức lương) và seed 4 vị trí mẫu (chạy lại Seed để tạo).
- [faqs] Trang `/faqs/` dựng theo `docs/reference-images/OG-FAQ.png`: hero (badge, H1 hai dòng, mô tả), lưới accordion 2 cột đánh số liên tục 01-10 (câu đầu mỗi cột mở sẵn), mục Blog "Bài viết mới nhất" (2 bài gần nhất, ảnh + tiêu đề + trích đoạn + nút Đọc thêm). Template `page-faqs.html`, pattern `az-faqs-hero`, `az-faqs-list`, `az-blog-recent`. Ref không có khối CTA nên bỏ `az-cta` khỏi plan.
- [core] Block `az-media/faq-list` thêm thuộc tính `columns` (1 hoặc 2 cột, chọn trong thanh bên); schema FAQPage vẫn in một lần cho toàn bộ câu hỏi. Seed FAQ tăng từ 5 lên 10 câu (chạy lại Seed để thêm 5 câu mới).
- [about] Trang `/about/` dựng theo `docs/reference-images/OG-About.png`: hero, Chúng tôi là ai (ảnh ngang) kèm Tầm nhìn và Sứ mệnh, thanh 4 số liệu có counter, Giá trị cốt lõi (3 thẻ đánh số + ảnh cao), Đội ngũ (lưới 2×2). Template `page-about.html`; pattern mới `az-about-hero`, `az-about-intro`, `az-vision-mission`, `az-about-stats`, `az-about-values`, `az-about-team`. Theo ref, trang không có logo đối tác, testimonials, CTA.
- [core] CPT `team_member` (menu Đội ngũ, meta `az_role` chức danh, ảnh đại diện) và seed 4 thành viên mẫu; lưới đội ngũ tự lấy từ CPT.
- [theme] Ảnh tạm `placeholder-person.svg` cho thành viên chưa có ảnh đại diện.
- [service-detail] Trang chi tiết dịch vụ `/services/{slug}/` dựng theo cấu trúc đề xuất trong `docs/pages/04-service-detail.md` (chưa có ảnh ref): hero (badge, H1, tóm tắt, nút Nhận báo giá), thân bài (ảnh đại diện + nội dung gồm giới thiệu, lợi ích, quy trình), 3 dịch vụ khác, CTA, FAQ. Template `single-service.html`; pattern mới `az-service-hero`, `az-service-body`, `az-service-related`; dùng lại `az-cta`, `az-faq`.
- [service-detail] Schema Service (JSON-LD) trong `functions.php`.
- [core] Seed nội dung mẫu cho 6 dịch vụ (giới thiệu, lợi ích, quy trình); dịch vụ đã seed từ trước được điền khi nội dung đang trống, không ghi đè nội dung đã sửa.
- [services] Trang `/all-services/` dựng theo `docs/reference-images/OG-Services.png`: hero, khối Why choose us (thẻ trích dẫn + 3 thẻ lợi ích), 2 hàng ảnh xen kẽ, lưới 6 dịch vụ có icon, CTA, FAQ. Template `page-all-services.html`; pattern mới `az-services-hero`, `az-services-why`, `az-services-features`, `az-services-grid`.
- [core] CPT `service` (menu Dịch vụ) và seed 6 dịch vụ mẫu; lưới dịch vụ tự lấy từ CPT.
- [pricing] Trang `/pricing/` dựng theo ảnh ref `docs/reference-images/OG-Pricing.png`: hero (badge, H1, mô tả), Trusted by, 3 thẻ gói (gói giữa nền đậm), Why choose us, FAQ. Template `page-pricing.html`; pattern mới `az-pricing-hero`, `az-pricing-list`, dùng lại `az-logos`, `az-why-us`, `az-faq`.
- [core] Trang wp-admin Công cụ → AZ Media Seed: tạo dữ liệu mẫu bằng một nút bấm khi không có WP-CLI (Local WP trên Windows), kèm nhắc khi chưa có gói giá. Logic seed tách khỏi WP-CLI, `wp az seed` vẫn dùng được.
- [theme] Khung block theme `az-media`: `theme.json` (palette xanh đậm, font Plus Jakarta Sans tự host kèm subset tiếng Việt), `functions.php`, `assets/css/az.css`, `assets/js/az.js`, template `front-page`, `index`, `page`, `single`, `404`.
- [global] Part `announcement-bar`, `header` (sticky, dropdown Trang, hamburger dưới 1024px), `footer` (dải tagline + liên hệ, lưới 5 cột link, thanh copyright và link pháp lý).
- [home] 9 pattern trang chủ: `az-hero`, `az-logos`, `az-why-us`, `az-specialization`, `az-solutions`, `az-pricing`, `az-testimonials`, `az-cta`, `az-faq`, kèm counter và accordion `<details>`.
- [core] Plugin `az-media-core`: CPT `pricing_plan`, `testimonial`, `faq` (+ taxonomy `faq_group`), meta box, block `az-media/faq-list` (kèm schema FAQPage), lệnh `wp az seed` tạo dữ liệu mẫu và các trang rỗng.
- [docs] Plan riêng cho từng trang trong `docs/pages/` (00-global đến 13-404-search) kèm bảng kiểm tra bám sát thiết kế.
- [docs] File `CHANGELOG.md`.

### Changed
- [global] `az.css`/`az.js` đánh phiên bản theo `filemtime` thay vì hằng `AZ_MEDIA_VERSION`: deploy FTP xong trình duyệt/CDN lấy bản mới ngay.
- [global] Menu mobile (dưới 1024px) làm lại: ngăn kéo trượt từ phải trên nền mờ (blur), nút hamburger và nút đóng dạng ô bo góc (vạch xoay thành dấu X), các mục cấp 1 chữ lớn có mũi tên và hiện lần lượt, "Trang" thành nhãn + danh sách con thụt vào (bỏ thẻ nổi có bóng), hai nút CTA ghim đáy. Mở và đóng đều có animation (container luôn render, ẩn bằng `visibility` có độ trễ thay vì `display: none` của core). Bấm nền mờ để đóng (`az.js`). Chỉ ảnh hưởng dưới 1024px; desktop giữ nguyên.
- [global] Header: “Blog” thành mục cấp 1 (đứng sau “Dịch vụ”), bỏ khỏi menu con “Trang” (còn FAQs, Tuyển dụng, Liên hệ).
- [theme] Hover header mượt hơn (desktop): link cấp 1 đổi màu mềm kèm gạch chân chạy từ trái; mũi tên dropdown xoay; dropdown "Trang" trượt lên và hiện dần (trước đây bật lên tức thì), mở trễ 80ms, đóng trễ 150ms để rê chuột chéo không bị đóng, các mục hiện lần lượt; nút Bảng giá/Liên hệ đổi màu và nhấc nhẹ.
- [theme] Con trỏ tuỳ biến: dot và vòng tròn di chuyển trôi mượt (làm mượt dạng hàm mũ, độc lập fps) thay vì bám tức thì; tổng độ trễ vẫn giữ đúng `DOT_DELAY` / `RING_DELAY`. Thêm `DOT_EASE` / `RING_EASE` để chỉnh độ trôi.
- [core] Nội dung 3 văn bản pháp lý viết lại đầy đủ hơn (Chính sách bảo mật 11 mục, Điều khoản 14 mục, Chính sách hoàn tiền 7 mục có quy trình và ví dụ tính tiền). Phần dữ liệu thu thập, cookie, lưu trữ bám theo hành vi thật của website (form liên hệ lưu họ tên, email, chủ đề, lời nhắn; IP chỉ dùng giới hạn gửi form dưới dạng mã băm khoảng 1 giờ; không công cụ theo dõi; phông chữ tự host). Căn cứ pháp luật là Luật Bảo vệ dữ liệu cá nhân (hiệu lực 01/01/2026); không trích Nghị định 13/2023/NĐ-CP vì đã được thay thế từ 01/01/2026. **Vẫn là bản nháp chưa qua rà soát pháp lý.**
- [core] Seed: nâng cấp văn bản nháp cũ lên bản mới nếu trang còn dòng “Bản nháp mẫu (PLACEHOLDER)”; trang đã duyệt và xóa dòng đó thì không bị ghi đè. Bấm seed nhiều lần không đổi ngày “Cập nhật lần cuối”. Seed tạo trang `/legal/`, gán template, và đổi tiêu đề “Privacy Policy” mặc định của WordPress thành “Chính sách bảo mật”.
- [docs] Slug trang Điều khoản chốt là `/terms/` (khớp footer và seed), plan `12-legal.md` đã sửa từ `/terms-and-conditions/`.
- [global] Gỡ mục "Bảo trì" khỏi dropdown Trang ở header (trang bảo trì không đưa vào menu công khai).
- [docs] Viết lại plan `docs/pages/11-maintenance.md` theo hướng trang bảo trì dùng thật, khác demo.
- [career] CPT `career` có URL công khai `/career/{slug}/` (rewrite tự làm mới một lần, `az_core_rewrite_ver` lên 2). Thẻ việc làm ở `/career/` bấm được toàn khung và có "Xem chi tiết".
- [career] Thẻ việc làm dùng block `az-media/post-updated` thay cho `core/post-date`, sửa lỗi dòng "Cập nhật:" không hiện ngày trên WordPress thật; ngày cập nhật giờ tự đổi khi sửa vị trí ở wp-admin. Seed vị trí tuyển lùi ngày tạo 2, 4, 6, 1 ngày để demo (chỉ áp dụng cho vị trí tạo mới).
- [global] Announcement bar theo ref: câu ngắn một dòng "Tăng tốc và nâng tầm thương hiệu của bạn cùng AZ Media.", chữ xanh nhạt trên nền navy đậm, cao 40px. Bỏ nút đóng (`az-announcement__close`) cùng CSS, JS và script lưu trạng thái đóng, bar luôn hiển thị như ref; JS chỉ còn đo chiều cao bar cho header dính.
- [global] Header làm lại theo ref: nền trắng trong suốt có blur (đặt ở `::before` để menu mobile `position: fixed` không bị ảnh hưởng), announcement bar và header cùng dính trên cùng khi cuộn (JS đo chiều cao bar vào `--az-announce-h`, xử lý cả khi đóng bar và có admin bar), menu căn trái cạnh logo thay vì căn giữa, chiều cao 70px cố định (bỏ co khi cuộn), mũi tên dropdown "Trang" sát chữ. Ảnh hưởng mọi trang.
- [docs] `[service-detail] Đạt design review`: chủ dự án xác nhận hoàn thành trang Chi tiết dịch vụ (17/11/2026). Các mục review tích theo xác nhận, chưa có số đo; xem `docs/pages/04-service-detail.md`.
- [docs] Thay `OG-About.png` bằng bản chụp không dính header sticky.
- [core] CPT `service` có rewrite `/services/{slug}/` (không có trang lưu trữ). Rewrite rules tự làm mới một lần khi cập nhật (option `az_core_rewrite_ver`), không cần Save lại Permalinks.
- [services] Tên dịch vụ trong lưới `az-services-grid` giờ là link tới trang chi tiết (xử lý known issue "thẻ chưa có link").
- [docs] `[services] Đạt design review`: chủ dự án xác nhận hoàn thành trang Dịch vụ (17/11/2026). Các mục review tích theo xác nhận, chưa có số đo; xem `docs/pages/03-services.md`.
- [docs] `[home] Đạt design review`: chủ dự án xác nhận hoàn thành trang chủ (17/11/2026). 5 mục review và Lighthouse tích theo xác nhận, chưa có số đo; xem `docs/pages/01-home.md`.
- [core] Giá, chu kỳ, mô tả gói (Gói giá) và vai trò, chữ avatar (Nhận xét) chuyển từ meta box ở đáy màn hình lên panel "Thông tin hiển thị" ở thanh bên phải trình soạn thảo. Meta box cũ chỉ còn dùng cho Classic Editor.
- [home] Làm lại layout theo ảnh ref `docs/reference-images/OG-Home.png`: hero (ảnh chạm đáy, card khách hàng và card rating chồng góc), Trusted by (nền tint, logo trong thẻ), Why choose us (nền đậm có lưới, ảnh kèm 3 counter, 4 card 2×2), Specialization (tầm nhìn trái, 4 thẻ sứ mệnh có icon phải), Solutions (ảnh trái, lưới 2×3 thẻ có icon mạng xã hội), Pricing (thẻ căn giữa, gói giữa nền đậm, không nâng lên), Testimonials (lưới 3×2, sao ở đáy thẻ, mobile vuốt ngang), CTA (khối đậm không ảnh), FAQ (ô câu hỏi nền nhạt, câu trả lời bên dưới).
- [global] Footer làm lại theo ref: dải tagline + email/điện thoại, lưới 5 cột link có mũi tên (thêm cột Mạng xã hội), thanh copyright nền đậm.
- [theme] Badge/eyebrow đổi sang kiểu nền nhạt viền trái đậm; nút viền đổi sang nền trắng viền xám.
- [theme] Ảnh tạm: thêm `placeholder-team.svg`, `placeholder-solutions.svg` cho các chỗ cần ảnh.

### Fixed
- [faqs] Accordion FAQ không còn giật màn hình khi bấm mở/đóng và có animation đóng/mở chiều cao (340ms, cùng đường cong với phần còn lại). Nguyên nhân: mục cũ chỉ được đóng ở sự kiện `toggle` (chạy sau khi mục mới đã mở) nên layout đổi hai nhịp liên tiếp; nay đóng mục cũ và mở mục mới trong cùng một lượt, bấm nhanh giữa chừng thì đảo chiều từ đúng chiều cao hiện tại. Tắt animation khi `prefers-reduced-motion`.
- [home] [faqs] Hover ô FAQ không còn rung khi rê chuột sát mép trái: hiệu ứng nhích phải chuyển từ cả ô `summary` sang phần chữ bên trong, ô không còn trượt khỏi con trỏ.
- [home] Counter không còn nháy “số cuối → 0 → đếm” khi cuộn tới (đặt về 0 trước khi vào màn hình).
- [global] Mobile: ô nhập (form Liên hệ, ô tìm kiếm ở Search và 404) đặt `font-size: 16px` dưới 900px để Safari iOS không tự phóng to khi focus.
- [global] Mobile/xoay ngang (dưới 1024px): announcement bar không còn dính, chỉ header dính, tiết kiệm khoảng 40–55px chiều cao màn hình. `az.js` chỉ đo `--az-announce-h` khi bar thực sự `sticky`, nên header bám sát mép trên.
- [404-search] Ô tìm kiếm ở 320px bị cao 62px vì nút "Tìm kiếm" xuống 2 dòng kéo giãn ô nhập: nút `nowrap`, dưới 420px nút xuống hàng riêng.
- [404-search] Hàng nút gợi ý (Về trang chủ, Dịch vụ, Blog, Liên hệ) chia đều 2 cột trên mobile.
- [global] Footer 2 cột trên mobile: bỏ `gap` thừa giữa tiêu đề cột và link đầu.
- [about] Ảnh thành viên đội ngũ ép tỉ lệ 16/10 dưới 480px để trang không dài.
- [theme] Con trỏ tuỳ biến: khi vòng phóng to (rê vào link/nút) hoặc thu nhỏ (nhấn chuột), vòng bị đẩy lệch khỏi con trỏ, lệch càng xa khi con trỏ càng cách góc trên trái màn hình (ở header lệch sang phải). Nguyên nhân: vị trí đặt bằng `transform: translate3d` còn độ phóng bằng thuộc tính `scale`; CSS áp `scale` trước `transform` nên nhân luôn toạ độ. Đổi sang thuộc tính `translate` (áp trước `scale`).
- [theme] Con trỏ tuỳ biến: khi rê nhanh vào link/nút (ví dụ menu header), vòng tròn bị phóng to và tô nền ngay lúc con trỏ gốc chạm link trong khi vòng còn ở chỗ trống phía sau. Nay trạng thái hover (phóng to, đổi màu trên nền tối) đi theo độ trễ của từng phần tử: vòng chỉ đổi khi nó tới nơi, dot đổi theo độ trễ của dot.
- [pricing] Local chỉ hiện khối CTA: WordPress cache danh sách pattern theo version theme, nên pattern mới thêm bằng `git pull` không được đăng ký. `functions.php` tự xóa cache khi danh sách hoặc thời gian sửa file trong `patterns/` đổi. Đã tái hiện và kiểm trên WordPress thật.
- [core] Ô nhiều dòng (mô tả gói) bị `sanitize_text_field` gộp thành một dòng khi lưu. Dùng `sanitize_textarea_field` cho ô loại textarea, cả ở REST lẫn meta box Classic Editor.
- [global] Dưới 1024px, 2 nút Bảng giá/Liên hệ ở header không ẩn (`.is-layout-flex` của core đè `display: none`), làm mọi trang tràn ngang trên mobile. Tăng độ ưu tiên selector. Phát hiện khi kiểm trang Bảng giá trên WordPress thật; ảnh hưởng cả trang chủ.
- [home] 4 card đánh số ở Why us bị trắng, chữ trắng trên nền trắng nên không đọc được: selector `.az-section .az-why-us .az-card` không khớp (cùng một phần tử). Đổi thành `.az-why-us .az-card`.
- [global] Header bị xuống dòng (logo "az-/media", menu hai hàng, nút gãy chữ) và nút Bảng giá/Liên hệ dành cho mobile hiện nhầm ở desktop.
- [theme] Khi plugin `az-media-core` chưa bật, Query Loop của core tự đổi post type về `post` nên Pricing/Testimonials hiện nhầm bài "Hello world". Thêm filter `query_loop_block_query_vars` để hiển thị rỗng, và admin notice nhắc bật plugin + chạy `wp az seed`.
- [core] CPT đặt `publicly_queryable` để Query Loop nhận đúng post type, không bật rewrite nên không sinh URL công khai.
- [theme] Chữ nhấn dùng token `accent-text` (`#1D4ED8`) thay vì `accent` để đạt WCAG AA (accent chỉ dùng cho nền, icon, trang trí).

### Removed
- [pricing] Phần bản dựng đầu tự thêm khi chưa có ảnh ref mà demo không có: breadcrumb, danh sách tính năng trong thẻ gói, bảng so sánh, FAQ về giá, CTA cuối. Gỡ pattern `az-page-hero`, `az-pricing-plans`, `az-compare`, `az-faq-pricing`, block `az-media/breadcrumb`, `az-media/plan-cards`, `az-media/plan-compare`, meta `az_features` và phần seed tương ứng.
- [home] Code slider testimonials trong `az.js` và CSS tương ứng (ref dùng lưới 3×2).
- [home] Ảnh `cta-visual.svg` (CTA của ref không có ảnh).
- [home] Icon +/- của accordion FAQ (ref không có).

### Known issues
- [global] Menu mobile mới chưa xem bằng trình duyệt thật (đã mô phỏng cascade CSS với CSS lõi WordPress): cần kiểm animation mở/đóng, cuộn trong ngăn kéo ở 844×390, focus bằng bàn phím, và khi đăng nhập có admin bar.
- [404-search] Chuỗi "Search results for", "Skip to content" phụ thuộc locale của WordPress. Cần đặt Cài đặt → Chung → Ngôn ngữ site = Tiếng Việt (hoặc Việt hóa cứng trong theme nếu muốn không phụ thuộc locale).
- [global] Các sửa mobile ở mục Fixed chưa kiểm bằng thiết bị thật: cần thử iPhone Safari (zoom khi focus), xoay ngang 844×390, 320px.
- [legal] Sau khi `git pull`: vào Công cụ → AZ Media Seed, bấm **Tạo dữ liệu mẫu** một lần để tạo trang `/legal/` và nâng cấp nội dung 3 văn bản; chưa bấm thì `/legal/` vẫn 404. Nếu trang pháp lý đã được sửa tay và đã xóa dòng nháp, nội dung mới sẽ KHÔNG tự thay; chép tay từ `includes/legal-content.php` nếu muốn.
- [legal] Các chỗ trong ngoặc vuông `[ ]` ở 3 văn bản (tên pháp nhân, mã số doanh nghiệp, địa chỉ, số tháng lưu trữ, số ngày hoàn tiền, tòa án) là PLACEHOLDER cần điền. Nếu thêm Google Analytics, Meta Pixel hoặc form thu thập dữ liệu mới thì phải cập nhật mục Cookie và Thông tin thu thập của Chính sách bảo mật.
- [legal] Nội dung 3 văn bản là bản nháp mẫu, cần rà soát pháp lý trước khi công bố (số ngày, tỷ lệ hoàn tiền, thông tin pháp nhân, email liên hệ). Chưa có ảnh ref nên bố cục theo cấu trúc đề xuất; chưa xem bằng trình duyệt/WordPress thật.
- [404-search] Chưa có ảnh ref; chưa xem bằng trình duyệt/WordPress thật (đặc biệt ô tìm kiếm, phân trang và `query-title` giữ từ khóa). Trang Blog (`06-blog`) chưa dựng nên link Blog dẫn tới trang danh sách bài viết mặc định.
- [contact] Chưa xem bằng trình duyệt/WordPress thật và chưa gửi thử form (đã kiểm thử hàm kiểm tra dữ liệu bằng PHP CLI, chưa chạy luồng gửi trong WordPress). Email, điện thoại, giờ làm việc, ảnh là PLACEHOLDER. Local WP mặc định không gửi được email: tin nhắn vẫn lưu ở menu Tin nhắn liên hệ. Chưa có reCAPTCHA/Turnstile.
- [maintenance] Chưa xem bằng trình duyệt/WordPress thật; chưa thử bật chế độ bảo trì với khách ẩn danh. Thời gian dự kiến, 3 bước tiến độ, email, điện thoại là nội dung mẫu cần sửa tay cho từng đợt bảo trì. Chưa có ô đăng ký nhận tin.
- [global] Header mới (nền mờ, bar dính) chưa xem bằng trình duyệt/WordPress thật: cần kiểm blur khi cuộn qua ảnh/khối đậm, menu mobile mở hết màn hình, bar 2 dòng trên mobile, và khi đăng nhập có admin bar.
- [about] Chưa xem bằng trình duyệt/WordPress thật (khoảng cách, typography, responsive 1200/1024/768/480). Ref dùng slider đội ngũ có chấm phân trang, bản dựng là lưới 2×2 tĩnh. Số liệu, tên thành viên, mô tả, ảnh là PLACEHOLDER.
- [service-detail] Bố cục theo plan đề xuất (không có ảnh ref). Chưa có form báo giá (chờ Contact Form 7 và trang Liên hệ). Nội dung dịch vụ là PLACEHOLDER.
- [services] Icon gán theo vị trí thẻ (6 icon xoay vòng), không theo từng dịch vụ; ảnh hai hàng xen kẽ là ảnh tạm; thẻ chưa có link tới trang chi tiết. Nội dung là PLACEHOLDER.
- [pricing] Mục 7 trong `02-pricing.md` còn vài hạng mục chờ so bằng mắt trên Local WP (khoảng cách, typography, responsive 1200/1024/768/480). Giá, mô tả, logo là PLACEHOLDER.
- [home] Toàn bộ số liệu, lời nhận xét, giá, logo, email, điện thoại là PLACEHOLDER, cần thay bằng dữ liệu thật trước khi public.
- [home] Layout đã làm lại theo ref nhưng chưa được xem bằng trình duyệt: các mục khoảng cách, typography, hover, responsive (đặc biệt 600–1023px) trong Design Fidelity Review của `01-home.md` còn để trống, chờ bạn xác nhận.
- [home] CTA vẫn giữ nút "Đặt lịch tư vấn" dù ref không có nút.

## [0.0.1] - 2026-11-17

### Added
- [docs] Khởi tạo repo: `.gitignore` dạng whitelist cho `wp-content`, `README.md`, `docs/plan.md`.
- [docs] Bổ sung nguồn tham chiếu thiết kế (demo Reachout) vào plan và README.
