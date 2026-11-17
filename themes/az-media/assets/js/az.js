/* AZ Media theme — az.js (không phụ thuộc thư viện ngoài) */
( function () {
	'use strict';

	var reduceMotion = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	function ready( fn ) {
		if ( document.readyState !== 'loading' ) { fn(); } else { document.addEventListener( 'DOMContentLoaded', fn ); }
	}

	/* Announcement bar: đóng và nhớ trạng thái. */
	function initAnnouncement() {
		var btn = document.querySelector( '.az-announcement__close' );
		if ( ! btn ) { return; }
		btn.addEventListener( 'click', function () {
			document.documentElement.classList.add( 'az-announce-closed' );
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

	/* Slider testimonials: scroll-snap + nút trước/sau + chấm. */
	function initSliders() {
		document.querySelectorAll( '.az-slider' ).forEach( function ( root ) {
			var track = root.querySelector( '.az-slider__track' );
			if ( ! track ) { return; }
			var slides = Array.prototype.slice.call( track.children );
			if ( slides.length < 2 ) { return; }

			var nav = document.createElement( 'div' );
			nav.className = 'az-slider__nav';
			var prev = document.createElement( 'button' );
			prev.type = 'button'; prev.className = 'az-slider__btn'; prev.setAttribute( 'aria-label', 'Nhận xét trước' ); prev.textContent = '←';
			var next = document.createElement( 'button' );
			next.type = 'button'; next.className = 'az-slider__btn'; next.setAttribute( 'aria-label', 'Nhận xét tiếp theo' ); next.textContent = '→';
			var dots = document.createElement( 'div' );
			dots.className = 'az-slider__dots';
			nav.appendChild( prev ); nav.appendChild( dots ); nav.appendChild( next );
			root.appendChild( nav );

			var perView = 1, pages = 1;

			function metrics() {
				var w = slides[0].getBoundingClientRect().width || 1;
				perView = Math.max( 1, Math.round( track.clientWidth / w ) );
				pages = Math.ceil( slides.length / perView );
			}
			function stepPx() {
				var gap = parseFloat( getComputedStyle( track ).columnGap ) || 0;
				return slides[0].getBoundingClientRect().width + gap;
			}
			function buildDots() {
				dots.innerHTML = '';
				for ( var i = 0; i < pages; i++ ) {
					( function ( page ) {
						var d = document.createElement( 'button' );
						d.type = 'button'; d.className = 'az-slider__dot'; d.setAttribute( 'aria-label', 'Trang ' + ( page + 1 ) );
						d.addEventListener( 'click', function () { track.scrollTo( { left: page * perView * stepPx(), behavior: reduceMotion ? 'auto' : 'smooth' } ); } );
						dots.appendChild( d );
					} )( i );
				}
			}
			function update() {
				var maxScroll = track.scrollWidth - track.clientWidth - 2;
				var page = Math.min( pages - 1, Math.round( track.scrollLeft / ( stepPx() * perView ) ) );
				if ( track.scrollLeft >= maxScroll ) { page = pages - 1; }
				Array.prototype.forEach.call( dots.children, function ( d, i ) {
					if ( i === page ) { d.setAttribute( 'aria-current', 'true' ); } else { d.removeAttribute( 'aria-current' ); }
				} );
				prev.disabled = track.scrollLeft <= 2;
				next.disabled = track.scrollLeft >= maxScroll;
			}
			function go( dir ) {
				track.scrollBy( { left: dir * perView * stepPx(), behavior: reduceMotion ? 'auto' : 'smooth' } );
			}

			prev.addEventListener( 'click', function () { go( -1 ); } );
			next.addEventListener( 'click', function () { go( 1 ); } );
			track.addEventListener( 'scroll', function () { window.requestAnimationFrame( update ); }, { passive: true } );
			window.addEventListener( 'resize', function () { metrics(); buildDots(); update(); } );
			metrics(); buildDots(); update();
		} );
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
		initSliders();
		initFaq();
	} );
}() );
