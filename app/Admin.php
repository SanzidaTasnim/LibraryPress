<?php

namespace Sanzida\Library\App;

/**
 * Admin Class
 */
class Admin
{

    /**
     * class constructor
     */
    public function __construct() {
        add_action('admin_enqueue_scripts', [ $this, 'admin_enqueue' ] );
        add_action( 'admin_menu', [ $this, 'menu_add' ] );
    }

    /**
     * Admin Enqueue Assets
     */
    public function admin_enqueue() {
        wp_enqueue_script( 'librarypress', LIBRARYPRESS_SPA . '/build/admin.bundle.js', [], time(), true );
    }


function menu_add() {
    add_menu_page(
         __( 'LibraryPress', 'librarypress' ),
         'LibraryPress',
         'manage_options',
         'librarypress',
         [ $this, 'add_menu_callback' ],
         'dashicons-book',
         6
     );
}

public function add_menu_callback() {
    ?>
        <div id="librarypress_container"></div>
    <?php
}
}
