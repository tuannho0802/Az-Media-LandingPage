( function ( wp ) {
	var el = wp.element.createElement;
	var useBlockProps = wp.blockEditor.useBlockProps;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var PanelBody = wp.components.PanelBody;
	var SelectControl = wp.components.SelectControl;
	var ServerSideRender = wp.serverSideRender;

	wp.blocks.registerBlockType( 'az-media/legal-nav', {
		edit: function ( props ) {
			var attrs = props.attributes;
			return el(
				'div',
				useBlockProps(),
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: 'Cài đặt điều hướng pháp lý' },
						el( SelectControl, {
							label: 'Kiểu hiển thị',
							value: attrs.mode,
							options: [
								{ label: 'Thanh nút (đầu mỗi văn bản)', value: 'tabs' },
								{ label: 'Thẻ (trang tổng)', value: 'cards' },
							],
							onChange: function ( v ) {
								props.setAttributes( { mode: v } );
							},
						} )
					)
				),
				el( ServerSideRender, { block: 'az-media/legal-nav', attributes: attrs } )
			);
		},
		save: function () {
			return null;
		},
	} );
} )( window.wp );
