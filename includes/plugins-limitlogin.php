<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * This filter whitelists the RHP Static IP address.
 *
 * @since  	1.0.0
 * @package Rhino
 * @author 	Rockhouse
 */

add_filter('limit_login_whitelist_ip', 'rhino_ip_whitelist', 10, 2);

if ( !function_exists( 'rhino_ip_whitelist' ) ) {

	function rhino_ip_whitelist($allow, $ip) {

		return ($ip == '50.241.200.194') ? true : $allow;

	} // End rhino_ip_whitelist()

} // End if

