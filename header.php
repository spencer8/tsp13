<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"" />
<title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css?v=1" />
<link href="<?php bloginfo('template_url');?>/css/responsive.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<script type="text/javascript" src="//use.typekit.net/zyv2sti.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_enqueue_script('jquery'); ?>
<?php wp_enqueue_script('jquery-cycle2', get_template_directory_uri() . '/js/cycle.js', array('jquery')); ?>
<?php wp_enqueue_script('jquery-spriteAnimation', get_template_directory_uri() . '/js/spriteAnimation.js', array('jquery')); ?>
<?php wp_enqueue_script('jquery-iosslider', get_template_directory_uri() . '/js/jquery.iosslider.js', array('jquery')); ?>
<?php wp_head(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/header.js" type="text/javascript"></script>
</head>

<body <?php body_class(); ?>>
	<div id="header" class="site-header" role="banner">

		<div id="nav" class="main-navigation" role="navigation">
			<a class="logo" href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/tsp-logo-w-paper-reverse.png" width="112" height="170" alt="Triple Stamp Press" /></a>
			<a class="minilogo" href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/tsp-logo-sm.png" width="31" height="29" alt="Triple Stamp Press" /></a>
			<?php $args = array(
				'theme_location'  => 'header', 
				'container'       => false, 
				'menu_class'      => 'menu', 
				'menu_id'         => 'menu-header',
			); 
			wp_nav_menu( $args );
			?>
				<?php wp_nav_menu(array(
                    'theme_location' => 'mini', // your theme location here				
					'container'       => 'div', 
					'container_class' => 'mininav',
                    'walker'         => new Walker_Nav_Menu_Dropdown(),
                    'items_wrap'     => '<select>%3$s</select>',
                ));
                //uses walker to generate select menu from header navmenu  ?>
			<a class="pricing" href="<?php bloginfo('url'); ?>/pricing"></a>
			<a class="minipricing" href="<?php bloginfo('url'); ?>/pricing"><img src="<?php bloginfo('template_directory'); ?>/images/pricing-mini.png" width="88" height="88" alt="get an instant pricing quote" /></a>
			</a>
			<p class="borderholder"></p>
            <div id="subheadwrap">
                <p class="headcontact">info@triplestamppress.com  |  (804) 233-1502</p>
            </div>
		</div><!-- #nav -->

	</div><!-- #masthead -->
    <div id="subhead"></div>
	<div id="main" class="wrapper">
