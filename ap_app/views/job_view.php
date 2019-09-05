<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('common/before_head_close');?>
</head>
<body class="home">
<!-- #header-wrapper start -->
<?php $this->load->view('common/header');?>
<!-- #header-wrapper end --> 
<!-- .page-content start -->
<div class="page-title-container">
  <div class="container">
    <h2><?php echo $row->job_title;?></h2>
  </div>
</div>
<div class="container">
<?php if($this->session->flashdata('applied_action')==true): ?>
<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> You have successfully applied for this job.
</div>
<?php endif;?> 
<?php if($this->session->flashdata('applied_action')==false && $is_already_applied): ?>
<div class="alert alert-info">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Heads up!</strong> You have already applied for this job.
</div>
<?php endif;?> 
<?php if($this->session->flashdata('err_applied')): ?>
<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error!</strong> <?php echo $this->session->flashdata('err_applied');?>
</div>
<?php endif;?> 
<div id="msg_err"></div>
  <div class="boxwraper">
    <div class="titlebar">Job Details</div>
    <!--Job Detail-->
    <div class="row"> 
      <!--Requirements-->
      <div class="col-md-6">
        <ul class="reqlist">
          <li>
            <div class="col-sm-6">Job Title:</div>
            <div class="col-sm-6"><?php echo $row->job_title;?></div>
            <div class="clearfix"></div>
          </li>
          <li>
            <div class="col-sm-6">Department / Type:</div>
            <div class="col-sm-6"><?php echo $row->type_name;?></div>
            <div class="clearfix"></div>
          </li>
          <li>
            <div class="col-sm-6">Job City:</div>
            <div class="col-sm-6"><?php echo $row->city;?></div>
            <div class="clearfix"></div>
          </li>
          
          <li>
            <div class="col-sm-6">Job State:</div>
            <div class="col-sm-6"><?php echo $row->state;?></div>
            <div class="clearfix"></div>
          </li>
          
          <li>
            <div class="col-sm-6">Job Posting Date:</div>
            <div class="col-sm-6"><?php echo date_formats($row->dated,'M d, Y');?></div>
            <div class="clearfix"></div>
          </li>
        </ul>
      </div>
      <!--Map-->
      <div class="col-md-6">
        <div class="jobdescription" style="padding-left:5px;">
          <div class="subtitlebar">Job Description</div>
          <p><?php echo $row->description;?> </p>
        </div>
      </div>
    </div>
	<?php if($is_already_applied): ?>
    <div class="actionBox footeraction">
      <h4>You have already applied for this job</h4>
      </div>
    <?php else:?>
    <div class="actionBox footeraction">
      <h4>To Apply for this job click below</h4>
      <?php if($this->session->userdata('user_id')):?>
      <a href="javascript:;" onClick="load_popup('job_info', <?php echo $row->ID;?>);" class="applyjob"><span>Apply Now</span></a> 
     <?php else:?>
	 <a href="<?php echo base_url('job/apply/'.$this->uri->segment(2));?>" class="applyjob"><span>Apply Now</span></a> 
	 <?php endif;?> 
      </div>
    <?php endif;?>
    <div class="clear"></div>
  </div>
</div>
<form name="frm_apply" id="frm_apply" method="post" enctype="multipart/form-data">
  <div class="modal fade" id="popup_box">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">You are appling for: <span id="jtitle"></span></h4>
        </div>
        <div class="modal-body">
          <div id="msg_box" style="padding-bottom:5px; color:#F00;"></div>
          <div class="box-body">
            <div id="load_form"><i class="fa fa-refresh fa-spin" style="font-size:20px;"></i></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            <button type="submit" name="frm_submit" id="frm_submit" class="btn btn-primary">Sumbit <span id="spinner_profile" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span></button>
          </div>
        </div>
      </div>
      <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
  </div>
</form>
<!-- .footer-wrapper start -->
<?php $this->load->view('common/footer');?>
<!-- .footer-wrapper end -->
<?php $this->load->view('common/before_body_close');?>
<script src="<?php echo base_url('public/js/apply.js');?>"></script>
<script type="text/javascript">
function apply_direct(jslug){
	$.get( baseUrl+"job/apply_for_job/"+jslug, function( data ) {
  	var obj = jQuery.parseJSON(data);
	document.location=baseUrl+obj.redirect_url;
	return;
});
}
</script>
</body>
</html>
