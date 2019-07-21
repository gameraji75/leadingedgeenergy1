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
				
					<?php
					
					$args = array('child_of' => get_queried_object_id());
					$categories = get_categories( $args );
					foreach($categories as $category) { 
						echo '<h4 class="text-primary mb-1">'.$category->name.'</h4>';
						// The Query
						$args = array('cat' => $category->term_id, 'post_status' => 'publish');
						$query1 = new WP_Query( $args );
						if ( $query1->have_posts() ) {
							// The Loop
							while ( $query1->have_posts() ) {
								$query1->the_post();
								get_template_part( 'loop-templates/category', 'case-study' ); 
								set_query_var('category_id',null);
							}

							wp_reset_postdata();
						}
					}
					
					?>
					
					<hr class="mt-0 mb-2 border-secondary">

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

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>
