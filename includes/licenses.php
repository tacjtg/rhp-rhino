<?php
/**
 * Licence Key Management and Hackery
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Load Rhino Licenses.
 *
 * @since  	1.0.3
 * @package Rhino
 * @author 	Rockhouse
 */

add_action( 'woo_theme_activate', 'rhino_license_keys', 100 );
add_filter( 'upgrader_post_install', 'rhino_license_theme_upgrade', 10, 2);


/**
 * Constants for ACF: Google Font Selector
 */
define( 'ACFGFS_API_KEY', 'AIzaSyBI2aoTZdqN6GAV2i8onMisU0wwiTr0laE');

/**
 * On a theme upgrade of Rhino re-run our license checks/fixes
 *
 * @action upgrader_post_install
 */
function rhino_license_theme_upgrade( $return, $theme ) {

	if( $theme == get_stylesheet() ) {
		rhino_license_keys();
	}

	return $return;
}

if ( !function_exists( 'rhino_license_keys' ) ) {

	/**
	 * Create or overwrite license options stored in the DB
	 */
	function rhino_license_keys() {

		// We can get away with hard coding WooThemes usually
		if( ! is_multisite() ) {

			$woothings = get_option( 'woothemes-updater-activated', array() );

			if( empty( $woothings ) or ! isset( $woothings['canvas/style.css'] ) ) {

				$woothings['canvas/style.css'] = array(
					'18775',
					'c0d59112207790293359d93fb11511ad',
					md5( 'W00-651eab14-47cc-9594-f83de6ac837e' ),
					'2016-07-18 00:00:00'
				);

				update_option( 'woothemes-updater-activated', $woothings );
			}
		}


		// Tribe Events Calendar Pro, Expires July 15, 2015
		if( is_multisite() ) {
			update_site_option( 'pue_install_key_events_calendar_pro', '51730c05caf3a51b0d36cb8ffd1caf649ca6c883' );
		} else {
			update_option( 'pue_install_key_events_calendar_pro', '51730c05caf3a51b0d36cb8ffd1caf649ca6c883' );
		}

		// Google Apps Login Enterprise
		$galogin_premium =
array (
  'ga_clientid' => '1058977577602-mroda6d5g8e1k49f5telpkatiaakhou4.apps.googleusercontent.com',
  'ga_clientsecret' => 'DUg223NPhzG641z_qMtUXPhu',
  'ga_ms_usesubsitecallback' => false,
  'ga_force_permissions' => false,
  'ga_auto_login' => false,
  'ga_poweredby' => false,
  'ga_domainadmin' => 'dale@rockhousepartners.com',
  'ga_version' => '2.8.5',
  'ga_domainname' => 'rockhousepartners.com',
  'ga_autocreate' => true,
  'ga_disablewplogin' => false,
  'ga_hidewplogin' => false,
  'ga_defaultrole' => 'editor',
  'ga_googlelogout' => false,
  'ga_loginbuttontext' => '',
  'ga_license_key' => '6efb65ede0ace598e38582ee67111014',
  'ga_grouproles' =>
  array (
    'hq@rockhousepartners.com' => 'administrator',
  ),
  'ga_groupsonlogin' => false,
  'ga_addsubsites' => false,
  'ga_demotesupers' => false,
);

		$ga_serviceacct =
array (
  'ga_sakey' => '-----BEGIN PRIVATE KEY-----
MIICeAIBADANBgkqhkiG9w0BAQEFAASCAmIwggJeAgEAAoGBAKi2NyluPyStBkmE
D+i0n0zCMTz07ooDLmBG0cnjpM0L0gB/SomGL24oScEaQEW95pZntvC7AGEbMW8a
4W3ZYWGTHPMA4w0fTQf3PIAX8deu9AgEHGvzCTYawpEX/W+TDpNwyXhW940zBP3x
CbR50NTD3eAr27F6wdM3KkitSrNrAgMBAAECgYEAhjYGZdANLTjzonILUdy2SRLG
pq5WQLZNI0vTQh71ECUSF1Er04FKpAAqxBIFBTYPhKDXGGQ65gUC61bf9EoUu4br
/0elDbLkf8yfyV1ysZkpubwPwluLxlgW04kTIHx0bT6BUxtE1cxOsJ18RLyunBOo
CPGSNNl9vYm+4KztqeECQQDQX++G2QWIsLuKliZ3RCD2b9ixrnawxSxDwALwI+6K
ZzHqsmXB1OBx/yZ8G4VUtv18Jg9nUaX+NN8uDSjPzjjRAkEAz0WWpp5QonfPt1fF
KabjXv/cn4783kz3SM+ZBdAZFs+Mhhykjw6HBHV5Mn1D4GdbSIDNWN/nof5uSmO/
Zxi3ewJAQWVabx+9NOECesQU3mlrTuxbPahbZ6757WldgrBENPueFuJWPTbqGdzR
3zFj7upfM49eVjaxuc4uHO3UWSOHgQJBALupzOnUwzsmcVoVzLyWjpyv2khZBRgc
5XP2Ch1aOa0Og7PVcSTZSWO/HNma0v71dY+ilsnWB/oCzEbsIxssJMsCQQDP0HfE
m40Epb138u7svpqPTsTBy6eiDdWExj9tvd1jOctmfhwu/wrZ4gfRKlT08DUwRx+h
DsBIm0/KKk5+u5ol
-----END PRIVATE KEY-----
',
  'ga_serviceemail' => '1058977577602-3euk0cikplbrpm075nobmbth642f99k3@developer.gserviceaccount.com',
  'ga_pkey_print' => '254079eabe4ea90976b5b4b41c051e5e0ac93ed4',
);

		$eddsl_gal_enterprise_ls =
array (
  'license_id' => '6efb65ede0ace598e38582ee67111014',
  'status' => 'valid',
  'expires' => '2016-03-25 21:48:26',
  'expires_time' => 1458942506,
  'expires_day' => '25 Mar 2016',
  'renewal_link' => 'https://wp-glogin.com/checkout/?edd_license_key=6efb65ede0ace598e38582ee67111014&download_id=926',
  'first_check_time' => 1427320801,
  'last_check_time' => 1427320801,
  'result_cleared' => false,
);

		if( is_multisite() ) {
			switch_to_blog(1);
		}

		update_site_option( 'galogin_premium', $galogin_premium );
		update_site_option( 'ga_serviceacct', $ga_serviceacct );
		update_site_option( 'eddsl_gal_enterprise_ls', $eddsl_gal_enterprise_ls );

		if( is_multisite() ) {
			restore_current_blog();
		}
	}

}

