<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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

<div class="wrapper mt-3 mt-lg-4" id="archive-wrapper">

	<div class="container-fluid">

		<div class="row py-2" style="<?php if($header_color) { echo 'background:'.esc_attr($header_color).';'; } if($header_text_color) { echo 'color:'.esc_attr($header_text_color).';'; } ?>">
			
			<div class="col">
			
				<?php if(esc_attr($container)=='container') { ?>
				
				<div class="container">
				<div class="row">
				<div class="col">
				
				<?php } ?>
			
				<?php if ( have_posts() ) : ?>

					<header class="page-header">
					
						<?php //the_archive_title( '<h3 class="entry-title">', '</h3>' ); ?>
						<h3 class="entry-title"><?php single_cat_title(); ?></h3>
						
					</header><!-- .page-header -->
							
				<?php endif; ?>
				
				<?php if(esc_attr($container)=='container') { ?>
				
				</div>
				</div>
				</div>
				
				<?php } ?>
			
			</div>
			
		</div>

		<div class="row py-3" id="content" tabindex="-1">

			<div class="col">
			
				<?php if(esc_attr($container)=='container') { ?>
				
				<div class="container">
				<div class="row">
				
				<?php } ?>

				<!-- Do the left sidebar check -->
				<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

				<main class="site-main" id="main">

					<?php if ( have_posts() ) : ?>

						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'loop-templates/content', get_post_format() );
							?>

						<?php endwhile; ?>

					<?php else : ?>

						<?php get_template_part( 'loop-templates/content', 'none' ); ?>

					<?php endif; ?>

				</main><!-- #main -->

				<!-- The pagination component -->
				<?php understrap_pagination(); ?>

				<!-- Do the right sidebar check -->
				<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>
				
				<?php if(esc_attr($container)=='container') { ?>

				</div>
				</div>
				
				<?php } ?>

			</div> <!-- .col -->

		</div><!-- #content -->
	
	</div><!-- container-fluid -->

</div><!-- #archive-wrapper -->

<!-- NEWSLETTER POPUP -->
<?php echo do_shortcode("[popup_et file_name='newsletter_et' time_delay='20']"); ?>
<!-- END NEWSLETTER POPUP -->

<?php get_footer(); ?>
