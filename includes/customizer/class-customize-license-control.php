<?php
/**
 * License Control for the Customizer
 *
 * @package Dynamico Pro
 */

/**
 * Make sure that custom controls are only defined in the Customizer
 */
if ( class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Displays a custom License control. Allows to switch fonts for particular elements on the theme.
	 */
	class Dynamico_Pro_Customize_License_Control extends WP_Customize_Control {

		/**
		 * Declare the control type. Critical for JS constructor.
		 *
		 * @var string
		 */
		public $type = 'dynamico_pro_license_key';

		/**
		 * Localization Strings.
		 *
		 * @var array
		 */
		public $l10n = array();

		/**
		 * License Status.
		 *
		 * @var array
		 */
		public $status = '';

		/**
		 * Setup Font Control
		 *
		 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
		 * @param String               $id      Control ID.
		 * @param array                $args    Arguments to override class property defaults.
		 * @return void
		 */
		public function __construct( $manager, $id, $args = array() ) {

			// Make Buttons translateable.
			$this->l10n = array(
				'activate'     => esc_html__( 'Activate License', 'dynamico-pro' ),
				'deactivate'   => esc_html__( 'Deactivate License', 'dynamico-pro' ),
				'loading'      => esc_html__( 'Loading...', 'dynamico-pro' ),
				'valid'        => esc_html__( 'Active', 'dynamico-pro' ),
				'invalid'      => esc_html__( 'Invalid', 'dynamico-pro' ),
				'expired'      => esc_html__( 'Expired', 'dynamico-pro' ),
				'inactive'     => esc_html__( 'Inactive', 'dynamico-pro' ),
				'valid_desc'   => esc_html__( 'You are receiving updates.', 'dynamico-pro' ),
				'invalid_desc' => esc_html__( 'Please make sure you have not reached site limits and/or expiration date.', 'dynamico-pro' ),
				'expired_desc' => esc_html__( 'Your license has expired, renew today to continue getting updates and support!', 'dynamico-pro' ),
			);

			// Set License status.
			$theme_options = Dynamico_Pro_Customizer::get_theme_options();
			$this->status  = $theme_options['license_status'];

			parent::__construct( $manager, $id, $args );
		}

		/**
		 * Enqueue License Control JS
		 *
		 * @return void
		 */
		public function enqueue() {
			// Register and Enqueue Custom License JS Constructor.
			wp_enqueue_script( 'dynamico-pro-custom-license-control', DYNAMICO_PRO_PLUGIN_URL . 'assets/js/custom-license-control.min.js', array( 'customize-controls' ), '20191114', true );
		}

		/**
		 * Display Control
		 *
		 * @return void
		 */
		public function render_content() {

			$l10n = json_encode( $this->l10n );
			?>

			<div class="customize-license-control" data-l10n="<?php echo esc_attr( $l10n ); ?>" data-status="<?php echo esc_attr( $this->status ); ?>">

				<span class="customize-control-title"><?php echo esc_html__( 'Pro Version License', 'dynamico-pro' ); ?></span>
				<div class="license-status"></div>
				<div class="license-description description"></div>

				<label class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</label>

				<input id="_customize-input-<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" type="text" value="<?php echo esc_attr( $this->value() ); ?>">

				<div class="actions"></div>

				<p class="license-note"><?php printf( __( 'You can find your license keys and manage your active sites on <a href="%s" target="_blank">themezee.com</a>.', 'dynamico-pro' ), __( 'https://themezee.com/license-keys/', 'dynamico-pro' ) . '?utm_source=customizer&utm_medium=textlink&utm_campaign=dynamico-pro&utm_content=license-keys' ); ?></p>

			</div>

			<?php
		}
	}

endif;
