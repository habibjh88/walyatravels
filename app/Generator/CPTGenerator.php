<?php
/**
 * @author  DevOfWP
 * @since   1.0
 * @version 1.0
 */

namespace Walyatravels\Generator;

use Walyatravels\Traits\SingletonTraits;

class CPTGenerator {
	use SingletonTraits;

	protected static $instance = null;
	private static $post_types = [];
	private static $taxonomies = [];

	/**
	 * Class Constructor
	 */
	private function __construct() {
		add_action( 'init', [ $this, 'register_taxonomies' ], 9999 );
		add_action( 'init', [ $this, 'register_custom_post_types' ], 9999 );
	}


	/**
	 * Add post types
	 *
	 * @param $post_types
	 *
	 * @return void
	 */
	public static function add_post_types( $post_types ) {

		foreach ( $post_types as $post_type ) {

//			error_log( print_r( $post_type, true ) . "\n\n", 3, __DIR__ . '/log.txt' );
			$labels = [
				'name'               => _x( $post_type['plural'], 'post type general name', 'walyatravels' ),
				'singular_name'      => _x( $post_type['singular'], 'post type singular name', 'walyatravels' ),
				'menu_name'          => _x( $post_type['plural'], 'admin menu', 'walyatravels' ),
				'name_admin_bar'     => _x( $post_type['singular'], 'add new on admin bar', 'walyatravels' ),
				'add_new'            => _x( 'Add New ' . $post_type['singular'], 'walyatravels' ),
				'add_new_item'       => __( 'Add New ' . $post_type['singular'], 'walyatravels' ),
				'new_item'           => __( 'New ' . $post_type['singular'], 'walyatravels' ),
				'edit_item'          => __( 'Edit ' . $post_type['singular'], 'walyatravels' ),
				'view_item'          => __( 'View ' . $post_type['singular'], 'walyatravels' ),
				'view_items'         => __( 'View ' . $post_type['plural'], 'walyatravels' ),
				'all_items'          => __( 'All ' . $post_type['plural'], 'walyatravels' ),
				'search_items'       => __( 'Search' . $post_type['plural'], 'walyatravels' ),
				'parent_item_colon'  => __( 'Parent ' . $post_type['plural'], 'walyatravels' ),
				'not_found'          => __( 'No ' . $post_type['plural'] . ' found.', 'walyatravels' ),
				'not_found_in_trash' => __( 'No ' . $post_type['plural'] . ' found in Trash.', 'walyatravels' ),
			];
			$args   = [
				'labels'             => $labels,
				'description'        => __( $post_type['description'], 'walyatravels' ),
				'public'             => $post_type['public'] ?? true,
				'publicly_queryable' => $post_type['publicly_queryable'] ?? true,
				'show_ui'            => $post_type['show_ui'] ?? true,
				'show_in_menu'       => $post_type['show_in_menu'] ?? true,
				'menu_icon'          => $post_type['menu_icon'],
				'query_var'          => $post_type['query_var'] ?? true,
				'rewrite'            => [ 'slug' => $post_type['slug'] ],
				'capability_type'    => $post_type['capability_type'] ?? 'post',
				'has_archive'        => $post_type['has_archive'] ?? true,
				'hierarchical'       => $post_type['hierarchical'] ?? false,
				'menu_position'      => $post_type['menu_position'],
				'supports'           => $post_type['supports'],
				'show_in_rest'       => $post_type['show_in_rest'] ?? true,
			];

			self::$post_types[ $post_type['id'] ] = $args;
		}
	}

	/**
	 * Add Taxonomies list
	 *
	 * @param $taxonomies
	 *
	 * @return void
	 */
	public static function add_taxonomies( $taxonomies ) {

		foreach ( $taxonomies as $taxonomy ) {

			$labels                              = [
				'name'              => _x( $taxonomy['plural'], 'taxonomy general name', 'walyatravels' ),
				'singular_name'     => _x( $taxonomy['singular'], 'taxonomy singular name', 'walyatravels' ),
				'menu_name'         => _x( $taxonomy['plural'], 'admin menu', 'walyatravels' ),
				'add_new_item'      => _x( 'Add New ' . $taxonomy['singular'], 'walyatravels' ),
				'search_items'      => __( 'Search ' . $taxonomy['plural'], 'walyatravels' ),
				'all_items'         => __( 'All ' . $taxonomy['plural'], 'walyatravels' ),
				'parent_item'       => __( 'Parent ' . $taxonomy['singular'], 'walyatravels' ),
				'parent_item_colon' => __( 'Parent ' . $taxonomy['singular'], 'walyatravels' ),
				'edit_item'         => __( 'Edit ' . $taxonomy['singular'], 'walyatravels' ),
				'update_item'       => __( 'Update ' . $taxonomy['singular'], 'walyatravels' ),
				'new_item_name'     => __( 'New ' . $taxonomy['singular'], 'walyatravels' ),
			];
			$args                                = [
				'labels'             => $labels,
				'description'        => __( '', 'walyatravels' ),
				'hierarchical'       => $taxonomy['hierarchical'] ?? true,
				'public'             => $taxonomy['public'] ?? true,
				'publicly_queryable' => $taxonomy['publicly_queryable'] ?? true,
				'show_ui'            => $taxonomy['show_ui'] ?? true,
				'show_in_menu'       => $taxonomy['show_in_menu'] ?? true,
				'show_in_nav_menus'  => $taxonomy['show_in_nav_menus'] ?? true,
				'show_tagcloud'      => $taxonomy['show_tagcloud'] ?? true,
				'show_in_quick_edit' => $taxonomy['show_in_quick_edit'] ?? true,
				'show_admin_column'  => $taxonomy['show_admin_column'] ?? false,
				'show_in_rest'       => $taxonomy['show_in_rest'] ?? true,
				'post_type'          => $taxonomy['post_type'],
			];
			self::$taxonomies[ $taxonomy['id'] ] = $args;
		}
	}

	/**
	 * Register custom post type
	 *
	 * @return void
	 */
	public function register_custom_post_types() {
		$post_types = apply_filters( 'walya_framework_post_types', self::$post_types );
		foreach ( $post_types as $post_type => $args ) {
			register_post_type( $post_type, $args );
		}
	}

	/**
	 * Register Taqxonomies
	 *
	 * @return void
	 */
	public function register_taxonomies() {
		$taxonomies = apply_filters( 'walya_framework_taxonomies', self::$taxonomies );
		foreach ( $taxonomies as $taxonomy => $args ) {
			$post_type = $args['post_type'];
			unset( $args['post_type'] );
			register_taxonomy( $taxonomy, $post_type, $args );
		}
	}
}