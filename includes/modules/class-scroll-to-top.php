<?php
/**
 * Scroll to Top
 *
 * Displays scroll to top button based on theme options
 *
 * @package Dynamico Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Scroll to Top Class
 */
class Dynamico_Pro_Scroll_To_Top {

	/**
	 * Scroll to Top Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Dynamico Theme is not active.
		if ( ! current_theme_supports( 'dynamico-pro' ) ) {
			return;
		}

		// Enqueue Scroll-To-Top JavaScript.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_script' ) );

		// Add Scroll-To-Top Checkbox in Customizer.
		add_action( 'customize_register', array( __CLASS__, 'scroll_to_top_settings' ) );
	}

	/**
	 * Enqueue Scroll-To-Top JavaScript
	 *
	 * @return void
	 */
	static function enqueue_script() {

		// Get Theme Options from Database.
		$theme_options = Dynamico_Pro_Customizer::get_theme_options();

		// Call Credit Link function of theme if credit link is activated.
		if ( true === $theme_options['scroll_to_top'] && ! self::is_amp() ) :

			wp_enqueue_script( 'dynamico-pro-scroll-to-top', DYNAMICO_PRO_PLUGIN_URL . 'assets/js/scroll-to-top.min.js', array(), '20220121', true );

			// Passing Parameters to navigation.js.
			wp_localize_script( 'dynamico-pro-scroll-to-top', 'dynamicoProScrollToTop', array( 'icon' => dynamico_get_svg( 'collapse' ) ) );

		endif;
	}

	/**
	 * Add scroll to top checkbox setting
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function scroll_to_top_settings( $wp_customize ) {

		// Add Scroll to Top headline.
		$wp_customize->add_control( new Dynamico_Customize_Header_Control(
			$wp_customize, 'dynamico_theme_options[scroll_top_title]', array(
				'label'    => esc_html__( 'Scroll to Top', 'dynamico-pro' ),
				'section'  => 'dynamico_section_footer',
				'settings' => array(),
				'priority' => 40,
			)
		) );

		// Add Scroll to Top setting.
		$wp_customize->add_setting( 'dynamico_theme_options[scroll_to_top]', array(
			'default'           => false,
			'type'              => 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'dynamico_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'dynamico_theme_options[scroll_to_top]', array(
			'label'    => esc_html__( 'Display Scroll to Top Button', 'dynamico-pro' ),
			'section'  => 'dynamico_section_footer',
			'settings' => 'dynamico_theme_options[scroll_to_top]',
			'type'     => 'checkbox',
			'priority' => 50,
		) );
	}

	/**
	 * Checks if AMP page is rendered.
	 */
	static function is_amp() {
		return function_exists( 'is_amp_endpoint' ) && is_amp_endpoint();
	}
}

// Run Class.
add_action( 'init', array( 'Dynamico_Pro_Scroll_To_Top', 'setup' ) );
