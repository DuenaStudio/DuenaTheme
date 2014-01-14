			<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder'); ?>>

				<?php
					$stickyclass = 'sticky';
					get_template_part('post-formats/post-thumb'); 
				?>

				<header class="post-header <?php if( is_singular() && is_sticky() ) echo esc_attr( $stickyclass ); ?>">
					<?php if ( is_sticky() ) echo "<span class='featured_badge'><i class='fa fa-thumb-tack'></i><strong>".__( 'Featured', 'duena' )."</strong></span>"; ?>
					<?php if(!is_singular()) : ?>
					
					<h3 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php esc_attr_e('Permalink to:', 'duena');?> <?php the_title(); ?>"><?php the_title(); ?></a></h3>
					
					<?php else :?>
					
					<h1 class="post-title"><?php the_title(); ?></h1>
					
					<?php endif; ?>
				
				</header>
				
				<?php if(!is_singular()) : ?>
				
				<!-- Post Content -->
				<div class="post_content">
					<?php if ( 'false' != of_get_option('post_excerpt')) { ?>
						<div class="excerpt">
						<?php 
							$excerpt = get_the_excerpt();
							if (has_excerpt()) {
									the_excerpt();
							} else {
									echo apply_filters( 'the_excerpt', duena_string_limit_words($excerpt,55) );
							}
						?>
						</div>
					<?php } ?>
					<?php 
						if ( 'false' != of_get_option('post_button')) { 
							$button_text = of_get_option( 'post_button_txt' );
							if ( '' == $button_text ) $button_text = __( 'Read more', 'duena' );
					?>
						<a href="<?php the_permalink() ?>" class="more_link"><?php echo $button_text; ?></a>
					<?php } ?>
				</div>
				
				<?php else :?>
				
				<!-- Post Content -->
				<div class="post_content">
				
					<?php the_content(''); ?>
					<?php 
						wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'duena' ), 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); 
					?>
				</div>
				<!-- //Post Content -->
				<?php if( has_tag() ) { ?>
				<footer class="post-footer">
					<i class="fa fa-tags"></i> <?php the_tags(__( 'Tags: ', 'duena' ), ' ', ''); ?>
				</footer>
				<?php } ?>
				<?php endif; ?>
				
				<?php get_template_part('post-formats/post-meta'); ?>

			</article>

			<?php if ( is_single() && get_the_author_meta( 'description' ) ) {
				get_template_part( 'post-formats/author-bio' );
			} ?>
