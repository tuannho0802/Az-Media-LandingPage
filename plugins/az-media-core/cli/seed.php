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
		$this->seed_careers();
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
	private function upsert( $type, $title, $content, $excerpt, $order, $meta = array(), $terms = array(), $days_ago = 0 ) {
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
		$args = array(
			'post_type'    => $type,
			'post_title'   => $title,
			'post_content' => $content,
			'post_excerpt' => $excerpt,
			'post_status'  => 'publish',
			'menu_order'   => $order,
			'meta_input'   => $meta,
		);
		if ( $days_ago > 0 ) {
			// Bài mới tạo có post_modified = post_date, nên lùi ngày tạo là lùi luôn mốc "cập nhật" để demo thời gian tương đối.
			$args['post_date_gmt'] = gmdate( 'Y-m-d H:i:s', time() - (int) $days_ago * DAY_IN_SECONDS );
			$args['post_date']     = get_date_from_gmt( $args['post_date_gmt'] );
		}
		$id = wp_insert_post( $args, true );
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

	private function seed_careers() {
		$perks = array(
			'Lương cạnh tranh, xét tăng lương hai lần mỗi năm theo hiệu quả công việc.',
			'Thưởng dự án, thưởng tháng 13 và các dịp lễ, Tết.',
			'Bảo hiểm sức khỏe và khám sức khỏe định kỳ hằng năm.',
			'Làm việc linh hoạt, hỗ trợ ngân sách học tập và tham gia hội thảo ngành.',
		);
		$jobs  = array(
			array(
				'title'    => 'Chuyên viên chiến lược mạng xã hội',
				'excerpt'  => 'Bạn có năng khiếu xây dựng chiến lược mạng xã hội dựa trên dữ liệu, giúp tăng tương tác và thúc đẩy tăng trưởng? Bạn sẽ chịu trách nhiệm lên kế hoạch, triển khai và tối ưu các chiến dịch.',
				'salary'   => '18 - 28 triệu / tháng',
				'days_ago' => 2,
				'duties'   => array(
					'Xây dựng chiến lược và lịch nội dung theo từng nền tảng cho khách hàng.',
					'Phối hợp đội sáng tạo và đội quảng cáo để triển khai chiến dịch đúng tiến độ.',
					'Theo dõi số liệu, báo cáo hiệu quả định kỳ và đề xuất hướng tối ưu.',
					'Nghiên cứu xu hướng mạng xã hội và đối thủ để cập nhật cách làm mới.',
				),
				'reqs'     => array(
					'Ít nhất 2 năm kinh nghiệm làm mạng xã hội hoặc marketing nội dung.',
					'Hiểu rõ cơ chế hoạt động của Facebook, Instagram, TikTok.',
					'Tư duy dữ liệu, biết đọc báo cáo và rút ra nhận định.',
					'Kỹ năng trình bày và làm việc nhóm tốt.',
				),
			),
			array(
				'title'    => 'Quản lý tài khoản khách hàng',
				'excerpt'  => 'Chúng tôi tìm người đảm nhận vai trò đầu mối làm việc với khách hàng: hiểu mục tiêu, xây dựng chiến lược phù hợp và đảm bảo khách hàng hài lòng với dịch vụ của AZ Media.',
				'salary'   => '16 - 25 triệu / tháng',
				'days_ago' => 4,
				'duties'   => array(
					'Là đầu mối làm việc hằng ngày với khách hàng, nắm rõ mục tiêu và ngân sách.',
					'Chuyển yêu cầu của khách thành kế hoạch công việc cụ thể cho các đội nội bộ.',
					'Theo dõi tiến độ, chất lượng và xử lý phát sinh trong quá trình triển khai.',
					'Báo cáo kết quả và tư vấn hướng mở rộng hợp tác.',
				),
				'reqs'     => array(
					'Ít nhất 2 năm kinh nghiệm quản lý khách hàng tại agency hoặc đơn vị dịch vụ.',
					'Giao tiếp tốt, chủ động và có khả năng thuyết phục.',
					'Quản lý thời gian, đa nhiệm và làm việc dưới áp lực.',
					'Hiểu biết cơ bản về marketing số là lợi thế.',
				),
			),
			array(
				'title'    => 'Chuyên viên quảng cáo số',
				'excerpt'  => 'Bạn đam mê quảng cáo trả phí trên mạng xã hội? Bạn sẽ quản lý và tối ưu các chiến dịch quảng cáo để đạt hiệu quả đầu tư cao nhất và độ phủ tối đa cho khách hàng.',
				'salary'   => '15 - 22 triệu / tháng',
				'days_ago' => 6,
				'duties'   => array(
					'Lên kế hoạch, thiết lập và vận hành quảng cáo trên Meta, TikTok, Google.',
					'Tối ưu ngân sách, đối tượng và mẫu quảng cáo để cải thiện chi phí chuyển đổi.',
					'Thử nghiệm A/B thông điệp và hình ảnh, ghi lại bài học cho cả đội.',
					'Báo cáo hiệu quả quảng cáo theo tuần và theo tháng.',
				),
				'reqs'     => array(
					'Ít nhất 1 năm kinh nghiệm chạy quảng cáo trả phí.',
					'Thành thạo Meta Ads Manager và công cụ đo lường cơ bản.',
					'Tư duy số liệu, cẩn thận với ngân sách khách hàng.',
					'Chủ động học hỏi các định dạng và tính năng quảng cáo mới.',
				),
			),
			array(
				'title'    => 'Chuyên viên phân tích dữ liệu',
				'excerpt'  => 'Bạn giỏi đọc và phân tích số liệu? Hãy cùng chúng tôi đo lường, cải thiện hiệu quả chiến dịch bằng những nhận định và đề xuất giá trị từ dữ liệu.',
				'salary'   => '18 - 30 triệu / tháng',
				'days_ago' => 1,
				'duties'   => array(
					'Thu thập, làm sạch và tổng hợp dữ liệu từ các nền tảng quảng cáo và mạng xã hội.',
					'Xây dựng bảng điều khiển theo dõi hiệu quả cho từng khách hàng.',
					'Phân tích hành vi khán giả và đề xuất hướng tối ưu cho chiến dịch.',
					'Trình bày kết quả dễ hiểu cho đội nội bộ và khách hàng.',
				),
				'reqs'     => array(
					'Ít nhất 2 năm kinh nghiệm phân tích dữ liệu, ưu tiên lĩnh vực marketing.',
					'Thành thạo Excel hoặc Google Sheets, biết SQL hoặc công cụ BI.',
					'Tư duy logic, kể được câu chuyện bằng số liệu.',
					'Cẩn thận, có trách nhiệm với độ chính xác của số liệu.',
				),
			),
		);
		$deadline = wp_date( 'd/m/Y', time() + 45 * DAY_IN_SECONDS );
		foreach ( $jobs as $i => $j ) {
			$meta    = array(
				'az_job_type' => 'Toàn thời gian',
				'az_salary'   => $j['salary'],
				'az_location' => 'TP. Hồ Chí Minh',
				'az_deadline' => $deadline,
			);
			$content = $this->career_content( $j['duties'], $j['reqs'], $perks );
			$id      = $this->upsert( 'career', $j['title'], $content, $j['excerpt'], $i + 1, $meta, array(), $j['days_ago'] );
			if ( ! $id ) {
				continue;
			}
			// Vị trí đã seed từ trước: bổ sung phần còn thiếu, không đổi ngày tạo/sửa và không ghi đè nội dung đã chỉnh.
			foreach ( $meta as $key => $value ) {
				if ( '' === trim( (string) get_post_meta( $id, $key, true ) ) ) {
					update_post_meta( $id, $key, $value );
					$this->out( "Đã bổ sung thông tin ($key): [career] {$j['title']}" );
				}
			}
			$current = trim( (string) get_post_field( 'post_content', $id ) );
			if ( '' === $current || trim( wp_strip_all_tags( $current ) ) === $j['excerpt'] ) {
				global $wpdb;
				// Ghi thẳng vào DB để giữ nguyên post_modified (wp_update_post sẽ đặt lại thành "vừa xong").
				$wpdb->update( $wpdb->posts, array( 'post_content' => $content ), array( 'ID' => $id ) ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery
				clean_post_cache( $id );
				$this->out( "Đã điền nội dung chi tiết: [career] {$j['title']}" );
			}
		}
	}

	/**
	 * Nội dung chi tiết vị trí tuyển dụng: Mô tả công việc, Yêu cầu, Quyền lợi (block markup).
	 */
	private function career_content( $duties, $reqs, $perks ) {
		$list = function ( $items ) {
			$out = "<!-- wp:list -->\n<ul class=\"wp-block-list\">";
			foreach ( $items as $item ) {
				$out .= "<!-- wp:list-item -->\n<li>$item</li>\n<!-- /wp:list-item -->";
			}
			return $out . "</ul>\n<!-- /wp:list -->\n\n";
		};
		$heading = function ( $text ) {
			return "<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">$text</h2>\n<!-- /wp:heading -->\n\n";
		};
		return $heading( 'Mô tả công việc' ) . $list( $duties ) . $heading( 'Yêu cầu ứng viên' ) . $list( $reqs ) . $heading( 'Quyền lợi' ) . $list( $perks )
			. "<!-- wp:paragraph -->\n<p>Quan tâm vị trí này? Bấm Ứng tuyển ngay và gửi CV cùng thư giới thiệu ngắn cho chúng tôi.</p>\n<!-- /wp:paragraph -->";
	}

	/**
	 * Điền nội dung mẫu cho 3 trang pháp lý, gán template "Trang pháp lý" (page-legal) và gán template trang tổng /legal/.
	 * Chỉ ghi đè khi nội dung đang là bản trống, dòng "Trang đang được xây dựng", văn bản mẫu mặc định của WordPress,
	 * hoặc bản nháp mẫu của AZ Media còn nguyên dòng "Bản nháp mẫu (PLACEHOLDER)" (để nâng cấp lên bản nháp mới).
	 * Khi đã duyệt và xóa dòng nháp đó, seed không đụng tới nội dung nữa.
	 */
	private function seed_legal() {
		foreach ( az_core_legal_pages() as $slug => $content ) {
			$page = get_page_by_path( $slug );
			if ( ! $page ) {
				continue;
			}
			$current  = (string) $page->post_content;
			$is_stub  = '' === trim( wp_strip_all_tags( $current ) )
				|| false !== strpos( $current, 'Trang đang được xây dựng' )
				|| false !== strpos( $current, 'privacy-policy-tutorial' )
				|| false !== strpos( $current, az_core_legal_draft_mark() );
			// Bỏ qua khi đã giống hệt, để bấm seed nhiều lần không đổi ngày "Cập nhật lần cuối".
			if ( $is_stub && trim( $current ) !== trim( $content ) ) {
				wp_update_post( array( 'ID' => $page->ID, 'post_content' => $content ) );
				$this->out( "Đã điền nội dung mẫu: {$page->post_title} (/$slug/)" );
			}
			// Trang privacy-policy do WordPress tạo sẵn có tiêu đề tiếng Anh "Privacy Policy": đổi sang tiếng Việt (chỉ khi còn tiêu đề mặc định).
			if ( 'Privacy Policy' === $page->post_title ) {
				$labels = az_core_legal_docs();
				wp_update_post( array( 'ID' => $page->ID, 'post_title' => $labels[ $slug ]['label'] ?? $page->post_title ) );
				$this->out( "Đã đổi tiêu đề sang tiếng Việt: /$slug/" );
			}
			$template = get_post_meta( $page->ID, '_wp_page_template', true );
			if ( ! $template || 'default' === $template ) {
				update_post_meta( $page->ID, '_wp_page_template', 'page-legal' );
				$this->out( "Đã gán template Trang pháp lý: /$slug/" );
			}
		}

		// Trang tổng /legal/: liệt kê 3 văn bản. Gán template riêng để không bị nhận nhầm template page-legal theo slug.
		$hub = get_page_by_path( 'legal' );
		if ( $hub && 'page-legal-hub' !== get_post_meta( $hub->ID, '_wp_page_template', true ) ) {
			update_post_meta( $hub->ID, '_wp_page_template', 'page-legal-hub' );
			$this->out( 'Đã gán template Trang tổng pháp lý: /legal/' );
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
			'legal'            => 'Pháp lý',
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
			$content = in_array( $slug, array( 'home', 'legal' ), true ) ? '' : '<!-- wp:paragraph --><p>Trang đang được xây dựng.</p><!-- /wp:paragraph -->';
			$ids[ $slug ] = wp_insert_post( array(
				'post_type'    => 'page',
				'post_title'   => $title,
				'post_name'    => $slug,
				'post_status'  => 'publish',
				'post_content' => $content,
			) );
			$this->out( "Đã tạo trang: $title (/$slug/)" );
		}
		$this->seed_legal();
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $ids['home'] );
		update_option( 'page_for_posts', $ids['blog'] );
	}
}

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	WP_CLI::add_command( 'az seed', 'AZ_Core_Seed_Command' );
}
