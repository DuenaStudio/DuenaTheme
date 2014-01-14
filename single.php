<?php
/**
 * The Template for displaying all single posts.
 *
 * @package duena
 */

get_header(); ?>

	<div id="primary" class="col-md-8 <?php echo esc_attr( of_get_option('blog_sidebar_pos') ) ?>">
		<div id="content" class="site-content" role="main">

		<?php while (have_posts()) : the_post(); 			

				// The following determines what the post format is and shows the correct file accordingly
				$format = get_post_format();
				get_template_part( 'post-formats/'.$format );					
				if($format == '')
				get_template_part( 'post-formats/standard' );
				get_template_part( 'post-formats/post-nav' );
				get_template_part( 'post-formats/related-posts' );			
				comments_template('', true);
			endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>