<?php

//JS fájlok beszúrása a frontend oldalra.
function add_my_scripts() {
    
        
/*    
        wp_enqueue_script(  'bootstrap_handler',
                            plugins_url( 'product-listing/js/bootstrap.min.js' ),
                            ['jquery'],
                            date( 'YmdHis')                    
        );

        // Az ajax handler script beszúrása az oldal láblécébe.
        wp_enqueue_script(  'angular-handler',
                            plugins_url( 'product-listing/js/angular.min.js' ),
                            ['jquery'],
                            date( 'YmdHis')
        );

        // Az ajax handler script beszúrása az oldal láblécébe.
        wp_enqueue_script(  'main-handler',
                            plugins_url( 'product-listing/js/main.js' ),
                            ['jquery'],
                            date( 'YmdHis'),
                            true 
        );
*/
        
        // Az ajax handler script beszúrása az oldal láblécébe.
        wp_enqueue_script(  'main-handler',
                            plugins_url( 'product-listing/js/js.php' ),
                            array(),
                            date( 'YmdHis'),
                            true 
        );

        // PHP változók hozzáadása a script-hez.
        wp_localize_script(
            'angular_handler',
            'ajaxOptions',
            [
                'ajaxurl' => admin_url('admin-ajax.php'),
                'actionName' => 'it_ajax'
            ]
        );
    }
    add_action( "wp_enqueue_scripts", 'add_my_scripts');
    
    function add_my_styles() {
        wp_enqueue_style(  'page-style',
                            plugins_url( 'product-listing/css/page-css.css' ),
                            array(),
                            date( 'YmdHis')
        );
    
        wp_enqueue_style(  'page-style',
                            plugins_url( 'product-listing/css/bootstrap-grid.css' ),
                            array(),
                            date( 'YmdHis')
        );
    }
    add_action( "wp_enqueue_scripts", 'add_my_styles' );

    ?>