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
	wp_register_script( 'simple-crm-main', SIMPLE_CRM_URL . '/assets/scripts/main.js', array( 'jquery' ), '1.0', true );

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
			'name'    => esc_html__( 'Name', 'simple-crm' ),
			'phone'   => esc_html__( 'Phone Number', 'simple-crm' ),
			'email'   => esc_html__( 'Email Address', 'simple-crm' ),
			'budget'  => esc_html__( 'Desired Budget', 'simple-crm' ),
			'msg'     => esc_html__( 'Message', 'simple-crm' ),
			'success' => esc_html__( 'Success!', 'simple-crm' ),
			'rows'    => '5',
			'cols'    => '33',
		),
		$atts,
		'simple_crm_form'
	);

	// Enqueue resources.
	wp_enqueue_script( 'simple-crm-main' );
	wp_enqueue_style( 'simple-crm-main' );

	// Return custom form code.
	return '
	<form class="simple-crm-form" action="#">
		<p>
			<label>' . $atts['name'] . '</label><br>
			<input type="text" name="name" class="js-simple-crm-name">
		</p>
		<p>
			<label>' . $atts['phone'] . '</label><br>
			<input type="tel" name="phone" class="js-simple-crm-phone">
		</p>
		<p>
			<label>' . $atts['email'] . '</label><br>
			<input type="email" name="email" class="js-simple-crm-email">
		</p>
		<p>
			<label>' . $atts['budget'] . '</label><br>
			<input type="text" name="budget" class="js-simple-crm-budget">
		</p>
		<p>
			<label>' . $atts['msg'] . '</label><br>
			<textarea name="msg" class="js-simple-crm-msg" rows="' . $atts['rows'] . '" cols="' . $atts['cols'] . '"></textarea>
		</p>
		<p>
			<button type="submit">Submit</button>
		</p>
		<p class="js-simple-crm-loading>' . esc_html__( 'Loading...', 'simple-crm' ) . '<p>
		<p class="message success">' . $atts['success'] . '<p>
		<p class="message error">
			Error 1<br>
			Error 2<br>
		<p>
	</form>';

}
add_shortcode( 'simple_crm_form', __NAMESPACE__ . '\shortcode' );
