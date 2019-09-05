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
    <h2>Profile</h2>
  </div>
</div>
<div class="container">
<?php if($this->session->flashdata('err_applied')): ?>
		<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  		<strong>Error!</strong> <?php echo $this->session->flashdata('err_applied');?>
		</div>
<?php endif;?> 
<?php if($this->session->flashdata('msg')): ?>
		<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  		<strong>Success!</strong> <?php echo $this->session->flashdata('msg');?>
		</div>
<?php endif;?> 
   
  <p><?php echo get_site_url($common_row->tech_text);?></p>
  <div class="row">
    <div class="col-md-3">
                	<?php $this->load->view('jobseeker/common/left_side');?>                
                </div>
    <div class="col-md-9">
      <div class="boxwraper">
        <div class="titlebar"> <b>Manage Profile</b> </div>
        
  <?php echo validation_errors(); ?>
        <form name="profilefrm" id="profilefrm" method="post" action="" enctype="multipart/form-data">
        <div class="formint padding20">
          <div class="input-group">
            <label class="input-group-addon">First Name <span>*</span></label>
            <input type="text" class="form-control" name="f_name" id="f_name" value="<?php echo $row->f_name;?>" required>
          </div>
          <div class="input-group">
            <label class="input-group-addon">Last Name <span>*</span></label>
            <input type="text" class="form-control" name="l_name" id="l_name" value="<?php echo $row->l_name;?>" required>
          </div>
          <div class="input-group">
            <label class="input-group-addon">Telephone Number <span>*</span></label>
            <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $row->phone;?>" required>
          </div>
          <div class="input-group">
            <label class="input-group-addon">City <span>*</span></label>
            <input type="text" class="form-control" name="city" id="city" value="<?php echo $row->city;?>" required>
          </div>
          <div class="input-group">
            <label class="input-group-addon">Resume <span>*</span></label>
            <input type="file" class="form-control" name="resume" id="resume" value="<?php echo $row->resume;?>">
          </div>
          <div class="input-group">
            <label class="input-group-addon">Password <span>*</span></label>
            <input type="password" class="form-control" id="passcode" min="5" name="passcode" value="">
            
          </div>
          <div class="formbtn">
            <input type="submit" class="sbutn" value="Submit" name="sub_profile" id="sub_profile">
          </div>
          
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- .footer-wrapper start -->
<?php $this->load->view('common/footer');?>
<!-- .footer-wrapper end -->
<?php $this->load->view('common/before_body_close');?>
<script src="<?php echo base_url('public/js/register.js');?>"></script>
</body>
</html>
