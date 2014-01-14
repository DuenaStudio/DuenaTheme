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
	global $post;
	?>
	<div class="gallery_slider gallery-<?php echo $post->ID; ?>">
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

	        		$gal_image = wp_get_attachment_image_src( $attachment->ID,'image_post_format' );
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
	<?php if ( $attachments ) { ?>
	<script type="text/javascript">
	/* <![CDATA[ */
	    jQuery(window).load(function() {
	        jQuery('.gallery-<?php echo $post->ID; ?>').flexslider({
	            animation: 'fade',
	            slideshow: true,
	            controlNav: true,
	            directionNav: false
	        });

	        jQuery(".gallery-<?php echo $post->ID; ?> .lightbox_img").magnificPopup({
				type: 'image',
				removalDelay: 500, //delay removal by X to allow out-animation
				callbacks: {
				    beforeOpen: function() {
				      // just a hack that adds mfp-anim class to markup 
				       this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
				       this.st.mainClass = this.st.el.attr('data-effect');
				    }
				},
				gallery:{enabled:true}
			});
	    });
	/* ]]> */
	</script>
	<?php
	}
}

/**
 * Image post format custom output
 */
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

/**
 * Show loop on portfolio page template
 */
function duena_portfolio_show() {
	wp_reset_query();
	global $post;
	$post_num = of_get_option( 'portfolio_per_page', '12' );
	$post_num = intval($post_num);
	if ( 0 == $post_num ) {
		$post_num = 12;
	}
	$args = array(
		'posts_per_page'      => $post_num,
		'ignore_sticky_posts' => 1
	);
	$from_cat = get_post_meta( $post->ID, 'duena_portfolio_meta_cats', true );
	if ( '' != $from_cat && 'from_all' != $from_cat ) {
		$args['cat'] = $from_cat;
	}

	$count_portf = 0;
	$item_class = 'portf_item';
	$columns =  intval(get_post_meta( $post->ID, 'duena_portfolio_meta_cols', true ));
	if ( '' == $columns || 0 == $columns ) {
		$columns = 3;
	}
	switch ($columns) {
		case 2:
			$item_class .= ' col-md-6';
			break;
		
		case 3:
			$item_class .= ' col-md-4';
			break;

		case 4:
			$item_class .= ' col-md-3';
			break;
	}

	$portf_query = new WP_Query( $args );
	if ( $portf_query->have_posts() ):
		while ( $portf_query->have_posts() ) :
			$portf_query->the_post(); ?>
			<div class="<?php echo esc_attr( $item_class ); ?>">
				<div class="hentry">
				<?php 
					$show_thumb = of_get_option( 'portfolio_show_thumbnail', 'true' ); 					
					if ( 'true' == $show_thumb ) {
				?>
					<figure class="featured-thumbnail thumbnail">
						<a href="<?php echo get_permalink(); ?>">
							<?php 
								switch ($columns) {
									case 2:
										$thumb_size = 'portfolio-large-th';
										break;
									
									case 3:
										$thumb_size = 'post-thumbnail';
										break;

									case 4:
										$thumb_size = 'portfolio-small-th';
										break;
								}
								the_post_thumbnail( $thumb_size ); 
							?>
						</a>
					</figure>
				<?php } ?>
					<div class="post_content">
					<?php 
						$show_title = of_get_option( 'portfolio_show_title', 'true' ); 					
						if ( 'true' == $show_title ) {
					?>
						<h5>
							<a href="<?php echo get_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</h5>
					<?php 
						}
						$show_excerpt = of_get_option( 'portfolio_show_excerpt', 'true' ); 					
						if ( 'true' == $show_excerpt ) {
					?>
						<div class="excerpt">
						<?php 
							$excerpt = get_the_excerpt();
							if (has_excerpt()) {
								the_excerpt();
							} else {
								echo apply_filters( 'the_excerpt', duena_string_limit_words($excerpt,20) );
							}
						?>
						</div>
					<?php 
						}
						$show_link = of_get_option( 'portfolio_show_link', 'true' ); 					
						if ( 'true' == $show_link ) {
					?>
						<a href="<?php the_permalink() ?>" class="more_link"><?php _e('Read more', 'duena'); ?></a>
					<?php } ?>
					</div>
				</div>
			</div>
			<?php
			$count_portf++;
			$portf_num = $count_portf % $columns;
			if ( 0 == $portf_num ) {
				?>
				<div class="clear"></div>
				<?php
			}
		endwhile;
	endif;
	wp_reset_query();
}

/**
 * Get colors
 */
