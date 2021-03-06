/**
 * Custom License Control JS
 *
 * Adds Javascript for the Custom License Control in the Customizer.
 *
 * @package Dynamico Pro
 */

( function( wp, $ ) {
	/**
	 * The Customizer looks for wp.customizer.controlConstructor[type] functions
	 * where type == the type member of a WP_Customize_Control
	 */
	wp.customize.controlConstructor.dynamico_pro_license_key = wp.customize.Control.extend({
		/**
		 * This method is called when the control is ready to run.
		 */
		ready: function() {

			// Grab the bits of data from the title for specifying this control. this.container is a jQuery object of your container.
			var data = this.container.find( '.customize-license-control' ).data();

			// Use specific l10n data for this control where available.
			this.l10n = data.l10n;

			// Set License status.
			this.status = data.status;

			// Display License status.
			this.displayStatus( this.status );

			// Set up buttons.
			this.buttonContainer = this.container.find( '.actions' );
			this.buttonActivate = $( '<button type="button" class="button activate" title="' + this.l10n.activate + '">' + this.l10n.activate + '</button>' ).prependTo( this.buttonContainer );
			this.buttonDeactivate = $( '<button type="button" class="button deactivate" title="' + this.l10n.deactivate + '">' + this.l10n.deactivate + '</button>' ).prependTo( this.buttonContainer );

			// Display buttons.
			this.displayButtons( this.status );

			// Handy shortcut so we don't have to us _.bind every time we add a callback.
			_.bindAll( this, 'activateLicense', 'deactivateLicense', 'displayStatus', 'displayButtons' );

			this.buttonActivate.on( 'click', this.activateLicense );
			this.buttonDeactivate.on( 'click', this.deactivateLicense );
		},
		/**
		 * Display License Status
		 */
		displayStatus: function( status ) {
			var statusField = this.container.find( '.license-status' );
			var descField = this.container.find( '.license-description' );

			if ( 'valid' === status ) {
				statusField.html( '<span class="valid">' + this.l10n.valid + '</span>' );
				descField.html( this.l10n.valid_desc );
			} else if ( 'expired' === status ) {
				statusField.html( '<span class="expired">' + this.l10n.expired + '</span>' );
				descField.html( this.l10n.expired_desc );
			} else if ( 'invalid' === status ) {
				statusField.html( '<span class="invalid">' + this.l10n.invalid + '</span>' );
				descField.html( this.l10n.invalid_desc );
			} else {
				statusField.html( '<span class="inactive">' + this.l10n.inactive + '</span>' );
				descField.html( '' );
			}
		},
		/**
		 * Display Activate or Deactivate License button.
		 */
		displayButtons: function( status ) {
			var input = this.container.find( 'input' );

			if ( 'valid' === status ) {
				this.buttonActivate.hide();
				this.buttonDeactivate.show();
				input.prop( 'disabled', true );
			} else {
				this.buttonActivate.show();
				this.buttonDeactivate.hide();
				input.prop( 'disabled', false );
			}
		},
		/**
		 * Called when the "Activate License" link is clicked.
		 *
		 * @param  {object} event jQuery Event object from click event
		 */
		activateLicense: function( event ) {
			event.preventDefault();
			var button = this.buttonActivate;
			var statusField = this.container.find( '.license-status' );
			var key = this.container.find( 'input' ).val();
			var displayStatus = this.displayStatus;
			var displayButtons = this.displayButtons;

			// Turn off button.
			button.prop( 'disabled', true );

			// Set loading message.
			statusField.html( '<span class="loading">' + this.l10n.loading + '</span>' );

			// Check License Key.
			$.ajax({
				url: ajaxurl,
				data: {
					'action'     : 'themezee_activate_license',
					'license_key': key
				},
				success: function( data ) {
					// Update Status.
					displayStatus( data );
					displayButtons( data );
				},
				error: function( errorThrown ){
					console.log( errorThrown );
					statusField.html( '<span class="error">' + errorThrown.status + ': ' + errorThrown.statusText + '</span>' );
				},
				complete: function() {
					button.prop( 'disabled', false );
				}
			});
		},
		/**
		 * Called when the "Deactivate License" link is clicked.
		 *
		 * @param  {object} event jQuery Event object from click event
		 */
		deactivateLicense: function( event ) {
			event.preventDefault();
			var button = this.buttonDeactivate;
			var statusField = this.container.find( '.license-status' );
			var key = this.container.find( 'input' ).val();
			var displayStatus = this.displayStatus;
			var displayButtons = this.displayButtons;

			// Turn off button.
			button.prop( 'disabled', true );

			// Set loading message.
			statusField.html( '<span class="loading">' + this.l10n.loading + '</span>' );

			// Activate License Key.
			$.ajax({
				url: ajaxurl,
				data: {
					'action'     : 'themezee_deactivate_license',
					'license_key': key
				},
				success: function( data ) {
					// Update Status.
					displayStatus( data );
					displayButtons( data );
				},
				error: function( errorThrown ){
					console.log( errorThrown );
					statusField.html( '<span class="error">' + errorThrown.status + ': ' + errorThrown.statusText + '</span>' );
				},
				complete: function() {
					button.prop( 'disabled', false );
				}
			});
		},
	});
})( this.wp, jQuery );
