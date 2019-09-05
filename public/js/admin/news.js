function load_news_popup(method, id){
		jQuery('#news_popup_box').modal('show');
		
		// Make an ajax call
		var myurl = baseUrl+'admin/news/'+method+'/'+id;
		$.getJSON(myurl, function (obj_data) {
			$("#msg_box").html(obj_data.msg);
   			$("#load_news_form").html(obj_data.form_data);
 		});
}

$(document).ready(function (e) {
$("#frm_news").on('submit',(function(e){
		  e.preventDefault();
		  CKupdate();
		  var method = $('#method').val();
		  var nid = $('#nid').val();
		  $('#spinner_profile').show();
		  $('#news_submit').attr('disabled', 'disabled');
		  $.ajax({
		  		url: baseUrl+"admin/news/"+method+'/'+nid,
		  		type: "POST",
		  		data:  new FormData(this),
		  		contentType: false,
		  		cache: false,
		  		processData:false,
		  		success: function(data){
					var obj = jQuery.parseJSON(data);
		  			if(obj.msg=='done'){
						$('#news_popup_box').modal('toggle');
						$('#news_submit').removeAttr('disabled');
						$('#spinner_profile').hide();
						$.toaster({ priority : 'success', title : 'Success', message : 'Record has been updated successfully.'});
						setTimeout(function() { location.reload(true);}, 2000);
						return;
					}
					else{
						$('#news_submit').removeAttr('disabled');
						$('#spinner_profile').hide();
						$('#msg_box').html(obj.msg);
						return;
					}
		  	  }       
		  });
		  return;	
		  }));
});

function delete_news(id){
	var myurl = baseUrl+'admin/news/delete/'+id;
	var is_confirm = confirm("Are you sure you want to delete this news?");
	if(is_confirm){
		  $.get(myurl, function (sts) {
			  if(sts=='done')
				  $("#row_"+id).fadeOut();
			  else
				  alert('OOps! Something went wrong.');
	   	  });
	}
}

function update_news_status(id){
	var current_status = $("#sts_"+id+" span").html();
	var myurl = baseUrl+'admin/news/status/'+id+'/'+current_status;
	$.get(myurl, function (sts) {
		var class_label = 'success';
		if(sts!='active')
			var class_label = 'danger';
   $("#sts_"+id).html('<span class="label label-'+class_label+'">'+sts+'</span>');
 });
}