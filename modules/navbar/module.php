<?php
namespace AmadeusElementor\Modules\Navbar;

use AmadeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Navbar',
		];
	}

	public function get_name() {
		return 'amadeus-navbar';
	}
}
