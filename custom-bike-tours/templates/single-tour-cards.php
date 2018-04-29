<?php

/**
 * The Template for displaying all single posts.
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
      
      while ( have_posts() ) : the_post(); 
      global $post, $term;
      $tourID = $post->ID;
      
      $tid = get_the_title( $tourID);  
      
    //   var_dump($tid);
    //  $tid = html_entity_decode(str_replace("&#8216;" ,"'", $tid));
    //   var_dump($tid);
       
     $tid = str_replace("&#8217", '', $tid);
     $tid = str_replace('#038;', '', $tid);
//var_dump($tid);
     $tid =  preg_replace("/[^A-Za-z0-9\-\']/", '', $tid); 
          //  var_dump($tid);

      
      $terms = get_the_terms( $post->ID, 'tour_category');
      if(!empty($terms)){
      foreach( $terms as $term ) { 
       $tour_category[] = $term->term_id;
        //echo $term->term_id;
	    }
      }
      
      ?>

      <div class="txbt-tour-page-content container">
        <div class="row">

          <div class="col-12 text-center">

            <h1 class="txbt-tour_title pb-2">
              <?php echo get_the_title( $tourID); ?>
            </h1>

            <div class="col-12 pb-2">
              <?php the_post_thumbnail('tour_page'); ?>
            </div>

            <?php
      
              // Get Tour Info
              $duration = get_post_meta( $post->ID, '_cmb_tour_duration', true );
              $mileage = get_post_meta( $post->ID, '_cmb_tour_route_length', true );
              $fee = get_post_meta( $post->ID, '_cmb_tour_fee', true );
              $partyof = get_post_meta( $post->ID, '_cmb_tour_paries_of', true );
              $cyclingtype = get_post_meta( $post->ID, '_cmb_tour_cycling_type', true );

              // Filter it for shortcodes
              $duration = do_shortcode( $duration );
              $mileage = do_shortcode( $mileage );
              $fee = do_shortcode( $fee );
              $partyof = do_shortcode( $partyof );
              $cyclingtype = do_shortcode( $cyclingtype );
              
              ?>

                <div class="row">

                  <!-- Display Tour Info Hours/Distance -->

                    <div class="col-12 col-sm-11 col-md-8 col-lg-5 mx-auto text-center">
                      <div class="row align-items-end pb-2">
                          <div class="tour-duration col-4">
                            <div class="tour-vitals">
                              <?php echo $duration ?> <span class="hour">hr</span>
                            </div>
                            <div class="tour-label">
                              duration
                            </div>
                          </div>
                          <div class="tour-type col-4">
                            <div class="tour-vitals">
                              <?php echo $cyclingtype ?>
                            </div>
                            <div class="tour-label">
                              type
                            </div>
                          </div>

                          <div class="tour-distance col-4">
                            <div class="tour-vitals">
                              <?php echo $mileage ?>
                            </div>
                            <div class="tour-label">
                              Miles
                            </div>
                          </div>
                        </div>
                    </div>

                    <style>
                      .tour-label { font-size:.75em; padding:10px 0; text-transform: uppercase}
                      .tour-vitals { font-size:1.4em;}
                      .tour-type .tour-vitals { font-size:.8em; text-transform: capitalize;}
                      .hour { text-transform: uppercase; font-size:.5em;}
                      .tour-duration { border-right: 1px solid #999; }
                      .tour-distance { border-left: 1px solid #999; }
                    </style>

                  <div class="col-12">
                    <a class="btn btn-primary btn-lg" id="rent" href="/book-tour">REQUEST A TOUR
                    </a>
                  </div>

                </div>



              </div>



        </div>

        <!-- / txbt_tour_info -->

        <div class="tour-content row">
          <div class="col-12 pb-2">
            <hr />
            <h2 class="txbt-tour_title">Tour Description</h2>
            <?php the_content(); ?>
          </div>
          
        </div>

        <div class="tour-reviews row">
          <div class="col-12 pb-2">
            <hr />

            <h2 class="txbt-tour_title" style="text-align:center;">Tour Reviews</h2>
          
          <?php
 
        $args = array( 'post_type' => 'tour_review', 'posts_per_page' => -1,
          );
          
         $loop = new WP_Query( $args );
        
         if ($loop->have_posts()) {
         
          while ( $loop->have_posts() ) : $loop->the_post();
          
            // Get review Info
            $reviewtourname = get_post_meta( $post->ID, '_cmb_review_tour_name', true );
            $reviewtourdate = get_post_meta( $post->ID, '_cmb_review_tour_date', true );
            $reviewfrom = get_post_meta( $post->ID, '_cmb_review_from', true );
            $reviewby = get_post_meta( $post->ID, '_cmb_review_author', true );

            $reviewtourdate = do_shortcode( $reviewtourdate );
            $reviewfrom = do_shortcode( $reviewfrom );
            $reviewby = do_shortcode( $reviewby );

            $reviewtourname = str_replace("&#8217", '', $reviewtourname);
            $reviewtourname = preg_replace("/'/", '', $reviewtourname); 
            $reviewtourname = preg_replace("/&/", '', $reviewtourname);
            $reviewtourname = preg_replace("/[^A-Za-z0-9\-\']/", '', $reviewtourname); 
         

        if( $tid === $reviewtourname) {

            echo '<div class="card card-review">
                    <div class="card-header">
                      <h5>';
                        the_title();
            echo    '</h5>
                  </div>';

            echo '<div class="card-block p-0">
                    <blockquote>';
                      the_content();
            echo    '</blockquote>
                  </div>';
            
            
            echo '<div class="card-footer text-center">';
            echo '<span style="padding-right:10px;"> Review By: '. $reviewby . '</span>';
            echo '<span style="padding-right:10px;"> Tour Date: '. $reviewtourdate . '</span>';
            echo '<span"> Review From: '. $reviewfrom . '</div>';
            echo '</div></div>';



            break;
            
            }
          
          endwhile;
         
          }
           
          else {
          
          
          //echo "DEFAULT REVIEW";
          
	         // echo wpautop( 'Sorry, no posts were found' );
             $args2 = array( 'post_type' => 'tour_review', 'showposts' => 1,'tour_category' => 'general' );
             $loop2 = new WP_Query( $args2 );
          
             
             
             while ( $loop2->have_posts() ) : $loop2->the_post();
             echo '<div class="entry-content">';

            the_content();
            echo '</div>';
           endwhile;
           }
         
          ?>
        </div>

        <div class="tour-reviews row">
          <div class="col-12 text-center pb-2">
            <hr />
            <a id="allreviews_btn" class="btn btn-secondary btn-lg mr-2" href="<?php echo get_site_url(); ?>/tour_review/" >See All Reviews</a>
            <a id="allreviews_btn" class="btn btn-secondary btn-lg" href="<?php echo get_site_url(); ?>/tour" >View All Tours</a>
          </div>

      </div>

      <?php endwhile; // end of the loop. ?>

    

      
</div><!-- inner-wrap -->
   
    

  </main><!-- #content -->
		</div><!-- #primary .site-content -->
<?php get_footer();?>