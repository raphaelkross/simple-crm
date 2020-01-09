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
			'name' => [
				'type'     => 'text',
				'required' => true,
				'label'    => esc_html__( 'Name', 'simple-crm' ),
			],
			'phone' => [
				'type'     => 'text',
				'required' => true,
				'label'    => esc_html__( 'Phone', 'simple-crm' ),
			],
			'email' => [
				'type'     => 'email',
				'required' => true,
				'label'    => esc_html__( 'Email Address', 'simple-crm' ),
			],
			'budget' => [
				'type'     => 'text',
				'required' => true,
				'label'    => esc_html__( 'Desired Budget', 'simple-crm' ),
			],
			'message' => [
				'type'     => 'text',
				'required' => true,
				'label'    => esc_html__( 'Message', 'simple-crm' ),
			],
		];

		// @TODO: validate.

		$result = 'End message';

		// @TODO: check by class to see if valid or not.
		if ( $result ) {

			$lead = wp_insert_post(
				[
					'post_content' => $result,
					'post_title'   => 'Rafael @TODO',
					'post_status'  => 'private',
					'post_type'    => 'customer',
				],
				true
			);

			if ( ! is_wp_error( $lead ) ) {
				return new \WP_REST_Response( [ 'success' => true ], 200 );
			} else {
				return new \WP_REST_Response( $lead->get_error_message(), 501 );
			}
		} else {
			// @TODO: Return error message compiled to FE.
			return new \WP_REST_Response( esc_html__( 'Bad Request @TODO error list.', 'simple-crm' ), 401 );
		}
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
