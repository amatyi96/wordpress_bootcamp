<?php

/**
* get: get,
* post: update,
* put: insert,
* delete: delete
*/


class ProductController {

    private $method;

    private $model;

    private $input;

    private $methodPairs = array( 'get' => 'get',
                                  'post' => 'update',
                                  'put' => 'insert',
                                  'delete' => 'delete');

    function __construct(){
        // Modell példányosítás.
        $this->model = new ProductModel;

        // Metódus meghatározása.
        $this->getMethod();
        
        // Input adatok összegyűjtése.
        $this->getInput();

        //Modell metódus hívása.
        switch($this->method) {
            case 'get':
                $result = $this->handleGet();
                break;
            case 'post':
                $result = $this->handlePost();
                break;
            
                default:
                    break;
        }
        /*$result = call_user_func( array($this->model, $this->methodPairs[$this->method]), $input);*/
        
        echo json_encode( $result );

        wp_die();
    }

    private function handleGet() {
        if ( isset($this->input->id) ) {
			return $this->model->get( $this->input->id );
		} else {
			return $this->model->get();					
		}
    }

    private function handlePost() {
        $id = $this->input->data->id;
        $where = array( 'id' => $id );
        $data = array();
        foreach ($this->input->data as $key => $value) {
            $data[$key] = $value;
        }

        return $this->model->update( $data, $where);
    }

    private function getMethod() {
		$this->method = strtolower( $_SERVER['REQUEST_METHOD'] );
    }
    
    private function getInput() {
        $input = file_get_contents( 'php://input' );
        
        if( strlen($input) < 1) {
            $input = new stdClass;
        }else {
            $input = json_decode( $input );
        }

        if( count($_GET) > 0 ) {
            foreach( $_GET as $key => $value) {
                $input->{$key} = $value;
            }
        }
        $this->input = $input;
    }
}