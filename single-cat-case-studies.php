<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
$header_color = get_theme_mod( 'understrap_posts_header_color' );
$header_text_color = get_theme_mod( 'understrap_posts_header_text_color' );
?>

<div class="wrapper mt-3 mt-lg-4" id="single-wrapper">
<div class="container-fluid">

	<div class="row py-3" id="content" tabindex="-1">

		<div class="col">
		
			<?php if(esc_attr($container)=='container') { ?>
			
			<div class="container">
			<div class="row">
			
			<?php } ?>

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php while ( have_posts() ) : the_post(); ?>
				
					<?php get_template_part( 'loop-templates/content', 'case-study-single' );  ?>
					
					<?php //understrap_post_nav(); ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>
			
			<?php if(esc_attr($container)=='container') { ?>

			</div>
			</div>
			
			<?php } ?>

		</div><!-- .row -->

	</div><!-- #content -->
	
	<?php get_template_part( 'loop-templates/footer', 'form' ); ?>
</div>
</div><!-- #single-wrapper -->

<?php get_footer(); ?>
