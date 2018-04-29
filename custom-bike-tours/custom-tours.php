<?php 
/*
* Plugin Name: Texas Bike Tours
* Plugin URI: http://texasbiketours.com/staging
* Description: Creating custom post type, meta boxes and templates for Tour pages
* Author: Texas Bike Tours
* Version: 1.0
* Author URI: http://texasbiketours.com
*/

// Plugin Directory 
define( 'TXBT_DIR', dirname( __FILE__ ));
 
// Post Types
include_once( TXBT_DIR . '/lib/functions/post-types.php');

// Taxonomies 
include_once( TXBT_DIR . '/lib/functions/taxonomies.php');

// Metaboxes
include_once( TXBT_DIR . '/lib/functions/metaboxes.php');
 
// Widgets
//include_once( TXBT_DIR . '/lib/widgets/widget-social.php');

// Editor Style Refresh
include_once( TXBT_DIR . '/lib/functions/editor-style-refresh.php');

// General
include_once( TXBT_DIR . '/lib/functions/general.php');

// Tour search results
include_once( TXBT_DIR . '/lib/functions/searchtour-results-grid.php');





/*** Register tour style sheet. */

function register_plugin_styles() {
	wp_register_style('custom-bike-tours', plugins_url('custom-bike-tours/css/txbt.css'));
	wp_enqueue_style('custom-bike-tours' );
}

// Register style sheet.
add_action('wp_enqueue_scripts', 'register_plugin_styles');

/*** Register tour scripts. */

function register_plugin_scripts() {
	wp_register_script('custom-bike-tours', plugins_url('custom-bike-tours/js/txbt.js'), array('jquery'));

	wp_enqueue_script('custom-bike-tours' );
}

// Register style sheet.
add_action('wp_enqueue_scripts', 'register_plugin_scripts');

/**************************************************************/
/* Add custom image sizes
/************************************************************/

// Make sure featured images are enabled
add_theme_support( 'post-thumbnails' );

// Add featured image sizes
add_image_size( 'tour_page', 400, 200, true ); // width, height, crop
add_image_size( 'tour_page_thumb', 150, 150, true );

// Add other useful image sizes for use through Add Media modal

// Register the three useful image sizes for use in Add Media modal
add_filter( 'image_size_names_choose', 'txbt_custom_sizes' );
function txbt_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'tour_page' => __( 'Tour Page Image' ),
        'tour_page_thumb' => __( 'Tour Page Thumb' ),
    ) );
}


/**************************************************************/
/* Add bootstrap support to the Wordpress theme
/************************************************************/

function txbt_add_bootstrap() {

	wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.0.0', true);

}

add_action('wp_enqueue_scripts', 'txbt_add_bootstrap');


/**************************************************************/
/* Adding custom archive-tour tempalte using filter function */
/************************************************************/

function get_tour_archive_template ($archive_template) {

global $post;

     if ( is_post_type_archive ('tour')) {
	 
	 if(file_exists(TXBT_DIR . '/templates/archive-tour-grid.php')) {
	 
	 $archive_template = TXBT_DIR . '/templates/archive-tour-grid.php';
		  }
     }
     return $archive_template;
}

add_filter('archive_template', 'get_tour_archive_template');

/*************************************************************/
/* Adding custom single-tour tempalte using filter function */
/***********************************************************/

function get_tour_single_template($single_template) {

global $post;
	 
	 if ($post->post_type == 'tour') {
		  if(file_exists(TXBT_DIR . '/templates/single-tour-cards.php')) {	
          $single_template = TXBT_DIR . '/templates/single-tour-cards.php';
		  }
     }
	 return $single_template;
	 
	 }
	 
	 add_filter('single_template', 'get_tour_single_template');

/*************************************************************/
/* Adding custom book-tour tempalte using filter function */
/***********************************************************/

function get_book_tour_template($page_template) {

global $post;
	 
	 if ( is_page('book-tour')) {
		  if(file_exists(TXBT_DIR . '/templates/page-book-tour.php')) {	
          $page_template = TXBT_DIR . '/templates/page-book-tour.php';
		  }
     }
	 return $page_template;
	 
	 }
	 
	 add_filter('page_template', 'get_book_tour_template');

/**************************************************************/
/* Adding custom archive-tour_review tempalte using filter function */
/************************************************************/

function get_tour_review_archive_template ($archive_template) {

global $post;

     if ( is_post_type_archive ('tour_review')) {
	 
	 if(file_exists(TXBT_DIR . '/templates/archive-tour-review-cards.php')) {
	 
	 $archive_template = TXBT_DIR . '/templates/archive-tour-review-cards.php';
		  }
     }
     return $archive_template;
}

