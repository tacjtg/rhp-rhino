<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Setup new roles and extra capabilities for Rhino.
 *
 * @since  	1.0.0
 * @package Rhino
 * @author 	Rockhouse
 */

/**
 * Allow Editors to view/change Sidebar Widgets.
 *
 * Action: woo_theme_activate (woo version of after_theme_switch)
 */

add_action('woo_theme_activate','rhino_alter_roles', 90 );

if ( !function_exists( 'rhino_alter_roles' ) ) {

	function rhino_alter_roles() {

		$role = get_role('editor');

		if ( !empty($role) and !$role->has_cap( 'edit_theme_options' ) )

			$role->add_cap( 'edit_theme_options' );

	} // End rhino_alter_roles()

} // End if()


/**
 * Put things back like we found them
 */

add_action('switch_theme','rhino_unalter_roles', 90 );

if ( !function_exists( 'rhino_unalter_roles' ) ) {

	function rhino_unalter_roles() {

		$role = get_role('editor');

		if ( !empty($role) and $role->has_cap( 'edit_theme_options' ) )

			$role->remove_cap( 'edit_theme_options' );

	} // End rhino_unalter_roles()

} // End if()

/**
 * Creates page titled 'Homepage',
 * then assigns the Homepage Template.
 *
 * @since  	1.0.0
 * @package Rhino
 * @author 	Rockhouse
 */

add_action( 'after_switch_theme' , 'rhino_homepage' );

if ( !function_exists( 'rhino_homepage' ) ) {

	function rhino_homepage() {

        $new_page_title = 'Homepage';
        $new_page_content = '';
        $new_page_template = 'template-homepage.php';
        $page_check = get_page_by_title($new_page_title);

        $new_page = array(

            'post_type' => 'page',
            'post_title' => $new_page_title,
            'post_content' => $new_page_content,
            'post_status' => 'publish',
            'post_author' => 1,

        );

        if(!isset($page_check->ID)){

	        $new_page_id = wp_insert_post($new_page);

            if(!empty($new_page_template)){

                update_post_meta($new_page_id, '_wp_page_template', $new_page_template);

            } // End if()

        } // End if()

        // Set Homepage as Homepage
		$homepage = get_page_by_title( 'Homepage' );

		update_option( 'page_on_front', $homepage->ID );
		update_option( 'show_on_front', 'page' );

	} // End rhino_homepage()

} // End if()


