/************************************************/
/// isscroll value should be 1 or yes if dont want to scroll the div the you can set it empty or no.
/// popupHeight depend on isscroll value if isscroll value is 1 or yes and popupHeight value is empty then it will return an error.
/// if backgroundOverlay is 1 or yes thenm it will show background overlay, if value is empty, 0 or no then it will not show background Overlay
/// Through CSS important layout settings of Popup can be changed like Popup position, color of Text, Heading style, Heading background color and Popup outer border    color.
/// By default Popup will set itself in center according to screen resolution.


/************************************************/
var ScrollBackToX = '';
var ScrollBackToY = '';

function loadNewPopup(headingText,content,popupWidth,popupHeight,isscroll,backgroundOverlay,jqSelector,selectorName,topPosition,topPositionUnit,popUpPosition)
{
		
		if(arguments.length > 11) {
			
			for (var x = 11; x < arguments.length; x++) {
				
				var getValueArr = arguments[x].split(':');
				
				var varType = getValueArr[0];
				var varValue = getValueArr[1];
				
				if(varType == 'windowScroll') {
					
					if(varValue == '1' || varValue == 'yes') {
						
						varType = getValueArr[2];
						varValue = getValueArr[3];
						
						if(varType == 'windowScrollToX') {
							
							var setX = varValue;
							
						}
						
						varType = getValueArr[4];
						varValue = getValueArr[5];
						
						
						if(varType == 'windowScrollToY') {
							
							var setY = varValue;
							
						}
						
						window.scroll(parseInt(setX),parseInt(setY));
						
						varType = getValueArr[6];
						varValue = getValueArr[7];
					
						if(varType == 'windowScrollBack') {
							
							
							if(varValue == '1' || varValue == 'yes') {
								
								varType = getValueArr[8];
								varValue = getValueArr[9];
								
								if(varType == 'windowSrollBackSelector') {
									
									var position = $(varValue).position();
									ScrollBackToX = position.left;
									ScrollBackToY = position.top;
									//alert("X"+" "+ScrollToX+" Y"+" "+ScrollToY);
									
								}
								
								
							
							}
								
																
						}	
						
					}
					
				} else {
					
					alert("Unknown Parameter");
					return false;
					
				}
				
			};
			
		}
		
		if(backgroundOverlay == '1' || backgroundOverlay == 'yes') {
			
			var createMainDivs = '<div id="backgroundPopup"></div><div class="content_main"><div class="content_popup"></div></div>';
			
		} else {
		
			var createMainDivs = '<div class="content_main"><div class="content_popup"></div></div>';
		
		}
		
		var headingDivWidth = parseInt(popupWidth) - 52;
		var headingHtml = '<div class="heading_popup"><div></div><a href="javascript:;" onclick="closePopup()">Close (X)</a></div>';
		
		if(jqSelector != "") {
		
			if(jqSelector == 'id' || jqSelector == 'class' || jqSelector == 'tag') {
				
				if(jqSelector == 'id') {
					var selector = "#";
				} else if(jqSelector == 'class') {
					var selector = ".";
				} else if(jqSelector == 'tag') {
					var selector = "";
				}
				
			} else {
				
				alert('Select the Valid Selector');
				return false;
			}
			
		} else {
			
			alert('Select the Valid Selector. Possible Values are id, class and tag.');
			return false;
			
		}
		
		
		if(selectorName == "") {
			
			alert("Please Define Selector. Possible values are id name, class name and Tag name");
			return false;
			
		} else {
			
			var jQobject = selector+selectorName;
			
		}
		
		
		if($('.content_main').length > 0) {
			
			$('#backgroundPopup').remove();
			$('.content_main').remove();
			
			$(jQobject).append(createMainDivs);
		} else {
			
			$(jQobject).append(createMainDivs);
			
		}
		
		if(isscroll=='yes' || isscroll=='1') {
			var scrollDiv = '<div class="scroll-divPopup">&nbsp;</div>';
		}
		
		$("#backgroundPopup").css({
			"opacity": "0.7"
		});
		
		
		if(popUpPosition != "") {
			
						if(popUpPosition != "fixed" && popUpPosition !="absolute" && popUpPosition !="relative") {
				
				alert("Possible values of popUpPosition should be fixed and absolute");
				return false;
			}
			
			$('.content_main').css({
				"position":popUpPosition
			});
		}
		
		
		if(topPosition!='') {
			
			if(topPositionUnit == "") {
				
				alert("You Define topPositionValue. Possible values are px and %");
				return false;
			}
			
			setTop = topPosition+topPositionUnit;
			
			$('.content_main').css({
				"top":setTop
			});
			
		}
		
		$('.content_popup').css({
			"width":popupWidth+"px"
		});
		
		$('.content_popup').html(headingHtml);

		$('.heading_popup div').css({
			"float": "left",
			"width": headingDivWidth+"px"
		});

		$('.heading_popup div').html(unescape(headingText));
		
		if(isscroll == 'yes' || isscroll=='1') {
			if(popupHeight == '') {
				alert('Variable "popupHeight" value is missing.');
				return false;
			} else {
					$('.content_popup').append(scrollDiv);
					
					$('.scroll-divPopup').css({
						"height" : popupHeight+"px"
					});
	
					$('.scroll-divPopup').html(unescape(content));
			}
		}
		else {
				$('.content_popup').append(unescape(content));
		}
		
		$("#backgroundPopup").fadeIn("slow");
		$('.content_main').fadeIn("slow");
}



