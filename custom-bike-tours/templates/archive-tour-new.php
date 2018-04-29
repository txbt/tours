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

<div id="primary-full" class="container-fluid content-area" >

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

      <div>
        <?php
        if( !empty( $page->post_content) ) {
        echo '<div id="tourserach2" class="container-fluid"><div id="customTours-gf" class="col-md-4"></div><div id="p_tours">' . apply_filters('the_content', $page->post_content) . '</div></div>';
              }
             
           ?>  

<div id="tourserach" class="row">
        
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

              <div class="col-3">
                <div class="card">
                  <a 
                    href="<?php the_permalink(); ?>" 
                    title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'texas_bike_tours' ), the_title_attribute( 'echo=0' ) ) ); ?>" 
                    class="card-img-top card-img-sizer" 
                    rel="bookmark"
                  >
                      <img class="card-img" src= "<?php the_post_thumbnail_url( 'tour_page' ); ?>"/>
                  </a>
                <div class="card-block">
                  <h4 class="card-title">
                    <a 
                      href="<?php the_permalink(); ?>" 
                      title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'texas_bike_tours' ), the_title_attribute( 'echo=0' ) ) ); ?>" 
                      rel="bookmark"
                    >
                        <?php echo get_the_title( $tourID); ?>
                    </a>
                  </h4>
                  <p class="card-text"><?php the_excerpt(); ?></p>
                  <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'texas_bike_tours' ), the_title_attribute( 'echo=0' ) ) ); ?>" class="btn btn-primary">Go somewhere</a>
                </div>
                <div class="card-footer p-0">
                  <a class="entry-read-more col-xs-2 pull-right" href="https://learn.compactappliance.com/best-places-for-portable-ice-makers/" target="_blank"><i class="fa fa-chevron-circle-right"></i></a>
                </div>
              </div>
            </div>
        

            <?php endwhile; // end of the loop. ?>
              <!-- Add the pagination functions here. -->

              <?php // the_posts_navigation(); ?>

              <div class="nav-previous">
                <?php next_posts_link( 'Next &raquo;'); ?>
              </div>
              <div class="nav-next">
                <?php previous_posts_link( '&laquo; Previous'); ?>
              </div>

              </div> <!-- / serch end -->
              
        </div><!-- search -->

            </div><!-- inner-wrap -->
			</main><!-- #content -->
		</div><!-- #primary .site-content -->

<?php get_footer();?>