<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Add Rhino Sassify Variables
 *
 * @since  	1.3.0
 * @author 	Rockhouse
 */


/**
 * Merge our custom SCSS variables with plugin defaults to
 * populate further variables in our sass files
 */
add_filter( 'sassify_compiler_variables', 'rhino_sassify_vars', 15, 1 );

function rhino_sassify_vars( $vars ) {

	$defaults = array(
		'layout_width' 			=> '980px',
		'navigation_position' 	=> 'below',
		'body_font_family' 		=> "'Roboto', sans-serif",
		'header_font_family' 	=> "'Roboto', sans-serif",
		'button_font_family' 	=> "'Roboto', sans-serif",
		'primary_color' 		=> '#ABBB00',
		'secondary_color' 		=> '#232409',
		'tertiary_color' 		=> '#FCFEEC',
		'link_color' 			=> '#ABBB00',
		'bg_body_img' 			=> '',
		'bg_header_img' 		=> '',
		'bg_footer_img' 		=> '',
		'bg_body_repeat' 		=> 'no-repeat',
		'bg_header_repeat' 		=> 'no-repeat',
		'bg_footer_repeat' 		=> 'no-repeat',
		'bg_body_size' 			=> 'auto',
		'bg_header_size' 		=> 'auto',
		'bg_footer_size' 		=> 'auto',
		'button_primary_color' 	=> '#FE5D26',
		'button_radius'			=> '0px'
	);

	// TYPOGRAPHY
	$body_font_family_array = get_field('rhino_body_font_family', 'option');
	$header_font_family_array = get_field('rhino_header_font_family', 'option');
	$button_font_family_array = get_field('rhino_cta_font_family', 'option');

	$rhino =  array(
		// GENERAL
		'layout_width' => get_field('rhino_layout_width', 'option'),
		'navigation_position' => get_field('rhino_navigation_position', 'option'),

		// TYPOGRAPHY
		'body_font_family' => $body_font_family_array['font'],
		'header_font_family' => $header_font_family_array['font'],
		'button_font_family' => $button_font_family_array['font'],

		// COLORS
		'primary_color' => get_field('rhino_primary_color', 'option'),
		'secondary_color' => get_field('rhino_secondary_color', 'option'),
		'tertiary_color' => get_field('rhino_tertiary_color', 'option'),
		'link_color' => get_field('rhino_link_color', 'option'),

		 // BACKGROUNDS
		'bg_body_img' => get_field('rhino_bg_body_img', 'option'),
		'bg_header_img' => get_field('rhino_bg_header_img', 'option'),
		'bg_footer_img' => get_field('rhino_bg_footer_img', 'option'),
		'bg_body_repeat' => get_field('rhino_bg_body_repeat', 'option'),
		'bg_header_repeat' => get_field('rhino_bg_header_repeat', 'option'),
		'bg_footer_repeat' => get_field('rhino_bg_footer_repeat', 'option'),
		'bg_body_size' => get_field('rhino_bg_body_size', 'option'),
		'bg_header_size' => get_field('rhino_bg_header_size', 'option'),
		'bg_footer_size' => get_field('rhino_bg_footer_size', 'option'),

		// BUTTONS
		'button_primary_color' => get_field('rhino_button_primary_color', 'option'),
		'button_radius' => get_field('rhino_button_radius', 'option')
	);

	// Merge to preserve defaults
	foreach( $defaults as $dk => $dv ) {
		if( empty( $rhino[$dk] ) ) {
			$rhino[$dk] = $dv;
		}
	}

	// Empty images throw errors
	foreach( array( 'bg_body_img', 'bg_header_img', 'bg_footer_img' ) as $img ) {
		if( empty( $rhino[$img] ) ) {
			unset( $rhino[$img] );
		} else {
			// Quirk with leafo/phpscss library, image string URLs need to be quoted or they'll be discarded at the ":"
			$rhino[$img] = "'{$rhino[$img]}'";
		}
	}

	// Advanced color toggle, need to conditionally add this due to bug with leafo/phpsass compiler using @if comparisons
	if( get_field('rhino_advanced_color_controls', 'option') ) {
		$rhino['enable_advanced'] = 'on';
	}

	return array_merge( $vars, $rhino );

}
