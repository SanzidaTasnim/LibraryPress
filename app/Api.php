<?php

namespace Sanzida\Library\App;

/**
 * Admin Class
 */
class Api {

    /**
     * class constructor
     */
    public function __construct() {
        add_action( 'rest_api_init', [ $this, 'register_endpoint' ] );
    }

    public function register_endpoint() {

        register_rest_route( 'libraryPress/v1', '/books-record', array(
            'methods'             => REST::CREATABLE,
            'callback'            => [ $this, 'handle_book_record_api' ],
            'permission_callback' => '__return_true'
        ) );

    }

    public function handle_book_record_api( $request ){

        $params           = $request->get_params();
        $title            = sanitize_text_field( $params['title'] );
        $author           = sanitize_text_field( $params['author'] );
        $publisher        = sanitize_text_field( $params['publisher'] );
        $isbn             = sanitize_textarea_field( $params['isbn'] );
        $publication_date = sanitize_text_field( $params['publication_date'] );
        $current_user_id  = get_current_user_id();

        global $wpdb;
        $table_name = $wpdb->prefix . 'lp_book_records';

        $result = $wpdb->insert(
            $table_name,
            array(
                'title'            => $title,
                'author'           => $author,
                'publisher'        => $publisher,
                'ISBN'             => $isbn,
                'publication_date' => $publication_date,
                'created_at'       => current_time('mysql', 1),
                'created_by'       => $current_user_id  
            ),
            array('%s', '%s', '%s', '%s')
        );

        if ( $result ) {
            return new \WP_REST_Response('Success', 200);
        } else {
            return new \WP_REST_Response('Error', 500);
        }
    }
    
}