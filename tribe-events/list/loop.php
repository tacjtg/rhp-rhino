<?php
/**
 * List View Loop
 * This file sets up the structure for the list loop
 *
 * NOTE: This loop.php only fires if there are events for the view, otherwise
 * the tribe-events/list.php file will display the "No events found" message.
 *
 * @package Rhino
 * @package TribeEventsCalendar
 *
 * Originally copied from TEC 3.11
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php
global $post;
global $more;
$more = false;
?>

<div class="tribe-events-loop vcalendar">

<?php
	// Check if we are using our special Series template or are under its hierarchy
	$series_cat = get_term_by( 'slug', 'series', Tribe__Events__Main::TAXONOMY );
	$event_cat = get_queried_object();

	if( is_tax( Tribe__Events__Main::TAXONOMY ) and is_object( $series_cat ) and $event_cat->parent == $series_cat->term_id ) {
		// A single Event Series
		tribe_get_template_part( 'rhp/taxonomy-tribe_events_cat-single' );
	} else {
		// More typical loop through events, checking for special series
		while ( have_posts() ) : the_post();
			do_action( 'tribe_events_inside_before_loop' );

			global $post;
			if( isset( $post->is_series ) and $post->is_series ) { ?>

			<div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?> rhp-event-series">
				<?php tribe_get_template_part( 'list/single-series' ) ?>
			</div><!-- .hentry .vevent -->

<?php
			} else {
			// Regular Tribe template
?>

			<!-- Month / Year Headers -->
			<?php tribe_events_list_the_date_headers(); ?>

			<!-- Event  -->
			<?php
			$post_parent = '';
			if ( $post->post_parent ) {
				$post_parent = ' data-parent-post-id="' . absint( $post->post_parent ) . '"';
			}
			?>
			<div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?>" <?php echo $post_parent; ?>>


				<?php tribe_get_template_part( 'list/single', 'event' ) ?>
			</div><!-- .hentry .vevent -->

<?php
			} // end Regular Tribe template

			do_action( 'tribe_events_inside_after_loop' );
		endwhile;
	}
?>


</div><!-- .tribe-events-loop -->
