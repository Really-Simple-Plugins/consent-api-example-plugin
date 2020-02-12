<?php
/**
 * Plugin Name: Example plugin for the WP Consent Level API
 * Plugin URI: https://www.wordpress.org/plugins/wp-consent-api
 * Description: Example plugin to demonstrate usage of the Consent API
 * Version: 1.0.0
 * Text Domain: wp-consent-api
 * Domain Path: /languages
 * Author: WP privacy team
 * Author URI:
 */


$plugin_data = get_file_data( __FILE__, array( 'Version' => 'Version' ), false );
define( 'CONSENT_API_EXAMPLE_PLUGIN_VERSION', $plugin_data['Version'] );$plugin = plugin_basename(__FILE__);

/**
 * Tell the consent API we're following the api
 */
add_filter("wp_consent_api_registered_$plugin", function(){return true;});

add_action( 'wp_enqueue_scripts', 'example_plugin_enqueue_assets' );
function example_plugin_enqueue_assets( $hook ) {
	wp_enqueue_script( 'example-plugin', plugin_dir_url(__FILE__) . "main.js", array('jquery'), CONSENT_API_EXAMPLE_PLUGIN_VERSION, true );
}

add_shortcode('example-plugin-shortcode', 'example_plugin_load_document');
function example_plugin_load_document($atts = [], $content = null, $tag = '')
{
	$atts = array_change_key_case((array)$atts, CASE_LOWER);
	ob_start();

	// override default attributes with user attributes
	$atts = shortcode_atts(array('category' => 'marketing'), $atts, $tag);
	//default
	$category = 'marketing';
	if (function_exists('wp_validate_consent_category')){
		$category = wp_validate_consent_category($atts['category']);
    }

	?>
	<div id="example-plugin-content" data-consentcategory="<?php echo $category?>">
		<div class="functional-content">
			<h1>No consent has been given yet for category <?php echo $category?>. </h1>
		</div>
		<div class="marketing-content" style="display:none">
			<h1>Woohoo! consent has been given for category <?php echo $category?> :)</h1>
		</div>

	</div>

	<?php
	return ob_get_clean();
}
