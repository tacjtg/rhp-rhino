<?php

/**
 * Template Name: Homepage
 *
 * Here we setup all logic and HTML that is required for the index template, used as both the homepage
 * and as a fallback template, if a more appropriate template file doesn't exist for a specific context.
 *
 * @package Rhino
 * @subpackage WooFramework
 */

get_header();

woo_content_before(); ?>

<?php if ( is_active_sidebar( 'rhino-widget-area-homepage-above' ) ) { ?>

	<div id="home-widget-container-above" class="col-full">
		<?php dynamic_sidebar('rhino-widget-area-homepage-above'); ?>
	</div><!-- #widget-container-above -->

<?php } // End if ( is_active_sidebar( 'rhino-widget-area-homepage-above' )  ?>


<div id="home-widget-container" class="<?php echo ( is_active_sidebar( 'rhino-widget-area-homepage-sidebar' ) ) ? 'sidebar' : 'no-sidebar'; ?>">

	<div id="content" class="col-full">

		<div id="<?php echo ( is_active_sidebar( 'rhino-widget-area-homepage-sidebar' ) ) ? 'main-sidebar-container' : 'main-container'; ?>">

			<!-- BEGIN MAIN -->
			<?php woo_main_before(); ?>
			<section id="main">

				<?php // Display page content, if any

					$the_content = get_the_content();

					if ( !empty($the_content) ) { ?>

						<section class="entry">
						    <?php the_content(); ?>
						</section><!-- /.entry -->

				<?php } ?>

				<?php if ( is_active_sidebar( 'rhino-widget-area-homepage-main' ) ) {

					$home_widget_class = ( get_field( 'tabbed_widgets_on_homepage', 'options' ) ) ? 'responsive-tabs widget widget_text' : '';

				?>

					<div id="home-widget-container-main" class="<?php echo $home_widget_class; ?>">
						<?php dynamic_sidebar('rhino-widget-area-homepage-main'); ?>
					</div><!-- #home-widget-container-main -->

				<?php } // End if ( is_active_sidebar( 'rhino-widget-area-homepage-main' ) ) ?>

			</section><!-- /#main -->
			<?php woo_main_after();?>
			<!-- END MAIN -->

			<!-- BEGIN SIDEBAR -->
			<?php if ( is_active_sidebar( 'rhino-widget-area-homepage-sidebar' ) ) { ?>
				<div id="home-widget-container-sidebar">
					<aside id="sidebar">
						<?php dynamic_sidebar('rhino-widget-area-homepage-sidebar'); ?>
					</aside><!-- /#sidebar -->
				</div><!-- #widget-container-sidebar -->
			<?php } // if ( is_active_sidebar( 'rhino-widget-area-homepage-sidebar' ) ) ?>
			<!-- END SIDEBAR -->

	    </div><!-- /#main-sidebar-container -->

	</div><!-- /#content -->

</div><!-- #home-widget-container -->

<?php if ( is_active_sidebar( 'rhino-widget-area-homepage-below' ) ) { ?>

	<div id="home-widget-container-below" class="col-full">
		<?php dynamic_sidebar('rhino-widget-area-homepage-below'); ?>
	</div><!-- #widget-container-below -->

<?php }

woo_content_after();

get_footer();
