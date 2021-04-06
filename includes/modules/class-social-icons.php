<?php
/**
 * Social Icons Menus
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
class Dynamico_Pro_Social_Icons {

	/**
	 * Displays social icons menu
	 *
	 * @return void
	 */
	static function display_social_icons_menu( $menu ) {
		wp_nav_menu( array(
			'theme_location' => $menu,
			'container'      => false,
			'menu_class'     => $menu . '-menu social-icons-menu',
			'echo'           => true,
			'fallback_cb'    => '',
			'link_before'    => '<span class = "screen-reader-text">',
			'link_after'     => '</span>',
			'depth'          => 1,
		) );
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
			'social-header-bar' => esc_html__( 'Social Icons (Top Navigation)', 'dynamico-pro' ),
			'social-footer'     => esc_html__( 'Social Icons (Footer)', 'dynamico-pro' ),
		) );

	}
}

// Register navigation menus in backend.
add_action( 'after_setup_theme', array( 'Dynamico_Pro_Social_Icons', 'register_nav_menus' ), 30 );
