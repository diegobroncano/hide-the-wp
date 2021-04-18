<?php

/**
 * Class to handle actual WordPress hide options.
 */
class HTWP_core
{

	/**
	 * Check every option and execute which are selected.
	 */
	public function load()
	{
		// Remove the generator meta tag.
		if ( get_option('hide_generator_meta') ) {
			$this->hide_generator_meta();
		}

		// Remove files version.
		if ( get_option('hide_files_versions') ) {
			add_filter('style_loader_src', array($this, 'hide_file_version'), 9999, 2);
			add_filter('script_loader_src', array($this, 'hide_file_version'), 9999, 2);
		}
	}

	/**
	 * Remove for every linked file its version.
	 * That version is included for cache preventing problems, but you would probably like to hide it.
	 *
	 * @param mixed $src File URL
	 * @return mixed
	 */
	public function hide_file_version( $src )
	{
		if( strpos( $src, '?ver=' ) ) {
			$src = remove_query_arg('ver', $src);
		}
		return $src;
	}

	/**
	 * Remove the generator meta tag.
	 * WordPress by default adds a meta tag in your website identifying itself.
	 */
	private function hide_generator_meta()
	{
		remove_action( 'wp_head', 'wp_generator' );
	}
}