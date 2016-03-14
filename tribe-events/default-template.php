<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

get_header(); ?>

<?php if ( !is_archive() and !is_tax() and is_active_sidebar( 'rhino-sidebar-events' ) ) { ?>

	<div id="content" class="col-full">

		<div id="main-sidebar-container">

		    <!-- #main Starts -->
		    <?php woo_main_before(); ?>

			<section id="main">

				<div id="tribe-events-pg-template">
					<?php tribe_events_before_html(); ?>
					<?php tribe_get_view(); ?>
					<?php tribe_events_after_html(); ?>
				</div> <!-- #tribe-events-pg-template -->

			</section><!-- /#main -->

		    <?php woo_main_after();?>

			<aside id="sidebar">
				<?php dynamic_sidebar('rhino-sidebar-events'); ?>
			</aside><!-- /#sidebar -->

		</div><!-- /#main-sidebar-container -->

	</div><!-- /#content -->

<?php } // End if ( is_active_sidebar( 'rhino-sidebar-homepage' ) )

else { ?>

<div id="tribe-events-pg-template" class="col-full">
	<?php tribe_events_before_html(); ?>
	<?php tribe_get_view(); ?>
	<?php tribe_events_after_html(); ?>
</div> <!-- #tribe-events-pg-template -->

<?php } ?>

<?php get_footer(); ?>
