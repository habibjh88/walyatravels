<?php
/**
 *
 * This theme uses PSR-4 and OOP logic instead of procedural coding
 * Every function, hook and action is properly divided and organized inside related folders and files
 * Use the file `config/custom/custom.php` to write your custom functions
 *
 * @package walya
 */

namespace Walyatravels;

use Walyatravels\Helper\Install;
use Walyatravels\Traits\SingletonTraits;

final class Init {

	use SingletonTraits;

	/**
	 * Class constructor
	 */
	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'after_theme_loaded' ] );
		add_action( 'init', [ $this, 'load_textdomain' ], 20 );

		Hooks\FilterHooks::instance();
		Hooks\ActionHooks::instance();

		register_activation_hook( WALYA_CORE_BASE_FILE_NAME, [ Install::class, 'activate' ] );
		register_deactivation_hook( WALYA_CORE_BASE_FILE_NAME, [ Install::class, 'deactivate' ] );
	}

	/**
	 * Instantiate all class
	 * @return void
	 */
	public function after_theme_loaded() {
		Controllers\ScriptController::instance();
		Controllers\PostTypeController::instance();

		if ( function_exists( 'RawAddons' ) ) {
			Controllers\PostMetaController::instance();
		}
	}

	public function load_textdomain() {
		load_plugin_textdomain( 'walyatravels', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
}
