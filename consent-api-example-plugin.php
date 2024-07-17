<?php //phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase, WordPress.Files.FileName.InvalidClassFileName
/**
 * Plugin Name: Example plugin for the WP Consent Level API
 * Plugin URI: https://www.wordpress.org/plugins/wp-consent-api
 * Description: Example plugin to demonstrate usage of the Consent API
 * Version: 1.1.0
 * Text Domain: wp-consent-api
 * Domain Path: /languages
 * Author: WP Privacy Team
 * Author URI:
 */

/**
 * Class WP_Consent_API_Example_Plugin
 *
 * Main class for the WP Consent API Example Plugin.
 */
class WP_Consent_API_Example_Plugin {
	/**
	 * Plugin version.
	 *
	 * @var string
	 */
	public $version = '1.1.0';

	/**
	 * Plugin basename.
	 *
	 * @var string
	 */
	public $basename;

	/**
	 * Plugin directory URL.
	 *
	 * @var string
	 */
	public $dir_url;

	/**
	 * Plugin text domain.
	 *
	 * @var string
	 */
	public $domain = 'wp-consent-api';

	/**
	 * Shortcode for the plugin.
	 *
	 * @var string
	 */
	public $shortcode = 'example-plugin-shortcode';

	/**
	 * Content ID for the plugin.
	 *
	 * @var string
	 */
	public $content_id = 'wp-consent-example-content';

	/**
	 * Default categories for consent.
	 *
	 * @var array
	 */
	public $default_categories = array(
		'functional',
		'preferences',
		'statistics',
		'statistics-anonymous',
		'marketing',
	);

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->basename = plugin_basename( __FILE__ );
		$this->dir_url  = plugin_dir_url( __FILE__ );

		add_filter( 'wp_consent_api_registered_' . $this->basename, array( $this, 'register_with_consent_api' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
		add_shortcode( $this->shortcode, array( $this, 'render_shortcode' ) );
	}

	/**
	 * Register with the Consent API.
	 *
	 * @return bool
	 */
	public function register_with_consent_api() {
		return true;
	}

	/**
	 * Enqueue the plugin's JavaScript assets.
	 */
	public function enqueue_assets() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_script(
			'wp-consent-example-plugin',
			$this->dir_url . "assets/consent-api-example$suffix.js",
			array( 'jquery' ),
			$this->version,
			true
		);

		// Localize script to pass data to JavaScript.
		wp_localize_script(
			'wp-consent-example-plugin',
			'wpConsentExampleData',
			array(
				'contentId' => $this->content_id,
			)
		);

		// Enqueue styles.
		wp_enqueue_style( 'wp-consent-example-plugin', $this->dir_url . 'assets/style.css', array(), $this->version );
	}

	/**
	 * Render the shortcode content.
	 *
	 * @param   array $attributes  Shortcode attributes.
	 *
	 * @return string
	 */
	public function render_shortcode( array $attributes = array() ) {
		$attributes = shortcode_atts(
			array(
				'category' => '',
			),
			$attributes,
			$this->shortcode
		);

		$categories = $attributes['category'] ? array( sanitize_text_field( $attributes['category'] ) ) : $this->default_categories;

		ob_start();
		?>
		<div id="<?php echo esc_attr( $this->content_id ); ?>" class="wp-consent-example">
			<?php foreach ( $categories as $category ) : ?>
				<?php $this->render_category_content( $category ); ?>
			<?php endforeach; ?>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * Render the category content.
	 *
	 * @param   string $category  The consent category.
	 */
	public function render_category_content( $category ) {
		?>
		<div class="category-container <?php echo esc_attr( $category ); ?>-content" data-consentcategory="<?php echo esc_attr( $category ); ?>">
			<h4 class="no-consent-given">
				<?php
				// translators: %s: Consent category name.
				printf( esc_html__( 'No consent has been given yet for %s category.', 'wp-consent-api' ), '<strong>' . esc_html( $category ) . '</strong>' );
				?>
			</h4>
			<h4 class="consent-given" style="display: none;">
				<?php
				// translators: %s: Consent category name.
				printf( esc_html__( 'Consent has been given for %s category.', 'wp-consent-api' ), '<strong>' . esc_html( $category ) . '</strong>' );
				?>
			</h4>
		</div>
		<?php
	}
}

// Initialize the plugin.
new WP_Consent_API_Example_Plugin();
