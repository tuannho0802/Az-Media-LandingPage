<?php
/**
 * Nội dung mẫu cho 3 trang pháp lý (Chính sách bảo mật, Điều khoản, Chính sách hoàn tiền), dạng block.
 *
 * Đây là BẢN NHÁP MẪU do AZ Media tự soạn để dựng giao diện, chưa qua rà soát pháp lý.
 * Cần AZ Media hoặc đơn vị tư vấn pháp lý xem lại (số ngày, tỷ lệ hoàn tiền, thông tin pháp nhân) trước khi công bố.
 *
 * @package az-media-core
 */

defined( 'ABSPATH' ) || exit;

/**
 * @return array<string, string> slug trang => nội dung block.
 */
function az_core_legal_pages() {
	$p = static function ( $text ) {
		return "<!-- wp:paragraph -->\n<p>$text</p>\n<!-- /wp:paragraph -->\n\n";
	};
	$h = static function ( $text ) {
		return "<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">$text</h2>\n<!-- /wp:heading -->\n\n";
	};
	$l = static function ( array $items ) {
		$out = "<!-- wp:list -->\n<ul class=\"wp-block-list\">";
		foreach ( $items as $item ) {
			$out .= "<!-- wp:list-item -->\n<li>$item</li>\n<!-- /wp:list-item -->";
		}
		return $out . "</ul>\n<!-- /wp:list -->\n\n";
	};
	$note    = $p( '<em>Bản nháp mẫu (PLACEHOLDER): nội dung do AZ Media soạn để dựng giao diện, cần được rà soát pháp lý trước khi công bố. Xóa đoạn này khi đã duyệt.</em>' );
	$contact = $p( 'Nếu có thắc mắc về văn bản này, vui lòng liên hệ AZ Media qua email <a href="mailto:hello@azmedia.example">hello@azmedia.example</a> hoặc trang <a href="/contact/">Liên hệ</a>.' );

	$privacy = $note
		. $p( 'Chính sách này giải thích cách AZ Media thu thập, sử dụng và bảo vệ thông tin của bạn khi truy cập website và sử dụng dịch vụ của chúng tôi.' )
		. $h( 'Thông tin chúng tôi thu thập' )
		. $l( array(
			'Thông tin bạn chủ động cung cấp: họ tên, email, chủ đề và nội dung khi gửi form liên hệ.',
			'Thông tin kỹ thuật: địa chỉ IP, loại trình duyệt, trang đã xem, ghi nhận qua nhật ký máy chủ và cookie.',
		) )
		. $h( 'Mục đích sử dụng' )
		. $l( array(
			'Phản hồi yêu cầu liên hệ và tư vấn dịch vụ.',
			'Vận hành, bảo mật và cải thiện website.',
			'Gửi thông tin liên quan khi bạn đồng ý nhận.',
			'Tuân thủ nghĩa vụ theo quy định pháp luật.',
		) )
		. $h( 'Chia sẻ thông tin' )
		. $p( 'AZ Media không bán thông tin cá nhân của bạn. Thông tin chỉ được chia sẻ với đơn vị cung cấp hạ tầng (lưu trữ, email) khi cần thiết để vận hành dịch vụ, hoặc theo yêu cầu hợp lệ của cơ quan có thẩm quyền.' )
		. $h( 'Lưu trữ và bảo mật' )
		. $p( 'Chúng tôi áp dụng các biện pháp kỹ thuật và quản lý hợp lý để bảo vệ thông tin, và chỉ lưu trong thời gian cần thiết cho các mục đích nêu trên.' )
		. $h( 'Cookie' )
		. $p( 'Website dùng cookie và bộ nhớ trình duyệt ở mức cần thiết để hoạt động (ví dụ ghi nhớ bạn đã đóng thông báo). Bạn có thể chặn hoặc xóa cookie trong cài đặt trình duyệt, một số tính năng có thể bị ảnh hưởng.' )
		. $h( 'Quyền của bạn' )
		. $p( 'Bạn có quyền yêu cầu truy cập, chỉnh sửa hoặc xóa thông tin cá nhân của mình, và rút lại sự đồng ý đã cung cấp, theo quy định pháp luật Việt Nam về bảo vệ dữ liệu cá nhân.' )
		. $h( 'Thay đổi chính sách' )
		. $p( 'Chúng tôi có thể cập nhật chính sách này. Ngày cập nhật gần nhất được hiển thị ở đầu trang.' )
		. $contact;

	$terms = $note
		. $p( 'Khi truy cập website hoặc sử dụng dịch vụ của AZ Media, bạn đồng ý với các điều khoản dưới đây.' )
		. $h( 'Phạm vi dịch vụ' )
		. $p( 'Nội dung, thời gian và chi phí của từng dịch vụ được xác định trong báo giá hoặc hợp đồng riêng giữa AZ Media và khách hàng. Thông tin trên website chỉ mang tính giới thiệu.' )
		. $h( 'Trách nhiệm của khách hàng' )
		. $l( array(
			'Cung cấp thông tin, tư liệu chính xác và kịp thời để chúng tôi triển khai.',
			'Bảo đảm có quyền hợp pháp đối với nội dung, hình ảnh, thương hiệu cung cấp cho AZ Media.',
			'Không dùng dịch vụ cho mục đích vi phạm pháp luật hoặc quy định của nền tảng mạng xã hội.',
		) )
		. $h( 'Thanh toán' )
		. $p( 'Khách hàng thanh toán theo lịch trong báo giá hoặc hợp đồng. AZ Media có quyền tạm dừng triển khai khi thanh toán bị chậm sau khi đã thông báo.' )
		. $h( 'Sở hữu trí tuệ' )
		. $p( 'Sản phẩm do AZ Media sản xuất được chuyển giao quyền sử dụng theo hợp đồng sau khi khách hàng thanh toán đầy đủ. Tư liệu do khách hàng cung cấp vẫn thuộc về khách hàng. Giao diện, mã nguồn và nội dung của website này thuộc AZ Media.' )
		. $h( 'Giới hạn trách nhiệm' )
		. $p( 'Chúng tôi nỗ lực đạt mục tiêu đã thống nhất nhưng không cam kết kết quả tuyệt đối vì hiệu quả marketing còn phụ thuộc thuật toán và chính sách của nền tảng thứ ba, thị trường và hành vi người dùng.' )
		. $h( 'Chấm dứt dịch vụ' )
		. $p( 'Mỗi bên có thể chấm dứt dịch vụ theo thời hạn báo trước ghi trong hợp đồng. Các khoản đã phát sinh trước thời điểm chấm dứt vẫn được thanh toán đầy đủ.' )
		. $h( 'Luật áp dụng' )
		. $p( 'Các điều khoản này được điều chỉnh bởi pháp luật Việt Nam. Tranh chấp được ưu tiên giải quyết bằng thương lượng, nếu không được thì đưa ra tòa án có thẩm quyền.' )
		. $contact;

	$refund = $note
		. $p( 'Chính sách này áp dụng cho các gói dịch vụ trả phí của AZ Media. Điều kiện cụ thể của từng hợp đồng (nếu có) được ưu tiên áp dụng.' )
		. $h( 'Điều kiện hoàn tiền' )
		. $l( array(
			'Chưa bắt đầu triển khai: hoàn toàn bộ phí đã thanh toán khi yêu cầu trong vòng 7 ngày kể từ ngày thanh toán.',
			'Đã bắt đầu triển khai: hoàn phần phí tương ứng với công việc chưa thực hiện.',
			'Dịch vụ không đúng cam kết trong hợp đồng và không được khắc phục sau khi đã thông báo: hai bên thương lượng mức hoàn tiền phù hợp.',
		) )
		. $h( 'Các khoản không hoàn' )
		. $l( array(
			'Ngân sách quảng cáo đã chi cho nền tảng.',
			'Sản phẩm đã được bàn giao và nghiệm thu.',
			'Chi phí đã trả cho bên thứ ba theo yêu cầu của khách hàng (diễn viên, địa điểm quay, bản quyền...).',
		) )
		. $h( 'Cách yêu cầu hoàn tiền' )
		. $p( 'Gửi email cho chúng tôi kèm tên khách hàng, mã hợp đồng hoặc báo giá và lý do yêu cầu. AZ Media phản hồi trong vòng 3 ngày làm việc.' )
		. $h( 'Thời gian hoàn tiền' )
		. $p( 'Sau khi hai bên thống nhất, khoản hoàn được chuyển trong vòng 14 ngày làm việc về tài khoản đã thanh toán.' )
		. $contact;

	return array(
		'privacy-policy' => $privacy,
		'terms'          => $terms,
		'refund-policy'  => $refund,
	);
}
