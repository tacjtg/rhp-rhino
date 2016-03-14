<?php
/**
 * Photo View Single Event
 * This file contains one event in the photo view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/photo/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

global $post;

$event_id = get_the_ID();
$event_series = rhp_event_get_series();


if( $event_series ) {

?>

<div class="tribe-events-photo-event-wrap rhino-event-series">

<?php
	$img = tribe_event_featured_image( get_the_ID(), 'medium', false);
	if( !empty( $img ) ) {
		echo $img;
	}
?>

	<div class="tribe-events-event-details tribe-clearfix">

			<!-- Rhino Event Box Center Begin -->
		<div class="rhino-event-center rhino-photo">

			<!-- Rhino Event Headers & Content -->
			<div class="rhino-event-info">

				<?php do_action( 'tribe_events_before_the_event_title' ) ?>

				<!-- Rhino Event Tagline -->
				<p class="rhino-event-tagline">
					<?php if ( the_field('rhp_event_tagline') ) : the_field('rhp_event_tagline'); endif; ?>
				</p>

				<!-- Rhino Event Header -->
				<h2 class="rhino-event-header">
					<a class="url" href="<?php echo tribe_get_event_link() ?>" title="<?php the_title() ?>" rel="bookmark">
						<?php the_title() ?>
					</a>
				</h2>

				<!-- Rhino Event Subheader -->
				<p class="rhino-event-subheader">
					<?php if ( the_field('rhp_event_subheader') ) : the_field('rhp_event_subheader'); endif; ?>
				</p>

				<?php do_action( 'tribe_events_after_the_event_title' ) ?>

			</div><!-- .rhino-event-info -->

			<!-- RHP Event Details -->
				<div class="rhino-event-details">

					<?php do_action( 'tribe_events_before_the_meta' );

						// Do not override there here, use the Events > Settings Admin
						$time_format = tribe_get_time_format();
						$date_format = tribe_get_date_format();
					?>

					<i class="fa fa-calendar-o"></i>
					<p class="rhino-event-date">
						<?php echo tribe_get_start_date( null, false, $date_format) ?>-<?php echo tribe_get_end_date( null, false, $date_format) ?>
					</p>

					<i class="fa fa-clock-o"></i>
					<p class="rhino-event-time">
						<?php echo tribe_get_start_date( null, false, $time_format) ?>
					</p>

					<?php if( tribe_has_venue() ): ?>
						<div class="rhino-event-venue-box">
							<i class="fa fa-map-marker"></i>
							<p class="rhino-event-venue"><?php tribe_get_venue_link(); ?></p>
						</div><!-- /.rhino-event-venue-box -->
					<?php endif; ?>

				<?php do_action( 'tribe_events_after_the_meta' ) ?>

			</div><!-- .rhino-event-details -->

		</div><!-- .rhino-event-center -->
		<!-- Rhino Event Box Center End -->

		<div class="clear"> </div>

		<br />

		<!-- RHP Event CTA Begin -->

				<?php do_action( 'tribe_rhp_events_list_single_event_before_the_cta' ) ?>

				<div class="rhino-event-single-cta">

					<?php tribe_get_template_part( 'rhp/cta' ); ?>

				</div><!-- .rhino-event-single-cta -->

				<?php do_action( 'tribe_rhp_events_list_single_event_after_the_cta' ) ?>

				<!-- RHP Event CTA End -->

			<!-- Rhino Event More Info Button -->
			<a href="<?php echo tribe_get_event_link() ?>" class="rhino-event-more-info" rel="bookmark">
				<?php _e( 'Show Information', 'tribe-events-calendar' ) ?>
			</a>

			<!-- Rhino Event Facebook Event RSVP Button -->
			<?php if ( get_field('rhp_event_facebook_event_url') ) : ?>
				<a href="<?php the_field('rhp_event_facebook_event_url'); ?>" class="rhino-event-rsvp" target="_blank">RSVP on FB</a>
			<?php endif; ?>

			<?php get_template_part( 'content-sharetools' ) ?>

		<!-- Event Content -->
		<?php do_action( 'tribe_events_before_the_content' ); ?>
		<div class="tribe-events-list-photo-description tribe-events-content entry-summary description">
			<?php echo tribe_events_get_the_excerpt() ?>
		</div>
		<?php do_action( 'tribe_events_after_the_content' ) ?>

	</div><!-- /.tribe-events-event-details -->

	<div class="wrapper rhino-event-series-list-wrap">
		<div id="st-accordion" class="st-accordion">
			<ul class="rhino-event-series-dates">
				<li class="rhino-event-series-toggle">
					<a href="#" class="button secondary">See [NUMBER OF EVENTS] More Dates<span class="st-arrow"></span></a>
	                <div class="st-content">
	                	<ul class="rhino-event-series-list">
	                		<li class="rhino-event-series-individual">
			                    <div class="rhino-event-series-dates">
									<span class="rhino-event-series-title"><a class="url" href="<?php echo tribe_get_event_link() ?>" title="<?php the_title() ?>" rel="bookmark"><?php the_title() ?></a></span>
									<span class="rhino-event-series-date"><i class="fa fa-calendar-o"></i><?php echo tribe_get_start_date( null, false, $date_format) ?></span>
									<span class="rhino-event-series-time"><i class="fa fa-clock-o"></i><?php echo tribe_get_start_date( null, false, $time_format) ?></span>
								</div>
								<div class="rhino-event-series-dates-cta">
									<?php tribe_get_template_part( 'rhp/cta' ); ?>
								</div>
							</li>
							<li class="rhino-event-series-individual">
			                    <div class="rhino-event-series-dates">
									<span class="rhino-event-series-title"><a class="url" href="<?php echo tribe_get_event_link() ?>" title="<?php the_title() ?>" rel="bookmark"><?php the_title() ?></a></span>
									<span class="rhino-event-series-date"><i class="fa fa-calendar-o"></i><?php echo tribe_get_start_date( null, false, $date_format) ?></span>
									<span class="rhino-event-series-time"><i class="fa fa-clock-o"></i><?php echo tribe_get_start_date( null, false, $time_format) ?></span>
								</div>
								<div class="rhino-event-series-dates-cta">
									<?php tribe_get_template_part( 'rhp/cta' ); ?>
								</div>
							</li>
							<li class="rhino-event-series-individual">
			                    <div class="rhino-event-series-dates">
									<span class="rhino-event-series-title"><a class="url" href="<?php echo tribe_get_event_link() ?>" title="<?php the_title() ?>" rel="bookmark"><?php the_title() ?></a></span>
									<span class="rhino-event-series-date"><i class="fa fa-calendar-o"></i><?php echo tribe_get_start_date( null, false, $date_format) ?></span>
									<span class="rhino-event-series-time"><i class="fa fa-clock-o"></i><?php echo tribe_get_start_date( null, false, $time_format) ?></span>
								</div>
								<div class="rhino-event-series-dates-cta">
									<?php tribe_get_template_part( 'rhp/cta' ); ?>
								</div>
							</li>
						</ul>
	                </div>
				</li>
			</ul>
		</div>
	</div>

</div><!-- /.tribe-events-photo-event-wrap -->

<script type="text/javascript">
	jQuery(document).ready(function($) {
			$('#st-accordion').accordion();
	});
</script>



<?php
} else { // Regular single event
?>

<div class="tribe-events-photo-event-wrap">

<?php
	$img = tribe_event_featured_image( get_the_ID(), 'medium', false);
	if( !empty( $img ) ) {
		echo $img;
	}
?>


	<div class="tribe-events-event-details tribe-clearfix">

			<!-- Rhino Event Box Center Begin -->
		<div class="rhino-event-center rhino-photo">

			<!-- Rhino Event Headers & Content -->
			<div class="rhino-event-info">

				<?php do_action( 'tribe_events_before_the_event_title' ) ?>

				<!-- Rhino Event Tagline -->
				<p class="rhino-event-tagline">
					<?php if ( the_field('rhp_event_tagline') ) : the_field('rhp_event_tagline'); endif; ?>
				</p>

				<!-- Rhino Event Header -->
				<h2 class="rhino-event-header">
					<a class="url" href="<?php echo tribe_get_event_link() ?>" title="<?php the_title() ?>" rel="bookmark">
						<?php the_title() ?>
					</a>
				</h2>

				<!-- Rhino Event Subheader -->
				<p class="rhino-event-subheader">
					<?php if ( the_field('rhp_event_subheader') ) : the_field('rhp_event_subheader'); endif; ?>
				</p>

				<?php do_action( 'tribe_events_after_the_event_title' ) ?>

			</div><!-- .rhino-event-info -->

			<!-- RHP Event Details -->
				<div class="rhino-event-details">

					<?php do_action( 'tribe_events_before_the_meta' );

						// Do not override there here, use the Events > Settings Admin
						$time_format = tribe_get_time_format();
						$date_format = tribe_get_date_format();
					?>

					<i class="fa fa-calendar-o"></i>
					<p class="rhino-event-date">
						<?php echo tribe_get_start_date( null, false, $date_format) ?>
					</p>

					<i class="fa fa-clock-o"></i>
					<p class="rhino-event-time">
						<?php echo tribe_get_start_date( null, false, $time_format) ?>
					</p>

					<?php if( tribe_has_venue() ): ?>
						<div class="rhino-event-venue-box">
							<i class="fa fa-map-marker"></i>
							<p class="rhino-event-venue"><?php tribe_get_venue_link(); ?></p>
						</div><!-- /.rhino-event-venue-box -->
					<?php endif; ?>

				<?php do_action( 'tribe_events_after_the_meta' ) ?>

			</div><!-- .rhino-event-details -->

		</div><!-- .rhino-event-center -->
		<!-- Rhino Event Box Center End -->

		<div class="clear"> </div>

		<br />

		<!-- RHP Event CTA Begin -->

				<?php do_action( 'tribe_rhp_events_list_single_event_before_the_cta' ) ?>

				<div class="rhino-event-single-cta">

					<?php tribe_get_template_part( 'rhp/cta' ); ?>

				</div><!-- .rhino-event-single-cta -->

				<?php do_action( 'tribe_rhp_events_list_single_event_after_the_cta' ) ?>

				<!-- RHP Event CTA End -->

				<?php if( !empty($series_info) ): ?>

					<div class="clear"> </div>

					<a href="<?php echo tribe_get_event_link(); ?>" class="button medium secondary">See <?php echo count($series_info); ?> More Dates</a>

				<?php endif; ?>

			<!-- Rhino Event More Info Button -->
			<a href="<?php echo tribe_get_event_link() ?>" class="rhino-event-more-info" rel="bookmark">
				<?php _e( 'Show Information', 'tribe-events-calendar' ) ?>
			</a>

			<!-- Rhino Event Facebook Event RSVP Button -->
			<?php if ( get_field('rhp_event_facebook_event_url') ) : ?>
				<a href="<?php the_field('rhp_event_facebook_event_url'); ?>" class="rhino-event-rsvp" target="_blank">RSVP on FB</a>
			<?php endif; ?>

			<?php get_template_part( 'content-sharetools' ) ?>

		<!-- Event Content -->
		<?php do_action( 'tribe_events_before_the_content' ); ?>
		<div class="tribe-events-list-photo-description tribe-events-content entry-summary description">
			<?php echo tribe_events_get_the_excerpt() ?>
		</div>
		<?php do_action( 'tribe_events_after_the_content' ) ?>

	</div><!-- /.tribe-events-event-details -->

</div><!-- /.tribe-events-photo-event-wrap -->


<?php
} // end series vs non-series
