<div class="box-body">
  <ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#pdetails">Page Details</a></li>
    <li><a href="#pcontent">Page Content</a></li>
    <li><a href="#seo">Page SEO</a></li>
    <li><a href="#gallery">Page Gallery</a></li>
  </ul>
  <div class="clearfix">&nbsp;</div>
  <div class="tab-content">
    <div id="pdetails" class="tab-pane fade in active">
      <div class="form-group">
        <label  for="exampleInputPassword1">Page Heading</label>
        <input type="text" class="form-control"  id="pageTitle" name="pageTitle" value="<?php echo $row->pageTitle;?>" placeholder="Heading">
      </div>
      <div class="form-group">
        <label  for="exampleInputPassword1">Page Slug</label>
        <input type="text" class="form-control" name="pageSlug" id="pageSlug" value="<?php echo $row->pageSlug;?>" placeholder="Page Slug">
      </div>
      <div class="form-group">
        <label  for="exampleInputPassword1">Upload Image (Optional)</label>
        <input type="file" class="form-control"  id="pageImage" name="pageImage">
        <img id="img_preview" src="<?php echo base_url('public/uploads/'.$row->pageImage);?>" style="max-width:200px; <?php echo ($row->pageImage!=''?'display:block !important;':'display:none;');?>" /> </div>
      <div class="form-group">
       <input type="checkbox" name="menuTop" id="menuTop" value="1" <?php echo ($row->menuTop=='1'?'checked="checked"':'');?> /> Show in Header Menu
       <br />
       <input type="checkbox" name="menuBottom" id="menuBottom" value="1" <?php echo ($row->menuBottom=='1'?'checked="checked"':'');?> /> Show in Footer Menu
        </div>
    </div>
    <div id="pcontent" class="tab-pane fade">
      <div class="form-group">
        <label  for="exampleInputPassword1">Page Content</label>
        <div style="width:99%;">
          <textarea class="form-control" id="editor1" name="editor1" rows="4" cols="80"><?php echo $row->pageContent;?></textarea>
        </div>
      </div>
      <input type="hidden" name="method" id="method" value="update" />
      <input type="hidden" name="pid" id="pid" value="<?php echo $row->pageID;?>" />
    </div>
    <div id="seo" class="tab-pane fade">
      <div class="form-group">
        <label>Page Title</label>
        <input type="text" class="form-control"  id="seoMetaTitle" name="seoMetaTitle" value="<?php echo $row->seoMetaTitle;?>" placeholder="Meta Title">
      </div>
      <div class="form-group">
        <label>Meta Keywords</label>
        <input type="text" class="form-control"  id="seoMetaKeyword" name="seoMetaKeyword" value="<?php echo $row->seoMetaKeyword;?>" placeholder="Meta Keywords">
      </div>
      <div class="form-group">
        <label>Meta Description</label>
        <textarea type="text" class="form-control"  id="seoMetaDescription" name="seoMetaDescription" rows="2" placeholder="Meta Description"><?php echo $row->seoMetaDescription;?></textarea>
      </div>
      <div class="form-group">
        <label  for="exampleInputPassword1">Disallow Bots </label>
        <input type="checkbox" name="seoAllowCrawler" id="seoAllowCrawler" value="0" />
      </div>
    </div>
    
    <div id="gallery" class="tab-pane fade">
    <div id="pg_msg" style="color:#F00;"></div>
      <div class="form-group">
        <label  for="exampleInputPassword1">Page Gallery</label>
        <div class="row">
        <div class="col-md-7">
          <input type="file" class="form-control" name="galleryImageFile" id="galleryImageFile" />  
        </div>
        <div class="col-md-5">
          <button type="button" class="btn btn-success" id="pg_sub">Upload</button>
        </div>
        </div>
      </div>
      
      <div class="form-group" id="data_gallery">
      <?php 
	  if($page_gallery_result):
	  foreach($page_gallery_result as $pg_row):?>
      <div style="position:relative; display:inline-block; padding:10px;" id="pg<?php echo $pg_row->pageGalleryID;?>">
        <img src="<?php echo base_url('public/uploads/page_gallery/'.$pg_row->galleryImageFile);?>" style="max-width:100px;" /> <a href="javascript:;" onclick="remove_page_gallery_image(<?php echo $pg_row->pageGalleryID;?>);" class="close" aria-label="close" style="color:#F00; opacity:0.8;">&times;</a>
        </div>
      <?php endforeach; endif;?>
     </div>
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
$("#pageImage").change(function(){
    readURL(this);
});
$(document).ready(function(){ 
    $("#myTab a").click(function(e){
    	e.preventDefault();
    	$(this).tab('show');
    });
	
	//Page Gallery Action
$("#pg_sub").on('click',(function(e){
	if($("#galleryImageFile").val()==''){
		$("#pg_msg").html("Please select image file first.");
		return false;	
	}
	$("#method").val('upload_gallery_image');
	$("#frm_page").submit();
	$("#method").val('update');
}));
});
function remove_page_gallery_image(id){
	// Make an ajax call
//	var myid=id;
	if(id==''){
		$("#msg_box").html("Something went wrong");
		return false;	
	}
		var myurl = baseUrl+'admin/pages/remove_page_gallery_image/'+id;
		$.getJSON(myurl, function (obj_data) {
			 
 		});
		$("#pg"+id).fadeOut();
}
</script> 