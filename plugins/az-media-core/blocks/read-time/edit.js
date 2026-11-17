( function ( wp ) {
	var el = wp.element.createElement;
	var useBlockProps = wp.blockEditor.useBlockProps;

	wp.blocks.registerBlockType( 'az-media/read-time', {
		edit: function () {
			// Số phút thật chỉ có ở trang ngoài site (tính theo số từ của từng bài).
			return el( 'div', useBlockProps( { className: 'az-read-time' } ), '3 phút đọc (ví dụ)' );
		},
		save: function () {
			return null;
		},
	} );
} )( window.wp );
