<?php
/**
 * @author  DevofWP
 * @since   1.0
 * @version 1.0
 */

namespace Walyatravels\Controllers;

use Elementor\Plugin;
use Walyatravels\Helper\Fns;
use Walyatravels\Traits\SingletonTraits;
use Walyatravels\Elementor\Addons\Projects;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ElementorController Class
 */
class ElementorController {
	use SingletonTraits;

	public function __construct() {
		add_action( 'elementor/widgets/register', [ $this, 'register_widget' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'widget_category' ] );
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'editor_scripts' ] );
	}


	/**
	 * Editor JS.
	 *
	 * @return void
	 */
	public function editor_scripts() {
		$version = ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? time() : WALYA_CORE;

		wp_enqueue_script(
			'walya-editor-script',
			Fns::get_assets_url( 'js/editor.js' ),
			[
				'jquery',
				'elementor-editor',
				'jquery-elementor-select2',
			],
			$version,
			true
		);
	}


	/**
	 * Register Elementor Widget.
	 * Just put the widget class reference here
	 * @return void
	 */
	public function register_widget() {

		$widgets = [
			Projects::class,
		];
		foreach ( $widgets as $class ) {
			Plugin::instance()->widgets_manager->register( new $class );
		}
	}

	/**
	 * Register Elementor category
	 *
	 * @param $elements_manager
	 *
	 * @return void
	 */
	public function widget_category( $elements_manager ) {
		$id                = WALYA_CORE_PREFIX . '-widgets';
		$categories[ $id ] = [
			'title' => __( 'DevofWP Elements', 'walyatravels' ),
			'icon'  => 'fa fa-plug',
		];

		$get_all_categories = $elements_manager->get_categories();
		$categories         = array_merge( $categories, $get_all_categories );
		$set_categories     = function ( $categories ) {
			$this->categories = $categories;
		};

		$set_categories->call( $elements_manager, $categories );
	}

}