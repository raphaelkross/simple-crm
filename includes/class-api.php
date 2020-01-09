<?php
/**
 * API Controller.
 *
 * @package SimpleCRM
 */

namespace SimpleCRM;

/**
 * Split Payment REST Controller.
 */
class API extends \WP_REST_Controller {

	/**
	 * Register the routes for the objects of the controller.
	 */
	public function register_routes() {
		$version   = '1';
		$namespace = 'simple-crm/v' . $version;

		register_rest_route(
			$namespace,
			'/lead',
			array(
				'methods'  => \WP_REST_Server::CREATABLE,
				'callback' => array( $this, 'create_lead' ),
			)
		);
	}

	/**
	 * Create Lead.
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 * @return WP_Error|WP_REST_Request
	 */
	public function create_lead( $request ) {
		$params = $request->get_body_params();

		$expected_params = [
			'creation_date' => [
				'type'     => 'text',
				'required' => true,
				'label'    => esc_html__( 'Creation Date', 'simple-crm' ),
			],
			'name'          => [
				'type'     => 'text',
				'required' => true,
				'label'    => esc_html__( 'Name', 'simple-crm' ),
			],
			'phone'         => [
				'type'     => 'text',
				'required' => true,
				'label'    => esc_html__( 'Phone', 'simple-crm' ),
			],
			'email'         => [
				'type'     => 'email',
				'required' => true,
				'label'    => esc_html__( 'Email Address', 'simple-crm' ),
			],
			'budget'        => [
				'type'     => 'text',
				'required' => true,
				'label'    => esc_html__( 'Desired Budget', 'simple-crm' ),
			],
			'msg'           => [
				'type'     => 'text',
				'required' => true,
				'label'    => esc_html__( 'Message', 'simple-crm' ),
			],
		];

		// Validate and generate msgs.
		$result = $this->validate_forms( $expected_params, $params );

		// Check by class to see if valid or not.
		if ( ! is_wp_error( $result ) ) {

			$lead = wp_insert_post(
				[
					'post_content' => $result,
					'post_title'   => $params['name'],
					'post_status'  => 'private',
					'post_type'    => 'customer',
				],
				true
			);

			if ( ! is_wp_error( $lead ) ) {
				return new \WP_REST_Response( [ 'success' => true ], 200 );
			} else {
				return new \WP_REST_Response( [ 'error' => $lead->get_error_message() ], 200 );
			}
		} else {
			// Return error message compiled to FE.
			return new \WP_REST_Response( [ 'error' => $result->get_error_message() ], 200 );
		}
	}

	/**
	 * Validate Form.
	 *
	 * @param array $expected Expected params and validation rules.
	 * @param array $source    Received params from the form.
	 * @return WP_Error|string
	 */
	private function validate_forms( $expected, $source ) {
		$error_messages = [];
		$ouput_messages = [];

		foreach ( $expected as $expected_key => $expected_value ) {
			if ( isset( $source[ $expected_key ] ) ) {
				// Validate and add message.

				$ouput_messages[] = $expected_value['label'] . ': ' . $source[ $expected_key ];
			} else {
				if ( $expected_value['required'] ) {
					$error_messages[] = sprintf(
						'%1$s %2$s',
						$expected_value['label'],
						esc_html__( 'is required.', 'simple-crm' )
					);
				}
			}
		}

		if ( 0 < count( $error_messages ) ) {
			return new \WP_Error( 'simple_crm_validation_error', implode( '<br>', $error_messages ) );
		}

		return implode( '<br>', $ouput_messages );
	}
}

/**
 * Register the REST route.
 */
add_action(
	'rest_api_init',
	function() {
		$api = new API();
		$api->register_routes();
	}
);
