<?php

include 'shortcodes.php';

function walkcambridge_theme_resources() {
	wp_enqueue_style('style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'walkcambridge_theme_resources');

// Navigation Menus

register_nav_menus(array(
		'primary-med-large' => __('Primary Menu'),
		'primary-small' => __('Phone Primary Menu'),
		'phone-second-menu' => __('Phone Second Menu'),
));

if ( function_exists('register_sidebar') )
	register_sidebar();