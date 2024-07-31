<?php
/*
 * Plugin Name:       LibraryPress
 * Plugin URI:        
 * Description:       Develop a WordPress plugin for managing a library system that handles book records.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Sanzida Tasnim
 * Author URI:        https://sanzida.me
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       librarypress
 * Domain Path:       /languages
 */


 namespace Sanzida\Library;

 if( ! defined( 'ABSPATH' ) ) {
	 exit; // Exit if accessed directly
 }
 
 /**
  * Plugin main class
  */ 
 final class LibraryPress {
	 static $instance = false;
 
	 /**
	  * class constructor
	  */
	 private function __construct() {
		 
		 $this->include();
		 $this->define();
		 $this->hooks();
	 }
 
	 /**
	  * Include all needed files
	  */
	 public function include() {
		 require_once( dirname( __FILE__ ) . '/vendor/autoload.php' );
		 require_once( dirname( __FILE__ ) . '/inc/functions.php' );
	 }
 
	 /**
	  * define all constant
	  */
	 private function define() {
		 define( 'LIBRARYPRESS', __FILE__ );
		 define( 'LIBRARYPRESS_DIR', dirname( LIBRARYPRESS ) );
		 define( 'LIBRARYPRESS_ASSET', plugins_url( 'assets', LIBRARYPRESS ) );
		 define( 'LIBRARYPRESS_SPA', plugins_url( 'spa', LIBRARYPRESS ) );

	 }
 
	 /**
	  * All hooks
	  */
	 private function hooks() {
		if ( is_admin() ){
			new App\Admin();
		}
		
		if ( ! is_admin() ){
			new App\Front();
		}
		
		new App\Shortcode();
		new App\Common();
	 }
 
	 /**
	  * Singleton Instance
	 */
	 static function get_esent_plugin() {
		 
		 if( ! self::$instance ) {
			 self::$instance = new self();
		 }
 
		 return self::$instance;
	 }
 }
 
 /**
  * Cick off the plugins 
  */
  LibraryPress::get_esent_plugin();