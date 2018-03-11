<?php

/*
 Metódusok:
 get: termékek lekérése.
 post: termékek frissítése.
 put: új termék létrehozása.
 delete: termék törlése.
*/
/**
* Adatbázis modell.
*/

class ProductModel {
    
    // Adattábla neve
    private $table = 'wp_products';
    
    public function printError( $message ) {
        return json_encode( array( "error" => $message ) );
    }

    // Lekérdezés.
    public function get( $id = null ) {
        
        global $wpdb;

        $where = is_null($id) ? "" : "WHERE id = $id";

        $result =  $wpdb->get_results(
            "SELECT * FROM $this->table $where"
        );

        if( !is_null($id) ) {
            if( count ($result) > 0 ) {
                return $result[0];
            } else {
                return null;
            }
        }

        return $result;
    }
    
    // Frissités
    public function update( $data = null, $where = array(), $limit = 1 ) {

        global $wpdb;
        
        if( is_null($data) ) {
            return printError( 'No data specified for update!' );
        }

        if( $where === '' ) {
            return printError( 'No where in update!' );
        }

        return $wpdb->update( $this->table,  $data, $where );
    }

    // Beszúrás
    public function insert( $data = null ) {
        
        global $wpdb;
        
        if( is_null($data) ) {
            return printError( 'No data specified for insert!' );
        }

        return $wpdb->insert( $this->table,  $data );        
    }

    public function delete( $id = null ) {

        global $wpdb;
        
        if( is_null($id) ) {
            return printError( 'No id specified for delete!' );
        }

        return $wpdb->delete( $this->table, array( 'id' => $id) );
    }
}

?>
