<?php
/**
 * duena functions and definitions
 *
 * @package duena
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 900; /* pixels */

// The excerpt based on words
if ( !function_exists('duena_string_limit_words') ) {
	function duena_string_limit_words($string, $word_limit) {
	  $words = explode(' ', $string, ($word_limit + 1));
	    if(count($words) > $word_limit) array_pop($words);
	    $res = implode(' ', $words);
	    $res = trim ($res);
	    $res = preg_replace("/[.]+$/", "", $res);
	    if ( '' !=  $res) {
	    	return $res . '... ';
		} else {
			return $res;
		}
	}
}
/*
 * Load Files.
 */

//Loading options.php for theme customizer
include_once( get_template_directory() . '/options.php');

//Loads the Options Panel
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/options/' );
	include_once( get_template_directory() . '/options/options-framework.php' );
}
	


/*
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/inc/jetpack.php' );

if ( ! function_exists( 'duena_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function duena_setup() {

	$defaults = array(
		'default-color'          => '',
		'default-image'          => '',
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => ''
	);

	add_theme_support( 'custom-background', $defaults );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * Customizer additions
	 */
	require( get_template_directory() . '/inc/customizer.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on duena, use a find and replace
	 * to change 'duena' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'duena', get_template_directory() . '/languages' );


	/**
	 * Add editor styles
	 */

	add_editor_style( 'css/editor-style.css' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in two locations.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'duena' ),
		'footer' => __( 'Footer Menu', 'duena' )
	) );

	/*
	 * This theme supports all available post formats.
	 * See http://codex.wordpress.org/Post_Formats
	 *
	 * Structured post formats are formats where Twenty Thirteen handles the
	 * output instead of the default core HTML output.
	 */
	add_theme_support( 'structured-post-formats', array(
		'link', 'video'
	) );
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'quote', 'status'
	) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

	/**
	 * Add image sizes
	 */

	if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 750, 290, true ); // Normal post thumbnails
		add_image_size( 'slider-post-thumbnail', 1140, 440, true ); // Slider Thumbnail
		add_image_size( 'image_post_format', 750, 440, true ); // Image Post Format output
		add_image_size( 'related-thumb', 160, 160, true ); // Realted Post Image output
		add_image_size( 'portfolio-large-th', 550, 210, true ); // 2 cols portfolio image
		add_image_size( 'portfolio-small-th', 265, 100, true ); // 4 cols portfolio image
	}

}
endif; // duena_setup
add_action( 'after_setup_theme', 'duena_setup' );



/**
 * Register widgetized area and update sidebar with default widgets
 */
function duena_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'duena' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'duena_widgets_init' );



/**
 * Enqueue scripts and styles
 */
function duena_styles() {
	global $wp_styles;

	// Bootstrap styles
	wp_register_style( 'duena-bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.css');
	wp_enqueue_style( 'duena-bootstrap' );

	// Slider styles
	wp_register_style( 'flexslider', get_template_directory_uri() . '/css/flexslider.css');
	wp_enqueue_style( 'flexslider' );

	// Popup styles
	wp_register_style( 'magnific', get_template_directory_uri() . '/css/magnific-popup.css');
	wp_enqueue_style( 'magnific' );

	// FontAwesome stylesheet
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', '', '4.0.3');
	wp_enqueue_style( 'font-awesome' );

	// Main stylesheet
	wp_enqueue_style( 'duena-style', get_stylesheet_uri() );

	// Add inline styles from theme options
	$duena_user_css = duena_get_user_colors();
    wp_add_inline_style( 'duena-style', $duena_user_css );

    // Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'duena_ie', get_template_directory_uri() . '/css/ie.css' );
	$wp_styles->add_data( 'duena_ie', 'conditional', 'lt IE 9' );

}

