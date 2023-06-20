<?php
namespace AmadeusElementor\Modules\CircleProgress;

use AmadeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Circle_Progress',
		];
	}

	public function get_name() {
		return 'amadeus-circle-progress';
	}
}
