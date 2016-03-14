<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Register the individual layout CSS/JS scripts so they can be triggered
 * for inclusion based on the layouts set.
 *
 * @since	1.0.4
 * @author	Rockhouse
 */

add_action( 'wp_enqueue_scripts', 'rhino_layout_scripts' );

if ( !function_exists( 'rhino_layout_scripts' ) ) {

	function rhino_layout_scripts() {

		wp_register_style( 'rhino-nav-sticky-inside' , get_stylesheet_directory_uri() . '/layouts/header/rhino-nav-sticky-inside.css', null, RHP_RHINO_VER );
		wp_register_style( 'rhino-nav-sticky-outside' , get_stylesheet_directory_uri() . '/layouts/header/rhino-nav-sticky-outside.css', null, RHP_RHINO_VER );
		wp_register_script( 'rhino-nav-sticky' , get_stylesheet_directory_uri() . '/layouts/header/rhino-nav-sticky.js', array('jquery'), RHP_RHINO_VER, true );

        if ( get_field('rhino_navigation_position', 'option') == 'inside' ) {
			if ( get_field('rhino_sticky_navigation', 'option') == 'true' ) {
				wp_enqueue_style( 'rhino-nav-sticky-inside' );
				wp_enqueue_script( 'rhino-nav-sticky' );
			}
		} elseif ( get_field('rhino_sticky_navigation', 'option') == 'true' ) {
			wp_enqueue_style( 'rhino-nav-sticky-outside' );
			wp_enqueue_script( 'rhino-nav-sticky' );
		}
	}
}



/**
* If the option is selected, this
* places the nav container inside
* the header.
*
* @since      1.0.2
* @package Rhino
* @author     Rockhouse
*/

add_action( 'wp', 'rhino_nav_setup', 10 );

if ( !function_exists( 'rhino_nav_setup' ) ) {

	// We can have a navbar inside or ouside the header
	// Additionally that navbar can be fixed of floating (sticky)
    function rhino_nav_setup() {

		// wp_nav_menu is outside the header by default
        if ( get_field('rhino_navigation_position', 'option') == 'inside' ) {
			remove_action( 'woo_header_after','woo_nav', 10 );
			add_action( 'woo_header_inside','woo_nav', 50 );
			remove_action( 'woo_header_after', 'rhino_widget_above_nav' );
			add_action( 'woo_header_inside', 'rhino_widget_above_nav', 45 );
		} else {
			remove_action( 'woo_header_after','woo_nav', 10 );
			add_action( 'woo_header_after','woo_nav', 5 );
		}

    } // End rhino_nav_setup()

} // End if()



/**
 * Load Rhino Header.
 *
 * @since  	1.0.0
 * @package Rhino
 * @author 	Rockhouse
 */

add_action( 'woo_header_inside' , 'rhino_contact', 30 );


if ( !function_exists( 'rhino_contact' ) ) {

	function rhino_contact() {
		get_template_part('layouts/header/rhino-nav-contact');
	}

} // End if

/**
 * Add rhp-rhino class to body element
 */

add_filter( 'body_class', 'rhino_body_class' );

if ( !function_exists( 'rhino_body_class' ) ) {

	function rhino_body_class( $classes ) {
		if( function_exists( 'get_field' ) and get_field('rhino_enable_sassify', 'option') ) {
			$classes[] = 'rhp-rhino';
		}
		return $classes;
	}

}
