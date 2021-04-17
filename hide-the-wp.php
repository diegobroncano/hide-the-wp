<?php
/**
 * Hide Wordpress plugin.
 *
 * @package      Hide_The_WP
 * @link         https://hernandezf.com/hide-the-wp
 * @license      GPL v3 or later
 *
 * @wordpress-plugin
 * Plugin Name:       Hide The WP
 * Version:           0.1
 * Plugin URI:        https://hernandezf.com/hide-wordpress
 * Description:       Light and minimalist plugin to remove the WordPress trails from your page and improve your security.
 * Author:            Diego Hernández
 * Author URI:        https://hernandezf.com
 * License:           GPL v3 OR LATER
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       hide-the-wp
 * Domain Path:       /languages
 * Requires PHP:      7.0
 */

// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
	die();
}

/**
 * Class to initialize Hide The WP plugin
 *
 * @package Hide_The_WP
 */
final class HTWP_init {

	/**
	 * Plugin version
	 *
	 * @type string
	 */
	const version = '0.1';

	/**
	 * Plugin text domain
	 *
	 * @type string
	 */
	const textdomain = 'hide_the_wp';

	public function load()
	{
		// Load plugin constants.
		$this->pluginConstants();

		// Include necessary files.
		$this->includes();

		// Initialize all classes.
		$this->inits();

	}

	/**
	 * Define all plugin constants:
	 * - Prefix
	 * - Version
	 * - Text domain
	 * - Folder path
	 * - Folder URL
	 * - Root file
	 */
	private function pluginConstants()
	{
		// Plugin prefix
		if ( !defined( 'HTWP_PREFIX' ) ) {
			define( 'HTWP_PREFIX', 'HTWP' );
		}

		// Plugin version
		if ( !defined( 'HTWP_VERSION' ) ) {
			define( 'HTWP_VERSION', self::version );
		}

		// Plugin text domain
		if ( !defined( 'HTWP_TEXTDOMAIN' ) ) {
			define( 'HTWP_TEXTDOMAIN', self::textdomain );
		}

		// Plugin folder path
		if ( !defined( 'HTWP_PLUGIN_DIR' ) ) {
			define( 'HTWP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}

		// Plugin folder URL
		if ( !defined( 'HTWP_PLUGIN_URL' ) ) {
			define( 'HTWP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}

		// Plugin root file
		if ( !defined( 'HTWP_PLUGIN_FILE' ) ) {
			define( 'HTWP_PLUGIN_FILE', __FILE__ );
		}

	}

	/**
	 * Require all necessary classes.
	 *
	 *  @noinspection PhpIncludeInspection
	 */
	private function includes()
	{
		require_once HTWP_PLUGIN_DIR . 'class-htwp-core.php';
		require_once HTWP_PLUGIN_DIR . 'class-htwp-admin.php';
	}

	/**
	 * Initialize all required classes.
	 */
	private function inits()
	{
		$admin = new HTWP_admin();
		$admin->load();

		$core = new HTWP_core();
		$core->load();
	}

}

$init = new HTWP_init();
$init->load();

//add_filter('the_generator', '__return_false');