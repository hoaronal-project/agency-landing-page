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
    <h1> Change Password</h1>
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
            <label  for="exampleInputPassword1">New Password</label><br />
            <input type="password" name="pass" id="pass" class="form-control" required value="" autocomplete="off" />
            <?php echo form_error('pass'); ?> 
            </div>
            <div class="form-group">
            <input type="submit" name="sub" class="btn btn-primary" id="sub" value="Update Password" />
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
