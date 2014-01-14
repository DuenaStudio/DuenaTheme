<?php
/**
 *
 * Template Name: Portfolio Page
 *
 * @package duena
 */

get_header(); ?>
	<div id="primary" class="col-md-12">
		<div id="content" class="site-content" role="main">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
		<div class="page_wrap">		
			<h1 class="post-title"><?php the_title(); ?></h1>
			<div class="post_content pholio">
				<?php the_content(); ?>
			</div>
		</div>
			
		<?php endwhile; else: ?>
		
			<?php get_template_part( 'no', 'results' ); ?>

		<?php endif; ?>
		
		<div class="row">
			<?php duena_portfolio_show(); ?>
		</div>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>