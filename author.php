<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package duena
 */

get_header(); ?>

	<div id="primary" class="col-md-8 <?php echo esc_attr( of_get_option('blog_sidebar_pos') ) ?>">
		<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
						/* Queue the first post, that way we know
						 * what author we're dealing with (if that is the case).
						*/
						the_post();
						printf( __( 'About: %s', 'duena' ), get_the_author() );
						/* Since we called the_post() above, we need to
						 * rewind the loop back to the beginning that way
						 * we can run the loop properly, in full.
						 */

					?>
				</h1>
			</header><!-- .page-header -->

			<div class="author-info author-page">
				<figure class="featured-thumbnail thumbnail">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), 120, '', get_the_author_meta( 'nickname' ) ); ?>
				</figure><!-- .author-avatar -->
				<div class="author-description">
					<p>
						<?php the_author_meta( 'description' ); ?>
					</p>
				</div><!-- .author-description -->
			</div><!-- .author-info -->
			<h2 class="page-title">
				<?php printf( __( 'Author Archives: %s', 'duena' ), get_the_author() );	?>
			</h2>
			<?php rewind_posts(); ?>
			<?php /* Start the Loop */ ?>
			<?php while (have_posts()) : the_post(); 			

				// The following determines what the post format is and shows the correct file accordingly
				$format = get_post_format();
				get_template_part( 'post-formats/' . $format );					
				if($format == '')
				get_template_part( 'post-formats/standard' );					
			endwhile; ?>

		<?php else : ?>

			<div class="no-results">
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'duena' ); ?></p>
    			<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
  			</div><!--no-results-->	

		<?php endif; ?>
		<?php get_template_part('post-formats/post-nav'); ?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>