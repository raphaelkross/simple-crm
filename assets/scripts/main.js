/**
 * Simple CRM Script
 *
 * Add logic to submit our forms with AJAX.
 *
 */

jQuery( document ).ready( function( $ ) {
	$( '.simple-crm-form' ).on( 'submit', function( e ) {
		var _this = $( this );

		var loadingMsg   = _this.find( '.js-simple-crm-loading' );
		var successMsg   = _this.find( '.js-simple-crm-message.success' );
		var errorMsg     = _this.find( '.js-simple-crm-message.error' );
		var creationDate = _this.find( '.js-simple-crm-creation-date' );

		// Hide messages, show loading...
		function setAsLoading() {
			successMsg.hide();
			errorMsg.hide();
			loadingMsg.show();
		};

		// Display error.
		function setAsError( msg ) {
			successMsg.hide();
			loadingMsg.hide();
			errorMsg.html( msg );
			errorMsg.show();
		};

		// Display success.
		function setAsSuccess() {
			errorMsg.hide();
			loadingMsg.hide();
			successMsg.show();
		};

		e.preventDefault();

		setAsLoading();

		// Include current date.
		$.ajax({
			url: 'http://worldclockapi.com/api/json/utc/now',
			method: 'GET'
		}).done( function( data ) {

			// Add data to hidden field.
			creationDate.val( new Date( data.currentDateTime ) );

			// Do the request.
			$.ajax({
				url: wpApiSettings.root + 'simple-crm/v1/lead',
				method: 'POST',
				data: _this.serialize()
			}).done( function( data ) {

				// Display the messages returned.
				if ( data.success ) {
					setAsSuccess();
				} else {
					setAsError( data.error );
				}
			}).fail( function() {
				setAsError( 'Error during the request.' );
			});
		}).fail( function( error ) {
			setAsError( error );
		});
	});
});
