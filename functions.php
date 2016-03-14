<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'RHP_RHINO_VER', '1.3.1' );

/**
 * Load the included PHP files.
 *
 * @since  	1.0.0
 * @package Rhino
 * @author 	Rockhouse
 */

// Load our License insertions
require_once( get_stylesheet_directory() . '/includes/licenses.php' );

// Load Built-in ACF Field Sets
require_once( get_stylesheet_directory() . '/includes/acf/acf-rhino-slides.php' );

// Load Rhino Updater
require_once( get_stylesheet_directory() . '/includes/update.php' );

// Load WP updates on theme switch
require_once( get_stylesheet_directory() . '/includes/install.php' );

// Load Comment Destroyer
require_once( get_stylesheet_directory() . '/includes/comments.php' );

// Load Yoast-specific overrides when plugin is active
if( defined( 'WPSEO_VERSION' ) and class_exists('RockhouseEvents') ) {
	require_once ( get_stylesheet_directory() . '/includes/seo-yoast.php' );
}

// Load Tribe Overrides
if( class_exists('RockhouseEvents') ) {
	require_once( get_stylesheet_directory() . '/includes/tribe-events.php' );
}

// Load required plugins and plugin customizations
require_once( get_stylesheet_directory() . '/includes/plugins-tgmpa.php' );
require_once( get_stylesheet_directory() . '/includes/plugins.php' );
require_once( get_stylesheet_directory() . '/includes/plugins-addthis.php' );
require_once( get_stylesheet_directory() . '/includes/plugins-limitlogin.php' );
require_once( get_stylesheet_directory() . '/includes/plugins-meteorslides.php' );

// Load Widgets
require_once( get_stylesheet_directory() . '/includes/widget-rhino-mailchimp.php' );

// Transitional loading of pre-1.3 styles
require_once( get_stylesheet_directory() . '/includes/woo-options-output.php' );
require_once( get_stylesheet_directory() . '/includes/woo-options-output-type.php' );
require_once( get_stylesheet_directory() . '/includes/woo-font-awesome.php' );

// Load WooFramework customizations
require_once( get_stylesheet_directory() . '/includes/woo-footer.php' );
require_once( get_stylesheet_directory() . '/includes/woo-footer-rockhouse-powered.php' );
require_once( get_stylesheet_directory() . '/includes/woo-header.php' );
require_once( get_stylesheet_directory() . '/includes/woo-menus.php' );
require_once( get_stylesheet_directory() . '/includes/woo-sidebars.php' );
require_once( get_stylesheet_directory() . '/includes/woo-slider.php' );

// Add our Control Panel and legacy Woo Framework options
require_once( get_stylesheet_directory() . '/includes/rhino-options.php' );
require_once( get_stylesheet_directory() . '/includes/woo-options.php' );

// Load Rhino Schemes
require_once( get_stylesheet_directory() . '/includes/rhino-schemes.php' );
require_once( get_stylesheet_directory() . '/layouts/header/rhino-nav-sticky.php' );

// Enqueue Scripts / Styles
add_action( 'wp_enqueue_scripts', 'rhino_enqueue_scripts', 15 );

function rhino_enqueue_scripts() {

	// Legacy stylesheet for backwards compatibility
	wp_enqueue_style( 'rhino-transitional', get_stylesheet_directory_uri() . '/style-transitional.css' );

	// Add in our Sass based styles and variables, powered by the Sassify plugin
	if( function_exists( 'get_field' ) and get_field('rhino_enable_sassify', 'option') ) {
		require_once( get_stylesheet_directory() . '/includes/rhino-sassify.php' );
		wp_enqueue_style( 'rhino-scss', get_stylesheet_directory_uri() . '/scss/rhino-style.scss', array( 'rhino-transitional' ) );
	}

	// Add our custom JS
	wp_register_script( 'rhino-js' , get_stylesheet_directory_uri() . '/js/rhino.js', array('jquery'), RHP_RHINO_VER, true );
	wp_enqueue_script( 'rhino-js' );

	// Accordion for event series
	wp_enqueue_script( 'jquery-ui-accordion' );

	// Add our tabs if we have them enabled on the homepage
	if( is_front_page() and function_exists( 'get_field' ) and get_field( 'tabbed_widgets_on_homepage', 'options' ) ) {
		wp_register_script( 'responsivetabs-js' , get_stylesheet_directory_uri() . '/js/responsiveTabs.min.js', array('jquery'), RHP_RHINO_VER );
		wp_enqueue_script( 'responsivetabs-js' );

		wp_register_style( 'responsivetabs-css' , get_stylesheet_directory_uri() . '/css/responsive-tabs.css', null, RHP_RHINO_VER );
		wp_enqueue_style( 'responsivetabs-css' );
	}

	if( function_exists( 'tribe_is_list_view' ) and tribe_is_list_view() ) {
        wp_dequeue_style('tribe-events-custom-jquery-styles');
    }

}

