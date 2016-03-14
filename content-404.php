<?php
/**
 * Error Content Template
 *
 * This template is the content template for error screens. It is used to display a message
 * to the viewer when no appropriate page can be found by WordPress.
 *
 * @package WooFramework
 * @subpackage Template
 */

/**
 * Settings for this template file.
 *
 * This is where the specify the HTML tags for the title.
 * These options can be filtered via a child theme.
 *
 * @link http://codex.wordpress.org/Plugin_API#Filters
 */

 $title_before = '<h1 class="title entry-title">';
 $title_after = '</h1>';

 $page_link_args = apply_filters( 'woothemes_pagelinks_args', array( 'before' => '<div class="page-link">' . __( 'Pages:', 'woothemes' ), 'after' => '</div>' ) );

 woo_post_before();
?>
<article <?php post_class(); ?>>
<?php woo_post_inside_before();	?>

	<header>
		<?php echo $title_before . get_field( 'rhino_404_title', 'options' ) . $title_after; ?>
	</header>

	<section class="entry">
	    <?php the_field( 'rhino_404_content', 'options' ); ?>
	</section><!-- /.entry -->
<?php
	woo_post_inside_after();
?>
</article><!-- /.post -->
<?php
	woo_post_after();
?>
