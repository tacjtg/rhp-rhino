<?php
/*  Loop template for the Meteor Slides 1.5.3 slideshow

	Copy "meteor-slideshow.php" from "/meteor-slides/" to your theme's directory to replace
	the plugin's default slideshow loop.

	Learn more about customizing the slideshow template for Meteor Slides:
	http://www.jleuze.com/plugins/meteor-slides/customizing-the-slideshow-template/
*/

	global $post;

	// These two knucklehead variables may lose scope the way meteor operates in shortcode or plugin calls
	if( !isset( $slideshow ) and isset( $GLOBALS['slideshow'] ) ) {
		global $slideshow;
	}

	if( !isset( $metadata ) and isset( $GLOBALS['metadata'] ) ) {
		global $metadata;
	}

	$meteor_posttemp = $post;
	$meteor_options  = get_option( 'meteorslides_options' );
	$meteor_nav      = $meteor_options['slideshow_navigation'];
	$meteor_count    = 1;
	$meteor_loop     = new WP_Query( array(

		'post_type'      => 'slide',
		'slideshow'      => $slideshow,
		'posts_per_page' => $meteor_options['slideshow_quantity']

	) );

	// RHINO MOD - This must be set for the Thumbnails Layout to function properly.
	$meteor_options['slideshow_navigation'] = 'navpaged';

	?>

	<!-- Check for slides -->
	<?php if ( $meteor_loop->have_posts() ) : ?>

	<!-- RHINO MOD - Clean out Event Linked slides that have elapsed -->
	<?php if ( function_exists( 'rhp_event_status' ) ) {

			$clean_slides = array();

			foreach($meteor_loop->posts as $slide ) {

				$rhino_event = get_field('rhino_slide_linked_event',$slide->ID);

				if( empty($rhino_event) or ($rhino_event and rhp_event_status($rhino_event->ID) != 'past') )

					$clean_slides[] = $slide;

			} // End foreach()

			// Butcher the WP_Query so internal functions still operate
			$meteor_loop->posts = $clean_slides;
			$meteor_loop->post_count = count( $meteor_loop->posts );

		} //End if() ?>


	<div id="meteor-slideshow" class="meteor-slides col-full <?php

		// Adds classes to slideshow

		echo $slideshow . ' ' . $meteor_nav;

		if ( $meteor_loop->post_count == 1 ) { echo ' single-slide'; }

		// RHINO MOD - Add template class
		echo ' rhino-thumbnails-layout ';

		// Adds metadata to slideshow

		if ( !empty( $metadata ) || !empty( $slideshow ) ) { echo ' { '; }

		if ( !empty( $slideshow ) ) { echo "next: '#meteor-next" . $slideshow . "', prev: '#meteor-prev" . $slideshow . "', pager: '#meteor-buttons" . $slideshow . "'"; }

		if ( !empty( $metadata ) && !empty( $slideshow ) ) { echo ', '; }

		echo $metadata;

		if ( !empty( $metadata ) || !empty( $slideshow ) ) { echo ' }'; }

	?>">