// Enqueue Scripts / Styles for WP Admin
add_action('admin_enqueue_scripts','rhino_admin_styles');

function rhino_admin_styles() {
	wp_register_script( 'rhino-admin-js' , get_stylesheet_directory_uri() . '/js/admin.js', array('jquery'), RHP_RHINO_VER, true );
	wp_enqueue_script( 'rhino-admin-js' );

	wp_register_style( 'rhino-admin-styles', get_stylesheet_directory_uri() . '/css/styles-wpadmin.css', null, RHP_RHINO_VER );
	wp_enqueue_style( 'rhino-admin-styles' );

	// Plugin and Styles for SyntaxHighlighter
	if( isset( $_GET['tab'] ) and $_GET['tab'] == 'custom-css' ) {
		wp_register_script( 'rhino-sh-js' , 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.1.8/ace.js', array('jquery'), RHP_RHINO_VER, true );
		wp_enqueue_script( 'rhino-sh-js' );
	}

}

// Insert our ACF Option Pages
if( function_exists('acf_add_options_sub_page') ) {

	acf_add_options_sub_page(array(
		'title' => 'Site Styles',
		'parent' => 'woothemes',
		'capability' => 'manage_options'
	));

	acf_add_options_sub_page(array(
		'title' => 'Zookeeper',
		'parent' => 'woothemes',
		'capability' => 'manage_options'
	));
}

// Remove elements from Admin Bar
add_action( 'wp_before_admin_bar_render', 'rhino_custom_admin_bar', 7 );

function rhino_custom_admin_bar() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo');
	$wp_admin_bar->remove_menu('search');
	$wp_admin_bar->remove_menu('comments');
	$wp_admin_bar->remove_menu('new-content');
	$wp_admin_bar->remove_menu('wpseo-menu');
}

// Disable Canvas' Portfolio CPT
function woo_add_portfolio() {
	return;
}

// Disable Canvas' admin header redirect that breaks after_theme_switch
// See: canvas/functions/admin-setup.php
function woo_themeoptions_redirect () {
	// Do nothing!
}

function woo_enqueue_custom_styling () {
	// Do nothing!
}


