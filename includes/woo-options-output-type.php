<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $woo_options;

/**
 * Outputs all the custom fonts to HEAD.
 *
 * @since  	1.0.0
 * @package Rhino
 * @author 	Rockhouse
 */

add_action( 'woo_head' , 'rhino_custom_typography' ); // Add custom typography to HEAD

if ( !function_exists('rhino_custom_typography') ) {

	function rhino_custom_typography() {

		// Enable Google Fonts stylesheet in HEAD
		if ( function_exists( 'woo_google_webfonts' ) )
			woo_google_webfonts();

		// Get options & Set Fallback
		global $woo_options;
		$woo_options['rhino_font_fallback'] = array(
			'face' => 'Helvetica',
			'size' => '14',
			'unit' => 'px',
			'style' => '400 normal',
			'color' => '#000'
	   	);

		// Reset
		$rhino_output = '';

		// Header Fonts
		$rhino_output .= 'h1, h2, h3, h4, h2.rhino-event-header, h3.rhino-event-subheader, .widget h3.rhino-event-subheader, .rhino-event-datebox-month p, .rhino-event-datebox-date p, ul.nav li a, #navigation ul.rss a, #navigation ul.cart a.cart-contents, #navigation .cart-contents #navigation ul.rss, #navigation ul.nav-search, #navigation ul.nav-search a, .rhino-footer .rhino-footer-menu ul#menu-main-navigation > li a, .rhino-footer-nav ul li a, #top ul.nav > li a:hover .rhino-email-widget h3.widget-title, .widget h3, .tribe-bar-collapse #tribe-bar-collapse-toggle.tribe-bar-collapse-toggle-full-width, #tribe-bar-form label, .tribe-events-list-separator-month span, h4.entry-title, .page-title, .post .title, .page .title, .tribe-events-calendar thead th, #tribe-events-content .tribe-events-calendar div[id*=tribe-events-event-] h3.tribe-events-month-event-title, .rhino-event-series-title, .nav-toggle a, .responsive-tabs__list__item { ';
		$rhino_output .= rhino_generate_font_css( 'rhino_header_font', 'font-face' );
		$rhino_output .= "\n}\n";

		if ( $woo_options['woo_font_h1'] )
			$rhino_output .= 'h1, .page-title, .post .title, .page .title { color: ' . (is_string($woo_options['woo_font_h1']) ? $woo_options['woo_font_h1'] : $woo_options['woo_font_h1']['color']) . '; }' . "\r\n";

		if ( $woo_options['woo_font_h2'] )
			$rhino_output .= 'h2, .entry h2 { color: ' . (is_string($woo_options['woo_font_h2']) ? $woo_options['woo_font_h2'] : $woo_options['woo_font_h2']['color']) . '; }' . "\r\n";

		if ( $woo_options['woo_font_h3'] )
			$rhino_output .= 'h3, .entry h3, #home-widget-container-main h3, #home-widget-container-main h3.widget-title { color: ' . (is_string($woo_options['woo_font_h3']) ? $woo_options['woo_font_h3'] : $woo_options['woo_font_h3']['color']) . '; }' . "\r\n";

		if ( $woo_options['woo_font_h4'] )
			$rhino_output .= 'h4, .entry h4 { color: ' . (is_string($woo_options['woo_font_h4']) ? $woo_options['woo_font_h4'] : $woo_options['woo_font_h4']['color']) . '; }' . "\r\n";

		if ( $woo_options['woo_font_h5'] )
			$rhino_output .= 'h5, .entry h5 { color: ' . (is_string($woo_options['woo_font_h5']) ? $woo_options['woo_font_h5'] : $woo_options['woo_font_h5']['color']) . '; }' . "\r\n";

		if ( $woo_options['woo_font_h6'] )
			$rhino_output .= 'h6, .entry h6 { color: ' . (is_string($woo_options['woo_font_h6']) ? $woo_options['woo_font_h6'] : $woo_options['woo_font_h6']['color']) . '; }' . "\r\n";

		// Body Fonts
		$rhino_output .= 'body, h5, h6, p, ul, li, ol, .entry, .entry p, p.rhino-event-tagline, .rhino-event-details, p.rhino-event-date, p.rhino-event-time, p.rhino-event-price, .rhino-event-more-info, .rhino-event-datebox-day p, .rhino-slide-details, input, textarea, keygen, select, p.rhino-email-details, .rhino-header, .rhino-header-right, .rhino-header-left, p.rhino-header-phone, p.rhino-header-email, p.rhino-header-address, a.rhino-footer-phone-link, a.rhino-footer-email-link, a.rhino-footer-address-link, #tribe-bar-form input[type=text], .rhino-email-widget .mc-field-group input.email, .widget p { ';
	  	$rhino_output .= rhino_generate_font_css( 'rhino_body_font', 'font-face' );
		$rhino_output .= "\n}\n";

		$rhino_output .= 'body, p, ul, li, ol, .entry, .entry p, p.rhino-event-tagline, .rhino-event-details, p.rhino-event-date, p.rhino-event-time, .rhino-event-more-info, .rhino-event-datebox-day p, .rhino-slide-details, input, textarea, keygen, select, p.rhino-email-details, .rhino-header, .rhino-header-right, .rhino-header-left, p.rhino-header-phone, p.rhino-header-email, p.rhino-header-address, a.rhino-footer-phone-link, a.rhino-footer-email-link, a.rhino-footer-address-link, #tribe-bar-form input[type=text], #top ul.nav > li a:hover { ';
	  	$rhino_output .= rhino_generate_font_css( 'rhino_body_font', 'color' );
		$rhino_output .= "\n}\n";

		$rhino_output .= 'html * { ';
	  	$rhino_output .= rhino_generate_font_css( 'rhino_body_font', 'font-size' );
		$rhino_output .="\n!important }\n";

		if ( $woo_options['woo_link_color'] )
			$rhino_output .= 'body a:link, body.page a:link, body a:visited, body.page a:visited { color: ' . $woo_options['woo_link_color'] . '; }' . "\r\n";

		// Button Fonts
		$rhino_output .= '.button, .rhino-email-widget #mc_embed_signup .mc-field-group #mc_embed_signup input.button.large.email, .rhino-email-widget #mc_embed_signup .mc-field-group input[type=submit], #tribe-bar-form .tribe-bar-submit input[type=submit], #tribe-events .tribe-events-button, a.button, a.comment-reply-link, #commentform #submit, .submit, input[type=submit], input.button, button.button, #wrapper .woo-sc-button, span.coming-soon, span.sold-out, span.free, span.off-sale, p.tribe-events-widget-link a { ';
	  	$rhino_output .= rhino_generate_font_css( 'rhino_button_font', 'font-face', true );
		$rhino_output .= ( $woo_options['rhino_uppercase_cta'] == 'true' ) ? " text-transform: uppercase !important;" : '';
		$rhino_output .= "\n}\n";

		// Header Fonts
		if ( $woo_options['rhino_header_contact_info_font'] )
			$rhino_output .= 'a.rhino-header-phone-link, a.rhino-header-email-link, a.rhino-header-address-link, #header-container #header .rhino-header-right ul.rhino-contact-info li, #header-container #header .rhino-header-right ul.rhino-contact-info li a, #header-container #header .rhino-header-right ul.rhino-contact-info li img, #header-container #header .rhino-header-right ul.rhino-contact-info li .svg { color: ' . $woo_options['rhino_header_contact_info_font'] . '; fill: ' . $woo_options['rhino_header_contact_info_font'] . '; }' . "\r\n";

		if ( $woo_options['rhino_header_contact_info_link_hover_color'] )
			$rhino_output .= 'a.rhino-header-phone-link:hover, .rhino-social ul.rhino-social-icons li.rhino-social-icon a:hover, .rhino-social-icons a:hover, a.rhino-header-email-link:hover, a.rhino-header-address-link:hover, #header-container #header .rhino-header-right ul.rhino-contact-info li a:hover, #header-container #header .rhino-header-right ul.rhino-contact-info li a img:hover, #header-container #header .rhino-header-right ul.rhino-contact-info li a .svg:hover { color: ' . $woo_options['rhino_header_contact_info_link_hover_color'] . '; }' . "\r\n";

		if ( $woo_options['rhino_header_social_icon_size'] )
			$rhino_output .= 'p.rhino-header-social a { font-size: ' . trim( $woo_options['rhino_header_social_icon_size'] ) . 'px; } ' . "\n";

		if ( $woo_options['rhino_header_social_icon_size'] )
			$rhino_output .= '#header-container #header .rhino-header .rhino-social ul.rhino-social-icons li.rhino-social-icon { width: ' . trim( $woo_options['rhino_header_social_icon_size'] ) . 'px; height: ' . trim( $woo_options['rhino_header_social_icon_size'] ) . 'px; } ' . "\n";

		if ( $woo_options['rhino_uppercase_headers'] == 'true' )
			$rhino_output .= "h1, .page-title, .post .title, .page .title, h2, .entry h2, h3 .entry, h3, h4, .entry h4, h5, .entry h5, h6, .entry h6 { text-transform: uppercase !important; } \n";

		// Meteor Slides Fonts
		if ( $woo_options['rhino_slide_font'] )
			$rhino_output .= 'a.rhino-slide-header, h3.rhino-slide-title, .widget_meteor-slides-widget #meteor-slideshow a h3.rhino-slide-title, .widget_meteor-slides-widget #meteor-slideshow h3.rhino-slide-title, .widget_meteor-slides-widget #meteor-slideshow a, p.rhino-slide-description, .rhino-slide-details, .rhino-slide-details p.rhino-event-date, .rhino-slide-details p.rhino-event-time, .rhino-event-series-date, .rhino-event-series-time  { color: ' . $woo_options['rhino_slide_font'] . '; }' . "\r\n";

		if ( $woo_options['rhino_slide_hover_font'] )
			$rhino_output .= 'a.rhino-slide-header, h3.rhino-slide-title:hover, .widget_meteor-slides-widget #meteor-slideshow a h3.rhino-slide-title:hover { color: ' . $woo_options['rhino_slide_hover_font'] . '; }' . "\r\n";

		// Email Fonts
		if ( $woo_options['rhino_email_header_font'] )
			$rhino_output .= '.rhino-email-widget h3.widget-title, .rhino-widget-below-nav .rhino-email-widget h3.widget-title { color: ' . $woo_options['rhino_email_header_font'] . '; }' . "\r\n";

		if ( $woo_options['rhino_email_details_font'] )
			$rhino_output .= '.rhino-email-widget p.rhino-email-details, .rhino-widget-below-nav .rhino-email-widget p.rhino-email-details { color: ' . $woo_options['rhino_email_details_font'] . '; }' . "\r\n";

		if ( $woo_options['rhino_email_input_font'] )
			$rhino_output .= '.rhino-email-widget .mc-field-group input.email, .rhino-widget-below-nav .rhino-email-widget .mc-field-group input.email { color: ' . $woo_options['rhino_email_input_font'] . '; }' . "\n";

		// Events Fonts
		if ( $woo_options['rhino_datebox_month_font'] )
			$rhino_output .= '.rhino-event-datebox-month p { color: ' . $woo_options['rhino_datebox_month_font'] . '; }' . "\r\n";

		if ( $woo_options['rhino_datebox_date_font'] )
			$rhino_output .= '.rhino-event-datebox-date p { color: ' . $woo_options['rhino_datebox_date_font'] . '; }' . "\r\n";

		if ( $woo_options['rhino_datebox_day_font'] )
			$rhino_output .= '.rhino-event-datebox-day p { color: ' . $woo_options['rhino_datebox_day_font'] . '; }' . "\r\n";

		if ( $woo_options['rhino_events_tagline_font'] )
			$rhino_output .= '.rhino-event-tagline { color: ' . $woo_options['rhino_events_tagline_font'] . '!important; }' . "\r\n";

		if ( $woo_options['rhino_events_header_font'] )
			$rhino_output .= 'body h2.rhino-event-header a, body .rhino-event-header a, .widget.tribe-events-list-widget h2.rhino-event-header a, #tribe-bar-form .tribe-bar-submit input[type=submit], h4.entry-title, #tribe-bar-form label, .rhino-event-series-title a, #tribe-events #tribe-events-content.tribe-events-month #rhp-calendar-sidebar .tribe-events-tooltip a h4 { color: ' . $woo_options['rhino_events_header_font'] . '; }' . "\r\n";

		if ( $woo_options['rhino_events_header_font'] )
			$rhino_output .= '#st-accordion a.button.st-toggle, a.rhino-event-rsvp { color: ' . $woo_options['rhino_events_header_font'] . ' !important; }' . "\r\n";

		if ( $woo_options['rhino_events_subheader_font'] )
			$rhino_output .= 'h3.rhino-event-subheader, .widget h3.rhino-event-subheader, .tribe-events-list-separator-month span { color: ' . $woo_options['rhino_events_subheader_font'] . '; }' . "\r\n";

		if ( $woo_options['rhino_events_details_font'] )
			$rhino_output .= '.rhino-event-details, p.rhino-event-date, p.rhino-event-time, p.rhino-event-venue, p.rhino-event-price, p.rhino-event-notes, #tribe-events .tribe-events-content p, .tribe-events-after-html p, .tribe-events-before-html p, .tribe-events-tooltip p.entry-summary, #tribe-bar-form input[type=text], .rhino-event-series-date, .rhino-event-series-time { color: ' . $woo_options['rhino_events_details_font'] . '; }' . "\r\n";

		if ( $woo_options['rhino_share_font'] )
			$rhino_output .= '.rhino-event-share p { color: ' . $woo_options['rhino_share_font'] . '; }' . "\r\n";

		// Footer Fonts
		if ( $woo_options['rhino_footer_contact_info_font'] )
			$rhino_output .= 'a.rhino-footer-phone-link, a.rhino-footer-email-link, a.rhino-footer-address-link, #copyright p { color: ' . $woo_options['rhino_footer_contact_info_font'] . '; }' . "\r\n";

		if ( $woo_options['rhino_footer_contact_info_link_hover_color'] )
			$rhino_output .= 'a.rhino-footer-phone-link:hover, a.rhino-footer-email-link, a.rhino-footer-address-link:hover { color: ' . $woo_options['rhino_footer_contact_info_link_hover_color'] . '; }' . "\r\n";

		if ( $woo_options['rhino_footer_social_icon_size'] )
			$rhino_output .= 'p.rhino-footer-social a { font-size: ' . trim( $woo_options['rhino_footer_social_icon_size'] ) . 'px; } ' . "\n";

		if ( $woo_options['rhino_footer_social_icon_color'] )
			$rhino_output .= 'p.rhino-footer-social a { color: ' . $woo_options['rhino_footer_social_icon_color'] . '; }' . "\r\n";

		if ( $woo_options['rhino_footer_social_icon_hover_color'] )
			$rhino_output .= 'p.rhino-footer-social a:hover { color: ' . $woo_options['rhino_footer_social_icon_hover_color'] . '; }' . "\r\n";

		// And output
		echo "<!-- Rhino Custom Typography -->\n<style type=\"text/css\">\n" . $rhino_output . "</style>\n\n";

	} // End rhino_custom_typography

} // End if

