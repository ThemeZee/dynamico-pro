/**
 * Customizer Preview JS
 *
 * Reloads changes on Theme Customizer Preview asynchronously for better usability
 *
 * @package Dynamico Pro
 */

( function( $ ) {

	/* Header Search checkbox */
	wp.customize( 'dynamico_theme_options[header_search]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				$( 'body' ).addClass( 'header-search-hidden' );
				$( 'body' ).removeClass( 'header-search-enabled' );
			} else {
				$( 'body' ).addClass( 'header-search-enabled' );
				$( 'body' ).removeClass( 'header-search-hidden' );
			}
		} );
	} );

	/* Author Bio checkbox */
	wp.customize( 'dynamico_theme_options[author_bio]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				$( 'body' ).addClass( 'author-bio-hidden' );
			} else {
				$( 'body' ).removeClass( 'author-bio-hidden' );
			}
		} );
	} );

	/* Primary Color Option */
	wp.customize( 'dynamico_theme_options[primary_color]', function( value ) {
		value.bind( function( newval ) {
			document.documentElement.style.setProperty( '--dynamico--primary-color', newval );
		} );
	} );

	/* Secondary Color Option */
	wp.customize( 'dynamico_theme_options[secondary_color]', function( value ) {
		value.bind( function( newval ) {
			document.documentElement.style.setProperty( '--dynamico--secondary-color', newval );
		} );
	} );

	/* Tertiary Color Option */
	wp.customize( 'dynamico_theme_options[tertiary_color]', function( value ) {
		value.bind( function( newval ) {
			document.documentElement.style.setProperty( '--dynamico--tertiary-color', newval );
		} );
	} );

	/* Contrast Color Option */
	wp.customize( 'dynamico_theme_options[contrast_color]', function( value ) {
		value.bind( function( newval ) {
			document.documentElement.style.setProperty( '--dynamico--contrast-color', newval );
		} );
	} );

	/* Accent Color Option */
	wp.customize( 'dynamico_theme_options[accent_color]', function( value ) {
		value.bind( function( newval ) {
			document.documentElement.style.setProperty( '--dynamico--accent-color', newval );
		} );
	} );

	/* Highlight Color Option */
	wp.customize( 'dynamico_theme_options[highlight_color]', function( value ) {
		value.bind( function( newval ) {
			document.documentElement.style.setProperty( '--dynamico--highlight-color', newval );
		} );
	} );

	/* Light Gray Color Option */
	wp.customize( 'dynamico_theme_options[light_gray_color]', function( value ) {
		value.bind( function( newval ) {
			document.documentElement.style.setProperty( '--dynamico--light-gray-color', newval );
		} );
	} );

	/* Gray Color Option */
	wp.customize( 'dynamico_theme_options[gray_color]', function( value ) {
		value.bind( function( newval ) {
			document.documentElement.style.setProperty( '--dynamico--gray-color', newval );
		} );
	} );

	/* Dark Gray Color Option */
	wp.customize( 'dynamico_theme_options[dark_gray_color]', function( value ) {
		value.bind( function( newval ) {
			document.documentElement.style.setProperty( '--dynamico--dark-gray-color', newval );
		} );
	} );

	/* Header Bar Color Option */
	wp.customize( 'dynamico_theme_options[header_bar_color]', function( value ) {
		value.bind( function( newval ) {
			var text_color;

			if( isColorLight( newval ) ) {
				text_color = '#151515';
			} else {
				text_color = '#fff';
			}

			document.documentElement.style.setProperty( '--dynamico--header-bar-background-color', newval );
			document.documentElement.style.setProperty( '--dynamico--header-bar-text-color', text_color );
		} );
	} );

	/* Header Bar Hover Color Option */
	wp.customize( 'dynamico_theme_options[header_bar_hover_color]', function( value ) {
		value.bind( function( newval ) {
			var text_color;

			if( isColorLight( newval ) ) {
				text_color = '#151515';
			} else {
				text_color = '#fff';
			}

			document.documentElement.style.setProperty( '--dynamico--header-bar-hover-color', newval );
			document.documentElement.style.setProperty( '--dynamico--header-bar-hover-text-color', text_color );
		} );
	} );

	/* Navigation Background Color Option */
	wp.customize( 'dynamico_theme_options[navi_color]', function( value ) {
		value.bind( function( newval ) {
			var text_color, hover_color;

			if( isColorLight( newval ) ) {
				text_color = '#151515';
				hover_color = 'rgba(0, 0, 0, 0.6)';
			} else {
				text_color = '#fff';
				hover_color = 'rgba(255, 255, 255, 0.6)';
			}

			document.documentElement.style.setProperty( '--dynamico--navi-background-color', newval );
			document.documentElement.style.setProperty( '--dynamico--featured-background-color', newval );
			document.documentElement.style.setProperty( '--dynamico--navi-text-color', text_color );
			document.documentElement.style.setProperty( '--dynamico--featured-text-color', text_color );
			document.documentElement.style.setProperty( '--dynamico--featured-hover-color', hover_color );
		} );
	} );

	/* Navigation Hover Color Option */
	wp.customize( 'dynamico_theme_options[navi_hover_color]', function( value ) {
		value.bind( function( newval ) {
			var text_color;

			if( isColorLight( newval ) ) {
				text_color = '#151515';
			} else {
				text_color = '#fff';
			}

			document.documentElement.style.setProperty( '--dynamico--navi-hover-color', newval );
			document.documentElement.style.setProperty( '--dynamico--featured-border-color', newval );
			document.documentElement.style.setProperty( '--dynamico--navi-hover-text-color', text_color );
		} );
	} );

	/* Link Color Option */
	wp.customize( 'dynamico_theme_options[link_color]', function( value ) {
		value.bind( function( newval ) {
			document.documentElement.style.setProperty( '--dynamico--link-color', newval );
			document.documentElement.style.setProperty( '--dynamico--link-hover-color', newval );
		} );
	} );

	/* Button Color Option */
	wp.customize( 'dynamico_theme_options[button_color]', function( value ) {
		value.bind( function( newval ) {
			var text_color;

			if( isColorLight( newval ) ) {
				text_color = '#151515';
			} else {
				text_color = '#fff';
			}

			document.documentElement.style.setProperty( '--dynamico--button-color', newval );
			document.documentElement.style.setProperty( '--dynamico--button-text-color', text_color );
		} );
	} );

	/* Button Color Hover Option */
	wp.customize( 'dynamico_theme_options[button_hover_color]', function( value ) {
		value.bind( function( newval ) {
			var text_color;

			if( isColorLight( newval ) ) {
				text_color = '#151515';
			} else {
				text_color = '#fff';
			}

			document.documentElement.style.setProperty( '--dynamico--button-hover-color', newval );
			document.documentElement.style.setProperty( '--dynamico--button-hover-text-color', text_color );
		} );
	} );

	/* Title Color Option */
	wp.customize( 'dynamico_theme_options[title_color]', function( value ) {
		value.bind( function( newval ) {
			document.documentElement.style.setProperty( '--dynamico--title-color', newval );
			document.documentElement.style.setProperty( '--dynamico--site-title-hover-color', newval );
		} );
	} );

	/* Title Hover Color Option */
	wp.customize( 'dynamico_theme_options[title_hover_color]', function( value ) {
		value.bind( function( newval ) {
			document.documentElement.style.setProperty( '--dynamico--title-hover-color', newval );
			document.documentElement.style.setProperty( '--dynamico--site-title-color', newval );
		} );
	} );

	/* Widget Title Color Option */
	wp.customize( 'dynamico_theme_options[widget_title_color]', function( value ) {
		value.bind( function( newval ) {
			var text_color;

			if( isColorLight( newval ) ) {
				text_color = '#151515';
			} else {
				text_color = '#fff';
			}

			document.documentElement.style.setProperty( '--dynamico--widget-title-background-color', newval );
			document.documentElement.style.setProperty( '--dynamico--widget-title-text-color', text_color );
		} );
	} );

	/* Footer Color Option */
	wp.customize( 'dynamico_theme_options[footer_color]', function( value ) {
		value.bind( function( newval ) {
			var overlay_color, text_color, link_color, link_hover_color, border_color;

			if( isColorLight( newval ) ) {
				overlay_color = 'rgba(0, 0, 0, 0.05)';
				text_color = '#151515';
				link_color = 'rgba(0, 0, 0, 0.6)';
				link_hover_color = 'rgba(0, 0, 0, 0.8)';
				border_color = 'rgba(0, 0, 0, 0.1)';
			} else {
				overlay_color = 'rgba(255, 255, 255, 0.05)';
				text_color = '#fff';
				link_color = 'rgba(255, 255, 255, 0.6)';
				link_hover_color = 'rgba(255, 255, 255, 0.8)';
				border_color = 'rgba(255, 255, 255, 0.1)';
			}

			document.documentElement.style.setProperty( '--dynamico--footer-widgets-background-color', newval );
			document.documentElement.style.setProperty( '--dynamico--footer-background-color', newval );
			document.documentElement.style.setProperty( '--dynamico--footer-widgets-overlay-color', overlay_color );
			document.documentElement.style.setProperty( '--dynamico--footer-widgets-text-color', text_color );
			document.documentElement.style.setProperty( '--dynamico--footer-widgets-link-color', link_color );
			document.documentElement.style.setProperty( '--dynamico--footer-widgets-link-hover-color', link_hover_color );
			document.documentElement.style.setProperty( '--dynamico--footer-widgets-border-color', border_color );
			document.documentElement.style.setProperty( '--dynamico--footer-widgets-title-color', border_color );
			document.documentElement.style.setProperty( '--dynamico--footer-overlay-color', overlay_color );
			document.documentElement.style.setProperty( '--dynamico--footer-text-color', link_color );
			document.documentElement.style.setProperty( '--dynamico--footer-link-color', text_color );
			document.documentElement.style.setProperty( '--dynamico--footer-link-hover-color', link_color );
			document.documentElement.style.setProperty( '--dynamico--footer-border-color', border_color );
		} );
	} );

	/* Text Font */
	wp.customize( 'dynamico_theme_options[text_font]', function( value ) {
		value.bind( function( newval ) {

			// Load Font in Customizer.
			loadCustomFont( newval, 'text-font' );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			document.documentElement.style.setProperty( '--dynamico--text-font', newFont );
		} );
	} );

	/* Title Font */
	wp.customize( 'dynamico_theme_options[title_font]', function( value ) {
		value.bind( function( newval ) {

			// Load Font in Customizer.
			loadCustomFont( newval, 'title-font' );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			document.documentElement.style.setProperty( '--dynamico--title-font', newFont );
		} );
	} );

	/* Title Font Weight */
	wp.customize( 'dynamico_theme_options[title_is_bold]', function( value ) {
		value.bind( function( newval ) {
			var fontWeight = newval ? 'bold' : 'normal';
			document.documentElement.style.setProperty( '--dynamico--title-font-weight', fontWeight );
		} );
	} );

	/* Title Text Transform */
	wp.customize( 'dynamico_theme_options[title_is_uppercase]', function( value ) {
		value.bind( function( newval ) {
			var textTransform = newval ? 'uppercase' : 'none';
			document.documentElement.style.setProperty( '--dynamico--title-text-transform', textTransform );
		} );
	} );

	/* Navi Font */
	wp.customize( 'dynamico_theme_options[navi_font]', function( value ) {
		value.bind( function( newval ) {

			// Load Font in Customizer.
			loadCustomFont( newval, 'navi-font' );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			document.documentElement.style.setProperty( '--dynamico--navi-font', newFont );
		} );
	} );

	/* Navi Font Weight */
	wp.customize( 'dynamico_theme_options[navi_is_bold]', function( value ) {
		value.bind( function( newval ) {
			var fontWeight = newval ? 'bold' : 'normal';
			document.documentElement.style.setProperty( '--dynamico--navi-font-weight', fontWeight );
		} );
	} );

	/* Navi Text Transform */
	wp.customize( 'dynamico_theme_options[navi_is_uppercase]', function( value ) {
		value.bind( function( newval ) {
			var textTransform = newval ? 'uppercase' : 'none';
			document.documentElement.style.setProperty( '--dynamico--navi-text-transform', textTransform );
		} );
	} );

	/* Widget Title Font */
	wp.customize( 'dynamico_theme_options[widget_title_font]', function( value ) {
		value.bind( function( newval ) {

			// Load Font in Customizer.
			loadCustomFont( newval, 'widget-title-font' );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			document.documentElement.style.setProperty( '--dynamico--widget-title-font', newFont );
		} );
	} );

	/* Widget Title Font Weight */
	wp.customize( 'dynamico_theme_options[widget_title_is_bold]', function( value ) {
		value.bind( function( newval ) {
			var fontWeight = newval ? 'bold' : 'normal';
			document.documentElement.style.setProperty( '--dynamico--widget-title-font-weight', fontWeight );
		} );
	} );

	/* Widget Title Text Transform */
	wp.customize( 'dynamico_theme_options[widget_title_is_uppercase]', function( value ) {
		value.bind( function( newval ) {
			var textTransform = newval ? 'uppercase' : 'none';
			document.documentElement.style.setProperty( '--dynamico--widget-title-text-transform', textTransform );
		} );
	} );

	function hexdec( hexString ) {
		hexString = ( hexString + '' ).replace( /[^a-f0-9]/gi, '' );
		return parseInt( hexString, 16 );
	}

	function getColorBrightness( hexColor ) {

		// Remove # string.
		hexColor = hexColor.replace( '#', '' );

		// Convert into RGB.
		var r = hexdec( hexColor.substring( 0, 2 ) );
		var g = hexdec( hexColor.substring( 2, 4 ) );
		var b = hexdec( hexColor.substring( 4, 6 ) );

		return ( ( ( r * 299 ) + ( g * 587 ) + ( b * 114 ) ) / 1000 );
	}

	function isColorLight( hexColor ) {
		return ( getColorBrightness( hexColor ) > 130 );
	}

	function isColorDark( hexColor ) {
		return ( getColorBrightness( hexColor ) <= 130 );
	}

	function loadCustomFont( font, type ) {
		var fontFile = font.split( " " ).join( "+" );
		var fontFileURL = "https://fonts.googleapis.com/css?family=" + fontFile + ":400,700";

		var fontStylesheet = "<link id='dynamico-pro-custom-" + type + "' href='" + fontFileURL + "' rel='stylesheet' type='text/css'>";
		var checkLink = $( "head" ).find( "#dynamico-pro-custom-" + type ).length;

		if (checkLink > 0) {
			$( "head" ).find( "#dynamico-pro-custom-" + type ).remove();
		}
		$( "head" ).append( fontStylesheet );
	}

} )( jQuery );
