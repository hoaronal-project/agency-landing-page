<div class="box-body">
  <div class="tab-content">
    <div id="pdetails" class="tab-pane fade in active">
      <div class="form-group">
        <label for="exampleInputPassword1">Upload Image</label>
        <input type="file" class="form-control"  id="image_name" name="image_name" value="<?php echo set_value('image_name');?>">
        <?php echo form_error('image_name'); ?> <br />
        <img id="img_preview" src="<?php echo base_url('public/uploads/gallery/'.$row->image_name);?>" style="max-width:200px; <?php echo ($row->image_name!=''?'display:block !important;':'display:none;');?>" /> </div>
      <div class="form-group">
        <label  for="exampleInputPassword1">Image Caption</label>
        <input type="text" class="form-control" name="image_caption" id="image_caption" value="<?php echo $row->image_caption;?>" placeholder="Image Caption" maxlength="100">
        <?php echo form_error('image_caption'); ?> </div>
    </div>
    <div id="pcontent" class="tab-pane fade">
      <input type="hidden" name="method" id="method" value="update" />
      <input type="hidden" name="rid" id="rid" value="<?php echo $row->ID;?>" />
    </div>
  </div>
</div>