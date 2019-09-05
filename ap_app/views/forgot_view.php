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
    <h2>Forgot Password</h2>
  </div>
</div>
<div class="container">
<?php if($this->session->flashdata('msg')): ?>
		<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  		 <strong>Error:</strong> <?php echo $this->session->flashdata('msg');?>
		</div>
		<?php endif;?> 
        
  <div class="row">
    <div class="col-md-5">
    
      <form name="loginfrm" id="loginfrm" method="post" action="">
      <div class="formint">
        <h2>Recover Password</h2>
        <div id="msg_err_login"></div>
        <div class="input-group">
          <label class="input-group-addon">Your Email<span>*</span></label>
          <input type="email" class="form-control" name="email" id="email" required>
        </div>
        <div class="input-group">
          <label class="input-group-addon">Security Code <span>*</span> </label></label>
          <input name="captcha" id="captcha" type="text" class="captcha form-control" placeholder="" value="<?php echo set_value('captcha');?>" autocomplete="off" /> <span id="cp"><?php echo $cpt_code;?></span>
                <br /><?php echo form_error('captcha'); ?>
        </div>
        <div class="input-group">
          <label class="input-group-addon">&nbsp;</label>
          <a href="<?php echo base_url('register');?>">Already a Member?</a></div>
        <div class="formbtn">
          <input type="submit" class="sbutn" id="loginbtn" value="Recover Password">
        </div>
       
      </div>
      </form>
    </div>
    
  </div>
</div>
<!-- .footer-wrapper start -->
<?php $this->load->view('common/footer');?>
<!-- .footer-wrapper end -->
<?php $this->load->view('common/before_body_close');?>
</body>
</html>
