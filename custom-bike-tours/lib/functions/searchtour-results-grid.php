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

        <div class="col-xs-12 col-sm-6 col-md-4 col-xl-3">
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
            <div class="card-text"><?php the_excerpt(); ?></div>
          </div>
          <div class="card-footer p-0">
            <a 
              class="entry-read-more pull-right" 
              title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'texas_bike_tours' ), the_title_attribute( 'echo=0' ) ) ); ?>"
              href="<?php the_permalink(); ?>"
            >
              <i class="fa fa-chevron-circle-right"></i>
            </a>
          </div>
        </div>
      </div>
            <?php

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