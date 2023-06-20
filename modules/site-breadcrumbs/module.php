<?php
namespace AmadeusElementor\Modules\SiteBreadcrumbs;

use AmadeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'SiteBreadcrumbs',
		];
	}

	public function get_name() {
		return 'amadeus-site-breadcrumbs';
	}

	public function __construct() {
		parent::__construct();
		require_once AMADEUS_ELEMENTOR_PATH . 'includes/class-amadeus-breadcrumb-trail.php';
	}
}