function duena_get_user_colors() {
	$primary_color = of_get_option( 'cs_primary_color', '#FF5B5B' );
	$secondary_color = of_get_option( 'cs_secondary_color', '#71A08B' );
	$colors = "
    a,
    .searchform .screen-reader-text,
    .post_meta i,
    .author_bio_sidebar .social_box a,
    .post-title a:hover,
    .post-footer i,
    .page_nav_wrap .post_nav ul li .current,
    .page_nav_wrap .post_nav ul li a:hover {
		color: " . $primary_color . ";
	}
	.post_type_label,
	.flex-direction-nav a,
	#content .featured_badge,
	.author_bio_sidebar .social_box,
	.flex-control-paging li a.flex-active,
	.flex-control-paging li a:hover,
	#toTop,
	.post-footer a,
	.navbar_inner > div > ul ul, 
	.navbar_inner > ul ul,
	.btn.btn-primary,
	input[type='submit'],
	input[type='reset'] {
		background-color: " . $primary_color . ";
	}
	.site-info,
	.widget,
	#slider-wrapper .flexslider,
	.navbar_inner > div > ul > li > a,
	.navbar_inner > div > ul > li > a:hover, 
	.navbar_inner > div > ul > li.sfHover > a, 
	.navbar_inner > div > ul > li.current-menu-item > a, 
	.navbar_inner > div > ul > li.current_page_item > a,
	.navbar_inner > ul > li > a,
	.navbar_inner > ul > li > a:hover, 
	.navbar_inner > ul > li.sfHover > a, 
	.navbar_inner > ul > li.current-menu-item > a, 
	.navbar_inner > ul > li.current_page_item > a,
	.breadcrumb,
	#comments,
	.post-footer a,
	.author-info {
		border-color: " . $primary_color . ";
	}
	a:hover,
	a:focus {
		color: " . $secondary_color . ";
	}

	.btn.btn-primary:hover,
	input[type='submit']:hover,
	input[type='reset']:hover,
	.slider-caption .btn.btn-primary:hover {
		background-color: " . $secondary_color . ";
	}

	textarea:focus,
	input[type='text']:focus,
	input[type='password']:focus,
	input[type='datetime']:focus,
	input[type='datetime-local']:focus,
	input[type='date']:focus,
	input[type='month']:focus,
	input[type='time']:focus,
	input[type='week']:focus,
	input[type='number']:focus,
	input[type='email']:focus,
	input[type='url']:focus,
	input[type='search']:focus,
	input[type='tel']:focus,
	input[type='color']:focus,
	.uneditable-input:focus {
		border-color: " . $primary_color . ";
		box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 2px " . $primary_color . ";
	}
	";


	$list_bullet = of_get_option( 'cs_list_bullet' );
	if ( '' != $list_bullet ) {
		$colors .= "
		ul li {
			background: url(" . esc_url( $list_bullet ) . ") no-repeat 0 0;
		}
		";
	}

	return $colors;
}

/**
 * Add Portfolio page template custom fields
 */
function duena_add_portfolio_meta_box() {
	add_meta_box( 'duena-portfolio-page', __( 'Page Options', 'duena' ), 'duena_show_porfolio_metabox', 'page', 'normal', 'high' );
}
add_action('admin_menu', 'duena_add_portfolio_meta_box');

function duena_show_porfolio_metabox( $post ) {
	echo '<input type="hidden" name="duena_portfolio_meta_box_nonce" value="' . wp_create_nonce( basename(__FILE__) ) . '" />';
	echo '<table class="form-table">';
		echo '<tr>';
			echo '<td>';
				_e( 'Select columns number', 'duena' );
			echo '</td>';
			echo '<td>';

				$curr_cols = intval(get_post_meta( $post->ID, 'duena_portfolio_meta_cols', true ));
				if ( '' == $curr_cols || 0 == $curr_cols ) {
					$curr_cols = 3;
				}

				echo '<select name="duena_portfolio_meta_cols">';
					echo '<optgroup>';
						echo '<option value="2" ' . selected( $curr_cols, 2, false ) . '>2</option>';
						echo '<option value="3" ' . selected( $curr_cols, 3, false ) . '>3</option>';
						echo '<option value="4" ' . selected( $curr_cols, 4, false ) . '>4</option>';
					echo '</optgroup>';
				echo '</select>';
			echo '</td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td>';
				_e( 'Select category to pull posts from', 'duena' );
			echo '</td>';
			echo '<td>';

				// Pull all the categories into an array
				$all_categories = array();  
				$all_categories_obj = get_categories();
				foreach ($all_categories_obj as $category) {
						$all_categories[$category->cat_ID] = $category->cat_name;
				}
				
				$all_cats_array = array('from_all' => __( 'Select from all', 'duena' ) ) + $all_categories;

				$curr_cat = get_post_meta( $post->ID, 'duena_portfolio_meta_cats', true ); 
				if ( '' == $curr_cat ) {
					$curr_cat = 'from_all';
				}

				echo '<select name="duena_portfolio_meta_cats">';
					echo '<optgroup>';
					foreach ($all_cats_array as $cat_id => $cat_name) {
						echo '<option value="' . $cat_id . '" ' . selected( $curr_cat, $cat_id, false ) . '>' . $cat_name . '</option>';
					}
					echo '</optgroup>';
				echo '</select>';
			echo '</td>';
		echo '</tr>';
	echo '</table>';
}

/**
 * Save Portfolio page template custom fields
 */
function duena_save_portfolio_meta( $post_id ) {

	// verify nonce
	if (!isset($_POST['duena_portfolio_meta_box_nonce']) || !wp_verify_nonce($_POST['duena_portfolio_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
	// check user permissions
	if (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	$saved_data = array( 'duena_portfolio_meta_cols', 'duena_portfolio_meta_cats' );

	foreach ( $saved_data as $single_field ) {
		$currnet_data = get_post_meta( $post_id, $single_field, true );
		$new_data = $_POST[$single_field];
		if ( isset($new_data) && $new_data != $currnet_data ) {
			update_post_meta( $post_id, $single_field, $new_data, $currnet_data );
		}

	}

	
}
add_action('save_post', 'duena_save_portfolio_meta');
?>