$(document).ready(function() {
	
	activarEvents();
});


function activarEvents(){
    
    $("#first_constraint").click(function (){
        
        if(! parseInt( $("#continer_num").val() ) ){
            
            
            $('#const_form_group').addClass('has-danger');
            
            $('#message_const').html('Necesitas ingresar un valor numerco entero ')
            $('#message_const').show('FadeIn')
            
        }else if(! parseInt( $("#type_num").val() ) ) {
            
            $('#type_form_group').addClass('has-danger');
            
            $('#message_type').html('Necesitas ingresar un valor numerco entero ')
            $('#message_type').show('FadeIn')
            
        } else {
            
            var continer = parseInt( $("#continer_num").val() ); 
            
            var type =   parseInt( $("#type_num").val() );
            
            $('#add_continers').html('')
            
            for( var i =0 ; i < continer ; i ++  ){
                
                form = hacerform( type  );
 
                $('#add_continers').append('<div class"row"><div class="card" >'+
  '<div class="card-header">'+
  
  '<h3 class="card-title">Container N# '+i+'</h3>'+
    
  '</div>'+
  '<div class="card-block">'+
    
    '<div class="col">'+form+'</div>'+
    
    
  '</div>'+
'</div></div>');
                
            }
        }
        

        
    })
}



function hacerform(num){
    
    var concat='<form>';
    
    for(var i = 0; i < num ; i++ ){
       
       concat +=  
             '<br><div id="type_form_group" class="form-group row">'+
              '<label for="inputPassword3" class="col-sm-2 col-form-label">Types N # '+i+'</label>'+
              '<div class="col-sm-10">'+
                
                '<input type="number" class="form-control" id="type_num" placeholder="M">'+
                
                '<div id="message_type" class="form-control-feedback"  style="display:none"></div>'+
                
              '</div>'+
            '</div>';
       
    }
    
    
    return  concat+'</form>';
}