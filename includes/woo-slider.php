<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Remove WooSlider (to use Meteor Slides)
 *
 * Canvas creates a WP Admin Panel called 'Slides',
 * which conflicts with Meteor Slides.
 *
 * @since  	1.0.0
 * @package Rhino
 * @author 	Rockhouse
 */

add_action( 'after_setup_theme', 'rhino_remove_wooslider', 90 );

function rhino_remove_wooslider() {

	if( is_admin() and get_option( 'rhp_wooslider_enabled' , 'false' ) == 'false' ) {

		remove_theme_support( 'wooslider' );

		remove_action( 'init' , 'woo_add_slides' );

	} // End if

} // End rhino_remove_wooslider()