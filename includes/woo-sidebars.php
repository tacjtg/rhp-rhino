<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Load Rhino Widgets.
 *
 * @since  	1.0.0
 * @package Rhino
 * @author 	Rockhouse
 */

// Register Widgets

add_action( 'widgets_init', 'rhino_sidebars' );

if ( !function_exists( 'rhino_sidebars' ) ) {

	function rhino_sidebars() {

		// Some of these are from Canvas so we are including them to
		// maintain backwards compatiblity... with a few name changes
		//   see: canvas/includes/sidebar-init.php

		$rhino_sidebars = array(

			// Header
			'rhino-widget-area-above-nav' => array(
					'name' => __( 'Navigation [Above Menu]', 'rhino' ),
					'id' => 'rhino-widget-area-above-nav',
					'description' => __( 'Widgets in this area will be shown on all pages above the navigation.', 'rhino' ),
					'before_title' => '<h3 class="widget-title">',
					'after_title' => '</h3>',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
				) ,

			'rhino-widget-area-below-nav' => array(
					'name' => __( 'Navigation [Below Menu]', 'rhino' ),
					'id' => 'rhino-widget-area-below-nav',
					'description' => __( 'Widgets in this area will be shown on all pages below the navigation.', 'rhino' ),
					'before_title' => '<h3 class="widget-title">',
					'after_title' => '</h3>',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
				),

			// Home Page Areas
			'rhino-widget-area-homepage-above' => array(
					'name' => __( 'Homepage [Above Content]', 'rhino' ),
					'id' => 'rhino-widget-area-homepage-above',
					'description' => __( 'Widget Area above the main Homepage content.', 'rhino' ),
					'before_title' => '<h3 class="widget-title">',
					'after_title' => '</h3>',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
				),

			'rhino-widget-area-homepage-main' => array(
					'name' => __( 'Homepage Primary Content', 'rhino' ),
					'id' => 'rhino-widget-area-homepage-main',
					'description' => __( 'Widgets in this area will be shown in the primary space on the Homepage.', 'rhino' ),
					'before_title' => '<h3 class="widget-title">',
					'after_title' => '</h3>',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
				),

			'rhino-widget-area-homepage-sidebar' => array(
					'name' => __( 'Homepage Sidebar', 'rhino' ),
					'id' => 'rhino-widget-area-homepage-sidebar',
					'description' => __( 'Widgets in this area will be shown on the Homepage Sidebar.  Leave this empty to hide the sidebar.', 'rhino' ),
					'before_title' => '<h3 class="widget-title">',
					'after_title' => '</h3>',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
				),

			'rhino-widget-area-homepage-below' => array(
					'name' => __( 'Homepage [Below Content]', 'rhino' ),
					'id' => 'rhino-widget-area-homepage-below',
					'description' => __( 'Widget Area below the main Homepage content.', 'rhino' ),
					'before_title' => '<h3 class="widget-title">',
					'after_title' => '</h3>',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
				),

			// Canvas default
			'primary' => array(
					'name' => 'Content Sidebar',
					'id' => 'primary',
					'description' => 'The primary sidebar for pages and content other than the Homepage and Events',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h3>',
					'after_title' => '</h3>'
				),

			// Events View, Optional Sidebar
			'rhino-sidebar-events' => array(
					'name' => __( 'Events Sidebar', 'rhino' ),
					'id' => 'rhino-sidebar-events',
					'description' => __( 'Widgets in this area will be shown on Event pages.', 'rhino' ),
					'before_title' => '<h3 class="widget-title">',
					'after_title' => '</h3>',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
				),

			// Footer
			'rhino-widget-area-above-footer' => array(
					'name' => __( 'Footer [Above Content]', 'rhino' ),
					'id' => 'rhino-widget-area-above-footer',
					'description' => __( 'Widgets in this Full Width region will be shown on all pages above the Footer Blocks.', 'rhino' ),
					'before_title' => '<h3 class="widget-title">',
					'after_title' => '</h3>',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
				),

			// Canvas defaults
			'footer-1' => array(
					'name' => 'Footer 1',
					'id' => 'footer-1',
					'description' => 'Footer Block %d.',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h3>',
					'after_title' => '</h3>'
				),

			'footer-2' => array(
					'name' => 'Footer 2',
					'id' => 'footer-2',
					'description' => 'Footer Block %d.',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h3>',
					'after_title' => '</h3>'
				),

			'footer-3' => array(
					'name' => 'Footer 3',
					'id' => 'footer-3',
					'description' => 'Footer Block %d.',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h3>',
					'after_title' => '</h3>'
				),

			'footer-4' => array(
					'name' => 'Footer 4',
					'id' => 'footer-4',
					'description' => 'Footer Block %d.',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h3>',
					'after_title' => '</h3>'
				),

			// Below footer, full width
			'rhino-widget-area-below-footer' => array(
					'name' => __( 'Footer [Below Content]', 'rhino' ),
					'id' => 'rhino-widget-area-below-footer',
					'description' => __( 'Widgets in this Full Width region will be shown on all pages below the Footer Blocks.', 'rhino' ),
					'before_title' => '<h3 class="widget-title">',
					'after_title' => '</h3>',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
				)

		);

		// Get rid of Above Nav widget area with Sticky Headers
		$sticky_header = false;
		if( function_exists( 'get_field' ) ) {
			$sticky_header = get_field( 'rhino_sticky_navigation', 'options' );
		}
		if( $sticky_header == 'true' ) {
			unset( $rhino_sidebars['rhino-widget-area-above-nav'] );
		}

		// Remove extra Widget divs so the responsiveTabs.js can work it's magic
		if( function_exists( 'get_field' ) and get_field( 'tabbed_widgets_on_homepage', 'options' ) ) {
			$rhino_sidebars['rhino-widget-area-homepage-main']['before_widget'] = '';
			$rhino_sidebars['rhino-widget-area-homepage-main']['after_widget'] = '';
		}

		// Do the deed
		foreach( $rhino_sidebars as $id => $sidebar ) {
			register_sidebar( $rhino_sidebars[ $id ] );
		}

	} // End rhino_sidebars()

} // End if


