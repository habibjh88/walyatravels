<?php
/*
Plugin Name: Walyatravels Utils
Plugin URI: https://www.devofwp.com
Description: WALYA Theme Core Plugin
Version: 1.0.0
Author: DevofWP
Author URI: https://www.devofwp.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'WALYA_CORE' ) ) {
	define( 'WALYA_ITEM', 'walya1224' );
	define( 'WALYA_CORE', '1.0.0' );
	define( 'WALYA_CORE_PREFIX', 'walya' );
	define( 'WALYA_CORE_BASE_URL', plugin_dir_url( __FILE__ ) );
	define( 'WALYA_CORE_BASE_DIR', plugin_dir_path( __FILE__ ) );
	define( 'WALYA_CORE_BASE_FILE_NAME', plugin_basename( __FILE__ ) );
}

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) :
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
endif;

if ( class_exists( 'Walyatravels\\Init' ) ) :
	Walyatravels\Init::instance();
endif;