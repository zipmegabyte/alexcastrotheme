<?php
function alex_castro_enqueue_styles() {
    $parenthandle = 'twentytwenty-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
    $theme = wp_get_theme();
    wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css', 
        array(),  // if the parent theme code has a dependency, copy it to here
        $theme->parent()->get('Version')
    );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
        array( $parenthandle ),
        $theme->get('Version') // this only works if you have Version in the style header
    );
}
add_action( 'wp_enqueue_scripts', 'alex_castro_enqueue_styles' );

function alex_castro_sidebar_registration() {
  // Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
  );
  
  register_sidebar(
    array_merge(
      $shared_args,
      array(
        'name'        => 'Header',
        'id'          => 'header-sidebar',
        'description' => 'Widgets in this area will be displayed beneath the header of the home page',
      )
    )
  );
}
add_action( 'widgets_init', 'alex_castro_sidebar_registration' );

function default_image_options() {
    // Set default values for the upload media box
    update_option('image_default_align', 'center' );
    update_option('image_default_size', 'medium' );
}
add_action( 'after_setup_theme', 'default_image_options' );

function reorder_image_size_list($sizes){
    $medium_list = array(
      'medium' => $sizes['medium']
    );
    
    return array_merge( $medium_list, $sizes );
}
add_filter('image_size_names_choose', 'reorder_image_size_list');