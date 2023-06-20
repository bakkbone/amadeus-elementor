<?php
namespace AmadeusElementor\Modules\BlogGrid;

use AmadeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Blog_Grid',
		];
	}

	public function get_name() {
		return 'amadeus-blog-grid';
	}
}
