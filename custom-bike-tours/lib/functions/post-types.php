<?php
/**
 * Post Types
 *
 * This file registers any custom post types
 *
 */

/**
 * Create Tour post type
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

/* *********************************** */
/* Creating a custom post type Tours  */
/* ***********************************/

function codex_tour_init() {
	$labels = array(
		'name'               => _x( 'Tours', 'post type general name' ),
		'singular_name'      => _x( 'Tour', 'post type singular name' ),
		'menu_name'          => _x( 'Tours', 'admin menu' ),
		'name_admin_bar'     => _x( 'Tour', 'add new on admin bar' ),
		'add_new'            => _x( 'Add New Tour', 'tour' ),
		'add_new_item'       => __( 'Add New Tour' ),
		'new_item'           => __( 'New Tour' ),
		'edit_item'          => __( 'Edit Tour'  ),
		'view_item'          => __( 'View Tour'  ),
		'all_items'          => __( 'All Tours'  ),
		'search_items'       => __( 'Search Tours' ),
		'parent_item_colon'  => __( 'Parent Tours:' ),
		'not_found'          => __( 'No tours found.' ),
		'not_found_in_trash' => __( 'No tours found in Trash.')
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'tour' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'			 => get_stylesheet_directory_uri() . '/images/bike-icon.png',
		'taxonomies'		 => array( 'post_tag'), // array( 'post_tag', 'category'),
		'can_export'		 => true,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);


	register_post_type( 'tour', $args );
}

add_action( 'init', 'codex_tour_init' );


/* ********************************************** */
/* Creating a custom post type for Tour Reviews  */
/* ******************************************** */

function codex_tour_review_init() {
	$labels = array(
		'name'               => _x( 'Tour Reviews', 'post type general name' ),
		'singular_name'      => _x( 'Tour Review', 'post type singular name' ),
		'menu_name'          => _x( 'Tour Reviews', 'admin menu' ),
		'name_admin_bar'     => _x( 'Tour Review', 'add new on admin bar' ),
		'add_new'            => _x( 'Add New Review', 'tour_review' ),
		'add_new_item'       => __( 'Add New Review' ),
		'new_item'           => __( 'New Tour Review' ),
		'edit_item'          => __( 'Edit Tour Review'  ),
		'view_item'          => __( 'View Tour Review'  ),
		'all_items'          => __( 'All Reviews'  ),
		'search_items'       => __( 'Search Tour Review' ),
		'parent_item_colon'  => __( 'Parent Tour Reviews:' ),
		'not_found'          => __( 'No tours found.' ),
		'not_found_in_trash' => __( 'No tours found in Trash.')
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'tour_review' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'			 => 'dashicons-format-status',
		'taxonomies'		 => array( 'post_tag', 'category'),
		'can_export'		 => true,
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);


	register_post_type( 'tour_review', $args );
}

add_action( 'init', 'codex_tour_review_init' );