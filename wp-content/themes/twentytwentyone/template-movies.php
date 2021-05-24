<?php /* Template Name: Movie Page */ ?>
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

  require_once( ABSPATH . 'wp-admin/includes/image.php' );
  require_once( ABSPATH . 'wp-admin/includes/file.php' );
  require_once( ABSPATH . 'wp-admin/includes/media.php' );

  $args = array(
    'post_type' => 'movie',
    'posts_per_page' -1,
    'orderby' => 'title',
    'order' => 'ASC'
  );
  $all_films = new WP_Query( $args );		
  ?>

  <?php if ( $all_films->have_posts() ) : // making sure we have movies to show before doing anything?>
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
        <?php $movie_banner = get_post_meta( $c_id, 'my-image-for-post',true); ?>
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

<div class="post_creation_form">
  <h2>Please fill the form to insert a post</h2>
<form method="POST" enctype="multipart/form-data" >
<label>Movie Name</label></br>
        <input type="text" value="" class="input-xlarge" name='title'></br>
        <label>Movie Description</label></br>
        <input type="text" value="" rows="3" class="input-xlarge" name='description'></br>
        <label for="my-image-for-post">Movie Banner</label></br>
		<input type="file" name="my-image-for-post" id="my-image-for-post" /><br />	
 		<label>Movie Budget</label></br>
        <input type="text" value="" class="input-xlarge" name='movie_budget'></br>
        <label>Movie Release Date</label></br>
        <input type="text" value="" class="input-xlarge" name='movie_release_date' placeholder=""></br>
  		</br><div><button class="btn btn-primary">Add Movie</button>
        </div>
        <input type="hidden" name="action" value="movie" />
 </from>
</div>
<?php
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == "movie") {

    $title     = $_POST['title'];
    $post_type = 'movie';
    //the array of arguements to be inserted with wp_insert_post
    $front_post = array(
    'post_title'    => $title,
    'post_status'   => 'publish',          
    'post_type'     => $post_type 
    );

    $post_id = wp_insert_post($front_post);

// code for image uploading in the post
  	$uploaddir = wp_upload_dir();
  	$file = $_FILES["my-image-for-post"]["name"];
  	$uploadfile = $uploaddir['path'] . '/' . basename( $file );

  	move_uploaded_file( $file , $uploadfile );
  	$filename = basename( $uploadfile );

  	$wp_filetype = wp_check_filetype(basename($filename), null );

  	$attachment = array(
  	    'post_mime_type' => $wp_filetype['type'],
  	    'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
  	    'post_content' => '',
  	    'post_status' => 'inherit',
  	    'menu_order' => $_i + 1000
  	);
  	$attach_id = wp_insert_attachment( $attachment, $uploadfile );
  	update_post_meta($post_id,'_thumbnail_id',$attach_id);

    if ( !function_exists('wp_handle_upload') ) {
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    }

    // Move file to media library
    $movefile = wp_handle_upload( $_FILES['my-image-for-post'], array('test_form' => false) );

    // If move was successful, insert WordPress attachment
    if ( $movefile && !isset($movefile['error']) ) {
    $wp_upload_dir = wp_upload_dir();
    $attachment = array(
    'guid' => $wp_upload_dir['url'] . '/' . basename($movefile['file']),
    'post_mime_type' => $movefile['type'],
    'post_title' => preg_replace( '/\.[^.]+$/', ”, basename($movefile['file']) ),
    'post_content' => ”,
    'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment($attachment, $movefile['file']);

    // Assign the file as the featured image
    set_post_thumbnail($post_id, $attach_id);
    // update_field('my-image-for-post', $attach_id, $post_id);

    update_post_meta($post_id, "description", @$_POST["description"]);
    update_post_meta($post_id, "movie_budget", @$_POST["movie_budget"]);
    update_post_meta($post_id, "movie_release_date", @$_POST["movie_release_date"]);
    update_post_meta($post_id, "my-image-for-post", @$_POST["my-image-for-post"]);
  }
}
?>
<?php get_footer(); ?>
