<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Rhino Event Widget CTA
 *
 * This template is called in the following locations:
 * 		Rhino Widget (/widget/list-widget.php)
 *
 * @since  	1.0.0
 * @package Rhino
 * @author 	Rockhouse
 */

do_action( 'rhp_widget_before_cta' );

// When we're called from a widget, we are not inside a loop.  Pass the post
// manually from our known wrapper $perf variable from the Widget
global $post;
global $rhp_perf;
$rhp_post = empty( $rhp_perf ) ? $post->ID : $rhp_perf->ID;
$rhp_cta = RockhouseEvents::getEventCtaContent( 'widget', $rhp_post );

?>

<?php
if( !empty($rhp_cta['label']) ) {
	$label =
		( empty($rhp_cta['href']) ) ?
			$rhp_cta['label'] :
			'<a target="_blank" class="button primary medium" rel="external" title="' .$rhp_cta['label'] . '" href="' . $rhp_cta['href'] . '">' . $rhp_cta['label'] . '</a>';

	$classes = implode(' ',$rhp_cta['classes']);
	echo '<span class=" ' . $classes . '">' . $label . '</span>';
}

?>

<?php
do_action( 'rhp_widget_after_cta' );
