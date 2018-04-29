<?php
/*
 Template Name: Custom Search
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Texas Bike Tours
 * @since Texas Bike Tours 1.0
 */

get_header(); ?>




		<div id="primary" class="site-content">
			<div id="content" role="main">
        <div class="row-fluid">
          <!--first of 3 sections-->

          <?php
$list = array();
$item = array();
foreach($_POST as $key => $value){
	if($value != ''){
		$item['taxonomy'] = htmlspecialchars($key);
		$item['terms'] = htmlspecialchars($value);
		$item['field'] = 'slug';
		$list[] = $item;
	}
}
$cleanArray = array_merge(array('relation' => 'AND'), $list);

$args['post_type'] = 'tour';
$args['showposts'] = 9;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args['paged'] = $paged;
$args['tax_query'] = $cleanArray;
$the_query = new WP_Query( $args );
?>

          <?php echo ($the_query->found_posts > 0) ? '<h3 class="foundPosts">' . $the_query->found_posts. ' listings found</h3>' : '<h3 class="foundPosts">We found no results</h3>';?>
          <?php while ( $the_query->have_posts() ) : $the_query->the_post();?>

          //add our code here i.e. the_title();

          <?php endwhile; wp_reset_postdata();?>

          <div class="row page-navigation">
            <?php next_posts_link('&laquo; Older Entries', $the_query->max_num_pages) ?>
            <?php previous_posts_link('Newer Entries &raquo;') ?>
          </div>
        </div>
	</div><!-- #content -->
		</div><!-- #primary .site-content -->

<?php get_footer(); ?>