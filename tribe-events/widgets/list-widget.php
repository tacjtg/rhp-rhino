<?php
/**
 * Events List Widget Template (Pro)
 *
 * @return string
 *
 * @package TribeEventsCalendar
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Have taxonomy filters been applied?
$filters = json_decode( $filters, true );

// Is the filter restricted to a single taxonomy?
$single_taxonomy = ( is_array( $filters ) && 1 === count( $filters ) );
$single_term = false;

// Pull the actual taxonomy and list of terms into scope
if ( $single_taxonomy ) foreach ( $filters as $taxonomy => $terms );

// If we have a single taxonomy and a single term, the View All link should point to the relevant archive page
if ( $single_taxonomy && 1 === count( $terms ) ) {
	$link_to_archive = true;
	$link_to_all = get_term_link( absint( $terms[0] ), $taxonomy );
}

// Otherwise link to the main events page
else {
	$link_to_archive = false;
	$link_to_all = tribe_get_events_link();
}

// Unsure why this is necessary again... dliszka
if( isset($instance) and is_array($instance) )
	extract($instance, EXTR_SKIP); // see events-calendar-pro/lib/widget-advanced-list.class.php

$posts = tribe_get_list_widget_events();

//Check if any posts were found
if ( $posts ) {
	?>

	<ol>
		<?php

			// Hack into the series list by global when called by widgets
			global $rhptribe_series;
			$current_series = array();

			foreach ( $posts as $post ) :
				setup_postdata( $post );

				$is_series = ( isset( $post->is_series ) and $post->is_series ) ? true : false;

				if( $is_series ) {
					$current_series = $rhptribe_series[$post->ID];
				}

				// Do not override there here, use the Events > Settings Admin
				$time_format = tribe_get_time_format();
				$date_format = tribe_get_date_format();
		?>
			<li class="tribe-events-list-widget-events <?php tribe_events_event_classes() ?>">

				<div class="rhino-events-widget-vitals">

					<?php do_action( 'tribe_events_list_widget_before_the_event_title' ); ?>

					<!-- Event Title -->
					<h4 class="entry-title summary">
						<?php if( $is_series ): ?>
						<a href="<?php echo $current_series['series_link']; ?>" rel="bookmark"><?php echo $current_series['term']->name; ?></a>
						<?php else: ?>
						<a href="<?php echo tribe_get_event_link(); ?>" rel="bookmark"><?php the_title(); ?></a>
						<?php endif; ?>
					</h4>

					<?php do_action( 'tribe_events_list_widget_after_the_event_title' ); ?>
					<!-- Event Time -->

					<?php do_action( 'tribe_events_list_widget_before_the_meta' ) ?>

					<div class="duration">
					<?php
						if( $is_series ) {
							echo date( $date_format, strtotime( $current_series['rhp_series_start_date'] ) );
							if( !empty( $current_series['rhp_series_end_date'] ) ) {
								echo ' - ',date( $date_format, strtotime( $current_series['rhp_series_end_date'] ) );
							}
						} else {
							echo tribe_get_start_date( null, false, $date_format), ' at ', tribe_get_start_date( null, false, $time_format);
						}
					?>
					</div>

				</div><!-- .rhino-events-widget-vitals" -->

				<!-- RHP Widget Event CTA Begin -->

				<?php do_action( 'tribe_rhp_events_widget_event_before_the_cta' ) ?>

				<div class="rhino-event-single-cta">

					<?php tribe_get_template_part( 'rhp/cta-widget' ); ?>

				</div><!-- .rhino-event-single-cta -->

				<?php do_action( 'tribe_rhp_events_widget_event_after_the_cta' ) ?>


				<?php if( $is_series ) : ?>

					<div class="clear"> </div>

					<div class="rhino-event-single-cta">
						<a href="<?php echo $current_series['series_link']; ?>" class="button medium secondary">Show Info</a>
					</div>

				<?php endif; ?>

				<!-- RHP Widget Event CTA End -->

				<?php do_action( 'tribe_events_list_widget_after_the_meta' ) ?>

			</li>
		<?php endforeach; ?>
	</ol><!-- .hfeed -->

	<p class="tribe-events-widget-link">
		<a href="<?php echo tribe_get_events_link(); ?>" rel="bookmark"><?php _e( 'View All Events', 'tribe-events-calendar' ); ?></a>
	</p>

	<?php } else {  ?>
	<p><?php _e( 'There are no upcoming events at this time.', 'tribe-events-calendar' ); ?></p>
<?php }
