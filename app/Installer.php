<?php

namespace Sanzida\Library\App;

/**
 * Admin Class
 */
class Installer {

    /**
     * Run the installer
     *
     * @return void
     */

    public function run() {
        $this->add_version();
        $this->create_tables();
    }

    /**
     * Add time and version on DB
     */

    public function add_version() {

        $installed = get_option( 'librarypress_installed' );

        if ( ! $installed ) {
            update_option( 'librarypress_installed', time() );
        }

        update_option( 'librarypress_version', LIBRARYPRESS_VERSION );
    }

   
    /**
     * Create necessary database table
     *
     * @return void
     */
    public function create_tables() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $schema = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}lp_book_records` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `title` varchar(100) NOT NULL DEFAULT '',
        `author` varchar(255) DEFAULT NULL,
        `publisher` varchar(255) DEFAULT NULL,
        `ISBN` varchar(255) DEFAULT NULL,
        `publication date` varchar(255) DEFAULT NULL,
        `created_by` bigint(20) unsigned NOT NULL,
        `created_at` datetime NOT NULL,
        PRIMARY KEY (`id`)
        ) $charset_collate";

        if ( ! function_exists( 'dbDelta' ) ) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }

        dbDelta( $schema );
    }

}