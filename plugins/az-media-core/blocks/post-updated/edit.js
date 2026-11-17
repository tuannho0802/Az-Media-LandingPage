( function ( wp ) {
	var el = wp.element.createElement;
	var useBlockProps = wp.blockEditor.useBlockProps;

	wp.blocks.registerBlockType( 'az-media/post-updated', {
		edit: function () {
			// Thời gian thật chỉ có ở trang ngoài site (tính theo lần sửa gần nhất của từng bài).
			return el( 'div', useBlockProps( { className: 'az-job__updated' } ), 'Cập nhật 2 ngày trước (ví dụ)' );
		},
		save: function () {
			return null;
		},
	} );
} )( window.wp );
