<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Load modified Meteor Slideshow script for Thumbnail view
 *
 * @since  	1.0.3
 * @package Rhino
 * @author 	Rockhouse
 */

add_action( 'wp_print_scripts' , 'rhino_meteor_thumbs', 15 );
if ( !function_exists( 'rhino_meteor_thumbs' ) ) {
	function rhino_meteor_thumbs() {
		if( !is_admin() and get_field('rhino_slider_layout', 'option') == 'thumbnails' ) {
			// We have to load a custom JS file that reads localized vars and overrides the pageAnchorBuilder function
			//  ... why isn't there a way to do that via jQuery opts?  Isn't that what localize_script is for?  Go figure...
			wp_dequeue_script( 'meteorslides-script' );
			wp_register_script( 'rhino-meteor-thumbnails-js' , get_stylesheet_directory_uri() . '/layouts/meteorslides/meteor-slideshow-thumbnails.js', null, RHP_RHINO_VER );
			wp_enqueue_script( 'rhino-meteor-thumbnails-js' );

			$meteor_options = get_option( 'meteorslides_options' );
			$opts = array(
					'meteorslideshowspeed'      => $meteor_options['transition_speed'] * 1000,
					'meteorslideshowduration'   => $meteor_options['slide_duration'] * 1000,
					'meteorslideshowheight'     => $meteor_options['slide_height'],
					'meteorslideshowwidth'      => $meteor_options['slide_width'],
					'meteorslideshowtransition' => $meteor_options['transition_style']
				);
			wp_localize_script( 'rhino-meteor-thumbnails-js', 'meteorslidessettings', $opts );
		}
	}
}

// Add the "homepage" slideshow if it doesn't exist
add_action( 'admin_init', 'rhino_meteor_homepage_term' );
function rhino_meteor_homepage_term() {
	$sldterm = term_exists('homepage','slideshow') ;
	if( !is_array( $sldterm ) ) {
		$ins =	wp_insert_term( 'Homepage', 'slideshow', array('description' => 'Slides that will appear on the Home Page', 'slug' => 'homepage') );
	}
}

/**
 * Meteor Slides title clean up in list view so
 * it doesn't say "(no title)" when linked.
 *
 * @since   1.0.0
 * @package Rhino
 * @author  Rockhouse
 */

add_action('admin_head-edit.php','rhino_meteor_title_swap');

if ( !function_exists( 'rhino_meteor_title_swap' ) ) {
	function rhino_meteor_title_swap() {
		add_filter('the_title','rhino_admin_slides_title',90,2);
	} // End rhino_meteor_title_swap()
} // End if()

if ( !function_exists( 'rhino_admin_slides_title' ) ) {
	function rhino_admin_slides_title( $column, $post_id ) {
		if( get_post_type( $post_id ) == 'slide' and empty($column) ) {
			$event = get_field('rhino_slide_linked_event',$post_id);
			if( $event )
				$column = 'Event: '.$event->post_title;
		}
		return $column;
	} // End rhino_admin_slides_title()
} // End if()


/**
 * Create a 'Status' column for Meteor Slides
 */

add_filter('manage_edit-slide_columns','rhino_meteor_slides_display_status_column' );

if ( !function_exists( 'rhino_meteor_slides_display_status_column' ) ) {
	function rhino_meteor_slides_display_status_column($columns) {
		$columns['status'] = 'Status';
		return $columns;
	} // End rhino_meteor_slides_display_status()
} // End if()


/**
 * Report Slides as 'Displayed' or 'Not Displayed'
 */

add_action('manage_slide_posts_custom_column',  'rhino_meteor_slides_display_status', 10, 2);

if ( !function_exists( 'rhino_meteor_slides_display_status' ) ) {
	function rhino_meteor_slides_display_status( $column, $post_id) {
		$post = get_post( $post_id );
		$rhino_event = get_field('rhino_slide_linked_event');
		$event_status = $rhino_event ? rhp_event_status($rhino_event->ID) : 'none';

		switch ( $column ) {
	        case 'status' :
				if( ($event_status == 'past') ) {
					echo 'Not Displayed (Event in past)';
				} elseif( $post->post_status !== 'publish' ) {
					echo 'Not Displayed ('.$post->post_status.')';
				} else {
					echo 'Displayed';
				}
			break;
		} // End switch()
    } // End rhino_meteor_slides_display_status()
} // End if()
