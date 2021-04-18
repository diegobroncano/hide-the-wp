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

	/**
	 * Register and add all plugin options and sections.
	 */
	public function set_options()
	{
		// Register settings section
		add_settings_section(
			'hide_the_wp_options',
			'',
			'__return_null',
			'hide_the_wp'
		);


		// Register hide generator meta tag option
		register_setting( 'hide_the_wp_options',
			'hide_generator_meta',
			array(
				'default' => false,
				'sanitize_callback' => array($this, 'sanitize_option')
			)
		);

		// Register hide files versions option
		register_setting( 'hide_the_wp_options',
			'hide_files_versions',
			array(
				'default' => false,
				'sanitize_callback' => array($this, 'sanitize_option')
			)
		);

		// Register hide windows live writer option
		register_setting( 'hide_the_wp_options',
			'hide_wlwmanifest',
			array(
				'default' => false,
				'sanitize_callback' => array($this, 'sanitize_option')
			)
		);

		// Register disable XML-RPC option
		register_setting( 'hide_the_wp_options',
			'disable_xmlrpc',
			array(
				'default' => false,
				'sanitize_callback' => array($this, 'sanitize_option')
			)
		);


		// Display hide meta generator option
		add_settings_field(
			'hide_generator_meta',
			__( 'Generator meta tag', HTWP_TEXTDOMAIN ),
			array($this, 'options_hide_generator_meta'),
			'hide_the_wp',
			'hide_the_wp_options'
		);

		// Display hide files versions option
		add_settings_field(
			'hide_files_versions',
			__( 'Files versions', HTWP_TEXTDOMAIN ),
			array($this, 'options_hide_files_versions'),
			'hide_the_wp',
			'hide_the_wp_options'
		);

		// Display hide windows live writer option
		add_settings_field(
			'hide_wlwmanifest',
			__( 'Windows Live Writer', HTWP_TEXTDOMAIN ),
			array($this, 'options_hide_wlwmanifest'),
			'hide_the_wp',
			'hide_the_wp_options'
		);

		// Display hide windows live writer option
		add_settings_field(
			'disable_xmlrpc',
			__( 'XML-RPC', HTWP_TEXTDOMAIN ),
			array($this, 'options_disable_xmlrpc'),
			'hide_the_wp',
			'hide_the_wp_options'
		);
	}

	/**
	 * Sanitize an option input.
	 *
	 * @param mixed $value Value to sanitize
	 * @return bool Return true if value is a checkbox on, otherwise false
	 */
	public function sanitize_option( $value ): bool
	{
		if ( $value  === 'on' ) {
			return true;
		}
		return false;
	}

	/**
	 * Add hide generator meta option input to the backend page.
	 */
	public function options_hide_generator_meta() {
		?> <label for="hide_generator_meta">
			<input type="checkbox" name="hide_generator_meta" id="hide_generator_meta" <?php if(get_option('hide_generator_meta')) { echo 'checked'; } ?>>
			Remove the generator meta tag
		</label>
		<p class="description"><?php esc_html_e("WordPress by default generate a piece of code identifying itself, but you don't want that right?", HTWP_TEXTDOMAIN) ?></p>
		<?php
	}

	/**
	 * Add hide files versions option input to the backend page.
	 */
	public function options_hide_files_versions() {
		?>
		<label for="hide_files_versions">
			<input type="checkbox" name="hide_files_versions" id="hide_files_versions" <?php if(get_option('hide_files_versions')) { echo 'checked'; } ?>>
			<?php esc_html_e( 'Hide version from files loaded in your website.', HTWP_TEXTDOMAIN ) ?> </label>
		<p class="description"><?php esc_html_e( "Files required by your website (like scripts or fonts), usually show its version to avoid cache problems. However, those files hardly ever change and usually there isn't that kind of problems.", HTWP_TEXTDOMAIN ) ?></p>
		<?php
	}

	/**
	 * Add hide windows live writer manifest option to the backend page.
	 */
	public function options_hide_wlwmanifest() {
		?>
		<label for="hide_wlwmanifest">
			<input type="checkbox" name="hide_wlwmanifest" id="hide_wlwmanifest" <?php if(get_option('hide_wlwmanifest')) { echo 'checked'; } ?>>
			<?php esc_html_e( 'Hide the Windows Live Writer manifest', HTWP_TEXTDOMAIN ) ?>
		</label>
		<p class="description"><?php esc_html_e("You can enable this checkbox if you don't use Windows Live Writer, who use it already?"); ?></p>
		<?php
	}

	/**
	 * Add disable XML-RPC option to the backend page.
	 */
	public function options_disable_xmlrpc() {
		?>
		<label for="disable_xmlrpc">
			<input type="checkbox" name="disable_xmlrpc" id="disable_xmlrpc" <?php if(get_option('disable_xmlrpc')) { echo 'checked'; } ?>>
			<?php esc_html_e( 'Disable the XML-RPC standard', HTWP_TEXTDOMAIN ) ?>
		</label>
		<p class="description"><?php esc_html_e("XML-RPC is a protocol to communicate WordPress with third party services, but also can be a security issue. If you can, we definitely encourage you to deactivate it."); ?></p>
		<?php
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

				// Display all the sections and options.
				do_settings_sections( "hide_the_wp" );

				// Add the submit button.
				submit_button();
				?>
			</form>
		</div>
		<?php
	}

}