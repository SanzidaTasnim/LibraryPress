<?php

namespace Sanzida\Library\App;

/**
 * Front Class
 */
class Front {

    /**
     * class constructor
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [$this, 'front_enqueue'] );
    }
    /**
     * Enqueuing Front Files
     */
    public function front_enqueue() {
        wp_enqueue_script( 'librarypress', plugins_url( 'spa/build/public.bundle.js', __FILE__ ), [], time(), true );
    }

}