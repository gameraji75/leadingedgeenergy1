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

<div class="wrapper container-fluid mt-3 mt-lg-4" id="single-wrapper">

	<div class="row py-2" style="<?php if($header_color) { echo 'background:'.esc_attr($header_color).';'; } if($header_text_color) { echo 'color:'.esc_attr($header_text_color).';'; } ?>">
		
		<div class="col">
	
			<?php if(esc_attr($container)=='container') { ?>
			
			<div class="container">
			<div class="row">
			<div class="col">
			
			<?php } ?>
			
			<?php while ( have_posts() ) : the_post(); ?>
			
				<header class="entry-header">
				
					<?php foreach( (get_the_category()) as $category ) { ?>
						<a class="lead category" href="<?php echo esc_url( get_category_link( $category->term_id ) ) ?>"><?php echo $category->name ?></a>
					<?php } ?>

					<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>

					<div class="entry-meta">

						<span class="byline">By <?php echo get_the_author() ?></span> | <span class="posted-on"><?php echo get_the_date(); ?></span>

					</div><!-- .entry-meta -->

				</header><!-- .entry-header -->

			<?php endwhile; // end of the loop. ?>
			
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
			
			<?php if(esc_attr($container)=='container') { ?>

			</div>
			</div>
			
			<?php } ?>

		</div><!-- .row -->

	</div><!-- #content -->
	
	<?php get_template_part( 'loop-templates/footer', 'form' ); ?>

</div><!-- #single-wrapper -->

<?php get_footer(); ?>
