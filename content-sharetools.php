<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Adds the AddThis Share plugin.
 *
 * @since  	1.0.0
 * @package Rhino
 * @author 	Rockhouse
 */

global $post;
$shr_link = empty( $post->is_series ) ? get_permalink() : $post->series_link;

$shr_title = wp_title(null,false); // Filtered by Yoast on is_single()
if( is_archive() ) {
	$shr_title = empty( $post->is_series ) ? get_the_title($post->ID) : $post->series_title;
}
?>

<!-- Rhino Event Share -->
<div class="rhino-event-share">

	<!--p>Share:</p-->

	<!-- AddThis Button BEGIN -->
	<div class="addthis_toolbox addthis_default_style " addthis:url="<?php echo $shr_link; ?>" addthis:title="<?php echo $shr_title; ?>">
		<a class="addthis_button_facebook"></a>
		<a class="addthis_button_twitter"></a>
		<a class="addthis_button_email"></a>
		<a class="addthis_button_compact"></a>
		<a class="addthis_counter addthis_bubble_style"></a>
	</div>
	<!-- AddThis Button END -->

	</div><!-- .rhino-event-share -->
