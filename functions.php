<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis Child' );
define( 'CHILD_THEME_URL', 'http://conetfun.com/' );
define( 'CHILD_THEME_VERSION', '0.1' );

//* Enqueue Scripts and styles and fonts
add_action( 'wp_enqueue_scripts', 'personal_google_fonts' );
function personal_google_fonts() {
	wp_enqueue_style( 'google-font', '//fonts.googleapis.com/css?family=Open+Sans:300,400,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_script( 'plugins' , get_stylesheet_directory_uri().'/assets/js/plugins.min.js');
	wp_enqueue_script( 'main' , get_stylesheet_directory_uri().'/assets/js/main.min.js');
}

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

// Add Genesis structural wraps
add_theme_support( 'genesis_structural_wraps', array('header', 'nav', 'subnav', 'site-inner', 'footer-widgets', 'footer' ));

// Add footer widgets
add_theme_support( genesis-footer-widgets, 3);

//* Add the default featured image size
add_image_size( 'Featured Image', 660, 150, true );

//* Remove Genesis in-post SEO Settings
remove_action( 'admin_menu', 'genesis_add_inpost_seo_box' );

//* Remove Genesis Layout Settings
remove_theme_support( 'genesis-inpost-layouts' );

//* Remove Genesis SEO Settings menu link
remove_theme_support( 'genesis-seo-settings-menu' );

//* Unregister  layout setting
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'full-width-content' );

//* Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );

//* Remove the entry meta in the entry footer
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

//* Move Floating Social Bar outside of entry content
add_action( 'pre_get_posts', 'personal_remove_social_bar', 15 );
/**
* @author Gary Jones
* @link http://gamajo.com/move-floating-social-bar
*/
function personal_remove_social_bar() {
if ( class_exists( 'floating_social_bar' ) ) {
	remove_filter( 'the_excerpt', array( floating_social_bar::get_instance(), 'fsb' ), apply_filters( 'fsb_social_bar_priority', 10 ) );
	remove_filter( 'the_content', array( floating_social_bar::get_instance(), 'fsb' ), apply_filters( 'fsb_social_bar_priority', 10 ) );
	}
}
add_action( 'genesis_before_entry_content', 'personal_add_social_bar' );
function personal_add_social_bar() {
	if ( class_exists( 'floating_social_bar' ) ) {
		echo floating_social_bar::get_instance()->fsb('');
	}
}

//* Added the featured image to single post
add_action( 'genesis_entry_header', 'single_post_featured_image', 15 );
function single_post_featured_image() {
	if ( ! is_singular( 'post' ) )
		return;
	$img = genesis_get_image( array( 'format' => 'html', 'size' => genesis_get_option( 'image_size' ), 'attr' => array( 'class' => 'alignleft post-image entry-image' ) ) );
	printf( '<a href="%s" title="%s">%s</a>', get_permalink(), the_title_attribute( 'echo=0' ), $img );
}

//* Register newsletter widget area
genesis_register_sidebar( array(
	'id'		=> 'newsletter',
	'name'		=> __( 'Newsletter', 'CHILD_THEME_NAME' ),
	'description'	=> __( 'This is the newsletter section.', 'CHILD_THEME_NAME' ),
) );
 
//* Add the newsletter widget after the post content
add_action( 'genesis_entry_footer', 'personal_newsletter_box' );
function personal_newsletter_box() {
	if ( is_singular( 'post' ) )
	genesis_widget_area( 'newsletter', array(
		'before' => '<div id="newsletter">',
	) );
}

//* Customize the entire footer
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'personal_footer' );
function personal_footer() {
    ?>
    	<p>Copyright © 2013 <?php echo bloginfo('name');?>.</p>
			<p>Proudly powered by <a href="http://www.wordpress.org/" title="WordPress">WordPress</a></p>
    <?php
}

//* Remove WP version param from any enqueued scripts
function remove_wp_ver( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'remove_wp_ver', 9999 );
add_filter( 'script_loader_src', 'remove_wp_ver', 9999 );
