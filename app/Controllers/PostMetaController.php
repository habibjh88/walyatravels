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
			'regular_price' => [
				'label' => __( 'Regular Price', 'walyatravels' ),
				'type'  => 'number',
			],

			'offer_price' => [
				'label' => __( 'Offer Price', 'walyatravels' ),
				'type'  => 'number',
			],

			'airlines' => [
				'label' => __( 'Airlines', 'walyatravels' ),
				'type'  => 'text',
			],

			'accommodation' => [
				'label' => __( 'Accommodation', 'walyatravels' ),
				'type'  => 'text',
			],

			'contact' => [
				'label' => __( 'Contact', 'walyatravels' ),
				'type'  => 'text',
			],

			'rating' => [
				'label'       => __( 'Rating', 'walyatravels' ),
				'type'        => 'select',
				'description' => 'Rating the package within 5',
				'options'     => [
					'1' => __( '1 Star', 'neuzin-core' ),
					'2' => __( '2 Star', 'neuzin-core' ),
					'3' => __( '3 Star', 'neuzin-core' ),
					'4' => __( '4 Star', 'neuzin-core' ),
					'5' => __( '5 Star', 'neuzin-core' ),
				],
				'default'     => '5',
			],

			'booking_url' => [
				'label' => __( 'Booking Link (optional)', 'walyatravels' ),
				'type'  => 'text',
			],

		] );
	}
}

