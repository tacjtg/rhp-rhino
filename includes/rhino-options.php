<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Add Rhino Options
 *
 * Introduce an ACF Options Panel based control system for this theme
 *
 * @since  	1.3.0
 * @author 	Rockhouse
 */

// Load ACF Options Panel
require_once( get_stylesheet_directory() . '/includes/acf/acf-rhino-options.php' );

/**
 * Add our Task Runner options via code instead of from ACF fields interface
 */
add_filter( 'acf/load_field/name=rhino_taskrunner', 'rhino_taskrunner_opts', 10, 1 );
function rhino_taskrunner_opts( $field ) {
	$field['choices'] =
		array (
			'fix-licenses' => 'Fix Licences',
			'onethree-upgrade' => 'Upgrade Rhino 1.3 Options',
			'fix-tribe-mayhem' => 'Fix Tribe Subpage Meta',
		);
	return $field;
}

// Deal with legacy variables either for non-sass sites or sass sites with backfill
if( function_exists( 'get_field' ) and get_field('rhino_enable_sassify', 'option') ) {
	// Generic means to ensure core Woo options are filled in when we set in ACF
	add_action( 'acf/update_value/name=rhino_header_logo', 'rhino_backfill_wooopts', 20, 3 );
	add_action( 'acf/update_value/name=rhino_favicon', 'rhino_backfill_wooopts', 20, 3 );
	add_action( 'acf/update_value/name=rhino_layout_width', 'rhino_backfill_wooopts', 20, 3 );
	add_action( 'acf/update_value/name=rhino_bg_body_img', 'rhino_backfill_wooopts', 20, 3 );
	add_action( 'acf/update_value/name=rhino_bg_body_repeat', 'rhino_backfill_wooopts', 20, 3 );
	add_action( 'acf/update_value/name=rhino_bg_header_img', 'rhino_backfill_wooopts', 20, 3 );
	add_action( 'acf/update_value/name=rhino_bg_header_repeat', 'rhino_backfill_wooopts', 20, 3 );
	add_action( 'acf/update_value/name=rhino_link_color', 'rhino_backfill_wooopts', 20, 3 );
	add_action( 'acf/update_value/name=rhino_button_primary_color', 'rhino_backfill_wooopts', 20, 3 );
} elseif( !is_admin() ) {
	// When sass disabled, return the old Woo value if we have it
	$map = rhino_onethree_optmap();
	foreach( $map as $woo_field => $acf_field ) {
		add_action( 'acf/load_value/name='.$acf_field, 'rhino_woo_fallback', 20, 3 );
	}
}

function rhino_woo_fallback( $value, $post_id, $field ) {
	$map = rhino_onethree_optmap();
	$kmap = array_keys( $map );
	$vmap = array_values( $map );
	$key = array_search( $field['name'], $vmap );

	$woo = get_option( $kmap[$key], 'no-default' );
	if( $value === false and $woo !== 'no-default' ) {
		if( $woo == 'true' ) {
			$value = true;
		} elseif( $woo == 'false' ) {
			$value = false;
		} else {
			$value = $woo;
		}

	}

	return $value;
}

function rhino_backfill_wooopts( $value, $post_id, $field ) {
	if( $post_id == 'options' ) {
		// Do a quick reverse index lookup of the woo option name
		$map = rhino_onethree_optmap();
		$kmap = array_keys( $map );
		$vmap = array_values( $map );
		$key = array_search( $field['name'], $vmap );

		if( $key !== false ) {

			$woo_value = '';

			switch( $field['name'] ) {

				case 'rhino_header_logo':
				case 'rhino_favicon':
				case 'rhino_bg_body_img':
				case 'rhino_bg_header_img':
				case 'rhino_bg_footer_img':
					$woo_value = wp_get_attachment_url( $value );
					break;

				case 'rhino_layout_width':
					$woo_width = explode( 'px', $value );
					$woo_value = $woo_width[0];
					break;

				case 'rhino_link_color':
				case 'rhino_button_primary_color':
				default:
					$woo_value = $value;
			}

			update_option( $kmap[$key], $woo_value );

			global $woo_options;
			$woo_options[$kmap[$key]] = $woo_value;
			update_option( 'woo_options', $woo_options );
		}
	}
	return $value; // Yeah, it's an action, but it fails like a filter if this isn't returned
}


