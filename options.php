<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

if(!function_exists('optionsframework_option_name')) {
	function optionsframework_option_name() {
		// This gets the theme name from the stylesheet (lowercase and without spaces)
		$themename = 'duena';
		
		$optionsframework_settings = get_option('optionsframework');
		$optionsframework_settings['id'] = $themename;
		update_option('optionsframework', $optionsframework_settings);
		
	}
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

if(!function_exists('optionsframework_options')) {

	function optionsframework_options() {
	
		// Logo type
		$logo_type = array(
			"image_logo" => __( "Image Logo", 'duena'),
			"text_logo" => __( "Text Logo", 'duena')
		);
		
		// Search box in the header
		$g_search_box = array(
			"yes" => __( "Yes", 'duena'),
			"no" => __( "No", 'duena')
		);

		// Breadcrumbs
		$g_breadcrumb = array(
			"yes" => __( "Yes", 'duena'),
			"no" => __( "No", 'duena')
		);
		
		// Superfish fade-in animation
		$sf_f_animation_array = array(
			"show" => __( "Enable fade-in animation", 'duena'),
			"false" => __( "Disable fade-in animation", 'duena')
		);
		
		// Superfish slide-down animation
		$sf_sl_animation_array = array(
			"show" => __( "Enable slide-down animation", 'duena'),
			"false" => __( "Disable slide-down animation", 'duena')
		);
		
		// Superfish animation speed
		$sf_speed_array = array(
			"slow" => __( "Slow", 'duena'),
			"normal" => __( "Normal", 'duena'),
			"fast" => __( "Fast", 'duena')
		);
		
		// Superfish arrows markup
		$sf_arrows_array = array(
			"true" => __( "Yes", 'duena'),
			"false" => __( "No", 'duena')
		);
		
		// Slider show
		$sl_show_array = array(
			"yes" => __( "Show", 'duena'),
			"no" => __( "Hide", 'duena')
		);

		// Slider effects
		$sl_effect_array = array(
			"fade" => __( "Fade", 'duena'),
			"slide" => __( "Slide", 'duena')
		);

		// Slider direction
		$sl_direction_array = array(
			'horizontal' => __( 'Horizontal', 'duena'), 
			'vertical' => __( 'Vertical', 'duena') 
		);

		// Slider slideshow
		$sl_slideshow_array = array(
			"true" => __( "Yes", 'duena'),
			"false" => __( "No", 'duena')
		);

		// Slider control nav
		$sl_control_array = array(
			"true" => __( "Yes", 'duena'),
			"false" => __( "No", 'duena')
		);

		// Slider direction nav
		$sl_direction_nav_array = array(
			"true" => __( "Yes", 'duena'),
			"false" => __( "No", 'duena')
		);

		// Slide as link
		$sl_as_link_array = array(
			"true" => __( "Yes", 'duena'),
			"false" => __( "No", 'duena')
		);


		// Slider number nav
		$sl_num_array = array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15');


		// Slider caption
		$sl_caption_array = array('show' => __( 'Show', 'duena'), 'hide' => __( 'Hide', 'duena') );

		// Slider caption title
		$sl_capt_title_array = array('show' => __( 'Show', 'duena'), 'hide' => __( 'Hide', 'duena') );

		// Slider caption excerpt
		$sl_capt_exc_array = array('show' => __( 'Show', 'duena'), 'hide' => __( 'Hide', 'duena') );

		// Slider caption button
		$sl_capt_btn_array = array('show' => __( 'Show', 'duena'), 'hide' => __( 'Hide', 'duena') );


		// Footer menu
		$footer_menu_array = array("true" => __( "Yes", 'duena'), "false" => __( "No", 'duena') );


		$post_sidebar_array = array("left" => __( "Left Sidebar", 'duena'), "right" => __( "Right Sidebar", 'duena') );
		
		// Featured image on the blog.
		$post_image_array = array(
			"normal" => __( "Yes", 'duena'),
			"noimg" => __( "No", 'duena')
		);
		
		// Featured image size on the single page.
		$single_image_array = array(
			"normal" => __( "Yes", 'duena'),
			"noimg" => __( "No", 'duena')
		);
		
		// True/False options array for blog
		$post_opt_array = array("true" => __( "Yes", 'duena'), "false" => __( "No", 'duena') );
		
		
		
		
		
		// Pull all the categories into an array
		$options_categories = array();  
		$options_categories_obj = get_categories();
		foreach ($options_categories_obj as $category) {
				$options_categories[$category->cat_ID] = $category->cat_name;
		}
		
		$all_cats_array = array('from_all' => __( 'Select from all', 'duena' ) ) + $options_categories;

		// Pull all the pages into an array
		$options_pages = array();  
		$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
		$options_pages[''] = __( "Select a page:", "duena" );
		foreach ($options_pages_obj as $page) {
				$options_pages[$page->ID] = $page->post_title;
		}
			
		// If using image radio buttons, define a directory path
		$imagepath =  get_template_directory_uri() . '/inc/images/';
			
		$options = array();
		
		$options[] = array( "name" => __( "General", "duena" ),
							"type" => "heading");

		$options['g_search_box_id'] = array( "name" => __( "Display search box?", "duena" ),
							"desc"    => __( "Display search box in the header?", "duena" ),
							"id"      => "g_search_box_id",
							"type"    => "radio",
							"std"     => "yes",
							"options" => $g_search_box);
		
		$options['g_breadcrumbs_id'] = array( "name" => __( "Display breadcrumbs?", "duena" ),
							"desc"    => __( "Display breadcrumbs?", "duena" ),
							"id"      => "g_breadcrumbs_id",
							"type"    => "radio",
							"std"     => "yes",
							"options" => $g_breadcrumb);

		$options['g_portfolio_cat'] = array( "name" => __( "Category slug for portfolio page", "duena" ),
							"desc" => __( "Enter category slug, from which you like to fill portfolio page", "duena" ),
							"id"   => "g_portfolio_cat",
							"type" => "text",
							"std"  => "");

		$options['g_author_bio'] = array( "name" => __( "Display Author Bio in sidebar", "duena" ),
							"desc"    => __( "Show/hide author bio in sidebar", "duena" ),
							"id"      => "g_author_bio",
							"type"    => "radio",
							"std"     => "yes",
							"options" => $g_search_box);

		$options['g_author_bio_title'] = array( "name" => __( "Author Bio Title", "duena" ),
							"desc"  => __( "Enter Author Bio Title", "duena" ),
							"id"    => "g_author_bio_title",
							"type"  => "text",
							"class" => "hidden",
							"std"   => __( "Welcome to my site", "duena" ));

		$options['g_author_bio_img'] = array( "name" => __( "Author Bio image", "duena" ),
							"desc"  => __( "Upload Author Bio image", "duena" ),
							"id"    => "g_author_bio_img",
							"class" => "hidden",
							"type"  => "upload");

		$options['g_author_bio_message'] = array( "name" => __( "Author Bio Message", "duena" ),
							"desc"  => __( "Enter Author Bio Message (HTML tags allowed)", "duena" ),
							"id"    => "g_author_bio_message",
							"type"  => "textarea",
							"class" => "hidden",
							"std"   => __( "Hello, and welcome to my site! I hope you like the place and decide to stay.", "duena" ));

		$options['g_author_bio_social_twitter'] = array( "name" => __( "Author Twitter URL", "duena" ),
							"desc"  => __( "Enter Author Twitter URL", "duena" ),
							"id"    => "g_author_bio_social_twitter",
							"type"  => "text",
							"class" => "hidden",
							"std"   => "#");

		$options['g_author_bio_social_facebook'] = array( "name" => __( "Author Facebook URL", "duena" ),
							"desc"  => __( "Enter Author Facebook URL", "duena" ),
							"id"    => "g_author_bio_social_facebook",
							"type"  => "text",
							"class" => "hidden",
							"std"   => "#");

		$options['g_author_bio_social_google'] = array( "name" => __( "Author Google+ URL", "duena" ),
							"desc"  => __( "Enter Author Google+ URL", "duena" ),
							"id"    => "g_author_bio_social_google",
							"type"  => "text",
							"class" => "hidden",
							"std"   => "#");

		$options['g_author_bio_social_linked'] = array( "name" => __( "Author LinkedIn URL", "duena" ),
							"desc"  => __( "Enter Author LinkedIn URL", "duena" ),
							"id"    => "g_author_bio_social_linked",
							"type"  => "text",
							"class" => "hidden",
							"std"   => "#");

		$options['g_author_bio_social_rss'] = array( "name" => __( "Author RSS URL", "duena" ),
							"desc"  => __( "Enter Author RSS URL", "duena" ),
							"id"    => "g_author_bio_social_rss",
							"type"  => "text",
							"class" => "hidden",
							"std"   => "#");
		
		
		
		
		$options[] = array( "name" => __( "Logo & Favicon", "duena" ),
							"type" => "heading");
		
		$options['logo_type'] = array( "name" => __( "What kind of logo?", "duena" ),
							"desc"    => __( "Select whether you want your main logo to be an image or text. If you select 'image' you can put in the image url in the next option, and if you select 'text' your Site Title will show instead.", "duena" ),
							"id"      => "logo_type",
							"std"     => "text_logo",
							"type"    => "radio",
							"options" => $logo_type);
		
		$options['logo_url'] = array( "name" => __( "Logo Image Path", "duena" ),
							"desc" => __( "Upload logo image", "duena" ),
							"id"   => "logo_url",
							"type" => "upload");
		
		$options['favicon'] = array( "name" => __( "Favicon", "duena" ),
							"desc" => __( "Click Upload or Enter the direct path to your favicon.", "duena" ),
							"id"   => "favicon",
							"std"  => "",
							"type" => "upload");
		
		$options[] = array( "name" => __( "Color scheme", "duena" ),
							"type" => "heading");

		$options['cs_primary_color'] = array( "name" => __( "Primary color", "duena" ),
							"desc" => __( "Color of links, borders on content boxes, social icons, meta icons, post type labels", "duena" ),
							"id"   => "cs_primary_color",
							"std"  => "#FF5B5B",
							"type" => "color");

		$options['cs_secondary_color'] = array( "name" => __( "Secondary color", "duena" ),
							"desc" => __( "Color of links hovers", "duena" ),
							"id"   => "cs_secondary_color",
							"std"  => "#71A08B",
							"type" => "color");


		$options['cs_list_bullet'] = array( "name" => __( "Default list bullet", "duena" ),
							"desc" => __( "Upload image for list bullet (Note. Use small image for bullet, not larger than 10*10px, also reccomended to leave some empty space at image before bullet(5-8px))", "duena" ),
							"id"   => "cs_list_bullet",
							"type" => "upload");


		$options[] = array( "name" => __( "Navigation", "duena" ),
							"type" => "heading");
		
		$options['sf_delay'] = array( "name" => __( "Delay", "duena" ),
							"desc"  => __( "miliseconds delay on mouseout.", "duena" ),
							"id"    => "sf_delay",
							"std"   => "1000",
							"class" => "mini",
							"type"  => "text");
		
		$options['sf_f_animation'] = array( "name" => __( "Fade-in animation", "duena" ),
							"desc"    => __( "Fade-in animation.", "duena" ),
							"id"      => "sf_f_animation",
							"std"     => "show",
							"type"    => "radio",
							"options" => $sf_f_animation_array);
		
		$options['sf_sl_animation'] = array( "name" => __( "Slide-down animation", "duena" ),
							"desc"    => __( "Slide-down animation.", "duena" ),
							"id"      => "sf_sl_animation",
							"std"     => "show",
							"type"    => "radio",
							"options" => $sf_sl_animation_array);
		
		$options['sf_speed'] = array( "name" => __( "Speed", "duena" ),
							"desc"    => __( "Animation speed.", "duena" ),
							"id"      => "sf_speed",
							"type"    => "select",
							"std"     => "normal",
							"class"   => "tiny", //mini, tiny, small
							"options" => $sf_speed_array);
		
		$options['sf_arrows'] = array( "name" => __( "Arrows markup", "duena" ),
							"desc"    => __( "Do you want to generate arrow mark-up?", "duena" ),
							"id"      => "sf_arrows",
							"std"     => "false",
							"type"    => "radio",
							"options" => $sf_arrows_array);


		$options[] = array( "name" => __( "Slider (visualisation)", "duena" ),
							"type" => "heading");
 
		$options['sl_show'] = array( "name" => __( "Show slider", "duena" ),
							"desc"    => __( "Show / Hide slider on home page", "duena" ),
							"id"      => "sl_show",
							"std"     => "yes",
							"type"    => "radio",
							"class"   => "tiny", //mini, tiny, small
							"options" => $sl_show_array);

        $options['sl_effect'] = array( "name" => __( "Sliding effect", "duena" ),
							"desc"    => __( "Select your animation type", "duena" ),
							"id"      => "sl_effect",
							"std"     => "fade",
							"type"    => "select",
							"class"   => "tiny", //mini, tiny, small
							"options" => $sl_effect_array);

        $options['sl_direction'] = array( "name" => __( "Sliding direction", "duena" ),
							"desc"    => __( "Select the sliding direction", "duena" ),
							"id"      => "sl_direction",
							"std"     => "horizontal",
							"type"    => "select",
							"class"   => "tiny", //mini, tiny, small
							"options" => $sl_direction_array);

        $options['sl_slideshow'] = array( "name" => __( "Slideshow", "duena" ),
							"desc"    => __( "Animate slider automatically?", "duena" ),
							"id"      => "sl_slideshow",
							"std"     => "true",
							"type"    => "radio",
							"class"   => "tiny", //mini, tiny, small
							"options" => $sl_slideshow_array);

        $options['sl_control'] = array( "name" => __( "Paging control", "duena" ),
							"desc"    => __( "Create navigation for paging control of each slide?", "duena" ),
							"id"      => "sl_control",
							"std"     => "true",
							"type"    => "radio",
							"class"   => "tiny", //mini, tiny, small
							"options" => $sl_control_array);

        $options['sl_direction_nav'] = array( "name" => __( "Previous/Next navigation", "duena" ),
							"desc"    => __( "Create controls for previous/next navigation?", "duena" ),
							"id"      => "sl_direction_nav",
							"std"     => "true",
							"type"    => "radio",
							"class"   => "tiny", //mini, tiny, small
							"options" => $sl_direction_nav_array);

        


		$options[] = array( "name" => __( "Slider (content)", "duena" ),
							"type" => "heading");
 
		$options['sl_num'] = array( "name" => __( "How many slides to show?", "duena" ),
							"desc"    => __( "This is how many slides will be displayed.", "duena" ),
							"id"      => "sl_num",
							"std"     => "4",
							"type"    => "select",
							"class"   => "tiny", //mini, tiny, small
							"options" => $sl_num_array);

		$options['sl_category'] = array( "name" => __( "Which category to pull from?", "duena" ),
							"desc"    => __( "Select the category you'd like to pull slides from.", "duena" ),
							"id"      => "sl_category",
							"std"     => "",
							"type"    => "select",
							"options" => $all_cats_array);

		$options['sl_as_link'] = array( "name" => __( "Slide as link to the post", "duena" ),
							"desc"    => __( "Add/remove permalink to slides", "duena" ),
							"id"      => "sl_as_link",
							"std"     => "true",
							"type"    => "radio",
							"class"   => "tiny",
							"options" => $sl_as_link_array);

		$options['sl_caption'] = array( "name" => __( "Show/Hide slide caption", "duena" ),
							"desc"    => __( "Show/Hide slide caption.", "duena" ),
							"id"      => "sl_caption",
							"std"     => "hide",
							"type"    => "radio",
							"class"   => "tiny",
							"options" => $sl_caption_array);

		$options['sl_capt_title'] = array( "name" => __( "Show/Hide slide caption title", "duena" ),
							"desc"    => __( "Show/Hide slide caption title.", "duena" ),
							"id"      => "sl_capt_title",
							"std"     => "show",
							"type"    => "radio",
							"class"   => "tiny hidden",
							"options" => $sl_capt_title_array);

		$options['sl_capt_exc'] = array( "name" => __( "Show/Hide slide caption excerpt", "duena" ),
							"desc"    => __( "Show/Hide slide caption excerpt.", "duena" ),
							"id"      => "sl_capt_exc",
							"std"     => "show",
							"type"    => "radio",
							"class"   => "tiny hidden",
							"options" => $sl_capt_exc_array);

		$options['sl_capt_exc_length'] = array( "name" => __( "Slide caption excerpt length", "duena" ),
							"desc"  => __( "How many words are displayed in the excerpt?", "duena" ),
							"id"    => "sl_capt_exc_length",
							"std"   => "20",
							"type"  => "text",
							"class" => "tiny hidden");

		$options['sl_capt_btn'] = array( "name" => __( "Show/Hide slide caption button", "duena" ),
								"desc" => __( "Show/Hide slide caption button", "duena" ),
								"id" => "sl_capt_btn",
								"std" => "show",
								"type" => "radio",
								"class" => "tiny hidden",
								"options" => $sl_capt_btn_array);

		$options['sl_capt_btn_txt'] = array( "name" => __( "Slide caption button text", "duena" ),
							"desc"  => __( "Slide caption button text", "duena" ),
							"id"    => "sl_capt_btn_txt",
							"std"   => __( 'Read more', 'duena' ),
							"type"  => "text",
							"class" => "tiny hidden");


		
		$options[] = array( "name" => __( "Blog", "duena" ),
							"type" => "heading");
		
		$options['blog_sidebar_pos'] = array( "name" => __( "Sidebar position", "duena" ),
							"desc"    => __( "Choose sidebar position.", "duena" ),
							"id"      => "blog_sidebar_pos",
							"std"     => "right",
							"type"    => "radio",
							"options" => $post_sidebar_array);
		
		$options['post_image_size'] = array( "name" => __( "Show featured image on Blog page", "duena" ),
							"desc"    => __( "Show or hide featured image on Blog page", "duena" ),
							"id"      => "post_image_size",
							"type"    => "select",
							"std"     => "normal",
							"class"   => "small", //mini, tiny, small
							"options" => $post_image_array);
		
		$options['single_image_size'] = array( "name" => __( "Show featured image on Single post page", "duena" ),
							"desc"    => __( "Show or hide featured image on Single post page", "duena" ),
							"id"      => "single_image_size",
							"type"    => "select",
							"std"     => "normal",
							"class"   => "small", //mini, tiny, small
							"options" => $single_image_array);
		
		$options['post_meta'] = array( "name" => __( "Enable Meta for blog posts?", "duena" ),
							"desc"    => __( "Enable or Disable meta information for blog posts.", "duena" ),
							"id"      => "post_meta",
							"std"     => "true",
							"type"    => "radio",
							"options" => $post_opt_array);
		
		$options['post_excerpt'] = array( "name" => __( "Enable excerpt for blog posts?", "duena" ),
							"desc"    => __( "Enable or Disable excerpt for blog posts.", "duena" ),
							"id"      => "post_excerpt",
							"std"     => "true",
							"type"    => "radio",
							"options" => $post_opt_array);

		$options['post_button'] = array( "name" => __( "Enable read more button for blog posts?", "duena" ),
							"desc"    => __( "Enable or Disable read more button for blog posts.", "duena" ),
							"id"      => "post_button",
							"std"     => "true",
							"type"    => "radio",
							"options" => $post_opt_array);

		$options['post_button_txt'] = array( "name" => __( "'Read more' button text", "duena" ),
							"desc"  => __( "Enter 'read more' button text.", "duena" ),
							"id"    => "post_button_txt",
							"std"   => __( "Read More", "duena" ),
							"type"  => "text",
							"class" => "tiny");

		$options['post_author'] = array( "name" => __( "Show author bio on single post page?", "duena" ),
							"desc"    => __( "Show or hide author bio on single post page.", "duena" ),
							"id"      => "post_author",
							"std"     => "true",
							"type"    => "radio",
							"options" => $post_opt_array);
		

		$options['blog_related'] = array( "name" => __( "Related Posts Title", "duena" ),
							"desc" => __( "Enter Your Title used on Single Post page for related posts.", "duena" ),
							"id"   => "blog_related",
							"std"  => __( 'Related posts', 'duena' ),
							"type" => "text");
		
		$options[] = array( "name" => __( "Portfolio", "duena" ),
							"type" => "heading");

		$options['portfolio_per_page'] = array( "name" => __( "Posts per page", "duena" ),
							"desc"    => __( "Enter number of post per page on portfolio page template", "duena" ),
							"id"      => "portfolio_per_page",
							"type"    => "text",
							"std"     => "12",
							"class"   => "tiny");

		$options['portfolio_show_thumbnail'] = array( "name" => __( "Show thumbnail", "duena" ),
							"desc"    => __( "Show or hide post thumbnail on portfolio pages.", "duena" ),
							"id"      => "portfolio_show_thumbnail",
							"std"     => "true",
							"type"    => "radio",
							"options" => $post_opt_array);

		$options['portfolio_show_title'] = array( "name" => __( "Show title", "duena" ),
							"desc"    => __( "Show or hide post title on portfolio pages.", "duena" ),
							"id"      => "portfolio_show_title",
							"std"     => "true",
							"type"    => "radio",
							"options" => $post_opt_array);

		$options['portfolio_show_excerpt'] = array( "name" => __( "Show excerpt", "duena" ),
							"desc"    => __( "Show or hide post excerpt on portfolio pages.", "duena" ),
							"id"      => "portfolio_show_excerpt",
							"std"     => "true",
							"type"    => "radio",
							"options" => $post_opt_array);

		$options['portfolio_show_link'] = array( "name" => __( "Show 'Read more' link", "duena" ),
							"desc"    => __( "Show or hide 'Read more' on portfolio pages.", "duena" ),
							"id"      => "portfolio_show_link",
							"std"     => "true",
							"type"    => "radio",
							"options" => $post_opt_array);

		$options[] = array( "name" => __( "Footer", "duena" ),
							"type" => "heading");
		
		$options['footer_text'] = array( "name" => __( "Footer copyright text", "duena" ),
							"desc" => __( "Enter text used in the right side of the footer. HTML tags are allowed.", "duena" ),
							"id"   => "footer_text",
							"std"  => "",
							"type" => "textarea");
		
		$options['footer_menu'] = array( "name" => __( "Display Footer menu?", "duena" ),
							"desc"    => __( "Do you want to display footer menu?", "duena" ),
							"id"      => "footer_menu",
							"std"     => "false",
							"type"    => "radio",
							"options" => $footer_menu_array);
					
		
		return $options;
	}

}

/* 
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');


if(!function_exists('optionsframework_custom_scripts')) {

	function optionsframework_custom_scripts() { ?>

		<script type="text/javascript">
		jQuery(document).ready(function($) {

			$('#example_showhidden').click(function() {
					$('#section-example_text_hidden').fadeToggle(400);
			});
			
			if ($('#example_showhidden:checked').val() !== undefined) {
				$('#section-example_text_hidden').show();
			}
			
		});
		</script>

		<?php
		}

}


/**
* Front End Customizer
*
* WordPress 3.4 Required
*/
add_action( 'customize_register', 'duena_register' );

if(!function_exists('duena_register')) {

	function duena_register($wp_customize) {
		/**
		 * This is optional, but if you want to reuse some of the defaults
		 * or values you already have built in the options panel, you
		 * can load them into $options for easy reference
		 */
		$options = optionsframework_options();
		
		
		
		/*-----------------------------------------------------------------------------------*/
		/*	General
		/*-----------------------------------------------------------------------------------*/
		$wp_customize->add_section( 'duena_header', array(
			'title' => __( 'General', 'duena' ),
			'priority' => 200
		));
		
		
		/* Search Box */
		$wp_customize->add_setting( 'duena[g_search_box_id]', array(
				'default' => $options['g_search_box_id']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_g_search_box_id', array(
				'label' => $options['g_search_box_id']['name'],
				'section' => 'duena_header',
				'settings' => 'duena[g_search_box_id]',
				'type' => $options['g_search_box_id']['type'],
				'choices' => $options['g_search_box_id']['options'],
				'priority' => 11
		) );
		
		/* Breadcrumbs */
		$wp_customize->add_setting( 'duena[g_breadcrumbs_id]', array(
				'default' => $options['g_breadcrumbs_id']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_g_breadcrumbs_id', array(
				'label' => $options['g_breadcrumbs_id']['name'],
				'section' => 'duena_header',
				'settings' => 'duena[g_breadcrumbs_id]',
				'type' => $options['g_breadcrumbs_id']['type'],
				'choices' => $options['g_breadcrumbs_id']['options'],
				'priority' => 12
		) );

		/* Portfolio cat */
		$wp_customize->add_setting( 'duena[g_portfolio_cat]', array(
				'default' => $options['g_portfolio_cat']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_g_portfolio_cat', array(
				'label' => $options['g_portfolio_cat']['name'],
				'section' => 'duena_header',
				'settings' => 'duena[g_portfolio_cat]',
				'type' => $options['g_portfolio_cat']['type'],
				'priority' => 13
		) );

		/* g_author_bio */
		$wp_customize->add_setting( 'duena[g_author_bio]', array(
				'default' => $options['g_author_bio']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_g_author_bio', array(
				'label' => $options['g_author_bio']['name'],
				'section' => 'duena_header',
				'settings' => 'duena[g_author_bio]',
				'type' => $options['g_author_bio']['type'],
				'choices' => $options['g_author_bio']['options'],
				'priority' => 14
		) );

		/* g_author_bio_title */
		$wp_customize->add_setting( 'duena[g_author_bio_title]', array(
				'default' => $options['g_author_bio_title']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_g_author_bio_title', array(
				'label' => $options['g_author_bio_title']['name'],
				'section' => 'duena_header',
				'settings' => 'duena[g_author_bio_title]',
				'type' => $options['g_author_bio_title']['type'],
				'priority' => 15
		) );

		/* g_author_bio_img */
		$wp_customize->add_setting( 'duena[g_author_bio_img]', array(
				'type' => 'option'
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'g_author_bio_img', array(
			'label' => $options['g_author_bio_img']['name'],
			'section' => 'duena_header',
			'settings' => 'duena[g_author_bio_img]',
			'priority' => 16
		) ) );

		/* g_author_bio_message */
		$wp_customize->add_setting( 'duena[g_author_bio_message]', array(
				'default' => $options['g_author_bio_message']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_g_author_bio_message', array(
				'label' => $options['g_author_bio_message']['name'],
				'section' => 'duena_header',
				'settings' => 'duena[g_author_bio_message]',
				'type' => 'text',
				'priority' => 17
		) );

		/* g_author_bio_social_twitter */
		$wp_customize->add_setting( 'duena[g_author_bio_social_twitter]', array(
				'default' => $options['g_author_bio_social_twitter']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_g_author_bio_social_twitter', array(
				'label' => $options['g_author_bio_social_twitter']['name'],
				'section' => 'duena_header',
				'settings' => 'duena[g_author_bio_social_twitter]',
				'type' => $options['g_author_bio_social_twitter']['type'],
				'priority' => 18
		) );

		/* g_author_bio_social_facebook */
		$wp_customize->add_setting( 'duena[g_author_bio_social_facebook]', array(
				'default' => $options['g_author_bio_social_facebook']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_g_author_bio_social_facebook', array(
				'label' => $options['g_author_bio_social_facebook']['name'],
				'section' => 'duena_header',
				'settings' => 'duena[g_author_bio_social_facebook]',
				'type' => $options['g_author_bio_social_facebook']['type'],
				'priority' => 19
		) );

		/* g_author_bio_social_google */
		$wp_customize->add_setting( 'duena[g_author_bio_social_google]', array(
				'default' => $options['g_author_bio_social_google']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_g_author_bio_social_google', array(
				'label' => $options['g_author_bio_social_google']['name'],
				'section' => 'duena_header',
				'settings' => 'duena[g_author_bio_social_google]',
				'type' => $options['g_author_bio_social_google']['type'],
				'priority' => 20
		) );

		/* g_author_bio_social_linked */
		$wp_customize->add_setting( 'duena[g_author_bio_social_linked]', array(
				'default' => $options['g_author_bio_social_linked']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_g_author_bio_social_linked', array(
				'label' => $options['g_author_bio_social_linked']['name'],
				'section' => 'duena_header',
				'settings' => 'duena[g_author_bio_social_linked]',
				'type' => $options['g_author_bio_social_linked']['type'],
				'priority' => 21
		) );

		/* g_author_bio_social_rss */
		$wp_customize->add_setting( 'duena[g_author_bio_social_rss]', array(
				'default' => $options['g_author_bio_social_rss']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_g_author_bio_social_rss', array(
				'label' => $options['g_author_bio_social_rss']['name'],
				'section' => 'duena_header',
				'settings' => 'duena[g_author_bio_social_rss]',
				'type' => $options['g_author_bio_social_rss']['type'],
				'priority' => 22
		) );
		
		/*-----------------------------------------------------------------------------------*/
		/*	Logo
		/*-----------------------------------------------------------------------------------*/
		
		$wp_customize->add_section( 'duena_logo', array(
			'title' => __( 'Logo & Favicon', 'duena' ),
			'priority' => 201
		) );
		
		/* Logo Type */
		$wp_customize->add_setting( 'duena[logo_type]', array(
				'default' => $options['logo_type']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_logo_type', array(
				'label' => $options['logo_type']['name'],
				'section' => 'duena_logo',
				'settings' => 'duena[logo_type]',
				'type' => $options['logo_type']['type'],
				'choices' => $options['logo_type']['options'],
				'priority' => 11
		) );

		/* Logo Path */
		$wp_customize->add_setting( 'duena[logo_url]', array(
			'type' => 'option'
		) );
		
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_url', array(
			'label' => $options['logo_url']['name'],
			'section' => 'duena_logo',
			'settings' => 'duena[logo_url]',
			'priority' => 12
		) ) );

		/* Favicon Path */
		$wp_customize->add_setting( 'duena[favicon]', array(
			'type' => 'option'
		) );
		
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'favicon', array(
			'label' => $options['favicon']['name'],
			'section' => 'duena_logo',
			'settings' => 'duena[favicon]',
			'priority' => 13
		) ) );
		
		/*-----------------------------------------------------------------------------------*/
		/*	Navigation
		/*-----------------------------------------------------------------------------------*/
		
		/* Nav Delay */
		$wp_customize->add_setting( 'duena[sf_delay]', array(
				'default' => $options['sf_delay']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_sf_delay', array(
				'label' => $options['sf_delay']['name'],
				'section' => 'nav',
				'settings' => 'duena[sf_delay]',
				'type' => $options['sf_delay']['type'],
				'priority' => 11
		) );

		/* nav_fade_in */
		$wp_customize->add_setting( 'duena[sf_f_animation]', array(
				'default' => $options['sf_f_animation']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_sf_f_animation', array(
				'label' => $options['sf_f_animation']['name'],
				'section' => 'nav',
				'settings' => 'duena[sf_f_animation]',
				'type' => $options['sf_f_animation']['type'],
				'choices' => $options['sf_f_animation']['options'],
				'priority' => 12
		) );

		/* nav_slide_down */
		$wp_customize->add_setting( 'duena[sf_sl_animation]', array(
				'default' => $options['sf_sl_animation']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_sf_sl_animation', array(
				'label' => $options['sf_sl_animation']['name'],
				'section' => 'nav',
				'settings' => 'duena[sf_sl_animation]',
				'type' => $options['sf_sl_animation']['type'],
				'choices' => $options['sf_sl_animation']['options'],
				'priority' => 13
		) );

		/* nav_speed */
		$wp_customize->add_setting( 'duena[sf_speed]', array(
				'default' => $options['sf_speed']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_sf_speed', array(
				'label' => $options['sf_speed']['name'],
				'section' => 'nav',
				'settings' => 'duena[sf_speed]',
				'type' => $options['sf_speed']['type'],
				'choices' => $options['sf_speed']['options'],
				'priority' => 14
		) );

		/* Nav Arrows */
		$wp_customize->add_setting( 'duena[sf_arrows]', array(
				'default' => $options['sf_arrows']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_sf_arrows', array(
				'label' => $options['sf_arrows']['name'],
				'section' => 'nav',
				'settings' => 'duena[sf_arrows]',
				'type' => $options['sf_arrows']['type'],
				'choices' => $options['sf_arrows']['options'],
				'priority' => 15
		) );


		/*-----------------------------------------------------------------------------------*/
		/*  Slider (visualisation)
		/*-----------------------------------------------------------------------------------*/
 
		$wp_customize->add_section( 'duena_slider_visual', array(
		    'title' => __( 'Slider (visualisation)', 'duena' ),
		    'priority' => 202
		) );

		/* Slider Show */
		$wp_customize->add_setting( 'duena[sl_show]', array(
		        'default' => $options['sl_show']['std'],
		        'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_sl_show', array(
		        'label' => $options['sl_show']['name'],
		        'section' => 'duena_slider_visual',
		        'settings' => 'duena[sl_show]',
		        'type' => $options['sl_show']['type'],
		        'choices' => $options['sl_show']['options'],
		        'priority' => 11
		) );
		 
		/* Slider Effect */
		$wp_customize->add_setting( 'duena[sl_effect]', array(
		        'default' => $options['sl_effect']['std'],
		        'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_sl_effect', array(
		        'label' => $options['sl_effect']['name'],
		        'section' => 'duena_slider_visual',
		        'settings' => 'duena[sl_effect]',
		        'type' => $options['sl_effect']['type'],
		        'choices' => $options['sl_effect']['options'],
		        'priority' => 12
		) );

		/* Slider Direction */
		$wp_customize->add_setting( 'duena[sl_direction]', array(
		        'default' => $options['sl_direction']['std'],
		        'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_sl_direction', array(
		        'label' => $options['sl_direction']['name'],
		        'section' => 'duena_slider_visual',
		        'settings' => 'duena[sl_direction]',
		        'type' => $options['sl_direction']['type'],
		        'choices' => $options['sl_direction']['options'],
		        'priority' => 13
		) );

		/* Slider Slideshow */
		$wp_customize->add_setting( 'duena[sl_slideshow]', array(
		        'default' => $options['sl_slideshow']['std'],
		        'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_sl_slideshow', array(
		        'label' => $options['sl_slideshow']['name'],
		        'section' => 'duena_slider_visual',
		        'settings' => 'duena[sl_slideshow]',
		        'type' => $options['sl_slideshow']['type'],
		        'choices' => $options['sl_slideshow']['options'],
		        'priority' => 14
		) );

		/* Slider Controls */
		$wp_customize->add_setting( 'duena[sl_control]', array(
		        'default' => $options['sl_control']['std'],
		        'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_sl_control', array(
		        'label' => $options['sl_control']['name'],
		        'section' => 'duena_slider_visual',
		        'settings' => 'duena[sl_control]',
		        'type' => $options['sl_control']['type'],
		        'choices' => $options['sl_control']['options'],
		        'priority' => 15
		) );

		/* Slider Effect */
		$wp_customize->add_setting( 'duena[sl_direction_nav]', array(
		        'default' => $options['sl_direction_nav']['std'],
		        'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_sl_direction_nav', array(
		        'label' => $options['sl_direction_nav']['name'],
		        'section' => 'duena_slider_visual',
		        'settings' => 'duena[sl_direction_nav]',
		        'type' => $options['sl_direction_nav']['type'],
		        'choices' => $options['sl_direction_nav']['options'],
		        'priority' => 16
		) );
 

		/*-----------------------------------------------------------------------------------*/
		/*  Slider (content)
		/*-----------------------------------------------------------------------------------*/
 
		$wp_customize->add_section( 'duena_slider_content', array(
		    'title' => __( 'Slider (content)', 'duena' ),
		    'priority' => 203
		) );
		
		/* Slider Number */
		$wp_customize->add_setting( 'duena[sl_num]', array(
		        'default' => $options['sl_num']['std'],
		        'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_sl_num', array(
		        'label' => $options['sl_num']['name'],
		        'section' => 'duena_slider_content',
		        'settings' => 'duena[sl_num]',
		        'type' => $options['sl_num']['type'],
		        'choices' => $options['sl_num']['options'],
		        'priority' => 11
		) );

		/* Slider Category */
		$wp_customize->add_setting( 'duena[sl_category]', array(
		        'default' => $options['sl_category']['std'],
		        'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_sl_category', array(
		        'label' => $options['sl_category']['name'],
		        'section' => 'duena_slider_content',
		        'settings' => 'duena[sl_category]',
		        'type' => $options['sl_category']['type'],
		        'priority' => 12
		) );

		/* Slider Link */
		$wp_customize->add_setting( 'duena[sl_as_link]', array(
		        'default' => $options['sl_as_link']['std'],
		        'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_sl_as_link', array(
		        'label' => $options['sl_as_link']['name'],
		        'section' => 'duena_slider_content',
		        'settings' => 'duena[sl_as_link]',
		        'type' => $options['sl_as_link']['type'],
		        'choices' => $options['sl_as_link']['options'],
		        'priority' => 13
		) );

		/* Slider Caption */
		$wp_customize->add_setting( 'duena[sl_caption]', array(
		        'default' => $options['sl_caption']['std'],
		        'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_sl_caption', array(
		        'label' => $options['sl_caption']['name'],
		        'section' => 'duena_slider_content',
		        'settings' => 'duena[sl_caption]',
		        'type' => $options['sl_caption']['type'],
		        'choices' => $options['sl_caption']['options'],
		        'priority' => 14
		) );

		/* Slider Caption Title */
		$wp_customize->add_setting( 'duena[sl_capt_title]', array(
		        'default' => $options['sl_capt_title']['std'],
		        'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_sl_capt_title', array(
		        'label' => $options['sl_capt_title']['name'],
		        'section' => 'duena_slider_content',
		        'settings' => 'duena[sl_capt_title]',
		        'type' => $options['sl_capt_title']['type'],
		        'choices' => $options['sl_capt_title']['options'],
		        'priority' => 15
		) );

		/* Slider Captiopn Excerpt */
		$wp_customize->add_setting( 'duena[sl_capt_exc]', array(
		        'default' => $options['sl_capt_exc']['std'],
		        'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_sl_capt_exc', array(
		        'label' => $options['sl_capt_exc']['name'],
		        'section' => 'duena_slider_content',
		        'settings' => 'duena[sl_capt_exc]',
		        'type' => $options['sl_capt_exc']['type'],
		        'choices' => $options['sl_capt_exc']['options'],
		        'priority' => 16
		) );

		/* Slider Caption Excerpt Length */
		$wp_customize->add_setting( 'duena[sl_capt_exc_length]', array(
		        'default' => $options['sl_capt_exc_length']['std'],
		        'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_sl_capt_exc_length', array(
		        'label' => $options['sl_capt_exc_length']['name'],
		        'section' => 'duena_slider_content',
		        'settings' => 'duena[sl_capt_exc_length]',
		        'type' => $options['sl_capt_exc_length']['type'],
		        'priority' => 17
		) );

		/* Slider Caption Button */
		$wp_customize->add_setting( 'duena[sl_capt_btn]', array(
		        'default' => $options['sl_capt_btn']['std'],
		        'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_sl_capt_btn', array(
		        'label' => $options['sl_capt_btn']['name'],
		        'section' => 'duena_slider_content',
		        'settings' => 'duena[sl_capt_btn]',
		        'type' => $options['sl_capt_btn']['type'],
		        'choices' => $options['sl_capt_btn']['options'],
		        'priority' => 18
		) );
		
		/* Slider Caption Button Text */
		$wp_customize->add_setting( 'duena[sl_capt_btn_txt]', array(
		        'default' => $options['sl_capt_btn_txt']['std'],
		        'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_sl_capt_btn_txt', array(
		        'label' => $options['sl_capt_btn_txt']['name'],
		        'section' => 'duena_slider_content',
		        'settings' => 'duena[sl_capt_btn_txt]',
		        'type' => $options['sl_capt_btn_txt']['type'],
		        'priority' => 19
		) );

		/*-----------------------------------------------------------------------------------*/
		/*	Blog
		/*-----------------------------------------------------------------------------------*/
		
		
		$wp_customize->add_section( 'duena_blog', array(
				'title' => __( 'Blog', 'duena' ),
				'priority' => 204
		) );

		/* Blog sidebar position */
		$wp_customize->add_setting( 'duena[blog_sidebar_pos]', array(
				'default' => $options['blog_sidebar_pos']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_blog_sidebar_pos', array(
				'label' => $options['blog_sidebar_pos']['name'],
				'section' => 'duena_blog',
				'settings' => 'duena[blog_sidebar_pos]',
				'type' => $options['blog_sidebar_pos']['type'],
				'choices' => $options['blog_sidebar_pos']['options'],
				'priority' => 11
		) );
		
		/* Blog image size */
		$wp_customize->add_setting( 'duena[post_image_size]', array(
				'default' => $options['post_image_size']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_post_image_size', array(
				'label' => $options['post_image_size']['name'],
				'section' => 'duena_blog',
				'settings' => 'duena[post_image_size]',
				'type' => $options['post_image_size']['type'],
				'choices' => $options['post_image_size']['options'],
				'priority' => 12
		) );
		
		/* Single post image size */
		$wp_customize->add_setting( 'duena[single_image_size]', array(
				'default' => $options['single_image_size']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_single_image_size', array(
				'label' => $options['single_image_size']['name'],
				'section' => 'duena_blog',
				'settings' => 'duena[single_image_size]',
				'type' => $options['single_image_size']['type'],
				'choices' => $options['single_image_size']['options'],
				'priority' => 13
		) );
		
		/* Post Meta */
		$wp_customize->add_setting( 'duena[post_meta]', array(
				'default' => $options['post_meta']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_post_meta', array(
				'label' => $options['post_meta']['name'],
				'section' => 'duena_blog',
				'settings' => 'duena[post_meta]',
				'type' => $options['post_meta']['type'],
				'choices' => $options['post_meta']['options'],
				'priority' => 14
		) );
		
		/* Post Excerpt */
		$wp_customize->add_setting( 'duena[post_excerpt]', array(
				'default' => $options['post_excerpt']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_post_excerpt', array(
				'label' => $options['post_excerpt']['name'],
				'section' => 'duena_blog',
				'settings' => 'duena[post_excerpt]',
				'type' => $options['post_excerpt']['type'],
				'choices' => $options['post_excerpt']['options'],
				'priority' => 15
		) );

		/* Post Button */
		$wp_customize->add_setting( 'duena[post_button]', array(
				'default' => $options['post_button']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_post_button', array(
				'label' => $options['post_button']['name'],
				'section' => 'duena_blog',
				'settings' => 'duena[post_button]',
				'type' => $options['post_button']['type'],
				'choices' => $options['post_button']['options'],
				'priority' => 16
		) );

		/* Post Button Text */
		$wp_customize->add_setting( 'duena[post_button_txt]', array(
				'default' => $options['post_button_txt']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_post_button_txt', array(
				'label' => $options['post_button_txt']['name'],
				'section' => 'duena_blog',
				'settings' => 'duena[post_button_txt]',
				'type' => $options['post_button_txt']['type'],
				'priority' => 17
		) );


		/* Post author */
		$wp_customize->add_setting( 'duena[post_author]', array(
				'default' => $options['post_author']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_post_author', array(
				'label' => $options['post_author']['name'],
				'section' => 'duena_blog',
				'settings' => 'duena[post_author]',
				'type' => $options['post_author']['type'],
				'choices' => $options['post_author']['options'],
				'priority' => 19
		) );
		

		/* Related title */
		$wp_customize->add_setting( 'duena[blog_related]', array(
				'default' => $options['blog_related']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_blog_related', array(
				'label' => $options['blog_related']['name'],
				'section' => 'duena_blog',
				'settings' => 'duena[blog_related]',
				'type' => $options['blog_related']['type'],
				'priority' => 20
		) );

		/*-----------------------------------------------------------------------------------*/
		/*	Portfolio
		/*-----------------------------------------------------------------------------------*/
		
		
		$wp_customize->add_section( 'duena_portfolio', array(
				'title' => __( 'Portfolio', 'duena' ),
				'priority' => 205
		) );

		/* Per page */
		$wp_customize->add_setting( 'duena[portfolio_per_page]', array(
				'default' => $options['portfolio_per_page']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_portfolio_per_page', array(
				'label' => $options['portfolio_per_page']['name'],
				'section' => 'duena_portfolio',
				'settings' => 'duena[portfolio_per_page]',
				'type' => $options['portfolio_per_page']['type'],
				'priority' => 11
		) );

		/* Thumb */
		$wp_customize->add_setting( 'duena[portfolio_show_thumbnail]', array(
				'default' => $options['portfolio_show_thumbnail']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'portfolio_show_thumbnail', array(
				'label' => $options['portfolio_show_thumbnail']['name'],
				'section' => 'duena_portfolio',
				'settings' => 'duena[portfolio_show_thumbnail]',
				'type' => $options['portfolio_show_thumbnail']['type'],
				'choices' => $options['portfolio_show_thumbnail']['options'],
				'priority' => 12
		) );

		/* Title */
		$wp_customize->add_setting( 'duena[portfolio_show_title]', array(
				'default' => $options['portfolio_show_title']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'portfolio_show_title', array(
				'label' => $options['portfolio_show_title']['name'],
				'section' => 'duena_portfolio',
				'settings' => 'duena[portfolio_show_title]',
				'type' => $options['portfolio_show_title']['type'],
				'choices' => $options['portfolio_show_title']['options'],
				'priority' => 13
		) );

		/* Excerpt */
		$wp_customize->add_setting( 'duena[portfolio_show_excerpt]', array(
				'default' => $options['portfolio_show_excerpt']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'portfolio_show_excerpt', array(
				'label' => $options['portfolio_show_excerpt']['name'],
				'section' => 'duena_portfolio',
				'settings' => 'duena[portfolio_show_excerpt]',
				'type' => $options['portfolio_show_excerpt']['type'],
				'choices' => $options['portfolio_show_excerpt']['options'],
				'priority' => 14
		) );

		/* Link */
		$wp_customize->add_setting( 'duena[portfolio_show_link]', array(
				'default' => $options['portfolio_show_link']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'portfolio_show_link', array(
				'label' => $options['portfolio_show_link']['name'],
				'section' => 'duena_portfolio',
				'settings' => 'duena[portfolio_show_link]',
				'type' => $options['portfolio_show_link']['type'],
				'choices' => $options['portfolio_show_link']['options'],
				'priority' => 15
		) );

		/*-----------------------------------------------------------------------------------*/
		/*	Footer
		/*-----------------------------------------------------------------------------------*/
		
		$wp_customize->add_section( 'duena_footer', array(
			'title' => __( 'Footer', 'duena' ),
			'priority' => 206
		) );
			
		/* Footer Copyright Text */
		$wp_customize->add_setting( 'duena[footer_text]', array(
				'default' => $options['footer_text']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_footer_text', array(
				'label' => $options['footer_text']['name'],
				'section' => 'duena_footer',
				'settings' => 'duena[footer_text]',
				'type' => 'text'
		) );
		
		
		/* Display Footer Menu */
		$wp_customize->add_setting( 'duena[footer_menu]', array(
				'default' => $options['footer_menu']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'duena_footer_menu', array(
				'label' => $options['footer_menu']['name'],
				'section' => 'duena_footer',
				'settings' => 'duena[footer_menu]',
				'type' => $options['footer_menu']['type'],
				'choices' => $options['footer_menu']['options']
		) );
		

	
	};

}