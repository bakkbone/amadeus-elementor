<?php
namespace AmadeusElementor\Modules\ScrollUp;

use AmadeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Scroll_Up',
		];
	}

	public function get_name() {
		return 'amadeus-scroll-up';
	}
}
