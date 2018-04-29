<?php
/**
 * Taxonomies
 *
 * This file registers any custom taxonomies
 *
 */


/**
 * Create Tour Taxonomy
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 */

	//Register custom Tour Category
	function my_taxonomies_tour() {
	  $labels = array(
		'name'              => _x( 'Tour Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Tour Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search tour Categories' ),
		'all_items'         => __( 'All Tour Categories' ),
		'parent_item'       => __( 'Parent Tour Category' ),
		'parent_item_colon' => __( 'Parent Tour Category:' ),
		'edit_item'         => __( 'Edit Tour Category' ), 
		'update_item'       => __( 'Update Tour Category' ),
		'add_new_item'      => __( 'Add New Tour Category' ),
		'new_item_name'     => __( 'New Tour Category' ),
		'menu_name'         => __( 'Tour Categories' ),
	  );
	  $args = array(
		'labels' => $labels,
		'hierarchical' => true,
	  );
	  register_taxonomy( 'tour_category', array( 'tour','tour_review'), $args );
	}
	add_action( 'init', 'my_taxonomies_tour', 0 );

	//Register custom Tour City Category
	function my_taxonomies_tour_city() {
	  $labels = array(
		'name'              => _x( 'Tour City', 'taxonomy general name' ),
		'singular_name'     => _x( 'Tour City', 'taxonomy singular name' ),
		'search_items'      => __( 'Search tour cities' ),
		'all_items'         => __( 'All Tour Cities' ),
		'parent_item'       => __( 'Parent Tour City' ),
		'parent_item_colon' => __( 'Parent Tour City:' ),
		'edit_item'         => __( 'Edit Tour City' ), 
		'update_item'       => __( 'Update Tour City' ),
		'add_new_item'      => __( 'Add New Tour City' ),
		'new_item_name'     => __( 'New Tour City' ),
		'menu_name'         => __( 'Tour Cities' ),
	  );
	  $args = array(
		'labels' => $labels,
		'hierarchical' => true,
	  );
	  register_taxonomy( 'tour_city', array( 'tour'), $args );
	}
	add_action( 'init', 'my_taxonomies_tour_city', 0 );