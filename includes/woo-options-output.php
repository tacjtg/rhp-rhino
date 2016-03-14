<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $woo_options;

/**
 * Outputs all the custom settings panel options (except type) into the head.
 *
 * @since  	1.0.0
 * @package Rhino
 * @author 	Rockhouse
 */

/**
 * TODO: Fix Border CSS output
 */

add_action( 'woo_head' , 'rhino_options_output' ); // Add custom styles to HEAD

if ( !function_exists( 'rhino_options_output' ) ) {
	function rhino_options_output() {

		global $woo_options;

		// Reset
		$rhino_output = '';

		// Output CSS to $rhino_output

		// Body Styles
		if ( empty( $woo_options['woo_style_bg'] ) )
			$rhino_output .= 'body, body.page { background-color: none; }' . "\n";
		else
			$rhino_output .= 'body, body.page { background-color: ' . $woo_options['woo_style_bg'] . '; }' . "\n";

		if ( empty( $woo_options['woo_style_bg_image'] ) )
			$rhino_output .= 'body, body.page { background-image: none; }' . "\n";
		else
			$rhino_output .= 'body, body.page { background-image: url(' . $woo_options['woo_style_bg_image'] . '); }' . "\n";

		if ( empty( $woo_options['woo_style_bg_image_repeat'] ) )
			$rhino_output .= 'body, body.page { background-repeat: no-repeat; }' . "\n";
		else
			$rhino_output .= 'body, body.page { background-repeat: ' . $woo_options['woo_style_bg_image_repeat'] . '; }' . "\n";

		// Header Styles
		if ( empty( $woo_options['woo_header_bg'] ) )
			$rhino_output .= '#header-container { background-color: #ffffff; }' . "\n";
		else
			$rhino_output .= '#header-container { background-color: ' . $woo_options['woo_header_bg'] . '; }' . "\n";

		if ( empty( $woo_options['woo_header_bg_image'] ) )
			$rhino_output .= '#header-container { background-image: none; }' . "\n";
		else
			$rhino_output .= '#header-container { background-image: url(' . $woo_options['woo_header_bg_image'] . '); }' . "\n";

		if ( empty( $woo_options['rhino_footer_contact_info_font'] ) )
			$rhino_output .= '#footer-container #footer .rhino-footer-right ul.rhino-contact-info li, #footer-container #footer .rhino-footer-right ul.rhino-contact-info li a, ul.rhino-contact-info li .svg, ul.rhino-contact-info li img, body #rockhouse-powered a { color: #0F5897; fill: #0F5897; }' . "\n";
		else
			$rhino_output .= '#footer-container #footer .rhino-footer-right ul.rhino-contact-info li, #footer-container #footer .rhino-footer-right ul.rhino-contact-info li a, ul.rhino-contact-info li .svg, ul.rhino-contact-info li img, body #rockhouse-powered a { color: ' . $woo_options['rhino_footer_contact_info_font'] . '; fill: ' . $woo_options['rhino_footer_contact_info_font'] . '; }' . "\n";

		if ( empty( $woo_options['rhino_header_contact_info_link_hover_color'] ) )
			$rhino_output .= 'a.rhino-header-phone-link:hover, a.rhino-header-email-link:hover, a.rhino-header-address-link:hover, #footer-container #footer .rhino-footer-right ul.rhino-contact-info li a:hover, ul.rhino-contact-info li a .svg:hover, ul.rhino-contact-info li a img:hover, body #rockhouse-powered a:hover { color: #0F5897; }' . "\n";
		else
			$rhino_output .= 'a.rhino-phone-link:hover, a.rhino-email-link:hover, a.rhino-address-link:hover, #footer-container #footer .rhino-footer-right ul.rhino-contact-info li a:hover, ul.rhino-contact-info li a .svg:hover, ul.rhino-contact-info li a img:hover, body #rockhouse-powered a:hover { color: ' . $woo_options['rhino_header_contact_info_link_hover_color'] . '; }' . "\n";

		if ( empty( $woo_options['rhino_header_social_icon_color'] ) )
			$rhino_output .= 'p.rhino-header-social a, #header-container #header .rhino-header .rhino-social ul.rhino-social-icons li.rhino-social-icon img, #header-container #header .rhino-header .rhino-social ul.rhino-social-icons li.rhino-social-icon .svg { color: #428bca; fill: #428bca; }' . "\n";
		else
			$rhino_output .= 'p.rhino-header-social a, #header-container #header .rhino-header .rhino-social ul.rhino-social-icons li.rhino-social-icon img, #header-container #header .rhino-header .rhino-social ul.rhino-social-icons li.rhino-social-icon .svg { color: ' . $woo_options['rhino_header_social_icon_color'] . '; fill: ' . $woo_options['rhino_header_social_icon_color'] . '; }' . "\n";

		if ( empty( $woo_options['rhino_header_social_icon_hover_color'] ) )
			$rhino_output .= 'p.rhino-header-social a:hover, p.rhino-header-social a, #header-container #header .rhino-header .rhino-social ul.rhino-social-icons li.rhino-social-icon img:hover, #header-container #header .rhino-header .rhino-social ul.rhino-social-icons li.rhino-social-icon .svg:hover { color: #0F5897; fill: #0F5897; }' . "\n";
		else
			$rhino_output .= 'p.rhino-header-social a:hover, p.rhino-header-social a, #header-container #header .rhino-header .rhino-social ul.rhino-social-icons li.rhino-social-icon img:hover, #header-container #header .rhino-header .rhino-social ul.rhino-social-icons li.rhino-social-icon .svg:hover { color: ' . $woo_options['rhino_header_social_icon_hover_color'] . '; fill: ' . $woo_options['rhino_header_social_icon_hover_color'] . '; }' . "\n";

		if ( empty( $woo_options['rhino_header_bottom']['width']) )
			$rhino_output .= '#header { border-bottom: none }' . "\n";
		else
			$rhino_output .= "#header { border-bottom: {$woo_options['rhino_header_bottom']['width']}px {$woo_options['rhino_header_bottom']['style']} {$woo_options['rhino_header_bottom']['color']}; } \n";

		if ( empty( $woo_options['rhino_header_right']['width']) )
			$rhino_output .= '#header { border-right: none }' . "\n";
		else
			$rhino_output .= "#header { border-right: {$woo_options['rhino_header_right']['width']}px {$woo_options['rhino_header_right']['style']} {$woo_options['rhino_header_right']['color']}; } \n";

		if ( empty( $woo_options['rhino_header_left']['width']) )
			$rhino_output .= '#header { border-left: none }' . "\n";
		else
			$rhino_output .= "#header { border-left: {$woo_options['rhino_header_left']['width']}px {$woo_options['rhino_header_left']['style']} {$woo_options['rhino_header_left']['color']}; } \n";



		// Navigation Styles
		if ( empty( $woo_options['woo_nav_bg'] ) )
			$rhino_output .= 'body #nav-container, #top, .nav-toggle { background-color: transparent; }' . "\n";
		else
			$rhino_output .= 'body #nav-container, #top, .nav-toggle { background-color: ' . $woo_options['woo_nav_bg'] . '; }' . "\n";

		if ( $woo_options['woo_nav_font'] )
			$rhino_output .= 'body #navigation ul.nav > li a, body #header #navigation ul.nav > li ul.sub-menu li a, body .rhino-footer .rhino-footer-menu ul#menu-main-navigation > li ul.sub-menu li a, ul.nav li ul.sub-menu li a, .rhino-footer .rhino-footer-menu ul.menu > li a, #top #top-nav li:hover ul li a { color: ' . (is_string($woo_options['woo_nav_font']) ? $woo_options['woo_nav_font'] : $woo_options['woo_nav_font']['color']) . ' !important; text-decoration: none; }' . "\r\n";

		if ( empty( $woo_options['woo_nav_hover_bg'] ) )
			$rhino_output .= 'body #navigation ul.nav > li:hover, body #navigation ul.nav > li:hover a, #top #top-nav li:hover, ul.nav li.current_page_item a, ul.nav li.current_page_parent a, ul.nav li.current-menu-ancestor a, ul.nav li.current-cat a, ul.nav li.current-menu-item a { background-color: transparent; }' . "\n";
		else
			$rhino_output .= 'body #navigation ul.nav > li:hover, body #navigation ul.nav > li:hover a, #top #top-nav li:hover, ul.nav li.current_page_item a, ul.nav li.current_page_parent a, ul.nav li.current-menu-ancestor a, ul.nav li.current-cat a, ul.nav li.current-menu-item a { background-color: ' . (is_string($woo_options['woo_nav_hover_bg']) ? $woo_options['woo_nav_hover_bg'] : $woo_options['woo_nav_hover_bg']['color']) . '; }' . "\n";

		if ( empty( $woo_options['rhino_submenu_bg_color'] ) )
			$rhino_output .= 'body #navigation ul.nav > li:hover > ul, #top #top-nav li:hover ul { background-color: transparent; }' . "\n";
		else
			$rhino_output .= 'body #navigation ul.nav > li:hover > ul, #top #top-nav li:hover ul { background-color: ' . $woo_options['rhino_submenu_bg_color'] . '; }' . "\n";

		if ( empty( $woo_options['rhino_submenu_hover_bg_color'] ) )
			$rhino_output .= '#top #top-nav li:hover ul li a:hover, #nav-container #navigation .menus ul#main-nav li ul li a:hover, #footer-container #footer .rhino-footer .rhino-footer-nav .rhino-footer-menu ul.menu li:hover, #footer-container #footer .rhino-footer .rhino-footer-nav .rhino-footer-menu ul.menu li a:hover { background-color: transparent; }' . "\n";
		else
			$rhino_output .= '#top #top-nav li:hover ul li a:hover, #nav-container #navigation .menus ul#main-nav li ul li a:hover, #footer-container #footer .rhino-footer .rhino-footer-nav .rhino-footer-menu ul.menu li:hover, #footer-container #footer .rhino-footer .rhino-footer-nav .rhino-footer-menu ul.menu li a:hover { background-color: ' . (is_string($woo_options['rhino_submenu_hover_bg_color']) ? $woo_options['rhino_submenu_hover_bg_color'] : $woo_options['rhino_submenu_hover_bg_color']['color']) . ' !important; }' . "\n";



		// Footer Styles
		if ( empty( $woo_options['rhino_footer_social_icon_color'] ) )
			$rhino_output .= 'p.rhino-footer-social a, #footer-container #footer .rhino-social ul.rhino-social-icons li.rhino-social-icon img, #footer-container #footer .rhino-social ul.rhino-social-icons li.rhino-social-icon .svg { color: #428bca; fill: #428bca; }' . "\n";
		else
			$rhino_output .= 'p.rhino-footer-social a, #footer-container #footer .rhino-social ul.rhino-social-icons li.rhino-social-icon img, #footer-container #footer .rhino-social ul.rhino-social-icons li.rhino-social-icon .svg { color: ' . $woo_options['rhino_footer_social_icon_color'] . '; fill: ' . $woo_options['rhino_footer_social_icon_color'] . '; }' . "\n";

		if ( empty( $woo_options['rhino_footer_social_icon_hover_color'] ) )
			$rhino_output .= 'p.rhino-footer-social a:hover, #footer-container #footer .rhino-social ul.rhino-social-icons li.rhino-social-icon img:hover, #footer-container #footer .rhino-social ul.rhino-social-icons li.rhino-social-icon .svg:hover { color: #0F5897; fill: #0F5897; }' . "\n";
		else
			$rhino_output .= 'p.rhino-footer-social a:hover, #footer-container #footer .rhino-social ul.rhino-social-icons li.rhino-social-icon img:hover, #footer-container #footer .rhino-social ul.rhino-social-icons li.rhino-social-icon .svg:hover { color: ' . $woo_options['rhino_footer_social_icon_hover_color'] . '; fill: ' . $woo_options['rhino_footer_social_icon_hover_color'] . '; }' . "\n";

		if ( empty( $woo_options['woo_footer_bg'] ) )
			$rhino_output .= '#footer-container, #rockhouse-powered { background-color: #ffffff; }' . "\n";
		else
			$rhino_output .= '#footer-container, #rockhouse-powered { background-color: ' . $woo_options['woo_footer_bg'] . '; }' . "\n";



		// Slide Styles
		if ( empty( $woo_options['rhino_slide_background_color'] ) )
			$rhino_output .= '#rhino-slideshow, .widget.widget_meteor-slides-widget { background-color: #f0f0f0; }' . "\n";
		else
			$rhino_output .= '#rhino-slideshow, .widget.widget_meteor-slides-widget { background-color: ' . $woo_options['rhino_slide_background_color'] . '; }' . "\n";

		if ( $woo_options['rhino_slide_border_top'] )
			$rhino_output .= '#rhino-slideshow { border-top: ' . rhino_generate_border_css( $woo_options['rhino_slide_border_top'] ) . '; }' . "\n";

		if ( $woo_options['rhino_slide_border_right'] )
			$rhino_output .= '#rhino-slideshow { border-right: ' . rhino_generate_border_css( $woo_options['rhino_slide_border_right'] ) . '; }' . "\n";

		if ( $woo_options['rhino_slide_border_bottom'] )
			$rhino_output .= '#rhino-slideshow { border-bottom: ' . rhino_generate_border_css( $woo_options['rhino_slide_border_bottom'] ) . '; }' . "\n";

		if ( $woo_options['rhino_slide_border_left'] )
			$rhino_output .= '#rhino-slideshow { border-left: ' . rhino_generate_border_css( $woo_options['rhino_slide_border_left'] ) . '; }' . "\n";


		// Widget Styles
		if ( empty( $woo_options['woo_widget_bg'] ) )
			$rhino_output .= '#sidebar .widget { background: #efefef; background-color: #efefef; }' . "\n";
		else
			$rhino_output .= '#sidebar .widget { background: ' . $woo_options['woo_widget_bg'] . '; background-color: ' . $woo_options['woo_widget_bg'] . '; }' . "\n";

		if ( empty( $woo_options['woo_widget_font_text'] ) )
			$rhino_output .= '#sidebar .widget, #sidebar .widget h3, .widget.widget_recent_entries ul li a, .widget.widget_recent_entries ul li .post-date, #sidebar .widget.tribe-events-list-widget ol li .rhino-events-widget-vitals h4 a, #sidebar .widget.tribe-events-list-widget ol li .rhino-events-widget-vitals .duration { color: #efefef; }' . "\n";
		else
			$rhino_output .= '#sidebar .widget, #sidebar .widget h3, .widget.widget_recent_entries ul li a, .widget.widget_recent_entries ul li .post-date, #sidebar .widget.tribe-events-list-widget ol li .rhino-events-widget-vitals h4 a, #sidebar .widget.tribe-events-list-widget ol li .rhino-events-widget-vitals .duration { color: ' . $woo_options['woo_widget_font_text'] . '; }' . "\n";


		// Email Styles
		if ( $woo_options['rhino_email_background_color'] )
			$rhino_output .= '.widget.widget_rhino_email_widget,
		#sidebar .widget.widget_rhino_email_widget,
		#home-widget-container-above .widget.widget_rhino_email_widget,
		.rhino-widget-area-below-nav .widget.widget_rhino_email_widget { background-color: ' . $woo_options['rhino_email_background_color'] . '; }' . "\n";

		if ( $woo_options['rhino_email_top_border'] )
			$rhino_output .= '.widget_rhino_email_widget { border-top: ' . rhino_generate_border_css( $woo_options['rhino_email_top_border'] ) . '; }' . "\n";

		if ( $woo_options['rhino_email_bottom_border'] )
			$rhino_output .= '.widget_rhino_email_widget { border-bottom: ' . rhino_generate_border_css( $woo_options['rhino_email_bottom_border'] ) . '; }' . "\n";

		if ( $woo_options['rhino_email_side_border'] )
			$rhino_output .= '.widget_rhino_email_widget { border-left: ' . rhino_generate_border_css( $woo_options['rhino_email_side_border'] ) . '; }' . "\n";

		if ( $woo_options['rhino_email_side_border'] )
			$rhino_output .= '.widget_rhino_email_widget { border-right: ' . rhino_generate_border_css( $woo_options['rhino_email_side_border'] ) . '; }' . "\n";

		if ( $woo_options['rhino_email_header_font'] )
			$rhino_output .= '.widget_rhino_email_widget h3.widget-title { color: ' . $woo_options['rhino_email_header_font'] . '; }' . "\n";

		if ( $woo_options['rhino_email_details_font'] )
			$rhino_output .= '.widget_rhino_email_widget .mc-field-group input.email, .widget_rhino_email_widget p.rhino-email-details { color: ' . $woo_options['rhino_email_details_font'] . '; }' . "\n";




		// Homepage Tab Widget Styles
		if ( empty( $woo_options['woo_widget_bg'] ) )
			$rhino_output .= '.responsive-tabs__list__item, .responsive-tabs__heading, .responsive-tabs__panel { background-color: transparent; }' . "\n";
		else
			$rhino_output .= '.responsive-tabs__list__item, .responsive-tabs__heading, .responsive-tabs__panel { background-color: ' . $woo_options['woo_widget_bg'] . '; }' . "\n";

		if ( $woo_options['woo_widget_font_text'] )
			$rhino_output .= '.responsive-tabs__list__item, .responsive-tabs__heading, h3.responsive-tabs__heading, .widget h3.responsive-tabs__heading { color: ' . (is_string($woo_options['woo_widget_font_text']) ? $woo_options['woo_widget_font_text'] : $woo_options['woo_widget_font_text']['color']) . '; }' . "\n";

		if ( $woo_options['woo_widget_border'] )
			$rhino_output .= '.responsive-tabs__list__item, .responsive-tabs__heading, h3.responsive-tabs__heading, .widget h3.responsive-tabs__heading { border-bottom: ' . rhino_generate_border_css( $woo_options['woo_widget_border'] ) . '; }' . "\n";

		if ( $woo_options['woo_widget_padding_tb'] )
			$rhino_output .= '.responsive-tabs__panel { padding-top: ' . $woo_options['woo_widget_padding_tb'] . 'px; }' . "\n";

		if ( $woo_options['woo_widget_padding_tb'] )
			$rhino_output .= '.responsive-tabs__panel { padding-bottom: ' . $woo_options['woo_widget_padding_tb'] . 'px; }' . "\n";

		if ( $woo_options['woo_widget_padding_lr'] )
			$rhino_output .= '.responsive-tabs__panel { padding-left: ' . $woo_options['woo_widget_padding_lr'] . 'px; }' . "\n";

		if ( $woo_options['woo_widget_padding_lr'] )
			$rhino_output .= '.responsive-tabs__panel { padding-right: ' . $woo_options['woo_widget_padding_lr'] . 'px; }' . "\n";




		// Event Styles

		if ( $woo_options['rhino_tribe_override_color']  )

		$rhino_output .= '#tribe-events .tribe-events-button, #tribe-events .tribe-events-button:hover, #tribe_events_filters_wrapper input[type=submit], .tribe-events-button, .tribe-events-button.tribe-active:hover, .tribe-events-button.tribe-inactive, .tribe-events-button:hover, .tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-], .tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-]>a  { background-color: ' . $woo_options['rhino_tribe_override_color'] . ';}' . "\n" . '#tribe-events-content .tribe-events-tooltip h4, #tribe_events_filters_wrapper .tribe_events_slider_val, .single-tribe_events a.tribe-events-gcal, .single-tribe_events a.tribe-events-ical { color: ' . $woo_options['rhino_tribe_override_color'] . ';}' . "\n";

		if ( empty( $woo_options['rhino_events_box_background'] ) )
			$rhino_output .= '.rhino-event-wrapper, .tribe-bar-collapse #tribe-bar-collapse-toggle.tribe-bar-collapse-toggle-full-width, #tribe-events-bar, .tribe-events-list-separator-month span, #tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option a, .tribe-events-single, #tribe-events-content table.tribe-events-calendar, .tribe-week-grid-wrapper, .type-tribe_events.tribe-events-photo-event .tribe-events-photo-event-wrap, .wrapper.rhino-event-series-list-wrap, #st-accordion .button.st-toggle, body .tribe-events-list-separator-month, body.page .tribe-events-list-separator-month, #tribe-events-bar, body #tribe-bar-form, #tribe-events #tribe-events-content.tribe-events-month #rhp-calendar-sidebar .tribe-events-tooltip { background-color: #f0f0f0; }' . "\n";
		else
			$rhino_output .= '.rhino-event-wrapper, .tribe-bar-collapse #tribe-bar-collapse-toggle.tribe-bar-collapse-toggle-full-width, #tribe-events-bar, .tribe-events-list-separator-month span, #tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option a, .tribe-events-single, #tribe-events-content table.tribe-events-calendar, .tribe-week-grid-wrapper, .type-tribe_events.tribe-events-photo-event .tribe-events-photo-event-wrap, .wrapper.rhino-event-series-list-wrap, #st-accordion .button.st-toggle, body .tribe-events-list-separator-month, body.page .tribe-events-list-separator-month, #tribe-events-bar, body #tribe-bar-form, #tribe-events #tribe-events-content.tribe-events-month #rhp-calendar-sidebar .tribe-events-tooltip { background-color: ' . $woo_options['rhino_events_box_background'] . ';}' . "\n";

		if ( $woo_options['rhino_events_box_rounded_corners'] )
			$rhino_output .= '.rhino-event-wrapper, #tribe-events-bar { -webkit-border-radius: ' . trim( $woo_options['rhino_events_box_rounded_corners'] ) . 'px; ' .
							 '-moz-border-radius: ' . trim( $woo_options['rhino_events_box_rounded_corners'] ) . 'px; ' .
							 'border-radius: ' . trim( $woo_options['rhino_events_box_rounded_corners'] ) . 'px; }' . "\n";

		if ( empty( $woo_options['rhino_events_box_bottom_border']["color"] ) )
			$rhino_output .= '.rhino-event-wrapper, .tribe-bar-collapse #tribe-bar-collapse-toggle.tribe-bar-collapse-toggle-full-width, #tribe-events-bar, .tribe-events-single, .rhino-event-wrapper, .tribe-events-single, .widget.tribe-events-list-widget, #tribe-events-content table.tribe-events-calendar { border-bottom: 2px solid #e6e6e6; }' . "\n";
		else
			$rhino_output .= '.rhino-event-wrapper, .tribe-bar-collapse #tribe-bar-collapse-toggle.tribe-bar-collapse-toggle-full-width, #tribe-events-bar, .tribe-events-single, .rhino-event-wrapper, .tribe-events-single, .widget.tribe-events-list-widget, #tribe-events-content table.tribe-events-calendar { border-bottom: ' . rhino_generate_border_css( $woo_options['rhino_events_box_bottom_border'] ) . ';}' . "\n";

		if ( empty( $woo_options['rhino_events_box_bottom_border']["color"] ) )
			$rhino_output .= '.single .rhino-event-cta-box { border-top: 2px solid #e6e6e6; }' . "\n";
		else
			$rhino_output .= '.single .rhino-event-cta-box { border-top: ' . rhino_generate_border_css( $woo_options['rhino_events_box_bottom_border'] ) . ';}' . "\n";

		// Event Datebox Styles
		if ( $woo_options['rhino_datebox_rounded_corners'] )
			$rhino_output .= '.rhino-event-datebox-month { -webkit-border-top-left-radius: ' . trim( $woo_options['rhino_datebox_rounded_corners'] ) . 'px; ' .
							 '-webkit-border-top-right-radius: ' . trim( $woo_options['rhino_datebox_rounded_corners'] ) . 'px; ' .
							 '-moz-border-top-left-radius: ' . trim( $woo_options['rhino_datebox_rounded_corners'] ) . 'px; ' .
							 '-moz-border-top-right-radius: ' . trim( $woo_options['rhino_datebox_rounded_corners'] ) . 'px; ' .
							 'border-top-left-radius: ' . trim( $woo_options['rhino_datebox_rounded_corners'] ) . 'px;' .
							 'border-top-right-radius: ' . trim( $woo_options['rhino_datebox_rounded_corners'] ) . 'px; }' . "\n" .
							 '.rhino-event-datebox-day { -webkit-border-bottom-left-radius: ' . trim( $woo_options['rhino_datebox_rounded_corners'] ) . 'px; ' .
							 '-webkit-border-bottom-right-radius: ' . trim( $woo_options['rhino_datebox_rounded_corners'] ) . 'px; ' .
							 '-moz-border-bottom-left-radius: ' . trim( $woo_options['rhino_datebox_rounded_corners'] ) . 'px; ' .
							 '-moz-border-bottom-right-radius: ' . trim( $woo_options['rhino_datebox_rounded_corners'] ) . 'px; ' .
							 'border-bottom-left-radius: ' . trim( $woo_options['rhino_datebox_rounded_corners'] ) . 'px;' .
							 'border-bottom-right-radius: ' . trim( $woo_options['rhino_datebox_rounded_corners'] ) . 'px; }' . "\n";

		if ( empty( $woo_options['rhino_datebox_month_background_color'] ) )
			$rhino_output .= '.rhino-event-datebox-month, #tribe-events-content .tribe-events-calendar td.tribe-events-present.mobile-active:hover, .tribe-events-calendar td.tribe-events-present.mobile-active, .tribe-events-calendar td.tribe-events-present.mobile-active div[id*=tribe-events-daynum-], .tribe-events-calendar td.tribe-events-present.mobile-active div[id*=tribe-events-daynum-] a, .tribe-week-grid-hours { background-color: #cccccc; }' . "\n";
		else
			$rhino_output .= '.rhino-event-datebox-month, #tribe-events-content .tribe-events-calendar td.tribe-events-present.mobile-active:hover, .tribe-events-calendar td.tribe-events-present.mobile-active, .tribe-events-calendar td.tribe-events-present.mobile-active div[id*=tribe-events-daynum-], .tribe-events-calendar td.tribe-events-present.mobile-active div[id*=tribe-events-daynum-] a, .tribe-week-grid-hours { background-color: ' . $woo_options['rhino_datebox_month_background_color'] . ';}' . "\n";

		if ( empty( $woo_options['rhino_datebox_date_background_color'] ) )
			$rhino_output .= '.rhino-event-datebox-date { background-color: #cccccc; }' . "\n";
		else
			$rhino_output .= '.rhino-event-datebox-date { background-color: ' . $woo_options['rhino_datebox_date_background_color'] . ';}' . "\n";

		if ( empty( $woo_options['rhino_datebox_day_background_color'] ) )
			$rhino_output .= '.rhino-event-datebox-day { background-color: #cccccc; }' . "\n";
		else
			$rhino_output .= '.rhino-event-datebox-day { background-color: ' . $woo_options['rhino_datebox_day_background_color'] . ';}' . "\n";

		if ( empty( $woo_options['rhino_events_header_font_hover_color'] ) )
			$rhino_output .= 'h2.rhino-event-header a:hover { color: #777777; }' . "\n";
		else
			$rhino_output .= 'h2.rhino-event-header a:hover { color: ' . $woo_options['rhino_events_header_font_hover_color'] . ' !important;}' . "\n";



		// Button Styles - Rounded Corners

		if ( $woo_options['rhino_button_rounded_corners'] )
			$rhino_output .= '.button, span.coming-soon, span.sold-out, span.free, span.off-sale, #tribe-bar-form .tribe-bar-submit input[type=submit], a.rhino-event-rsvp, p.tribe-events-widget-link a { -webkit-border-top-left-radius: ' . trim( $woo_options['rhino_button_rounded_corners'] ) . 'px !important ; ' .
							 '-webkit-border-top-right-radius: ' . trim( $woo_options['rhino_button_rounded_corners'] ) . 'px !important ; ' .
							 '-moz-border-top-left-radius: ' . trim( $woo_options['rhino_button_rounded_corners'] ) . 'px !important ; ' .
							 '-moz-border-top-right-radius: ' . trim( $woo_options['rhino_button_rounded_corners'] ) . 'px !important ; ' .
							 'border-top-left-radius: ' . trim( $woo_options['rhino_button_rounded_corners'] ) . 'px !important ;' .
							 'border-top-right-radius: ' . trim( $woo_options['rhino_button_rounded_corners'] ) . 'px; !important }' . "\n" .

							 '.button, span.coming-soon, span.sold-out, span.free, span.off-sale, #tribe-bar-form .tribe-bar-submit input[type=submit], a.rhino-event-rsvp, p.tribe-events-widget-link a { -webkit-border-bottom-left-radius: ' . trim( $woo_options['rhino_button_rounded_corners'] ) . 'px !important ; ' .
							 '-webkit-border-bottom-right-radius: ' . trim( $woo_options['rhino_button_rounded_corners'] ) . 'px !important ; ' .
							 '-moz-border-bottom-left-radius: ' . trim( $woo_options['rhino_button_rounded_corners'] ) . 'px !important ; ' .
							 '-moz-border-bottom-right-radius: ' . trim( $woo_options['rhino_button_rounded_corners'] ) . 'px !important ; ' .
							 'border-bottom-left-radius: ' . trim( $woo_options['rhino_button_rounded_corners'] ) . 'px !important ;' .
							 'border-bottom-right-radius: ' . trim( $woo_options['rhino_button_rounded_corners'] ) . 'px; !important }' . "\n";


		// Button Styles - Primary (CTA)

		if ( empty( $woo_options['rhino_cta_primary_button_background_color'] ) )
			$rhino_output .= '.button.primary, .tribe-grid-allday .type-tribe_events>div, .tribe-grid-allday .type-tribe_events>div:hover, .tribe-grid-body .type-tribe_events .tribe-events-week-hourly-single, .tribe-grid-body .type-tribe_events .tribe-events-week-hourly-single:hover { background-color: #cc0000; color: #ffffff; }' . "\n";
		else
			$rhino_output .= '.button.primary, .tribe-grid-allday .type-tribe_events>div, .tribe-grid-allday .type-tribe_events>div:hover, .tribe-grid-body .type-tribe_events .tribe-events-week-hourly-single, .tribe-grid-body .type-tribe_events .tribe-events-week-hourly-single:hover { background-color: ' . $woo_options['rhino_cta_primary_button_background_color'] . ' !important;}' . "\n";

		if ( empty( $woo_options['rhino_cta_primary_button_hover_background_color'] ) )
			$rhino_output .= '.button.primary:hover { background-color: #cc0000; color: #ffffff; }' . "\n";
		else
			$rhino_output .= '.button.primary:hover { background-color: ' . $woo_options['rhino_cta_primary_button_hover_background_color'] . ' !important;}' . "\n";

		if ( empty( $woo_options['rhino_cta_primary_button_hover_background_color'] ) )
			$rhino_output .= '.tribe-grid-allday .type-tribe_events>div, .tribe-grid-allday .type-tribe_events>div:hover, .tribe-grid-body .type-tribe_events .tribe-events-week-hourly-single, .tribe-grid-body .type-tribe_events .tribe-events-week-hourly-single:hover { border: 1px solid #cc0000 }' . "\n";
		else
			$rhino_output .= '.tribe-grid-allday .type-tribe_events>div, .tribe-grid-allday .type-tribe_events>div:hover, .tribe-grid-body .type-tribe_events .tribe-events-week-hourly-single, .tribe-grid-body .type-tribe_events .tribe-events-week-hourly-single:hover { border: 1px solid ' . $woo_options['rhino_cta_primary_button_hover_background_color'] . ' !important;}' . "\n";

		if ( empty( $woo_options['rhino_cta_primary_button_font_color'] ) )
			$rhino_output .= '.button.primary { color: #ffffff; }' . "\n";
		else
			$rhino_output .= '.button.primary { color: ' . $woo_options['rhino_cta_primary_button_font_color'] . ' !important;}' . "\n";

		// Button Styles - Secondary

		if ( empty( $woo_options['rhino_cta_secondary_button_background_color'] ) )
			$rhino_output .= '.button.secondary, #tribe-bar-form .tribe-bar-submit input[type=submit], .responsive-tabs__list__item, .responsive-tabs__heading, h3.responsive-tabs__heading, .widget h3.responsive-tabs__heading, p.tribe-events-widget-link a { background-color: #cc0000; color: #ffffff; }' . "\n";
		else
			$rhino_output .= 'body .button.secondary, body #tribe-bar-form .tribe-bar-submit input[type=submit], body .responsive-tabs__list__item, body .responsive-tabs__heading, h3.responsive-tabs__heading, body .widget h3.responsive-tabs__heading, body p.tribe-events-widget-link a { background-color: ' . $woo_options['rhino_cta_secondary_button_background_color'] . ';}' . "\n";

		if ( empty( $woo_options['rhino_cta_secondary_button_hover_background_color'] ) )
			$rhino_output .= 'body .button.secondary:hover, body #tribe-bar-form .tribe-bar-submit input[type=submit]:hover, body .responsive-tabs__list__item:hover, .responsive-tabs__heading:hover, body h3.responsive-tabs__heading:hover, .widget h3.responsive-tabs__heading:hover .responsive-tabs__list__item--active, .responsive-tabs__list__item--active:hover, body .responsive-tabs__heading--active, body .responsive-tabs__heading--active:hover, body p.tribe-events-widget-link a:hover { background-color: #cc0000; color: #ffffff; }' . "\n";
		else
			$rhino_output .= '.button.secondary:hover, #tribe-bar-form .tribe-bar-submit input[type=submit]:hover, .responsive-tabs__list__item:hover, .responsive-tabs__heading:hover, h3.responsive-tabs__heading:hover, .widget h3.responsive-tabs__heading:hover .responsive-tabs__list__item--active, .responsive-tabs__list__item--active:hover, .responsive-tabs__heading--active, .responsive-tabs__heading--active:hover, p.tribe-events-widget-link a:hover { background-color: ' . $woo_options['rhino_cta_secondary_button_hover_background_color'] . ' !important;}' . "\n";

		if ( empty( $woo_options['rhino_cta_secondary_button_font_color'] ) )
			$rhino_output .= '.button.secondary, #tribe-bar-form .tribe-bar-submit input[type=submit], a.rhino-event-rsvp, .responsive-tabs__list__item, .responsive-tabs__heading, h3.responsive-tabs__heading, .widget h3.responsive-tabs__heading, p.tribe-events-widget-link a { color: #ffffff; }' . "\n";
		else
			$rhino_output .= '.button.secondary, #tribe-bar-form .tribe-bar-submit input[type=submit], a.rhino-event-rsvp, .responsive-tabs__list__item, .responsive-tabs__heading, h3.responsive-tabs__heading, .widget h3.responsive-tabs__heading, p.tribe-events-widget-link a { color: ' . $woo_options['rhino_cta_secondary_button_font_color'] . ' !important;}' . "\n";

		// Button Styles - Tertiary

		if ( empty( $woo_options['rhino_cta_tertiary_button_background_color'] ) )
			$rhino_output .= '.button.tertiary, span.coming-soon, span.sold-out, span.free, span.off-sale { background-color: #cc0000; color: #ffffff; }' . "\n";
		else
			$rhino_output .= '.button.tertiary, span.coming-soon, span.sold-out, span.free, span.off-sale { background-color: ' . $woo_options['rhino_cta_tertiary_button_background_color'] . ' !important;}' . "\n";

		if ( empty( $woo_options['rhino_cta_tertiary_button_font_color'] ) )
			$rhino_output .= '.button.tertiary, span.coming-soon, span.sold-out, span.free, span.off-sale { color: #ffffff; }' . "\n";
		else
			$rhino_output .= '.button.tertiary, span.coming-soon, span.sold-out, span.free, span.off-sale { color: ' . $woo_options['rhino_cta_tertiary_button_font_color'] . ' !important;}' . "\n";




		// Output styles
		if (isset($rhino_output) && $rhino_output != '') {
			$rhino_output = strip_tags($rhino_output);
			$rhino_output = "<!-- Rhino Custom Styles -->\n<style type=\"text/css\">\n" . $rhino_output . "</style>\n\n";
			echo $rhino_output;
		} // End if

	} // End rhino_options_output()

} // End if

/**
 * Outputs all the custom border options into CSS syntax.
 *
 * @since  	1.0.0
 * @package Rhino
 * @author 	Rockhouse
 */

if ( !function_exists( 'rhino_generate_border_css' ) ) {
	function rhino_generate_border_css( $rhino_output ) {

		if ( !empty( $rhino_output["width"] ) && !empty( $rhino_output["style"] ) && !empty( $rhino_output["color"] ) )

			return $rhino_output["width"] . 'px ' . $rhino_output["style"] . ' ' . $rhino_output["color"];

	} // End rhino_generate_border_css()

} // End if
