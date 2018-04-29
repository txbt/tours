<?php

/**
 * The Template for displaying all single posts.
 *
 * @package Texas Bike Tours
 * @since Texas Bike Tours 1.0
 */

get_header();



?>

<div id="primary-full" class="row-fluid content-area" >

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

      <div class="txbt-tour-page-content">
        <div class="row">
            <div class="col-xs-12 col-md-4">
              <?php the_post_thumbnail('tour_page'); ?>
            </div>

            <div class="col-xs-12 col-md-8">

              <div class="txbt-tour_excerpt">

                <h1 class="txbt-tour_title">
                  <?php echo get_the_title( $tourID); ?>
                </h1>
                <!-- <?php the_excerpt(); ?>
            
            <div class="clear txbt-moreinfo-button">
                <a class="btn" href="<?php echo site_url() . '/test'?>" rel="bookmark">SIGN UP</a>
            </div>
            -->

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

                    <div class="col-xs-12 col-md-6">
                      <div class="clear txbt-tour-hours">
                        <span>
                          Duration: <?php echo $duration ?> hours
                        </span>
                      </div>
                      <div class="txbt-tour-hours">
                        <span>
                          Cycling Type: <?php echo $cyclingtype ?>
                        </span>
                      </div>

                      <div class="txbt-tour-hours">
                        <span>
                          Mileage: <?php echo $mileage ?> miles
                        </span>
                      </div>
                      <!--
                      <div class="txbt-tour-hours">
                        <span>
                          Price: $<?php echo $fee ?>
                        </span>
                      </div>
                    -->
                    </div>

                  <div class="col-xs-12 col-md-6">
                    <div  class="clear">
                      <!-- <a class="btn" id="custom">CUSTOMIZE THIS TOUR</a> 
                      <a style="padding:3%; font-size:1.1em;" class="btn btn-primary btn-lg" id="rent" href="http://www.texasbiketours.com/book-tour?tourID=<?php echo $post->ID; ?>&tourName=<?php echo urlencode(get_the_title($tourID)); ?>">CUSTOMIZE THIS TOUR
                      </a>-->
                      <a style="padding:3%; font-size:1.1em;" class="btn btn-primary btn-lg" id="rent" href="http://www.texasbiketours.com/book-tour">REQUEST A TOUR
                      </a>
                    </div>
                  </div>
                </div>

              </div>


            </div>

        </div>

        <!-- / txbt_tour_info -->

        <div class="clear"></div>


        <div class="txbt-tour_excerpt">
          <hr /><h2 class="txbt-tour_title" style="text-align:center;">Tour Description</h2>
          <?php the_content(); ?>
        </div>
        <hr />
        <h2 class="txbt-tour_title" style="text-align:center;">Tour Reviews</h2>
          
          <?php
          
       // echo "categoty = " . $term->term_id;
          
          
        $args = array( 'post_type' => 'tour_review', 'posts_per_page' => -1,
       // 'showposts' => 1,           
       // 'tax_query' => array(   // Note: tax_query expects an array of arrays!
       //     array( 
       //         'taxonomy' => 'tour_category', // 
       //         'field'    => 'id',
       //         'terms'    => $term->term_id,
       //       ),
       //   ),
          );
          
         $loop = new WP_Query( $args );
        
         if ($loop->have_posts()) {
         
          while ( $loop->have_posts() ) : $loop->the_post();
          
                  // Get review Info
                  $reviewtourname = get_post_meta( $post->ID, '_cmb_review_tour_name', true );
                  $reviewtourdate = get_post_meta( $post->ID, '_cmb_review_tour_date', true );
                  $reviewfrom = get_post_meta( $post->ID, '_cmb_review_from', true );
                  $reviewby = get_post_meta( $post->ID, '_cmb_review_author', true );

                  
               //   $reviewtourname = do_shortcode( $reviewtourname );
                  $reviewtourdate = do_shortcode( $reviewtourdate );
                  $reviewfrom = do_shortcode( $reviewfrom );
                  $reviewby = do_shortcode( $reviewby );
                  
            
       // echo 'tour name: ' . $tid .'<br />';
       //  echo 'review for tour: ' . $reviewtourname. '<br />';
       
        // $tid = preg_replace('/[^A-Za-z0-9\-\']/', '', $tid); 
       //  $tid = preg_replace("/'/", '', $tid); 
         
      //   $reviewtourname = htmlentities($reviewtourname, ENT_QUOTES);
                  $reviewtourname = str_replace("&#8217", '', $reviewtourname);
         $reviewtourname = preg_replace("/'/", '', $reviewtourname); 
         $reviewtourname = preg_replace("/&/", '', $reviewtourname);
         $reviewtourname = preg_replace("/[^A-Za-z0-9\-\']/", '', $reviewtourname); 
         
      //  var_dump($tid, $reviewtourname);
         
      //   echo '<hr />';

        if( $tid === $reviewtourname) {
       //    if (strcmp($tid, $reviewtourname) == 0)  {
       //     echo "FOUND";

            echo '<h2 class="txbt-tour_title">';
            the_title();
            echo '</h2>';

            echo '<div class="entry-content">';
            the_content();
            echo '</div>';
            
            

            echo '<div> Review By: '. $reviewby . '</div>';
        //  echo '<div> Tour Name: '. $reviewtourname . '</div>';
            echo '<div> Tour Date: '. $reviewtourdate . '</div>';
            echo '<div> Review From: '. $reviewfrom . '</div>';



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

        <div id="allreviews" style="clear:both;text-align:center; width:100%;">
          <a id="allreviews_btn" class="btn btn-default btn-lg" href="<?php echo get_site_url(); ?>/tour_review/" >See All Reviews</a>
<a id="allreviews_btn" class="btn btn-default btn-lg" href="<?php echo get_site_url(); ?>/tour" >View All Tours</a>

        </div>

      </div>

      <?php endwhile; // end of the loop. ?>

    

      
</div><!-- inner-wrap -->
   
    

  </main><!-- #content -->
		</div><!-- #primary .site-content -->
<?php get_footer();?>