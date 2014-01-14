			<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder'); ?>>
			<?php $stickyclass = 'sticky'; ?>
					<header class="post-header <?php if( is_singular() && is_sticky() ) echo esc_attr( $stickyclass ); ?>">
						<?php if ( is_sticky() ) echo "<span class='featured_badge'><i class='fa fa-thumb-tack'></i><strong>".__( 'Featured', 'duena' )."</strong></span>"; ?>
						<?php if(is_singular()) : ?>
						
						<h1 class="post-title"><?php the_title(); ?></h1>
						
						<?php endif; ?>
					
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
