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
        
        // hacer declaracion de parametros con tipos de dato arrau()
        // el sistema manda msg de error o Alerta de sintaxis 
        public function intercambio( $base = array( ) , $reemplazos = array( ) ){
            
            $var  = array_replace($base, $reemplazos );
           return $var;
            
        }
        
        public function agregar_total ( $container = array() ){
            
            $this->total_types_containers = 0 ;
            
            $result = array();
             
            foreach ( $container as $key => $value ){
                
                 //echo json_encode(  'container ' . $key  );
                 
                    foreach( $value as $fila_cont ){
                        
                            $this->total_types_containers = (int) $fila_cont['cantidad'] + $this->total_types_containers ;
                    }
                    
                    $value['total'] = $this->total_types_containers;
                    
                    $this->total_types_containers = 0 ;
                    
                    $result[] = $value;
            }                
            
            return $result;
        }
        
        public function verificardisponibilidad(  $container = array() ){
            
            $auxiliar = array();
            
            $result = false;
            
            $container_total = $this->agregar_total( $container );
            
            $result_ecaminar = $this->examinar_totales( $container_total );
            
            if( $result_ecaminar == false ){
                    
                    echo json_encode( array( 'message' , 'El total de cantidad de cada container debe ser  igual! para mantener la cantidad de bolas en cada container.' ) );
            }
            echo json_encode($container);
            echo json_encode('---------');
            
            foreach ( $container as $key => $value ){
                
                 
                 
                if( $key+1 <= count($container) ){
                    
                    //si existe una proxima
                    
                
                    foreach( $value as $fila_cont ){
                        
                        // recorrer el contenedor por tipo
                       
                       if(  $fila_cont['index_type'] === $container[$key+1][$key]['index_type'] ){
                           
                           // Verificar si existe el mismo tipo en el otro  contenedor
                           
                           //echo json_encode(   $fila_cont  );
                          
                          
                           if( ( (int) $fila_cont['cantidad'] > 0 ) && ( (int) $container[$key+1][$key]['cantidad'] > 0) ){
                               
                                // Verificar si ambos son mayores que cero para saber que se puede hacer una operacion
                                
                               
                               if( (int) $fila_cont['cantidad'] > (int) $container[$key+1][$key]['cantidad'] ){
                                

                                  
                                   $container[$key][$key]['cantidad'] = (int) $container[$key][$key]['cantidad'] - 1  ;// Agregar

                                   $container[$key+1][$key]['cantidad'] =  (int) $container[$key+1][$key]['cantidad'] + 1  ;// Quitar
                                   
                                   $container[$key+1][$key+1]['cantidad'] =  (int) $container[$key+1][$key+1]['cantidad'] - 1  ;// Agregar
                                   
                                   $container[$key][$key+1]['cantidad'] =  (int) $container[$key][$key+1]['cantidad'] + 1  ;// Quitar
                                   

                               }else{
                                   
                                   (int)  $container[$key][$key]['cantidad'] = (int)  $container[$key][$key]['cantidad'] - 1  ;

                                   (int) $container[$key+1][$key]['cantidad'] =  (int) $container[$key+1][$key]['cantidad'] + 1  ;// Quitar
                                   
                                   (int)  $container[$key+1][$key+1]['cantidad'] = (int)  $container[$key+1][$key+1]['cantidad'] - 1  ;

                                   (int) $container[$key][$key+1]['cantidad'] =  (int) $container[$key][$key+1]['cantidad'] + 1  ;// Quitar                                   
                                   
                               }
                               
                               
                               
                               
                           }
                       } 
                        
                    }
                    
                }
                
            }    
            
            echo json_encode($container);
            
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