<?php
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_slide-overlay-configuration',
		'title' => 'Slide Overlay Configuration',
		'fields' => array (
			array (
				'key' => 'field_54d26a1e0f542',
				'label' => 'Description',
				'name' => 'rhino_slide_description',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_548f0d1ee69bb',
				'label' => 'Button Text',
				'name' => 'rhino_slide_button_text',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_548f0d2de69bc',
				'label' => 'Button URL',
				'name' => 'rhino_slide_button_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_548f0ca0e69b9',
				'label' => 'Event Linking Info',
				'name' => '',
				'type' => 'message',
				'message' => '<h4>Show Event as Slide</h4>

	Select an Event from the dropdown below to display this slide using information from that post. The Featured Image, Title, and CTA from that Event will be displayed by default when this is set.',
			),
			array (
				'key' => 'field_548f0b91e69b8',
				'label' => 'Linked Event',
				'name' => 'rhino_slide_linked_event',
				'type' => 'post_object',
				'post_type' => array (
					0 => 'tribe_events',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'allow_null' => 1,
				'multiple' => 0,
			),
			array (
				'key' => 'field_54d252cdc1bd1',
				'label' => 'Event Linking Note',
				'name' => '',
				'type' => 'message',
				'message' => 'You will not need to populate additional fields here when an Event is linked.	Setting any of the other fields here will override what is being pulled from the Event.

	<b>Note:</b> When the Event Performance Date has passed this slide will not be displayed on the site but it will still be shown here.',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'slide',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