/**
 * Widget Above Nav
 */

add_action( 'woo_header_after', 'rhino_widget_above_nav' );

if ( !function_exists( 'rhino_widget_above_nav' ) ) {

	function rhino_widget_above_nav() {

		if( is_active_sidebar( 'rhino-widget-area-above-nav' ) ) {
			echo '<div class="rhino-widget-area-above-nav">';
			dynamic_sidebar( 'rhino-widget-area-above-nav' );
			echo '</div>';
		}

	} // End rhino_widget_above_nav()

} // End if

/**
 * Widget Below Nav
 */

add_action( 'woo_content_before', 'rhino_widget_below_nav' );

if ( !function_exists( 'rhino_widget_below_nav' ) ) {

	function rhino_widget_below_nav() {


		if( is_active_sidebar( 'rhino-widget-area-below-nav' ) ) {

			// The col-full used to be conditional on 'woo_header_full_width' !== "true"
			echo '<div class="col-full">';
			echo '<div class="rhino-widget-area-below-nav">';
			dynamic_sidebar( 'rhino-widget-area-below-nav' );
			echo '</div> <!-- /#rhino-widget-area-below-nav -->';
			echo '</div> <!-- /#col-full -->';

		}

    } // End rhino_widget_above_nav()

} // End if

/**
 * Widget Above Footer
 */

add_action( 'woo_content_after', 'rhino_widget_above_footer' );

if ( !function_exists( 'rhino_widget_above_footer' ) ) {

	function rhino_widget_above_footer() {

		if( is_active_sidebar( 'rhino-widget-area-above-footer' ) ) {
			echo '<div class="rhino-widget-area-above-footer">';
			dynamic_sidebar( 'rhino-widget-area-above-footer' );
			echo '</div>';
		}

	} // End rhino_widget_above_nav()

} // End if

/**
 * Widget Below Footer
 */

add_action( 'woo_foot', 'rhino_widget_below_footer', 1 ); // Priority Set above 'Rockhouse Powered' logo.

if ( !function_exists( 'rhino_widget_below_footer' ) ) {

	function rhino_widget_below_footer() {

		if( is_active_sidebar( 'rhino-widget-area-below-footer' ) ) {
			echo '<div class="rhino-widget-area-below-footer">';
			dynamic_sidebar( 'rhino-widget-area-below-footer' );
			echo '</div>';
		}

	} // End rhino_widget_above_nav()

} // End if

/**
 * Remove Standard WordPress Widgets
 */

add_action('widgets_init', 'rhino_unregister_default_widgets', 11);

if ( !function_exists( 'rhino_unregister_default_widgets' ) ) {

	function rhino_unregister_default_widgets() {

		unregister_widget('WP_Widget_Pages');
		unregister_widget('WP_Widget_Calendar');
		unregister_widget('WP_Widget_Archives');
		unregister_widget('WP_Widget_Links');
		unregister_widget('WP_Widget_Meta');
		unregister_widget('WP_Widget_Categories');
		unregister_widget('WP_Widget_Recent_Comments');
		unregister_widget('WP_Widget_RSS');
		unregister_widget('WP_Widget_Tag_Cloud');

	} // End rhino_unregister_default_widgets()

} // End if

/**
 * Remove Default Canvas Sidebars by overriding the default in
 * canvas/includes/widgets-init.php
 */

function the_widgets_init() {
	// Do nothing!
}
