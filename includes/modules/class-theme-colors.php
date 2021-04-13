<?php
/**
 * Theme Colors
 *
 * Adds theme color settings to Customizer and generates color CSS code
 *
 * @package Dynamico Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme Colors Class
 */
class Dynamico_Pro_Theme_Colors {

	/**
	 * Theme Colors Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Dynamico Theme is not active.
		if ( ! current_theme_supports( 'dynamico-pro' ) ) {
			return;
		}

		// Add Custom Color CSS code to custom stylesheet output.
		add_filter( 'dynamico_pro_custom_css_stylesheet', array( __CLASS__, 'custom_colors_css' ) );

		// Add Custom Color Settings.
		add_action( 'customize_register', array( __CLASS__, 'color_settings' ) );
	}

	/**
	 * Adds Color CSS styles in the head area to override default colors
	 *
	 * @param String $custom_css Custom Styling CSS.
	 * @return string CSS code
	 */
	static function custom_colors_css( $custom_css ) {

		// Get Theme Options from Database.
		$theme_options = Dynamico_Pro_Customizer::get_theme_options();

		// Get Default Fonts from settings.
		$default_options = Dynamico_Pro_Customizer::get_default_options();

		// Color Variables.
		$color_variables = '';

		// Set Header Bar Background Color.
		if ( $theme_options['header_bar_color'] !== $default_options['header_bar_color'] ) {
			$color_variables .= '--header-bar-background-color: ' . $theme_options['header_bar_color'] . ';';

			// Check if a light background color was chosen.
			if ( self::is_color_light( $theme_options['header_bar_color'] ) ) {
				$color_variables .= '--header-bar-text-color: #151515;';
			}
		}

		// Set Header Bar Hover Color.
		if ( $theme_options['header_bar_hover_color'] !== $default_options['header_bar_hover_color'] ) {
			$color_variables .= '--header-bar-hover-color: ' . $theme_options['header_bar_hover_color'] . ';';

			// Check if a light background color was chosen.
			if ( self::is_color_light( $theme_options['header_bar_hover_color'] ) ) {
				$color_variables .= '--header-bar-hover-text-color: #151515;';
			}
		}

		// Set Navigation Background Color.
		if ( $theme_options['navi_color'] !== $default_options['navi_color'] ) {
			$color_variables .= '--navi-background-color: ' . $theme_options['navi_color'] . ';';
			$color_variables .= '--featured-background-color: ' . $theme_options['navi_color'] . ';';

			// Check if a light background color was chosen.
			if ( self::is_color_light( $theme_options['navi_color'] ) ) {
				$color_variables .= '--navi-text-color: #151515;';
				$color_variables .= '--featured-text-color: #151515;';
				$color_variables .= '--featured-hover-color: rgba(0, 0, 0, 0.6);';
			}
		}

		// Set Navigation Hover Color.
		if ( $theme_options['navi_hover_color'] !== $default_options['navi_hover_color'] ) {
			$color_variables .= '--navi-hover-color: ' . $theme_options['navi_hover_color'] . ';';
			$color_variables .= '--featured-border-color: ' . $theme_options['navi_hover_color'] . ';';

			// Check if a light background color was chosen.
			if ( self::is_color_light( $theme_options['navi_hover_color'] ) ) {
				$color_variables .= '--navi-hover-text-color: #151515;';
			}
		}

		// Set Link Color.
		if ( $theme_options['link_color'] !== $default_options['link_color'] ) {
			$color_variables .= '--link-color: ' . $theme_options['link_color'] . ';';
			$color_variables .= '--link-hover-color: ' . $theme_options['link_color'] . ';';
		}

		// Set Button Color.
		if ( $theme_options['button_color'] !== $default_options['button_color'] ) {
			$color_variables .= '--button-color: ' . $theme_options['button_color'] . ';';

			// Check if a light background color was chosen.
			if ( self::is_color_light( $theme_options['button_color'] ) ) {
				$color_variables .= '--button-text-color: #151515;';
			}
		}

		// Set Button Hover Color.
		if ( $theme_options['button_hover_color'] !== $default_options['button_hover_color'] ) {
			$color_variables .= '--button-hover-color: ' . $theme_options['button_hover_color'] . ';';

			// Check if a light background color was chosen.
			if ( self::is_color_light( $theme_options['button_hover_color'] ) ) {
				$color_variables .= '--button-hover-text-color: #151515;';
			}
		}

		// Set Title Color.
		if ( $theme_options['title_color'] !== $default_options['title_color'] ) {
			$color_variables .= '--title-color: ' . $theme_options['title_color'] . ';';
			$color_variables .= '--site-title-hover-color: ' . $theme_options['title_color'] . ';';
		}

		// Set Title Hover Color.
		if ( $theme_options['title_hover_color'] !== $default_options['title_hover_color'] ) {
			$color_variables .= '--title-hover-color: ' . $theme_options['title_hover_color'] . ';';
			$color_variables .= '--site-title-color: ' . $theme_options['title_hover_color'] . ';';
		}

		// Set Widget Title Color.
		if ( $theme_options['widget_title_color'] !== $default_options['widget_title_color'] ) {
			$color_variables .= '--widget-title-background-color: ' . $theme_options['widget_title_color'] . ';';

			// Check if a light background color was chosen.
			if ( self::is_color_light( $theme_options['widget_title_color'] ) ) {
				$color_variables .= '--widget-title-text-color: #151515;';
			}
		}

		// Set Footer Color.
		if ( $theme_options['footer_color'] !== $default_options['footer_color'] ) {
			$color_variables .= '--footer-widgets-background-color: ' . $theme_options['footer_color'] . ';';
			$color_variables .= '--footer-background-color: ' . $theme_options['footer_color'] . ';';

			// Check if a light background color was chosen.
			if ( self::is_color_light( $theme_options['footer_color'] ) ) {
				$color_variables .= '--footer-widgets-overlay-color: rgba(0, 0, 0, 0.05);';
				$color_variables .= '--footer-widgets-text-color: #151515;';
				$color_variables .= '--footer-widgets-link-color: rgba(0, 0, 0, 0.6);';
				$color_variables .= '--footer-widgets-link-hover-color: rgba(0, 0, 0, 0.8);';
				$color_variables .= '--footer-widgets-border-color: rgba(0, 0, 0, 0.1);';
				$color_variables .= '--footer-widgets-title-color: rgba(0, 0, 0, 0.1);';
				$color_variables .= '--footer-overlay-color: rgba(0, 0, 0, 0.05);';
				$color_variables .= '--footer-text-color: rgba(0, 0, 0, 0.6);';
				$color_variables .= '--footer-link-color: #151515;';
				$color_variables .= '--footer-link-hover-color: rgba(0, 0, 0, 0.6);';
				$color_variables .= '--footer-border-color: rgba(0, 0, 0, 0.1);';
			}
		}

		// Set Color Variables.
		if ( '' !== $color_variables ) {
			$custom_css .= ':root {' . $color_variables . '}';
		}

		return $custom_css;
	}