add_filter('archive_template', 'get_tour_review_archive_template');

/*
function get_search_tour_template ($search_template) {

global $post;

     if ($post->post_type == 'tour') {
      if(file_exists(TXBT_DIR . '/templates/search-tour.php')) {  
          $search_template = TXBT_DIR . '/templates/search-tour.php';
      }
     }
   return $search_template;
}

add_filter('archive_template', 'get_search_tour_template');
*/



/*************************************************************************************/
/* Prepopulating dropdown field with tours for gravity form ID #26 "Book your tour" */
/***********************************************************************************/

//Note: when changing drop down values, we also need to use the gform_admin_pre_render so that the right values are displayed when editing the entry.
add_filter( 'gform_pre_render_26', 'populate_posts' );

//Note: when changing drop down values, we also need to use the gform_pre_validation so that the new values are available when validating the field.
add_filter( 'gform_pre_validation_26', 'populate_posts' );

//Note: this will allow for the labels to be used during the submission process in case values are enabled
add_filter( 'gform_pre_submission_filter_26', 'populate_posts' );
add_filter( 'gform_admin_pre_render_26', 'populate_posts' );

function populate_posts( $form ) {

$namet ='';

    foreach ( $form['fields'] as &$field ) {

        //if ( $field->type != 'select' || strpos( $field->cssClass, 'populate-posts' ) === false ) {
          if ( $field->type != 'select' || strpos( $field->cssClass, 'populate-posts' ) === false ) {
            continue;
		}

	//	$sports = get_entry_field_values( 61, 26 );
            
      //    echo 'sports - ' . $sports;



        // you can add additional parameters here to alter the posts that are retrieved
        // more info: [http://codex.wordpress.org/Template_Tags/get_posts](http://codex.wordpress.org/Template_Tags/get_posts)
        $choices = array();       
        
        // get tour title to populate field #55 
        $posts = get_posts( 'post_status=publish&post_type=tour' );
        foreach ( $posts as $post ) {
            $choices[] = array( 'text' => $post->post_title, 'value' => $post->post_title );
        }
        

        // get all cities from City category for tours
        /*
        $cities = get_the_terms( $post->ID , 'tour_city' );
        //$cities = get_categories('taxonomy=tour_city&type=tour'); 

        foreach ( $cities as $city ) {
        echo $city->name;
        $choices[] = array( 'text' => $city->name;, 'value' => $city->name; );
        }
*/
        // update 'Select a Post' to whatever you'd like the instructive option to be
        $field->placeholder = 'A New Custom Bike Tour';
        $field->choices = $choices;

    }

//	echo 'input value = ' . rgpost( 'input_61' );

    return $form;
}





/**********************************************************************/
/* Add conditional logic to HTML field "Tour Details" in form ID #26 */
/********************************************************************/

add_filter( 'gform_pre_render_26', 'set_conditional_logic' );
function set_conditional_logic( $form ) {
    foreach ( $form['fields'] as &$field ) {
        if ( $field->id == 60 ) {
            $field->conditionalLogic = 
                array(
                    'actionType' => 'show',
                    'logicType' => 'all',
                    'rules' => 
                        array( array( 'fieldId' => 55, 'operator' => 'isnot', 'value' => 'A New Custom Bike Tour' ) )
                );
        }
    }
    return $form;
}

/**********************************************************************/
/* Set field Id #55 to be selected in Gravity form id #26 */
/*******************************************************************

add_filter( 'gform_pre_render_26', 'select_tour_name' );
function select_tour_name( $form ) {
    foreach ( $form['fields'] as &$field ) {
        if ( $field->id == 55 ) {
		
		 
		foreach($terms as $term) {
			 $choices[] = array('value' => $term->term_id, 'text' => $term->name);

			 foreach($terms as $key => $term) {
			 $isSelected = ( $key+1 == $selected ? 1 : null );
			 $choices[] = array('value' => $term->term_id, 'text' => $term->name, 'isSelected' => $isSelected);

		} 
            
        }
    }
    return $form;
}*/




/**********************************************************************/
/* replace list item #4 with dropdown fields in Gravity form Id #26 */
/*******************************************************************/


add_filter("gform_column_input_26_16_4", "change_column_content", 10, 6);
function change_column_content($input_info, $field, $column, $value, $form_id) {

$new_input = array(
    'type' => 'select', 
    'choices' => array(
	    array( 'text' => '-options-', 'value' => '-options-', 'isSelected' => '1'),
	    array( 'text' => 'Road', 'value' => 'Road'),
        array( 'text' => 'Hybrid', 'value' => 'Hybrid' ),
        array( 'text' => 'Recumbent', 'value' => 'Recumbent' ),
        array( 'text' => 'Handcycle', 'value' => 'Handcycle' ),
        array( 'text' => 'Electric', 'value' => 'Electric' ),
        array( 'text' => 'Mountain', 'value' => 'Mountain' ),
        array( 'text' => 'Tandem', 'value' => 'Tandem' )
    )
);

return $new_input;
}

