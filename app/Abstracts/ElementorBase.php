<?php
/**
 * @author  DevofWP
 * @since   1.0
 * @version 1.0
 */

namespace Walyatravels\Abstracts;

use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

abstract class ElementorBase extends Widget_Base {

	public $walya_name;
	public $walya_base;
	public $walya_category;
	public $walya_icon;
	public $walya_translate;

	public function __construct( $data = [], $args = null ) {
		$this->walya_category = WALYA_CORE_PREFIX . '-widgets'; // Category /@dev
		$this->walya_icon     = 'rdtheme-el-custom';
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return $this->walya_base;
	}

	public function get_title() {
		return $this->walya_name;
	}

	public function get_icon() {
		return $this->walya_icon;
	}

	public function get_categories() {
		return [ $this->walya_category ];
	}
}