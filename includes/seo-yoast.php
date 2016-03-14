<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Yoast WordPress SEO Plugin Overrides
 *
 * @since  	1.0.0
 * @package Rhino
 * @author 	Rockhouse
 */

/**
 * Filter to provide title support for
 * The Events Calendar plugin by Modern Tribe.
 *
 * Reference:
 * https://gist.github.com/jo-snips/3710617
 * http://tri.be/support/forums/topic/yoast-ecl/
 *
 */

add_filter('wpseo_title','rhino_custom_titles');

function rhino_custom_titles($title) {

	if( tribe_is_month() && !is_tax() ) { // Main Calendar Page

		return wpseo_replace_vars('Calendar %%sep%% %%sitename%%',array());

	} elseif( tribe_is_month() && is_tax() ) { // Calendar Category Pages

		return wpseo_replace_vars('Calendar &raquo; ' . single_term_title('', false) . ' %%sep%% %%sitename%%',array());

	} elseif( tribe_is_event() && !tribe_is_day() && !is_single() ) { // Main Events List

		$yoast_override = get_field( 'yoast_seo_events_title' );
		$title = empty( $yoast_override ) ? 'Upcoming Events %%sep%% %%sitename%%' : $yoast_override;

		if( is_tax( Tribe__Events__Main::TAXONOMY ) ) {
			$term = get_queried_object();
			$title = htmlentities( $term->name ) . ' %%sep%% %%sitename%%';
		}

		return wpseo_replace_vars($title,array());

	} elseif( tribe_is_event() && is_single() ) { // Single Event Page

		// Follow the date format set in Tribe, add Venue if we need
		$date_format = tribe_get_date_format();
		$date = tribe_get_start_date( null, false, '- '.$date_format);
		$title = get_the_title();
		$location = tribe_has_venue() ? tribe_get_venue() : '%%sitename%%';
		return wpseo_replace_vars("{$title} {$date} %%sep%% {$location}",array());

	} elseif( tribe_is_day() ) { // Single Day Events

		return 'Events on: ' . date('F j, Y', strtotime($wp_query->query_vars['eventDate']));

	} elseif( tribe_is_venue() ) { // Single Venues

		$yoast_titles = get_option('wpseo_titles');
		return wpseo_replace_vars($yoast_titles['title-tribe_venue'],array());

	} elseif( tribe_is_event() and stripos( $title, 'Archives' ) ) { // Double check any kind of event archive

		return str_ireplace( '%Archives%', '', $title );

	} else {

		return $title;

	}

}


/**
 * Change OpenGraph type to activity for events
 *
 * Filter: wpseo_opengraph_type
 */
add_filter('wpseo_opengraph_type','rhino_yoast_ogtype');

function rhino_yoast_ogtype($type) {
	return ( is_single() and Tribe__Events__Main::POSTTYPE == get_post_type() ) ? 'activity' : $type;
}

/**
 * Remove SEO column from any Post Type List in Admin View
 */

add_filter( 'wpseo_use_page_analysis', '__return_false' );

/**
 * STOP. THE. NOTICES.
 *
 * Inspired by https://gist.github.com/wpchannel/7cdd6eed0927ea5732d7
 */
add_action( 'admin_init', 'rhino_silence_yoast' );

function rhino_silence_yoast() {
	if( is_plugin_active('wordpress-seo/wp-seo.php') and class_exists( 'Yoast_Notification_Center' ) ) {
		remove_action('admin_notices', array(Yoast_Notification_Center::get(), 'display_notifications'));
		remove_action('all_admin_notices', array(Yoast_Notification_Center::get(), 'display_notifications'));
	}
}
