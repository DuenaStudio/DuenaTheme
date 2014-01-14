<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package duena
 */

get_header(); ?>
	<div id="primary" class="col-md-8 <?php echo esc_attr( of_get_option('blog_sidebar_pos') ) ?>">
		<div id="content" class="site-content" role="main">

		<?php if (have_posts()) : while (have_posts()) : the_post(); 			

				// The following determines what the post format is and shows the correct file accordingly
				$format = get_post_format();
				get_template_part( 'post-formats/'.$format );					

				if($format == '')
				get_template_part( 'post-formats/standard' );	
				
			endwhile; 

			get_template_part('post-formats/post-nav');

			else: ?>
		
				<div class="no-results">
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'duena' ); ?></p>
        			<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
      			</div><!--no-results-->			

    		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>