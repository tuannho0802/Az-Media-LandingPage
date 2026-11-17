( function ( wp ) {
	var el = wp.element.createElement;
	var useBlockProps = wp.blockEditor.useBlockProps;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var PanelBody = wp.components.PanelBody;
	var RangeControl = wp.components.RangeControl;
	var TextControl = wp.components.TextControl;
	var SelectControl = wp.components.SelectControl;
	var ServerSideRender = wp.serverSideRender;

	wp.blocks.registerBlockType( 'az-media/faq-list', {
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
						{ title: 'Cài đặt FAQ' },
						el( RangeControl, {
							label: 'Số câu hỏi',
							min: 1,
							max: 20,
							value: attrs.limit,
							onChange: function ( v ) {
								props.setAttributes( { limit: v } );
							},
						} ),
						el( SelectControl, {
							label: 'Số cột',
							value: String( attrs.columns || 1 ),
							options: [
								{ label: '1 cột', value: '1' },
								{ label: '2 cột (trang FAQs)', value: '2' },
							],
							onChange: function ( v ) {
								props.setAttributes( { columns: parseInt( v, 10 ) } );
							},
						} ),
						el( TextControl, {
							label: 'Slug nhóm FAQ (tùy chọn)',
							value: attrs.group,
							onChange: function ( v ) {
								props.setAttributes( { group: v } );
							},
						} )
					)
				),
				el( ServerSideRender, { block: 'az-media/faq-list', attributes: attrs } )
			);
		},
		save: function () {
			return null;
		},
	} );
} )( window.wp );
