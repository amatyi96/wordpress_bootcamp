<div> &nbsp; </div>

<?php

    if ( isset($_POST['get_request']) ) {
        global $wpdb;
        $table = $wpdb->prefix.'options';
        $site_url = $wpdb->get_col( "SELECT option_value FROM $table" );
        echo '<pre>';
        //var_dump( $site_url );
        print_r( $site_url );
        echo '<pre>';
        //echo $site_url[0]->option_value;

    }

    if( isset($_POST['insert_request']) ) {
        
        global $wpdb;

        $table = $wpdb->prefix.'products';

        $data = [
            'name' => 'borotva',
            'price' => 2999
        ];

        $formats = [ '%s', '%d' ];
        
        $wpdb->insert( $table,  $data, $formats);

        echo "A record $wpdb->insert_id id-vel beszúrásra került az adatbázisban.";
    }

    if( isset($_POST['update_request']) ) {
        
        global $wpdb;

        $table = $wpdb->prefix.'products';

        $data = [
            'name' => 'borotvahab',
            'price' => 799
        ];

        //$where = ['id' => 2];
        $where = [" name LIKE '%borotva%' "];

        $formats = [ '%s', '%d' ];
        
        $row_num = $wpdb->update( $table,  $data, $where );
        

        if( $row_num === false ) {
            echo $wpdb->last_error;
            echo '<br>'.$wpdb->last_query;
        } else {
            echo " $row_num sor frissült.";
        }


    }

?>

<div>
    <form method="post">
        <input type="submit" name="get_request" value="get kérés">
    </form>
</div>
<div>
    <form method="post">
        <input type="submit" name="insert_request" value="insert">
    </form>
</div>
<div>
    <form method="post">
        <input type="submit" name="update_request" value="update">
    </form>
</div>
