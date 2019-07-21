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
	ob_start();
	include 'shortcodes/recent_posts_et.php';
	
	return ob_get_clean();
}
add_shortcode( 'recent_posts_et', 'recent_posts_et_func' );

add_image_size( 'recent_posts_thumb_et', 256, 144, true ); 

add_filter( 'wp_trim_excerpt', 'understrap_all_excerpts_get_more_link' );
if ( ! function_exists( 'understrap_all_excerpts_get_more_link' ) ) { 
 	function understrap_all_excerpts_get_more_link( $post_excerpt ) { 
 		if ( ! is_admin() ) { 
 			$post_excerpt .= ' ...'; 
 		} 
 		return $post_excerpt; 
 	} 
 }
/** END LATEST POSTS SHORTCODE **/


/** LATEST POSTS SHORTCODE **/
add_shortcode( 'popup_et', 'popup_et_func' );
function popup_et_func( $atts ) {
	$a = shortcode_atts( array(
		'file_name' => 'newsletter_et',
		'time_delay' => '20',
		'form_id' => '',
		'heading' => '',
	), $atts );

	ob_start();
	include 'shortcodes/popup_'.$a['file_name'].'.php';
	
	return ob_get_clean();
}
/** END LATEST POSTS SHORTCODE **/


/** DYNAMIC CSS **/
add_action( 'wp_enqueue_scripts', 'dynamic_enqueue_styles' );
function dynamic_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
	if(is_single()) {
		wp_enqueue_style( 'post-styles', get_stylesheet_directory_uri() . '/css/post.css', array(), $the_theme->get( 'Version' ) );
	}
	if(is_category()) {
		wp_enqueue_style( 'category-styles', get_stylesheet_directory_uri() . '/css/category.css', array(), $the_theme->get( 'Version' ) );
	}
}
/** END DYNAMIC CSS **/


/** GRAVITY FORMS <LI> TO <DIV> **/
add_filter( 'gform_field_container', 'et_field_container', 10, 6 );
function et_field_container( $field_container, $field, $form, $css_class, $style, $field_content ) {
	if(!is_admin()) {
		if ($field->type == 'name') {
			$output = '<div class="form-row '.$css_class.'">{FIELD_CONTENT}</div>';
		}
		else {
			if(strstr($css_class,'gf_left')){
				$output = '<div class="form-row"><div class="col '.$css_class.'">{FIELD_CONTENT}</div>';
			}
			elseif(strstr($css_class,'gf_middle')) {
				$output = '<div class="col '.$css_class.'">{FIELD_CONTENT}</div>';
			}
			elseif(strstr($css_class,'gf_right')) {
				$output = '<div class="col '.$css_class.'">{FIELD_CONTENT}</div></div>';
			}
			else {
				$output = '<div class="form-group '.$css_class.'">{FIELD_CONTENT}</div>';
			}
		}
		return $output;
	}
	else {
		$field_markup = str_replace( '{FIELD_CONTENT}', $field_content, $field_container );

		return $field_markup;
	}
}

add_filter( 'gform_field_input', 'tracker', 10, 5 );
function tracker( $input, $field, $value, $lead_id, $form_id ) {
    if(!is_admin()) {
		// because this will fire for every form/field, only do it when it is the specific form and field
		if($field->type != 'name') {
			$input = '<input type="'. $field->type .'" id="input_'. $form_id .'_'.$field->id .'" name="input_'. $field->id . '" value="'. $field->value .'" class="form-control '. $field->cssClass .'" placeholder="'.$field['placeholder'].'" >';
		}
		
		if ($field->type == 'name') {

			foreach ($field->inputs as $f) {
				if(!$f['isHidden']){
					$input .= '<div class="col">';
					if($field->subLabelPlacement == 'above') {
						$input .= '<label for="input_'.$form_id.'_'.preg_replace('/\./i','_',$f['id']).'">'.($f['customLabel']?$f['customLabel']:$f['label']).'</label>';
					}
					$input .= '<input type="text" id="input_'.$form_id.'_'.preg_replace('/\./i','_',$f['id']).'" name="input_'.$f['id'].'" class="form-control '.$field->cssClass.'" value="" aria-label="'.$f->label.'" placeholder="'.$f['placeholder'].'" />';
					if($field->subLabelPlacement == 'below') {
						$input .= '<label for="input_'.$form_id.'_'.preg_replace('/\./i','_',$f['id']).'">'.($f['customLabel']?$f['customLabel']:$f['label']).'</label>';
					}
					$input .= '</div>';
				}
			}
		}
	}
  
	return $input;
}

add_filter( 'gform_next_button', 'input_to_button', 10, 2 );
add_filter( 'gform_previous_button', 'input_to_button', 10, 2 );
add_filter( 'gform_submit_button', 'input_to_button', 10, 2 );
function input_to_button( $button, $form ) {
    $dom = new DOMDocument();
    $dom->loadHTML( $button );
    $input = $dom->getElementsByTagName( 'input' )->item(0);
    $new_button = $dom->createElement( 'button' );
    $new_button->appendChild( $dom->createTextNode( $input->getAttribute( 'value' ) ) );
    $input->removeAttribute( 'value' );
    foreach( $input->attributes as $attribute ) {
        $new_button->setAttribute( $attribute->name, $attribute->value );
    }
    $input->parentNode->replaceChild( $new_button, $input );
 
    return $dom->saveHtml( $new_button );
}
/** END GRAVITY FORMS <LI> TO <DIV> **/


/** POST TEMPLATE BASED ON CATEGORY **/
add_filter( 'single_template', 'add_postType_slug_template', 10, 1 );
function add_posttype_slug_template( $single_template ) {
	$object = get_queried_object();

	foreach(get_the_category($object->ID) as $cat) {
 
		if(file_exists(locate_template('single-cat-'.$cat->slug.'.php'))) {
			return locate_template('single-cat-' . $cat->slug . '.php');
		}

	}
	return $single_template;
}
/** END POST TEMPLATE BASED ON CATEGORY **/