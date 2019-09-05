//JS
var err = 0;
$(document).ready(function(){
	
 //Email address
 $("#signup_form #user_name").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('user_name', 'username', closest_div, '', '', '','');
	 check_username($('#user_name').val());
 });
 
 $('#signup_form #user_name').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^a-zA-Z0-9\s]/g,'') ); }
 );

 //Password
 $("#signup_form #passcode").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('passcode', 'passcode', closest_div, '', '6', '','');
 });
 
 //Confirm Password
 $("#signup_form #confirm_pass").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('confirm_pass', 'confirm password', closest_div, '', '', 'passcode','');	
 });
 
 //Full Name
 $("#signup_form #full_name").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('full_name', 'full name', closest_div, '', '', '','');	
 });
 $('#signup_form #full_name').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^a-zA-Z\s]/g,'') ); }
);

 //Email
 $("#signup_form #email_address").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('email_address', 'email address', closest_div, 'yes', '', '','');
	 check_email($('#email_address').val());
 });
 
 //Phone
 $("#signup_form #phone").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('phone', 'phone', closest_div, '', '', '','');
 });
 $('#signup_form #phone').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^0-9\s]/g,'') ); }
);
  
 //street address
 $("#signup_form #street_address").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('street_address', 'street address', closest_div, '', '', '','');
 });
 
 //Country
 $("#signup_form #country").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('country', 'country name', closest_div, '', '', '','');
 });
 
 //City
 $(document.body).on('blur','#signup_form #city',function(){	
	 closest_div = $( this ).closest('div');
	 universal_validation('city', 'city name', closest_div, 'no', '', '','');
 });
 
 /*$("#signup_form #city").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('city', 'city name', closest_div, 'no', '', '','');
 });*/


 //captcha
 $("#signup_form #captcha").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('captcha', 'verification code', closest_div, '', '', '','');
 });

 /*$('#signup_form').bind('keyup blur',function(){ 
    if($('.ui-autocomplete-input').val()!=''){
		$( '.city_err').remove(); 
	}
});*/

});

function validate_signup_form(theForm){
  if(is_empty($("#user_name"), 'user_name', 'username')) return false;
  if(check_username($('#user_name').val())) return false;
  if(is_empty($("#passcode"), 'passcode', 'password')) return false;
  if(is_empty($("#confirm_pass"), 'confirm_pass', 'confirm password')) return false;
  if(is_not_match($("#passcode"), $("#confirm_pass"), 'confirm_pass', 'confirm password')) return false;
  if(is_empty($("#full_name"), 'full_name', 'full name')) return false;
  if(is_empty($("#email_address"), 'email_address', 'email address')) return false;
  if(check_email($('#email_address').val())) return false;
  if(is_empty($("#phone"), 'phone', 'phone')) return false;
  if(is_empty($("#street_address"), 'street_address', 'street address')) return false;
  if(is_empty($("#country"), 'country', 'country')) return false;
  if(is_empty($("#city"), 'city', 'city')) return false;
  if(is_empty($("#captcha"), 'captcha', 'captcha')) return false;
}

function check_username(username){
	var returnval = true;
	if(username){
		$('.user_name_err').remove();
		$.ajax({
				type: "POST",
				url: baseUrl+"signup/check_username",
				data: { username: username}
			  })
				.done(function( msg ) {
					$('.user_name_err').remove();
					if(msg=='1'){
						$( '#user_name' ).closest('div').append('<span class="errormsg user_name_err">Username is already taken.</span>');
						returnval = true;
						$( '#user_name' ).focus();
					}
					else if(msg=='0'){
						$( '#user_name' ).closest('div').append('<span class="user_name_err" style="color:green;">Username available.</span>');
						returnval = false;
					}
					else{
						$( '#user_name' ).closest('div').append(msg);
						returnval = true;
						$( '#user_name' ).focus();
					}
					
					return returnval;
		});
	}
	
}

function check_email(email){
	var returnval = true;
	if(email){
		$('.email_address_err').remove();
		$.ajax({
				type: "POST",
				url: baseUrl+"signup/check_email",
				data: { email: email}
			  })
				.done(function( msg ) {
					$('.email_address_err').remove();
					if(msg=='1'){
						$( '#email_address' ).closest('div').append('<span class="errormsg email_address_err">Email address is already taken.</span>');
						returnval = true;
						$( '#email_address' ).focus();
					}
					else if(msg=='0'){
						$( '#email_address' ).closest('div').append('<span class="email_address_err" style="color:green;">Email Address available.</span>');
						returnval = false;
					}
					else{
						$( '#email_address' ).closest('div').append(msg);
						returnval = true;
						$( '#email_address' ).focus();
					}
					return returnval;
		});
	}
	
}

function show_cities_ajax(country){	
	$("#citi").html('<span class="loading" style="padding-left:0"><input type="text" value="Loading..." id="" name="" class="formfield" style="border: medium none; color:#AF3BB8;"></span>');
	$.ajax({
				type: "POST",
				url: baseUrl+"signup/get_cities_by_country",
				data: { country: country}
			  })
				.done(function( msg ) {
					$("#citi").html(msg);
				});
}

//==================================================
//SIGNUP 2 FORM
//==================================================

$(document).ready(function(){

 $("#signup2_form #s_1").click(function(){
	 load_seller_form('free');
 });
 $("#signup2_form #s_2").click(function(){
	 load_seller_form('free');
 });
 $("#signup2_form #s_3").click(function(){
	 load_seller_form('full');
 });
 
 /*$('#signup2_form #user_name').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^a-zA-Z0-9\s]/g,'') ); }
 );*/

$(document.body).on('blur','#signup2_form #business_identity',function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('business_identity', 'business identity', closest_div, '', '', '','');
 });
 
$(document.body).on('blur','#signup2_form #about_service',function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('about_service', 'about service', closest_div, '', '', '','');
 });

 $(document.body).on('change blur','#signup2_form #logo',function(){
	closest_div = $( this ).closest('div');
	universal_validation('logo', 'logo', closest_div, '', '', '','logo');
 });
 
 
 $(document.body).on('blur','#signup2_form #boutique_address',function(){
	closest_div = $( this ).closest('div');
	universal_validation('boutique_address', 'boutique address', closest_div, '', '', '','');
 });
 
 $(document.body).on('blur','#signup2_form #boutique_phone',function(){
	closest_div = $( this ).closest('div');
	universal_validation('boutique_phone', 'boutique_phone', closest_div, '', '', '','');
 });
 
 $(document.body).on('blur','#signup2_form #city',function(){
	closest_div = $( this ).closest('div');
	universal_validation('city', 'city', closest_div, '', '', '','');
 });


});

function validate_signup2_form(theForm){
  if(is_empty($("#business_identity"), 'business_identity', 'business identity')) return false;
  if(is_empty($("#about_service"), 'about_service', 'about service')) return false;

  var ext = $('#logo').val().split('.').pop().toLowerCase();
  if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
		closest_div = $( '#logo' ).closest('div');
		closest_div.append( error_wrapper('logo_err', 'Please upload a valid logo.') );
		$('#logo').focus();
		return false;
	}
	
	if ($('#s_3').is(':checked')) {
		if(is_empty($("#boutique_address"), 'boutique_address', 'boutique address')) return false;	
		if(is_empty($("#boutique_phone"), 'boutique_phone', 'boutique phone number')) return false;	
		if(is_empty($("#city"), 'city', 'city name')) return false;	
	}
}

function load_seller_form(type){
	var myurl = baseUrl+'signup/load_seller_form/'+type;
		  $.get(myurl, function (msg) {
			 $("#res_frm").html(msg);
	   	  });
}