add_filter("gform_column_input_26_16_5", "change_column_content2", 10, 6);
function change_column_content2($input_info, $field, $column, $value, $form_id) {

$new_input = array(
    'type' => 'select', 
    'choices' => array(
	    array( 'text' => '-options-', 'value' => '-options-'),
	    array( 'text' => 'none', 'value' => 'none'),
	    array( 'text' => 'child trailer', 'value' => 'child trailer' ),
        array( 'text' => 'tag-along', 'value' => 'tag-along' )
    )
);

return $new_input;
}


//add_filter("gform_column_input_content_26_16_5", "change_column_content2", 10, 6);
//function change_column_content2($input, $input_info, $field, $text, $value, $form_id) {
//$input_field_name = 'input_' . $field["id"] . '[]';
//$tabindex = GFCommon::get_tabindex();

//$new_input = '<select name="' . $input_field_name . '" ' . $tabindex . ' class="YOUR_CSS_CLASS_GOES_HERE" ><option>tag-along</option><option>child trailer</option></select>';
//return $new_input;
//}



/**********************************************************************/
/* Show Selected Tour description  */
/*******************************************************************/


function example_ajax_request() {

global $wpdb;
global $wp_query;
global $post;
global $terms;
 
    // The $_REQUEST contains all the data sent via ajax
    if ( isset($_REQUEST) ) {
     
        $textSelected = $_REQUEST['textSelected'];
		$html = "";
		// alert ($textSelected);

		$html .= '<ul>';
		$args = array('numberposts' => 1, 'post_type' => 'tour', );


// the query
$the_query = new WP_Query( $args ); 

 if ( $the_query->have_posts() ) : 
 
 while ( $the_query->have_posts() ) : $the_query->the_post(); 

	 $title = get_the_title();
	 if ($title == $textSelected) { 
	 $html = '<div id="form-tour-expert"">' . the_excerpt() . '</div>';
	 echo $html;
	 }


	 endwhile; 

 wp_reset_postdata(); 


endif; 


$html .= '</ul>';

// Build the response...
$success = true;
$response = json_encode(array(
    'success' => $success,
    'html' => $html
));

// Construct and send the response
//header("content-type: application/json");
//echo $response;
//exit;

        
        // Let's take the data that was sent and do something with it
       // if ( $fruit == 'Banana' ) {
      //     $textSelected = 'title tour';
       // }
     
        // Now we'll return it to the javascript function
        // Anything outputted will be returned in the response

      // echo $textSelected;
         
        // If you're debugging, it might be useful to see what was sent in the $_REQUEST
        // print_r($_REQUEST);
     
    }
    
   //  echo 'nothing sent';
     
    // Always die in functions echoing ajax content
   die();
}
 
add_action( 'wp_ajax_example_ajax_request', 'example_ajax_request' );
add_action('wp_ajax_nopriv_example_ajax_request', 'example_ajax_request');




// Add CSS class to Gravity Input field for Date Picker
// Requires setting the Description in the forms with default content
add_action('gform_field_css_class_26', 'twp_custom_input_class', 10, 3);
	function twp_custom_input_class($classes, $field, $form){
    if($field['description'] == 'Arrival'){
        $classes .= " date-in";
    }
    if($field['description'] == 'Departure'){
        $classes .= " date-out";
    }
    return $classes;
	}

/**********************************************************************/
/* Show custom text for set and remove featured image
/*******************************************************************/

	function custom_tour_post_thumbnail_set( $content ) {
	global $post_type;
	if ($post_type == 'tour') {
		$content = str_replace( __( 'Set featured image' ), __( 'Set Tour Image' ), $content );
	    $content = str_replace( __( 'Remove featured image' ), __( 'Remove Tour Image' ), $content );
		} 
	return $content;
}

add_filter( 'admin_post_thumbnail_html', 'custom_tour_post_thumbnail_set' );


/**********************************************************************/
/* Show custom text for set and remove featured image
/*******************************************************************/

add_action( 'edit_form_after_title', 'myprefix_edit_form_after_title' );

function myprefix_edit_form_after_title() {
	if ( 'tour' == $GLOBALS['post_type'] ) {

echo '<h2>Tour Long Description </h2>';
}
}