function duena_scripts() {

	wp_enqueue_script( 'duena-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'duena-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'duena-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

	// Menu scripts
	wp_enqueue_script('superfish', get_template_directory_uri() . '/js/superfish.js', array('jquery'), '1.4.8', true);
	wp_enqueue_script('mobilemenu', get_template_directory_uri() . '/js/jquery.mobilemenu.js', array('jquery'), '1.0', true);
	wp_enqueue_script('sf_Touchscreen', get_template_directory_uri() . '/js/sfmenu-touch.js', array('jquery'), '1.0', true);

	// Slider
	wp_enqueue_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array('jquery'), '2.1', true);
	
	// PopUp
	wp_enqueue_script('magnific', get_template_directory_uri() . '/js/jquery.magnific-popup.js', array('jquery'), '0.8.9', true);

	// Bootstrap JS
	wp_enqueue_script('bootstrap-custom', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'), '1.0', true);

	// Custom Script File
	wp_enqueue_script('custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0', true);

}
add_action( 'wp_enqueue_scripts', 'duena_scripts', 10 );
add_action( 'wp_enqueue_scripts', 'duena_styles', 10 );


/**
 * Include additional assests for admin area
 */
function duena_admin_assets() {
	$screen = get_current_screen();
	if ( isset( $screen ) && 'page' == $screen->post_type ) {
		// scripts
		wp_enqueue_script( 'duena-admin-script', get_template_directory_uri() . '/js/admin-scripts.js', array('jquery'), '1.0', true );
		// styles
		wp_enqueue_style( 'duena-admin-style', get_template_directory_uri() . '/css/admin-style.css', '', '1.0' );
	}
}
add_action( 'admin_enqueue_scripts', 'duena_admin_assets' );

/**
 * Adding class 'active' to current menu item
 */

add_filter( 'nav_menu_css_class', 'duena_active_item_classes', 10, 2 );

function duena_active_item_classes($classes = array(), $menu_item = false){

    if(in_array('current-menu-item', $menu_item->classes)){
        $classes[] = 'active';
    }

    return $classes;
}

/**
 * Load localization
 */
load_theme_textdomain( 'duena', get_template_directory() . '/languages' );

/*-----------------------------------------------------------------------------------*/
/*	Custom Gallery
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'duena_featured_gallery' ) ) :

function duena_featured_gallery() {
	$pattern = get_shortcode_regex();

	if ( preg_match( "/$pattern/s", get_the_content(), $match ) && 'gallery' == $match[2] ) {
		add_filter( 'shortcode_atts_gallery', 'duena_gallery_atts' );
		echo do_shortcode_tag( $match );
	}
}
endif;

function duena_gallery_atts( $atts ) {
	$atts['size'] = 'large';
	return $atts;
}

/*-----------------------------------------------------------------------------------*/
/*	Get link URL for link post type
/*-----------------------------------------------------------------------------------*/

function duena_get_link_url() {
	$has_url = get_the_post_format_url();

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}



/*-----------------------------------------------------------------------------------*/
/*	Breabcrumbs
/*-----------------------------------------------------------------------------------*/
if (! function_exists( 'duena_breadcrumb' )) {
	function duena_breadcrumb() {
	  $showOnHome = 0; // 1 - show "breadcrumbs" on home page, 0 - hide
	  $delimiter = '<li class="divider">/</li>'; // divider
	  $home = 'Home'; // text for link "Home"
	  $showCurrent = 1; // 1 - show title current post/page, 0 - hide
	  $before = '<li class="active">'; // open tag for active breadcrumb
	  $after = '</li>'; // close tag for active breadcrumb

  	  global $post;
  		$homeLink = home_url();

 	 if (is_front_page()) {

    	if ($showOnHome == 1) echo '<ul class="breadcrumb breadcrumb__t"><li><a href="' . $homeLink . '">' . $home . '</a><li></ul>';

  	} else {

    	echo '<ul class="breadcrumb breadcrumb__t"><li><a href="' . $homeLink . '">' . $home . '</a></li> ' . $delimiter . ' ';
	
	if ( is_home() ) {
		echo $before . 'Blog' . $after;
	} elseif ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo $before . 'Category Archives: "' . single_cat_title('', false) . '"' . $after;

    } elseif ( is_search() ) {
      echo $before . 'Search for: "' . get_search_query() . '"' . $after;

    } elseif ( is_day() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
      echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;

    } elseif ( is_month() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;

    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
      	$post_name = get_post_type();
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<li><a href="' . $homeLink . '/' . $post_name . '/">' . $post_type->labels->singular_name . '</a></li>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;

    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;

    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

    } elseif ( is_tag() ) {
      echo $before . 'Tag Archives: "' . single_tag_title('', false) . '"' . $after;

    } elseif ( is_author() ) {
      global $author;
      $userdata = get_userdata($author);
      echo $before . 'by ' . $userdata->display_name . $after;

    } elseif ( is_404() ) {
      echo $before . '404' . $after;
    }
	/*
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __(' Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
	*/

    echo '</ul>';

  }
} // end breadcrumbs()
}

