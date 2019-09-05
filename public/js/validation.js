//=============== Functions ==================

function universal_validation(field_id, field_text, closest_div, email_validation, text_length, match_with, file_upload_id){	
	var filter = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
	var field_value = $.trim($("#"+field_id).val());
	
	$('#serverside').remove();  
	$('.'+field_id+'_err').remove();  
	if(file_upload_id==''){
	 if(field_value==''){
		$( '#'+field_id).addClass( "errorfield" ); 
		closest_div.append( error_wrapper(field_id+'_err', 'Please provide '+field_text+'.') ); 
		err=1; 
		return false;
	 }
	}
	
	 if(text_length!=''){
	   if(field_value.length<text_length){
		  $( '#'+field_id).addClass( "errorfield" ); 
		  closest_div.append( error_wrapper(field_id+'_err', field_text+' must be '+text_length+' characters long.') ); 
		  err=1; 
		  return false;
	   }
	 }
	
	 if(match_with!=''){
	   if(field_value!=$.trim($("#"+match_with).val())){
		  $( '#'+field_id).addClass( "errorfield" ); 
		  closest_div.append( error_wrapper(field_id+'_err', field_text+' does not match.') ); 
		  err=1; 
		  return false;
	   }
	 }
	
	 if(file_upload_id!=''){
			ext_array = ['png','jpg','jpeg','gif'];
		var ext = $('#'+file_upload_id).val().split('.').pop().toLowerCase();
		if($.inArray(ext, ext_array) == -1) {

			$( '#'+field_id).addClass( "errorfield" ); 
			closest_div.append( error_wrapper(field_id+'_err', 'invalid file provided!') );
			err=1; 
			return false;
		}
	 }
	 
	 if(email_validation=='yes'){
	   if(filter.test(field_value)===false){
		  $( '#'+field_id).addClass( "errorfield" ); 
		  closest_div.append( error_wrapper(field_id+'_err', 'Please enter a valid email address.') );
		  err=1; 
		  return false;
	   }
	 }

	 $( '#'+field_id).removeClass( "errorfield" ); 
	 $( '.'+field_id+'_err').remove();
	 err=0;
	
}

function check_error(){
	if(err==1){
		return false;
	}else{
		
	}
}

function error_wrapper(id, error_msg){
	return '<span class="errormsg '+id+'">'+error_msg+'</span> ';	
}

function error_msg(id, text_msg){
	$("."+id+"_err").remove();
	$("#"+id).addClass( "errorfield" );
	$( '#'+id ).closest('div').append( error_wrapper(id+"_err", text_msg) );
}

function is_empty(field_obj, field_name, field_label){
	if(field_obj.val()==''){
		 error_msg(field_name, 'Please provide '+field_label);
		field_obj.focus();
		return true;
	  }
	  return false;
}

function is_not_match(field_id,match_with_field,field_name,field_text){
	if(field_id.val()!=match_with_field.val()){
		  match_with_field.addClass( "errorfield" ); 
		  match_with_field.closest('div').append( error_wrapper(field_name+"_err", field_text+' does not match.') ); 		  match_with_field.focus();
		  return true;
	   }	
	 return false;
}

function validate_email(field_obj, field_name) {
    var filter = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
    if (!filter.test(field_obj.val())) {
		error_msg(field_name, 'Please provide valid email address');
		field_obj.focus();
        return true;
    }
    return false;
}

function admin_is_empty(field_obj, field_name, field_label){
	if(field_obj.val()==''){
		 alert('Please provide '+field_label);
		field_obj.focus();
		return true;
	  }
	  return false;
}