/**
 * Handle Taskrunner actions on the ACF Options Page for the Zookeeper
 */
add_action( 'load-rhino_page_acf-options-zookeeper', 'rhino_taskrunner' );

function rhino_taskrunner() {
	if( current_user_can( 'manage_options' ) and isset( $_POST['fields'] ) and count( $_POST['fields'] ) ){
		global $rhino_notices;
		$rhino_notices = array();

		$action = array_pop( $_POST['fields'] );

		switch( $action ) {
			case 'fix-licenses':
				rhino_fix_licenses();
				$rhino_notices[] = 'Cleared and reset licences, then re-ran theme activation for good measure.';
				break;

			case 'onethree-upgrade':
				rhino_onethree_upgrade();
				$rhino_notices[] = 'Import of legacy Rhino options complete.';
				break;

			case 'fix-tribe-mayhem':
				$n = rhino_fix_tribemayhem();
				$rhino_notices[] = $n ? 'Saved '.$n.' posts from the subpage reaper' : 'No invalid subpage meta found, this site is clean!';
				break;
		}

		add_action( 'admin_notices', 'rhino_taskrunner_notices' );
	}
}

/**
 * Add notices to the Taskrunner page
 */
function rhino_taskrunner_notices() {
	// Kill the save options notices
	$GLOBALS['acf_options_page']->data['admin_message'] = null;

	global $rhino_notices;
	foreach( $rhino_notices as $class => $msg ) {
		echo "<div class=\"updated\"><p>{$msg}</p></div>";
	}
}

/**
 * Run our license cleanup / activation routines
 */
function rhino_fix_licenses() {
	// see includes/licenses.php
	rhino_license_cleanup();
	rhino_license_keys();
	rhino_woo_activation();
}

/**
 * Addresses a RHP AddOn bug prior to .13 where subpages
 * have _Event* metadata and get deleted by the Pro plugin
 */
function rhino_fix_tribemayhem() {
	global $wpdb;
	$sqlc = "SELECT COUNT(*) FROM {$wpdb->postmeta} INNER JOIN {$wpdb->posts} ON {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id WHERE meta_key like '_Event%' AND {$wpdb->posts}.post_type <> 'tribe_events'";
	$count = $wpdb->get_var( $sqlc );

	if( $count ) {
		$sqld = "DELETE FROM {$wpdb->postmeta} WHERE EXISTS (SELECT * FROM {$wpdb->posts} WHERE {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id AND {$wpdb->posts}.post_type <> 'tribe_events') AND {$wpdb->postmeta}.meta_key like '_Event%'";
		$wipe = $wpdb->get_var( $sqld );
	}

	return $count;
}

/**
 * Temporary upgrade routine for converting Woo to ACF
 */
