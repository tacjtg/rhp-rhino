<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Add the JS in the header for our AddThis instance
 */

// JS requires us to add this AFTER Google Analytics calls
add_action('wp_head', 'rhino_addthis', 95);

if ( !function_exists( 'rhino_addthis' ) ) {

	function rhino_addthis() {
	$pubid = get_option('rhino_events_addthis_pubid');
	if( empty($pubid) )
		$pubid = 'ra-502e9155785185f7';  // RHP Default

	echo <<<HTML
<script type="text/javascript">
	var addthis_config = addthis_config || {
		pubid: '{$pubid}',
		data_track_clickback: true,
		data_ga_property: (typeof _gat !== 'undefined') ? _gat._getTrackerByName()._getAccount() : '',
		data_ga_social: (typeof _gat !== 'undefined') ? true : false
	};

	jQuery(document).ready(function($) {
		if( typeof addthis == 'undefined' ) {
			$.ajax({ url: "//s7.addthis.com/js/300/addthis_widget.js#async=1", dataType: "script", cache: true })
				.done(function() {
					addthis.init();
					// Refire on AJAX events to show sharing tools
					if( typeof( tribe_ev ) !== 'undefined' ) {
						$( tribe_ev.events ).on( 'ajax-success.tribe', function() {
							addthis.init();
						});
					}
			   	});
		}
	});
</script>


HTML;
} // End rhino_addthis()


} // End if
