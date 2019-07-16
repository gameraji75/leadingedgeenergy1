<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

function add_child_theme_textdomain() {
    load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );

/** WEBP SUPPORT **/
function cc_mime_types($mimes) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');
/** END WEBP SUPPORT **/

/** REMOVE SIDEBAR CONTAINER **/
function get_dynamic_sidebar($i = 1) {
   $c = '';
   ob_start();
   dynamic_sidebar($i);
   $c = ob_get_clean();
   return $c;
}
/** END REMOVE SIDEBAR CONTAINER **/

/** LATEST POSTS SHORTCODE **/
function recent_posts_et_func( $atts ) {
	$a = shortcode_atts( array(
		'post_type' => 'post',
		'category_name' => '',
		'showposts' => 4,
		'post_status' => 'publish',
	), $atts );
	
	$args3 = new WP_Query(array(
		'post_type' => $a['post_type'],
		'category_name' => $a['category_name'],
		'showposts' => $a['showposts'],
		'nopaging' => 0,
		'post_status' => $a['post_status']));
	if ($args3->have_posts()) :
		ob_start(); ?>
			<div class="card-deck">
				<?php while ($args3->have_posts()) : $args3->the_post(); 
				global $post; ?>
				<div class="card border-0 bg-transparent">
					<?php if(has_post_thumbnail()) { ?>
					<a href="<?php echo esc_url(get_permalink()) ?>"><img width="300" height="300" src="<?php echo  get_the_post_thumbnail_url($post->ID, "recent_posts_thumb_et") ?>" class="" alt="" title="" ></a>
					<?php } ?>
					<div class="card-body px-0">
						<a href="<?php echo esc_url(get_permalink()) ?>"><h6 class="card-title text-primary"><?php echo  get_the_title() ?></h6></a>
						<p class="card-text"><small class="text-muted"><?php echo get_the_author() ?> | 
						<?php foreach( (get_the_category()) as $category ) { ?>
						<a href="<?php echo esc_url( get_category_link( $category->term_id ) ) ?>"><?php echo $category->name ?></a>
						<?php } ?>
						</small></p>
						<p class="card-text"><?php echo get_the_excerpt() ?></p>
					</div>
				</div>
				<?php if ( ( $args3->current_post + 1 && $args3->current_post + 1 != $args3->post_count ) % 2 === 0 ) { ?>
				<div class="w-100 d-none d-sm-block d-md-none"></div>
				<?php }
				endwhile; ?>
			</div>
	<?php wp_reset_query();  // Restore global post data stomped by the_post().
	endif;
	
	return ob_get_clean();
}
add_shortcode( 'recent_posts_et', 'recent_posts_et_func' );

add_image_size( 'recent_posts_thumb_et', 256, 144, true ); 
  
if ( ! function_exists( 'understrap_all_excerpts_get_more_link' ) ) { 
 	function understrap_all_excerpts_get_more_link( $post_excerpt ) { 
 		if ( ! is_admin() ) { 
 			$post_excerpt .= ' ...'; 
 		} 
 		return $post_excerpt; 
 	} 
 }
add_filter( 'wp_trim_excerpt', 'understrap_all_excerpts_get_more_link' );
/** END LATEST POSTS SHORTCODE **/

/** DYNAMIC CSS **/
add_action( 'wp_enqueue_scripts', 'dynamic_enqueue_styles' );
function dynamic_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
	if(is_single()) {
		wp_enqueue_style( 'post-styles', get_stylesheet_directory_uri() . '/css/post.css', array(), $the_theme->get( 'Version' ) );
	}
}