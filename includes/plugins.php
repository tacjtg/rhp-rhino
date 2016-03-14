<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register the required plugins for this theme.
 *
 * @since  	1.0.0
 * @package Rhino
 * @author 	Rockhouse
 */

add_action( 'tgmpa_register', 'rhino_register_required_plugins' );

function rhino_register_required_plugins() {
	$plugins = array(
		array(
			'name'					=>	'Meteor Slides',
			'slug'					=>	'meteor-slides',
			'required'				=>	true,
			'force_activation'		=>	true,
			'force_deactivation'	=>	true
		),
		array(
			'name'					=>	'Advanced Custom Fields',
			'slug'					=>	'advanced-custom-fields',
			'required'				=>	true,
			'force_activation'		=>	true,
			'force_deactivation'	=>	true
		),
		array(
			'name'					=>	'Advanced Custom Fields: Options Page',
			'slug'					=>	'acf-options-page',
			'required'				=>	true,
			'force_activation'		=>	true,
			'force_deactivation'	=>	true,
			'source'				=>	'https://s3.amazonaws.com/rockhouse/wp/plugins/acf-options-page/latest.zip',
			'external_url'			=>	'http://www.advancedcustomfields.com/add-ons/options-page/'
		),
		array(
			'name'					=>	'Advanced Custom Fields: Date and Time Picker',
			'slug'					=>	'acf-field-date-time-picker',
			'required'				=>	true,
			'force_activation'		=>	true,
			'force_deactivation'	=>	true
		),
		array(
			'name'					=>	'Advanced Custom Fields: Repeater Field',
			'slug'					=>	'acf-field-date-time-picker',
			'required'				=>	false,
			'force_activation'		=>	false,
			'force_deactivation'	=>	false,
			'source'				=>	'https://s3.amazonaws.com/rockhouse/wp/plugins/acf-repeater/latest.zip',
			'external_url'			=>	'http://www.advancedcustomfields.com/add-ons/repeater-field/'
		),
		array(
			'name'					=>	'ACF: Google Font Selector',
			'slug'					=>	'acf-google-font-selector-field',
			'required'				=>	true,
			'force_activation'		=>	true,
			'force_deactivation'	=>	true
		),
		array(
			'name'					=>	'The Events Calendar',
			'slug'					=>	'the-events-calendar',
			'required'				=>	true,
			'force_activation'		=>	true,
			'force_deactivation'	=>	true
		),
		array(
			'name'					=>	'RHP Google Tag Manager',
			'slug'					=>	'wp-rhp-tagmanager',
			'required'				=>	true,
			'force_activation'		=>	true,
			'force_deactivation'	=>	true,
			'source'				=>	'https://s3.amazonaws.com/rockhouse/wp/plugins/wp-rhp-tagmanager/latest.zip',
			'external_url'			=>	'https://bitbucket.org/rhprocks/wp-rhp-tagmanager'
		),
		array(
			'name'					=>	'WooThemes Helper',
			'slug'					=>	'woothemes-updater',
			'required'				=>	true,
			'force_activation'		=>	true,
			'force_deactivation'	=>	true,
			'source'				=>	'http://woodojo.s3.amazonaws.com/downloads/woothemes-updater/woothemes-updater.zip',
			'external_url'			=>	'http://docs.woothemes.com/document/woothemes-helper/'
		),
		array(
			'name'					=>	'Google Apps Login Enterprise',
			'slug'					=>	'googleappslogin-enterprise',
			'required'				=>	true,
			'force_activation'		=>	true,
			'force_deactivation'	=>	true,
			'source'				=>	'https://s3.amazonaws.com/rockhouse/wp/plugins/googleappslogin-enterprise/latest.zip',
			'external_url'			=>	'https://wp-glogin.com/downloads/google-apps-login-for-wordpress-enterprise-unlimited-sites/'
		),
		array(
			'name'					=>	'WordPress SEO',
			'slug'					=>	'wordpress-seo',
			'required'				=>	true
		)
	);

	// Activate RHP AddOn after Tribe is active
	if( class_exists('Tribe__Events__Main') ) {
		$plugins[] = array(
							'name'					=>	'Rockhouse Events Calendar AddOn',
							'slug'					=>	'rhp-tribe-events',
							'required'				=>	true,
							'force_activation'		=>	true,
							'force_deactivation'	=>	true,
							'source'				=>	'https://s3.amazonaws.com/rockhouse/wp/plugins/rhp-tribe-events/latest.zip',
							'external_url'			=>	'https://bitbucket.org/rhprocks/rhp-tribe-events'
							// TODO: fix packaging: https://rockhousepartners.teamwork.com/tasklists/431076
						);

		$plugins[] = array(
							'name'					=>	'The Events Calendar Pro',
							'slug'					=>	'events-calendar-pro',
							'required'				=>	true,
							'force_activation'		=>	true,
							'force_deactivation'	=>	true,
							'source'				=>	'https://s3.amazonaws.com/rockhouse/wp/plugins/events-calendar-pro/latest.zip',
							'external_url'			=>	'http://tri.be/shop/wordpress-events-calendar-pro/'
						);
	}

	// Add Sassify if enabled
	if( function_exists( 'get_field' ) and get_field('rhino_enable_sassify', 'option') ) {
		$plugins[] = array(
							'name'					=>	'Sassify',
							'slug'					=>	'sassify',
							'required'				=>	true,
							'force_activation'		=>	true,
							'force_deactivation'	=>	true
						);
	}

    $config = array(
        'id'           						=> 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' 						=> '',                      // Default absolute path to pre-packaged plugins.
        'menu'         						=> 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  						=> true,                    // Show admin notices or not.
        'dismissable'  						=> true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  						=> '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' 						=> false,                   // Automatically activate plugins after installation or not.
        'message'      						=> '',                      // Message to output right before the plugins table.
        'strings'      						=> array(
        'page_title'                     	=> __( 'Install Required Plugins', 'tgmpa' ),
        'menu_title'                      	=> __( 'Install Plugins', 'tgmpa' ),
        'installing'                      	=> __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
        'oops'                            	=> __( 'Something went wrong with the plugin API.', 'tgmpa' ),
        'notice_can_install_required'     	=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
        'notice_can_install_recommended'  	=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
        'notice_cannot_install'           	=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'tgmpa' ), // %1$s = plugin name(s).
        'notice_can_activate_required'    	=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
        'notice_can_activate_recommended' 	=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
        'notice_cannot_activate'          	=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'tgmpa' ), // %1$s = plugin name(s).
		'notice_ask_to_update'            	=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
        'notice_cannot_update'            	=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'tgmpa' ), // %1$s = plugin name(s).
        'install_link'                    	=> _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'tgmpa' ),
        'activate_link'                   	=> _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'tgmpa' ),
        'return'                          	=> __( 'Return to Required Plugins Installer', 'tgmpa' ),
        'plugin_activated'                	=> __( 'Plugin activated successfully.', 'tgmpa' ),
        'complete'                        	=> __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
        'nag_type'                        	=> 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

	tgmpa( $plugins, $config );
}
