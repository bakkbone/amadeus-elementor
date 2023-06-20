<?php
namespace AmadeusElementor\Modules\GoogleMap;

use AmadeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Google_Map',
		];
	}

	public function get_name() {
		return 'amadeus-google-map';
	}
}
