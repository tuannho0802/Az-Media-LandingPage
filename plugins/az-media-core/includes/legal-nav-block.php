<?php
/**
 * Block az-media/legal-nav: điều hướng giữa các văn bản pháp lý.
 *
 * - mode "tabs": thanh nút ở đầu mỗi văn bản (Tất cả | Chính sách bảo mật | Điều khoản | Chính sách hoàn tiền), đánh dấu trang đang xem.
 * - mode "cards": các thẻ lớn ở trang tổng /legal/, kèm mô tả và ngày cập nhật.
 * Chỉ liệt kê trang đã xuất bản, nên xóa hoặc chưa tạo một văn bản thì mục đó tự biến mất, không có link chết.
 *
 * @package az-media-core
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', function () {
	register_block_type( AZ_CORE_DIR . 'blocks/legal-nav' );
} );

/**
 * Danh sách văn bản pháp lý theo thứ tự hiển thị. Slug phải khớp với link ở chân trang và seed.
 *
 * @return array<string, array{label: string, desc: string}> slug => thông tin.
 */
function az_core_legal_docs() {
	return array(
		'privacy-policy' => array(
			'label' => 'Chính sách bảo mật',
			'desc'  => 'Chúng tôi thu thập, sử dụng và bảo vệ thông tin của bạn như thế nào, và quyền của bạn đối với dữ liệu cá nhân.',
		),
		'terms'          => array(
			'label' => 'Điều khoản',
			'desc'  => 'Quy định khi sử dụng website và dịch vụ của AZ Media: phạm vi dịch vụ, thanh toán, sở hữu trí tuệ, trách nhiệm.',
		),
		'refund-policy'  => array(
			'label' => 'Chính sách hoàn tiền',
			'desc'  => 'Khi nào được hoàn tiền, khoản nào không hoàn, cách gửi yêu cầu và thời gian xử lý.',
		),
	);
}

/**
 * Trang đã xuất bản theo slug, hoặc null.
 *
 * @param string $slug Slug trang.
 * @return WP_Post|null
 */
function az_core_published_page( $slug ) {
	$page = get_page_by_path( $slug );
	return ( $page && 'publish' === $page->post_status ) ? $page : null;
}
