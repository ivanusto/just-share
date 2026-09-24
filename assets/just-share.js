/* Just Share: copy link and the system share sheet. The link buttons need no script. */
( function () {
	'use strict';

	function announce( button, text ) {
		var bar = button.closest( '.jsp-bar' );
		var status = bar && bar.querySelector( '.jsp-status' );
		if ( status ) {
			status.textContent = '';
			window.setTimeout( function () {
				status.textContent = text;
			}, 50 );
		}
	}

	function fallbackCopy( text ) {
		var area = document.createElement( 'textarea' );
		area.value = text;
		area.setAttribute( 'readonly', '' );
		area.style.position = 'fixed';
		area.style.opacity = '0';
		document.body.appendChild( area );
		area.select();
		var ok = false;
		try {
			ok = document.execCommand( 'copy' );
		} catch ( e ) {}
		document.body.removeChild( area );
		return ok;
	}

	function copied( button ) {
		button.classList.add( 'is-done' );
		announce( button, button.getAttribute( 'data-jsp-done' ) );
		window.setTimeout( function () {
			button.classList.remove( 'is-done' );
		}, 1600 );
	}

	document.addEventListener( 'click', function ( event ) {
		var copy = event.target.closest( '[data-jsp-copy]' );
		if ( copy ) {
			var url = copy.getAttribute( 'data-jsp-copy' );
			if ( navigator.clipboard && window.isSecureContext ) {
				navigator.clipboard.writeText( url ).then(
					function () {
						copied( copy );
					},
					function () {
						if ( fallbackCopy( url ) ) {
							copied( copy );
						}
					}
				);
			} else if ( fallbackCopy( url ) ) {
				copied( copy );
			}
			return;
		}

		var native = event.target.closest( '[data-jsp-native]' );
		if ( native && navigator.share ) {
			navigator
				.share( {
					title: native.getAttribute( 'data-jsp-title' ),
					url: native.getAttribute( 'data-jsp-native' ),
				} )
				.catch( function () {} );
		}
	} );

	if ( navigator.share ) {
		document.querySelectorAll( '.jsp-native' ).forEach( function ( item ) {
			item.hidden = false;
		} );
	}
} )();
