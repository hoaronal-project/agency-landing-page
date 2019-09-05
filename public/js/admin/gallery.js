function load_popup(method, id){
		jQuery('#popup_box').modal('show');
		
		// Make an ajax call
		var myurl = baseUrl+'admin/gallery/'+method+'/'+id;
		$.getJSON(myurl, function (obj_data) {
			$("#msg_box").html(obj_data.msg);
   			$("#load_form").html(obj_data.form_data);
 		});
}

$(document).ready(function (e) {
$("#frm_gallery").on('submit',(function(e){
		  e.preventDefault();
		  var method = $('#method').val();
		  var rid = $('#rid').val();
		  $('#spinner_profile').show();
		  $('#frm_submit').attr('disabled', 'disabled');
		  $.ajax({
		  		url: baseUrl+"admin/gallery/"+method+'/'+rid,
		  		type: "POST",
		  		data:  new FormData(this),
		  		contentType: false,
		  		cache: false,
		  		processData:false,
		  		success: function(data){
					var obj = jQuery.parseJSON(data);
		  			if(obj.msg=='done'){
						$('#popup_box').modal('toggle');
						$('#frm_submit').removeAttr('disabled');
						$('#spinner_profile').hide();
						$.toaster({ priority : 'success', title : 'Success', message : 'Record has been updated successfully.'});
						setTimeout(function() { location.reload(true);}, 2000);
						return;
					}
					else{
						$('#frm_submit').removeAttr('disabled');
						$('#spinner_profile').hide();
						$('#msg_box').html(obj.msg);
						return;
					}
		  	  }       
		  });
		  return;	
		  }));
});

function delete_record(id){
	var myurl = baseUrl+'admin/gallery/delete/'+id;
	var is_confirm = confirm("Are you sure you want to delete this record?");
	if(is_confirm){
		  $.get(myurl, function (sts) {
			  if(sts=='done')
				  $("#row_"+id).fadeOut();
			  else
				  alert('OOps! Something went wrong.');
	   	  });
	}
}

function update_status(id){
	var current_status = $("#sts_"+id+" span").html();
	var myurl = baseUrl+'admin/gallery/status/'+id+'/'+current_status;
	$.get(myurl, function (sts) {
		var class_label = 'success';
		if(sts!='active')
			var class_label = 'danger';
   $("#sts_"+id).html('<span class="label label-'+class_label+'">'+sts+'</span>');
 });
}

//Image reading before uploading on server
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
			$('#img_preview').css('display','block');
            $('#img_preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#image_name").change(function(){
    readURL(this);
});
