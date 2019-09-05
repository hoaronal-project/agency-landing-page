$(document).ready(function (e) {
//Registration
$("#regfrm").on('submit',(function(e){
		  e.preventDefault();
		  var jslug = $('#jslug').val();
		  //$('#spinner_reg').show();
		  $('#sub_reg').attr('disabled', 'disabled');
		  $.ajax({
		  		url: baseUrl+"registration",
		  		type: "POST",
		  		data:  new FormData(this),
		  		contentType: false,
		  		cache: false,
		  		processData:false,
		  		success: function(data){
					var obj = jQuery.parseJSON(data);
		  			if(obj.msg=='done'){
						/*$('#msg').html('<div class="message-container"> <div class="callout callout-success"><h4>Password updated Successfully.</h4></div></div>').show();*/
						
						$('#sub_reg').removeAttr('disabled');
						//$('#spinner_reg').hide();
						/*$.toaster({ priority : 'success', title : 'Success', message : 'Page has been updated successfully.'});
						setTimeout(function() { location.reload(true);}, 2000);*/
						document.location=baseUrl+obj.redirect_url;
						return;
					}
					else{
						$('#sub_reg').removeAttr('disabled');
						//$('#spinner_reg').hide();
						var body = $("html, body");
body.stop().animate({scrollTop:100}, '500', 'swing', function() { });
						$('#msg_err_reg').html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+obj.msg+'</div>');
						$('#cp').html(obj.cp);
						return;
					}
		  	  }       
		  });
		  return;	
		  }));
		  
//Login
$("#loginfrm").on('submit',(function(e){
		  e.preventDefault();
		  $('#loginbtn').attr('disabled', 'disabled');
		  $.ajax({
		  		url: baseUrl+"login",
		  		type: "POST",
		  		data:  new FormData(this),
		  		contentType: false,
		  		cache: false,
		  		processData:false,
		  		success: function(data){
					var obj = jQuery.parseJSON(data);
		  			if(obj.msg=='done'){
						$('#loginbtn').removeAttr('disabled');
						document.location=baseUrl+obj.redirect_url;
						return;
					}
					else{
						$('#loginbtn').removeAttr('disabled');
						var body = $("html, body");
body.stop().animate({scrollTop:100}, '500', 'swing', function() { });
						$('#msg_err_login').html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+obj.msg+'</div>');
						return;
					}
		  	  }       
		  });
		  return;	
		  }));
});