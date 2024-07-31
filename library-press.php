<?php
/*
 * Plugin Name:       LibraryPress
 * Plugin URI:        
 * Description:       A WordPress plugin for managing a library system that handles book records.
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
     * Plugin version
     *
     * @var string
     */
    const version = '1.0';
 
	 /**
	  * class constructor
	  */
	 private function __construct() {
		 
		 $this->include();
		 $this->define();
		 $this->hooks();
		 register_activation_hook( __FILE__, [ $this, 'activate' ] );

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
		 define( 'LIBRARYPRESS_VERSION', self::version );
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
		new App\Api();
	 }

	/**
     * Do stuff upon plugin activation
     *
     * @return void
     */
    public function activate() {
        $installer = new App\Installer();
        $installer->run();
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
  * kick off the plugins 
  */
  LibraryPress::get_esent_plugin();