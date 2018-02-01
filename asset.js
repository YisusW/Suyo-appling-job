$(document).ready(function() {
	
	activarEvents();
});

function hiddemessageValidadtion (){
    
                
            $('#const_form_group').removeClass('has-danger');
            
            $('#message_const').html('')
            $('#message_const').hide('FadeOut')
            
            /**/
            
                        
            $('#const_form_group').removeClass('has-danger');
            
            $('#message_const').html('')
            $('#message_const').hide('FadeIn')
    
}

function activarEvents(){
    
    $("#first_constraint").click(function (){
        
        if(! parseInt( $("#continer_num").val() ) ){
            
            
            $('#const_form_group').addClass('has-danger');
            
            $("#continer_num").addClass("form-control-danger")
            
            $('#message_const').html('Necesitas ingresar un valor numerco entero ')
            $('#message_const').show('FadeIn')
            
        }else if(! parseInt( $("#type_num").val() ) ) {
            
            $('#type_form_group').addClass('has-danger');
            
            $("#type_num").addClass("form-control-danger")
            
            $('#message_type').html('Necesitas ingresar un valor numerco entero ')
            $('#message_type').show('FadeIn')
            
        } else {
            
            hiddemessageValidadtion();
            
            var continer = parseInt( $("#continer_num").val() ); 
            
            var type =   parseInt( $("#type_num").val() );
            
            $('#add_continers').html('')
            
            for( var i =0 ; i < continer ; i ++  ){
                
                form = hacerform( type , i );
 
                $('#add_continers').append('<div class"row"><div class="card" >'+
                                              '<div class="card-header">'+
                                              
                                              '<h3 class="card-title">Container N# '+i+'</h3>'+
                                                
                                              '</div>'+
                                              '<div class="card-block">'+
                                                
                                                '<div class="col">'+form+'</div>'+
                                                
                                              '</div>'+
                                            '</div></div>');
                
                activar_event( '#'+i+'_container' , '#'+i+'_form' )
            }
        }
        

        
    })
}



function hacerform(num , num_container ){
    
    var concat='<form id="'+num_container+'_form" >';
    
    for(var i = 0; i < num ; i++ ){
       
       concat +=  
             '<br><div id="type_form_group" class="form-group row">'+
              '<label for="inputPassword3" class="col-sm-2 col-form-label">Types N # '+i+'</label>'+
              '<div class="col-sm-10">'+
                
                '<input type="number" class="form-control" id="type_num'+i+'" placeholder="M">'+
                
                '<div id="message_type" class="form-control-feedback"  style="display:none"></div>'+
                
              '</div>'+
            '</div>';
       
    }
    
    concat += '<button type="button" id="'+num_container+'_container" class="btn btn-outline-primary btn-block">Fijar tipos</button><br>'; 
    
    return  concat+'</form>';
}

function activar_event( id , id_form ){
    
   var  container = [];
   
    $( id ).click( function (){
        
        
        $( id_form ).find(':input').each( function ( index , item  ){
            
            if(! parseInt( $(this).val() ) ){
                
            }else{
                
                container[ container.length ] = $(this).val();
            }
        
            
        } );
        
         $(id_form).append('<input id="containervalue'+id_form+'" type="hidden" value="'+container+'" >')
         
         
    })
    
}