( function ( wp ) {
	var el = wp.element.createElement;
	var useBlockProps = wp.blockEditor.useBlockProps;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var PanelBody = wp.components.PanelBody;
	var RangeControl = wp.components.RangeControl;
	var ServerSideRender = wp.serverSideRender;

	wp.blocks.registerBlockType( 'az-media/plan-cards', {
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
						{ title: 'Cài đặt thẻ gói giá' },
						el( RangeControl, {
							label: 'Số gói hiển thị',
							min: 1,
							max: 6,
							value: attrs.limit,
							onChange: function ( v ) {
								props.setAttributes( { limit: v } );
							},
						} )
					)
				),
				el( ServerSideRender, { block: 'az-media/plan-cards', attributes: attrs } )
			);
		},
		save: function () {
			return null;
		},
	} );
} )( window.wp );
