<?php
/**
 * Dữ liệu mẫu: chạy bằng WP-CLI (`wp az seed`) hoặc trong wp-admin (Công cụ → AZ Media Seed).
 *
 * Tạo dữ liệu mẫu (idempotent, chạy nhiều lần không nhân đôi): gói giá, nhận xét, FAQ,
 * các trang rỗng để link menu không bị 404, đặt trang chủ tĩnh. Mọi nội dung là PLACEHOLDER của AZ Media,
 * cần thay bằng số liệu và lời nhận xét thật trước khi public.
 *
 * @package az-media-core
 */

defined( 'ABSPATH' ) || exit;

class AZ_Core_Seed_Command {

	/**
	 * Tạo dữ liệu mẫu cho site.
	 *
	 * ## EXAMPLES
	 *
	 *     wp az seed
	 *
	 * @param array $args       Positional args.
	 * @param array $assoc_args Flags.
	 */
	public function __invoke( $args, $assoc_args ) {
		$this->run();
		WP_CLI::success( 'Seed xong.' );
	}

	/**
	 * Các dòng nhật ký của lần chạy gần nhất (dùng cho trang wp-admin).
	 *
	 * @var string[]
	 */
	private $lines = array();

	/**
	 * Chạy toàn bộ seed. Dùng được cả trong WP-CLI lẫn wp-admin.
	 *
	 * @return string[] Nhật ký các việc đã làm.
	 */
	public function run() {
		$this->lines = array();
		$this->seed_plans();
		$this->seed_services();
		$this->seed_testimonials();
		$this->seed_team();
		$this->seed_faqs();
		$this->seed_pages();
		flush_rewrite_rules();
		return $this->lines;
	}

