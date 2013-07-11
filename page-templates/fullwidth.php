<?php
/**
 *
 * Template Name: Fullwidth Page
 *
 * @package duena
 */

get_header(); ?>
	<div id="primary" class="span12">
		<div id="content" class="site-content" role="main">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
		<div class="page_wrap">		
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