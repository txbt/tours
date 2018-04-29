<?php
/**
 * Metaboxes
 *
 * This file registers any custom metaboxes
 *
 */

/**
 * Create Metaboxes
 * @since 1.0.0
 * @link http://www.billerickson.net/wordpress-metaboxes/
 */

/**
 * Tour Metaboxes
 *
 * @category Texas Bike Tours
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */


/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */


/* ****************************************************** */
/* Creating custom metaboxes for Custom post type Tours  */
/* ******************************************************/


function cmb_tour_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';

	$meta_boxes['tour_info_box'] = array(
		'id'         => 'tour_info_box',
		'title'      => __( 'Tour Info', 'cmb' ),
		'pages'      => array( 'tour', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(

		//Tour Duration Custom Field
			array(
				'name'       => __( 'Tour Duration', 'cmb' ),
				'desc'       => __( 'hour (just enter numbers)', 'cmb' ),
				'id'         => $prefix . 'tour_duration',
				'type'       => 'text_small',
				'show_on_cb' => 'cmb_tour_duration_show_on_cb', // function should return a bool value
				// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
				// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
				// 'on_front'        => false, // Optionally designate a field to wp-admin only
				// 'repeatable'      => true,
			),

			//Cycling Type - Road (or city-streets or bike trails or city-streets and bike trails) 
			array(
				'name'       => __( 'Cycling Type', 'cmb' ),
				'desc'       => __( 'decription of the tour cycling type (example: road, city-streets or bike trails)', 'cmb' ),
				'id'         => $prefix . 'tour_cycling_type',
				'type'       => 'text_small',
				'show_on_cb' => 'cmb_tour_cycling_type_on_cb', // function should return a bool value
			),

			//Tour Route Custom Field
			array(
				'name'       => __( 'Tour Route Mileage', 'cmb' ),
				'desc'       => __( 'miles (just enter numbers)', 'cmb' ),
				'id'         => $prefix . 'tour_route_length',
				'type'       => 'text_small',
				'show_on_cb' => 'cmb_tour_miles_show_on_cb', // function should return a bool value
			),


			//Tour Fee Custom Field
			array(
				'name' => __( 'Tour Fee', 'cmb' ),
				'desc' => __( 'tour fee', 'cmb' ),
				'id'   => $prefix . 'tour_fee',
				'type' => 'text_money',
				//'before'     => '$', // override '$' symbol if needed
				// 'repeatable' => true,
			),

			//Tour Route Custom Field
		/*	array(
				'name'       => __( 'For parties of', 'cmb' ),
				'desc'       => __( 'number of people in a party', 'cmb' ),
				'id'         => $prefix . 'tour_paries_of',
				'type'       => 'text_small',
				'show_on_cb' => 'cmb_tour_paries_of_show_on_cb', // function should return a bool value
			),

			//Tour Additional Fee Custom Field
			array(
				'name' => __( 'Additional Fee', 'cmb' ),
				'desc' => __( 'additional fee per person', 'cmb' ),
				'id'   => $prefix . 'tour_additional_fee',
				'type' => 'text_money',
				'before'     => '$', // override '$' symbol if needed
				// 'repeatable' => true,
			),
			*/

			// Cancellation  Custom Field
			array(
				'name' => __( 'Cancellation Policy', 'cmb' ),
				'desc' => __( 'Cancellation Policy for this tour', 'cmb' ),
				'id'   => $prefix . 'cancellation_policy',
				'type' => 'textarea_small',
			),

		),
	);

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'cmb_tour_metaboxes' );

/* ************************************************************* */
/* Creating custom metaboxes for Custom post type Tour reviews  */
/* *************************************************************/


function cmb_tour_review_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';

	$meta_boxes['tour_review_info_box'] = array(
		'id'         => 'tour_review_info_box',
		'title'      => __( 'Tour Review Info', 'cmb' ),
		'pages'      => array( 'tour_review', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(

		//Tour Name to review Custom Field
			array(
				'name'       => __( 'Tour Name', 'cmb' ),
				'desc'       => __( 'tour name for this review', 'cmb' ),
				'id'         => $prefix . 'review_tour_name',
				'type'    => 'select',
				'options' => get_tour_name_options(),
				'show_on_cb' => 'cmb_review_tour_name_show_on_cb', // function should return a bool value
				// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
				// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
				// 'on_front'        => false, // Optionally designate a field to wp-admin only
				// 'repeatable'      => true,
			),


			/*

			array(
				'name'    => 'Test Select',
				'desc'    => 'field description (optional)',
				'id'      => $prefix . 'test_select',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Option One', 'value' => 'standard', ),
					array( 'name' => 'Option Two', 'value' => 'custom', ),
					array( 'name' => 'Option Three', 'value' => 'none', ),
				),
			),

			*/
			

		//Tour date to review Custom Field
			array(
				'name' => 'Tour Date',
				'desc' => __( 'tour date', 'cmb' ),
				'id'   => $prefix . 'review_tour_date',
				'type' => 'text_date',
			),

			//Tour "Reviewed By" Custom Field
			array(
				'name'       => __( 'Review By', 'cmb' ),
				'desc'       => __( "author's name", 'cmb' ),
				'id'         => $prefix . 'review_author',
				'type'		 => 'text_medium',
				'show_on_cb' => 'cmb_tour_review_author_show_on_cb', // function should return a bool value
			),

			//Tour Review Custom Field
			array(
				'name'       => __( 'Review From', 'cmb' ),
				'desc'       => __( 'review source', 'cmb' ),
				'id'         => $prefix . 'review_from',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Trip Adviser', 'value' => 'Trip Adviser', ),
					array( 'name' => 'Google+', 'value' => 'Google+', ),
					array( 'name' => 'Yelp', 'value' => 'Yelp', ),
					array( 'name' => 'Citysearch', 'value' => 'Citysearch', ),
					array( 'name' => 'Yahoo', 'value' => 'Yelp', ),
					array( 'name' => 'Facebook', 'value' => 'Facebook', ),
					array( 'name' => 'Better Business Bureau (BBB)', 'value' => 'Better Business Bureau (BBB)', ),
					array( 'name' => 'LinkedIn', 'value' => 'LinkedIn', ),
					array( 'name' => 'Website', 'value' => 'Website', ),
					
				),
				'show_on_cb' => 'cmb_tour_review_from_show_on_cb', // function should return a bool value
			),


		),
	);

	return $meta_boxes;
}

add_filter( 'cmb_meta_boxes', 'cmb_tour_review_metaboxes' );

/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {
	if ( ! class_exists( 'cmb_Meta_Box' ) )
		 //require_once( TXBT_DIR . '/lib/metabox/init.php' );
		 require_once( TXBT_DIR . '/lib/functions/metaboxes.php' );
		 }

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );




function get_tour_name_options() {

$query_args = array(
        'post_type' => 'tour',
		'posts_per_page' => -1,
        'show_option_none' => 'Choose item',
    );

$args = wp_parse_args( $query_args, array(
    'post_type' => 'tour',
) );

$posts = get_posts( $args );

$post_options = array();
$postn = array();
if ( isset($posts) ) {
    foreach ( $posts as $post ) {
        $post_options [ $post->ID ] = array( 'name' =>  $post->post_title, 'value' => $post->post_title );
    }
}

return $post_options;
}


