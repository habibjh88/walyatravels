<?php

namespace Walyatravels\Controllers;

use Walyatravels\Traits\SingletonTraits;

/**
 * Enqueue.
 */
class ScriptController {
	use SingletonTraits;

	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ], 99 );
	}

	public static function get_version() {
		return WP_DEBUG ? time() : WALYA_CORE;
	}

	/**
	 * Enqueue Scripts
	 * @return void
	 */
	public function enqueue_scripts() {

	}

}
