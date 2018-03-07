<?php

/*
Plugin Name: DB tester plugin
Plugin URI: https://itfactory.hu
Description: Plugin for test wordpress native db engine.
Version: 0.0.1
Author: Albirt Matyas
Author URI: https://itfactory.hu
License: MIT
Text Domain: dbtester
*/

// Plugin indítása.
function load_db_tester_plugin() {
    add_menu_page ( 'DB test page', 'DB tester', 'edit_users', 'db_tester', 'init_db_tester_page' );
}

// Az akció, aminek a hatására az indító függvény lefut.
add_action ( 'admin_menu', 'load_db_tester_plugin' );

// A menüpont tartalmának generálása.
function init_db_tester_page() {
    include 'db_page.php';
}

function my_action_callback() {
    global $wpdb;
    $records = $wpdb->get_results( "SELECT * FROM $wpdb->posts" );
    echo json_encode( $records );

    wp_die();
}

add_action( 'wp_ajax_nopriv_my_action', 'my_action_callback' );


function pluginname_ajaxurl() {
    ?>
        <script type="text/javascript">
            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
        </script>
    <?php
}

add_action('wp_head', 'pluginname_ajaxurl');

/*
var req = new XMLHttpRequest;
req.open( 'get', ajaxurl+'?action=my_action' );
req.onloadend = function( ev ) {
    console.log( JSON.parse( ev.target.response ) );
}
req.send()
*/
