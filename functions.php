<?php
add_action( 'wp_enqueue_scripts', 'alex_castro_enqueue_styles' );
add_action( 'widgets_init', 'alex_castro_sidebar_registration' );

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