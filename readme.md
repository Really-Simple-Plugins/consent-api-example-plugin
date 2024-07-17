## Consent API Example plugin
Contributors: RogierLankhorst

Tags: consent, privacy

Requires at least: 5.0

License: GPL2

Tested up to: 6.6.0

Requires PHP: 5.6

Stable tag: 1.1.0

Simple plugin to demonstrate the usage of the WP Consent API.

### Description
This plugin demonstrates the usage of the WP Consent API. It provides a shortcode that can be used to display content based on the user's consent for different categories.

### Usage
To use this plugin, add the appropriate shortcode to your pages or posts as described below:

1. **Display Content for All Categories**
   - Use the shortcode `[example-plugin-shortcode]` to display content for all consent categories.

2. **Display Content for Specific Categories**
   - Use the following shortcodes to display content for specific consent categories:
     - `[example-plugin-shortcode category='marketing']`: Displays content for the 'marketing' consent category.
     - `[example-plugin-shortcode category='functional']`: Displays content for the 'functional' consent category.
     - `[example-plugin-shortcode category='preferences']`: Displays content for the 'preferences' consent category.
     - `[example-plugin-shortcode category='statistics']`: Displays content for the 'statistics' consent category.
     - `[example-plugin-shortcode category='statistics-anonymous']`: Displays content for the 'statistics-anonymous' consent category.

3. **Install WP Consent API Support Plugins**
   - Install a plugin with WP Consent API support. Examples include:
     - [Complianz GDPR](https://github.com/really-simple-plugins/complianz-gdpr)
     - [Iubenda Cookie Law Solution](https://wordpress.org/plugins/iubenda-cookie-law-solution/)
   - Install the [WP Consent API](http://wordpress.org/plugins/wp-consent-api).

### Installation
1. Upload the plugin files to the `/wp-content/plugins/wp-consent-api-example-plugin` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the shortcode `[example-plugin-shortcode]` in your posts or pages to display content for all categories.
4. Use the shortcode `[example-plugin-shortcode category='marketing']` (or other categories such as 'functional', 'preferences', 'statistics', 'statistics-anonymous') to display content for a specific category.

### Frequently Asked Questions

1. How do I use the shortcode?
   * You can use the shortcode `[example-plugin-shortcode category='marketing']` to display content for the 'marketing' consent category. If no category is specified, it will display content for all categories.

2. Do I need any other plugins for this to work?
   * Yes, you need to install a plugin that supports the WP Consent API and the WP Consent API plugin itself. Examples include:
   - [Complianz GDPR](https://github.com/really-simple-plugins/complianz-gdpr)
   - [Iubenda Cookie Law Solution](https://wordpress.org/plugins/iubenda-cookie-law-solution/)
   - [WP Consent API](http://wordpress.org/plugins/wp-consent-api)

### Changelog

#### 1.1.0
* Applied code standards and improved documentation.
* Enhanced the readme with detailed usage instructions.
* Added support for multiple categories in shortcode usage examples.

#### 1.0.0
* Initial release.