// Due to a bug in the Sassify plugin, the Colors class is missing
if( function_exists( 'get_field' ) and get_field('rhino_enable_sassify', 'option') and ! class_exists( 'Colors' ) ) {

	class Colors
	{
		/**
		 * CSS Colors
		 *
		 * @see http://www.w3.org/TR/css3-color
		 *
		 * @var array
		 */
		public static $cssColors = array(
			'aliceblue' => '240,248,255',
			'antiquewhite' => '250,235,215',
			'aqua' => '0,255,255',
			'aquamarine' => '127,255,212',
			'azure' => '240,255,255',
			'beige' => '245,245,220',
			'bisque' => '255,228,196',
			'black' => '0,0,0',
			'blanchedalmond' => '255,235,205',
			'blue' => '0,0,255',
			'blueviolet' => '138,43,226',
			'brown' => '165,42,42',
			'burlywood' => '222,184,135',
			'cadetblue' => '95,158,160',
			'chartreuse' => '127,255,0',
			'chocolate' => '210,105,30',
			'coral' => '255,127,80',
			'cornflowerblue' => '100,149,237',
			'cornsilk' => '255,248,220',
			'crimson' => '220,20,60',
			'cyan' => '0,255,255',
			'darkblue' => '0,0,139',
			'darkcyan' => '0,139,139',
			'darkgoldenrod' => '184,134,11',
			'darkgray' => '169,169,169',
			'darkgreen' => '0,100,0',
			'darkgrey' => '169,169,169',
			'darkkhaki' => '189,183,107',
			'darkmagenta' => '139,0,139',
			'darkolivegreen' => '85,107,47',
			'darkorange' => '255,140,0',
			'darkorchid' => '153,50,204',
			'darkred' => '139,0,0',
			'darksalmon' => '233,150,122',
			'darkseagreen' => '143,188,143',
			'darkslateblue' => '72,61,139',
			'darkslategray' => '47,79,79',
			'darkslategrey' => '47,79,79',
			'darkturquoise' => '0,206,209',
			'darkviolet' => '148,0,211',
			'deeppink' => '255,20,147',
			'deepskyblue' => '0,191,255',
			'dimgray' => '105,105,105',
			'dimgrey' => '105,105,105',
			'dodgerblue' => '30,144,255',
			'firebrick' => '178,34,34',
			'floralwhite' => '255,250,240',
			'forestgreen' => '34,139,34',
			'fuchsia' => '255,0,255',
			'gainsboro' => '220,220,220',
			'ghostwhite' => '248,248,255',
			'gold' => '255,215,0',
			'goldenrod' => '218,165,32',
			'gray' => '128,128,128',
			'green' => '0,128,0',
			'greenyellow' => '173,255,47',
			'grey' => '128,128,128',
			'honeydew' => '240,255,240',
			'hotpink' => '255,105,180',
			'indianred' => '205,92,92',
			'indigo' => '75,0,130',
			'ivory' => '255,255,240',
			'khaki' => '240,230,140',
			'lavender' => '230,230,250',
			'lavenderblush' => '255,240,245',
			'lawngreen' => '124,252,0',
			'lemonchiffon' => '255,250,205',
			'lightblue' => '173,216,230',
			'lightcoral' => '240,128,128',
			'lightcyan' => '224,255,255',
			'lightgoldenrodyellow' => '250,250,210',
			'lightgray' => '211,211,211',
			'lightgreen' => '144,238,144',
			'lightgrey' => '211,211,211',
			'lightpink' => '255,182,193',
			'lightsalmon' => '255,160,122',
			'lightseagreen' => '32,178,170',
			'lightskyblue' => '135,206,250',
			'lightslategray' => '119,136,153',
			'lightslategrey' => '119,136,153',
			'lightsteelblue' => '176,196,222',
			'lightyellow' => '255,255,224',
			'lime' => '0,255,0',
			'limegreen' => '50,205,50',
			'linen' => '250,240,230',
			'magenta' => '255,0,255',
			'maroon' => '128,0,0',
			'mediumaquamarine' => '102,205,170',
			'mediumblue' => '0,0,205',
			'mediumorchid' => '186,85,211',
			'mediumpurple' => '147,112,219',
			'mediumseagreen' => '60,179,113',
			'mediumslateblue' => '123,104,238',
			'mediumspringgreen' => '0,250,154',
			'mediumturquoise' => '72,209,204',
			'mediumvioletred' => '199,21,133',
			'midnightblue' => '25,25,112',
			'mintcream' => '245,255,250',
			'mistyrose' => '255,228,225',
			'moccasin' => '255,228,181',
			'navajowhite' => '255,222,173',
			'navy' => '0,0,128',
			'oldlace' => '253,245,230',
			'olive' => '128,128,0',
			'olivedrab' => '107,142,35',
			'orange' => '255,165,0',
			'orangered' => '255,69,0',
			'orchid' => '218,112,214',
			'palegoldenrod' => '238,232,170',
			'palegreen' => '152,251,152',
			'paleturquoise' => '175,238,238',
			'palevioletred' => '219,112,147',
			'papayawhip' => '255,239,213',
			'peachpuff' => '255,218,185',
			'peru' => '205,133,63',
			'pink' => '255,192,203',
			'plum' => '221,160,221',
			'powderblue' => '176,224,230',
			'purple' => '128,0,128',
			'red' => '255,0,0',
			'rosybrown' => '188,143,143',
			'royalblue' => '65,105,225',
			'saddlebrown' => '139,69,19',
			'salmon' => '250,128,114',
			'sandybrown' => '244,164,96',
			'seagreen' => '46,139,87',
			'seashell' => '255,245,238',
			'sienna' => '160,82,45',
			'silver' => '192,192,192',
			'skyblue' => '135,206,235',
			'slateblue' => '106,90,205',
			'slategray' => '112,128,144',
			'slategrey' => '112,128,144',
			'snow' => '255,250,250',
			'springgreen' => '0,255,127',
			'steelblue' => '70,130,180',
			'tan' => '210,180,140',
			'teal' => '0,128,128',
			'thistle' => '216,191,216',
			'tomato' => '255,99,71',
			'transparent' => '0,0,0,0',
			'turquoise' => '64,224,208',
			'violet' => '238,130,238',
			'wheat' => '245,222,179',
			'white' => '255,255,255',
			'whitesmoke' => '245,245,245',
			'yellow' => '255,255,0',
			'yellowgreen' => '154,205,50'
		);
	}
}
