<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Load Font Awesome.
 *
 * @since  	1.0.0
 * @package Rhino
 * @author 	Rockhouse
 */

add_action( 'woo_head' , 'rhino_font_awesome' );

if ( !function_exists( 'rhino_font_awesome' ) ) {

	function rhino_font_awesome() {

    	echo "<link href=\"//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css\" rel=\"stylesheet\">" . "\n" .
		"<!--[if IE 7]><link href=\"//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css\" rel=\"stylesheet\"><![endif]-->" . "\n\n";

	} // End rhino_font_awesome()

} // End if
