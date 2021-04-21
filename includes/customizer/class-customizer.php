<?php
/**
 * Customizer
 *
 * Setup the Customizer and theme options for the Pro plugin
 *
 * @package Dynamico Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer Class
 */
class Dynamico_Pro_Customizer {

	/**
	 * Customizer Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Dynamico Theme is not active.
		if ( ! current_theme_supports( 'dynamico-pro' ) ) {
			return;
		}

		// Enqueue scripts and styles in the Customizer.
		add_action( 'customize_preview_init', array( __CLASS__, 'customize_preview_js' ) );
		add_action( 'customize_controls_print_styles', array( __CLASS__, 'customize_preview_css' ) );

		// Remove Upgrade section.
		remove_action( 'customize_register', 'dynamico_customize_register_upgrade_settings' );
	}

	/**
	 * Get saved user settings from database or plugin defaults
	 *
	 * @return array
	 */
	static function get_theme_options() {

		// Merge Theme Options Array from Database with Default Options Array.
		return wp_parse_args( get_option( 'dynamico_theme_options', array() ), self::get_default_options() );
	}

	/**
	 * Returns the default settings of the plugin
	 *
	 * @return array
	 */
	static function get_default_options() {
		return array(
			'license_key'               => '',
			'license_status'            => 'inactive',
			'header_search'             => false,
			'author_bio'                => false,
			'scroll_to_top'             => false,
			'primary_color'             => '#e84747',
			'secondary_color'           => '#cb3e3e',
			'tertiary_color'            => '#ae3535',
			'contrast_color'            => '#4747e8',
			'accent_color'              => '#47e897',
			'highlight_color'           => '#e8e847',
			'light_gray_color'          => '#eeeeee',
			'gray_color'                => '#777777',
			'dark_gray_color'           => '#333333',
			'header_bar_color'          => '#e84747',
			'header_bar_hover_color'    => '#333333',
			'navi_color'                => '#333333',
			'navi_hover_color'          => '#e84747',
			'link_color'                => '#e84747',
			'button_color'              => '#e84747',
			'button_hover_color'        => '#333333',
			'title_color'               => '#333333',
			'title_hover_color'         => '#e84747',
			'widget_title_color'        => '#333333',
			'footer_color'              => '#333333',
			'text_font'                 => 'Ubuntu',
			'title_font'                => 'Francois One',
			'title_is_bold'             => false,
			'title_is_uppercase'        => false,
			'navi_font'                 => 'Francois One',
			'navi_is_bold'              => false,
			'navi_is_uppercase'         => true,
			'widget_title_font'         => 'Ubuntu',
			'widget_title_is_bold'      => false,
			'widget_title_is_uppercase' => true,
		);
	}

	/**
	 * Embed JS file to make Theme Customizer preview reload changes asynchronously.
	 *
	 * @return void
	 */
	static function customize_preview_js() {
		wp_enqueue_script( 'dynamico-pro-customize-preview', DYNAMICO_PRO_PLUGIN_URL . 'assets/js/customize-preview.min.js', array( 'customize-preview' ), '20210420', true );
	}

	/**
	 * Embed CSS styles for the theme options in the Customizer
	 *
	 * @return void
	 */
	static function customize_preview_css() {
		wp_enqueue_style( 'dynamico-pro-customizer-css', DYNAMICO_PRO_PLUGIN_URL . 'assets/css/customizer.css', array(), '20210420' );
	}
}

// Run Class.
add_action( 'init', array( 'Dynamico_Pro_Customizer', 'setup' ) );
