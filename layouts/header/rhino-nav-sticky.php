<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Load Rhino Sticky Header.
 *
 * @since  	1.0.0
 * @package Rhino
 * @author 	Rockhouse
 */

add_action( 'woo_header_after' , 'rhino_nav_sticky_start', 30 );

if ( !function_exists( 'rhino_nav_sticky_start' ) ) {

	function rhino_nav_sticky_start() {

		if( get_field( 'rhino_sticky_navigation', 'options' ) ) {

			echo '<div class="rhino_nav_sticky_wrap">';
		}
	}

} // End if

/**
 * Load Rhino Sticky Footer Div.
 *
 * @since  	1.0.0
 * @package Rhino
 * @author 	Rockhouse
 */

add_action( 'woo_foot' , 'rhino_nav_sticky_end', 30 );

if ( !function_exists( 'rhino_nav_sticky_end' ) ) {

	function rhino_nav_sticky_end() {

		if( get_field( 'rhino_sticky_navigation', 'options' ) ) {

			echo '</div>';

		}
	}

} // End if
