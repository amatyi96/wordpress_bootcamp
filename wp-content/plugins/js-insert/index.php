<?php

/*
Plugin Name: JS inserter
Plugin URI: https://itfactory.hu
Description: Plugin help you for insert js files.
Version: 0.0.1
Author: Albirt Matyas
Author URI: https://itfactory.hu
License: MIT
Text Domain: jsinsert
*/

//JS fájlok beszúrása a frontend oldalra.
function add_my_scripts() {

    // Az ajax handler script beszúrása az oldal láblécébe.
    wp_enqueue_script(  'ajax_handler',
                        plugins_url( 'js-insert/js/ajax-handler.js' ),
                        ['jquery'],
                        date( 'YmdHis'),
                        true 
    );

    wp_enqueue_script(  'ajax_handler',
                        plugins_url( 'js-insert/js/bootstrap.min.js' ),
                        ['jquery'],
                        date( 'YmdHis'),
                        true 
    );

    // PHP változók hozzáadása a script-hez.
    wp_localize_script(
        'ajax_handler',
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
                        plugins_url( 'js-insert/css/page-css.css' ),
                        array(),
                        date( 'YmdHis')
    );

    wp_enqueue_style(  'page-style',
                        plugins_url( 'js-insert/css/bootstrap-grid.css' ),
                        array(),
                        date( 'YmdHis')
    );
}
add_action( "wp_enqueue_scripts", 'add_my_styles' );

// Shortcoce hozzáadása a wordpress rendszerhez.

function add_subscribe( $atts, $content, $name ) {
    ob_start();
    ?>
        <div class="urgent <?php echo $atts['cssclass']; ?>">
            <form class="col-xs-6 col-xs-offset-3">
                <div class="form-group">
                    <label for="exampleInputName2">Name</label>
                    <input type="text" class="form-control" id="exampleInputName2" placeholder="Jane Doe">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail2">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="jane.doe@example.com">
                </div>
                <button type="submit" class="btn btn-default">Send invitation</button>
                <div class="clearfix"></div>
            </form>
            <div class="clearfix"></div>
        </div>
    <?php
    $content = ob_get_contents();
    ob_clean();
    return $content;
}
add_shortcode( 'subscribe', 'add_subscribe' );

function title_filter( $title ){
    return 'Ez a cím';
} 
add_filter( 'the_title', 'title_filter' );

/*
function bartag_func( $atts ) {
    $a = shortcode_atts( array(
        'foo' => 'something',
        'bar' => 'something else',
    ), $atts );

    return "foo = {$a['foo']}";
}
add_shortcode( 'bartag', 'bartag_func' );*/