/**
 * Use Gravity Forms Conditional Logic with Dates
 * http://gravitywiz.com/use-gravity-forms-conditional-logic-with-dates/
 */
add_filter("gform_field_value_startdate", "txbt_populate_timestamp");
function txbt_populate_timestamp( $value ){
    return time();
}





        
    //if ( isset( $post_type ) && locate_template( 'search-' . $post_type . '.php' ) ) {
      // if so, load that template

      //get_template_part( 'templates/search', get_post_type());



      //if ( $_GET['post_type'] == 'tour') {
      

      //get_template_part( 'templates/search', 'tour');
     // }

      
      // and then exit out
    // exit;
    //}
              
      


/* *
add_action( 'gform_post_submission_1', 'be_event_timestamp', 10, 2 );

 * Create a UNIX timestamp based on Gform date fields
 * @author Bill Erickson
 * @link http://www.billerickson.net/code/gravity-forms-unix-timestamp
 * @link http://www.gravityhelp.com/documentation/page/Gform_post_submission
 *
 * 'gform_post_submission' applies to all forms, append form ID to specify
 *
 * @param array $entry
 * @param array $form
 * @return array
 
function be_event_timestamp( $entry, $form ) {
	$start_date = get_post_meta( $entry['post_id'], 'be_event_start_date', true );
	if( $start_date ) {
		$timestamp = strtotime( $start_date );
		update_post_meta( $entry['post_id'], 'be_event_start_date_unix', $timestamp );		
	}
	
	$end_date = get_post_meta( $entry['post_id'], 'be_event_end_date', true );
	if( $end_date ) {
		$timestamp = strtotime( $end_date );
		update_post_meta( $entry['post_id'], 'be_event_end_date_unix', $timestamp );
	}
}



function template_chooser($template)
{
  global $wp_query;
  //$post_type = get_query_var('post_type');
  $post_type = get_post_type();
   echo "post type:" . $post_type;
  if( $wp_query->is_search() && $post_type == 'tour' )
  {

  echo "post type:" . $post_type;
    //return locate_template('archive-tour.php');
	return locate_template('archive-' . $post_type . '.php');
  }
  return $template;
}
add_filter('template_include', 'template_chooser');



// advanced search functionality
function advanced_search_query($query) {

	if($query->is_search()) {
		
		// tag search
		if (isset($_GET['taglist']) && is_array($_GET['taglist'])) {
			$query->set('tag_slug__and', $_GET['taglist']);
		}
	
		return $query;
	}

}

add_action('pre_get_posts', 'advanced_search_query', 1000);

*/

/* **********************************
*
* SEARCH FILTER
* http://speckyboy.com/2010/09/19/10-useful-wordpress-search-code-snippets/
*
********************************** 
function SearchFilter($query) {
if ($query->is_search or $query->is_feed) {
// Portfolio
if($_GET['post_type'] == "portfolio") {
$query->set('post_type', array('artwork', 'websites', 'motion'));
}
// Tutorials
elseif($_GET['post_type'] == "tutorials") {
$query->set('category_name','tutorials');
}
// EVERYTHING! MWAHAHAHAHAHA
elseif($_GET['post_type'] == "all") {
$query->set('post_type', array('artwork', 'websites', 'motion', 'post'));
}
}
return $query;
}
// This filter will jump into the loop and arrange our results before they're returned
add_filter('pre_get_posts','SearchFilter');

 */

add_filter("gform_pre_render_26", "gform_prepopluate_cities");
add_filter("gform_admin_pre_render_26", "gform_prepopluate_cities");

function gform_prepopluate_cities($form){

    //Grab all Terms Associated with a Specific Taxonomy;
    global $post;
    $taxonomy = 'tour_city';
    $formid = 26;
    $fieldid = 76;

    if($form["id"] != $formid)
        return $form;
    $terms = get_terms($taxonomy, 'hide_empty=0&orderby=none');

    //Creating drop down item array.
    $items = array();

    //Adding initial blank value.
    //$items[] = array("text" => "", "value" => "");

    //Adding term names to the items array
    foreach($terms as $term){
       // $is_selected = $term->name == "testing" ? true : false;
       // $items[] = array("value" => $term->name, "text" => $term->name, "isSelected"=> $is_selected);
        $items[] = array("value" => $term->name, "text" => $term->name);
    }

    //Adding items to field id 76. Replace 76 with your actual field id. You can get the field id by looking at the input name in the markup.
    foreach($form["fields"] as &$field)
        if($field["id"] == $fieldid){
            $field["type"] = "select";
            $field->placeholder = '- options -';
            $field["choices"] = $items;
        }

    return $form;
  }
