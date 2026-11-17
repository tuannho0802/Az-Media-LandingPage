/**
 * Panel "Thông tin hiển thị" trong thanh bên phải của trình soạn thảo (tab Gói giá / Nhận xét).
 * Thay cho meta box ở đáy màn hình. Không cần build: dùng trực tiếp các biến toàn cục wp.*.
 * Danh sách ô nhập do PHP truyền vào qua window.azCoreFields (xem includes/editor-panel.php).
 */
( function ( wp ) {
	var el = wp.element.createElement;
	var useSelect = wp.data.useSelect;
	var useDispatch = wp.data.useDispatch;
	var Panel = ( wp.editor && wp.editor.PluginDocumentSettingPanel ) || ( wp.editPost && wp.editPost.PluginDocumentSettingPanel );
	var TextControl = wp.components.TextControl;
	var TextareaControl = wp.components.TextareaControl;
	var config = window.azCoreFields || {};

	if ( ! Panel ) {
		return;
	}

	function AzFieldsPanel() {
		var postType = useSelect( function ( select ) {
			return select( 'core/editor' ).getCurrentPostType();
		}, [] );
		var meta = useSelect( function ( select ) {
			return select( 'core/editor' ).getEditedPostAttribute( 'meta' ) || {};
		}, [] );
		var editPost = useDispatch( 'core/editor' ).editPost;
		var fields = config[ postType ];

		if ( ! fields || ! fields.length ) {
			return null;
		}

		return el(
			Panel,
			{ name: 'az-core-fields', title: 'Thông tin hiển thị', initialOpen: true, className: 'az-core-fields' },
			fields.map( function ( field ) {
				var Control = 'textarea' === field.type ? TextareaControl : TextControl;
				return el( Control, {
					key: field.key,
					label: field.label,
					placeholder: field.placeholder || '',
					value: meta[ field.key ] || '',
					rows: 'textarea' === field.type ? 4 : undefined,
					__nextHasNoMarginBottom: true,
					onChange: function ( value ) {
						var next = {};
						next[ field.key ] = value;
						editPost( { meta: next } );
					},
				} );
			} )
		);
	}

	wp.plugins.registerPlugin( 'az-core-fields', { render: AzFieldsPanel } );
} )( window.wp );