	/**
	 * Ghi nhật ký; có WP-CLI thì in ra terminal.
	 */
	private function out( $message, $level = 'log' ) {
		$this->lines[] = $message;
		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			'warning' === $level ? WP_CLI::warning( $message ) : WP_CLI::log( $message );
		}
	}

	/**
	 * Tạo bài nếu chưa có (so theo post_type + tiêu đề).
	 */
	private function upsert( $type, $title, $content, $excerpt, $order, $meta = array(), $terms = array() ) {
		$existing = get_posts( array(
			'post_type'   => $type,
			'title'       => $title,
			'post_status' => 'any',
			'numberposts' => 1,
			'fields'      => 'ids',
		) );
		if ( $existing ) {
			$this->out( "Bỏ qua (đã có): [$type] $title" );
			return (int) $existing[0];
		}
		$id = wp_insert_post( array(
			'post_type'    => $type,
			'post_title'   => $title,
			'post_content' => $content,
			'post_excerpt' => $excerpt,
			'post_status'  => 'publish',
			'menu_order'   => $order,
			'meta_input'   => $meta,
		), true );
		if ( is_wp_error( $id ) ) {
			$this->out( $id->get_error_message(), 'warning' );
			return 0;
		}
		foreach ( $terms as $taxonomy => $names ) {
			wp_set_object_terms( $id, $names, $taxonomy );
		}
		$this->out( "Đã tạo: [$type] $title" );
		return (int) $id;
	}

	private function seed_plans() {
		$plans = array(
			array(
				'Starter', 'Cho thương hiệu mới bắt đầu', '4.900.000đ', 'Quản trị 2 kênh, 12 bài nội dung mỗi tháng và báo cáo hiệu quả hằng tháng.',
			),
			array(
				'Standard', 'Cho thương hiệu đang tăng trưởng', '9.900.000đ', 'Quản trị 4 kênh, 24 bài nội dung, quảng cáo cơ bản và báo cáo hai tuần một lần.',
			),
			array(
				'Premium', 'Cho thương hiệu muốn dẫn đầu', '19.900.000đ', 'Chiến lược đa kênh, sản xuất video, quảng cáo nâng cao và một chuyên viên phụ trách riêng.',
			),
		);
		foreach ( $plans as $i => $p ) {
			$this->upsert( 'pricing_plan', $p[0], '', $p[1], $i + 1, array(
				'az_price'   => $p[2],
				'az_period'  => '/tháng',
				'az_summary' => $p[3],
			) );
		}
	}

	private function seed_services() {
		$items = array(
			array( 'Sáng tạo nội dung', 'Hình ảnh và nội dung thuyết phục, thu hút sự chú ý của khán giả mục tiêu.' ),
			array( 'Quản trị cộng đồng', 'Xây dựng kết nối thật với cộng đồng trực tuyến của thương hiệu.' ),
			array( 'Chiến lược mạng xã hội', 'Lộ trình rõ ràng cho từng nền tảng, bám sát mục tiêu kinh doanh.' ),
			array( 'Hợp tác người ảnh hưởng', 'Làm việc với người ảnh hưởng phù hợp để mở rộng độ phủ một cách tự nhiên.' ),
			array( 'Báo cáo và phân tích', 'Đo lường thành quả bằng số liệu rõ ràng để tối ưu từng chiến dịch.' ),
			array( 'Video marketing', 'Sản xuất video ngắn và dài giúp tăng tương tác và truyền tải thông điệp.' ),
		);
		foreach ( $items as $i => $s ) {
			$id = $this->upsert( 'service', $s[0], $this->service_content( $s[0] ), $s[1], $i + 1 );
			// Dịch vụ đã seed từ trước chưa có nội dung: chỉ điền khi đang trống, không ghi đè nội dung đã sửa.
			if ( $id && '' === trim( (string) get_post_field( 'post_content', $id ) ) ) {
				wp_update_post( array( 'ID' => $id, 'post_content' => $this->service_content( $s[0] ) ) );
				$this->out( "Đã điền nội dung mẫu: [service] {$s[0]}" );
			}
		}
	}

	/**
	 * Nội dung mẫu cho trang chi tiết dịch vụ (PLACEHOLDER): giới thiệu, lợi ích, quy trình.
	 * Lợi ích và quy trình nằm trong nội dung bài để biên tập viên sửa từng dịch vụ ngay trong trình soạn thảo.
	 */
	private function service_content( $title ) {
		$title    = esc_html( $title );
		$list     = static function ( $items, $ordered = false ) {
			$tag   = $ordered ? 'ol' : 'ul';
			$attrs = $ordered ? ' {"ordered":true}' : '';
			$out   = "<!-- wp:list$attrs -->\n<$tag class=\"wp-block-list\">";
			foreach ( $items as $item ) {
				$out .= "<!-- wp:list-item -->\n<li>$item</li>\n<!-- /wp:list-item -->";
			}
			return $out . "</$tag>\n<!-- /wp:list -->\n\n";
		};
		$content  = "<!-- wp:paragraph -->\n<p>Dịch vụ $title của AZ Media giúp thương hiệu của bạn có kế hoạch rõ ràng, triển khai nhất quán và đo được kết quả. Nội dung mẫu (PLACEHOLDER), cần thay bằng mô tả thật.</p>\n<!-- /wp:paragraph -->\n\n";
		$content .= "<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Lợi ích</h2>\n<!-- /wp:heading -->\n\n";
		$content .= $list( array( 'Kế hoạch bám sát mục tiêu kinh doanh', 'Một đầu mối làm việc xuyên suốt', 'Báo cáo minh bạch, số liệu rõ ràng' ) );
		$content .= "<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Quy trình thực hiện</h2>\n<!-- /wp:heading -->\n\n";
		$content .= $list( array( 'Tiếp nhận nhu cầu và mục tiêu', 'Đề xuất kế hoạch và báo giá', 'Triển khai và theo dõi', 'Báo cáo và tối ưu' ), true );
		return $content;
	}

	private function seed_team() {
		$items = array(
			array( 'Nguyễn Hoàng Long', 'Giám đốc sáng tạo', 'Long dẫn dắt định hướng hình ảnh và nội dung, biến ý tưởng thương hiệu thành những câu chuyện dễ nhớ. Hồ sơ mẫu (PLACEHOLDER).' ),
			array( 'Trần Thu Trang', 'Chuyên viên chiến lược', 'Trang xây dựng lộ trình nội dung cho từng nền tảng, bám sát mục tiêu kinh doanh của khách hàng. Hồ sơ mẫu (PLACEHOLDER).' ),
			array( 'Lê Minh Khoa', 'Chuyên viên quảng cáo', 'Khoa tối ưu ngân sách và đối tượng cho chiến dịch trả phí, ưu tiên kết quả đo được. Hồ sơ mẫu (PLACEHOLDER).' ),
			array( 'Phạm Ngọc Anh', 'Chuyên viên cộng đồng', 'Ngọc Anh chăm sóc cộng đồng, phản hồi nhanh và giữ giọng điệu thương hiệu nhất quán. Hồ sơ mẫu (PLACEHOLDER).' ),
		);
		foreach ( $items as $i => $m ) {
			$this->upsert( 'team_member', $m[0], '', $m[2], $i + 1, array( 'az_role' => $m[1] ) );
		}
	}

	private function seed_testimonials() {
		$items = array(
			array( 'Nguyễn Minh Anh', 'Giám đốc Marketing, Công ty A', 'NA', 'AZ Media giúp chúng tôi có kế hoạch nội dung rõ ràng và báo cáo dễ hiểu. Lượng tương tác tăng đều qua từng quý.' ),
			array( 'Trần Quốc Bảo', 'Nhà sáng lập, Thương hiệu B', 'QB', 'Đội ngũ phản hồi nhanh, hiểu giọng điệu thương hiệu và luôn đề xuất ý tưởng mới đúng thời điểm.' ),
			array( 'Lê Thu Hà', 'Trưởng phòng Truyền thông, Công ty C', 'TH', 'Chiến dịch quảng cáo được tối ưu liên tục, chi phí cho mỗi khách hàng tiềm năng giảm rõ rệt.' ),
			array( 'Phạm Đức Long', 'CEO, Startup D', 'DL', 'Chúng tôi chỉ cần một đầu mối làm việc, mọi thứ còn lại AZ Media lo từ chiến lược đến sản xuất.' ),
			array( 'Võ Ngọc Mai', 'Quản lý thương hiệu, Công ty E', 'NM', 'Nội dung video được làm chỉn chu, đúng định hướng và đạt hiệu quả vượt kỳ vọng ban đầu.' ),
			array( 'Đặng Hoàng Nam', 'Chủ cửa hàng, Thương hiệu F', 'HN', 'Báo cáo minh bạch, không số liệu ảo. Đó là lý do chúng tôi tiếp tục đồng hành lâu dài.' ),
		);
		foreach ( $items as $i => $t ) {
			$this->upsert( 'testimonial', $t[0], '', $t[3], $i + 1, array( 'az_role' => $t[1], 'az_initials' => $t[2] ) );
		}
	}

	private function seed_faqs() {
		$items = array(
			array( 'AZ Media cung cấp những dịch vụ nào?', 'Chúng tôi cung cấp chiến lược mạng xã hội, sản xuất nội dung, quảng cáo trả phí và báo cáo hiệu quả cho nhiều nền tảng.' ),
			array( 'Mất bao lâu để thấy kết quả?', 'Thường sau 4 đến 8 tuần bạn sẽ thấy xu hướng rõ ràng. Mức tăng trưởng bền vững cần kiên trì 3 đến 6 tháng.' ),
			array( 'Tôi có thể đổi gói dịch vụ giữa chừng không?', 'Có. Bạn có thể nâng hoặc hạ gói vào đầu mỗi chu kỳ thanh toán, chúng tôi sẽ điều chỉnh kế hoạch tương ứng.' ),
			array( 'AZ Media có làm việc với ngành của tôi không?', 'Chúng tôi làm việc với nhiều ngành. Hãy liên hệ để được tư vấn cách tiếp cận phù hợp với đặc thù của bạn.' ),
			array( 'Làm sao để bắt đầu hợp tác?', 'Bạn chỉ cần gửi form liên hệ hoặc đặt lịch tư vấn. Chúng tôi sẽ phản hồi trong vòng một ngày làm việc.' ),
			array( 'Vì sao nên chọn AZ Media cho nhu cầu marketing của tôi?', 'Chúng tôi kết hợp chiến lược, sáng tạo nội dung và số liệu thực tế, với một đầu mối phụ trách và báo cáo minh bạch hằng tuần.' ),
			array( 'AZ Media có làm việc với doanh nghiệp nhỏ không?', 'Có. Các gói dịch vụ được thiết kế linh hoạt cho cả doanh nghiệp nhỏ lẫn tập đoàn, bạn chọn quy mô phù hợp với ngân sách.' ),
			array( 'AZ Media đo lường hiệu quả chiến dịch như thế nào?', 'Chúng tôi thống nhất chỉ số ngay từ đầu (tiếp cận, tương tác, chuyển đổi) và gửi báo cáo định kỳ kèm đề xuất cải thiện.' ),
			array( 'AZ Media có hỗ trợ tái định vị hoặc ra mắt sản phẩm mới không?', 'Có. Chúng tôi xây dựng thông điệp, nội dung và kế hoạch phân phối cho giai đoạn tái định vị hoặc ra mắt sản phẩm.' ),
			array( 'Tôi có cần ký hợp đồng dài hạn không?', 'Không bắt buộc. Bạn có thể bắt đầu với chu kỳ ngắn, sau đó gia hạn hoặc điều chỉnh tùy theo kết quả đạt được.' ),
		);
		foreach ( $items as $i => $f ) {
			$this->upsert( 'faq', $f[0], '<p>' . $f[1] . '</p>', '', $i + 1, array(), array( 'faq_group' => array( 'Chung' ) ) );
		}
	}

	private function seed_pages() {
		$pages = array(
			'home'             => 'Trang chủ',
			'pricing'          => 'Bảng giá',
			'all-services'     => 'Dịch vụ',
			'about'            => 'Giới thiệu',
			'blog'             => 'Blog',
			'faqs'             => 'FAQs',
			'career'           => 'Tuyển dụng',
			'contact'          => 'Liên hệ',
			'maintenance-mode' => 'Bảo trì',
			'privacy-policy'   => 'Chính sách bảo mật',
			'terms'            => 'Điều khoản',
			'refund-policy'    => 'Chính sách hoàn tiền',
		);
		$ids = array();
		foreach ( $pages as $slug => $title ) {
			$page = get_page_by_path( $slug );
			if ( $page ) {
				$ids[ $slug ] = $page->ID;
				// WordPress tạo sẵn bản nháp privacy-policy; xuất bản để link chân trang không bị 404.
				if ( 'draft' === $page->post_status ) {
					wp_update_post( array( 'ID' => $page->ID, 'post_status' => 'publish' ) );
					$this->out( "Đã xuất bản bản nháp: {$page->post_title} (/$slug/)" );
				}
				continue;
			}
			$content = 'home' === $slug ? '' : '<!-- wp:paragraph --><p>Trang đang được xây dựng.</p><!-- /wp:paragraph -->';
			$ids[ $slug ] = wp_insert_post( array(
				'post_type'    => 'page',
				'post_title'   => $title,
				'post_name'    => $slug,
				'post_status'  => 'publish',
				'post_content' => $content,
			) );
			$this->out( "Đã tạo trang: $title (/$slug/)" );
		}
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $ids['home'] );
		update_option( 'page_for_posts', $ids['blog'] );
	}
}

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	WP_CLI::add_command( 'az seed', 'AZ_Core_Seed_Command' );
}
