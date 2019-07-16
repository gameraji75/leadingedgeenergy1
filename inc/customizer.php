<?php
/**
 * Understrap Theme Customizer
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'understrap_customize_register' ) ) {
	/**
	 * Register basic customizer support.
	 *
	 * @param object $wp_customize Customizer reference.
	 */
	function understrap_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
}
add_action( 'customize_register', 'understrap_customize_register' );

if ( ! function_exists( 'understrap_theme_customize_register' ) ) {
	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	function understrap_theme_customize_register( $wp_customize ) {

		// Theme layout settings.
		$wp_customize->add_section(
			'understrap_theme_layout_options',
			array(
				'title'       => __( 'Child Theme Layout Settings', 'understrap' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Container width and sidebar defaults', 'understrap' ),
				'priority'    => 160,
			)
		);

		/**
		 * Select sanitization function
		 *
		 * @param string               $input   Slug to sanitize.
		 * @param WP_Customize_Setting $setting Setting instance.
		 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
		 */
		function understrap_theme_slug_sanitize_select( $input, $setting ) {

			// Ensure input is a slug (lowercase alphanumeric characters, dashes and underscores are allowed only).
			$input = sanitize_key( $input );

			// Get the list of possible select options.
			$choices = $setting->manager->get_control( $setting->id )->choices;

				// If the input is a valid key, return it; otherwise, return the default.
				return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

		}

		$wp_customize->add_setting(
			'understrap_container_type',
			array(
				'default'           => 'container',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_container_type',
				array(
					'label'       => __( 'Container Width', 'understrap' ),
					'description' => __( 'Choose between Bootstrap\'s container and container-fluid', 'understrap' ),
					'section'     => 'understrap_theme_layout_options',
					'settings'    => 'understrap_container_type',
					'type'        => 'select',
					'choices'     => array(
						'container'       => __( 'Fixed width container', 'understrap' ),
						'container-fluid' => __( 'Full width container', 'understrap' ),
					),
					'priority'    => '10',
				)
			)
		);
		
		$wp_customize->add_setting(
			'understrap_posts_header_color',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'understrap_posts_header_color',
				array(
					'label'       => __( 'Posts Header Color', 'understrap' ),
					'description' => __( 'Apply header color to all posts', 'understrap' ),
					'section'     => 'understrap_theme_layout_options',
					'settings'    => 'understrap_posts_header_color',
					'priority'    => '10',
				)
			)
		);
		
		$wp_customize->add_setting(
			'understrap_posts_header_text_color',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'understrap_posts_header_text_color',
				array(
					'label'       => __( 'Posts Header Color', 'understrap' ),
					'description' => __( 'Apply header color to all posts', 'understrap' ),
					'section'     => 'understrap_theme_layout_options',
					'settings'    => 'understrap_posts_header_text_color',
					'priority'    => '10',
				)
			)
		);
		
		$wp_customize->add_setting(
			'understrap_nav_fixed',
			array(
				'default'           => false,
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_nav_fixed',
				array(
					'label'       => __( 'Navigation top fixed', 'understrap' ),
					'description' => __( 'Make nav bar stick at the top', 'understrap' ),
					'section'     => 'understrap_theme_layout_options',
					'settings'    => 'understrap_nav_fixed',
					'type'        => 'checkbox',
					'priority'    => '20',
				)
			)
		);

		$wp_customize->add_setting(
			'understrap_sidebar_position',
			array(
				'default'           => 'right',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_sidebar_position',
				array(
					'label'             => __( 'Sidebar Positioning', 'understrap' ),
					'description'       => __(
						'Set sidebar\'s default position. Can either be: right, left, both or none. Note: this can be overridden on individual pages.',
						'understrap'
					),
					'section'           => 'understrap_theme_layout_options',
					'settings'          => 'understrap_sidebar_position',
					'type'              => 'select',
					'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
					'choices'           => array(
						'right' => __( 'Right sidebar', 'understrap' ),
						'left'  => __( 'Left sidebar', 'understrap' ),
						'both'  => __( 'Left & Right sidebars', 'understrap' ),
						'none'  => __( 'No sidebar', 'understrap' ),
					),
					'priority'          => '30',
				)
			)
		);
		
		$wp_customize->add_setting(
			'show_page_title',
			array(
				'default'           => 'hide',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'show_page_title',
				array(
					'label'       => __( 'Page Title', 'understrap' ),
					'description' => __( 'Show or hide titles above page content. Note: this can be overridden on individual pages.', 'understrap' ),
					'section'     => 'understrap_theme_layout_options',
					'settings'    => 'show_page_title',
					'type'        => 'select',
					'choices'     => array(
						'hide'    => __( 'Hide', 'understrap' ),
						'show'    => __( 'Show', 'understrap' ),
					),
					'priority'    => '40',
				)
			)
		);
		
		$wp_customize->add_setting(
			'footer_padding',
			array(
				'default'           => '0',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'footer_padding',
				array(
					'label'       => __( 'Footer Padding', 'understrap' ),
					'description' => __( 'Adjust footer padding.', 'understrap' ),
					'section'     => 'understrap_theme_layout_options',
					'settings'    => 'footer_padding',
					'type'        => 'select',
					'choices'     => array(
						'0'    => __( '0', 'understrap' ),
						'1'    => __( '1', 'understrap' ),
						'2'    => __( '2', 'understrap' ),
						'3'    => __( '3', 'understrap' ),
						'4'    => __( '4', 'understrap' ),
						'5'    => __( '5', 'understrap' ),
					),
					'priority'    => '50',
				)
			)
		);
	}
} // endif function_exists( 'understrap_theme_customize_register' ).
add_action( 'customize_register', 'understrap_theme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( ! function_exists( 'understrap_customize_preview_js' ) ) {
	/**
	 * Setup JS integration for live previewing.
	 */
	function understrap_customize_preview_js() {
		wp_enqueue_script(
			'understrap_customizer',
			get_template_directory_uri() . '/js/customizer.js',
			array( 'customize-preview' ),
			'20130508',
			true
		);
	}
}
add_action( 'customize_preview_init', 'understrap_customize_preview_js' );
