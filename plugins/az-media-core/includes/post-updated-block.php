<?php
/**
 * Block az-media/post-updated + hàm hiển thị thời gian tương đối bằng tiếng Việt.
 *
 * @package az-media-core
 */

defined( 'ABSPATH' ) || exit;

/**
 * "vừa xong", "5 phút trước", "2 ngày trước"... từ một mốc thời gian (Unix timestamp UTC).
 *
 * @param int      $timestamp Mốc thời gian cần diễn đạt.
 * @param int|null $now       Thời điểm hiện tại (mặc định time()); tham số để kiểm thử.
 * @return string
 */
function az_core_time_ago_vi( $timestamp, $now = null ) {
	$now  = null === $now ? time() : (int) $now;
	$diff = $now - (int) $timestamp;
	if ( $diff < 60 ) {
		return 'vừa xong';
	}
	$units = array(
		array( 365 * DAY_IN_SECONDS, 'năm' ),
		array( 30 * DAY_IN_SECONDS, 'tháng' ),
		array( 7 * DAY_IN_SECONDS, 'tuần' ),
		array( DAY_IN_SECONDS, 'ngày' ),
		array( HOUR_IN_SECONDS, 'giờ' ),
		array( MINUTE_IN_SECONDS, 'phút' ),
	);
	foreach ( $units as $unit ) {
		if ( $diff >= $unit[0] ) {
			return (int) floor( $diff / $unit[0] ) . ' ' . $unit[1] . ' trước';
		}
	}
	return 'vừa xong';
}

add_action( 'init', function () {
	register_block_type( AZ_CORE_DIR . 'blocks/post-updated' );
} );
