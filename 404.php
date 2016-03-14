<?php
/**
 * 404 Template
 *
 * This template is displayed when the page being requested by the viewer cannot be found
 * or doesn't exist. From here, we'll try to assist the user and keep them browsing the website.
 * @link http://codex.wordpress.org/Pages
 *
 * @package WooFramework
 * @subpackage Template
 */

get_header();
?>

    <!-- #content Starts -->
	<?php woo_content_before(); ?>
    <div id="content" class="col-full">

        <?php
    woo_loop_before();
        woo_get_template_part( 'content', '404' ); // Get the 404 content template file, contextually.
    woo_loop_after();
?>

<!-- Rhino Event Section Title -->
<div id="rhino-event-section-title">

    <h2> Upcoming Events </h2>

</div><!-- #rhino-event-section-title -->

<?php
    // Display the next X performances within 30 days from today's date.
    global $post;

    $current_date = date('j M Y');
    $events = tribe_get_events( array( 'start_date' => $current_date , 'posts_per_page' => 5 ) );

    if( count($events) ) {
?>

    <div id="rhino-homepage-event-section">
<?php
            foreach($events as $post) {

                setup_postdata($post);

                get_template_part( 'tribe-events/list/single-event' ); // Includes  List View Single Event Template

            } // End foreach
?>
    </div><!-- #rhino-homepage-event-section -->

    <div style="clear:both;"></div>

    <div class="rhino-events-see-all">

        <a href="<?php echo tribe_get_events_link() ?>" title="See All Events" class="button secondary medium rhino-events-see-all-button">

			See All Events

        </a>

    </div><!-- #see-more-events -->

<?php
        } // End if

        wp_reset_query();
?>


    </div><!-- /#content -->
	<?php woo_content_after(); ?>

<?php get_footer(); ?>
