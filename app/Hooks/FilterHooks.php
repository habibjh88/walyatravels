<?php
/**
 * @author  DevofWP
 * @since   1.0
 * @version 1.0
 */

namespace Walyatravels\Hooks;

use Walyatravels\Traits\SingletonTraits;
use Walyatravels\Elementor\Addons\Packages;

class FilterHooks {
	use SingletonTraits;


	public function __construct() {
		add_filter( 'raw_addons_elemetor_widgets', [ $this, 'elemetorWidgets' ] );

	}


	public function elemetorWidgets( $widgets ) {
		$widgets[] = Packages::class;
		return $widgets;
	}
}