/*-----------------------------------------------------------------------------------*/
/*	Author Bio
/*-----------------------------------------------------------------------------------*/
add_action( 'before_sidebar', 'duena_show_author_bio', 10 );

function duena_show_author_bio() {
	if ( 'no' != of_get_option('g_author_bio') ) {
	?>
	<div class="author_bio_sidebar">
		<div class="social_box">
	<?php
		if ( '' != of_get_option('g_author_bio_social_twitter') ) {
			echo "<a href='".esc_url( of_get_option('g_author_bio_social_twitter') )."'><i class='fa fa-twitter'></i></a>\n";
		}
		if ( '' != of_get_option('g_author_bio_social_facebook') ) {
			echo "<a href='".esc_url( of_get_option('g_author_bio_social_facebook') )."'><i class='fa fa-facebook'></i></a>\n";
		}
		if ( '' != of_get_option('g_author_bio_social_google') ) {
			echo "<a href='".esc_url( of_get_option('g_author_bio_social_google') )."'><i class='fa fa-google-plus'></i></a>\n";
		}
		if ( '' != of_get_option('g_author_bio_social_linked') ) {
			echo "<a href='".esc_url( of_get_option('g_author_bio_social_linked') )."'><i class='fa fa-linkedin'></i></a>\n";
		}
		if ( '' != of_get_option('g_author_bio_social_rss') ) {
			echo "<a href='".esc_url( of_get_option('g_author_bio_social_rss') )."'><i class='fa fa-rss'></i></a>\n";
		}
	?>
		</div>
		<?php if (( '' != of_get_option('g_author_bio_title') ) || ('' != of_get_option('g_author_bio_img')) || ('' != of_get_option('g_author_bio_message')) ) { ?>
		<div class="content_box">
		<?php
			if ( '' != of_get_option('g_author_bio_title') ) {
				echo "<h2>".of_get_option('g_author_bio_title')."</h2>\n";
			}
			if ( '' != of_get_option('g_author_bio_img') ) {
				if ( '' != of_get_option('g_author_bio_title') ) {
					$img_alt = of_get_option('g_author_bio_title');
				} else {
					$img_alt = get_bloginfo( 'name' );
				}
				echo "<figure class='author_bio_img'><img src='".esc_url( of_get_option('g_author_bio_img') )."' alt='".esc_attr( $img_alt )."'></figure>\n";
			}
			if ( '' != of_get_option('g_author_bio_message') ) {
				echo "<div class='author_bio_message'>".of_get_option('g_author_bio_message')."</div>\n";
			}
		?>
		</div>
		<?php } ?>
	</div>
	<?php
	}
}


/*-----------------------------------------------------------------------------------*/
/*	Pagination (based on Twenty Fourteen pagination function)
/*-----------------------------------------------------------------------------------*/
function duena_pagination() { 

	global $wp_query, $wp_rewrite;
    
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'      => $pagenum_link,
		'format'    => $format,
		'total'     => $wp_query->max_num_pages,
		'current'   => $paged,
		'mid_size'  => 1,
		'add_args'  => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'duena' ),
		'next_text' => __( 'Next &rarr;', 'duena' ),
		'type'      => 'list'
	) );

	if ( $links ) {

	?>
	<div class="page_nav_wrap">
		<div class="post_nav">
			<?php echo $links; ?>
		</div><!-- .pagination -->
	</div><!-- .navigation -->
	<?php
	}
}

/*-----------------------------------------------------------------------------------*/
/* Custom Comments Structure
/*-----------------------------------------------------------------------------------*/
function duena_comment($comment, $args, $depth) {
     $GLOBALS['comment'] = $comment;

?> 
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>" class="clearfix">
     	<div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix">
      		<div class="clearfix">
      			<div class="comment-author vcard">
  	         		<?php echo get_avatar( $comment->comment_author_email, 65 ); ?>
  	  				<?php printf(__('<span class="author fn">%1$s</span>' ), get_comment_author_link()) ?>
  	      		</div>
  		      	<?php if ($comment->comment_approved == '0') : ?>
  		        	<em><?php _e('Your comment is awaiting moderation.', 'cherry') ?></em>
  		      	<?php endif; ?>	      	
  		     	<div class="extra-wrap">
  		     		<?php comment_text() ?>	     	
  		     	</div>
  		    </div>
	     	<div class="clearfix comment-footer">
			  	<div class="reply">
			    	<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			   	</div>
		   		<div class="comment-meta commentmetadata"><?php printf(__('%1$s', 'cherry' ), get_comment_date('F j, Y')) ?></div>
		 	</div>
    	</div>
<?php }

