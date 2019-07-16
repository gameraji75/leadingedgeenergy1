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

<div class="wrapper" id="single-wrapper">

	<div class="<?php echo 'container' . ($header_color ? '-fluid' : ''); ?>" id="header" tabindex="-1">

		<div class="row" style="<?php if($header_color) { echo 'background:'.esc_attr($header_color).';'; } if($header_text_color) { echo 'color:'.esc_attr($header_text_color).';'; } ?>">
		
			<div class="col">
		
			<?php if($header_color) { ?>
			
			<div class="container">
			<div class="row">
			<div class="col">
			
			<?php } ?>
				<header class="entry-header">

					<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

					<div class="entry-meta">

						<?php understrap_posted_on(); ?>

					</div><!-- .entry-meta -->

				</header><!-- .entry-header -->
			
		
			<?php while ( have_posts() ) : the_post(); ?>
			<?php endwhile; // end of the loop. ?>
			
			<?php if($header_color) { ?>
			
			</div>
			</div>
			</div>
			
			<?php } ?>
			
			</div>
		
		</div>
		
	</div>

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'loop-templates/content', 'single' ); ?>

					<?php understrap_post_nav(); ?>

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

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php get_footer(); ?>