<div class="col-full">

	<div class="meteor-clip">

		<?php // Loop which loads the slideshow

		while ( $meteor_loop->have_posts() ) : $meteor_loop->the_post(); ?>

			<!-- RHINO MOD - Check for linked event -->
			<?php $rhino_event = ( function_exists( 'rhp_event_status' ) ) ? get_field('rhino_slide_linked_event',$post->ID) : false; ?>

			<?php // Use first slide image as shim to scale slideshow

			// if ( $meteor_count == 1 ) {

			if ( $meteor_count == 1 && $meteor_loop->post_count > 1 ) {

				// Begin RHINO MOD - Creates an image with http://placehold.it/ based on the width/height set in the options

				$rhino_shim_width = $meteor_options['slide_width'];
				$rhino_shim_height = $meteor_options['slide_height'];

				echo '<img src="http://placehold.it/' . $rhino_shim_width . 'x' . $rhino_shim_height . '" style="visibility:hidden;" class="meteor-shim" />';

			} ?>

			<div class="mslide mslide-<?php echo $meteor_count; ?>">

				<!-- Adds Slide URL link anchor -->
				<?php if ( get_post_meta( $post->ID, "slide_url_value", $single = true ) != "" ): ?>

					<a href="<?php echo get_post_meta( $post->ID, "slide_url_value", $single = true ); ?>" title="<?php the_title(); ?>">

				<!-- Adds slide image with Event URL link -->
				<?php elseif( $rhino_event ): ?>

					<a href="<?php echo get_permalink( $rhino_event->ID ); ?>" title="<?php echo get_the_title($rhino_event->ID); ?>">

				<?php endif; ?>

					<!-- Display the Slide image -->
					<?php if( has_post_thumbnail() )

						the_post_thumbnail( 'featured-slide', array( 'title' => get_the_title() ) ); // Default Slides behavior

					elseif( $rhino_event and has_post_thumbnail($rhino_event->ID) )

						echo get_the_post_thumbnail( $rhino_event->ID, 'featured-slide', array( 'title' => get_the_title($rhino_event->ID) ) );

					?>

				<!-- Closed linked slides anchor, if needed -->
				<?php if ( $rhino_event or get_post_meta( $post->ID, "slide_url_value", $single = true ) != "" ): ?>

					</a>

				<?php endif; ?>


					<!-- RHINO MOD - Slider Overlay -->

					<?php $rhino_title = ($rhino_event) ? get_the_title($rhino_event->ID) : get_the_title(); ?>

					<div class="rhino-slide-wrapper <?php if( empty( $rhino_event ) and empty( $rhino_title ) and ( get_field('rhino_slide_button_text') == null ) ) { echo 'no-content'; } ?>">
						<div class="col-full">

						<div class="rhino-slide-left">

						<?php $rhino_href = ($rhino_event) ? get_permalink( $rhino_event->ID ) : get_post_meta( $post->ID, "slide_url_value", true );

							if( !empty($rhino_href) ): ?>

								<a class="rhino-slide-header" href="<?php echo get_permalink( $rhino_event->ID ); ?>" title="<?php echo get_the_title($rhino_event->ID); ?>">

						<?php endif; ?>

								<h3 class="rhino-slide-title"><?php echo $rhino_title; ?></h3>

							<?php if( !empty($rhino_href) ): ?>

								</a>

							<?php endif; ?>

							<div class="rhino-slide-details">

								<?php if( get_field('rhino_slide_description') ): ?>

									<p class="rhino-slide-description">

										<?php the_field('rhino_slide_description'); ?>

									</p>

								<?php elseif( $rhino_event ):

										// Do not override there here, use the Events > Settings Admin
										$time_format = tribe_get_time_format();
										$date_format = tribe_get_date_format();
										$rhino_startdate = tribe_get_start_date( $rhino_event->ID, false, $date_format );
										$rhino_starttime = tribe_get_start_date( $rhino_event->ID, false, $time_format ); ?>

									<i class="fa fa-calendar-o"></i> <p class="rhino-event-date"><?php echo $rhino_startdate; ?></p>

									<i class="fa fa-clock-o"></i> <p class="rhino-event-time"><?php echo $rhino_starttime; ?></p>

								<?php endif; ?>

							</div><!-- .rhino-slide-details -->

						</div><!-- .rhino-slide-left -->

						<div class="rhino-slide-right">

							<?php if( get_field('rhino_slide_button_url') ): ?>

								<span class="rhino-slide-cta">

									<a href="<?php the_field('rhino_slide_button_url'); ?>" title="<?php the_field('rhino_slide_button_text'); ?>" class="button primary large">

										<?php the_field('rhino_slide_button_text'); ?>

									</a>

								</span>

							<?php elseif( $rhino_event ):

								// This is tricky, must swap out POST global but not disturb THE LOOP
								//   See the warnings here: http://codex.wordpress.org/Function_Reference/setup_postdata
								global $post;
								$slide_post = $post;
								$post = $rhino_event;
								setup_postdata($post);

								// Call our CTA template
								tribe_get_template_part( 'rhp/cta' );

								// Now leave everything like we found it
								global $post;
								$post = $slide_post;
								setup_postdata($post);

							endif; ?>

						</div><!-- .rhino-slide-right -->

						</div>

					</div><!-- .rhino-slide-wrapper -->

					<!-- end rhino slide section -->

			</div><!-- .mslide -->

			<?php $meteor_count++; ?>

		<?php endwhile; ?>

		</div><!-- .meteor-clip -->

		<?php // Check for multiple slides

			if ( $meteor_loop->post_count > 1 ) : ?>

				<?php // Adds Previous/Next and Paged navigation

				if ( $meteor_nav == "navboth" ) : ?>

					<ul class="meteor-nav">

						<li id="meteor-prev<?php echo $slideshow; ?>" class="prev"><a href="#prev"><?php _e( 'Previous', 'meteor-slides' ) ?></a></li>

						<li id="meteor-next<?php echo $slideshow; ?>" class="next"><a href="#next"><?php _e( 'Next', 'meteor-slides' ) ?></a></li>

					</ul><!-- .meteor-nav -->

					<div id="meteor-buttons<?php echo $slideshow; ?>" class="meteor-buttons"></div>

				<?php // Adds Previous/Next navigation

				elseif ( $meteor_nav == "navprevnext" ) : ?>

					<ul class="meteor-nav">

						<li id="meteor-prev<?php echo $slideshow; ?>" class="prev"><a href="#prev"><?php _e( 'Previous', 'meteor-slides' ) ?></a></li>

						<li id="meteor-next<?php echo $slideshow; ?>" class="next"><a href="#next"><?php _e( 'Next', 'meteor-slides' ) ?></a></li>

					</ul><!-- .meteor-nav -->

				<?php // Adds Paged navigation

				elseif ( $meteor_nav == "navpaged" ): ?>

					<div id="meteor-buttons<?php echo $slideshow; ?>" class="meteor-buttons"></div>

				<?php endif; ?>

			<?php endif; ?>

		</div> <!-- .col-full -->

		<?php // Reset the slideshow loop

		$post = $meteor_posttemp;

		wp_reset_postdata(); ?>

	</div><!-- .meteor-slides -->

	<?php endif; ?>
