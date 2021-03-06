<?php
/**
 * Header Bar
 *
 * @package Dynamico Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Header Bar Class
 */
class Dynamico_Pro_Header_Bar {

	/**
	 * Class Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Dynamico Theme is not active.
		if ( ! current_theme_supports( 'dynamico-pro' ) ) {
			return;
		}

		// Display Header Bar.
		add_action( 'dynamico_before_header', array( __CLASS__, 'display_header_bar' ), 20 );
	}

	/**
	 * Displays top navigation and social menu on header bar
	 *
	 * @return void
	 */
	static function display_header_bar() {

		// Get theme options.
		$theme_options = Dynamico_Pro_Customizer::get_theme_options();

		// Check if there is content for the header bar.
		if ( has_nav_menu( 'secondary' ) || has_nav_menu( 'social-header-bar' ) ) : ?>

			<div id="header-top" class="header-bar-wrap">

				<div id="header-bar" class="header-bar">

					<?php
					// Check if there is a social icons top menu.
					if ( has_nav_menu( 'social-header-bar' ) ) :
						?>

						<div class="header-bar-social-menu-wrap social-menu-wrap">

							<?php Dynamico_Pro_Social_Icons::display_social_icons_menu( 'social-header-bar' ); ?>

						</div>

						<?php
					endif;

					// Check if there is a top navigation menu.
					if ( has_nav_menu( 'secondary' ) ) :
						?>

						<button class="secondary-menu-toggle menu-toggle" aria-controls="secondary-menu" aria-expanded="false" <?php self::amp_menu_toggle(); ?>>
							<?php
							echo dynamico_get_svg( 'ellipsis' );
							echo dynamico_get_svg( 'close' );
							?>
							<span class="menu-toggle-text"><?php esc_html_e( 'Menu', 'dynamico-pro' ); ?></span>
						</button>

						<div class="secondary-navigation">

							<nav class="top-navigation" role="navigation" <?php self::amp_menu_is_toggled(); ?> aria-label="<?php esc_attr_e( 'Secondary Menu', 'dynamico-pro' ); ?>">

								<?php
								wp_nav_menu(
									array(
										'theme_location' => 'secondary',
										'menu_id'        => 'secondary-menu',
										'container'      => false,
									)
								);
								?>
							</nav><!-- .top-navigation -->

						</div><!-- .secondary-navigation -->

						<?php
					endif;
					?>

				</div>

			</div>

			<?php
		endif;
	}

	/**
	 * Register navigation menus
	 *
	 * @return void
	 */
	static function register_nav_menus() {

		// Return early if Dynamico Theme is not active.
		if ( ! current_theme_supports( 'dynamico-pro' ) ) {
			return;
		}

		register_nav_menus( array(
			'secondary' => esc_html__( 'Top Navigation', 'dynamico-pro' ),
		) );
	}

	/**
	 * Adds amp support for menu toggle.
	 */
	static function amp_menu_toggle() {
		if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
			echo "[aria-expanded]=\"secondaryMenuExpanded? 'true' : 'false'\" ";
			echo 'on="tap:AMP.setState({secondaryMenuExpanded: !secondaryMenuExpanded})"';
		}
	}

	/**
	 * Adds amp support for mobile dropdown navigation menu.
	 */
	static function amp_menu_is_toggled() {
		if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
			echo "[class]=\"'top-navigation' + ( secondaryMenuExpanded ? ' toggled-on' : '' )\"";
		}
	}
}

// Run Class.
add_action( 'init', array( 'Dynamico_Pro_Header_Bar', 'setup' ) );

// Register navigation menus in backend.
add_action( 'after_setup_theme', array( 'Dynamico_Pro_Header_Bar', 'register_nav_menus' ), 20 );
