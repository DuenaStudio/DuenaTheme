<?php
/**
 *
 * Template Name: Fullwidth Page
 *
 * @package duena
 */

get_header(); ?>
	<div id="primary" class="col-md-12">
		<div id="content" class="site-content" role="main">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
		<div class="page_wrap fullwidth-page">
			<?php
			if ( has_post_thumbnail() ) {
				echo '<figure class="featured-thumbnail thumbnail">' . get_the_post_thumbnail( get_the_id(), 'slider-post-thumbnail' ) . '</figure>';
			}
			?>	
			<h1 class="post-title"><?php the_title(); ?></h1>
			<div class="post_content">
				<?php the_content(''); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'duena' ), 'after' => '</div>' ) ); ?>
			</div>
		</div>
		<?php endwhile; else: ?>
		
				<?php get_template_part( 'no', 'results' ); ?>

    		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>