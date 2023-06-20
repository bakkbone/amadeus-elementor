<?php
namespace AmadeusElementor\Modules\GravityForms;

use AmadeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Gravity_Forms',
		];
	}

	public function get_name() {
		return 'amadeus-gravity-forms';
	}
}
