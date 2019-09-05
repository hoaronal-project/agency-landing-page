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
    <h2>Contact Us</h2>
  </div>
</div>
<div class="container">
<?php if($this->session->flashdata('msg')): ?>
<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> <?php echo $this->session->flashdata('msg');?>
</div>
<?php endif;?> 
  <div class="innerpagebx">
    <div class="row">
    <form name="contactfrm" id="contactfrm" action="" method="post">
      <div class="col-sm-8">
        <div class="formint">
          <div class="contctxt">Contact us! One of our expert will be in touch shortly.</div>
          <div class="input-group">
            <label class="input-group-addon">Your Name <span>*</span></label>
            <input type="text" class="form-control" name="fullname" id="fullname" value="<?php echo set_value('fullname');?>" required>
            <?php echo form_error('fullname'); ?>
          </div>
          <div class="input-group">
            <label class="input-group-addon">Email <span>*</span></label>
            <input type="email" class="form-control" name="email" id="email" value="<?php echo set_value('email');?>" required>
            <?php echo form_error('email'); ?>
          </div>
          <div class="input-group">
            <label class="input-group-addon">Street Address <span>*</span></label>
            <input type="text" class="form-control" name="address" id="address" value="<?php echo set_value('address');?>" required>
            <?php echo form_error('address'); ?>
          </div>
          <div class="input-group">
            <label class="input-group-addon">City <span>*</span></label>
            <input type="text" class="form-control" name="city" id="city" value="<?php echo set_value('city');?>" required>
            <?php echo form_error('city'); ?>
          </div>
          <div class="input-group">
            <label class="input-group-addon">Zipcode <span>*</span></label>
            <input type="text" class="form-control" name="zip" id="zip" value="<?php echo set_value('zip');?>" required>
            <?php echo form_error('zip'); ?>
          </div>
          <div class="input-group">
            <label class="input-group-addon">Phone Number <span>*</span></label>
            <input type="phone" class="form-control" max="12" name="phone" id="phone" value="<?php echo set_value('phone');?>" required>
            <?php echo form_error('phone'); ?>
          </div>
          <div class="input-group">
            <label class="input-group-addon">Website </label>
            <input type="url" class="form-control" name="website" id="website" value="<?php echo set_value('website');?>" required>
            <?php echo form_error('website'); ?>
          </div>
          <div class="input-group">
            <label class="input-group-addon">How can we help you?</label>
            <textarea class="form-control" rows="6" name="comment" id="comment" required><?php echo set_value('comment');?></textarea>
            <?php echo form_error('comment'); ?>
          </div>
          <div class="input-group">
            <div class="row">
              <div class="col-sm-12">
                <label class="input-group-addon">Please type the following characters in the box below: <span id="cp"><?php echo $cpt_code;?></span></label>
              </div>
              <div class="col-sm-4"></div>
              <div class="col-sm-4">
                <input name="captcha" id="captcha" type="text" class="captcha form-control" placeholder="" value="<?php echo set_value('captcha');?>" autocomplete="off" />
                <?php echo form_error('captcha'); ?>
              </div>
            </div>
          </div>
          <div class="formbtn">
            <input type="submit" class="sbutn" value="Submit">
          </div>
        </div>
      </div>
    </form>
      
      <div class="col-sm-4">
        <?php echo get_site_url($common_row->contact_address_contact_page);?>
      </div>
    </div>
  </div>
</div>
<!-- .footer-wrapper start -->
<?php $this->load->view('common/footer');?>
<!-- .footer-wrapper end -->
<?php $this->load->view('common/before_body_close');?>
</body>
</html>
