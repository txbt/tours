<?php

/**
 * Template Name:Tour
 * 
 *
 * @package Texas Bike Tours
 * @since Texas Bike Tours 1.0
 */

get_header();

?>

<div id="primary-full" class="content-area" >

  <main id="main" class="site-main" role="main">
    <div class="inner-wrap">

         <?php 
             
             //including page content before the loop
		          $page = get_page_by_path('tour'); //slug of desired page


      function buildSelect($tax){
      $terms = get_terms($tax);
      $x = '<select name="'. $tax .'">';
        $x .= '<option value="">Select '. ucfirst($tax) .'</option>';
        foreach ($terms as $term) {
        $x .= '<option value="' . $term->slug . '">' . $term->name . '</option>';
        }
        $x .= '</select>';
      return $x;
      }
      
?>

      <div id="tourserach2" class="container-fluid">
        <div id="customTours-gf" class="col-md-4"></div>
        <?php
        if( !empty( $page->post_content) ) {
        echo '<div id="p_tours">' . apply_filters('the_content', $page->post_content) . '</div>';
              }
             
           ?>  
           <form id="search" name="searchform" method="get" action="<?php bloginfo('url');?>/tour/">
             <?php  $taxonomies = get_object_taxonomies('tour');
          foreach($taxonomies as $tax){
          echo buildSelect($tax);
    }
?>
             <input type="submit"/>
             </form>
        
        <?php

             // Start Tour page query
             $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

             query_posts( array( 'post_type' => 'tour', 'order_by' => 'meta_value&meta_key=date', 'order' => 'desc', 'paged' => $paged)
             
             );
                while ( have_posts() ) : the_post(); 
                
                global $post;
                $tourID = $post->ID;
                
                ?>

              <!-- Tour Template html -->
           
              
              <div class="row-fluid txbt-tour-page-content">
                <div class="row">
                  <div class="col-xs-12 col-md-4">
                    <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'texas_bike_tours' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
                      <?php the_post_thumbnail('tour_page'); ?>
                    </a>
                    <!--
                  <div>
                    <?php  the_tags('Tags: <span class="tags">',' ','</span><br />');  ?>
                  </div> 
                  -->
                  </div>

                  <div class="col-xs-12 col-md-8">

                    <h1 class="txbt-tour_title">
                      <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'texas_bike_tours' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
                        <?php echo get_the_title( $tourID); ?>
                      </a>
                    </h1>

                    <div class="txbt-tour_rating">
                      <?php if(function_exists('the_ratings')) { the_ratings(); };  ?>
                    </div>

                    <div class="clear txbt-tour_excerpt">
                      <?php the_excerpt(); ?>
                    </div>


                    <?php
                  
                  // Get Tour Info
                  $duration = get_post_meta( $post->ID, '_cmb_tour_duration', true );
                  $hours = get_post_meta( $post->ID, '_cmb_tour_route_length', true );

                  // Filter it for shortcodes
                  $duration = do_shortcode( $duration );
                  $hours = do_shortcode( $hours );
                  
                  ?>

                    <!-- Display Tour Info Hours/Distance 
                    <div class="clear txbt-tour-hours span3">
                      <span>Hours: <?php echo $hours ?></span>
                    </div>
                    <div class="txbt-tour-hours span3">
                      <span>Miles: <?php echo $duration ?></span>
                    </div>
                    <div class="txbt-tour-hours span3">
                      <span>Type: <?php echo $duration ?></span>
                    </div>
                  -->

                    <div class="clear txbt-moreinfo-button">
                      <a class="btn btn-primary btn-lg" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'texas_bike_tours' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
                        MORE INFO
                      </a>
                    </div>


                  </div>
                  <!-- / txbt_tour_info -->

                </div>
               
              </div>
              <hr class="clear" />

            <?php endwhile; // end of the loop. ?>
              <!-- Add the pagination functions here. -->

              <?php // the_posts_navigation(); ?>

              <div class="nav-previous">
                <?php next_posts_link( 'Older posts &raquo;'); ?>
              </div>
              <div class="nav-next">
                <?php previous_posts_link( '&laquo; Newer posts'); ?>
              </div>
              
        </div><!-- search -->

            </div><!-- inner-wrap -->
			</div><!-- #content -->
		</div><!-- #primary .site-content -->

<?php get_footer();?>
