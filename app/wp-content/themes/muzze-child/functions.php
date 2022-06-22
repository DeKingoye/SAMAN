<?php
/**
 * Setup muzze Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function muzze_child_theme_setup() {
	load_child_theme_textdomain( 'muzze-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'muzze_child_theme_setup' );


// Add Code is here.

// Add Parent Style
add_action( 'wp_enqueue_scripts', 'muzze_child_scripts', 100 );
function muzze_child_scripts() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri(). '/style.css' );
}
