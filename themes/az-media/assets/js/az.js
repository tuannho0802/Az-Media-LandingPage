/* AZ Media theme — az.js (không phụ thuộc thư viện ngoài) */
( function () {
	'use strict';

	var reduceMotion = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	function ready( fn ) {
		if ( document.readyState !== 'loading' ) { fn(); } else { document.addEventListener( 'DOMContentLoaded', fn ); }
	}

	/* Announcement bar: đo chiều cao bar để header dính ngay dưới bar (--az-announce-h). */
	function initAnnouncement() {
		var wrap = document.querySelector( '.az-announcement-wrap' );
		var root = document.documentElement;
		function measure() {
			/* Chỉ tính chiều cao bar khi nó thực sự dính (desktop); khi cuộn đi (mobile) thì header bám mép trên. */
			var sticky = wrap && window.getComputedStyle( wrap ).position === 'sticky';
			var h = sticky && wrap.offsetParent !== null ? wrap.offsetHeight : 0;
			root.style.setProperty( '--az-announce-h', h + 'px' );
		}
		if ( wrap ) {
			measure();
			window.addEventListener( 'resize', measure );
			if ( 'ResizeObserver' in window ) { new ResizeObserver( measure ).observe( wrap ); }
		}
	}

	/* Menu mobile: bấm vào vùng nền mờ ngoài ngăn kéo để đóng (core chỉ đóng bằng nút X hoặc Esc). */
	function initMobileMenu() {
		document.addEventListener( 'click', function ( e ) {
			var t = e.target;
			if ( ! t.classList || ! ( t.classList.contains( 'wp-block-navigation__responsive-container' ) || t.classList.contains( 'wp-block-navigation__responsive-close' ) ) ) { return; }
			var box = t.closest( '.wp-block-navigation__responsive-container' );
			var btn = box && box.classList.contains( 'is-menu-open' ) ? box.querySelector( '.wp-block-navigation__responsive-container-close' ) : null;
			if ( btn ) { btn.click(); }
		} );
	}

	/* Header: thêm class khi đã cuộn. */
	function initHeader() {
		var header = document.querySelector( '.az-site-header' );
		if ( ! header ) { return; }
		var ticking = false;
		function update() {
			header.classList.toggle( 'is-scrolled', window.scrollY > 8 );
			ticking = false;
		}
		window.addEventListener( 'scroll', function () {
			if ( ! ticking ) { ticking = true; window.requestAnimationFrame( update ); }
		}, { passive: true } );
		update();
	}

	/* Counter: đếm khi cuộn tới, chạy một lần. Bỏ qua animation nếu reduced-motion (giữ số cuối trong HTML). */
	function initCounters() {
		var nodes = document.querySelectorAll( '[data-az-count]' );
		if ( ! nodes.length || reduceMotion || ! ( 'IntersectionObserver' in window ) ) { return; }
		var fmt = new Intl.NumberFormat( 'vi-VN' );

		function run( el ) {
			var target = parseFloat( el.getAttribute( 'data-az-count' ) );
			var suffix = el.getAttribute( 'data-az-suffix' ) || '';
			if ( isNaN( target ) ) { return; }
			var duration = 1400;
			var start = null;
			function step( ts ) {
				if ( start === null ) { start = ts; }
				var p = Math.min( ( ts - start ) / duration, 1 );
				var eased = 1 - Math.pow( 1 - p, 3 );
				el.textContent = fmt.format( Math.round( target * eased ) ) + suffix;
				if ( p < 1 ) { window.requestAnimationFrame( step ); }
			}
			el.textContent = '0' + suffix;
			window.requestAnimationFrame( step );
		}

		var io = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( entry ) {
				if ( entry.isIntersecting ) { io.unobserve( entry.target ); run( entry.target ); }
			} );
		}, { threshold: 0.4 } );
		nodes.forEach( function ( n ) { io.observe( n ); } );
	}

	/* FAQ: chỉ mở một mục tại một thời điểm trong cùng danh sách. */
	function initFaq() {
		document.querySelectorAll( '.az-faq__list' ).forEach( function ( list ) {
			list.addEventListener( 'toggle', function ( e ) {
				if ( ! e.target.open ) { return; }
				list.querySelectorAll( 'details[open]' ).forEach( function ( d ) { if ( d !== e.target ) { d.open = false; } } );
			}, true );
		} );
	}

	/* Con trỏ tuỳ biến: con trỏ gốc (0ms) → dot (trễ 20ms) → vòng tròn (trễ 40ms).
	 * Độ trễ là trễ theo thời gian thực (nội suy trên lịch sử vị trí chuột), không phải easing,
	 * nên dot và vòng luôn đi đúng đường của con trỏ gốc. Chỉ bật với chuột (hover + pointer: fine). */
	function initCursor() {
		var DOT_DELAY = 120, RING_DELAY = 200; /* tổng độ trễ mong muốn (ms) so với con trỏ gốc */
		var DOT_EASE = 45, RING_EASE = 80;     /* hằng số làm mượt (ms): càng lớn càng "trôi" chậm, càng mượt */
		var fine = window.matchMedia && window.matchMedia( '(hover: hover) and (pointer: fine)' ).matches;
		if ( ! fine || reduceMotion ) { return; }

		var dot = document.createElement( 'div' );
		var ring = document.createElement( 'div' );
		dot.className = 'az-cursor az-cursor--dot';
		ring.className = 'az-cursor az-cursor--ring';
		dot.setAttribute( 'aria-hidden', 'true' );
		ring.setAttribute( 'aria-hidden', 'true' );
		document.body.appendChild( ring );
		document.body.appendChild( dot );

		var trail = []; /* { t, x, y, act, dark } theo thời gian tăng dần; act/dark là trạng thái hover tại thời điểm đó */
		var visible = false;
		var raf = 0;

		function at( time ) {
			var n = trail.length, i;
			if ( ! n ) { return null; }
			if ( time <= trail[ 0 ].t ) { return trail[ 0 ]; }
			if ( time >= trail[ n - 1 ].t ) { return trail[ n - 1 ]; }
			for ( i = n - 1; i > 0; i-- ) { if ( trail[ i - 1 ].t <= time ) { break; } }
			var a = trail[ i - 1 ], b = trail[ i ], k = ( time - a.t ) / ( b.t - a.t || 1 );
			return { x: a.x + ( b.x - a.x ) * k, y: a.y + ( b.y - a.y ) * k, act: a.act, dark: a.dark };
		}

		/* Dùng thuộc tính `translate` (không dùng `transform`): CSS áp translate TRƯỚC scale, nên vòng phóng to/thu nhỏ
		 * quanh tâm của nó. Nếu dùng `transform: translate3d`, scale sẽ nhân luôn cả toạ độ và đẩy vòng lệch khỏi con trỏ. */
		function place( node, x, y ) {
			node.style.translate = x.toFixed( 1 ) + 'px ' + y.toFixed( 1 ) + 'px';
		}

		/* Vị trí đang hiển thị. Mỗi khung hình đi một phần quãng đường tới mục tiêu (độ trễ thời gian),
		 * theo hàm mũ độc lập với fps nên chuyển động trôi mượt, tăng/giảm tốc dần thay vì bám sát tức thì. */
		var dotPos = null, ringPos = null, lastFrame = 0;
		var dotDark = false, ringDark = false, ringAct = false;

		function glide( pos, target, ease, dt ) {
			if ( ! target ) { return pos; }
			if ( ! pos ) { return { x: target.x, y: target.y }; }
			var k = 1 - Math.exp( -dt / ease );
			pos.x += ( target.x - pos.x ) * k;
			pos.y += ( target.y - pos.y ) * k;
			return pos;
		}

		function frame() {
			var now = performance.now();
			var dt = Math.min( now - ( lastFrame || now ), 50 );
			lastFrame = now;
			/* Làm mượt kiểu mũ tự nó trễ ~ bằng hằng số ease, nên trừ đi để tổng độ trễ vẫn đúng DOT_DELAY/RING_DELAY. */
			dotPos = glide( dotPos, at( now - Math.max( 0, DOT_DELAY - DOT_EASE ) ), DOT_EASE, dt );
			ringPos = glide( ringPos, at( now - Math.max( 0, RING_DELAY - RING_EASE ) ), RING_EASE, dt );
			if ( dotPos ) { place( dot, dotPos.x, dotPos.y ); }
			if ( ringPos ) { place( ring, ringPos.x, ringPos.y ); }
			/* Trạng thái hover cũng đi theo độ trễ của từng phần tử: vòng chỉ phóng to / đổi màu khi nó thật sự
			 * tới vị trí đó, không phải lúc con trỏ gốc vừa chạm vào link (lúc ấy vòng còn ở chỗ trống phía sau). */
			var ds = at( now - DOT_DELAY ), rs = at( now - RING_DELAY );
			if ( ds && ds.dark !== dotDark ) { dotDark = ds.dark; dot.classList.toggle( 'is-dark', dotDark ); }
			if ( rs && rs.dark !== ringDark ) { ringDark = rs.dark; ring.classList.toggle( 'is-dark', ringDark ); }
			if ( rs && rs.act !== ringAct ) { ringAct = rs.act; ring.classList.toggle( 'is-active', ringAct ); }
			/* Giữ lại 1 mẫu cũ hơn mốc trễ lớn nhất để còn nội suy. */
			while ( trail.length > 2 && trail[ 1 ].t < now - RING_DELAY - 50 ) { trail.shift(); }
			raf = visible ? requestAnimationFrame( frame ) : 0;
		}

		function show( on ) {
			visible = on;
			dot.classList.toggle( 'is-visible', on );
			ring.classList.toggle( 'is-visible', on );
			if ( on && ! raf ) { raf = requestAnimationFrame( frame ); }
		}

		document.addEventListener( 'pointermove', function ( e ) {
			if ( e.pointerType && e.pointerType !== 'mouse' ) { return; }
			var t = performance.now();
			var el = e.target;
			var act = !! ( el.closest && el.closest( 'a, button, summary, label, input, textarea, select, [role="button"]' ) );
			var dark = !! ( el.closest && el.closest( '.az-why-us, .az-cta__box, .az-footer__bottom, .az-announcement-wrap' ) );
			if ( ! visible ) {
				/* Lần đầu hiện: đặt cả dot và vòng ngay tại con trỏ, tránh bay từ góc màn hình. */
				trail = [ { t: t - 500, x: e.clientX, y: e.clientY, act: act, dark: dark } ];
				dotPos = ringPos = null;
				dotDark = ringDark = ringAct = null; /* null ≠ boolean: ép frame() áp lại class đúng ngay khung đầu */
				lastFrame = 0;
				show( true );
			}
			/* Sau một lúc đứng yên, giữ nguyên vị trí và trạng thái cũ tới ngay trước sự kiện mới để dot/vòng không trượt sớm. */
			var last = trail[ trail.length - 1 ];
			if ( last && t - last.t > 40 ) { trail.push( { t: t - 1, x: last.x, y: last.y, act: last.act, dark: last.dark } ); }
			trail.push( { t: t, x: e.clientX, y: e.clientY, act: act, dark: dark } );
		}, { passive: true } );

		document.addEventListener( 'pointerdown', function () { ring.classList.add( 'is-down' ); } );
		document.addEventListener( 'pointerup', function () { ring.classList.remove( 'is-down' ); } );
		document.documentElement.addEventListener( 'mouseleave', function () { show( false ); } );
		document.addEventListener( 'visibilitychange', function () { if ( document.hidden ) { show( false ); } } );
	}

	/* Nút lên đầu trang (mọi trang): ẩn ở đầu trang, cuộn xuống một chút thì trượt vào từ góc phải,
	 * vòng ngoài được tô dần theo tiến độ cuộn. Bấm: cuộn mượt về đầu và trượt ra khuất góc phải,
	 * ở yên đó cho tới khi người dùng cuộn xuống lại. */
	function initBackToTop() {
		var SHOW_AFTER = 240; /* px cuộn tới đâu thì nút xuất hiện */
		var C = 2 * Math.PI * 21; /* chu vi vòng r=21 trong viewBox 48 */
		var btn = document.createElement( 'button' );
		btn.type = 'button';
		btn.className = 'az-top';
		btn.setAttribute( 'aria-label', 'Lên đầu trang' );
		btn.setAttribute( 'tabindex', '-1' );
		btn.innerHTML = '<svg class="az-top__ring" viewBox="0 0 48 48" aria-hidden="true" focusable="false">' +
			'<circle class="az-top__track" cx="24" cy="24" r="21"/>' +
			'<circle class="az-top__bar" cx="24" cy="24" r="21"/></svg>' +
			'<svg class="az-top__arrow" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="m6 15 6-6 6 6"/></svg>';
		document.body.appendChild( btn );
		var bar = btn.querySelector( '.az-top__bar' );
		bar.style.strokeDasharray = C.toFixed( 2 );

		var dismissed = false; /* true từ lúc bấm nút đến khi người dùng tự cuộn lại */
		var shown = false;
		var ticking = false;

		function update() {
			ticking = false;
			var y = window.pageYOffset || document.documentElement.scrollTop || 0;
			var max = Math.max( 1, document.documentElement.scrollHeight - window.innerHeight );
			bar.style.strokeDashoffset = ( C * ( 1 - Math.min( 1, Math.max( 0, y / max ) ) ) ).toFixed( 2 );
			if ( y < 8 ) { dismissed = false; }
			var want = y > SHOW_AFTER && ! dismissed;
			if ( want !== shown ) {
				shown = want;
				btn.classList.toggle( 'is-visible', want );
				btn.setAttribute( 'tabindex', want ? '0' : '-1' );
			}
		}

		function request() {
			if ( ! ticking ) { ticking = true; requestAnimationFrame( update ); }
		}

		window.addEventListener( 'scroll', request, { passive: true } );
		window.addEventListener( 'resize', request );

		/* Người dùng tự điều khiển cuộn (lăn chuột, chạm, phím) thì cho nút hiện lại như bình thường. */
		[ 'wheel', 'touchstart', 'keydown' ].forEach( function ( type ) {
			window.addEventListener( type, function () { if ( dismissed ) { dismissed = false; request(); } }, { passive: true } );
		} );

		btn.addEventListener( 'click', function () {
			dismissed = true;
			shown = false;
			btn.classList.remove( 'is-visible' );
			btn.setAttribute( 'tabindex', '-1' );
			btn.blur();
			window.scrollTo( { top: 0, behavior: reduceMotion ? 'auto' : 'smooth' } );
		} );

		update();
	}

	ready( function () {
		initAnnouncement();
		initHeader();
		initMobileMenu();
		initCounters();
		initFaq();
		initCursor();
		initBackToTop();
	} );
}() );