/**
 * When we switch to another theme make sure we get rid of our
 * licenses for the bundled products
 *
 * @since 1.0.3
 * @package Rhino
 * @author dliszka
 *
 */
add_action( 'switch_theme', 'rhino_license_cleanup', 100 );

if ( !function_exists( 'rhino_license_cleanup' ) ) {

	function rhino_license_cleanup() {
		delete_site_option( 'woothemes-updater-activated' );
		delete_site_option( 'woothemes-updater-version' );

		delete_site_option( 'galogin_premium' );
		delete_site_option( 'ga_serviceacct' );
		delete_site_option( 'eddsl_gal_enterprise_ls' );
	}

}

/**
 * We can exploit the WooThemes Updater plugin to fake an activation
 * with a few key inputs.  This is called on the Force option since
 * this function dynamically pulls the product lists and sets
 * the keys.  The rhino_license_keys() function just plugs static data.
 *
 * @since 1.0.4
 * @package Rhino
 * @author dliszka
 *
 */

if ( !function_exists( 'rhino_woo_activation' ) ) {
	function rhino_woo_activation() {

		if( ! is_multisite() and  class_exists('WooThemes_Updater') ) {

			$woothings = get_option( 'woothemes-updater-activated', array() );

			if( empty( $woothings ) or ! isset( $woothings['canvas/style.css'] ) ) {
				global $woothemes_updater;
				$products = $woothemes_updater->get_products();

				// Culled from the woo-updater/classes/class-woothemes-updater-admin.php::activate_products
				$woothings['canvas/style.css'] = array(
					$products['canvas/style.css']['product_id'],  // something like '18775'
					$products['canvas/style.css']['file_id'],  // something like 'c0d59112207790293359d93fb11511ad'
					md5( 'W00-651eab14-47cc-9594-f83de6ac837e' ),
					'2016-07-18 00:00:00'
				);

				update_option( 'woothemes-updater-activated', $woothings );

				/**
					Here is how to fake an API activation call

					$wooapi = new WooThemes_Updater_API();
					var_dump(
						$wooapi->activate(
							'18775',
							'W00-651eab14-47cc-9594-f83de6ac837e',
							'canvas/style.css'
						)
					);
				*/
			}
		}
	}
}

