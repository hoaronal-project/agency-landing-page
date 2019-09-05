<div class="box-body">
  <div class="tab-content">
    <div class="tab-pane fade in active">
      <div class="form-group">
        <label  for="exampleInputPassword1">Job Title</label>
        <input type="text" class="form-control" id="job_title" name="job_title" value="" placeholder="Job Title">
        </div>
      <div class="form-group">
        <label  for="exampleInputPassword1">Job Type</label>
        <select class="form-control" name="job_type_ID" id="job_type_ID">
           <option value="" selected="selected">- - Job Type - -</option>
           <?php
		   	if($obj_types):
				foreach($obj_types as $row_type):
		   ?>
          <option value="<?php echo $row_type->ID;?>"><?php echo $row_type->type_name;?></option>
          <?php endforeach; endif;?>
        </select>
      </div>
      <div class="form-group">
        <label  for="exampleInputPassword1">City</label>
        <input type="text" class="form-control"  id="city" name="city" value="">
      </div>
      <div class="form-group">
        <label  for="exampleInputPassword1">State</label>
        <input type="text" class="form-control"  id="state" name="state" value="">
      </div>
        
        <div class="form-group">
        <label  for="exampleInputPassword1">Job Description</label>
        <div style="width:99%;">
          <textarea class="form-control" id="editor1" name="editor1" rows="4" cols="80"></textarea>
        </div>
      </div>
      	
        <input type="hidden" name="method" id="method" value="add" />
      <input type="hidden" name="jid" id="jid" value="" />
      
    </div>
  </div>
</div>
<script src="<?php echo base_url('public/js/admin/plugins/ckeditor/ckeditor.js'); ?>" type="text/javascript"></script> 
<script type="text/javascript">
  $(function() {
   var editor = CKEDITOR.replace( 'editor1', {
    enterMode : CKEDITOR.ENTER_BR,    
    toolbar: [
     { name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },
     [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],
     '/',                   
     { name: 'basicstyles', items: [ 'Bold', 'Italic' ] },
	 { name: 'insert', items: [ 'Table' ] }
    ]
   });
  });
</script> 
