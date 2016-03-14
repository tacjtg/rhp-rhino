<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Rhino Event CTA
 *
 * This template is called in the following locations:
 * 		List View Single Event (/list/single-event.php)
 *
 * @since  	1.0.0
 * @package Rhino
 * @author 	Rockhouse
 */

do_action( 'rhp_event_before_cta' );
$rhp_cta = RockhouseEvents::getEventCtaContent();
?>

<?php
if( !empty($rhp_cta['label']) ) {
	$label =
		( empty($rhp_cta['href']) ) ?
			$rhp_cta['label'] :
			'<a class="button primary large" target="_blank" rel="external" title="' .$rhp_cta['label'] . '" href="' . $rhp_cta['href'] . '">' . $rhp_cta['label'] . '</a>';

	$classes = implode(' ',$rhp_cta['classes']);
	echo '<span class="' . $classes . '">' . $label . '</span>';
}

?>

<?php
do_action( 'rhp_event_after_cta' );
