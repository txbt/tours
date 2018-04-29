<?php

/**
 * Template Name: Tour Reviews Template
 * 
 *
 * @package Texas Bike Tours
 * @since Texas Bike Tours 1.0
 */

get_header();

?>

<div id="primary-full" class="container-fluid content-area" >

  <main id="main" class="site-main" role="main">
    <div class="inner-wrap row">
      <div class="col-12">
      
        <h1 class="py-2 text-center">Texas Bike Tours Reviews</h1>

      </div>

        <?php
                // Start Tour page query
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                
                query_posts( array( 'post_type' => 'tour_review', 'order' => 'desc', 'paged' => $paged) );
                while ( have_posts() ) : the_post(); 

                global $post;
                $reviewID = $post->ID;
                
                 // Get Review Info
                  $tourDate = get_post_meta( $post->ID, '_cmb_review_tour_date', true );
                  $authorName = get_post_meta( $post->ID, '_cmb_review_author', true );
                  $reviewSource = get_post_meta( $post->ID, '_cmb_review_from', true );
                              
                ?>
      

          <div class="col-12">
            <div class="card card-review">
              <div class="card-header">
                <h5>
                  <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'texas_bike_tours' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
                    <?php echo get_the_title( $reviewID); ?>
                  </a>
                </h5>
              </div>

              <div class="card-block p-0">

                <blockquote>
                  <?php the_content(); ?>
                </blockquote>
              </div>
           
            <div class="card-footer">
              <div class="row">
                <div class="col-6 mr-auto">
                  <?php echo $tourDate ?> | <?php echo $reviewSource ?>

                </div>

                <div class="col-6 ml-auto" style="text-align:right;">
                  <?php echo $authorName ?>
                </div>
              </div>
            </div>
          </div>

          


        

      </div>

      <hr class="clear"/>


      <?php endwhile; // end of the loop. ?>
       <!-- Add the pagination functions here. -->


      <div class="clear row">
        <div class="col-xs-12 col-md-6 nav-previous">
          <?php next_posts_link( 'Older posts &raquo;'); ?>
        </div>
        <div class="col-xs-12 col-md-6 nav-next">
          <?php previous_posts_link( '&laquo; Newer posts'); ?>
        </div>
      </div>


            </div><!-- inner-wrap -->
			</main><!-- #content -->
		</div><!-- #primary .site-content -->

<?php get_footer();?>