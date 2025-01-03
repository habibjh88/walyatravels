<?php

namespace Walyatravels\Controllers;

use Walyatravels\Traits\SingletonTraits;
use Walyatravels\Generator\CPTGenerator;

class PostTypeController {
	use SingletonTraits;

	public $post_type;

	public function __construct() {
		add_action('init', function (){
			$this->register_custom_post_type();
			$this->register_custom_taxonomy();
		}, 10);

	}


	/**
	 * Register custom post type
	 * @return void
	 */
	private function register_custom_post_type() {
		$custom_posts = [
			[
				'id'            => 'walya-packages',
				'slug'          => 'packages',
				'singular'      => 'Packages',
				'plural'        => 'Packages',
				'menu_icon'     => 'dashicons-admin-customizer',
				'menu_position' => 21,
				'supports'      => [ 'title', 'editor', 'thumbnail', 'excerpt', 'author', 'comments' ],
				'description'   => __( 'Walya Packages', 'walyatravels' ),
			],

		];

		CPTGenerator::add_post_types( $custom_posts );
	}

	/**
	 * Register custom taxonomy
	 * @return void
	 */
	private function register_custom_taxonomy() {
		$custom_posts = [
			[
				'id'        => 'walya-packages',
				'post_type' => [ 'walya-service' ],
				'slug'      => 'service-category',
				'singular'  => __( 'Service Category', 'walyatravels' ),
				'plural'    => __( 'Service Categories', 'walyatravels' ),
			],

		];

		CPTGenerator::add_taxonomies( $custom_posts );
//		$this->post_type->add_taxonomies( $custom_posts );
	}
}

