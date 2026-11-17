<?php
/**
 * Nội dung mẫu cho 3 trang pháp lý (Chính sách bảo mật, Điều khoản, Chính sách hoàn tiền), dạng block.
 *
 * Đây là BẢN NHÁP MẪU do AZ Media tự soạn để dựng giao diện, chưa qua rà soát pháp lý.
 * Cần AZ Media hoặc đơn vị tư vấn pháp lý xem lại (số ngày, tỷ lệ hoàn tiền, thông tin pháp nhân) trước khi công bố.
 * Phần mô tả dữ liệu thu thập, cookie, lưu trữ bám theo hành vi thật của website (form liên hệ, không có công cụ theo dõi,
 * phông chữ tự host). Nếu thêm Google Analytics, Meta Pixel hay form mới, phải cập nhật Chính sách bảo mật.
 *
 * @package az-media-core
 */

defined( 'ABSPATH' ) || exit;

/**
 * Chuỗi nhận diện bản nháp mẫu: seed chỉ thay nội dung khi trang vẫn còn dòng này (tức chưa được duyệt, chưa xóa ghi chú).
 *
 * @return string
 */
function az_core_legal_draft_mark() {
	return 'Bản nháp mẫu (PLACEHOLDER)';
}

/**
 * @return array<string, string> slug trang => nội dung block.
 */
