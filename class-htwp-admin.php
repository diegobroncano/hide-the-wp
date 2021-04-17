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

		// Set up options
		add_action( 'admin_init', array($this, 'set_options') );
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

	public function set_options()
	{
		// Register settings section
		add_settings_section(
			'hide_the_wp_options',
			'',
			'__return_null',
			'hide_the_wp'
		);
	}

	/**
	 * The menu page content.
	 */
	public function menu_page() {
		?>
		<div class="wrap">
			<h1><?php esc_html_e('Hide WordPress Settings', HTWP_TEXTDOMAIN); ?></h1>
			<p><?php esc_html_e('Change what you want to hide of WordPress. We recommend to select as much options as possible, but always check compatibility issues.', HTWP_TEXTDOMAIN); ?></p>
			<form method="POST" action="options.php">
				<?php

				// Add all needed hidden inputs.
				settings_fields( 'hide_the_wp_options' );

				// Display all the options.
				do_settings_sections( "hide_the_wp" );

				// Add the submit button.
				submit_button();
				?>
			</form>
		</div>
		<?php
	}

}