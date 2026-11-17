# AZ Media – WordPress Theme & Core Plugin

Website marketing agency **AZ Media** dựng bằng WordPress (block theme), phát triển local bằng Local WP và deploy lên hosting qua FTP.

Repo này đặt tại thư mục `wp-content/` và chỉ theo dõi phần code tự phát triển. WordPress core, plugin bên thứ ba và `uploads` **không** nằm trong repo.

## Mục lục

- [Cấu trúc repo](#cấu-trúc-repo)
- [Yêu cầu môi trường](#yêu-cầu-môi-trường)
- [Chạy local](#chạy-local)
- [Phát triển theme](#phát-triển-theme)
- [Quy ước Git](#quy-ước-git)
- [Deploy lên FTP](#deploy-lên-ftp)
- [Dữ liệu và cấu hình môi trường](#dữ-liệu-và-cấu-hình-môi-trường)
- [Tài liệu](#tài-liệu)
- [Tham chiếu thiết kế](#tham-chiếu-thiết-kế)
- [Checklist trước khi release](#checklist-trước-khi-release)
- [Xử lý sự cố](#xử-lý-sự-cố)

## Cấu trúc repo

```
wp-content/                      ← gốc repo
├── .github/workflows/deploy.yml  # CI/CD deploy FTP
├── .gitignore                    # whitelist: chỉ track phần bên dưới
├── README.md
├── docs/                         # kế hoạch, design system, sitemap (KHÔNG deploy)
│   └── plan.md
├── themes/
│   └── az-media/                 # block theme
│       ├── style.css             # header theme + CSS bổ sung
│       ├── theme.json            # màu, font, spacing, layout
│       ├── functions.php
│       ├── templates/            # front-page, home, single, page, archive, search, 404
│       ├── parts/                # header, footer, announcement-bar
│       ├── patterns/             # hero, logos, why-us, pricing, testimonials, cta, faq...
│       ├── assets/               # css, js, img, fonts (font tự host)
│       └── inc/
└── plugins/
    └── az-media-core/            # CPT, taxonomy, meta fields
```

Những thứ **không** được track (do `.gitignore`): `uploads/`, `index.php`, theme mặc định, plugin bên thứ ba, cache, `node_modules/`, `.env`, log.

## Yêu cầu môi trường

| Công cụ | Phiên bản gợi ý |
|---|---|
| Local WP | bản mới nhất |
| PHP | 8.2 trở lên |
| MySQL | 8.0 |
| WordPress | 6.x (bản mới nhất ổn định) |
| Node.js | LTS (nếu theme có bước build) |
| Git | 2.x |

Plugin dùng trong dự án: Contact Form 7, Rank Math (hoặc Yoast SEO). Plugin dev: Query Monitor.

## Chạy local

1. Tạo site trong Local WP tên **az-media** (PHP 8.2+, MySQL 8, nginx).
2. Clone repo vào đúng vị trí `wp-content`. Nếu `wp-content` đã tồn tại, khởi tạo repo tại chỗ:

   ```bash
   cd "C:/Users/<user>/Local Sites/az-media/app/public/wp-content"
   git init
   git remote add origin <URL-repo>
   git fetch origin
   git checkout -f main
   ```

3. Cài plugin cần thiết từ wp-admin (Contact Form 7, Rank Math, Query Monitor).
4. Kích hoạt theme và plugin core:

   ```bash
   wp theme activate az-media
   wp plugin activate az-media-core contact-form-7
   ```

5. Đặt permalink dạng **Post name**:

   ```bash
   wp rewrite structure '/%postname%/' --hard
   ```

6. Bật debug trong `wp-config.php` (chỉ local):

   ```php
   define('WP_DEBUG', true);
   define('WP_DEBUG_LOG', true);
   define('WP_DEBUG_DISPLAY', false);
   ```

Lệnh `wp` chạy trong **Site Shell** của Local (chuột phải site, Open site shell).

## Phát triển theme

- Theme là **block theme**: giao diện nằm ở `theme.json`, `templates/`, `parts/`, `patterns/`.
- Mọi màu, font, spacing khai báo ở `theme.json` dưới dạng token. Không hard-code mã màu trong từng pattern.
- Bảng màu mặc định (xanh đậm), có thể điều chỉnh khi có logo chính thức:

  | Token | Giá trị |
  |---|---|
  | `--az-primary` | `#0A2A66` |
  | `--az-primary-dark` | `#06173D` |
  | `--az-accent` | `#2F6BFF` |
  | `--az-tint` | `#E8EEFB` |
  | `--az-text` | `#0F172A` |
  | `--az-muted` | `#475569` |
  | `--az-border` | `#E2E8F0` |

- Font tự host (woff2) trong `assets/fonts/`, dùng `font-display: swap`. Không tải font hay thư viện từ CDN.
- Mỗi section trang chủ là một pattern trong `patterns/` (ví dụ `az-hero`, `az-pricing`). Thêm trang mới bằng cách ghép pattern, không viết lại markup.
- Dữ liệu động (dịch vụ, bảng giá, FAQ, testimonial, đội ngũ, tuyển dụng) lấy từ CPT trong `plugins/az-media-core/`. Không để dữ liệu này trong theme, để đổi theme không mất nội dung.
- Responsive theo 4 breakpoint: 1200 / 1024 / 768 / 480.
- Tôn trọng `prefers-reduced-motion` cho counter, slider, animation.

### Build (nếu có)

```bash
cd themes/az-media
npm ci
npm run build      # output vào assets/dist/
```

Nếu `assets/dist/` nằm trong `.gitignore`, CI sẽ build trước khi deploy. Nếu bạn commit bản build, bỏ dòng ignore tương ứng.

## Quy ước Git

- Nhánh `main`: bản chạy thật (production).
- Nhánh `develop`: tích hợp. Tính năng mới tách từ `develop`: `feature/<tên>`, sửa lỗi: `fix/<tên>`.
- Commit theo dạng ngắn, rõ ràng, ví dụ:
  - `feat(theme): add hero pattern`
  - `fix(core): correct pricing_plan meta key`
  - `docs: update sitemap`
- Release bằng **tag** `vX.Y.Z` và cập nhật `Version` trong `themes/az-media/style.css` cho khớp.
- Không commit: `wp-config.php`, file `.env`, mật khẩu, khóa API, database dump, ảnh trong `uploads/`.

Kiểm tra trước khi push:

```bash
git status
git check-ignore -v <đường-dẫn>   # xem rule .gitignore nào đang áp dụng
```

## Deploy lên FTP

Deploy tự động bằng GitHub Actions, chỉ đẩy **các file thay đổi** (action lưu trạng thái lần deploy trước). Chỉ deploy khi gắn tag, tránh đẩy nhầm.

### Thiết lập một lần

1. Trong repo GitHub: Settings → Secrets and variables → Actions, thêm:
   - `FTP_HOST`
   - `FTP_USER`
   - `FTP_PASS`
2. Xác nhận đường dẫn thật của `wp-content` trên host (ví dụ `/public_html/wp-content/`) và chỉnh `server-dir` trong workflow cho khớp.
3. Ưu tiên FTPS hoặc SFTP nếu host hỗ trợ.

### Workflow mẫu `.github/workflows/deploy.yml`

```yaml
name: Deploy
on:
  push:
    tags: ['v*']

jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4

      # Bỏ bước này nếu theme chưa có build
      - uses: actions/setup-node@v4
        with:
          node-version: 'lts/*'
      - run: cd themes/az-media && npm ci && npm run build

      - uses: SamKirkland/FTP-Deploy-Action@v4.3.5
        with:
          server: ${{ secrets.FTP_HOST }}
          username: ${{ secrets.FTP_USER }}
          password: ${{ secrets.FTP_PASS }}
          local-dir: ./
          server-dir: /public_html/wp-content/
          exclude: |
            **/node_modules/**
            **/src/**
            .git*/**
            .github/**
            docs/**
            README.md
```

### Quy trình release

```bash
git checkout main
git merge develop
# cập nhật Version trong themes/az-media/style.css
git commit -am "chore: release v0.1.0"
git tag v0.1.0
git push origin main --tags
```

Push tag sẽ kích hoạt deploy. Theo dõi tại tab Actions trên GitHub.

### Những thứ KHÔNG đi theo deploy

- WordPress core: cài/cập nhật trên host.
- Plugin bên thứ ba: cài/cập nhật trong wp-admin trên host.
- `uploads/`: quản lý trực tiếp trên host.
- `wp-config.php`: giữ riêng trên server.
- `docs/` và `README.md`: bị loại bởi `exclude`. Tuyệt đối không upload tay thư mục `docs/` lên host vì sẽ truy cập được công khai.

### Rollback

Checkout tag cũ rồi chạy lại deploy (tạo tag mới trỏ vào commit cũ, hoặc chạy workflow thủ công nếu có `workflow_dispatch`):

```bash
git checkout v0.1.0
git tag v0.1.1-rollback
git push origin v0.1.1-rollback
```

## Dữ liệu và cấu hình môi trường

- **Database không đi theo git.** Sau khi site live, nội dung nằm trên production; không đẩy DB từ local đè lên.
- Chỉ dùng script seed (WP-CLI hoặc PHP) để dựng nội dung mẫu cho môi trường local hoặc lần dựng đầu tiên.
- Cấu hình riêng từng môi trường (DB, salt, debug) nằm trong `wp-config.php` trên từng máy, không commit.
- Khi chuyển site lần đầu từ local lên host, dùng All-in-One WP Migration hoặc Duplicator, sau đó đổi URL:

  ```bash
  wp search-replace 'http://az-media.local' 'https://<domain-that>' --all-tables
  ```

## Tài liệu

| File | Nội dung |
|---|---|
| `docs/az-media-wordpress-plan.md` | Kế hoạch dựng theme: kiến trúc, design system, đặc tả trang chủ, sitemap, lộ trình, checklist |
| `docs/pages/README.md` | Mục lục plan từng trang, thứ tự làm và quy trình review bám sát thiết kế |

Các tài liệu tách thêm về sau (`design-system.md`, `sitemap.md`) cũng đặt trong `docs/`.

## Tham chiếu thiết kế

Bố cục và cấu trúc trang tham chiếu từ theme **Reachout** (tác giả NexMotive). Chỉ tham chiếu cấu trúc; code, ảnh, logo và nội dung của AZ Media là tự thực hiện.

| Nguồn | URL | Ngày truy cập |
|---|---|---|
| Demo trang chủ (nguồn chính) | https://reachout.nexmotivedemo.com/ | 17/11/2026 |
| Preview ThemeForest | https://preview.themeforest.net/item/reachout-social-media-marketing-agency-wordpress-theme/full_screen_preview/55526756 | 17/11/2026 |
| Trang bán ThemeForest | https://themeforest.net/item/reachout-social-media-marketing-agency-wordpress-theme/55526756 | 17/11/2026 |

Các trang con của demo: `/pricing/`, `/all-services/`, `/about/`, `/blog/`, `/faqs/`, `/career/`, `/contact/`, `/maintenance-mode/` (ghép sau domain `https://reachout.nexmotivedemo.com`). Danh sách đầy đủ kèm ghi chú nằm ở `docs/plan.md`, mục 11.

Lưu ý:
- Demo có thể đổi hoặc bị gỡ. Nên lưu bản chụp full-page từng trang vào `docs/references/` để đối chiếu về sau.
- Giá trị màu, font trong repo là đề xuất cho AZ Media, không phải trích từ demo.

## Checklist trước khi release

- [ ] `git status` sạch, không có file ngoài whitelist.
- [ ] `Version` trong `style.css` đã tăng, khớp với tag.
- [ ] Build chạy thành công, không lỗi PHP trong `debug.log`.
- [ ] Kiểm tra responsive 1200 / 1024 / 768 / 480.
- [ ] Form liên hệ và tuyển dụng gửi được.
- [ ] Không còn nội dung hoặc tài sản mẫu của theme tham chiếu.
- [ ] Lighthouse (mobile) Performance, SEO, Accessibility từ 90 trở lên.
- [ ] Đã sao lưu site trên host trước khi deploy.

## Xử lý sự cố

| Vấn đề | Cách xử lý |
|---|---|
| File lạ xuất hiện trong `git status` | Chạy `git check-ignore -v <file>`, chỉnh lại `.gitignore` (whitelist theo từng cấp thư mục) |
| Đã lỡ commit file nặng hoặc bí mật | `git rm --cached <file>`, thêm vào `.gitignore`. Nếu là mật khẩu/khóa, **đổi ngay** vì đã nằm trong lịch sử |
| Deploy báo lỗi đăng nhập FTP | Kiểm tra lại 3 secret, thử FTPS/SFTP, kiểm tra tường lửa host |
| Deploy xong nhưng giao diện không đổi | Xóa cache plugin và cache trình duyệt, kiểm tra `server-dir` đúng chưa, kiểm tra `Version` trong `style.css` |
| Deploy chậm | Đảm bảo `exclude` đã loại `node_modules`, `src`, `docs`; chỉ gắn tag khi cần release |
| Permalink 404 trên host | Vào Settings → Permalinks và bấm Save để làm mới rewrite rules |