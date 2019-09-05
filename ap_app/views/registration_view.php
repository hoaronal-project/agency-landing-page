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
    <h2>Login or Register</h2>
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
  		<?php echo $this->session->flashdata('msg');?>
		</div>
		<?php endif;?> 
            
  <p><?php echo get_site_url($common_row->tech_text);?></p>
  <div class="row">
    <div class="col-md-5">
    
      <form name="loginfrm" id="loginfrm" method="post" action="">
      <div class="formint">
        <h2>Already A Member Login Here</h2>
        <div id="msg_err_login"></div>
        <div class="input-group">
          <label class="input-group-addon">Your Email<span>*</span></label>
          <input type="email" class="form-control" name="email" id="email" required>
        </div>
        <div class="input-group">
          <label class="input-group-addon">Password <span>*</span></label>
          <input type="password" class="form-control" name="pass" id="pass" required>
        </div>
        <div class="input-group">
          <label class="input-group-addon">&nbsp;</label>
          <a href="<?php echo base_url('forgot');?>">Forgot Password?</a></div>
        <div class="formbtn">
        <input type="hidden" class="form-control" id="js" name="js" value="<?php echo $this->uri->segment(3);?>">
          <input type="submit" class="sbutn" id="loginbtn" value="Login">
        </div>
       
      </div>
      </form>
    </div>
    <div class="col-md-7">
      <div class="boxwraper">
        <div class="titlebar"> <b>New User Register</b> </div>
        
  <div id="msg_err_reg"></div>
        <form name="regfrm" id="regfrm" method="post" action="" enctype="multipart/form-data">
        <div class="formint padding20">
          <div class="input-group">
            <label class="input-group-addon">First Name <span>*</span></label>
            <input type="text" class="form-control" name="f_name" id="f_name" required>
          </div>
          <div class="input-group">
            <label class="input-group-addon">Last Name <span>*</span></label>
            <input type="text" class="form-control" name="l_name" id="l_name" required>
          </div>
          <div class="input-group">
            <label class="input-group-addon">Telephone Number <span>*</span></label>
            <input type="text" class="form-control" name="phone" id="phone" required>
          </div>
          <div class="input-group">
            <label class="input-group-addon">City <span>*</span></label>
            <input type="text" class="form-control" name="city" id="city" required>
          </div>
          <div class="input-group">
            <label class="input-group-addon">Resume <span>*</span></label>
            <input type="file" class="form-control" name="resume" id="resume" required>
          </div>
          <div class="input-group">
            <label class="input-group-addon">Message To Receiver</label>
            <textarea class="form-control" rows="6" id="cover_letter" name="cover_letter"></textarea>
          </div>
          <div class="input-group">
            <label class="input-group-addon">Email Address: <span>*</span></label>
            <input type="email" class="form-control" id="email_address" name="email_address" required>
          </div>
          <div class="input-group">
            <label class="input-group-addon">Password <span>*</span></label>
            <input type="password" class="form-control" id="passcode" min="5" name="passcode" required>
            <input type="hidden" class="form-control" id="jslug" name="jslug" value="<?php echo $this->uri->segment(3);?>">
          </div>
          <div class="input-group">
            <div class="row">
              <div class="col-sm-12">
                <label class="input-group-addon">Please type the following characters in the box below: <span id="cp"><?php echo $cpt_code;?></span></label>
              </div>
              <div class="col-sm-4"></div>
              <div class="col-sm-4">
                <input type="text" class="form-control" value="" id="captcha" name="captcha" required>
              </div>
            </div>
          </div>
          <div class="formbtn">
            <input type="submit" class="sbutn" value="Submit" name="sub_reg" id="sub_reg">
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
