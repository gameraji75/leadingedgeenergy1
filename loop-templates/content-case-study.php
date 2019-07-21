<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php
		the_title(
			sprintf( '<h5 class="entry-title mb-1"><a class="text-teal" href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
			'</a></h5>'
		);
		?>

	</header><!-- .entry-header -->

	<div class="row entry-content pb-2">
		<div class="col">
			<?php the_excerpt(); ?>
			<p class="read-more lead text-right"><?php echo '<a href="'.esc_url( get_permalink() ).'">Continue Reading <i class="fa fa-angle-right" aria-hidden="true"></i></a>'; ?></p>
		</div>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
<!-- NEWSLETTER POPUP -->
<?php if(has_tag('food-industry')) {
	echo do_shortcode("[popup_et file_name='food_industry_et' time_delay='20']");
} ?>
<!-- END NEWSLETTER POPUP -->
<!-- NEWSLETTER POPUP -->
<?php else {
	echo do_shortcode("[popup_et file_name='newsletter_et' time_delay='20']");
} ?>
<!-- END NEWSLETTER POPUP -->