if (!function_exists('img_html_to_post_id')) {
	function img_html_to_post_id( $html, &$matched_html = null ) {

	        $attachment_id = 0;

	        // Look for an <img /> tag
	        if ( ! preg_match( '#' . get_tag_regex( 'img' ) .  '#i', $html, $matches ) || empty( $matches ) )
	                return $attachment_id;

	        $matched_html = $matches[0];

	        // Look for attributes.
	        if ( ! preg_match_all( '#(src|class)=([\'"])(.+?)\2#is', $matched_html, $matches ) || empty( $matches ) )
	                return $attachment_id;

	        $attr = array();
	        foreach ( $matches[1] as $key => $attribute_name )
	                $attr[ $attribute_name ] = $matches[3][ $key ];

	        if ( ! empty( $attr['class'] ) && false !== strpos( $attr['class'], 'wp-image-' ) )
	                if ( preg_match( '#wp-image-([0-9]+)#i', $attr['class'], $matches ) )
	                        $attachment_id = absint( $matches[1] );

	        if ( ! $attachment_id && ! empty( $attr['src'] ) )
	                $attachment_id = attachment_url_to_postid( $attr['src'] );

	        return $attachment_id;
	}
}

if (!function_exists('duena_footer_js')) {
	function duena_footer_js() {

			$sf_delay = esc_attr( of_get_option('sf_delay') );
			$sf_f_animation = esc_attr( of_get_option('sf_f_animation') );
			$sf_sl_animation = esc_attr( of_get_option('sf_sl_animation') );
			$sf_speed = esc_attr( of_get_option('sf_speed') );
			$sf_arrows = esc_attr( of_get_option('sf_arrows') );
			if ('' == $sf_delay) {$sf_delay = 1000;}
			if ('' == $sf_f_animation) {$sf_f_animation = 'show';}
			if ('' == $sf_sl_animation) {$sf_sl_animation = 'show';}
			if ('' == $sf_speed) {$sf_speed = 'normal';}
			if ('' == $sf_arrows) {$sf_arrows = 'false';}

		?>
		<script type="text/javascript">
			// initialise plugins
			jQuery(function(){
				// main navigation init
				jQuery('.navbar_inner > ul').superfish({
					delay:       <?php echo $sf_delay; ?>, 		// one second delay on mouseout 
					animation:   {opacity:"<?php echo $sf_f_animation; ?>", height:"<?php echo $sf_sl_animation; ?>"}, // fade-in and slide-down animation
					speed:       '<?php echo $sf_speed; ?>',  // faster animation speed 
					autoArrows:  <?php echo $sf_arrows; ?>,   // generation of arrow mark-up (for submenu)
					dropShadows: false
				});
				jQuery('.navbar_inner > div > ul').superfish({
					delay:       <?php echo $sf_delay; ?>, 		// one second delay on mouseout 
					animation:   {opacity:"<?php echo $sf_f_animation; ?>", height:"<?php echo $sf_sl_animation; ?>"}, // fade-in and slide-down animation
					speed:       '<?php echo $sf_speed; ?>',  // faster animation speed 
					autoArrows:  <?php echo $sf_arrows; ?>,   // generation of arrow mark-up (for submenu)
					dropShadows: false
				});
			});
			jQuery(function(){
			  var ismobile = navigator.userAgent.match(/(iPad)|(iPhone)|(iPod)|(android)|(webOS)/i)
			  if(ismobile){
			  	jQuery('.navbar_inner > ul').sftouchscreen();
			  	jQuery('.navbar_inner > div > ul').sftouchscreen();
			  }
			});
		</script>
		<!--[if (gt IE 9)|!(IE)]><!-->
		<script type="text/javascript">
			jQuery(function(){
				jQuery('.navbar_inner > ul').mobileMenu();
			  	jQuery('.navbar_inner > div > ul').mobileMenu();
			})
		</script>
		<!--<![endif]-->
		<?php
	}

	add_action( 'wp_footer', 'duena_footer_js', 20, 1 );
}