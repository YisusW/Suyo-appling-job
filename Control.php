<?php

    
    if ( isset( $_POST['form'] ) ){
        
        $result = analice( $_POST['datos'] );
        
        
    }else {
        
        echo json_encode( array( 'message' , 'error al recibir los datos' ) );
    }
    
    
    function analice( $datos ){
        
        $result = null ;
        
        $instance = new Swap();
        
        foreach ($datos as $value) {
            // matriz des...
            
            echo json_encode( $value );
        }
        
        return $result;
    }
    
    
class Swap {
        
        public function operaciones(){
            
        }
        
        public function intercambio(){
            
        }
        
        public function verificardisponibilidad(){
            
        }
}

?>