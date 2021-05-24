<?php /* Template Name: Books Page */ ?>
<?php get_header(); ?>
<style type="text/css">
body {
   width: 1064px;
   margin: 0 auto !important;
   padding: 0 20px;
}

#top, .footer-wrap {margin: 0;}
</style>
<div id="primary" class="content-area">

<div class="tab-pane active" id="all">
  <?php 	
  $args = array(
    'post_type' => 'book',
    'posts_per_page' -1,
    'orderby' => 'title',
    'order' => 'ASC'
  );
  $all_films = new WP_Query( $args );		
  ?>

  <?php if ( $all_films->have_posts() ) : // make sure we have movies to show before doing anything?>
  <div class="table-responsive">
    <table class="table">
    	<tr>
        <td>Title</td>
        <td>Budget</td>
        <td>Release Date</td>
        <td>Movie Banner</td>
        <td>Description</td>	

    	</tr>
	      <?php while ( $all_films->have_posts() ) : $all_films->the_post(); 
	      $c_id = get_the_ID();
	      ?>	
      	<tr>
        <td><h3><?php the_title() ?></h3></td>
        
        <td><h3><?php echo get_post_meta($c_id, 'movie_budget', true) ?></h3></td>
        <td><h3><?php echo get_post_meta($c_id, 'movie_release_date', true) ?></h3></td>
        <td> 
        <?php $movie_banner = get_post_meta( $c_id, 'book_image',true); ?>
        <img style="width: 150px; height: 100px;" src="<?php echo $movie_banner; ?>">
    	</td>
        <td>
          <p class="lead"><?php the_excerpt() ?></p>
          <a href="<?php the_permalink() ?>" class="btn btn-primary">Read more</a>
        </td>
      </tr>
      <?php endwhile; ?>
      <?php wp_reset_query() ?>
    </table>
  </div>
  <?php endif; ?>

</div>
</div>

<?php get_footer(); ?>
