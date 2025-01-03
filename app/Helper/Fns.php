<?php

namespace Walyatravels\Helper;

class Fns {

	public static function doing_it_wrong( $function, $message, $version ) {
		// @codingStandardsIgnoreStart
		$message .= ' Backtrace: ' . wp_debug_backtrace_summary();
		_doing_it_wrong( $function, $message, $version );
	}

}


