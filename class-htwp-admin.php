<?php

/**
 * Class to handle admin options and menus.
 *
 * @package Hide_The_WP
 */
class HTWP_admin
{
	/**
	 * Initialize support for Hide The WP options in WordPress backend.
	 */
	public function load()
	{
		// Set up internationalization.
		add_action( 'plugin_loaded', array($this, 'load_textdomain') );

		// Add menu entry.
		add_action( 'admin_menu', array($this, 'add_menu') );
	}

	/**
	 * Load the plugin textdomain.
	 */
	public function load_textdomain()
	{
		load_plugin_textdomain( HTWP_TEXTDOMAIN, false, HTWP_PLUGIN_DIR.'/languages' );
	}

	/**
	 * Add a Settings submenu entry.
	 */
	public function add_menu()
	{
		add_options_page(
			__( 'Hide WordPress Settings', HTWP_TEXTDOMAIN ),
			__( 'Hide WordPress', HTWP_TEXTDOMAIN ),
			'manage_options',
			'hide_the_wp',
			array($this, 'menu_page')
		);
	}

	/**
	 * The menu page HTML.
	 */
	public function menu_page() {
		?>
		<div class="wrap">
			<h1><?php esc_html_e('Hide WordPress Settings', HTWP_TEXTDOMAIN); ?></h1>
			<p><?php esc_html_e('Change what you want to hide of WordPress. We recommend to select as much options as possible, but always check compatibility issues.', HTWP_TEXTDOMAIN); ?></p>
		</div>
		<?php
	}

}