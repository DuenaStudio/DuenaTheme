<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package duena
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function duena_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'duena_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 */
function duena_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'duena_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function duena_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'duena_enhanced_image_navigation', 10, 2 );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function duena_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'duena' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'duena_wp_title', 10, 2 );

/**
 * Show gallery on blog page
 */
function duena_gallery_sl() {
	?>
	<div class="gallery_slider">
	<?php
		global $post;
        $args = array(
            'post_type' => 'attachment', 
            'post_mime_type' => 'image', 
            'numberposts' => 20, 
            'post_status' => null, 
            'post_parent' => $post->ID, 
            'orderby' => 'menu_order', 
            'order' => 'asc'
        );
        $attachments = get_posts( $args );
        if ( $attachments ) {
        	?>
			<ul class="slides">
        	<?php
        	$gal_counter = 0;
        	foreach ( $attachments as $attachment ) {
        		$cur_url = wp_get_attachment_url( $attachment->ID, false );

        	?>
        		<li>
	        	<?php

	        		$gal_image = wp_get_attachment_image_src( $attachment->ID,'thumbnail');
	        		if ("" == $gal_image) $gal_image = $cur_url;
	        	?>
		        	<a href="<?php echo esc_url( $cur_url ); ?>" class="lightbox_img" data-effect="mfp-zoom-in">
		        		<img src="<?php echo esc_url( $gal_image[0] ); ?>" alt="">
		        	</a>
	        	</li>
	        	<?php
	        	$gal_counter ++;
        	}
        	?>
        	</ul>
        	<?php
        }
	?>
	</div>
	<script type="text/javascript">
	/* <![CDATA[ */
	    jQuery(window).load(function() {
	        jQuery('.gallery_slider').flexslider({
	            animation: 'fade',
	            slideshow: true,
	            controlNav: true,
	            directionNav: false
	        }); 
	    });
	/* ]]> */
	</script>
	<?php
}

function duena_post_format_image() {
	global $post;
	if ( function_exists('get_post_format_meta') ) {
		$meta = get_post_format_meta( $post->ID );
	}
	if ( ! empty( $meta['image'] ) ) {
		$att_id = img_html_to_post_id( $meta['image'] );
		$image = wp_get_attachment_image( $att_id, array(770, 295) );
		$cur_url = wp_get_attachment_url( $att_id, false );
	} elseif ( has_post_thumbnail() ) {
		$post_thumbnail_id = get_post_thumbnail_id();
		$image = wp_get_attachment_image( $post_thumbnail_id, array(770, 295) );
		$cur_url = wp_get_attachment_url( $post_thumbnail_id, false );
	} else {
		$args = array(
            'post_type' => 'attachment', 
            'post_mime_type' => 'image', 
            'numberposts' => 1, 
            'post_status' => null, 
            'post_parent' => $post->ID, 
            'orderby' => 'menu_order', 
            'order' => 'asc'
        );
        $attachments = get_posts( $args );

        if ( $attachments ) {
	        foreach ( $attachments as $attachment ) {
	        	$image = wp_get_attachment_image( $attachment->ID, array(770, 295) );
	        	$cur_url = wp_get_attachment_url( $attachment->ID, false );
	        }
        }
	}
	if (isset($cur_url)) {
		echo '<a href="'.$cur_url.'" class="lightbox_img single" data-effect="mfp-zoom-in">'.$image.'</a>';
	}
}

function duena_portfolio_show() {
	wp_reset_query();
	global $post;
	$post_num = get_option( 'posts_per_page' );
	$args = array(
		'posts_per_page' => $post_num
	);
	$count_portf = 0;
	$portf_query = new WP_Query( $args );
	if ( $portf_query->have_posts() ):
		while ( $portf_query->have_posts() ) :
			$portf_query->the_post();
			if ( has_post_thumbnail() ) {
				?>
				<div class="span4 portf_item">
					<div class="hentry">
						<figure class="featured-thumbnail thumbnail">
							<a href="<?php echo get_permalink(); ?>">
								<?php the_post_thumbnail(); ?>
							</a>
						</figure>
						<div class="post_content">
							<h5>
								<a href="<?php echo get_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h5>
							<div class="excerpt">
							<?php 
								$excerpt = get_the_excerpt();
								if (has_excerpt()) {
										the_excerpt();
								} else {
										echo duena_string_limit_words($excerpt,10);
								}
							?>
							</div>
							<a href="<?php the_permalink() ?>" class="more_link"><?php _e('Read more', 'duena'); ?></a>
						</div>
					</div>
				</div>
			<?php
			$count_portf++;
			$portf_num = $count_portf % 3;
			if ( 0 == $portf_num ) {
				?>
				<div class="clear"></div>
				<?php
			}
			}
		endwhile;
	endif;
}