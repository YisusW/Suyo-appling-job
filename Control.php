<?php

    
    if ( isset( $_POST['form'] ) ){
        
        $result = analice( $_POST['datos'] );
        
       // echo json_encode( $result );
        
    }else {
        
        echo json_encode( array( 'message' , 'error al recibir los datos' ) );
    }
    
    
    function analice( $datos ){
        
        $result = null ;
        
        $instance = new Swap();
        
        $containers = $instance->extraerContainer( $datos );
        
        $dispon = $instance->verificardisponibilidad( $containers );
        
        
        
        return $result;
    }
    
    
class Swap {
    
    private $total_types_containers ;
        
        public function examinar_totales( $container = array() ){
        
         $this->total_types_containers = false;
         
            $result = false;
            
            foreach ( $container as $key => $value ){
                
                if(  $this->total_types_containers === false ){
                    
                    $this->total_types_containers = $value['total'];
                    
                }else{
                    
                    if( $this->total_types_containers <> $value['total'] ){
                        $result = false;
                    }else {
                        $result = true;
                    }                    
                }
            }   
            
            return $result ;
        }
        
        public function intercambio(){
            
        }
        
        public function agregar_total (  $container = array() ){
            
            $this->total_types_containers = 0 ;
             
            foreach ( $container as $key => $value ){
                
                 //echo json_encode(  'container ' . $key  );
                 
                    foreach( $value as $fila_cont ){
                        
                            $this->total_types_containers = (int) $fila_cont['cantidad'] + $this->total_types_containers ;
                    }
                    
                    $value['total'] = $this->total_types_containers;
                    
                    $this->total_types_containers = 0 ;
                    
            }                
            
        }
        
        public function verificardisponibilidad(  $container = array() ){
            $auxiliar = array();
            
            $result = false;
            
            $result = $this->agregar_total( $container );
            
            $result = $this->examinar_totales ( $result );
            
            if( $result == false ){
                    
                    echo json_encode( array( 'message' , 'El total de cantidad de cada container debe ser  igual! para mantener la cantidad de bolas en cada container.' ) );
            }
            
            foreach ( $container as $key => $value ){
                
                 //echo json_encode(  'container ' . $key  );
                 
                if( $key+1 === count($container)-1 ||  $key+1 < count($container)-1 ){
                    
                    //si existe una proxima
                    
                    foreach( $value as $fila_cont ){
                        
                        // recorrer el contenedor por tipo
                       
                       if(  $fila_cont['index_type'] === $value[$key+1]['index_type'] ){
                           
                           // Verificar si existe el mismo tipo en el otro  contenedor
                           
                           //echo json_encode(  'type ' . $fila_cont['index_type']  );

                           if( ( (int) $fila_cont['cantidad'] > 0 ) && ( (int) $value[$key+1]['cantidad'] > 0) ){
                               
                                // Verificar si ambos son mayores que cero para saber que se puede hacer una operacion
                                
                                //echo json_encode( 'cantidad ' . $fila_cont['cantidad']  );
                               
                               $result = true;
                               
                           }
                       } 
                        
                    }
                    
                }
                
            }    
            
            return $result;
            
        }
        
        
        public function extraerContainer( $datos = array() ){
            
            $containers = array();
            
            for( $i = 0 ; $i < count($datos) ; $i ++  ){
                
                $containers[] = $datos[$i];
                
            }
            
            return $containers;
        }
}

?>