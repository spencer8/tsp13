<?php
/**
 * TSP setup.
 *
 * Sets up theme defaults and registers the various WordPress features 
 *
 * @uses add_theme_support() To add support for post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 *
 * @return void
 */
function tsp13_setup() {
	
	add_theme_support( 'post-thumbnails' );

	register_nav_menus( array(
		'header' => 'Main Navigation',
		'mini' => 'Mobile Navigation'
	) );

}
add_action( 'after_setup_theme', 'tsp13_setup' );

/**
 * Enqueue scripts and styles for the front end.
 *
 * @return void
 */
function tsp13_scripts_styles() {
	// Loads our main stylesheet.
	wp_enqueue_style( 'tsp13-style', get_template_directory_uri() . '/css/style.css?v=1.1', array(), '2015-07-25' );

	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-cycle2', get_template_directory_uri() . '/js/cycle.js', array('jquery'));
	wp_enqueue_script('jquery-spriteAnimation', get_template_directory_uri() . '/js/spriteAnimation.js', array('jquery'));
	wp_enqueue_script('jquery-iosslider', get_template_directory_uri() . '/js/jquery.iosslider.js', array('jquery'));
	
	// Loads JavaScript file with functionality specific to Team Eight.
	//wp_enqueue_script( 'tsp13-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '2013-07-18', true );

}
add_action( 'wp_enqueue_scripts', 'tsp13_scripts_styles' );

function is_portrait( $image_url ){
	$isize = ( getimagesize( $image_url ) );
	//array 0 is height, 1 is width
	//echo $isize[0]. '-' . $isize[1];
	if ( $isize[0] <= $isize[1] ) { 
		return true; 
	} else { 
		return false;
	}
}

/**
 * Register our sidebars and widgetized areas.
 *
 */
function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'Footer Area 1',
		'id'            => 'footer_1',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => 'Footer Area 2',
		'id'            => 'footer_2',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );


function change_post_menu_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'Products';
	$submenu['edit.php'][5][0] = 'All Products';
	$submenu['edit.php'][10][0] = 'Add Product';
	$submenu['edit.php'][16][0] = 'Product Tags';
	echo '';
}
function change_post_object_label() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'Products';
	$labels->singular_name = 'Product';
	$labels->add_new = 'Add Product';
	$labels->add_new_item = 'Add Product';
	$labels->edit_item = 'Edit Product';
	$labels->new_item = 'Product';
	$labels->view_item = 'View Product';
	$labels->search_items = 'Search Products';
	$labels->not_found = 'No Products found';
	$labels->not_found_in_trash = 'No Products found in Trash';
}
add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );
add_action('wp_ajax_tsp_calc_type', 'tsp_calc_type');
add_action('wp_ajax_nopriv_tsp_calc_type', 'tsp_calc_type');
add_action('wp_ajax_tsp_stat_qty', 'tsp_stat_qty');
add_action('wp_ajax_nopriv_tsp_stat_qty', 'tsp_stat_qty');

add_post_type_support( 'post', 'page-attributes' ); //add menu order to posts

// AJAX FUNCTIONS

function tsp_calc_type() {
	global $wpdb;
	if (! wp_verify_nonce($_POST['nonce'], 'tsp_nonce') ){
		$return = 'bad nonce';
		die();
	}
	
	$cat = esc_html($_POST['cat']);
	$products = get_posts('posts_per_page=-1&order=ASC&cat='.$cat);
	$return = array();
	foreach($products as $product) {
		$price = get_field('price', $product->ID);
		$return[] = array('id' => $product->ID, 'slug' => $product->post_name, 'title' => $product->post_title, 'price' => $price);
	}
	
	echo json_encode($return);
	exit;
}

function tsp_stat_qty() {
	global $wpdb;
	if (! wp_verify_nonce($_POST['nonce'], 'tsp_nonce') ){
		$return = 'bad nonce';
		die();
	}
	
	$return = 'empty';
	$qty_price = esc_html($_POST['array']);
	$name = esc_html($_POST['size']);
	$stat_sizes = get_field('sizes', 382);

	foreach($stat_sizes as $size) {
		if($size['size'] == $name) {
			$return = $size['qty_price'];
		}
	}
	
	echo json_encode($return);
	exit;
}

// CATEGORY HAS PARENT

function category_has_parent($catid){
    $category = get_category($catid);
    if ($category->category_parent > 0){
        return true;
    }
    return false;
}

class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu{
 function start_lvl(&$output, $depth){
      $indent = str_repeat("\t", $depth); // don't output children opening tag (`<ul>`)
    }

    function end_lvl(&$output, $depth){
      $indent = str_repeat("\t", $depth); // don't output children closing tag
    }

    function start_el(&$output, $item, $depth, $args){
      // add spacing to the title based on the depth
      $item->title = str_repeat("&nbsp;", $depth * 4).$item->title;
      	if (!isset($attributes)) $attributes = '';
      	if (!isset($value)) $value = '';
      	if (!isset($item_output)) $item_output = '';
        $attributes .= ' id="menu-item-'. $item->ID . '"' . $value;  
        $attributes  .= ! empty( $item->classes ) ? ' class="'.implode($item->classes, ' ') .'"' : '';  
        $attributes  .= ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';  
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';  
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';  
        $attributes .= ! empty( $item->url )        ? ' value="'   . esc_attr( $item->url        ) .'"' : '';  
        
        $item_output .= '<option'. $attributes .'>';  
        $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );  
        $item_output .= '</option>';  
        
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );  



      // no point redefining this method too, we just replace the li tag...
      $output = str_replace('<li', '<option', $output);
    }


//	  $class_names = 'class="'.implode($item->classes, ' ');


    function end_el(&$output, $item, $depth){
      $output .= "</option>\n"; // replace closing </li> with the option tag
    }
}
function my_myme_types($mime_types){
	$mime_types['eps'] = 'application/postscript'; 
	$mime_types['ai'] = 'application/postscript';
	$mime_types['ait'] = 'application/postscript';
	$mime_types['psd'] = 'application/postscript'; 
	$mime_types['tif'] = 'application/postscript';
    return $mime_types;
}
add_filter('upload_mimes', 'my_myme_types', 1, 1);


if ( is_admin() ) { // check to make sure we aren't on the front end
	add_filter('wpseo_pre_analysis_post_content', 'add_custom_to_yoast');

	function add_custom_to_yoast( $content ) {
		global $post;
		$pid = $post->ID;
		
		$custom = get_post_custom($pid);
		unset($custom['_yoast_wpseo_focuskw']); // Don't count the keyword in the Yoast field!

		foreach( $custom as $key => $value ) {
			if( substr( $key, 0, 1 ) != '_' && substr( $value[0], -1) != '}' && !is_array($value[0]) && !empty($value[0])) {
			  $custom_content .= $value[0] . ' ';
			}

		}

		$content = $content . ' ' . $custom_content;
		return $content;

		remove_filter('wpseo_pre_analysis_post_content', 'add_custom_to_yoast'); // don't let WP execute this twice
	}
}




//eof