	/**
	 * Adds all color settings in the Customizer
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function color_settings( $wp_customize ) {

		// Add Section for Theme Colors.
		$wp_customize->add_section( 'dynamico_pro_section_theme_colors', array(
			'title'    => esc_html__( 'Theme Colors', 'dynamico-pro' ),
			'priority' => 110,
			'panel'    => 'dynamico_options_panel',
		) );

		// Get Default Colors from settings.
		$default_options = Dynamico_Pro_Customizer::get_default_options();

		// Add Header Bar Color setting.
		$wp_customize->add_setting( 'dynamico_theme_options[header_bar_color]', array(
			'default'           => $default_options['header_bar_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'dynamico_theme_options[header_bar_color]', array(
				'label'    => esc_html_x( 'Top Navigation', 'Color Option', 'dynamico-pro' ),
				'section'  => 'dynamico_pro_section_theme_colors',
				'settings' => 'dynamico_theme_options[header_bar_color]',
				'priority' => 10,
			)
		) );

		// Add Header Bar Hover Color setting.
		$wp_customize->add_setting( 'dynamico_theme_options[header_bar_hover_color]', array(
			'default'           => $default_options['header_bar_hover_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'dynamico_theme_options[header_bar_hover_color]', array(
				'label'    => esc_html_x( 'Top Navigation Hover', 'Color Option', 'dynamico-pro' ),
				'section'  => 'dynamico_pro_section_theme_colors',
				'settings' => 'dynamico_theme_options[header_bar_hover_color]',
				'priority' => 20,
			)
		) );

		// Add Navigation Color setting.
		$wp_customize->add_setting( 'dynamico_theme_options[navi_color]', array(
			'default'           => $default_options['navi_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'dynamico_theme_options[navi_color]', array(
				'label'    => esc_html_x( 'Navigation', 'Color Option', 'dynamico-pro' ),
				'section'  => 'dynamico_pro_section_theme_colors',
				'settings' => 'dynamico_theme_options[navi_color]',
				'priority' => 30,
			)
		) );

		// Add Navigation Hover Color setting.
		$wp_customize->add_setting( 'dynamico_theme_options[navi_hover_color]', array(
			'default'           => $default_options['navi_hover_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'dynamico_theme_options[navi_hover_color]', array(
				'label'    => esc_html_x( 'Navigation Hover', 'Color Option', 'dynamico-pro' ),
				'section'  => 'dynamico_pro_section_theme_colors',
				'settings' => 'dynamico_theme_options[navi_hover_color]',
				'priority' => 40,
			)
		) );

		// Add Link Color setting.
		$wp_customize->add_setting( 'dynamico_theme_options[link_color]', array(
			'default'           => $default_options['link_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'dynamico_theme_options[link_color]', array(
				'label'    => esc_html_x( 'Links', 'Color Option', 'dynamico-pro' ),
				'section'  => 'dynamico_pro_section_theme_colors',
				'settings' => 'dynamico_theme_options[link_color]',
				'priority' => 50,
			)
		) );

		// Add Button Color setting.
		$wp_customize->add_setting( 'dynamico_theme_options[button_color]', array(
			'default'           => $default_options['button_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'dynamico_theme_options[button_color]', array(
				'label'    => esc_html_x( 'Buttons', 'Color Option', 'dynamico-pro' ),
				'section'  => 'dynamico_pro_section_theme_colors',
				'settings' => 'dynamico_theme_options[button_color]',
				'priority' => 60,
			)
		) );

		// Add Button Hover Color setting.
		$wp_customize->add_setting( 'dynamico_theme_options[button_hover_color]', array(
			'default'           => $default_options['button_hover_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'dynamico_theme_options[button_hover_color]', array(
				'label'    => esc_html_x( 'Button Hover', 'Color Option', 'dynamico-pro' ),
				'section'  => 'dynamico_pro_section_theme_colors',
				'settings' => 'dynamico_theme_options[button_hover_color]',
				'priority' => 70,
			)
		) );

		// Add Titles Color setting.
		$wp_customize->add_setting( 'dynamico_theme_options[title_color]', array(
			'default'           => $default_options['title_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'dynamico_theme_options[title_color]', array(
				'label'    => esc_html_x( 'Titles', 'Color Option', 'dynamico-pro' ),
				'section'  => 'dynamico_pro_section_theme_colors',
				'settings' => 'dynamico_theme_options[title_color]',
				'priority' => 80,
			)
		) );

		// Add Title Hover Color setting.
		$wp_customize->add_setting( 'dynamico_theme_options[title_hover_color]', array(
			'default'           => $default_options['title_hover_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'dynamico_theme_options[title_hover_color]', array(
				'label'    => esc_html_x( 'Title Hover', 'Color Option', 'dynamico-pro' ),
				'section'  => 'dynamico_pro_section_theme_colors',
				'settings' => 'dynamico_theme_options[title_hover_color]',
				'priority' => 90,
			)
		) );

		// Add Widget Titles Color setting.
		$wp_customize->add_setting( 'dynamico_theme_options[widget_title_color]', array(
			'default'           => $default_options['widget_title_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'dynamico_theme_options[widget_title_color]', array(
				'label'    => esc_html_x( 'Widget Titles', 'Color Option', 'dynamico-pro' ),
				'section'  => 'dynamico_pro_section_theme_colors',
				'settings' => 'dynamico_theme_options[widget_title_color]',
				'priority' => 100,
			)
		) );

		// Add Footer Color setting.
		$wp_customize->add_setting( 'dynamico_theme_options[footer_color]', array(
			'default'           => $default_options['footer_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'dynamico_theme_options[footer_color]', array(
				'label'    => esc_html_x( 'Footer', 'Color Option', 'dynamico-pro' ),
				'section'  => 'dynamico_pro_section_theme_colors',
				'settings' => 'dynamico_theme_options[footer_color]',
				'priority' => 110,
			)
		) );
	}

	/**
	 * Returns color brightness.
	 *
	 * @param int Number of brightness.
	 */
	static function get_color_brightness( $hex_color ) {

		// Remove # string.
		$hex_color = str_replace( '#', '', $hex_color );

		// Convert into RGB.
		$r = hexdec( substr( $hex_color, 0, 2 ) );
		$g = hexdec( substr( $hex_color, 2, 2 ) );
		$b = hexdec( substr( $hex_color, 4, 2 ) );

		return ( ( ( $r * 299 ) + ( $g * 587 ) + ( $b * 114 ) ) / 1000 );
	}

	/**
	 * Check if the color is light.
	 *
	 * @param bool True if color is light.
	 */
	static function is_color_light( $hex_color ) {
		return ( self::get_color_brightness( $hex_color ) > 130 );
	}

	/**
	 * Check if the color is dark.
	 *
	 * @param bool True if color is dark.
	 */
	static function is_color_dark( $hex_color ) {
		return ( self::get_color_brightness( $hex_color ) <= 130 );
	}
}

// Run Class.
add_action( 'init', array( 'Dynamico_Pro_Theme_Colors', 'setup' ) );
