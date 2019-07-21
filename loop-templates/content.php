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
			sprintf( '<h5 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
			'</a></h5>'
		);
		?>

	</header><!-- .entry-header -->

	<div class="row entry-content pb-2">
	<?php if(has_post_thumbnail()) { ?>
		<div class="col-md-3 text-center text-md-left"><?php echo '<a href="'.esc_url( get_permalink() ).'">'.get_the_post_thumbnail( $post->ID, 'recent_posts_thumb_et' ).'</a>'; ?></div>
	<?php } ?>
		<div class="col">
			<p class="entry-meta"><span class="byline">By <?php echo get_the_author() ?></span> | <span class="posted-on"><?php echo get_the_date(); ?></span></p>
			<?php the_excerpt(); ?>
			<p class="read-more lead"><?php echo '<a href="'.esc_url( get_permalink() ).'">Continue Reading <i class="fa fa-angle-right" aria-hidden="true"></i></a>'; ?></p>
		</div>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
