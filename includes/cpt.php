<?php
/**
 * Custom Post Types
 *
 * @package SimpleCRM
 */

namespace SimpleCRM;

/**
 * Register custom CPTs.
 *
 * @return void
 */
function register_cpts() {

	/**
	 * Post Type: Customer.
	 */

	$labels = array(
		'name'          => esc_html__( 'Customers', 'simple-crm' ),
		'singular_name' => esc_html__( 'Customer', 'simple-crm' ),
	);

	$args = array(
		'label'               => esc_html__( 'Customers', 'simple-crm' ),
		'labels'              => $labels,
		'description'         => '',
		'public'              => false,
		'publicly_queryable'  => false,
		'show_ui'             => true,
		'delete_with_user'    => false,
		'show_in_rest'        => false,
		'has_archive'         => false,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'exclude_from_search' => true,
		'hierarchical'        => false,
		'rewrite'             => false,
		'query_var'           => false,
		'menu_icon'           => 'dashicons-groups',
		'supports'            => array( 'title', 'editor' ),
		'capabilities'        => array(
			'edit_post'          => 'update_core',
			'read_post'          => 'update_core',
			'delete_post'        => 'update_core',
			'edit_posts'         => 'update_core',
			'edit_others_posts'  => 'update_core',
			'delete_posts'       => 'update_core',
			'publish_posts'      => 'update_core',
			'read_private_posts' => 'update_core',
		),
	);

	register_post_type( 'customer', $args );
}

add_action( 'init', __NAMESPACE__ . '\register_cpts' );
