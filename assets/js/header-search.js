/**
 * Header Search JS
 *
 * @package Dynamico Pro
 */

( function() {

	document.addEventListener( 'DOMContentLoaded', function() {

		// Find header search elements.
		var headerSearch = document.querySelector( '#main-navigation-wrap .header-search' );
		var searchIcon   = headerSearch.querySelector( '.header-search-icon' );
		var searchForm   = headerSearch.querySelector( '.header-search-form' );

		// Display Search Form when search icon is clicked.
		searchIcon.addEventListener( 'click', function() {
			searchIcon.classList.toggle( 'active' );
			searchForm.classList.toggle( 'toggled-on' );
			searchForm.querySelector( '.search-form .search-field' ).focus();
		});

		// Do not close search form if click is inside header search element.
		headerSearch.addEventListener( 'click', function(e) {
			e.stopPropagation();
		});

		// Close search form if click is outside header search element.
		document.addEventListener( 'click', function() {
			searchForm.classList.remove( 'toggled-on' );
		});
	} );

} )();