function az_core_legal_pages() {
	$p  = static function ( $text ) {
		return "<!-- wp:paragraph -->\n<p>$text</p>\n<!-- /wp:paragraph -->\n\n";
	};
	$h  = static function ( $text ) {
		return "<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">$text</h2>\n<!-- /wp:heading -->\n\n";
	};
	$l  = static function ( array $items ) {
		$out = "<!-- wp:list -->\n<ul class=\"wp-block-list\">";
		foreach ( $items as $item ) {
			$out .= "<!-- wp:list-item -->\n<li>$item</li>\n<!-- /wp:list-item -->";
		}
		return $out . "</ul>\n<!-- /wp:list -->\n\n";
	};
	$ol = static function ( array $items ) {
		$out = "<!-- wp:list {\"ordered\":true} -->\n<ol class=\"wp-block-list\">";
		foreach ( $items as $item ) {
			$out .= "<!-- wp:list-item -->\n<li>$item</li>\n<!-- /wp:list-item -->";
		}
		return $out . "</ol>\n<!-- /wp:list -->\n\n";
	};

	$note    = $p( '<em>' . az_core_legal_draft_mark() . ': nội dung do AZ Media soạn để dựng giao diện, chưa qua rà soát pháp lý. Các chỗ trong ngoặc vuông [ ] là thông tin AZ Media cần điền hoặc xác nhận. Xóa đoạn này khi đã duyệt.</em>' );
	$contact = $p( 'Nếu có thắc mắc về văn bản này, vui lòng liên hệ AZ Media qua email <a href="mailto:hello@azmedia.example">hello@azmedia.example</a> hoặc trang <a href="/contact/">Liên hệ</a>.' );

	/* ---------------------------------------------------------------- Chính sách bảo mật */
	$privacy = $note
		. $p( 'Chính sách bảo mật này giải thích cách AZ Media thu thập, sử dụng, lưu trữ và bảo vệ thông tin cá nhân của bạn khi bạn truy cập website, liên hệ hoặc sử dụng dịch vụ của chúng tôi. Khi gửi thông tin cho chúng tôi, bạn xác nhận đã đọc và hiểu chính sách này.' )
		. $p( 'Chính sách được xây dựng theo quy định pháp luật Việt Nam về bảo vệ dữ liệu cá nhân, gồm Luật Bảo vệ dữ liệu cá nhân (có hiệu lực từ ngày 01/01/2026) và các văn bản hướng dẫn thi hành.' )
		. $h( 'Đơn vị xử lý dữ liệu' )
		. $p( 'Đơn vị quyết định mục đích và cách thức xử lý dữ liệu cá nhân trên website này là <strong>AZ Media</strong> ([tên pháp nhân đầy đủ], mã số doanh nghiệp [mã số], địa chỉ trụ sở [địa chỉ]). Thông tin liên hệ nằm ở cuối trang.' )
		. $h( 'Thông tin chúng tôi thu thập' )
		. $l( array(
			'<strong>Thông tin bạn gửi qua form Liên hệ:</strong> họ tên, email, chủ đề và lời nhắn (nếu bạn điền). Trang Tuyển dụng dùng chung form này, nên thông tin ứng tuyển bạn tự gửi cũng được xử lý như vậy.',
			'<strong>Thông tin bạn trao đổi trực tiếp:</strong> qua email, điện thoại hoặc buổi tư vấn, ví dụ thông tin doanh nghiệp, mục tiêu marketing, quyền quản trị kênh truyền thông khi hai bên triển khai dịch vụ.',
			'<strong>Dữ liệu kỹ thuật:</strong> địa chỉ IP, loại trình duyệt, thời gian và trang truy cập, do máy chủ lưu trữ website ghi nhận trong nhật ký hệ thống để vận hành và bảo mật.',
		) )
		. $p( 'Chúng tôi không chủ động thu thập dữ liệu cá nhân nhạy cảm qua website. Vui lòng không đưa thông tin như số căn cước, số tài khoản ngân hàng hay thông tin sức khỏe vào lời nhắn.' )
		. $h( 'Mục đích sử dụng thông tin' )
		. $l( array(
			'Phản hồi yêu cầu liên hệ, tư vấn và chuẩn bị báo giá.',
			'Ký kết và thực hiện hợp đồng dịch vụ, thanh toán, xuất hóa đơn.',
			'Đánh giá hồ sơ khi bạn quan tâm các vị trí tuyển dụng.',
			'Vận hành, bảo mật website và chống spam (ví dụ giới hạn số lần gửi form).',
			'Cải thiện nội dung và trải nghiệm trên website.',
			'Gửi thông tin giới thiệu dịch vụ, chỉ khi bạn đồng ý nhận.',
			'Tuân thủ nghĩa vụ theo quy định pháp luật.',
		) )
		. $h( 'Cơ sở xử lý dữ liệu' )
		. $p( 'Chúng tôi xử lý thông tin của bạn dựa trên sự đồng ý của bạn khi bấm gửi form liên hệ (bạn có thể rút lại bất kỳ lúc nào), để thực hiện yêu cầu của bạn trước khi hai bên giao kết hợp đồng, để thực hiện hợp đồng đã ký, và để tuân thủ nghĩa vụ pháp lý của AZ Media.' )
		. $h( 'Thời gian lưu trữ' )
		. $p( 'Tin nhắn liên hệ được lưu trong hệ thống quản trị website và hộp thư của AZ Media. Chúng tôi chỉ giữ thông tin trong thời gian cần thiết cho các mục đích nêu trên: [số tháng, ví dụ 24 tháng] kể từ lần liên hệ gần nhất nếu hai bên không ký hợp đồng. Với khách hàng đã ký hợp đồng, thời gian lưu theo hợp đồng và quy định pháp luật về kế toán, thuế. Hết thời hạn, thông tin được xóa hoặc ẩn danh.' )
		. $h( 'Chia sẻ thông tin' )
		. $p( 'AZ Media không bán thông tin cá nhân của bạn. Chúng tôi chỉ chia sẻ khi cần thiết, trong các trường hợp sau:' )
		. $l( array(
			'Đơn vị cung cấp hạ tầng (lưu trữ website, dịch vụ email) theo cam kết bảo mật.',
			'Đối tác hoặc nhân sự thực hiện dịch vụ cho dự án của bạn, chỉ ở mức thông tin cần cho công việc và dưới nghĩa vụ bảo mật.',
			'Cơ quan nhà nước có thẩm quyền, theo yêu cầu hợp pháp.',
		) )
		. $p( 'Nếu đơn vị cung cấp hạ tầng đặt máy chủ ngoài Việt Nam, chúng tôi thực hiện việc chuyển dữ liệu theo quy định pháp luật về chuyển dữ liệu cá nhân ra nước ngoài.' )
		. $h( 'Cookie và công nghệ theo dõi' )
		. $p( 'Hiện tại website này không dùng cookie quảng cáo và không gắn công cụ phân tích hay theo dõi hành vi của bên thứ ba. Phông chữ được lưu ngay trên website, nên trình duyệt của bạn không phải tải từ dịch vụ phông chữ bên ngoài.' )
		. $p( 'WordPress, nền tảng vận hành website, có thể đặt cookie kỹ thuật phục vụ đăng nhập cho quản trị viên; khách truy cập thông thường không bị ảnh hưởng. Form liên hệ dùng mã bảo mật, ô ẩn và giới hạn số lần gửi theo địa chỉ IP để chống spam; địa chỉ IP chỉ được lưu dưới dạng mã băm trong khoảng 1 giờ cho mục đích này.' )
		. $p( 'Các liên kết Facebook, Instagram, TikTok, LinkedIn ở chân trang dẫn sang website của bên thứ ba, chính sách bảo mật của họ áp dụng khi bạn truy cập. Nếu sau này chúng tôi thêm công cụ phân tích hoặc quảng cáo, mục này sẽ được cập nhật và chúng tôi sẽ xin sự đồng ý của bạn khi pháp luật yêu cầu.' )
		. $h( 'Bảo mật thông tin' )
		. $p( 'Chúng tôi áp dụng các biện pháp kỹ thuật và quản lý hợp lý như phân quyền truy cập, đặt mật khẩu mạnh, cập nhật phần mềm, sao lưu và mã hóa kết nối. Tuy vậy, không có phương thức truyền tải hay lưu trữ nào an toàn tuyệt đối. Khi xảy ra sự cố ảnh hưởng đến dữ liệu cá nhân, chúng tôi xử lý và thông báo theo quy định pháp luật.' )
		. $h( 'Quyền của bạn' )
		. $p( 'Theo quy định pháp luật về bảo vệ dữ liệu cá nhân, bạn có các quyền sau đối với dữ liệu của mình:' )
		. $l( array(
			'Được biết về việc chúng tôi xử lý dữ liệu của bạn.',
			'Đồng ý hoặc không đồng ý cho phép xử lý, và rút lại sự đồng ý đã cho.',
			'Truy cập, xem và yêu cầu chỉnh sửa dữ liệu của bạn.',
			'Yêu cầu cung cấp, xóa hoặc hạn chế xử lý dữ liệu; phản đối việc xử lý trong các trường hợp pháp luật cho phép.',
			'Khiếu nại, tố cáo hoặc khởi kiện theo quy định pháp luật.',
		) )
		. $p( 'Để thực hiện các quyền này, hãy gửi email cho chúng tôi kèm họ tên và địa chỉ email bạn đã dùng khi liên hệ. Chúng tôi có thể cần xác minh danh tính của bạn trước khi xử lý, và sẽ phản hồi trong thời hạn theo quy định pháp luật.' )
		. $h( 'Trẻ em' )
		. $p( 'Website không dành cho trẻ em. Nếu phát hiện đã thu thập dữ liệu của trẻ em mà không có sự đồng ý của cha mẹ hoặc người giám hộ, chúng tôi sẽ xóa dữ liệu đó.' )
		. $h( 'Thay đổi chính sách' )
		. $p( 'Chúng tôi có thể cập nhật chính sách này khi hoạt động của website hoặc quy định pháp luật thay đổi. Ngày cập nhật gần nhất được hiển thị ở đầu trang; thay đổi quan trọng sẽ được thông báo rõ trên website.' )
		. $contact;

	/* ---------------------------------------------------------------- Điều khoản */
	$terms = $note
		. $p( 'Khi truy cập website hoặc sử dụng dịch vụ của AZ Media, bạn đồng ý với các điều khoản dưới đây. Nếu không đồng ý, vui lòng ngừng sử dụng website và dịch vụ.' )
		. $h( 'Giải thích từ ngữ' )
		. $l( array(
			'<strong>AZ Media</strong>: đơn vị cung cấp dịch vụ marketing, sở hữu website này ([tên pháp nhân đầy đủ]).',
			'<strong>Khách hàng</strong>: tổ chức hoặc cá nhân sử dụng dịch vụ của AZ Media.',
			'<strong>Dịch vụ</strong>: các hạng mục chiến lược, nội dung, quảng cáo, báo cáo mà AZ Media thực hiện theo báo giá hoặc hợp đồng.',
			'<strong>Hợp đồng</strong>: báo giá đã được hai bên xác nhận hoặc hợp đồng dịch vụ ký giữa hai bên.',
		) )
		. $h( 'Phạm vi dịch vụ' )
		. $p( 'Nội dung, thời gian và chi phí của từng dịch vụ được xác định trong hợp đồng. Thông tin trên website, kể cả bảng giá và mô tả gói, chỉ mang tính giới thiệu. Khi có khác biệt, hợp đồng được ưu tiên áp dụng.' )
		. $h( 'Báo giá và hợp đồng' )
		. $ol( array(
			'Khách hàng gửi yêu cầu qua form Liên hệ hoặc kênh trao đổi khác.',
			'AZ Media tư vấn và gửi báo giá hoặc đề xuất hợp đồng.',
			'Hợp đồng có hiệu lực khi hai bên xác nhận bằng văn bản hoặc email.',
			'Thay đổi phạm vi công việc được hai bên thống nhất bằng văn bản và có thể làm thay đổi chi phí, thời gian.',
		) )
		. $h( 'Quy trình làm việc' )
		. $p( 'Hai bên thống nhất mục tiêu, kế hoạch nội dung và lịch báo cáo ngay từ đầu. Khách hàng duyệt nội dung trong thời gian thống nhất; nếu quá thời hạn mà không phản hồi, tiến độ có thể được điều chỉnh tương ứng. Số lần chỉnh sửa miễn phí cho mỗi sản phẩm là [số lần] trừ khi hợp đồng quy định khác.' )
		. $h( 'Trách nhiệm của khách hàng' )
		. $l( array(
			'Cung cấp thông tin, tư liệu chính xác và kịp thời để AZ Media triển khai.',
			'Bảo đảm có quyền hợp pháp đối với nội dung, hình ảnh, thương hiệu, tài khoản kênh truyền thông cung cấp cho AZ Media.',
			'Không dùng dịch vụ cho mục đích vi phạm pháp luật hoặc quy định của các nền tảng mạng xã hội.',
			'Cấp quyền truy cập kênh truyền thông ở mức cần thiết và tự bảo quản thông tin đăng nhập của mình.',
		) )
		. $h( 'Phí và thanh toán' )
		. $l( array(
			'Giá niêm yết là phí dịch vụ của AZ Media, chưa gồm thuế VAT; thuế được cộng thêm theo quy định và ghi rõ trong báo giá.',
			'Ngân sách chạy quảng cáo không nằm trong phí dịch vụ; khách hàng quyết định mức ngân sách và thanh toán trực tiếp cho nền tảng quảng cáo.',
			'Khách hàng thanh toán đầu mỗi chu kỳ theo lịch trong hợp đồng. Thời hạn hợp đồng tối thiểu thông thường là [3] tháng, theo thỏa thuận cụ thể.',
			'AZ Media có quyền tạm dừng triển khai khi thanh toán bị chậm sau khi đã thông báo.',
		) )
		. $h( 'Sở hữu trí tuệ' )
		. $p( 'Sản phẩm do AZ Media sản xuất cho khách hàng được chuyển giao quyền sử dụng theo hợp đồng sau khi khách hàng thanh toán đầy đủ. Tư liệu do khách hàng cung cấp vẫn thuộc về khách hàng. Giao diện, mã nguồn, văn bản, hình ảnh và nhãn hiệu của website này thuộc AZ Media, không được sao chép hay sử dụng cho mục đích thương mại khi chưa có sự đồng ý bằng văn bản. AZ Media có thể giới thiệu dự án đã thực hiện trong hồ sơ năng lực khi khách hàng không có yêu cầu bảo mật riêng.' )
		. $h( 'Bảo mật thông tin' )
		. $p( 'Hai bên giữ bí mật thông tin kinh doanh, tài khoản và số liệu của nhau biết được trong quá trình hợp tác, và chỉ dùng cho mục đích thực hiện hợp đồng. Nghĩa vụ này tiếp tục sau khi hợp đồng kết thúc, trừ thông tin đã công khai hợp pháp hoặc phải cung cấp theo yêu cầu của cơ quan có thẩm quyền. Việc xử lý dữ liệu cá nhân thực hiện theo <a href="/privacy-policy/">Chính sách bảo mật</a>.' )
		. $h( 'Sử dụng website' )
		. $p( 'Bạn đồng ý không dùng website để gửi nội dung rác hoặc độc hại, tìm cách truy cập trái phép vào hệ thống, thu thập dữ liệu hàng loạt hoặc gây ảnh hưởng đến hoạt động của website. Website có thể chứa liên kết tới trang bên thứ ba; AZ Media không chịu trách nhiệm về nội dung và chính sách của các trang đó.' )
		. $h( 'Giới hạn trách nhiệm' )
		. $p( 'AZ Media nỗ lực đạt mục tiêu đã thống nhất nhưng không cam kết kết quả tuyệt đối, vì hiệu quả marketing còn phụ thuộc thuật toán và chính sách của nền tảng bên thứ ba, thị trường và hành vi người dùng. Trong phạm vi pháp luật cho phép, trách nhiệm bồi thường của AZ Media không vượt quá tổng phí dịch vụ khách hàng đã thanh toán cho giai đoạn phát sinh sự việc.' )
		. $h( 'Sự kiện bất khả kháng' )
		. $p( 'Mỗi bên không chịu trách nhiệm về việc chậm hoặc không thực hiện nghĩa vụ do sự kiện bất khả kháng như thiên tai, dịch bệnh, sự cố hạ tầng mạng diện rộng, thay đổi chính sách của cơ quan nhà nước hoặc nền tảng. Bên bị ảnh hưởng phải thông báo kịp thời và nỗ lực hạn chế thiệt hại.' )
		. $h( 'Tạm ngừng và chấm dứt dịch vụ' )
		. $p( 'Mỗi bên có thể chấm dứt dịch vụ theo thời hạn báo trước ghi trong hợp đồng. AZ Media có quyền tạm ngừng hoặc chấm dứt dịch vụ khi khách hàng vi phạm nghiêm trọng điều khoản hoặc pháp luật. Các khoản đã phát sinh trước thời điểm chấm dứt vẫn được thanh toán đầy đủ; việc hoàn tiền (nếu có) thực hiện theo <a href="/refund-policy/">Chính sách hoàn tiền</a>.' )
		. $h( 'Luật áp dụng và giải quyết tranh chấp' )
		. $p( 'Các điều khoản này được điều chỉnh bởi pháp luật Việt Nam. Tranh chấp được ưu tiên giải quyết bằng thương lượng; nếu không đạt thỏa thuận, hai bên đưa ra tòa án có thẩm quyền tại [địa phương nơi AZ Media đặt trụ sở].' )
		. $h( 'Thay đổi điều khoản' )
		. $p( 'AZ Media có thể cập nhật điều khoản này. Ngày cập nhật gần nhất hiển thị ở đầu trang. Việc tiếp tục sử dụng website hoặc dịch vụ sau khi điều khoản thay đổi được hiểu là bạn chấp nhận nội dung mới; hợp đồng đã ký không bị thay đổi nếu hai bên chưa thỏa thuận.' )
		. $contact;

	/* ---------------------------------------------------------------- Chính sách hoàn tiền */
	$refund = $note
		. $p( 'Chính sách này áp dụng cho các gói dịch vụ trả phí của AZ Media. Điều kiện cụ thể của từng hợp đồng (nếu có) được ưu tiên áp dụng. Chúng tôi muốn việc hoàn tiền minh bạch, nên các quy định bên dưới được nêu rõ theo từng trường hợp.' )
		. $h( 'Nguyên tắc chung' )
		. $l( array(
			'Hoàn tiền tính trên <strong>phí dịch vụ</strong> khách hàng đã thanh toán cho AZ Media.',
			'Mỗi yêu cầu được xem xét dựa trên tiến độ công việc đã thực hiện và các cam kết ghi trong hợp đồng.',
			'Khoản hoàn được chuyển về đúng tài khoản đã dùng để thanh toán.',
		) )
		. $h( 'Các trường hợp được hoàn tiền' )
		. $l( array(
			'<strong>Chưa bắt đầu triển khai:</strong> hoàn toàn bộ phí đã thanh toán khi khách hàng yêu cầu trong vòng [7] ngày kể từ ngày thanh toán.',
			'<strong>Đã bắt đầu triển khai:</strong> hoàn phần phí tương ứng với khối lượng công việc chưa thực hiện, sau khi trừ phần công việc đã hoàn thành và bàn giao.',
			'<strong>Dịch vụ không đúng cam kết:</strong> khi dịch vụ không đạt các hạng mục đã ghi trong hợp đồng và không được khắc phục trong thời hạn hợp lý sau khi khách hàng thông báo, hai bên thương lượng mức hoàn tiền phù hợp.',
			'<strong>Thanh toán trùng hoặc nhầm:</strong> hoàn đủ khoản thanh toán thừa.',
		) )
		. $h( 'Các khoản không hoàn' )
		. $l( array(
			'Ngân sách quảng cáo đã chi cho nền tảng (Facebook, TikTok, Google...).',
			'Sản phẩm đã được bàn giao và nghiệm thu.',
			'Chi phí đã trả cho bên thứ ba theo yêu cầu của khách hàng, như diễn viên, địa điểm quay, bản quyền hình ảnh và âm nhạc.',
			'Yêu cầu hủy do khách hàng không cung cấp tư liệu, không phản hồi hoặc thay đổi mục tiêu sau khi công việc đã triển khai, trừ khi hợp đồng quy định khác.',
			'Kết quả kinh doanh không như kỳ vọng khi các hạng mục trong hợp đồng đã được thực hiện đầy đủ.',
		) )
		. $h( 'Cách yêu cầu hoàn tiền' )
		. $ol( array(
			'Gửi email cho chúng tôi kèm tên khách hàng, mã hợp đồng hoặc báo giá, ngày thanh toán và lý do yêu cầu.',
			'AZ Media xác nhận đã nhận yêu cầu và phản hồi trong vòng [3] ngày làm việc.',
			'Hai bên đối chiếu tiến độ công việc đã thực hiện và thống nhất số tiền hoàn.',
			'AZ Media thông báo kết quả bằng văn bản hoặc email, sau đó tiến hành hoàn tiền.',
		) )
		. $h( 'Cách tính số tiền hoàn' )
		. $p( 'Số tiền hoàn bằng phí đã thanh toán trừ phần phí tương ứng với công việc đã thực hiện. Ví dụ minh họa (số liệu giả định): khách hàng đã thanh toán 10.000.000đ cho một chu kỳ, yêu cầu dừng khi 40% khối lượng công việc đã thống nhất được hoàn thành, thì phần hoàn là 60%, tức 6.000.000đ.' )
		. $h( 'Thời gian hoàn tiền' )
		. $p( 'Sau khi hai bên thống nhất, khoản hoàn được chuyển trong vòng [14] ngày làm việc. Thời gian tiền về tài khoản có thể thêm vài ngày tùy ngân hàng. Nếu đã xuất hóa đơn, hai bên điều chỉnh hoặc thay thế hóa đơn theo quy định pháp luật về hóa đơn.' )
		. $h( 'Khiếu nại' )
		. $p( 'Nếu chưa đồng ý với kết quả xử lý, bạn có thể gửi khiếu nại qua email để chúng tôi xem xét lại. Trường hợp hai bên không thống nhất được, việc giải quyết tranh chấp thực hiện theo mục Luật áp dụng và giải quyết tranh chấp trong <a href="/terms/">Điều khoản</a>.' )
		. $contact;

	return array(
		'privacy-policy' => $privacy,
		'terms'          => $terms,
		'refund-policy'  => $refund,
	);
}
