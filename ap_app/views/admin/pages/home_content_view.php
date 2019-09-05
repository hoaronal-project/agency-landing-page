<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $title;?></title>
<?php $this->load->view('admin/common/meta_tags'); ?>
<?php $this->load->view('admin/common/before_head_close'); ?>
<style type="text/css">
.mytextarea {
	width:80% !important; 
	height:250px !important;
}
</style>
</head>
<body class="skin-blue">
<?php $this->load->view('admin/common/after_body_open'); ?>
<?php $this->load->view('admin/common/header'); ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php $this->load->view('admin/common/left_side'); ?>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Manage Homepage Content</h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <?php if($this->session->flashdata('updated_action')==true): ?>
      <div class="message-container">
      	<div class="callout callout-success">
        <h4>Updated successfully.</h4>
      </div>
      </div>
      <?php endif;?>
      
    <div class="box-body">
      <div class="tab-content">
      <form name="frm" id="frm" method="post" action="">
        <div>
          <div class="form-group">
            <label  for="exampleInputPassword1">Slider</label><br />
            <textarea name="slider" id="slider" class="mytextarea"><?php echo $row->slider;?></textarea>
            <?php echo form_error('slider'); ?> 
            </div>
          <div class="form-group">
            <label  for="exampleInputPassword1">Services</label><br />
            <textarea name="services" id="services" class="mytextarea"><?php echo $row->services;?></textarea>
            <?php echo form_error('services'); ?> 
            </div>
          <div class="form-group">
            <label  for="exampleInputPassword1">About Tech</label><br />
            <textarea name="about_tech" id="about_tech" class="mytextarea"><?php echo $row->about_tech;?></textarea>
            <?php echo form_error('about_tech'); ?> 
            </div>
          <div class="form-group">
            <label  for="exampleInputPassword1">How We Work</label><br />
            <textarea name="how_we_work" id="how_we_work" class="mytextarea"><?php echo $row->how_we_work;?></textarea>
            <?php echo form_error('how_we_work'); ?> 
            </div>
          <div class="form-group">
            <label  for="exampleInputPassword1">Become Client</label><br />
            <textarea name="become_client" id="become_client" class="mytextarea"><?php echo $row->become_client;?></textarea>
            <?php echo form_error('become_client'); ?> 
            </div>
          <div class="form-group">
            <label  for="exampleInputPassword1">Meet Tech (Footer)</label><br />
            <textarea name="meet_tech_footer" id="meet_tech_footer" class="mytextarea"><?php echo $row->meet_tech_footer;?></textarea>
            <?php echo form_error('meet_tech_footer'); ?> 
            </div>
           
           
           
           
           
           
           <div class="form-group">
            <label  for="exampleInputPassword1">Contact Info (Footer)</label><br />
            <textarea name="contact_info_footer" id="contact_info_footer" class="mytextarea"><?php echo $row->contact_info_footer;?></textarea>
            <?php echo form_error('contact_info_footer'); ?> 
            </div>
            
            <div class="form-group">
            <label  for="exampleInputPassword1">Contact Info (Contact Us Page)</label><br />
            <textarea name="contact_address_contact_page" id="contact_address_contact_page" class="mytextarea"><?php echo $row->contact_address_contact_page;?></textarea>
            <?php echo form_error('contact_address_contact_page'); ?> 
            </div>
            
            <div class="form-group">
            <label  for="exampleInputPassword1">Tech Text (Staffing Page)</label><br />
            <textarea name="tech_text" id="tech_text" class="mytextarea"><?php echo $row->tech_text;?></textarea>
            <?php echo form_error('tech_text'); ?> 
            </div>
            <div class="form-group">
            <input type="submit" name="sub" class="btn btn-primary" id="sub" value="Update" />
            </div>
        </div>
      </form>
      </div>
    </div>
  </section>
  <!-- /.content --> 
</aside>
<!-- /.right-side -->
<?php $this->load->view('admin/common/before_body_close'); ?>
<?php $this->load->view('admin/common/footer'); ?>
