<?php
/**
 * Header
 *
 * @package amadeus-elementor
 * @since 1.0.0
 */ ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php echo amadeus_body_microdata(); ?>>
	<?php do_action( 'wp_body_open' ); ?>
	<?php do_action( 'amadeus_header' ); ?>

	<div id="page" class="site">
		<div id="content" class="site-content container">
