<?php
namespace AmadeusElementor\Modules\NinjaForms;

use AmadeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Ninja_Forms',
		];
	}

	public function get_name() {
		return 'amadeus-ninja-forms';
	}
}
