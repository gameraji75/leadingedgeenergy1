<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="entry-content mb-4">

		<?php the_content(); ?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<span class="tag-links lead align-middle">Tags: </span>
		<?php
			$posttags = get_the_tags();
			if ($posttags) {
				foreach($posttags as $tag) {
					echo '<a href="'.get_tag_link($tag).'" class="btn btn-primary btn-sm">' . $tag->name . '</a> '; 
				}
			}
		?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
<!-- NEWSLETTER POPUP -->
<?php echo do_shortcode("[popup_et file_name='newsletter_et' time_delay='20']"); ?>
<!-- END NEWSLETTER POPUP -->