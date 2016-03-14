<?php
/**
 * This is a special Tribe Events Category override for the
 * RHP driven Event Series taxonomy.
 *
 * In this case a child of the 'series' term is displayed as a single
 * event with some enancements for listing all the Events that are included.
 *
 * @package Rhino
 *
 * Originally based on TEC tribe-events/list/loop.php for v3.11
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Do not override these here, use the Events > Settings Admin
$time_format = tribe_get_time_format();
$date_format = tribe_get_date_format();

// Get custom ACF Fields for this Series Category
// See: http://www.advancedcustomfields.com/resources/get-values-from-a-taxonomy-term/
$term = get_queried_object();
$acf_term = "{$term->taxonomy}_{$term->term_id}";
$cat_fields = get_fields( $acf_term );

// If image is blank, try some fallbacks on the first Event in the series
if( empty( $cat_fields['rhp_series_page_image'] ) ) {
	global $wp_query;
	$post_img = get_the_post_thumbnail( $wp_query->posts[0]->ID, 'full' );
	if( empty( $post_img ) ) {
		// Try the Etix alt image
		$alt_img = get_post_meta( $wp_query->posts[0]->ID, 'alt_event_img', true );
		if( !empty( $alt_img ) ) {
			$cat_fields['rhp_series_page_image'] =
				array(
					'url' => $alt_img,
					'classes' => 'tribe-events-event-image rhp-event-image-offsite',
					'title' => $term->name
				);
		}
	} else {
		// Pick apart the HTML from get_post_thumbnail (maybe use wp_get_attachment_image_src?)
		preg_match( '/src="(.+)"/i', $post_img, $src_match );
		if( isset( $src_match[1] ) ) {
			$cat_fields['rhp_series_page_image'] =
				array(
					'url' => $src_match[1],
					'classes' => 'tribe-events-event-image',
					'title' => $term->name
				);
		}
	}
} else {
	// Make sure we have classes set
	$cat_fields['rhp_series_page_image']['classes'] = 'tribe-events-event-image';
	$cat_fields['rhp_series_page_image']['title'] = $term->name;
}

?>

<div id="tribe-events-content" class="tribe-events-single rhino-event-series-single col-full">

	<p class="tribe-events-back">
		<a href="<?php echo tribe_get_events_link() ?>">
			<?php _e( '&laquo; All Events', 'tribe-events-calendar' ) ?>
		</a>
	</p>

	<!-- Notices -->
	<?php // removed, not sure how this handles categories  #tribe_events_the_notices() ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div id="rhino-event-single-content">
				<!-- RHP Event Header -->
				<h2 class="rhino-event-header">
					<?php echo $term->name; ?>
				</h2>
				<!-- RHP Event Details -->
				<div class="rhino-event-details">

					<?php do_action( 'tribe_events_before_the_meta' ); ?>

					<?php if( !empty( $cat_fields['rhp_series_start_date'] ) ): ?>
					<div class="rhino-event-date-box">
						<i class="fa fa-calendar-o"></i>
						<p class="rhino-event-date"><?php
							$series_start =  date( $date_format, strtotime( $cat_fields['rhp_series_start_date'] ) );
							echo $series_start;
							if( !empty( $cat_fields['rhp_series_end_date'] ) ) {
								$series_end = date( $date_format, strtotime( $cat_fields['rhp_series_end_date'] ) );
								if( $series_start != $series_end ) {
									echo ' - ',$series_end;
								}
							} ?></p>
					</div>
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

					<?php do_action( 'tribe_events_after_the_meta' ) ?>



				</div><!-- .rhino-event-details -->

				<?php get_template_part( 'content-sharetools' ) ?>

				<!-- Event content -->
				<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>

				<div class="tribe-events-single-event-description tribe-events-content entry-content description">
					<?php if( !empty( $cat_fields['rhp_series_page_description'] ) ) { echo $cat_fields['rhp_series_page_description']; } ?>
				</div><!-- .tribe-events-single-event-description -->

			</div><!-- #rhino-event-content -->

			<div class="rhino-single-event-right">

				<?php if( $cat_fields and !empty( $cat_fields['rhp_series_page_image'] ) ): ?>
				<!-- Event featured image, but exclude link -->
				<div id="rhino-event-single-thumb">
					<div class="<?php echo $cat_fields['rhp_series_page_image']['classes']; ?>">
						<img src="<?php echo $cat_fields['rhp_series_page_image']['url']; ?>" title="<?php echo $cat_fields['rhp_series_page_image']['title']; ?>"/>
					</div>
				</div><!-- #rhino-event-single-thumb -->
				<?php endif; ?>

				<div class="rhino-event-cta-box">
					<!-- RHP Event Series CTA Begin -->

					<?php do_action( 'tribe_rhp_events_event_series_before_the_cta' ); ?>

					<div class="rhino-event-series-cta">
						<?php tribe_get_template_part( 'rhp/cta-series' ); ?>
					</div><!-- .rhino-event-series-cta -->

					<?php do_action( 'tribe_rhp_events_event_series_after_the_cta' ); ?>

					<!-- RHP Event Series CTA End -->
				</div><!-- /.rhino-event-single-cta-box -->
				<div class="clear"> </div>

<?php
			// List all upcoming dates in this Series
			if( have_posts() ): global $wp_query;
 ?>
				<div class="wrapper rhino-event-series-list-wrap">
					<h4><?php echo $wp_query->found_posts; ?> Dates</h4>
					<div id="rhino-event-series-single-list">
						<div class="st-content">
							<ul class="rhino-event-series-list">
						<?php while( have_posts() ) : the_post(); ?>
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
									<div class="clear"> </div>
								</li>
						<?php endwhile;  ?>
							</ul>
						</div>
					</div>
				</div>
			<?php endif; ?>

			</div> <!-- /.rhino-single-event-right -->

			<div class="rhino-event_after_content_wrap">
				<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>
			</div>

		</div> <!-- #post-x -->

</div><!-- #tribe-events-content -->




