<?php
/**
 * Header Search
 *
 * Displays header search in main navigation menu
 *
 * @package Dynamico Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Header Search Class
 */
class Dynamico_Pro_Header_Search {

	/**
	 * Header Search Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Dynamico Theme is not active.
		if ( ! current_theme_supports( 'dynamico-pro' ) ) {
			return;
		}

		// Enqueue Header Search JavaScript.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_script' ) );

		// Add search icon on main navigation menu.
		add_action( 'dynamico_header_search', array( __CLASS__, 'add_header_search' ) );

		// Add Header Search checkbox in Customizer.
		add_action( 'customize_register', array( __CLASS__, 'header_search_settings' ) );

		// Hide Header Search if disabled.
		add_filter( 'body_class', array( __CLASS__, 'hide_header_search' ) );
	}

	/**
	 * Enqueue Scroll-To-Top JavaScript
	 *
	 * @return void
	 */
	static function enqueue_script() {

		// Get Theme Options from Database.
		$theme_options = Dynamico_Pro_Customizer::get_theme_options();

		// Embed header search JS if enabled.
		if ( ( true === $theme_options['header_search'] || is_customize_preview() ) && ! self::is_amp() ) :

			wp_enqueue_script( 'dynamico-pro-header-search', DYNAMICO_PRO_PLUGIN_URL . 'assets/js/header-search.min.js', array(), '20220121', true );

		endif;
	}

	/**
	 * Add search form to navigation menu
	 *
	 * @return void
	 */
	static function add_header_search() {

		// Get Theme Options from Database.
		$theme_options = Dynamico_Pro_Customizer::get_theme_options();

		// Show header search if activated.
		if ( true === $theme_options['header_search'] || is_customize_preview() ) : ?>

			<div class="header-search">

				<button class="header-search-icon" aria-expanded="false" aria-controls="header-search-dropdown" <?php self::amp_search_toggle(); ?>>
					<?php echo dynamico_get_svg( 'search' ); ?>
					<span class="screen-reader-text"><?php esc_html_e( 'Toggle search form', 'dynamico-pro' ); ?></span>
				</button>

				<div id="header-search-dropdown" class="header-search-form" <?php self::amp_search_is_toggled(); ?>>
					<?php get_search_form(); ?>
				</div>

			</div>

			<?php
		endif;
	}

	/**
	 * Adds header search checkbox setting
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function header_search_settings( $wp_customize ) {

		// Add Header Search Headline.
		$wp_customize->add_control( new Dynamico_Customize_Header_Control(
			$wp_customize, 'dynamico_theme_options[header_search_title]', array(
				'label'    => esc_html__( 'Header Search', 'dynamico-pro' ),
				'section'  => 'dynamico_section_layout',
				'settings' => array(),
				'priority' => 50,
			)
		) );

		// Add Header Search setting and control.
		$wp_customize->add_setting( 'dynamico_theme_options[header_search]', array(
			'default'           => false,
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'dynamico_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'dynamico_theme_options[header_search]', array(
			'label'    => esc_html__( 'Enable search field in main navigation', 'dynamico-pro' ),
			'section'  => 'dynamico_section_layout',
			'settings' => 'dynamico_theme_options[header_search]',
			'type'     => 'checkbox',
			'priority' => 60,
		) );
	}

	/**
	 * Hide Header Search if deactivated.
	 *
	 * @param array $classes / Body Classes.
	 * @return array $classes
	 */
	static function hide_header_search( $classes ) {

		// Get Theme Options from Database.
		$theme_options = Dynamico_Pro_Customizer::get_theme_options();

		// Add class if header search is enabled.
		if ( true === $theme_options['header_search'] ) {
			$classes[] = 'header-search-enabled';
		}

		// Hide header search in Customizer for instant live preview.
		if ( is_customize_preview() && false === $theme_options['header_search'] ) {
			$classes[] = 'header-search-hidden';
		}

		return $classes;
	}

	/**
	 * Checks if AMP page is rendered.
	 */
	static function is_amp() {
		return function_exists( 'is_amp_endpoint' ) && is_amp_endpoint();
	}

	/**
	 * Adds amp support for search toggle.
	 */
	static function amp_search_toggle() {
		if ( self::is_amp() ) {
			echo "[aria-expanded]=\"headerSearchExpanded? 'true' : 'false'\" ";
			echo 'on="tap:AMP.setState({headerSearchExpanded: !headerSearchExpanded})"';
		}
	}

	/**
	 * Adds amp support for search form.
	 */
	static function amp_search_is_toggled() {
		if ( self::is_amp() ) {
			echo "[class]=\"'header-search-form' + ( headerSearchExpanded ? ' toggled-on' : '' )\"";
		}
	}
}

// Run Class.
add_action( 'init', array( 'Dynamico_Pro_Header_Search', 'setup' ) );
