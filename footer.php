<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package duena
 */
?>
			</div>
		</div>
	</div><!-- #main -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="site-info col-md-12">
				<div class="footer-text">
					<?php 
					$footer_text = esc_attr(of_get_option('footer_text'));
					if ('' != $footer_text) {
						echo stripslashes(htmlspecialchars_decode($footer_text));
					} else { ?>
						<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'duena' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'duena' ), 'WordPress' ); ?></a>
					<?php } ?>
				</div>
				<?php if ('true' == of_get_option('footer_menu')) {
					wp_nav_menu( array( 
						'container'       => 'ul', 
		                'menu_class'      => 'footer-menu', 
		                'menu_id'         => 'footer-nav',
		                'depth'           => 0,
		                'theme_location' => 'footer' 
					) ); 
				}
				?>
				<div class="clear"></div>
				<div id="toTop"><i class="fa fa-chevron-up"></i></div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- .page-wrapper -->

<?php wp_footer(); ?>
</body>
</html>