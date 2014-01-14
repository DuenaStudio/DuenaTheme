<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package duena
 */

get_header(); ?>

	<div id="primary" class="page404 col-md-12">
		<div class="hentry">
			<div class="error404-num">404</div>
			<div>
		      <hgroup>
		        <h1><?php _e( 'Sorry!', 'duena' ); ?></h1>
		        <h2><?php _e( 'Page Not Found', 'duena' ); ?></h2>
		      </hgroup>
		      <h6><?php _e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'duena' ); ?></h6>
		      <p><?php _e( 'Please try using our search box below to look for information on the internet.', 'duena' ); ?></p>
		      <?php get_search_form(); /* outputs the default Wordpress search form */ ?>
		    </div>
		</div>
	</div><!-- #primary -->

<?php get_footer(); ?>