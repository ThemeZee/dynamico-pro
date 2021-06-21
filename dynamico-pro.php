<?php
/*
Plugin Name: Dynamico Pro
Plugin URI: http://themezee.com/addons/dynamico-pro/
Description: Dynamico Pro is an add-on plugin for Dynamico including additional customization options for colors and typography as well as extra features like navigation menus, header search and footer widgets.
Author: ThemeZee
Author URI: https://themezee.com/
Version: 1.0.1
Text Domain: dynamico-pro
Domain Path: /languages/
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Dynamico Pro
Copyright(C) 2021, ThemeZee.com - support@themezee.com
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main Dynamico_Pro Class
 *
 * @package Dynamico Pro
 */
class Dynamico_Pro {
	/**
	 * Call all Functions to setup the Plugin
	 *
	 * @uses Dynamico_Pro::constants() Setup the constants needed
	 * @uses Dynamico_Pro::includes() Include the required files
	 * @uses Dynamico_Pro::setup_actions() Setup the hooks and actions
	 * @return void
	 */
	static function setup() {

		// Setup Constants.
		self::constants();

		// Setup Translation.
		add_action( 'plugins_loaded', array( __CLASS__, 'translation' ) );

		// Include Files.
		self::includes();

		// Setup Action Hooks.
		self::setup_actions();
	}