function rhino_onethree_upgrade() {

	global $wpdb;
	global $woo_options;
	$map = rhino_onethree_optmap();

	// Prevent drama with filters
	remove_action( 'acf/update_value/name=rhino_header_logo', 'rhino_backfill_wooopts', 20 );
	remove_action( 'acf/update_value/name=rhino_favicon', 'rhino_backfill_wooopts', 20 );
	remove_action( 'acf/update_value/name=rhino_layout_width', 'rhino_backfill_wooopts', 20 );
	remove_action( 'acf/update_value/name=rhino_link_color', 'rhino_backfill_wooopts', 20 );
	remove_action( 'acf/update_value/name=rhino_button_primary_color', 'rhino_backfill_wooopts', 20 );
	remove_action( 'acf/update_value/name=rhino_bg_body_img', 'rhino_backfill_wooopts', 20 );
	remove_action( 'acf/update_value/name=rhino_bg_body_repeat', 'rhino_backfill_wooopts', 20 );
	remove_action( 'acf/update_value/name=rhino_bg_header_img', 'rhino_backfill_wooopts', 20 );
	remove_action( 'acf/update_value/name=rhino_bg_header_repeat', 'rhino_backfill_wooopts', 20 );

	/**
	 * The ACF update_field() function is a flaming dumpster fire next to a gas tanker and
	 * should not be invoked if you expect a FIELD to be UPDATED with a VALUE for ACF Options.
	 * Rather, you can totally do this and spend 3 days troubleshooting the rickety custom actions
	 * of the ACF Options Panel and ACF plugin to find that it doesn't even remotely operate the
	 * same was as the AJAX frontend for ACF does.  This is not recommended.
	 *
	 * Instead we manually inject the marker fields and data fields in the options table.
	 * with two separate WP update_option() calls, which works perfectly fine as of ACF 4.4.3
	 */

	// Build a list of ACF field to field_key lookup for the forthcoming dumpster fire
	$acf_keys = array();
	if( isset( $GLOBALS['acf_register_field_group'] ) and is_array( $GLOBALS['acf_register_field_group'] ) ) {
		foreach( $GLOBALS['acf_register_field_group'] as $acf_group ) {
			if( $acf_group['id'] == 'acf_theme-options' ) {
				foreach( $acf_group['fields'] as $acf_field ) {
					$acf_keys[ $acf_field['name'] ] = $acf_field['key'];
				}
			}
		}
	}

	// Map the Woo to ACF variables and inject as needed
	foreach( $map as $woo => $acf ) {

		$acf_opt = get_field( $acf, 'option' );
		$woo_opt = get_option( $woo, '' );

		switch( $woo ) {

			// Fonts just need the array tweaked slightly
			case 'rhino_body_font':
			case 'rhino_header_font':
			case 'rhino_button_font':

				if( is_array( $woo_opt ) ) {
					$font = array(
								'font' => $woo_opt['face'],
								'variants' => array( 'regular' ),
								'subsets' => array( 'latin' )
							);

					//update_field( $acf_keys[$acf], $font, 'option' );
					update_option( 'options_'.$acf, $font );
					update_option( '_options_'.$acf, $acf_keys[ $acf ] );
				}
				break;

			case 'rhino_homepage_tabbed':
			case 'rhino_nav_sticky':
				if( $woo == 'true' ) {
					update_option( 'options_'.$acf, true );
					update_option( '_options_'.$acf, $acf_keys[ $acf ] );
				}
				break;

			case 'rhino_button_rounded_corners':
				$round = (int) $woo_opt;

				// Update ACF
				update_option( 'options_'.$acf, $round.'px' );
				update_option( '_options_'.$acf, $acf_keys[ $acf ] );
				break;

			// Width should be fixed to 1 of 3 values and include the "px" suffix
			case 'woo_layout_width':

				// Determine which of the new 3 we use
				$width = (int) $woo_opt;
				$scss_width = 980;
				if( $width > 1060 ) {
					$scss_width = 1140;
				}
				if( $width > 1190 ) {
					$scss_width = 1280;
				}

				//update_field( $acf_keys[$acf], $scss_width.'px', 'option' );
				update_option( 'options_'.$acf, $scss_width.'px' );
				update_option( '_options_'.$acf, $acf_keys[ $acf ] );

				// Update Woo as well
				update_option( $woo, $scss_width );
				$woo_options[$woo] = $scss_width;
				break;

			// Images need to be converted from a URL string to an WP Attachment ID
			case 'woo_logo':
			case 'rhino_footer_logo':
			case 'woo_custom_favicon':
			case 'woo_style_bg_image':
			case 'woo_header_bg_image':
			case 'rhino_default_event_image':

				if( empty( $acf_opt ) and !empty( $woo_opt ) ) {
					// Query the attachment_id of (Woo stores URLs, ACF stores attachment_id)
					$woo_uri = '%' . implode( '/', array_slice( explode( '/', $woo_opt ), 3 ) );
					$media_id = $wpdb->get_var(
						$wpdb->prepare( " SELECT ID FROM $wpdb->posts WHERE guid LIKE %s ", $woo_uri )
					);

					// Replace $woo_opt for updating below in default case
					if( !empty( $media_id ) ) {
						$woo_opt = $media_id;
					} else {
						$woo_uri = '%' . implode( '/', array_slice( explode( '/', $woo_opt ), 5 ) );
						$media_id = $wpdb->get_var(
							$wpdb->prepare( " SELECT post_id FROM $wpdb->postmeta WHERE meta_value LIKE %s ", $woo_uri )
						);
						if( !empty( $media_id ) ) {
							$woo_opt = $media_id;
							global $rhino_notices;
							$rhino_notices[] = "The <strong>{$acf}</strong> image has been resized, please check this in the Site Styles panel";
						} else {
							global $rhino_notices;
							$rhino_notices[] = "Unable to location the DB entry for <strong>{$acf}</strong>, you'll have to find a replacement image";
							$woo_opt = false; // Lookup failed, skip
						}
					}
				}
				// No breaks!  Pass on through to the normal variable update

			// Regular string type variables (ACF empty == false, Woo empty == '')
			default:

				if( empty( $acf_opt ) and !empty( $woo_opt ) ) {
					// Copy the existing option to the new option
					//$upd = update_field( $acf, $woo_opt, 'option' );
					update_option( 'options_'.$acf, $woo_opt );
					update_option( '_options_'.$acf, $acf_keys[ $acf ] );
				}

		}

	}

	// Let's just be sure on this one
	$woo_options['woo_header_full_width'] = 'true';
	update_option( 'woo_header_full_width', 'true' );

	update_option( 'woo_options', $woo_options );

	// One last thing, force Tribe to use Full styles
	$tribe_ecp = Tribe__Events__Main::instance();
	$tribe_ecp->setOption( 'stylesheetOption', 'full' );

}

