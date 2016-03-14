<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Enforce navpaged when slideshow template is set to bottom
 */
add_filter( 'pre_update_option_rhino_slider_layout', 'rhino_layout_meteorslidefix', 10, 2 );

function rhino_layout_meteorslidefix( $new, $old ) {

	if( $new == 'thumbnails' ) {
		$ms = get_option('meteorslides_options');
		$ms['slideshow_navigation'] = 'navpaged';
		update_option( 'meteorslides_options', $ms );
	}

	return $new;

}

/**
 * Option Schemes - apply a defined set of option values to enforce a
 * predefined color or site layout scheme
 *
 * This currently reads files exported from PHPMyAdmin's PHP Export
 *
 * @since  	1.0.3
 * @author 	Rockhouse
 */

function rhino_apply_scheme( $name ) {
	if( file_exists( get_stylesheet_directory() . '/bundles/' . $name . '.php' ) ) {
		$woo_rhino_options = array();

		// Retrieve our options from the exported PHP bundle file
		$wp_options = array();
		include_once get_stylesheet_directory() . '/bundles/' . $name . '.php';

		// Create compatible array for Woo Import function
		foreach( $wp_options as $opt ) {
			// Fish out options for update_option
			$n = '';
			$v = '';
			foreach($opt as $ok => $ov) {
				if( $ok == 'option_name' )
					$n = $ov;
				if( $ok == 'option_value' )
					$v = $ov;
			}

			//if( !empty($n) and !empty($v) ) {
				$woo_rhino_options[$n] = $v;
			//}
		}

		// Now reset Woo Framework (stolen from: canvas/classes/class-wf-backup:83)
		$woo_options = get_option( 'woo_options' );
		$has_updated = false;

		// Cycle through data, import settings
		foreach ( (array)$woo_rhino_options as $key => $settings ) {
			$settings = maybe_unserialize( $settings ); // Unserialize serialized data before inserting it back into the database.

			// We can run checks using get_option(), as the options are all cached. See wp-includes/functions.php for more information.
			if ( get_option( $key ) != $settings ) {
				update_option( $key, $settings );
			}

			if ( is_array( $woo_options ) ) {
				if ( isset( $woo_options[$key] ) && $woo_options[$key] != $settings ) {
					$woo_options[$key] = $settings;
					$has_updated = true;
				}
			}
		}

		if ( $has_updated == true ) {
			update_option( 'woo_options', $woo_options );
		}
		// End thievery
	}
}

/**
 * When we first activate Rhino set our sane defaults
 */

add_action( 'woo_theme_activate', 'rhino_scheme_defaults', 5 );

function rhino_scheme_defaults() {
	rhino_apply_scheme( 'bundle-reset' );
}

/**
 * Add Schemer Functionality
 */
function rhino_scheme_runner() {

	if( !isset( $rhino_scheme ) or empty( $rhino_scheme ) ) {
		$rhino_scheme = 'bundle-none';
	}

	rhino_apply_scheme( $rhino_scheme );

}

/**
 * Add Schemer to sub-menu
 */
add_action('admin_menu', 'rhino_scheme_menu');

function rhino_scheme_menu() {

	add_submenu_page(
          'woothemes'
        , 'Schemes'
        , 'Schemes'
        , 'manage_options'
        , 'schemes'
        , 'rhino_scheme_callback'
    );

}

/**
 * Schemes Page
 */
function rhino_scheme_callback() {

	// Perm Check
	if( !current_user_can('manage_options') ) {

		$msg = <<<MSG
			<div class="wrap">
			<h2>Permission Denied</h2>
			<p>You do not have permission to change these settings. Please contact your site administrator.</p>
			</div>
MSG;

		wp_die($msg);
	}

	if( isset( $_POST['rhino_form_nonce'] ) ) {

		// Verify nonce
		if( !wp_verify_nonce( $_POST['rhino_form_nonce'] , 'rhino-nonce-schemer' ) ) {

	        die( 'Security check' );

		} else {

			// Update Options
			if( isset( $_POST['rhino_bundle'] ) ) {

				$rhino_bundle = $_POST['rhino_bundle'];

				update_option('rhino_bundle', $rhino_bundle);

				rhino_apply_scheme($rhino_bundle);

				echo '<div id="message" class="updated">Settings saved</div>';

			}

		}

	}

	// Create nonce
	$nonce = wp_create_nonce( 'rhino-nonce-schemer' );

    echo <<<HTML

    	<div class="wrap">
    		<form name="rhino_bundle_form" method="post" action="">
		        <h2>Schemes</h2>
				<p>Select a Scheme or Bundle.</p>
		        <table class="form-table">
		            <tr valign="top">
		            	<th scope="row">CSS Bundle</th>
		                <td>
		                    <select id="rhino_bundle" name="rhino_bundle">
HTML;

	rhino_scheme_options();

	echo <<<HTML
							</select>
		                </td>
		            </tr>
		        </table>
		        <p class="submit">
					<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
		        </p>
				<input type="hidden" name="rhino_form_nonce" id="rhino_form_nonce" value="{$nonce}" />
			</form>
		</div>

HTML;

} // End rhino_scheme_callback()

/**
 * List of all Schemes/Bundles in Array
 */
function rhino_scheme_list() {

	return array(	'bundle-none' 		=> 	'None',
					'bundle-brick' 		=> 	'Brick',
					'bundle-concrete'	=> 	'Concrete',
					'bundle-blacktop'	=> 	'Blacktop',
					'bundle-wire'		=> 'Wire'
				);

}

/**
 * List of all Schemes/Bundles as options
 */
function rhino_scheme_options() {

	$rhino_scheme_list = rhino_scheme_list();

	$rhino_scheme_selected = get_option('rhino_bundle');

	foreach ( $rhino_scheme_list as $k => $v ) {

		echo '<option';

		if(  $rhino_scheme_selected == $k ) {

			echo ' selected="selected"';
		}

		echo ' value="' . $k . '">' . $v . '</option>';

	}

}
