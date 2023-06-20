<?php
namespace AmadeusElementor\Modules\MemberCarousel;

use AmadeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Member_Carousel',
		];
	}

	public function get_name() {
		return 'amadeus-member-carousel';
	}
}
