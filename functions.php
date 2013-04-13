<?php
/**
 * dineWithMe functions and definitions
 *
 * @package dineWithMe
 * @since dineWithMe 1.0.0
 */

if ( ! function_exists( 'dineWithMe_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since dineWithMe 1.0.0
 */
function dineWithMe_setup() {
	
	add_theme_support('custom-header', array (
	        // Header image default
	       'default-image'			=> get_stylesheet_directory_uri() . '/images/default-logo.png'));
}
endif; // dineWithMe_setup
add_action( 'after_setup_theme', 'dineWithMe_setup' );


/**
 * Enqueue scripts and styles
 */
function dineWithMe_scripts() {
	
	wp_enqueue_style( 'googleFonts', '//fonts.googleapis.com/css?family=Balthazar|Nunito|Noto Sans' );

}
add_action( 'wp_enqueue_scripts', 'dineWithMe_scripts' );



/**
 * Menu shortcode
 * [menuitem name="" desc="" price=""]
 */
function dineWithMe_menuitem_handler( $atts ){
	extract( shortcode_atts( array(
		'name' => 'Enter menu item name',
		'desc' => 'Enter menu item description',
		'price' => 'Enter menu item price',
	), $atts ) );

	$name = $atts['name'];
	$desc = $atts['desc'];
	$price = $atts['price'];

	return '<div class="dineWithMe-menu-item-container"><div class="dineWithMe-menu-item-wrapper"><h2 class="dineWithMe-menu-item-name">' . $name . '</h2><h4 class="dineWithMe-menu-item-desc">' . $desc . '</h4></div><h2 class="dineWithMe-menu-item-price">' . $price . '</h2></div>';
}
add_shortcode( 'menuitem', 'dineWithMe_menuitem_handler' );



/**
 * Add menuitem shortcode button on the tinyMCE editor
 */
function dineWithMe_menuitem_register_button( $buttons ) {
   array_push( $buttons, "|", "menuitem" );
   return $buttons;
}
function dineWithMe_menuitem_add_plugin( $plugin_array ) {
   $plugin_array['menuitem'] = get_stylesheet_directory_uri() . '/js/menuitem.js';
   return $plugin_array;
}
function dineWithMe_menuitem_button() {
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
      return;
   }

   if ( get_user_option('rich_editing') == 'true' ) {
      add_filter( 'mce_external_plugins', 'dineWithMe_menuitem_add_plugin' );
      add_filter( 'mce_buttons', 'dineWithMe_menuitem_register_button' );
   }
}
add_action('init', 'dineWithMe_menuitem_button');



/**
 * Add menuitem shortcode button on the HTML editor
 */
function dineWithMe_menuitem_quicktags() {
	wp_enqueue_script( 'dineWithMe_menuitem_quicktags', get_stylesheet_directory_uri() . '/js/menuitem_quicktag.js', array( 'quicktags' ), '20130412', true );
}
add_action('admin_print_scripts', 'dineWithMe_menuitem_quicktags');



/**
 * Override responsive theme option defaults
 */
function dineWithMe_default_options ($defaults) {
	$dineWithMe_defaults = array(
		'breadcrumb' => false,
		'cta_button' => false,
		'front_page' => 1,
		'home_headline' => __('Dine with Me','dineWithMe'),
		'home_subheadline' => __('Your H2 subheadline here','dineWithMe'),
		'home_content_area' => __('Edit this area in the theme options.','dineWithMe'),
		'cta_text' => __('Order Now','dineWithMe'),
		'cta_url' => '#nogo',
		'featured_content' => '<img class="aligncenter" src="' . get_stylesheet_directory_uri() . '/images/featured-image.png" width="562" height="338" alt="" />',
		'google_site_verification' => '',
		'bing_site_verification' => '',
		'yahoo_site_verification' => '',
		'site_statistics_tracker' => '',
		'twitter_uid' => '',
		'facebook_uid' => '',
		'linkedin_uid' => '',
		'youtube_uid' => '',
		'stumble_uid' => '',
		'rss_uid' => '',
		'google_plus_uid' => '',
		'instagram_uid' => '',
		'pinterest_uid' => '',
		'yelp_uid' => '',
		'vimeo_uid' => '',
		'foursquare_uid' => '',
		'responsive_inline_css' => '',
		'responsive_inline_js_head' => '',
		'responsive_inline_css_js_footer' => '',
		'static_page_layout_default' => 'content-sidebar-page',
		'single_post_layout_default' => 'content-sidebar-page',
		'blog_posts_index_layout_default' => 'content-sidebar-page',
	);

	return $dineWithMe_defaults;
}
add_filter ('responsive_option_defaults','dineWithMe_default_options');


/**
 * Theme Options Support and Information
 */	
function dineWithMe_theme_support () {
?>

<div class="info-box notice" style="margin-bottom: 0">
	<a class="gold button" href="<?php echo esc_url(__('https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=PUKAB93RNE83S','dineWithMe')); ?>" title="<?php esc_attr_e('Donate Now', 'dineWithMe'); ?>" target="_blank">
	<?php printf(__('Donate to Dine with Me Child Theme','dineWithMe')); ?></a>
	<a class="gold button" href="<?php echo esc_url(__('http://pure-essence.net/2013/04/13/dine-with-me-child-theme-for-responsive/','dineWithMe')); ?>" title="<?php esc_attr_e('Support', 'dineWithMe'); ?>" target="_blank">
	<?php printf(__('Dine with Me Child Theme Support','dineWithMe')); ?></a>
</div>

<?php }
add_action('responsive_theme_options','dineWithMe_theme_support');
?>
