<?php

add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );

function my_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}

add_filter( 'tiny_mce_before_init', 'my_mce_before_init' );

function my_mce_before_init( $settings ) {

    $style_formats = array(
        array(
            'title' => 'Label: Default',
            'inline' => 'span',
            'classes' => 'label',
            'wrapper' => true
        ),
        array(
            'title' => 'Label: Success',
            'inline' => 'span',
            'classes' => 'label label-success',
            'wrapper' => true
        ),
        array(
            'title' => 'Label: Warning',
            'inline' => 'span',
            'classes' => 'label label-warning',
            'wrapper' => true
        ),
        array(
            'title' => 'Label: Important',
            'inline' => 'span',
            'classes' => 'label label-important',
            'wrapper' => true
        ),
        array(
            'title' => 'Label: Info',
            'inline' => 'span',
            'classes' => 'label label-info',
            'wrapper' => true
        ),
        array(
            'title' => 'Label: Inverse',
            'inline' => 'span',
            'classes' => 'label label-inverse',
            'wrapper' => true
        ),
        array(
            'title' => 'Alert: Default',
            'block' => 'div',
            'classes' => 'alert alert-block',
            'wrapper' => true
        ),
        array(
            'title' => 'Alert: Error',
            'block' => 'div',
            'classes' => 'alert alert-error alert-block',
            'wrapper' => true
        ),
        array(
            'title' => 'Alert: Success',
            'block' => 'div',
            'classes' => 'alert alert-success alert-block',
            'wrapper' => true
        ),
        array(
            'title' => 'Alert: Info',
            'block' => 'div',
            'classes' => 'alert alert-info alert-block',
            'wrapper' => true
        ),
    	array(
    		'title' => 'Button (apply only for links)',
    		'selector' => 'a',
    		'classes' => 'btn'
    	),
    	array(
    		'title' => 'Button: Primary',
    		'selector' => 'a',
    		'classes' => 'btn btn-primary'
    	),
    	array(
    		'title' => 'Button: Info',
    		'selector' => 'a',
    		'classes' => 'btn btn-info'
    	),
    	array(
    		'title' => 'Button: Success',
    		'selector' => 'a',
    		'classes' => 'btn btn-success'
    	),
    	array(
    		'title' => 'Button: Warning',
    		'selector' => 'a',
    		'classes' => 'btn btn-warning'
    	),
    	array(
    		'title' => 'Button: Danger',
    		'selector' => 'a',
    		'classes' => 'btn btn-danger'
    	),
    	array(
    		'title' => 'Button: Inverse',
    		'selector' => 'a',
    		'classes' => 'btn btn-inverse'
    	)
    );

    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;

}

function register_button( $buttons ) {
   array_push( $buttons, "|", "bootstraptypo" );
   return $buttons;
}

function add_plugin( $plugin_array ) {
   $plugin_array['bootstraptypo'] = get_template_directory_uri() . '/inc/editor_plugin.js';
   return $plugin_array;
}
function duena_bootstraptypo_button() {

   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
      return;
   }

   if ( get_user_option('rich_editing') == 'true' ) {
      add_filter( 'mce_external_plugins', 'add_plugin' );
      add_filter( 'mce_buttons', 'register_button' );
   }

}
add_action('init', 'duena_bootstraptypo_button');
?>