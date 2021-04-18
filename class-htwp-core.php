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