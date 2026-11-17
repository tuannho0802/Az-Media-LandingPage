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
			var h = wrap && wrap.offsetParent !== null ? wrap.offsetHeight : 0;
			root.style.setProperty( '--az-announce-h', h + 'px' );
		}
		if ( wrap ) {
			measure();
			window.addEventListener( 'resize', measure );
			if ( 'ResizeObserver' in window ) { new ResizeObserver( measure ).observe( wrap ); }
		}
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
		var DOT_DELAY = 120, RING_DELAY = 200;
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

		var trail = []; /* { t, x, y } theo thời gian tăng dần */
		var visible = false;
		var raf = 0;

		function at( time ) {
			var n = trail.length, i;
			if ( ! n ) { return null; }
			if ( time <= trail[ 0 ].t ) { return trail[ 0 ]; }
			if ( time >= trail[ n - 1 ].t ) { return trail[ n - 1 ]; }
			for ( i = n - 1; i > 0; i-- ) { if ( trail[ i - 1 ].t <= time ) { break; } }
			var a = trail[ i - 1 ], b = trail[ i ], k = ( time - a.t ) / ( b.t - a.t || 1 );
			return { x: a.x + ( b.x - a.x ) * k, y: a.y + ( b.y - a.y ) * k };
		}

		function place( node, pos ) {
			if ( pos ) { node.style.transform = 'translate3d(' + pos.x.toFixed( 1 ) + 'px,' + pos.y.toFixed( 1 ) + 'px,0)'; }
		}

		function frame() {
			var now = performance.now();
			place( dot, at( now - DOT_DELAY ) );
			place( ring, at( now - RING_DELAY ) );
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
			if ( ! visible ) {
				/* Lần đầu hiện: đặt cả dot và vòng ngay tại con trỏ, tránh bay từ góc màn hình. */
				trail = [ { t: t - 200, x: e.clientX, y: e.clientY } ];
				show( true );
			}
			/* Sau một lúc đứng yên, giữ nguyên vị trí cũ tới ngay trước sự kiện mới để dot/vòng không trượt sớm. */
			var last = trail[ trail.length - 1 ];
			if ( last && t - last.t > 40 ) { trail.push( { t: t - 1, x: last.x, y: last.y } ); }
			trail.push( { t: t, x: e.clientX, y: e.clientY } );
			var el = e.target;
			var onLink = !! ( el.closest && el.closest( 'a, button, summary, label, input, textarea, select, [role="button"]' ) );
			var onDark = !! ( el.closest && el.closest( '.az-why-us, .az-cta__box, .az-footer__bottom, .az-announcement-wrap' ) );
			ring.classList.toggle( 'is-active', onLink );
			dot.classList.toggle( 'is-dark', onDark );
			ring.classList.toggle( 'is-dark', onDark );
		}, { passive: true } );

		document.addEventListener( 'pointerdown', function () { ring.classList.add( 'is-down' ); } );
		document.addEventListener( 'pointerup', function () { ring.classList.remove( 'is-down' ); } );
		document.documentElement.addEventListener( 'mouseleave', function () { show( false ); } );
		document.addEventListener( 'visibilitychange', function () { if ( document.hidden ) { show( false ); } } );
	}

	ready( function () {
		initAnnouncement();
		initHeader();
		initCounters();
		initFaq();
		initCursor();
	} );
}() );
