<?php
namespace AmadeusElementor\Modules\Mailchimp;

use AmadeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Mailchimp',
		];
	}

	public function get_name() {
		return 'amadeus-mailchimp';
	}
}
