<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Tribe Events modifications
 *
 * @since  	1.1.0
 * @package Rhino
 * @author 	Rockhouse
 */

add_filter( 'tribe_event_featured_image', 'rhino_event_image_default', 75, 3 );

	/**
	 * Look for empty Featued Event Images (via tribe_event_featured_image()
	 * and slip in our default if it is empty
	 */
if( !function_exists('rhino_event_image_default') ):

	function rhino_event_image_default( $featured_image, $post_id, $size ) {
		if( empty( $featured_image ) ) {
			$default = get_field( 'rhino_event_image', 'options' );
			if( !empty( $default ) ) {
				$featured_image = '<div class="tribe-events-event-image rhp-event-image-default"><img src="' . esc_url( $default ) . '" title="' . get_the_title( $post_id ) . '" /></div>';
			}
		}
		return $featured_image;
	}

endif;


add_filter( 'tribe_events_template_data_array', 'rhino_template_json_extras', 50, 3 );

if( !function_exists('rhino_template_json_extras') ):
	/**
	 * Add some extra data we need to the JSON representation of Events
	 * so we can enhance the Calendar view tooltips
	 *
	 * @filter tribe_events_template_data_array
	 * @param $json array The (soon to be) json payload
	 * @param $event WP_Post The Event post
	 * @param $addtional array Extra stuff added from other sources
	 */
	function rhino_template_json_extras( $json, $event, $additional ) {

		if( is_object( $event ) ) {

			if( rhp_event_status( $event->ID ) == 'past' ) {

				// Tribe 3.11 templating language complains if any variables are not defined
				$json['rhpCtaLabel'] = 'Past Event';
				$json['rhpCtaHref'] = '';
				$json['rhpCtaClass'] = 'rhp-event-cta off-sale';

			} else {

				$cta = RockhouseEvents::getEventCtaContent( 'event', $event->ID );

				if( !empty( $cta['label'] ) ) {
					$json['rhpCtaLabel'] = $cta['label'];
					$json['rhpCtaHref'] = empty( $cta['href'] ) ? get_permalink( $event->ID ) : $cta['href'];
					$json['rhpCtaClass'] = implode(' ',$cta['classes']);
				}
			}

		}

		return $json;
	}

endif;

