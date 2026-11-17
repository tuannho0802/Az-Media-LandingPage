( function ( wp ) {
	var el = wp.element.createElement;
	var useBlockProps = wp.blockEditor.useBlockProps;

	wp.blocks.registerBlockType( 'az-media/contact-form', {
		edit: function () {
			// Form thật chỉ hiển thị và gửi được ở trang ngoài site.
			return el( 'div', useBlockProps( { className: 'az-form' } ), 'Form liên hệ: họ tên, email, chủ đề, lời nhắn, nút Gửi (xem trên trang ngoài site)' );
		},
		save: function () {
			return null;
		},
	} );
} )( window.wp );
