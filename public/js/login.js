//JS
var err = 0;
$(document).ready(function(){

 $("#login_form #username").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('username', 'username', closest_div, '', '', '','');
 });

 $("#login_form #pass").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('pass', 'password', closest_div, '', '', '','');
 });
 
 
 $("#forgot_form #email").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('email', 'email', closest_div, '', '', '','');
 });

 $("#forgot_form #captcha").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('captcha', 'code', closest_div, '', '', '','');
 });
 
 
});

function validate_login_form(theForm){
  if(is_empty($("#username"), 'username', 'username')) return false;
  if(is_empty($("#pass"), 'pass', 'password')) return false;
}

function validate_forgot_form(theForm){
  if(is_empty($("#email"), 'email', 'username')) return false;
  if(is_empty($("#captcha"), 'captcha', 'code')) return false;
}