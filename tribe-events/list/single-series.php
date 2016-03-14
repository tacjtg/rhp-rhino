<?php
/**
 * List View Single Event Series
 * This file contains one event series in the list view
 *
 * @package Rhino
 * @since 1.2.0
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

// Do not override there here, use the Events > Settings Admin
$time_format = tribe_get_time_format();
$date_format = tribe_get_date_format();

global $wp_query;
global $post;
global $rhptribe_series;

// Hack into the series list by global when called by widgets
if( empty( $rhptribe_series ) ) {
	$current_series = $wp_query->event_series[$post->ID];
} else {
	$current_series = $rhptribe_series[$post->ID];
}

// Pull this HTML or null now, so we can test for our no-thumbnail classes
$tribe_img = is_array( $current_series['rhp_series_page_image'] ) ? $current_series['rhp_series_page_image']['url'] : $current_series['rhp_series_page_image'];

?>

<div class="rhino-event-section rhino-list-view">

	<div class="rhino-event-wrapper">

		<!-- Rhino Event Box Left Begin -->
		<div class="rhino-event-left <?php if( empty( $tribe_img ) ) { echo 'no-thumbnail'; } ?>">

			<!-- Rhino Event Date Box -->
			<div class="rhino-event-datebox <?php if( empty( $tribe_img ) ) { echo 'no-thumbnail'; } ?>">

<?php
			if( !empty( $current_series['end_ts'] ) ) :
				$rhino_mo_start = date('M', $current_series['start_ts']);
				$rhino_day_start = date('j', $current_series['start_ts']);
?>

				<div class="rhino-event-datebox-month">
					<p><?php echo $rhino_mo_start; ?> </p>
				</div><!-- .rhino-event-datebox-month -->

				<div class="rhino-event-datebox-date">
					<p><?php echo $rhino_day_start; ?> </p>
				</div><!-- .rhino-event-datebox-date -->

<?php
			endif;

			// Special handling for long multi-day Series
			if( !empty( $current_series['end_ts'] ) ) :
				$rhino_mo_end = date('M', $current_series['end_ts']);
				$rhino_day_end = date('j', $current_series['end_ts']);

				if( $rhino_mo_start != $rhino_mo_end or $rhino_day_start != $rhino_day_end ) :
?>
				<span> - </span>

				<div class="rhino-event-datebox-month">
					<p><?php echo $rhino_mo_end; ?> </p>
				</div><!-- .rhino-event-datebox-month -->

				<div class="rhino-event-datebox-date">
					<p><?php echo $rhino_day_end; ?> </p>
				</div><!-- .rhino-event-datebox-date -->

<?php
				endif;
			endif;
?>
			</div><!-- .rhino-event-datebox -->

			<!-- Rhino Event Thumbnail -->
			<?php if( !empty( $tribe_img ) ){ ?>

			<div class="rhino-event-thumb">
				<div class="tribe-events-event-image">
					<a class="url" href="<?php echo $current_series['series_link']; ?>" title="<?php echo $current_series['term']->name; ?>" rel="bookmark">
						<img src="<?php echo $tribe_img; ?>" class="wp-post-image" alt="<?php echo $current_series['term']->name; ?>" />
					</a>
				</div>
			</div><!-- .rhino-event-thumb -->

			<?php } ?>

		</div><!-- .rhino-event-left -->
		<!-- Event Box Left End -->

		<!-- Rhino Event Box Center Begin -->
		<div class="rhino-event-center <?php if( empty( $tribe_img ) ) { echo 'no-thumbnail'; } ?>">

			<!-- Rhino Event Headers & Content -->
			<div class="rhino-event-info">

				<?php do_action( 'tribe_events_before_the_event_title' ) ?>

				<!-- Rhino Event Header -->
				<h2 class="rhino-event-header">
					<a class="url" href="<?php echo $current_series['series_link']; ?>" title="<?php echo $current_series['term']->name; ?>" rel="bookmark">
						<?php echo $current_series['term']->name; ?>
					</a>
				</h2>

				<?php do_action( 'tribe_events_after_the_event_title' ) ?>

			</div><!-- .rhino-event-info -->

			<!-- RHP Event Details -->
				<div class="rhino-event-details">

					<?php do_action( 'tribe_events_before_the_meta' ); ?>

					<?php if( !empty( $current_series['rhp_series_start_date'] ) ): ?>
					<div class="rhino-event-date-box">
						<i class="fa fa-calendar-o"></i>
						<p class="rhino-event-date"><?php
							echo date( $date_format, strtotime( $current_series['rhp_series_start_date'] ) );
							if( !empty( $current_series['rhp_series_end_date'] ) ) {
								echo ' - ',date( $date_format, strtotime( $current_series['rhp_series_end_date'] ) );
							} ?></p>
					</div>
					<?php endif; ?>

					<?php if( tribe_has_venue() ): ?>
						<div class="rhino-event-venue-box">
							<i class="fa fa-map-marker"></i>
							<p class="rhino-event-venue"><?php tribe_get_venue_link(); ?></p>
						</div><!-- /.rhino-event-venue-box -->
					<?php endif; ?>

					<?php if( !empty( $current_series['rhp_series_max_price'] ) ): ?>
						<div class="rhino-event-price-box">
							<i class="fa fa-ticket"></i>
							<p class="rhino-event-price">
<?php
							if( !empty( $current_series['rhp_series_min_price'] ) ) {
								echo '$',$current_series['rhp_series_min_price'],' - ';
							}
							if( !empty( $current_series['rhp_series_max_price'] ) ) {
								echo '$',$current_series['rhp_series_max_price'];
							}
?>
							</p>
						</div><!-- /.rhino-event-price-box -->
					<?php endif; ?>

					<?php if( !empty( $current_series['term']->description ) ): ?>
						<div class="rhino-event-notes-box">
							<p class="rhino-event-notes">
								<?php echo $current_series['term']->description; ?>
							</p>
						</div><!-- /.rhino-event-notes-box -->
					<?php endif; ?>

				<?php do_action( 'tribe_events_after_the_meta' ) ?>
				
				<div class="rhino-event-list-share">
					<?php get_template_part( 'content-sharetools' ) ?>
				</div>

			</div><!-- .rhino-event-details -->

		</div><!-- .rhino-event-center -->
		<!-- Rhino Event Box Center End -->

		<!-- Rhino Event Box Right Begin -->
		<div class="rhino-event-right">

				<!-- RHP Event CTA Begin -->

				<?php do_action( 'tribe_rhp_events_list_single_event_before_the_cta' ) ?>

				<div class="rhino-event-list-cta">

					<?php tribe_get_template_part( 'rhp/cta-series' ); ?>

				</div><!-- .rhino-event-single-cta -->

				<?php do_action( 'tribe_rhp_events_list_single_event_after_the_cta' ) ?>

				<!-- RHP Event CTA End -->

			<!-- Rhino Event More Info Button -->
			<a href="<?php echo $current_series['series_link']; ?>" class="rhino-event-more-info" rel="bookmark">
				<?php _e( 'More Information', 'tribe-events-calendar' ) ?>
			</a>

		</div><!-- .rhino-event-right -->
		<!-- Rhino Event Box Left End - CTA -->

	<div style="clear:both"> </div>

<?php if( !empty($current_series['posts']) ): ?>
	<div class="wrapper rhino-event-series-list-wrap">
		<div id="st-accordion" class="st-accordion">
			<h3>
				<a href="#" class="button st-toggle">See <?php echo count( $current_series['posts'] ); ?> More Dates<span class="st-arrow"></span></a>
			</h3>
			<div class="st-content" style="display:none">
				<ul class="rhino-event-series-list">
			<?php foreach($current_series['posts'] as $perf): global $rhp_perf; $rhp_perf = $perf; ?>
					<li class="rhino-event-series-individual">
						<h4><a href="<?php echo get_permalink($perf->ID) ?>"><?php echo get_the_title($perf->ID) ?></a></h4>
						<div class="rhino-event-series-dates">
							<span class="rhino-event-series-date"><i class="fa fa-calendar-o"></i><?php echo tribe_get_start_date( $perf->ID, false, $date_format); ?></span>
							<span class="rhino-event-series-time"><i class="fa fa-clock-o"></i><?php echo tribe_get_start_date( $perf->ID, false, $time_format);  ?></span>
						</div>
						<div class="rhino-event-series-dates-cta">
							<span class="rhp-event-cta on-sale">
							<?php tribe_get_template_part( 'rhp/cta-widget' ); ?>
							</span>
						</div>
					</li>
			<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
	<?php endif; // end series_info ?>

	</div><!-- .rhino-event-wrapper -->


</div><!-- .rhino-event-section -->

