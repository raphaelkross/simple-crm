/**
 * Simple CRM Script
 *
 * Add logic to submit our forms with AJAX.
 *
 */

jQuery( document ).ready( function( $ ) {
	$( '.simple-crm-form' ).on( 'submit', function( e ) {
		e.preventDefault();

		var _this = $( this );

		var loadingMsg = _this.find( '.js-simple-crm-loading' );
		var successMsg = _this.find( '.js-simple-crm-message.success' );
		var errorMsg   = _this.find( '.js-simple-crm-message.error' );

		// Hide messages, show loading...
		var setAsLoading = function() {
			successMsg.hide();
			errorMsg.hide();
			loadingMsg.show();
		}

		// Display error.
		var setAsError = function( msg ) {
			successMsg.hide();
			loadingMsg.hide();
			errorMsg.html( msg );
			errorMsg.show();
		}

		// Display success.
		var setAsSuccess = function() {
			errorMsg.hide();
			loadingMsg.hide();
			successMsg.show();
		}

		setAsLoading();

		// Do the request.
		$.ajax( {
			url: wpApiSettings.root + 'simple-crm/v1/lead',
			method: 'POST',
		} ).done( function ( data ) {
			// Display data in every wrapper we find.
			setAsSuccess();
		} ).fail(function( error ) {
			setAsError( error );
		});
	});
});