/**
 * Outputs all the custom font options into CSS syntax.
 *
 * @since  	1.0.0
 * @package Rhino
 * @author 	Rockhouse
 */

if ( !function_exists( 'rhino_generate_font_css' ) ) {
	function rhino_generate_font_css( $opt, $css_attribute, $important = false ) {

		global $woo_options;

		$css = '';
		$force = $important ? '!important' : '';
		switch( $css_attribute ) {
			case 'font-face':
				$attr = empty($woo_options[$opt]['face']) ? $woo_options['rhino_font_fallback']['face'] : $woo_options[$opt]['face'];
				$css = 'font-family: \''.stripslashes($attr).'\', arial, sans-serif '.$force.';';
				break;

			case 'color':
				$attr = empty($woo_options[$opt]['color']) ? $woo_options['rhino_font_fallback']['color'] : $woo_options[$opt]['color'];
				$css = 'color: ' . $attr . $force .';';
				break;

			case 'font-size':
				$attrs = empty($woo_options[$opt]['size']) ? $woo_options['rhino_font_fallback']['size'] : $woo_options[$opt]['size'];
				$attru = empty($woo_options[$opt]['unit']) ? $woo_options['rhino_font_fallback']['unit'] : $woo_options[$opt]['unit'];
				$css = 'font-size: ' . $attrs . $attru . $force . ';';
				break;

			case 'font-weight':
				$attr = empty($woo_options[$opt]['style']) ? $woo_options['rhino_font_fallback']['style'] : $woo_options[$opt]['style'];
				$style = explode(' ',$attr);
				if( is_numeric($style[0]) )
					$css = 'font-weight: ' . $style[0] . $force . ';';
				break;

			case 'font-style':
				$attr = empty($woo_options[$opt]['style']) ? $woo_options['rhino_font_fallback']['style'] : $woo_options[$opt]['style'];
				$style = explode(' ',$attr);
				if( count($style) > 1 )
					$css = 'font-style: ' . $style[1] . $force . ';';
				break;
		}

		return $css;

	} // End rhino_generate_font_css()

} // End if
