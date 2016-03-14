<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Load Rhino Menus.
 *
 * @since  	1.0.0
 * @package Rhino
 * @author 	Rockhouse
 */

add_action( 'init', 'rhino_menus_loader' );

if ( !function_exists( 'rhino_menus_loader' ) ) {

	function rhino_menus_loader() {

		register_nav_menus(

			array(

			'primary-menu' 	=> __( 'Primary Menu' ),
			'rhino-footer-menu' 	=> __( 'Rhino Footer Menu' )

			)
		);

	} // End rhino_menus_loader()

} // End if()