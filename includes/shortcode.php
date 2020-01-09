<?php
/**
 * Shortcode
 *
 * @package SimpleCRM
 */

namespace SimpleCRM;

/**
 * Register assets.
 */
function enqueue_styles() {

	wp_register_style( 'simple-crm-main', SIMPLE_CRM_URL . '/assets/styles/main.css', false, SIMPLE_CRM_VERSION );
	wp_register_script( 'simple-crm-main', SIMPLE_CRM_URL . '/assets/scripts/main.js', array( 'jquery' ), SIMPLE_CRM_VERSION, true );

	wp_localize_script(
		'simple-crm-main',
		'wpApiSettings',
		array(
			'root' => esc_url_raw( rest_url() ),
		)
	);

}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_styles' );

/**
 * Generate Form Shortcode.
 *
 * @param array $atts Attributes.
 *
 * @return string
 */
function shortcode( $atts ) {

	// Attributes.
	$atts = shortcode_atts(
		array(
			'name'             => esc_html__( 'Name', 'simple-crm' ),
			'phone'            => esc_html__( 'Phone Number', 'simple-crm' ),
			'email'            => esc_html__( 'Email Address', 'simple-crm' ),
			'budget'           => esc_html__( 'Desired Budget', 'simple-crm' ),
			'msg'              => esc_html__( 'Message', 'simple-crm' ),
			'success'          => esc_html__( 'Success!', 'simple-crm' ),
			'rows'             => '5',
			'cols'             => '33',
			'name-maxlength'   => '50',
			'phone-maxlength'  => '20',
			'email-maxlength'  => '50',
			'budget-maxlength' => '10',
			'msg-maxlength'    => '180',
		),
		$atts,
		'simple_crm_form'
	);

	// Enqueue resources.
	wp_enqueue_script( 'simple-crm-main' );
	wp_enqueue_style( 'simple-crm-main' );

	// Return custom form code.
	$ouput = '
	<form class="simple-crm-form" action="#">
		<input type="hidden" name="creation_date" class="js-simple-crm-creation-date">
		<p>
			<label>' . $atts['name'] . '</label>
			<input type="text" name="name" class="js-simple-crm-name" required maxlength="' . $atts['name-maxlength'] . '">
		</p>
		<p>
			<label>' . $atts['phone'] . '</label>
			<input type="tel" name="phone" class="js-simple-crm-phone" required maxlength="' . $atts['phone-maxlength'] . '">
		</p>
		<p>
			<label>' . $atts['email'] . '</label>
			<input type="email" name="email" class="js-simple-crm-email" required maxlength="' . $atts['email-maxlength'] . '">
		</p>
		<p>
			<label>' . $atts['budget'] . '</label>
			<input type="text" name="budget" class="js-simple-crm-budget" required maxlength="' . $atts['budget-maxlength'] . '">
		</p>
		<p class="span-cols">
			<label>' . $atts['msg'] . '</label>
			<textarea name="msg" class="js-simple-crm-msg" rows="' . $atts['rows'] . '" cols="' . $atts['cols'] . '" required  maxlength="' . $atts['msg-maxlength'] . '"></textarea>
		</p>
		<p class="span-cols">
			<button type="submit">Submit</button>
		</p>
		<p class="js-simple-crm-loading span-cols">' . esc_html__( 'Loading...', 'simple-crm' ) . '</p>
		<p class="js-simple-crm-message success span-cols">' . $atts['success'] . '</p>
		<p class="js-simple-crm-message error span-cols"></p>
	</form>';

	return trim( $ouput );
}
add_shortcode( 'simple_crm_form', __NAMESPACE__ . '\shortcode' );
