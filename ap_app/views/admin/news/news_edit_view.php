<div class="box-body">
  <div class="tab-content">
    <div class="tab-pane fade in active">
      <div class="form-group">
        <label  for="exampleInputPassword1">News Title</label>
        <input type="text" class="form-control" id="news_title" name="news_title" value="<?php echo $row->news_title;?>" placeholder="News Title">
        </div>
      
      <div class="form-group">
        <label  for="exampleInputPassword1">News Image</label>
        <input type="file" class="form-control"  id="news_image" name="news_image" value="<?php echo $row->news_image;?>">
        <img src="<?php echo base_url('public/uploads/news/'.$row->news_image);?>" style="max-width:200px;" />
      </div>
        <div class="form-group">
        <label  for="exampleInputPassword1">News Details</label>
        <div style="width:99%;">
          <textarea class="form-control" id="editor1" name="editor1" rows="4" cols="80"><?php echo $row->news_details;?></textarea>
        </div>
      </div>
      	
        <input type="hidden" name="method" id="method" value="update" />
        <input type="hidden" name="nid" id="nid" value="<?php echo $row->ID;?>" />
      
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
	 { name: 'insert', items: [ 'Image', 'Table' ] }
    ]
   });
  });
</script> 