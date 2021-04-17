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
		// Set up internationalization
		add_action( 'plugin_loaded', array($this, 'load_textdomain') );
	}

	/**
	 * Load the plugin textdomain.
	 */
	public function load_textdomain()
	{
		load_plugin_textdomain( HTWP_TEXTDOMAIN, false, HTWP_PLUGIN_DIR.'/languages' );
	}

}