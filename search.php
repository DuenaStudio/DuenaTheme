<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package duena
 */

get_header(); ?>

	<div id="primary" class="col-md-8 <?php echo esc_attr( of_get_option('blog_sidebar_pos') ) ?>">
		<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'duena' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while (have_posts()) : the_post(); 			

				// The following determines what the post format is and shows the correct file accordingly
				$format = get_post_format();
				get_template_part( 'post-formats/'.$format );					
				if($format == '')
				get_template_part( 'post-formats/standard' );					
			endwhile; ?>

		<?php else : ?>

			<?php get_template_part( 'no', 'results' ); ?>

		<?php endif; ?>
		<?php get_template_part('post-formats/post-nav'); ?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>