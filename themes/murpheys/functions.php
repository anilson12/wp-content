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
function add_theme_script() {
	wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array ( 'jquery', 'jquery-ui-core' ), 1.1, true);
	wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/js/slick.min.js', array('jquery'),'1.6', false);

}

add_action( 'wp_enqueue_scripts', 'add_theme_script' );

//add theme Header Support
$header_logo = array(
	'default-image'          => '',
	'width'                  => '',
	'height'                 => '',
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

class CSS_Menu_Walker extends Walker {

  var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
 
  function start_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul>\n";
  }
  
  function end_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
  }
  
  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
  
    global $wp_query;
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
    $class_names = $value = ''; 
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    
    /* Add active class */
    if(in_array('current-menu-item', $classes)) {
      $classes[] = 'active';
      unset($classes['current-menu-item']);
    }
    
    /* Check for children */
    $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' =>'_menu_item_menu_item_parent', 'meta_value' => $item->ID));
    if (!empty($children)) {
      $classes[] = 'has-sub';
    }
    
    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
    $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
    
    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
    $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
    
    $output .= $indent . '<li' . $id . $value . $class_names .'>';
    
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    
    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'><span>';
    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
    $item_output .= '</span></a>';
    $item_output .= $args->after;
    
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
  
  function end_el( &$output, $item, $depth = 0, $args = array() ) {
    $output .= "</li>\n";
  }
}  

//Register Categories Sidebar

$args = array(
	array('name'    => __('Post Sidebar'),
    'id'            => 'sidebar-1',          
	'description'   => 'Post sidebar for Archive',
	'class'         => '',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
	),
	array('name'    => __('Header Sidebar'),
    'id'            => 'sidebar-2',          
	'description'   => '',
	'class'         => '',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>' 
	),
	array('name'    => __('Footer Sidebar'),
    'id'            => 'sidebar-3',          
	'description'   => '',
	'class'         => '',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>' 
	),
	array('name'    => __('Left Sidebar'),
    'id'            => 'sidebar-4',          
	'description'   => '',
	'class'         => '',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>' 
	),
); 

register_sidebars( 4, $args );



?>