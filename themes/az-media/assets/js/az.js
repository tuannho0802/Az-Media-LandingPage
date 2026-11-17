/* AZ Media theme — az.js (không phụ thuộc thư viện ngoài) */
( function () {
	'use strict';

	var reduceMotion = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	function ready( fn ) {
		if ( document.readyState !== 'loading' ) { fn(); } else { document.addEventListener( 'DOMContentLoaded', fn ); }
	}

	/* Announcement bar: đóng và nhớ trạng thái. Đo chiều cao bar để header dính ngay dưới bar (--az-announce-h). */
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
		var btn = document.querySelector( '.az-announcement__close' );
		if ( ! btn ) { return; }
		btn.addEventListener( 'click', function () {
			root.classList.add( 'az-announce-closed' );
			measure();
			try { localStorage.setItem( 'az_announce_closed', '1' ); } catch ( e ) { /* bỏ qua */ }
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

	ready( function () {
		initAnnouncement();
		initHeader();
		initCounters();
		initFaq();
	} );
}() );
