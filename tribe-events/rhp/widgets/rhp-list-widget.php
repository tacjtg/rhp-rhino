<?php
/**
 * Events List Widget Template (Rhino)
 *
 * @return string
 * @package Rhino
 * @author dliszka
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

global $filters;

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

//Check if any posts were found
$posts = tribe_get_list_widget_events();
if ( $posts ) { ?>

	<div class="rhino-widget-list">
		<ol>
			<?php
			foreach ( $posts as $post ) :
				$fullwidth_template = ( isset( $post->is_series ) and $post->is_series ) ? 'list/single-series' : 'list/single-event';
				$fullwidth_template = apply_filters( 'rhino_widget_template', $fullwidth_template );
				setup_postdata( $post );
				include Tribe__Events__Templates::getTemplateHierarchy( $fullwidth_template );
			endforeach;
			?>
		</ol><!-- .hfeed -->

		<p class="tribe-events-widget-link">
			<a href="<?php echo tribe_get_events_link(); ?>" rel="bookmark"><?php _e( 'View All Events', 'tribe-events-calendar' ); ?></a>
		</p>
	</div>

	<?php
	//No Events were Found
} else {
	?>
	<p><?php _e( 'There are no upcoming events at this time.', 'tribe-events-calendar' ); ?></p>
<?php
}
?>