	/**
	 * Setup plugin constants
	 *
	 * @return void
	 */
	static function constants() {

		// Define Plugin Name.
		define( 'DYNAMICO_PRO_NAME', 'Dynamico Pro' );

		// Define Version Number.
		define( 'DYNAMICO_PRO_VERSION', '1.0.1' );

		// Define Plugin Name.
		define( 'DYNAMICO_PRO_PRODUCT_ID', 239701 );

		// Define Update API URL.
		define( 'DYNAMICO_PRO_STORE_API_URL', 'https://themezee.com' );

		// Plugin Folder Path.
		define( 'DYNAMICO_PRO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

		// Plugin Folder URL.
		define( 'DYNAMICO_PRO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

		// Plugin Root File.
		define( 'DYNAMICO_PRO_PLUGIN_FILE', __FILE__ );
	}

	/**
	 * Load Translation File
	 *
	 * @return void
	 */
	static function translation() {
		load_plugin_textdomain( 'dynamico-pro', false, dirname( plugin_basename( DYNAMICO_PRO_PLUGIN_FILE ) ) . '/languages/' );
	}

	/**
	 * Include required files
	 *
	 * @return void
	 */
	static function includes() {

		// Include Admin Classes.
		require_once DYNAMICO_PRO_PLUGIN_DIR . 'includes/admin/class-admin-notices.php';
		require_once DYNAMICO_PRO_PLUGIN_DIR . 'includes/admin/class-license-key.php';
		require_once DYNAMICO_PRO_PLUGIN_DIR . 'includes/admin/class-plugin-updater.php';

		// Include Customizer Classes.
		require_once DYNAMICO_PRO_PLUGIN_DIR . 'includes/customizer/class-customizer.php';

		// Include Pro Features.
		require_once DYNAMICO_PRO_PLUGIN_DIR . 'includes/modules/class-author-bio.php';
		require_once DYNAMICO_PRO_PLUGIN_DIR . 'includes/modules/class-block-colors.php';
		require_once DYNAMICO_PRO_PLUGIN_DIR . 'includes/modules/class-custom-fonts.php';
		require_once DYNAMICO_PRO_PLUGIN_DIR . 'includes/modules/class-footer-menu.php';
		require_once DYNAMICO_PRO_PLUGIN_DIR . 'includes/modules/class-footer-widgets.php';
		require_once DYNAMICO_PRO_PLUGIN_DIR . 'includes/modules/class-header-bar.php';
		require_once DYNAMICO_PRO_PLUGIN_DIR . 'includes/modules/class-header-search.php';
		require_once DYNAMICO_PRO_PLUGIN_DIR . 'includes/modules/class-scroll-to-top.php';
		require_once DYNAMICO_PRO_PLUGIN_DIR . 'includes/modules/class-social-icons.php';
		require_once DYNAMICO_PRO_PLUGIN_DIR . 'includes/modules/class-theme-colors.php';
		require_once DYNAMICO_PRO_PLUGIN_DIR . 'includes/modules/class-widget-areas.php';
	}

	/**
	 * Setup Action Hooks
	 *
	 * @see https://codex.wordpress.org/Function_Reference/add_action WordPress Codex
	 * @return void
	 */
	static function setup_actions() {

		// Enqueue Dynamico Pro Stylesheet.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_styles' ), 11 );

		// Add Custom CSS code to the Gutenberg editor.
		add_action( 'enqueue_block_editor_assets', array( __CLASS__, 'enqueue_editor_styles' ), 11 );

		// Add Settings link to Plugin actions.
		add_filter( 'plugin_action_links_' . plugin_basename( DYNAMICO_PRO_PLUGIN_FILE ), array( __CLASS__, 'plugin_action_links' ) );

		// Add automatic plugin updater from ThemeZee Store API.
		add_action( 'admin_init', array( __CLASS__, 'plugin_updater' ), 0 );
	}

	/**
	 * Enqueue Styles
	 *
	 * @return void
	 */
	static function enqueue_styles() {

		// Return early if Dynamico Theme is not active.
		if ( ! current_theme_supports( 'dynamico-pro' ) ) {
			return;
		}

		// Enqueue RTL or default Plugin Stylesheet.
		if ( is_rtl() ) {
			wp_enqueue_style( 'dynamico-pro', DYNAMICO_PRO_PLUGIN_URL . 'assets/css/dynamico-pro-rtl.css', array(), DYNAMICO_PRO_VERSION );
		} else {
			wp_enqueue_style( 'dynamico-pro', DYNAMICO_PRO_PLUGIN_URL . 'assets/css/dynamico-pro.css', array(), DYNAMICO_PRO_VERSION );
		}

		// Enqueue Custom CSS.
		wp_add_inline_style( 'dynamico-pro', self::get_custom_css() );
	}

	/**
	 * Enqueue Editor Styles
	 *
	 * @return void
	 */
	static function enqueue_editor_styles() {

		// Return early if Dynamico Theme is not active.
		if ( ! current_theme_supports( 'dynamico-pro' ) ) {
			return;
		}

		// Enqueue Custom CSS.
		wp_add_inline_style( 'dynamico-editor-styles', self::get_custom_css() );
	}

	/**
	 * Return custom CSS for color and font variables.
	 *
	 * @return void
	 */
	static function get_custom_css() {

		// Get Custom CSS.
		$custom_css = apply_filters( 'dynamico_pro_custom_css_stylesheet', '' );

		// Sanitize CSS Code.
		$custom_css = wp_kses( $custom_css, array( '\'', '\"' ) );
		$custom_css = str_replace( '&gt;', '>', $custom_css );
		$custom_css = preg_replace( '/\n/', '', $custom_css );
		$custom_css = preg_replace( '/\t/', '', $custom_css );

		return $custom_css;
	}

	/**
	 * Add Settings link to the plugin actions
	 *
	 * @param array $actions Plugin action links.
	 * @return array $actions Plugin action links
	 */
	static function plugin_action_links( $actions ) {
		$settings_link = array(
			'settings' => sprintf( '<a href="%s">%s</a>', wp_customize_url() . '?autofocus[panel]=dynamico_options_panel', esc_html__( 'Theme Options', 'dynamico-pro' ) ),
		);

		return array_merge( $settings_link, $actions );
	}

	/**
	 * Plugin Updater
	 *
	 * @return void
	 */
	static function plugin_updater() {
		$theme_options = Dynamico_Pro_Customizer::get_theme_options();

		// Check if license key was entered.
		if ( '' !== $theme_options['license_key'] ) :

			// Setup the updater.
			$dynamico_pro_updater = new Dynamico_Pro_Plugin_Updater( DYNAMICO_PRO_STORE_API_URL, __FILE__, array(
				'version'   => DYNAMICO_PRO_VERSION,
				'license'   => trim( $theme_options['license_key'] ),
				'item_name' => DYNAMICO_PRO_NAME,
				'item_id'   => DYNAMICO_PRO_PRODUCT_ID,
				'author'    => 'ThemeZee',
			) );

		endif;
	}
}

// Run Plugin.
Dynamico_Pro::setup();
