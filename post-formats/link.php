 			<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder'); ?>>
			
					<?php $stickyclass = 'sticky'; ?>

					<header class="post-header <?php if( is_singular() && is_sticky() ) echo esc_attr( $stickyclass ); ?>">
						<?php if ( is_sticky() ) echo "<span class='featured_badge'><i class='fa fa-thumb-tack'></i><strong>".__( 'Featured', 'duena' )."</strong></span>"; ?>
						<?php if ( is_single() ) { ?>
						<h1 class="post-title">
							<?php if ( function_exists('get_the_post_format_url') ) { ?>
								<a href="<?php echo esc_url( duena_get_link_url() ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
							 <?php } else {
							?>
								<a href="<?php the_permalink(); ?>" title="<?php esc_attr_e('Permalink to:', 'duena');?> <?php the_title(); ?>"><?php the_title(); ?></a>
							<?php
							 } ?>
						</h1>
						<?php } else { ?>
						<h4 class="post-title link">
							<?php if ( function_exists('get_the_post_format_url') ) { ?>
								<a href="<?php echo esc_url( duena_get_link_url() ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
							 <?php } else {
							?>
								<a href="<?php the_permalink(); ?>" title="<?php esc_attr_e('Permalink to:', 'duena');?> <?php the_title(); ?>"><?php the_title(); ?></a>
							<?php
							 } ?>
							
						</h4>
						<?php } ?>
						
					</header>
					
					
					<!-- Post Content -->
					<div class="post_content">
						<?php the_content( __( 'Continue reading', 'duena' ) ); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'duena' ), 'after' => '</div>' ) ); ?>
					</div>
					<!-- //Post Content -->
					<?php if( ( has_tag() ) && ( is_singular() ) ) { ?>
						<footer class="post-footer">
							<i class="fa fa-tags"></i> <?php the_tags(__( 'Tags: ', 'duena' ), ' ', ''); ?>
						</footer>
					<?php } ?>
					<?php get_template_part('post-formats/post-meta'); ?>
					
					
			<!--//.post-holder-->  
			</article>

			<?php if ( is_single() && get_the_author_meta( 'description' ) ) {
				get_template_part( 'post-formats/author-bio' );
			} ?>
