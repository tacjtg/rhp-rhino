<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); }


// Do not override these here, use the Events > Settings Admin
$time_format = tribe_get_time_format();
$date_format = tribe_get_date_format();

// All Day Event? Removes time if true
$all_day = tribe_event_is_all_day();
?>

<div id="tribe-events-content" class="tribe-events-single col-full">

	<p class="tribe-events-back">

		<a href="<?php echo tribe_get_events_link() ?>">

			<?php _e( '&laquo; All Events', 'tribe-events-calendar' ) ?>

		</a>

	</p>

	<!-- Notices -->
	<?php tribe_events_the_notices() ?>

<?php
	while ( have_posts() ) :
			the_post();
			$event_id = get_the_ID();
			$event_series = rhp_event_get_series();
 ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="rhino-single-event-right">

				<!-- Event featured image, but exclude link -->
				<div id="rhino-event-single-thumb">
					<?php echo tribe_event_featured_image($event_id, 'full', false); ?>
				</div><!-- #rhino-event-single-thumb -->

				<div class="rhino-event-cta-box">
					<!-- RHP Event CTA Begin -->

					<?php do_action( 'tribe_rhp_events_single_event_before_the_cta' ); ?>

					<div class="rhino-event-single-cta">
						<?php tribe_get_template_part( 'rhp/cta' ); ?>
					</div><!-- .rhino-event-single-cta -->

					<?php do_action( 'tribe_rhp_events_single_event_after_the_cta' ); ?>

					<!-- RHP Event CTA End -->
				</div><!-- /.rhino-event-single-cta-box -->

				<div class="rhino-event-secondary-cta-box">
					<?php if ( get_field('secondary_cta_button_link') ) : ?>
						<a target="_blank" class="button small secondary" href="<?php the_field('secondary_cta_button_link'); ?>"><?php the_field('secondary_cta_button_text'); ?></a>
					<?php endif; ?>
				</div><!-- /.rhino-event-secondary-cta-box -->


<?php
				if( $event_series ):
					$sib_events = rhp_series_get_event_siblings( $event_id, true );
					if( $sib_events->have_posts() ) :
?>
				<div class="wrapper rhino-event-series-list-wrap">
					<h4><?php echo $sib_events->found_posts; ?> More Dates</h4>
					<div id="rhino-event-series-single-list">
						<div class="st-content">
							<ul class="rhino-event-series-list">
						<?php while( $sib_events->have_posts() ) : $sib_events->the_post(); ?>
								<li class="rhino-event-series-individual">
									<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
									<div class="rhino-event-series-dates">
										<span class="rhino-event-series-date"><i class="fa fa-calendar-o"></i><?php echo tribe_get_start_date( null, false, $date_format ); ?></span>
										<span class="rhino-event-series-time"><i class="fa fa-clock-o"></i><?php echo tribe_get_start_date( null, false, $time_format ); ?></span>
									</div>
									<div class="rhino-event-series-dates-cta">
										<span class="rhp-event-cta on-sale">
										<?php tribe_get_template_part( 'rhp/cta-widget' ); ?>
										</span>
									</div>
								</li>
						<?php endwhile; wp_reset_postdata(); ?>
							</ul>
						</div>
					</div>
				</div>
				<?php endif; // end have_posts
				endif; // end event_series ?>

			</div> <!-- /.rhino-single-event-right -->

			<div id="rhino-event-single-content">

				<!-- RHP Event Tagline -->
				<?php if ( get_field('rhp_event_tagline') ) : ?>
					<p class="rhino-event-tagline"><?php the_field('rhp_event_tagline'); ?></p>
				<?php endif; ?>

				<!-- RHP Event Header -->
				<h2 class="rhino-event-header">
					<a class="url" href="<?php echo tribe_get_event_link(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h2>

				<!-- RHP Event Subheader -->
				<?php if ( get_field('rhp_event_subheader') ) : ?>
					<h3 class="rhino-event-subheader"><?php the_field('rhp_event_subheader'); ?></h3>
				<?php endif; ?>

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

					<div class="rhino-event-price-box">
						<?php if( get_field('rhp_event_cost') ): ?>
							<i class="fa fa-ticket"></i>
							<p class="rhino-event-price">
								<?php the_field('rhp_event_cost'); ?>
							</p>
						<?php endif; ?>
					</div><!-- /.rhino-event-price-box -->

					<?php if ( get_field('secondary_cta_button_link') ) : ?>
						<div class="rhino-event-secondary-cta-box">
							<a target="_blank" class="button small secondary" href="<?php the_field('secondary_cta_button_link'); ?>"><?php the_field('secondary_cta_button_text'); ?></a>
						</div><!-- /.rhino-event-secondary-cta-box -->
					<?php endif; ?>

					<?php if( get_field('rhp_event_notes') ) : ?>
						<div class="rhino-event-notes-box">
							<p class="rhino-event-notes"><?php the_field('rhp_event_notes'); ?></p>
						</div><!-- /.rhino-event-notes-box -->
					<?php endif; ?>

					<?php do_action( 'tribe_events_after_the_meta' ) ?>

				</div><!-- .rhino-event-details -->

				<?php get_template_part( 'content-sharetools' ) ?>

				<!-- Rhino Event Facebook Event RSVP Button -->
				<?php if ( get_field('rhp_event_facebook_event_url') ) : ?>
					<a href="<?php the_field('rhp_event_facebook_event_url'); ?>" class="rhino-event-rsvp" target="_blank">RSVP on Facebook</a>
				<?php endif; ?>

				<!-- Event content -->
				<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>

				<div class="tribe-events-single-event-description tribe-events-content entry-content description">
					<?php the_content(); ?>
				</div><!-- .tribe-events-single-event-description -->

			</div><!-- #rhino-event-content -->

			<div class="rhino-event_after_content_wrap">
				<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>
			</div>

			</div> <!-- #post-x -->

	<?php endwhile; ?>


	<!-- Event footer -->
    <div id="tribe-events-footer">
	</div><!-- #tribe-events-footer -->

</div><!-- #tribe-events-content -->
