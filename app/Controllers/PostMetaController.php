<?php

namespace Walyatravels\Controllers;

use RawAddons\Framework\Postmeta\PostMeta;
use Walyatravels\Traits\SingletonTraits;

class PostMetaController {
	use SingletonTraits;

	public function __construct() {
		add_action( 'init', [ $this, 'add_meta_box' ] );
	}

	/**
	 * Add all metabox
	 * @return void
	 */
	function add_meta_box() {

		PostMeta::add_meta_box(
			"walya_package_settings",
			__( 'Packages Settings', 'walyatravels' ),
			[ 'walya-packages' ],
			'',
			'',
			'high',
			[
				'fields' => [
					"walya_package_meta_data" => [
						'label' => __( 'Package Info', 'walyatravels' ),
						'type'  => 'group',
						'value' => $this->get_package_meta_args(),
					],
				],
			]
		);


	}



	function get_package_meta_args() {

		return apply_filters( 'walya_package_meta_field', [
			'layout'            => [
				'label'   => __( 'Layout', 'walyatravels' ),
				'type'    => 'select',
				'options' => [
					'default'       => __( 'Default from customizer', 'walyatravels' ),
					'full-width'    => __( 'Full Width', 'walyatravels' ),
					'left-sidebar'  => __( 'Left Sidebar', 'walyatravels' ),
					'right-sidebar' => __( 'Right Sidebar', 'walyatravels' ),
				],
				'default' => 'default',
			],

			'header_style'      => [
				'label'   => __( 'Header Style', 'walyatravels' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'walyatravels' ),
					'1'       => __( 'Layout 1', 'walyatravels' ),
					'2'       => __( 'Layout 2', 'walyatravels' ),
					'3'       => __( 'Layout 3', 'walyatravels' ),
					'4'       => __( 'Layout 4', 'walyatravels' ),
					'5'       => __( 'Layout 5', 'walyatravels' ),
				],
				'default' => 'default',
			],


			'package_'      => [
				'label'   => __( 'Header Style', 'walyatravels' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'walyatravels' ),
					'1'       => __( 'Layout 1', 'walyatravels' ),
					'2'       => __( 'Layout 2', 'walyatravels' ),
					'3'       => __( 'Layout 3', 'walyatravels' ),
					'4'       => __( 'Layout 4', 'walyatravels' ),
					'5'       => __( 'Layout 5', 'walyatravels' ),
				],
				'default' => 'default',
			],


		] );
	}
}