function closePopup(){
	
	if(ScrollBackToX != "" && ScrollBackToY != "") {
		
		window.scroll(parseInt(ScrollBackToX),parseInt(ScrollBackToY));
		$('.content_main').fadeOut('slow');	
		$("#backgroundPopup").fadeOut('slow');
		
	}
	
	$("#backgroundPopup").fadeOut('slow');
	$('.content_main').fadeOut('slow');
	$('.content_main').remove();
	
	ScrollBackToX = '';
	ScrollBackToY = '';
}


function showpopwithUpdatedText() {
	
	var eml3=document.getElementById('email').value;

	var content2 = escape('<div style="padding-left:5px;">If you would like to  send it to '+eml3+', please click YES. If that is  not your email address and you would like to change your email address, please  click NO <table width="100%"><tr><td align="right"><img onclick="formSubmit();" src="images/yes-btn.png" /></td><td width="5%"></td><td><img onclick="edit_email();" src="images/no-btn.png" /></td></tr></table></div>');
	
	 loadNewPopup(escape('Resend confirmation email'),content2,'400','','','1','tag','body','','','fixed');
}

function testExtraArgus()
{
	content = escape('<table width="100%" border="0" cellspacing="3" cellpadding="3"><tr><td width="100%" colspan="3">Looks like either your email address or PIN is entered incorrectly. Please review both and fix the issue.</td></tr></table>');
	
	loadNewPopup(escape('Incorrect'),content,'400','','','1','tag','body','','','fixed', 'windowScroll:1:windowScrollToX:0:windowScrollToY:0:windowScrollBack:1:windowSrollBackSelector:#fourthimage');
}
function validate_myaccount(form)
{
	var email_regexp =/^([A-Za-z0-9_\-\.])+\@(([A-Za-z0-9_\-])+\.)+([A-Za-z]{2,4})$/;
	var fname = document.getElementById("fname").value;
	var lname = document.getElementById("lname").value;
	var email = document.getElementById("email").value;
	var address = document.getElementById("address").value;
	var city = document.getElementById("city").value;
	var zip = document.getElementById("zip").value;
	var p1 = document.getElementById("hphone1").value;
	var p2 = document.getElementById("hphone2").value;
	var p3 = document.getElementById("hphone3").value;
	if(fname == "" || fname == null)
	{
		alert('<table width="450" border="0" cellspacing="0" cellpadding="0"><tr><td>Oops, there\'s a problem with your submission.</td> </tr> <tr><td>&nbsp;</td> </tr> <tr><td>Here\'s the problem: <span style="color:#F00;"><strong>You have not provided your first name.</td> </tr><tr><td>&nbsp;</td> </tr><tr><td>Please fix that and you can continue.</td></tr><tr><td>&nbsp;</td></tr></table>');
		return false;
	}
	else if(lname == "" || lname == null)
	{
		alert('<table width="450" border="0" cellspacing="0" cellpadding="0"><tr><td>Oops, there\'s a problem with your submission.</td> </tr> <tr><td>&nbsp;</td> </tr> <tr><td>Here\'s the problem: <span style="color:#F00;"><strong>You have not provided your last name.</td> </tr><tr><td>&nbsp;</td> </tr><tr><td>Please fix that and you can continue.</td></tr><tr><td>&nbsp;</td></tr></table>');
		return false;
	}
	else if(email == "" || email == null)
	{ alert('<table width="450" border="0" cellspacing="0" cellpadding="0"><tr><td>Oops, there\'s a problem with your submission.</td> </tr> <tr><td>&nbsp;</td> </tr> <tr><td>Here\'s the problem: <span style="color:#F00;"><strong>You have not provided your valid email address.</td> </tr><tr><td>&nbsp;</td> </tr><tr><td>Please fix that and you can continue.</td></tr><tr><td>&nbsp;</td></tr></table>');
	 return false;
	}
	else if(!email.match(email_regexp))
	{ alert('<table width="450" border="0" cellspacing="0" cellpadding="0"><tr><td>Oops, there\'s a problem with your submission.</td> </tr> <tr><td>&nbsp;</td> </tr> <tr><td>Here\'s the problem: <span style="color:#F00;"><strong>You have not provided your valid email address.</td> </tr><tr><td>&nbsp;</td> </tr><tr><td>Please fix that and you can continue.</td></tr><tr><td>&nbsp;</td></tr></table>');
	 return false;
	}	 
	 else if(address == "" || address == null)
	 { alert('<table width="450" border="0" cellspacing="0" cellpadding="0"><tr><td>Oops, there\'s a problem with your submission.</td> </tr> <tr><td>&nbsp;</td> </tr> <tr><td>Here\'s the problem: <span style="color:#F00;"><strong>You have not provided your street addres.</td> </tr><tr><td>&nbsp;</td> </tr><tr><td>Please fix that and you can continue.</td></tr><tr><td>&nbsp;</td></tr></table>');
	 return false;
	 }	 
	 else if(city == "" || city== null)
	 { alert('<table width="450" border="0" cellspacing="0" cellpadding="0"><tr><td>Oops, there\'s a problem with your submission.</td> </tr> <tr><td>&nbsp;</td> </tr> <tr><td>Here\'s the problem: <span style="color:#F00;"><strong>You have not provided your city name.</td> </tr><tr><td>&nbsp;</td> </tr><tr><td>Please fix that and you can continue.</td></tr><tr><td>&nbsp;</td></tr></table>');
	 return false;
	 } 
	 else if(zip == "" || zip== null)
	 { alert('<table width="450" border="0" cellspacing="0" cellpadding="0"><tr><td>Oops, there\'s a problem with your submission.</td> </tr> <tr><td>&nbsp;</td> </tr> <tr><td>Here\'s the problem: <span style="color:#F00;"><strong>You have not provided your zipcode.</td> </tr><tr><td>&nbsp;</td> </tr><tr><td>Please fix that and you can continue.</td></tr><tr><td>&nbsp;</td></tr></table>');
	 return false;
	 }
	 else if(p1 == "" || p1== null)
	 { alert('<table width="450" border="0" cellspacing="0" cellpadding="0"><tr><td>Oops, there\'s a problem with your submission.</td> </tr> <tr><td>&nbsp;</td> </tr> <tr><td>Here\'s the problem: <span style="color:#F00;"><strong>You have not provided your valid phone number.</td> </tr><tr><td>&nbsp;</td> </tr><tr><td>Please fix that and you can continue.</td></tr><tr><td>&nbsp;</td></tr></table>');
	 return false;
	 }
	 else if(p1.length < 3)
	 { alert('<table width="450" border="0" cellspacing="0" cellpadding="0"><tr><td>Oops, there\'s a problem with your submission.</td> </tr> <tr><td>&nbsp;</td> </tr> <tr><td>Here\'s the problem: <span style="color:#F00;"><strong>You have not provided your valid phone number.</td> </tr><tr><td>&nbsp;</td> </tr><tr><td>Please fix that and you can continue.</td></tr><tr><td>&nbsp;</td></tr></table>'); return false;
	 }
	else if(p2 == "" || p2 == null)
	{ alert('<table width="450" border="0" cellspacing="0" cellpadding="0"><tr><td>Oops, there\'s a problem with your submission.</td> </tr> <tr><td>&nbsp;</td> </tr> <tr><td>Here\'s the problem: <span style="color:#F00;"><strong>You have not provided your valid phone number.</td> </tr><tr><td>&nbsp;</td> </tr><tr><td>Please fix that and you can continue.</td></tr><tr><td>&nbsp;</td></tr></table>');
	 return false;
	}
	else if(p2.length < 3)
	{ alert('<table width="450" border="0" cellspacing="0" cellpadding="0"><tr><td>Oops, there\'s a problem with your submission.</td> </tr> <tr><td>&nbsp;</td> </tr> <tr><td>Here\'s the problem: <span style="color:#F00;"><strong>You have not provided your valid phone number.</td> </tr><tr><td>&nbsp;</td> </tr><tr><td>Please fix that and you can continue.</td></tr><tr><td>&nbsp;</td></tr></table>');
	 return false;
	}
	else if(p3 == "" || p3 == null)
	{ alert('<table width="450" border="0" cellspacing="0" cellpadding="0"><tr><td>Oops, there\'s a problem with your submission.</td> </tr> <tr><td>&nbsp;</td> </tr> <tr><td>Here\'s the problem: <span style="color:#F00;"><strong>You have not provided your valid phone number.</td> </tr><tr><td>&nbsp;</td> </tr><tr><td>Please fix that and you can continue.</td></tr><tr><td>&nbsp;</td></tr></table>');
	 return false;
	}
	else if(p3.length < 4)
	{ alert('<table width="450" border="0" cellspacing="0" cellpadding="0"><tr><td>Oops, there\'s a problem with your submission.</td> </tr> <tr><td>&nbsp;</td> </tr> <tr><td>Here\'s the problem: <span style="color:#F00;"><strong>You have not provided your valid phone number.</td> </tr><tr><td>&nbsp;</td> </tr><tr><td>Please fix that and you can continue.</td></tr><tr><td>&nbsp;</td></tr></table>');
	return false;
	}


else 
	form.submit();

}

/*function loadVideos(id) {
	
		var content = '<iframe src="//player.vimeo.com/video/'+id+'?title=0&amp;byline=0&amp;portrait=0" width="725" height="480" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe><table width="725" bordercolor="#4A91C8" border="0" cellspacing="0" cellpadding="0"><tbody><tr> <td bgcolor="#4A91C8" align="center"><a href="http://www.savingsangel.com/16-1-3-2.html" target="_blank" style="color:#000;font-size:28px;">Start your full 90-day journey and enjoy more abundance</td></tr></tbody></table>';
				
	loadNewPopup(escape('&nbsp;'),content,'735','','','1','tag','body','17','%','fixed');
	
}*/