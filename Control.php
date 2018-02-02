<?php

    
    if ( isset( $_POST['form'] ) ){
        
        $result = analice( $_POST );
        
        echo json_encode( array( 'message' , $result ) );
        
    }else {
        
        echo json_encode( array( 'message' , 'error al recibir los datos' ) );
    }
    
    
    function analice( $datos ){
        
        $result = null ;
        
        foreach ($datos as $value) {
            // matriz des...
            
            
        }
        
        
        return $result;
    }
    

?>