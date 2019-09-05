function add_to_cart(pid){
		if(pid){
		$('#add_c_'+pid).html('Adding...');
		var p_sizes_array = [];	
		var values = $('input[name="pid_'+pid+'[]"]').map(function(){
			var mcCbxCheck = $(this);
			if(mcCbxCheck.is(':checked')) {
				p_sizes_array.push( this.value );	
		}
		}).get();

		var p_sizes_json = JSON.stringify(p_sizes_array);

   
		$.ajax({
				type: "POST",
				url:  baseUrl+"cart/add_to_cart",
				data: { pid: p_sizes_json}
			  })
				.done(function( msg ) {
					
					if(msg=='done'){
						$('#add_c_'+pid).html('<span style="color:green">Added to cart</span>');
					}
					else{
						$('#add_c_'+pid).html('<input type="button" value="Add To Cart" onclick="add_to_cart('+pid+');" />');
						alert(msg);
					}
		});
	}
}


function select_value(field_id, val){
	$("#"+field_id+" option[value='"+val+"']").attr('selected', 'selected');
}
