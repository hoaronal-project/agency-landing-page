function load_job_popup(method, id){
		jQuery('#job_popup_box').modal('show');
		
		// Make an ajax call
		var myurl = baseUrl+'admin/jobs/'+method+'/'+id;
		$.getJSON(myurl, function (obj_data) {
			$("#msg_box").html(obj_data.msg);
   			$("#load_job_form").html(obj_data.form_data);
 		});
}

$(document).ready(function (e) {
$("#frm_job").on('submit',(function(e){
		  e.preventDefault();
		  CKupdate();
		  var method = $('#method').val();
		  var jid = $('#jid').val();
		  $('#spinner_profile').show();
		  $('#job_submit').attr('disabled', 'disabled');
		  $.ajax({
		  		url: baseUrl+"admin/jobs/"+method+'/'+jid,
		  		type: "POST",
		  		data:  new FormData(this),
		  		contentType: false,
		  		cache: false,
		  		processData:false,
		  		success: function(data){
					var obj = jQuery.parseJSON(data);
		  			if(obj.msg=='done'){
						$('#job_popup_box').modal('toggle');
						$('#job_submit').removeAttr('disabled');
						$('#spinner_profile').hide();
						$.toaster({ priority : 'success', title : 'Success', message : 'Record has been updated successfully.'});
						setTimeout(function() { location.reload(true);}, 2000);
						return;
					}
					else{
						$('#job_submit').removeAttr('disabled');
						$('#spinner_profile').hide();
						$('#msg_box').html(obj.msg);
						return;
					}
		  	  }       
		  });
		  return;	
		  }));
});

function delete_job(id){
	var myurl = baseUrl+'admin/jobs/delete/'+id;
	var is_confirm = confirm("Are you sure you want to delete this job?");
	if(is_confirm){
		  $.get(myurl, function (sts) {
			  if(sts=='done')
				  $("#row_"+id).fadeOut();
			  else
				  alert('OOps! Something went wrong.');
	   	  });
	}
}

function update_job_status(id){
	var current_status = $("#sts_"+id+" span").html();
	var myurl = baseUrl+'admin/jobs/status/'+id+'/'+current_status;
	$.get(myurl, function (sts) {
		var class_label = 'success';
		if(sts!='active')
			var class_label = 'danger';
   $("#sts_"+id).html('<span class="label label-'+class_label+'">'+sts+'</span>');
 });
}