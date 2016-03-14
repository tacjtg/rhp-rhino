<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Add Custom Options
 *
 * Add custom options for this Child Theme.  This is a theme convention for Canvas to use
 * the 'woo_options_add' function name instead of an action.
 *
 * @since  	1.0.0
 * @return 	array
 * @author 	Rockhouse
 */


// Modifications to the Woo Settings panel
function woo_options_add( $options ) {
	// Use our custom options from below
	return rhino_wooopts_array();
}


/**
 * Woo Framework Compatible option set for Rhino, completely replacing
 * the defaults of Canvas / Uno
 *
 * @return array
 */
function rhino_wooopts_array() {
	return
array(

	// General heading
	array(
		'name' => 'Settings',
		'icon' => 'general',
		'type' => 'heading'
	),
			array(
				'name' => 'Custom Logo',
				'desc' => 'Upload a logo for your theme, or specify an image URL directly.',
				'id' => 'woo_logo',
				'std' => '',
				'type' => 'upload'
			),
			array(
				'name' => 'Custom Favicon',
				'desc' => 'Upload a 16px x 16px Png/Gif image that will represent your website\'s favicon.',
				'id' => 'woo_custom_favicon',
				'std' => '',
				'type' => 'upload'
			),
			array(
				'name' => 'General Styles',
				'type' => 'subheading'
			),
			array(
				'name' => 'Background Options',
				'id' => 'woo_background_notice',
				'desc' => 'Background options can also be set in <a href="/wp-admin/customize.php">Appearance > Customize</a>. The options on that page <strong>override</strong> the background options bellow.',
				'type' => 'info'
			),
			array(
				'name' => 'Background Color',
				'desc' => 'Pick a custom color for site background or add a hex color code e.g. #e6e6e6',
				'id' => 'woo_style_bg',
				'std' => '',
				'type' => 'color'
			),
			array(
				'name' => 'Background Image',
				'desc' => 'Upload a background image, or specify the image address of your image. (http://yoursite.com/image.png)',
				'id' => 'woo_style_bg_image',
				'std' => '',
				'type' => 'upload'
			),
			array(
				'name' => 'Background Image Repeat',
				'desc' => 'Select how you want your background image to display.',
				'id' => 'woo_style_bg_image_repeat',
				'type' => 'select',
				'options' =>
				array(
					'No Repeat' => 'no-repeat',
					'Repeat' => 'repeat',
					'Repeat Horizontally' => 'repeat-x',
					'Repeat Vertically' => 'repeat-y'
				)
			),
			array(
				'name' => 'Background Image Position',
				'desc' => 'Select how you would like to position the background',
				'id' => 'woo_style_bg_image_pos',
				'std' => 'top left',
				'type' => 'select',
				'options' =>
				array(
					0 => 'top left',
					1 => 'top center',
					2 => 'top right',
					3 => 'center left',
					4 => 'center center',
					5 => 'center right',
					6 => 'bottom left',
					7 => 'bottom center',
					8 => 'bottom right'
				)
			),
			array(
				'name' => 'Background Attachment',
				'desc' => 'Select whether the background should be fixed or move when the user scrolls',
				'id' => 'woo_style_bg_image_attach',
				'std' => 'scroll',
				'type' => 'select',
				'options' =>
				array(
					0 => 'scroll',
					1 => 'fixed'
				)
			),
			array(
				'name' => 'Top Border',
				'desc' => 'Specify border properties for the top border.',
				'id' => 'woo_border_top',
				'std' =>
				array(
					'width' => '0',
					'style' => 'solid',
					'color' => '#000000',
				),
				'type' => 'border'
			),
			array(
				'name' => 'General Border Color',
				'desc' => 'Pick a custom color for general border colors or add a hex color code e.g. #e6e6e6',
				'id' => 'woo_style_border',
				'std' => '',
				'type' => 'color'
			),


			array(
				'name' => 'Custom Styling Options',
				'type' => 'subheading'
			),

			array(
				'name' => 'Google Analytics',
				'type' => 'subheading'
			),
			array(
				'name' => 'Tracking Code',
				'desc' => 'Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.',
				'id' => 'woo_google_analytics',
				'std' => '',
				'type' => 'textarea'
			),

	// Layout heading
	array(
		'name' => 'Layout',
		'icon' => 'general',
		'type' => 'heading'
	),
			array(
				'name' => 'Layout Manager',
				'desc' => '',
				'id' => 'woo_layout_manager_notice',
				'std' => 'Below you can set the general site width and layout. To control the width of the columns in your themes layout, please visit the <a href="/wp-admin/admin.php?page=woo-layout-manager">Layout Manager</a>.',
				'type' => 'info'
			),
			array(
				'name' => 'Site Width',
				'desc' => 'Set the width (in px) that you would like your content column to be (recommended max-width is 1600px)',
				'id' => 'woo_layout_width',
				'std' => '960',
				'min' => '600',
				'max' => '1600',
				'increment' => '10',
				'type' => 'slider'
			),
			array(
				'name' => 'Main Layout',
				'desc' => 'Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.',
				'id' => 'woo_layout',
				'std' => 'two-col-left',
				'type' => 'images',
				'options' =>
				array(
					'one-col' => '/wp-content/themes/canvas/functions/images/1c.png',
					'two-col-left' => '/wp-content/themes/canvas/functions/images/2cl.png',
					'two-col-right' => '/wp-content/themes/canvas/functions/images/2cr.png',
					'three-col-left' => '/wp-content/themes/canvas/functions/images/3cl.png',
					'three-col-middle' => '/wp-content/themes/canvas/functions/images/3cm.png',
					'three-col-right' => '/wp-content/themes/canvas/functions/images/3cr.png',
				)
			),
			array(
				'name' => 'Footer Widget Areas',
				'desc' => 'Select how many footer widget areas you want to display.',
				'id' => 'woo_footer_sidebars',
				'std' => '4',
				'type' => 'images',
				'options' =>
				array(
					0 => '/wp-content/themes/canvas/functions/images/footer-widgets-0.png',
					1 => '/wp-content/themes/canvas/functions/images/footer-widgets-1.png',
					2 => '/wp-content/themes/canvas/functions/images/footer-widgets-2.png',
					3 => '/wp-content/themes/canvas/functions/images/footer-widgets-3.png',
					4 => '/wp-content/themes/canvas/functions/images/footer-widgets-4.png',
				)
			),
			array(
				'name' => 'Tabbed Widgets on Homepage',
				'desc' => 'Check this to display the main Homepage Widgest as tabs instead of blocks.',
				'id' => 'rhino_homepage_tabbed',
				'std' => 'false',
				'type' => 'checkbox'
			),


	// Typography heading
	array(
		'name' => 'Typography',
		'icon' => 'general',
		'type' => 'heading'
	),
			array(
				'name' => 'Body Font',
				'id' => 'rhino_body_font',
				'desc' => 'Body font size impacts how all fonts on the site display. Default and optimal size is 14px. Use this option carefully.',
				'default' =>
				array(
					'face' => 'Helvetica',
					'size' => '14',
					'unit' => 'px',
					'style' => '400 normal',
					'color' => '#000',
				),
				'type' => 'typography',
			),
			array(
				'name' => 'Header Font',
				'id' => 'rhino_header_font',
				'type' => 'typography',
			),
			array(
				'name'  => 'Uppercase Headers Text',
				'id'    => 'rhino_uppercase_headers',
				'type'  => 'checkbox'
			),
			array(
				'name' => 'Button Font',
				'id' => 'rhino_button_font',
				'type' => 'typography',
			),
			array(
				'name'  => 'Uppercase Button Text',
				'id'    => 'rhino_uppercase_cta',
				'type'  => 'checkbox'
			),
			array(
				'name' => 'Link Color',
				'desc' => 'Pick a custom color for links.',
				'id' => 'woo_link_color',
				'std' => '',
				'type' => 'color'
			),
			array(
				'name' => 'Link Hover Color',
				'desc' => 'Pick a custom color for links hover.',
				'id' => 'woo_link_hover_color',
				'std' => '',
				'type' => 'color'
			),
			array(
				'name' => 'H1 Font Color',
				'desc' => 'Select the color you want for header H1.',
				'id' => 'woo_font_h1',
				'std' =>
				array(
					'size' => '28',
					'unit' => 'px',
					'face' => 'Helvetica, Arial, sans-serif',
					'style' => 'bold',
					'color' => '#222222',
				),
				'type' => 'color'
			),
			array(
				'name' => 'H2 Font Color',
				'desc' => 'Select the color you want for header H2.',
				'id' => 'woo_font_h2',
				'std' =>
				array(
					'size' => '24',
					'unit' => 'px',
					'face' => 'Helvetica, Arial, sans-serif',
					'style' => 'bold',
					'color' => '#222222',
				),
				'type' => 'color'
			),
			array(
				'name' => 'H3 Font Color',
				'desc' => 'Select the color you want for header H3.',
				'id' => 'woo_font_h3',
				'std' =>
				array(
					'size' => '20',
					'unit' => 'px',
					'face' => 'Helvetica, Arial, sans-serif',
					'style' => 'bold',
					'color' => '#222222',
				),
				'type' => 'color'
			),
			array(
				'name' => 'H4 Font Color',
				'desc' => 'Select the color you want for header H4.',
				'id' => 'woo_font_h4',
				'std' =>
				array(
					'size' => '16',
					'unit' => 'px',
					'face' => 'Helvetica, Arial, sans-serif',
					'style' => 'bold',
					'color' => '#222222',
				),
				'type' => 'color'
			),
			array(
				'name' => 'H5 Font Color',
				'desc' => 'Select the color you want for header H5.',
				'id' => 'woo_font_h5',
				'std' =>
				array(
					'size' => '14',
					'unit' => 'px',
					'face' => 'Helvetica, Arial, sans-serif',
					'style' => 'bold',
					'color' => '#222222',
				),
				'type' => 'color'
			),
			array(
				'name' => 'H6 Font Color',
				'desc' => 'Select the color you want for header H6.',
				'id' => 'woo_font_h6',
				'std' =>
				array(
					'size' => '12',
					'unit' => 'px',
					'face' => 'Helvetica, Arial, sans-serif',
					'style' => 'bold',
					'color' => '#222222',
				),
				'type' => 'color'
			),

	// Buttons heading
	array(
		'name' => 'Buttons',
		'icon' => 'general',
		'type' => 'heading'
	),
			array(
				'name' => 'Buttons Rounded Corners',
				'id' => 'rhino_button_rounded_corners',
				'desc' => 'Please enter a number. Do not include "px".',
				'type' => 'text',
			),
			array(
				'name' => 'Primary (CTA) - Background Color',
				'id' => 'rhino_cta_primary_button_background_color',
				'desc' => 'Primary (CTA) buttons include on-sale and email subscription buttons.',
				'type' => 'color',
			),
			array(
				'name' => 'Primary (CTA) - Background Color:Hover',
				'id' => 'rhino_cta_primary_button_hover_background_color',
				'type' => 'color',
			),
			array(
				'name' => 'Primary (CTA) - Font Color',
				'id' => 'rhino_cta_primary_button_font_color',
				'type' => 'color',
			),
			array(
				'name' => 'Secondary - Background Color',
				'id' => 'rhino_cta_secondary_button_background_color',
				'desc' => 'Secondary buttons include see all events and various other buttons.',
				'type' => 'color',
			),
			array(
				'name' => 'Secondary - Background Color:Hover',
				'id' => 'rhino_cta_secondary_button_hover_background_color',
				'type' => 'color',
			),
			array(
				'name' => 'Secondary - Font Color',
				'id' => 'rhino_cta_secondary_button_font_color',
				'type' => 'color',
			),
			array(
				'name' => 'Tertiary - Background Color',
				'id' => 'rhino_cta_tertiary_button_background_color',
				'desc' => 'Tertiary buttons include off-sale, free show, coming soon, and other inactive buttons.',
				'type' => 'color',
			),
			array(
				'name' => 'Tertiary - Font Color',
				'id' => 'rhino_cta_tertiary_button_font_color',
				'type' => 'color',
			),

	// Header heading
	array(
		'name' => 'Header',
		'icon' => 'general',
		'type' => 'heading'
	),
			array(
				'name' => 'Header Background Color',
				'desc' => 'Pick a custom color for header background.',
				'id' => 'woo_header_bg',
				'std' => '',
				'type' => 'color'
			),
			array(
				'name' => 'Header Background Image',
				'desc' => 'Upload a background image, or specify the image address of your image (http://yoursite.com/image.png).<br/>It is recommended your image should be same width as your site width.',
				'id' => 'woo_header_bg_image',
				'std' => '',
				'type' => 'upload'
			),
			array(
				'name' => 'Header Background Image Repeat',
				'desc' => 'Select how you want your background image to display.',
				'id' => 'woo_header_bg_image_repeat',
				'type' => 'select',
				'options' =>
				array(
					'No Repeat' => 'no-repeat',
					'Repeat' => 'repeat',
					'Repeat Horizontally' => 'repeat-x',
					'Repeat Vertically' => 'repeat-y'
				)
			),
			array(
				'name' => 'Full Width Layout',
				'type' => 'subheading'
			),
			array(
				'name' => 'Enable Full Width Header',
				'desc' => 'Set header container to display full width.',
				'id' => 'woo_header_full_width',
				'std' => 'true',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Full Width Header Background Color',
				'desc' => 'Select the background color you want for your full width header.',
				'id' => 'woo_full_header_full_width_bg',
				'std' => '',
				'type' => 'color'
			),
			array(
				'name' => 'Header Spacing',
				'type' => 'subheading'
			),
			array(
				'name' => 'Header Margin Top/Bottom',
				'desc' => 'Enter an integer value i.e. 20 for the desired header margin.<br />The margin defines the space around elements.',
				'id' => 'woo_header_margin_tb',
				'std' => '',
				'type' =>
				array(
					array(
						'id' => 'woo_header_margin_top',
						'type' => 'text',
						'std' => '0',
						'meta' => 'Top'
					),
					array(
						'id' => 'woo_header_margin_bottom',
						'type' => 'text',
						'std' => '0',
						'meta' => 'Bottom'
					)
				)
			),
			array(
				'name' => 'Header Padding Top/Bottom',
				'desc' => 'Enter an integer value i.e. 20 for the desired header padding.<br />The padding clears an area around the content (inside the border) of an element.',
				'id' => 'woo_header_padding_tb',
				'std' => '',
				'type' =>
				array(
					array(
						'id' => 'woo_header_padding_top',
						'type' => 'text',
						'std' => '40',
						'meta' => 'Top'
					),
					array(
						'id' => 'woo_header_padding_bottom',
						'type' => 'text',
						'std' => '40',
						'meta' => 'Bottom'
					)
				)
			),
			//array(
			//	'name' => 'Header Padding Left/Right',
			//	'desc' => 'Enter an integer value i.e. 20 for the desired header padding.<br />The padding clears an area around the content (inside //the border) of an element.',
			//	'id' => 'woo_header_padding_lr',
			//	'std' => '',
			//	'type' =>
			//	array(
			//		array(
			//			'id' => 'woo_header_padding_left',
			//			'type' => 'text',
			//			'std' => '',
			//			'meta' => 'Left'
			//		),
			//		array(
			//			'id' => 'woo_header_padding_right',
			//			'type' => 'text',
			//			'std' => '',
			//			'meta' => 'Right'
			//		)
			//	)
			//),
			array(
				'name' => 'Header Borders',
				'type' => 'subheading'
			),
			array(
				'name' => 'Header Border - Top',
				'id' => 'woo_header_border',
				'std' =>
				array(
					'width' => '0',
					'style' => 'solid',
					'color' => ''
				),
				'type' => 'border'
			),
			array(
				'name'	=> 'Header Border - Right',
				'id'	=> 'rhino_header_right',
				'default'	=> array(
					'width' => '0',
					'style' => 'solid',
					'color' => ''
				),
				'type'	=> 'border'
			),
			array(
				'name'	=> 'Header Border - Bottom',
				'id'	=> 'rhino_header_bottom',
				'default'	=> array(
						'width' => '0',
						'style' => 'solid',
						'color' => ''
					),
				'type'	=> 'border'
			),
			array(
				'name'	=> 'Header Border - Left',
				'id'	=> 'rhino_header_left',
				'default'	=> array(
					'width' => '0',
					'style' => 'solid',
					'color' => ''
					),
				'type'	=> 'border'
			),
			array(
				'name' => 'Header Contact Info',
				'type' => 'subheading'
			),
			array(
				'name' => 'Header Contact Info Font Color',
				'id' => 'rhino_header_contact_info_font',
				'type' => 'color',
			),
			array(
				'name' => 'Header Contact Info Link Hover Color',
				'id' => 'rhino_header_contact_info_link_hover_color',
				'type' => 'color',
			),
			array(
				'name' => 'Header Social Icon Size',
				'id' => 'rhino_header_social_icon_size',
				'type' => 'text',
			),
			array(
				'name' => 'Header Social Icon Color',
				'id' => 'rhino_header_social_icon_color',
				'type' => 'color',
			),
			array(
				'name' => 'Header Social Icon Hover Color',
				'id' => 'rhino_header_social_icon_hover_color',
				'type' => 'color',
			),

	// Footer heading
	array(
		'name' => 'Footer',
		'icon' => 'general',
		'type' => 'heading'
	),
			array(
				'name' => 'Footer Logo',
				'desc' => 'Upload a logo for your theme, or specify an image URL directly.',
				'id' => 'rhino_footer_logo',
				'std' => '',
				'type' => 'upload'
			),
			array(
				'name' => 'Footer Background',
				'desc' => 'Select the background color you want for your footer.',
				'id' => 'woo_footer_bg',
				'std' => '',
				'type' => 'color'
			),
			array(
				'name' => 'Footer Full Width',
				'type' => 'subheading'
			),
			array(
				'name' => 'Enable Full Width Footer',
				'desc' => 'Set footer widget area and footer container to display full width.',
				'id' => 'woo_footer_full_width',
				'std' => 'true',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Full Width Footer Background Color',
				'desc' => 'Select the background color you want for your full width footer.',
				'id' => 'woo_footer_full_width_bg',
				'type' => 'color'
			),
			array(
				'name' => 'Footer Widget Background Color',
				'desc' => 'Select the background color you want for your full width footer.',
				'id' => 'woo_foot_full_width_widget_bg',
				'type' => 'color'
			),
			array(
				'name' => 'Footer Borders',
				'type' => 'subheading'
			),
			array(
				'name' => 'Footer Border Top',
				'desc' => 'Specify top border properties for the footer.',
				'id' => 'woo_footer_border_top',
				'std' =>
				array(
					'width' => '1',
					'style' => 'solid',
					'color' => '#dbdbdb',
				),
				'type' => 'border'
			),
			array(
				'name' => 'Footer Border Bottom',
				'desc' => 'Specify bottom border properties for the footer.',
				'id' => 'woo_footer_border_bottom',
				'std' =>
				array(
					'width' => '0',
					'style' => 'solid',
					'color' => '',
				),
				'type' => 'border'
			),
			array(
				'name' => 'Footer Border Left/Right',
				'desc' => 'Specify left/right border properties for the footer.',
				'id' => 'woo_footer_border_lr',
				'std' =>
				array(
					'width' => '0',
					'style' => 'solid',
					'color' => '',
				),
				'type' => 'border'
			),
			array(
				'name' => 'Footer Contact Info',
				'type' => 'subheading'
			),
			array(
				'name' => 'Footer Contact Info Font Color',
				'id' => 'rhino_footer_contact_info_font',
				'type' => 'color',
			),
			array(
				'name' => 'Footer Contact Info Link Hover Color',
				'id' => 'rhino_footer_contact_info_link_hover_color',
				'type' => 'color',
			),
			array(
				'name' => 'Footer Social Icon Size',
				'id' => 'rhino_footer_social_icon_size',
				'type' => 'text',
			),
			array(
				'name' => 'Footer Social Icon Color',
				'id' => 'rhino_footer_social_icon_color',
				'type' => 'color',
			),
			array(
				'name' => 'Footer Social Icon Hover Color',
				'id' => 'rhino_footer_social_icon_hover_color',
				'type' => 'color',
			),
			array(
				'name' => 'Rockhouse Logo - Dark Text',
				'id' => 'rhino_rhp_logo_dark',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Footer Custom Content',
				'type' => 'subheading'
			),
			array(
				'name' => 'Enable Custom Footer (Left)',
				'desc' => 'Activate to add the custom text below to the theme footer.',
				'id' => 'woo_footer_left',
				'class' => 'collapsed',
				'std' => 'false',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Custom Text (Left)',
				'desc' => 'Custom HTML and Text that will appear in the footer of your theme.',
				'id' => 'woo_footer_left_text',
				'class' => 'hidden last',
				'std' => '<p></p>',
				'type' => 'textarea'
			),
			array(
				'name' => 'Enable Custom Footer (Right)',
				'desc' => 'Activate to add the custom text below to the theme footer.',
				'id' => 'woo_footer_right',
				'class' => 'collapsed',
				'std' => 'false',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Custom Text (Right)',
				'desc' => 'Custom HTML and Text that will appear in the footer of your theme.',
				'id' => 'woo_footer_right_text',
				'class' => 'hidden last',
				'std' => '<p></p>',
				'type' => 'textarea'
			),

	// Navigation heading
	array(
		'name' => 'Navigation',
		'icon' => 'general',
		'type' => 'heading'
	),
			array(
				'name' => 'Navigation',
				'desc' => 'Set the location of the WordPress Header Menu.',
				'id' => 'rhino_nav_location',
				'std' => 'centered',
				'type' => 'images',
				'options' => array(
								'below' => '/wp-content/themes/rhp-rhino/images/nav-centered.jpg',
								'inside' => '/wp-content/themes/rhp-rhino/images/nav-right.jpg'
							)
			),
			array(
				'name' => 'Sticky Navigation',
				'desc' => 'Make the navigation stick to the top of the page on scroll.',
				'id' => 'rhino_nav_sticky',
				'std' => 'false',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Navigation Background Color',
				'desc' => 'Pick a custom color for the navigation background.<br />If empty, background will be transparent (recommended for navigations floating to the right of the logo).',
				'id' => 'woo_nav_bg',
				'std' => '',
				'type' => 'color'
			),
			// array(
			//	'name' => 'Top Navigation - Background Color',
			//	'desc' => 'Pick a custom color for the top navigation background or add a hex color code e.g. #000.<br />Top Navigation can be added with <a href="/wp-admin/nav-menus.php">WP Menus</a>. If empty, background will be transparent (recommended for navigations floating to the right of the logo).',
			//	'id' => 'woo_top_nav_bg',
			//	'std' => '',
			//	'type' => 'color'
			// ),
			array(
				'name' => 'Main Nav',
				'type' => 'subheading'
			),
			array(
				'name' => 'Navigation Font Color',
				'desc' => 'Select color for navigation fonts.',
				'id' => 'woo_nav_font',
				'std' =>
				array(
					'color' => '#ddd',
				),
				'type' => 'color'
			),
			array(
				'name' => 'Navigation Font Hover Background Color',
				'desc' => 'Select the hover background color for navigation.<br />If empty, background will be transparent.',
				'id' => 'woo_nav_hover_bg',
				'std' =>
				array(
					'color' => 'transparent',
				),
				'type' => 'color'
			),
			array(
				'name' => 'Dropdown Menu',
				'type' => 'subheading'
			),
			array(
				'name' => 'Dropdown Menu Background Color',
				'desc' => 'Pick a custom color for the navigation hover / dropdown menu background color.<br />If empty, background will be transparent.',
				'id' => 'rhino_submenu_bg_color',
				'std' => '',
				'type' => 'color'
			),
			array(
				'name' => 'Navigation Menu Hover Background Color',
				'desc' => 'Select the hover background color for the dropdown menu.<br />If empty, background will be transparent.',
				'id' => 'rhino_submenu_hover_bg_color',
				'std' =>
				array(
					'color' => 'transparent',
				),
				'type' => 'color'
			),
			array(
				'name' => 'Dropdown Menu Border',
				'desc' => 'Specify border properties for the dropdown menu.',
				'id' => 'woo_nav_dropdown_border',
				'std' =>
				array(
					'width' => '0',
					'style' => 'solid',
					'color' => '#dbdbdb',
				),
				'type' => 'border'
			),
			array(
				'name' => 'Navigation Borders',
				'type' => 'subheading'
			),
			array(
				'name' => 'Menu Item Divider',
				'desc' => 'Specify border properties for the menu items dividers.',
				'id' => 'woo_nav_divider_border',
				'std' =>
				array(
					'width' => '0',
					'style' => 'solid',
					'color' => '#dbdbdb',
				),
				'type' => 'border'
			),
			array(
				'name' => 'Border Top',
				'desc' => 'Specify border properties for the navigation.',
				'id' => 'woo_nav_border_top',
				'std' =>
				array(
					'width' => '0',
					'style' => 'solid',
					'color' => '#dbdbdb',
				),
				'type' => 'border'
			),
			array(
				'name' => 'Border Bottom',
				'desc' => 'Specify border properties for the navigation.',
				'id' => 'woo_nav_border_bot',
				'std' =>
				array(
					'width' => '0',
					'style' => 'solid',
					'color' => '#dbdbdb',
				),
				'type' => 'border'
			),
			array(
				'name' => 'Border Left/Right',
				'desc' => 'Specify border properties for the navigation.',
				'id' => 'woo_nav_border_lr',
				'std' =>
				array(
					'width' => '0',
					'style' => 'solid',
					'color' => '#dbdbdb',
				),
				'type' => 'border'
			),
			array(
				'name' => 'Navigation Spacing',
				'type' => 'subheading'
			),
			array(
				'name' => 'Navigation Margin Top/Bottom',
				'desc' => 'Enter an integer value i.e. 20 for the desired header margin.<br />The margin defines the space around elements.',
				'id' => 'woo_nav_margin_tb',
				'std' => '',
				'type' =>
				array(
					array(
						'id' => 'woo_nav_margin_top',
						'type' => 'text',
						'std' => '',
						'meta' => 'Top'
					),
					1 =>
					array(
						'id' => 'woo_nav_margin_bottom',
						'type' => 'text',
						'std' => '',
						'meta' => 'Bottom'
					),
				)
			),

	// Slider heading
	array(
		'name' => 'Slider',
		'icon' => 'general',
		'type' => 'heading'
	),
			array(
				'name' => 'Slider Layout',
				'desc' => 'Select your slider layout.',
				'id' => 'rhino_slider_layout',
				'std' => 'bottom',
				'type' => 'images',
				'options' => array(
								'bottom' 		=> '/wp-content/themes/rhp-rhino/images/slider-bottom.jpg',
								//'left' 			=> '/wp-content/themes/rhp-rhino/images/slider-left.jpg',
								'thumbnails' 	=> '/wp-content/themes/rhp-rhino/images/slider-thumbnails.jpg'
							)
			),
			array(
				'name' => 'Slide Background Color',
				'id' => 'rhino_slide_background_color',
				'type' => 'color',
			),
			array(
				'name' => 'Slider Fonts',
				'type' => 'subheading'
			),
			array(
				'name' => 'Slide Font Color',
				'id' => 'rhino_slide_font',
				'type' => 'color',
			),
			array(
				'name' => 'Slide Font Hover Color',
				'id' => 'rhino_slide_hover_font',
				'type' => 'color',
			),
			array(
				'name' => 'Slider Borders',
				'type' => 'subheading'
			),
			array(
				'name' => 'Slide Border-Top',
				'id' => 'rhino_slide_border_top',
				'type' => 'border',
			),
			array(
				'name' => 'Slide Border-Right',
				'id' => 'rhino_slide_border_right',
				'type' => 'border',
			),
			array(
				'name' => 'Slide Border-Bottom',
				'id' => 'rhino_slide_border_bottom',
				'type' => 'border',
			),
			array(
				'name' => 'Slide Border-Left',
				'id' => 'rhino_slide_border_left',
				'type' => 'border',
			),

	// Events heading
	array(
		'name' => 'Events',
		'icon' => 'general',
		'type' => 'heading'
	),
			array(
				'name'	=> 'Default Event Image',
				'id'	=> 'rhino_default_event_image',
				'type'	=> 'upload'
			),
			array(
				'name' => 'Tribe Events Color Override',
				'id' => 'rhino_tribe_override_color',
				'type' => 'color',
			),
			array(
				'name' => 'Events Box Background',
				'id' => 'rhino_events_box_background',
				'type' => 'color',
			),
			array(
				'name' => 'Font Colors',
				'type' => 'subheading'
			),
			array(
				'name' => 'Events Header Font Color',
				'id' => 'rhino_events_header_font',
				'type' => 'color',
			),
			array(
				'name' => 'Events Header Font Hover Color',
				'id' => 'rhino_events_header_font_hover_color',
				'type' => 'color',
			),
			array(
				'name' => 'Events Pre-Header Font Color',
				'id' => 'rhino_events_tagline_font',
				'type' => 'color',
			),
			array(
				'name' => 'Events Subheader Font Color',
				'id' => 'rhino_events_subheader_font',
				'type' => 'color',
			),
			array(
				'name' => 'Events Date/Time/Price Font Color',
				'id' => 'rhino_events_details_font',
				'type' => 'color',
			),
			array(
				'name' => 'Share Font Color',
				'id' => 'rhino_share_font',
				'type' => 'color',
			),
			array(
				'name' => 'Borders',
				'type' => 'subheading'
			),
			array(
				'name' => 'Events Box Bottom Border',
				'id' => 'rhino_events_box_bottom_border',
				'type' => 'border',
			),
			array(
				'name' => 'Events Box Rounded Corners',
				'id' => 'rhino_events_box_rounded_corners',
				'desc' => 'Please enter a number.',
				'type' => 'text',
			),
			array(
				'name' => 'Datebox',
				'type' => 'subheading'
			),
			array(
				'name' => 'Datebox Rounded Corners',
				'id' => 'rhino_datebox_rounded_corners',
				'desc' => 'Please enter a number.',
				'type' => 'text',
			),
			array(
				'name' => 'Datebox Month Background Color',
				'id' => 'rhino_datebox_month_background_color',
				'type' => 'color',
			),
			array(
				'name' => 'Datebox Month Font Color',
				'id' => 'rhino_datebox_month_font',
				'type' => 'color',
			),
			array(
				'name' => 'Datebox Date Background Color',
				'id' => 'rhino_datebox_date_background_color',
				'type' => 'color',
			),
			array(
				'name' => 'Datebox Date Font Color',
				'id' => 'rhino_datebox_date_font',
				'type' => 'color',
			),
			array(
				'name' => 'Datebox Day Background Color',
				'id' => 'rhino_datebox_day_background_color',
				'type' => 'color',
			),
			array(
				'name' => 'Datebox Day Font Color',
				'id' => 'rhino_datebox_day_font',
				'type' => 'color',
			),
			array(
				'name' => 'Sharing',
				'type' => 'subheading'
			),
			array(
				'name' => 'AddThis Publisher ID',
				'id' => 'rhino_events_addthis_pubid',
				'type' => 'text',
			),
			array(
				'name' => 'Events Listing SEO Title',
				'type' => 'subheading'
			),
			array(
				'name' => 'Yoast Events Archive Title',
				'id' => 'rhino_events_listing_title',
				'desc' => 'Override for the Yoast SEO Title for the Events Archive. When empty <br/>this defaults to <b>Upcoming Events %%sep%% %%sitename%%</b>',
				'default' => 'Upcoming Events %%sep%% %%sitename%%',
				'type' => 'text',
			),
	// Pages Heading
	array(
		'name' => 'Pages',
		'icon' => 'general',
		'type' => 'heading'
	),
			array(
				'name' 	=> 'Events Homepage Title Text',
				'id' 	=> 'rhino_homepage_title_text',
				'type' 	=> 'text',
			),
			array(
				'name' 	=> 'Events See All Events Button Text',
				'id' 	=> 'rhino_see_all_events_button_text',
				'type'	=> 'text',
				'std'	=> 'See All Events',
			),
			array(
				'name' 	=> 'Events on the Homepage',
				'desc' 	=> 'How many events would you like to display on the homepage?',
				'id' 	=> 'rhino_events_homepage_number',
				'type' 	=> 'text',
			),
			array(
				'name' => 'Custom 404 Text',
				'id' => 'rhino_custom_404_text',
				'type' => 'textarea',
				'std' => 'You may have clicked a link that is inactive or we led you astray. Never fear! Use the menu above to find what you are looking for, or you can view events by starting below.',
			),

	// Posts heading
	// array(
	// 	'name' => 'Posts',
	//	'icon' => 'general',
	//	'type' => 'heading'
	// ),

			array(
				'name' => 'Sub Menu Text Color',
				'id' => 'rhino_subnav_hover',
				'default' => '',
				'type' => 'color',
			),
			array(
				'name' => 'Sub Menu Background Color',
				'id' => 'rhino_subnav_hover_bg',
				'default' => '',
				'type' => 'color',
			),
			array(
				'name' => 'Post Meta Font Style',
				'desc' => 'Specify typography for post meta.',
				'id' => 'woo_font_post_meta',
				'std' =>
				array(
					'size' => '12',
					'unit' => 'px',
					'face' => 'Helvetica, Arial, sans-serif',
					'style' => 'thin',
					'color' => '#999999'
				),
				'type' => 'color'
			),
			array(
				'name' => 'Post/Page Text Font Style',
				'desc' => 'Specify typography for post/page content text.',
				'id' => 'woo_font_post_text',
				'std' =>
				array(
					'size' => '15',
					'unit' => 'px',
					'face' => 'Helvetica, Arial, sans-serif',
					'style' => '300',
					'color' => '#555555'
				),
				'type' => 'color'
			),
			array(
				'name' => 'Post More (bottom) Font Style',
				'desc' => 'Specify typography for post bottom text.',
				'id' => 'woo_font_post_more',
				'std' =>
				array(
					'size' => '13',
					'unit' => 'px',
					'face' => 'Helvetica, Arial, sans-serif',
					'style' => 'thin',
					'color' => ''
				),
				'type' => 'color'
			),
			array(
				'name' => 'Page Navigation Font Style',
				'desc' => 'Select typography for Page Navigation text.',
				'id' => 'woo_pagenav_font',
				'std' =>
				array(
					'size' => '13',
					'unit' => 'px',
					'face' => 'Helvetica, Arial, sans-serif',
					'style' => 'thin',
					'color' => '#888'
				),
				'type' => 'color'
			),
			array(
				'name' => 'Archive Header Font Style',
				'desc' => 'Select typography for Archive header.',
				'id' => 'woo_archive_header_font',
				'std' =>
				array(
					'size' => '18',
					'unit' => 'px',
					'face' => 'Arial, sans-serif',
					'style' => 'bold',
					'color' => '#222222',
				),
				'type' => 'color'
			),
			array(
				'name' => 'Post More (bottom) Border Top',
				'desc' => 'Specify border properties for post more section.',
				'id' => 'woo_post_more_border_top',
				'std' =>
				array(
					'width' => '0',
					'style' => 'solid',
					'color' => '#e6e6e6'
				),
				'type' => 'border'
			),
			array(
				'name' => 'Post More (bottom) Border Bottom',
				'desc' => 'Specify border properties for post more section.',
				'id' => 'woo_post_more_border_bottom',
				'std' =>
				array(
					'width' => '0',
					'style' => 'solid',
					'color' => '#e6e6e6'
				),
				'type' => 'border'
			),
			array(
				'name' => 'Post Author Background Color',
				'desc' => 'Pick a custom background color for the post author section or add a hex color code e.g. #fafafa',
				'id' => 'woo_post_author_bg',
				'std' => '#fafafa',
				'type' => 'color'
			),
			array(
				'name' => 'Post Author Border Top',
				'desc' => 'Specify border properties for post author section.',
				'id' => 'woo_post_author_border_top',
				'std' =>
				array(
					'width' => '1',
					'style' => 'solid',
					'color' => '#e6e6e6'
				),
				'type' => 'border'
			),
			array(
				'name' => 'Post Author Border Bottom',
				'desc' => 'Specify border properties for post author section.',
				'id' => 'woo_post_author_border_bottom',
				'std' =>
				array(
					'width' => '1',
					'style' => 'solid',
					'color' => '#e6e6e6'
				),
				'type' => 'border'
			),
			array(
				'name' => 'Post Author Border Left/Right',
				'desc' => 'Specify border properties for the navigation.',
				'id' => 'woo_post_author_border_lr',
				'std' =>
				array(
					'width' => '1',
					'style' => 'solid',
					'color' => '#e6e6e6'
				),
				'type' => 'border'
			),
			array(
				'name' => 'Post Author Rounded Corners',
				'desc' => 'Set amount of pixels for border radius (rounded corners). Will only show in CSS3 compatible browser.',
				'id' => 'woo_post_author_border_radius',
				'type' => 'select',
				'std' => '5px',
				'options' =>
				array(
					0 => '0px',
					1 => '1px',
					2 => '2px',
					3 => '3px',
					4 => '4px',
					5 => '5px',
					6 => '6px',
					7 => '7px',
					8 => '8px',
					9 => '9px',
					10 => '10px',
					11 => '11px',
					12 => '12px',
					13 => '13px',
					14 => '14px',
					15 => '15px',
					16 => '16px',
					17 => '17px',
					18 => '18px',
					19 => '19px',
					20 => '20px'
				)
			),
			array(
				'name' => 'Disable Post Author',
				'desc' => 'Disable post author below post?',
				'id' => 'woo_disable_post_author',
				'std' => 'false',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Comments Background Color (even threads)',
				'desc' => 'Pick a custom background color for the post comments even threads or add a hex color code e.g. #fafafa',
				'id' => 'woo_post_comments_bg',
				'std' => '',
				'type' => 'color'
			),
			array(
				'name' => 'Page Navigation Background Color',
				'desc' => 'Pick a custom color for the Page Navigation background or add a hex color code e.g. #fafafa',
				'id' => 'woo_pagenav_bg',
				'std' => '',
				'type' => 'color'
			),
			array(
				'name' => 'Page Navigation Border Top',
				'desc' => 'Specify border properties for Page Navigation section.',
				'id' => 'woo_pagenav_border_top',
				'std' =>
				array(
					'width' => '0',
					'style' => 'solid',
					'color' => '#e6e6e6'
				),
				'type' => 'border'
			),
			array(
				'name' => 'Page Navigation Border Bottom',
				'desc' => 'Specify border properties for Page Navigation section.',
				'id' => 'woo_pagenav_border_bottom',
				'std' =>
				array(
					'width' => '0',
					'style' => 'solid',
					'color' => '#e6e6e6',
				),
				'type' => 'border'
			),
			array(
				'name' => 'Archives',
				'type' => 'subheading'
			),
			array(
				'name' => 'Archive Header Border Bottom',
				'desc' => 'Specify border properties for Archive header',
				'id' => 'woo_archive_header_border_bottom',
				'std' =>
				array(
					'width' => '1',
					'style' => 'solid',
					'color' => '#e6e6e6',
				),
				'type' => 'border'
			),
			array(
				'name' => 'Disable Archive Header RSS link',
				'desc' => 'Disable RSS link in Archive header',
				'id' => 'woo_archive_header_disable_rss',
				'std' => 'false',
				'type' => 'checkbox'
			),

	// Widgets heading
	array(
		'name' => 'Widgets',
		'icon' => 'general',
		'type' => 'heading'
	),
			array(
				'name' => 'Widget Background Color',
				'desc' => 'Pick a custom color for the widget background.',
				'id' => 'woo_widget_bg',
				'std' => '',
				'type' => 'color'
			),
			array(
				'name' => 'Widget Fonts',
				'type' => 'subheading'
			),
			array(
				'name' => 'Widget Text',
				'desc' => 'Select the color you want for the widget text.',
				'id' => 'woo_widget_font_text',
				'std' =>
				array(
					'size' => '14',
					'unit' => 'px',
					'face' => 'Helvetica, Arial, sans-serif',
					'style' => 'thin',
					'color' => '#555555'
				),
				'type' => 'color'
			),
			array(
				'name' => 'Widget Title',
				'desc' => 'Select the color you want for the widget title.',
				'id' => 'woo_widget_font_text',
				'std' =>
				array(
					'color' => '#555555'
				),
				'type' => 'color'
			),
			array(
				'name' => 'Widget Title Bottom Border',
				'desc' => 'Specify border properties for the widget title.',
				'id' => 'woo_widget_title_border',
				'std' =>
				array(
					'width' => '1',
					'style' => 'solid',
					'color' => '#e6e6e6'
				),
				'type' => 'border'
			),
			array(
				'name' => 'Widget Borders',
				'type' => 'subheading'
			),
			array(
				'name' => 'Widget Border',
				'desc' => 'Specify border properties for widgets.',
				'id' => 'woo_widget_border',
				'std' =>
				array(
					'width' => '0',
					'style' => 'solid',
					'color' => '#dbdbdb'
				),
				'type' => 'border'
			),
			array(
				'name' => 'Widget Spacing',
				'type' => 'subheading'
			),
			array(
				'name' => 'Widget Padding',
				'desc' => 'Enter an integer value i.e. 20 for the desired widget padding.<br />The padding clears an area around the content (inside the border) of an element.',
				'id' => 'woo_widget_padding',
				'std' => '',
				'type' =>
				array(
					array(
						'id' => 'woo_widget_padding_tb',
						'type' => 'text',
						'std' => '',
						'meta' => 'Top/Bottom'
					),
					array(
						'id' => 'woo_widget_padding_lr',
						'type' => 'text',
						'std' => '',
						'meta' => 'Left/Right'
					)
				)
			),
			array(
				'name' => 'Widget Rounded Corners',
				'type' => 'subheading'
			),
			array(
				'name' => 'Widget Rounded Corners',
				'desc' => 'Set amount of pixels for border radius (rounded corners).',
				'id' => 'woo_widget_border_radius',
				'type' => 'select',
				'options' =>
				array(
					0 => '0px',
					1 => '1px',
					2 => '2px',
					3 => '3px',
					4 => '4px',
					5 => '5px',
					6 => '6px',
					7 => '7px',
					8 => '8px',
					9 => '9px',
					10 => '10px',
					11 => '11px',
					12 => '12px',
					13 => '13px',
					14 => '14px',
					15 => '15px',
					16 => '16px',
					17 => '17px',
					18 => '18px',
					19 => '19px',
					20 => '20px'
				)
			),
			array(
				'name' => 'Email Subscribe Widget',
				'type' => 'subheading'
			),
			array(
				'name' => 'Email Subscribe Background Color',
				'id' => 'rhino_email_background_color',
				'type' => 'color',
			),
			array(
				'name' => 'Email Subscribe Header Font Color',
				'id' => 'rhino_email_header_font',
				'type' => 'color',
			),
			array(
				'name' => 'Email Subscribe Details Font Color',
				'id' => 'rhino_email_details_font',
				'type' => 'color',
			),
			array(
				'name' => 'Email Subscribe Input Font Color',
				'id' => 'rhino_email_input_font',
				'type' => 'color',
			),
			array(
				'name' => 'Email Subscribe Top Border',
				'id' => 'rhino_email_top_border',
				'type' => 'border',
			),
			array(
				'name' => 'Email Subscribe Bottom Border',
				'id' => 'rhino_email_bottom_border',
				'type' => 'border',
			),
			array(
				'name' => 'Email Subscribe Side Border',
				'id' => 'rhino_email_side_border',
				'type' => 'border',
			),
			array(
				'name' => 'Rhino Events Widget',
				'type' => 'subheading'
			),
			array(
				'name' => 'Display Thumbnails',
				'id' => 'rhino_events_widget_thumbnails',
				'type' => 'checkbox',
			),


	// Contact heading
	array(
		'name' => 'Contact',
		'icon' => 'general',
		'type' => 'heading'
	),
			array(
				  'name' => 'Contact Information',
				  'type' => 'subheading'
			  ),
			array(
				'name' => 'Background Options',
				'desc' => '',
				'id' => 'woo_background_notice',
				'std' => 'Complete the fields below to have contact information display in the header and footer of your site.',
				'type' => 'info'
			),
			  array(
				'name' => 'Contact Phone Number',
				'id' => 'rhino_contact_phone',
				'type' => 'text',
			),
			array(
				'name' => 'Contact Email',
				'id' => 'rhino_contact_email',
				'type' => 'text',
			),
			array(
				'name' => 'Contact Address',
				'id' => 'rhino_contact_address',
				'type' => 'text',
			),
			array(
				'name' => 'Contact Address Link',
				'id' => 'rhino_contact_address_link',
				'type' => 'text',
			),
			array(
				'name' => 'Contact Facebook URL',
				'id' => 'rhino_contact_facebook',
				'type' => 'text',
			),
			array(
				'name' => 'Contact Twitter URL',
				'id' => 'rhino_contact_twitter',
				'type' => 'text',
			),
			array(
				'name' => 'Contact Google+ URL',
				'id' => 'rhino_contact_googleplus',
				'type' => 'text',
			),
			array(
				'name' => 'Contact Instagram URL',
				'id' => 'rhino_contact_instagram',
				'type' => 'text',
			),
			array(
				'name' => 'Contact Flickr URL',
				'id' => 'rhino_contact_flickr',
				'type' => 'text',
			),
			array(
				'name' => 'Contact Pinterest URL',
				'id' => 'rhino_contact_pinterest',
				'type' => 'text',
			),
			array(
				'name' => 'Contact Tumblr URL',
				'id' => 'rhino_contact_tumblr',
				'type' => 'text',
			),
			array(
				'name' => 'Contact YouTube URL',
				'id' => 'rhino_contact_youtube',
				'type' => 'text',
			),
			array(
				'name' => 'Contact Spotify URL',
				'id' => 'rhino_contact_spotify',
				'type' => 'text',
			),
			array(
				  'name' => 'Contact Page Information',
				  'type' => 'subheading'
			  ),
			array(
				'name' => 'Background Options',
				'desc' => '',
				'id' => 'woo_background_notice',
				'std' => 'Complete the fields below if you want custom contact information for your contact page.',
				'type' => 'info'
			),
			array(
				  'name' => 'Contact Information Panel',
				  'desc' => 'Enable the contact information panel on your contact page template.',
				  'id' => 'woo_contact_panel',
				  'std' => 'false',
				  'class' => 'collapsed',
				  'type' => 'checkbox'
			  ),
			  array(
				  'name' => 'Location Name',
				  'desc' => 'Enter the location name. Example: London Office',
				  'id' => 'woo_contact_title',
				  'std' => '',
				  'class' => 'hidden',
				  'type' => 'text'
			  ),
			  array(
				  'name' => 'Location Address',
				  'desc' => 'Enter your company\'s address',
				  'id' => 'woo_contact_address',
				  'std' => '',
				  'class' => 'hidden',
				  'type' => 'textarea'
			  ),
			  array(
				  'name' => 'Telephone',
				  'desc' => 'Enter your telephone number',
				  'id' => 'woo_contact_number',
				  'std' => '',
				  'class' => 'hidden',
				  'type' => 'text'
			  ),
			  array(
				  'name' => 'Fax',
				  'desc' => 'Enter your fax number',
				  'id' => 'woo_contact_fax',
				  'std' => '',
				  'class' => 'hidden last',
				  'type' => 'text'
			  ),
			array(
			  'name' => 'Contact Form E-Mail',
			  'desc' => 'Enter your E-mail address to use on the "Contact Form" page Template.',
			  'id' => 'woo_contactform_email',
			  'std' => '',
			  'type' => 'text'
			),
			array(
			  'name' => 'Maps',
			  'type' => 'subheading'
			),
			array(
			  'name' => 'Contact Form Google Maps Coordinates',
			  'desc' => 'Enter your Google Map coordinates to display a map on the Contact Form page template. You can get these details from <a href="http://itouchmap.com/latlong.html" target="_blank">Google Maps</a>',
			  'id' => 'woo_contactform_map_coords',
			  'std' => '',
			  'type' => 'text'
			),
			array(
			  'name' => 'Disable Mousescroll',
			  'desc' => 'Turn off the mouse scroll action for all the Google Maps on the site. This could improve usability on your site.',
			  'id' => 'woo_maps_scroll',
			  'std' => 'true',
			  'type' => 'checkbox'
			),
			array(
			  'name' => 'Map Height',
			  'desc' => 'Height in pixels for the maps displayed on Single.php pages.',
			  'id' => 'woo_maps_single_height',
			  'std' => '250',
			  'type' => 'text'
			),
			array(
			  'name' => 'Default Map Zoom Level',
			  'desc' => 'Set this to adjust the default in the post & page edit backend.',
			  'id' => 'woo_maps_default_mapzoom',
			  'std' => '9',
			  'type' => 'select2',
			  'options' =>
			  array(
				  0 => 'Select a number:',
				  1 => '0',
				  2 => 0,
				  3 => 1,
				  4 => 2,
				  5 => 3,
				  6 => 4,
				  7 => 5,
				  8 => 6,
				  9 => 7,
				  10 => 8,
				  11 => 9,
				  12 => 10,
				  13 => 11,
				  14 => 12,
				  15 => 13,
				  16 => 14,
				  17 => 15,
				  18 => 16,
				  19 => 17,
				  20 => 18,
				  21 => 19,
				  22 => 20
			  )
			),
			array(
			  'name' => 'Default Map Type',
			  'desc' => 'Set this to the default rendered in the post backend.',
			  'id' => 'woo_maps_default_maptype',
			  'std' => 'G_NORMAL_MAP',
			  'type' => 'select2',
			  'options' =>
			  array(
				  'G_NORMAL_MAP' => 'Normal',
				  'G_SATELLITE_MAP' => 'Satellite',
				  'G_HYBRID_MAP' => 'Hybrid',
				  'G_PHYSICAL_MAP' => 'Terrain',
			  )
			),
			array(
			  'name' => 'Map Callout Text',
			  'desc' => 'Text or HTML that will be output when you click on the map marker for your location.',
			  'id' => 'woo_maps_callout_text',
			  'std' => '',
			  'type' => 'textarea'
			),

	// Custom CSS Heading
	array(
		'name' => 'Custom CSS',
		'icon' => 'general',
		'type' => 'heading'
	),
			array(
				'name' => 'Custom CSS',
				'desc' => 'Add CSS to your theme by adding it to this block.<br/><br/>Use <strong>Alt + S</strong> to save.',
				'id' => 'woo_custom_css',
				'std' => '',
				'type' => 'textarea'
			),
			array(
				'name' => 'Disable ALL Custom Styling',
				'desc' => 'Disable output of all custom styling (CSS) from the theme options and use default styles from the stylesheet.',
				'id' => 'woo_style_disable',
				'std' => 'false',
				'type' => 'checkbox'
			),

	);

}

