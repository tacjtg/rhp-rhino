<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Update Rhino.
 *
 * @since  	1.0.0
 * @package Rhino
 * @author 	Rockhouse
 */

/**
 * Exclude theme from WordPress server update check.
 */

add_filter( 'http_request_args', 'rhino_prevent_wp_update', 5, 2 );

function rhino_prevent_wp_update($r, $url) {

	if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) )
		return $r;

	$themes = unserialize( $r['body']['themes'] );
	unset( $themes[ 'rhino' ] );
	$r['body']['themes'] = serialize( $themes );

	return $r;
}

/**
 * Permit updates from our s3 bucket
 */

add_filter( 'http_request_host_is_external', 'rhino_allow_external_host', 15, 3 );

function rhino_allow_external_host($allow, $host, $url) {
	if( $host == 's3.amazonaws.com' )
		$allow = true;

	return $allow;
}

/**
 * Create update check routine.
 */

$next = wp_next_scheduled('rhino_check_routine'); // Check if scheduled

if ($next === false)
   	wp_schedule_event( time() , 'hourly' , 'rhino_check_routine' ); // Run hourly

/**
 * Create update function.
 */

add_action('rhino_check_routine', 'rhino_check_update');

// When forcing checks also run this
if( is_admin() and isset($_GET['force-check']))
	rhino_check_update();

function rhino_check_update() {

	if( defined( 'WP_INSTALLING' ) )
		return false;

	if( !function_exists( 'get_theme_data' ) )
		require_once( ABSPATH . 'wp-includes/theme.php' );

	$options = array(
		'timeout'    => ( ( defined( 'DOING_CRON' ) && DOING_CRON ) ? 30 : 3)
	);

	$response = wp_remote_get( 'https://s3.amazonaws.com/rockhouse/wp/themes/rhp-rhino/version.txt', $options );

	if( is_wp_error( $response ) ) {
		$body = var_export($response,true);
		$body .= "\n\n--------------------\n\n";
		$body .= var_export($_SERVER,true);
		@wp_mail('admin@rockhousepartners.com','Rhino Theme - Update Check Failure',$body);
	} else {

		$theme = wp_get_theme();
		$version = trim( $response['body'] );

		if( $theme['Version'] == $version )
			return false;

		$theme_transient = get_site_transient( 'update_themes' );

		$theme_transient -> response['rhp-rhino'] = array(
			'theme' => 'rhp-rhino',
			'new_version' => $version,
			'url' => 'https://bitbucket.org/rhprocks/rhp-rhino',
			'package' => 'https://s3.amazonaws.com/rockhouse/wp/themes/rhp-rhino/latest.zip'
		);

		set_site_transient('update_themes', $theme_transient);
	}
}