/**
 * The canonical mapping for 1.3 conversions from Woo Framework to ACF
 */
function rhino_onethree_optmap() {
	return array(
		// woo_option => acf_field
		'rhino_contact_address'			=> 'rhino_contact_address',
		'rhino_contact_address_link'	=> 'rhino_contact_address_link',
		'rhino_contact_email'			=> 'rhino_contact_email',
		'rhino_contact_facebook'		=> 'rhino_contact_facebook',
		'rhino_contact_flickr'			=> 'rhino_contact_flickr',
		'rhino_contact_googleplus'		=> 'rhino_contact_googleplus',
		'rhino_contact_instagram'		=> 'rhino_contact_instagram',
		'rhino_contact_phone'			=> 'rhino_contact_phone',
		'rhino_contact_pinterest'		=> 'rhino_contact_pinterest',
		'rhino_contact_spotify'			=> 'rhino_contact_spotify',
		'rhino_contact_tumblr'			=> 'rhino_contact_tumblr',
		'rhino_contact_twitter'			=> 'rhino_contact_twitter',
		'rhino_contact_youtube'			=> 'rhino_contact_youtube',
		'woo_layout_width'				=> 'rhino_layout_width',
		'woo_logo'						=> 'rhino_header_logo',
		'rhino_footer_logo'				=> 'rhino_footer_logo',
		'woo_custom_favicon'			=> 'rhino_favicon',
		'rhino_nav_location'			=> 'rhino_navigation_position',
		'rhino_nav_sticky'				=> 'rhino_sticky_navigation',
		'rhino_slider_layout'			=> 'rhino_slider_layout',
		'rhino_body_font' 				=> 'rhino_body_font_family',
		'rhino_header_font' 			=> 'rhino_header_font_family',
		'rhino_button_font' 			=> 'rhino_cta_font_family',
		'woo_link_color'				=> 'rhino_link_color',
		'rhino_cta_primary_button_background_color' => 'rhino_button_primary_color',
		'woo_style_bg_image'			=> 'rhino_bg_body_img',
		'woo_style_bg_image_repeat'		=> 'rhino_bg_body_repeat',
		'woo_header_bg_image'			=> 'rhino_bg_header_img',
		'woo_header_bg_image_repeat'	=> 'rhino_bg_header_repeat',
		'rhino_default_event_image'		=> 'rhino_event_image',
		'rhino_events_addthis_pubid' 	=> 'rhino_addthis_publisher_id',
		'rhino_events_listing_title'	=> 'yoast_seo_events_title',
		'rhino_custom_404_text'			=> 'rhino_404_content',
		'rhino_homepage_tabbed'			=> 'tabbed_widgets_on_homepage',
		'rhino_button_rounded_corners'	=> 'rhino_button_radius'
	);
}



