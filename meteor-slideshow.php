<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Load Meteor Slideshow based on Rhino options.
 *
 * @since  	1.0.3
 * @package Rhino
 * @author 	Rockhouse
 */

if( is_front_page() ) {

	$rhino_slideshow_position = get_field('rhino_slider_layout', 'option');
	if( empty( $rhino_slideshow_position ) ) {
		$rhino_slideshow_position = 'bottom';
	}

	include( 'layouts/meteorslides/meteor-slideshow-' . $rhino_slideshow_position . '.php' );

} else {

	include( WP_PLUGIN_DIR . '/meteor-slides/includes/meteor-slideshow.php' );

}
