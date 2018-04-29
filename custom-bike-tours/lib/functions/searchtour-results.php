<?php

add_filter('uwpqsf_result_tempt', 'customize_output', '', 4);
function customize_output($results, $arg, $id, $getdata ){
   // The Query
            $apiclass = new uwpqsfprocess();
             $query = new WP_Query( $arg );

    ob_start(); $result = '';
      // The Loop

    if ( $query->have_posts() ) {
      while ( $query->have_posts() ) {
        $query->the_post();
        global $post; 
        $tourID = $post->ID; ?>

        <div class="row-fluid txbt-tour-page-content" >
                <div class="row">
                  <div class="col-xs-12 col-md-4">
                    <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'texas_bike_tours' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
                      <?php the_post_thumbnail('tour_page'); the_tags();?>
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

                    <div class="clear txbt-moreinfo-button">
                      <a class="btn btn-primary btn-lg" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'texas_bike_tours' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
                        MORE INFO
                      </a>
                    </div>


                  </div>
                  <!-- / txbt_tour_info -->

                </div>
               
              </div> <hr class="clear" /><?php

      }
                     
                        echo  $apiclass->ajax_pagination($arg['paged'],$query->max_num_pages, 4, $id, $getdata);
     } else {
           echo  'no post found';
        }




        /* Restore original Post Data */
        wp_reset_postdata();

    $results = ob_get_clean();
      return $results;

}