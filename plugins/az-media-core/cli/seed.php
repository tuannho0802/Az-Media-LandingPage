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
		$this->seed_testimonials();
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
				"Kênh quản trị: 2 kênh\nBài nội dung mỗi tháng: 12 bài\nBáo cáo hiệu quả: Hằng tháng\nHỗ trợ: Qua email",
			),
			array(
				'Standard', 'Cho thương hiệu đang tăng trưởng', '9.900.000đ', 'Quản trị 4 kênh, 24 bài nội dung, quảng cáo cơ bản và báo cáo hai tuần một lần.',
				"Kênh quản trị: 4 kênh\nBài nội dung mỗi tháng: 24 bài\nBáo cáo hiệu quả: Hai tuần một lần\nHỗ trợ: Email và chat\nQuảng cáo trả phí: Cơ bản",
			),
			array(
				'Premium', 'Cho thương hiệu muốn dẫn đầu', '19.900.000đ', 'Chiến lược đa kênh, sản xuất video, quảng cáo nâng cao và một chuyên viên phụ trách riêng.',
				"Kênh quản trị: Đa kênh\nBài nội dung mỗi tháng: 40 bài\nBáo cáo hiệu quả: Hằng tuần\nHỗ trợ: Ưu tiên\nQuảng cáo trả phí: Nâng cao\nSản xuất video\nChuyên viên phụ trách riêng",
			),
		);
		foreach ( $plans as $i => $p ) {
			$id = $this->upsert( 'pricing_plan', $p[0], '', $p[1], $i + 1, array(
				'az_price'    => $p[2],
				'az_period'   => '/tháng',
				'az_summary'  => $p[3],
				'az_features' => $p[4],
			) );
			// Site đã seed từ trước chưa có tính năng: bổ sung, nhưng không ghi đè nếu bạn đã tự nhập.
			if ( $id && '' === (string) get_post_meta( $id, 'az_features', true ) ) {
				update_post_meta( $id, 'az_features', $p[4] );
				$this->out( "Đã thêm tính năng cho gói: {$p[0]}" );
			}
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
		);
		foreach ( $items as $i => $f ) {
			$this->upsert( 'faq', $f[0], '<p>' . $f[1] . '</p>', '', $i + 1, array(), array( 'faq_group' => array( 'Chung' ) ) );
		}

		// FAQ riêng cho trang Bảng giá (nhóm "bang-gia"). menu_order từ 6 để không chen vào 5 câu đầu của trang chủ.
		if ( ! term_exists( 'bang-gia', 'faq_group' ) ) {
			wp_insert_term( 'Bảng giá', 'faq_group', array( 'slug' => 'bang-gia' ) );
		}
		$pricing = array(
			array( 'Giá trên trang đã bao gồm VAT chưa?', 'Giá hiển thị là giá trước thuế. Thuế VAT được cộng thêm theo quy định hiện hành và ghi rõ trong báo giá chính thức.' ),
			array( 'Ngân sách quảng cáo có nằm trong giá gói không?', 'Không. Giá gói là phí dịch vụ của AZ Media. Ngân sách chạy quảng cáo do bạn quyết định và thanh toán trực tiếp cho nền tảng.' ),
			array( 'Hợp đồng tối thiểu là bao lâu?', 'Thông thường là 3 tháng để có đủ thời gian đo lường và tối ưu. Điều khoản cụ thể sẽ được thống nhất trong hợp đồng.' ),
			array( 'Thanh toán theo hình thức nào?', 'Bạn thanh toán đầu mỗi chu kỳ bằng chuyển khoản. Chúng tôi xuất hóa đơn theo thông tin doanh nghiệp bạn cung cấp.' ),
			array( 'Tôi cần một gói riêng thì sao?', 'Hãy gửi yêu cầu qua trang Liên hệ. Chúng tôi sẽ đề xuất gói tùy chỉnh theo mục tiêu và ngân sách của bạn.' ),
		);
		foreach ( $pricing as $i => $f ) {
			$this->upsert( 'faq', $f[0], '<p>' . $f[1] . '</p>', '', $i + 6, array(), array( 'faq_group' => array( 'bang-gia' ) ) );
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
