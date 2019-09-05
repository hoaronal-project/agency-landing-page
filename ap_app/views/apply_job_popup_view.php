<div class="box-body">
  <div class="tab-content">
    <div>
      <div class="form-group">
        <label  for="exampleInputPassword1">Upload Resume</label>
        <input type="file" class="form-control" id="resume" name="resume">
        Current Resume: <strong><?php echo $row_js->resume;?></strong>
        </div>
        <div class="form-group">
        <label  for="exampleInputPassword1">Cover Letter</label>
        <div style="width:99%;">
          <textarea class="form-control" id="cover_letter" name="cover_letter" rows="6" cols="80" required="required"><?php echo $row_js->text_resume;?></textarea>
        </div>
      </div>
      	
        <input type="hidden" name="method" id="method" value="apply_now" />
        <input type="hidden" name="jid" id="jid" value="<?php echo $row->ID;?>" />
      
    </div>
  </div>
</div>