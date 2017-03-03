<?php 
	
// 	Adding stylesheets
function add_theme_style() {
	wp_enqueue_style( 'simple-grid', get_template_directory_uri() . '/css/simple-grid.min.css',false,'1.0','all');
	
	wp_enqueue_style( 'styles', get_template_directory_uri() . '/css/styles.min.css',false,'1.0','all');
	
	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/css/slick-theme.css',false,'1.0','all');

	wp_enqueue_style( 'slick-css', get_template_directory_uri() . '/css/slick.css',false,'1.0','all');
	
}

add_action( 'wp_enqueue_scripts', 'add_theme_style' );

// Adding scripts
function add_theme_scripts() {
	wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array ( 'jquery', 'jquery-ui-core' ), 1.1, false);
	
	wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/js/slick.min.js', array('jquery'),'1.6', false);

}

add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

//add theme Header Support
$header_logo = array(
	'default-image'          => '',
	'width'                  => 150,
	'height'                 => 150,
	'flex-height'            => false,
	'flex-width'             => false,
	'uploads'                => true,
	'random-default'         => false,
	'header-text'            => true,
	'default-text-color'     => '',
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);

add_theme_support( 'custom-header', $header_logo );
add_theme_support( 'custom-background' );
add_theme_support( 'post-thumbnails' );


//Menu

function register_menu() {
  register_nav_menu('header',__( 'Murphys' ));
}

add_action( 'init', 'register_menu' );

?>