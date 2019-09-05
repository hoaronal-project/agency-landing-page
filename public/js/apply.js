function load_popup(method, id){
		jQuery('#popup_box').modal('show');
		
		// Make an ajax call
		var myurl = baseUrl+'apply_job/'+id;
		$.getJSON(myurl, function (obj_data) {
			$("#msg_box").html(obj_data.msg);
			$("#jtitle").html(obj_data.jt);
   			$("#load_form").html(obj_data.form_data);
 		});
}

$(document).ready(function (e) {
//Registration
$("#frm_apply").on('submit',(function(e){
		  e.preventDefault();
		  var method = $('#method').val();
		  $('#spinner_reg').show();
		  $('#frm_submit').attr('disabled', 'disabled');
		  $.ajax({
		  		url: baseUrl+"apply_job/"+method,
		  		type: "POST",
		  		data:  new FormData(this),
		  		contentType: false,
		  		cache: false,
		  		processData:false,
		  		success: function(data){
					var obj = jQuery.parseJSON(data);
		  			if(obj.msg=='done'){
						$('#frm_submit').removeAttr('disabled');
						$('#spinner_reg').hide();
						document.location=baseUrl+obj.redirect_url;
						return;
					}
					else{
						$('#frm_submit').removeAttr('disabled');
						$('#spinner_reg').hide();
						$('#msg_box').html(obj.msg);
						return;
					}
		  	  }       
		  });
		  return;	
		  }));

});