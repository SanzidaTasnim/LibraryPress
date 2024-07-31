<?php
/*
 * Plugin Name:       WP React
 * Plugin URI:        
 * Description:       Handle the integration of React with WordPress
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Sanzida Tasnim
 * Author URI:        https://sanzida.me
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wp-react
 * Domain Path:       /languages
 */

add_action( 'admin_enqueue_scripts', 'enqueue_scripts');

function enqueue_scripts(){
	wp_enqueue_script( 'admin', plugins_url( 'spa/build/admin.bundle.js', __FILE__ ), [], '0.1', true );
}

add_action( 'admin_menu', 'wr_menu_page_react' );

function wr_menu_page_react() {
   add_menu_page(
		__( 'Custom Menu Title', 'wp-react' ),
		'Custom Menu',
		'manage_options',
		'my-custom-menu-slug',
		'wp_react_callback',
		'dashicons-tickets',
		6
	);
}

function wp_react_callback() {
   ?>
      <div id="wr_test_container"></div>
   <?php
}