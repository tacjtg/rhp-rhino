<?php
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); } ?>

<?php

// Setup an array of venue details for use later in the template
$venue_details = array();

if ($venue_name = tribe_get_meta( 'tribe_event_venue_name' ) ) {
	$venue_details[] = $venue_name;
}

if ($venue_address = tribe_get_meta( 'tribe_event_venue_address' ) ) {
	$venue_details[] = $venue_address;
}
// Venue microformats
$has_venue_address = ( $venue_address ) ? ' location': '';

// Organizer
$organizer = tribe_get_organizer();

// Pull this HTML or null now, so we can test for our no-thumbnail classes
$tribe_img = tribe_event_featured_image(get_the_ID(), 'medium', false);

// Do not override there here, use the Events > Settings Admin
$time_format = tribe_get_time_format();
$date_format = tribe_get_date_format();

// All Day Event? Removes time if true
$all_day = tribe_event_is_all_day();
?>

<div class="rhino-event-section rhino-list-view">

	<div class="rhino-event-wrapper">

		<!-- Rhino Event Box Left Begin -->
		<div class="rhino-event-left <?php if( empty( $tribe_img ) ) { echo 'no-thumbnail'; } ?>">

			<!-- Rhino Event Date Box -->
			<div class="rhino-event-datebox <?php if( empty( $tribe_img ) ) { echo 'no-thumbnail'; } ?>">

				<div class="rhino-event-datebox-month">
					<p><?php echo tribe_get_start_date( null, false, 'M') ?></p>
				</div><!-- .rhino-event-datebox-month -->

				<div class="rhino-event-datebox-date">
					<p><?php echo tribe_get_start_date( null, false, 'j') ?></p>
				</div><!-- .rhino-event-datebox-date -->

				<div class="rhino-event-datebox-day">
					<p><?php echo tribe_get_start_date( null, false, 'D') ?></p>
				</div><!-- .rhino-event-datebox-day -->

			</div><!-- .rhino-event-datebox -->

			<!-- Rhino Event Thumbnail -->
			<?php if( !empty( $tribe_img ) ){ ?>

			<div class="rhino-event-thumb">
				<a class="url" href="<?php echo tribe_get_event_link() ?>" title="<?php the_title() ?>" rel="bookmark">
					<?php echo $tribe_img; ?>
				</a>
			</div><!-- .rhino-event-thumb -->

			<?php } ?>

		</div><!-- .rhino-event-left -->
		<!-- Event Box Left End -->

		<!-- Rhino Event Box Center Begin -->
		<div class="rhino-event-center <?php if( empty( $tribe_img ) ) { echo 'no-thumbnail'; } ?>">

			<!-- Rhino Event Headers & Content -->
			<div class="rhino-event-info">

				<?php do_action( 'tribe_events_before_the_event_title' ) ?>

				<!-- Rhino Event Tagline -->
				<?php if ( get_field('rhp_event_tagline') ) : ?>
					<p class="rhino-event-tagline"><?php the_field('rhp_event_tagline'); ?></p>
				<?php endif; ?>

				<!-- Rhino Event Header -->
				<h2 class="rhino-event-header">
					<a class="url" href="<?php echo tribe_get_event_link() ?>" title="<?php the_title() ?>" rel="bookmark">
						<?php the_title() ?>
					</a>
				</h2>

				<!-- Rhino Event Subheader -->
				<?php if ( get_field('rhp_event_subheader') ) : ?>
					<h3 class="rhino-event-subheader"><?php the_field('rhp_event_subheader'); ?></h3>
				<?php endif; ?>

				<?php do_action( 'tribe_events_after_the_event_title' ) ?>

			</div><!-- .rhino-event-info -->

			<!-- RHP Event Details -->
				<div class="rhino-event-details">

					<?php do_action( 'tribe_events_before_the_meta' ); ?>

					<div class="rhino-event-date-box">
						<i class="fa fa-calendar-o"></i>
						<p class="rhino-event-date"><?php echo tribe_get_start_date( null, false, $date_format) ?></p>
					</div>

					<?php if( $all_day == false ): ?>
						<div class="rhino-event-time-box">
							<i class="fa fa-clock-o"></i>
							<p class="rhino-event-time"><?php echo tribe_get_start_date( null, false, $time_format) ?></p>
						</div>
					<?php endif; ?>

					<?php if( tribe_has_venue() ): ?>
						<div class="rhino-event-venue-box">
							<i class="fa fa-map-marker"></i>
							<p class="rhino-event-venue"><?php tribe_get_venue_link(); ?></p>
						</div><!-- /.rhino-event-venue-box -->
					<?php endif; ?>

					<?php if( get_field('rhp_event_cost') ): ?>
						<div class="rhino-event-price-box">
							<i class="fa fa-ticket"></i>
							<p class="rhino-event-price">
								<?php the_field('rhp_event_cost'); ?>
							</p>
						</div><!-- /.rhino-event-price-box -->
					<?php endif; ?>

					<?php if( get_field('rhp_event_notes') ) : ?>
						<div class="rhino-event-notes-box">
							<p class="rhino-event-notes"><?php the_field('rhp_event_notes'); ?></p>
						</div><!-- /.rhino-event-notes-box -->
					<?php endif; ?>

					<div class="rhino-event-list-share">
						<!-- Rhino Event Facebook Event RSVP Button -->
						<?php get_template_part( 'content-sharetools' ) ?>
						<?php if ( get_field('rhp_event_facebook_event_url') ) : ?>
						<a href="<?php the_field('rhp_event_facebook_event_url'); ?>" class="rhino-event-rsvp" target="_blank">RSVP on Facebook</a>
					<?php endif; ?>
				</div>

				<?php do_action( 'tribe_events_after_the_meta' ) ?>

			</div><!-- .rhino-event-details -->

		</div><!-- .rhino-event-center -->
		<!-- Rhino Event Box Center End -->

		<!-- Rhino Event Box Right Begin -->
		<div class="rhino-event-right">

			<!-- RHP Event CTA Begin -->

			<?php do_action( 'tribe_rhp_events_list_single_event_before_the_cta' ) ?>

			<div class="rhino-event-list-cta">

				<?php tribe_get_template_part( 'rhp/cta' ); ?>

			</div><!-- .rhino-event-single-cta -->
			<?php do_action( 'tribe_rhp_events_list_single_event_after_the_cta' ) ?>

			<!-- Rhino Event More Info Button -->
			<a href="<?php echo tribe_get_event_link() ?>" class="rhino-event-more-info" rel="bookmark">
				<?php _e( 'More Information', 'tribe-events-calendar' ) ?>
			</a>

				<!-- RHP Event CTA End -->
			</div><!-- .rhino-event-right -->
		<!-- Rhino Event Box Left End - CTA -->

		<div style="clear:both"> </div>

	</div><!-- .rhino-event-wrapper -->


</div><!-- .rhino-event-section -->

