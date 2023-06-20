<?php
namespace AmadeusElementor\Modules\BlogCarousel;

use AmadeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Blog_Carousel',
		];
	}

	public function get_name() {
		return 'amadeus-blog-carousel';
	}
}
