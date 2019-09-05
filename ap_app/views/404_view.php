<!DOCTYPE html>
<html lang="en">
<head>
<title>Page Not Found</title>
<?php $this->load->view('common/meta_tags'); ?>
<?php $this->load->view('common/before_head_close'); ?>
</head>
<body>
<?php $this->load->view('common/after_body_open'); ?>
<div class="siteWraper">
<!--Header-->
<?php $this->load->view('common/header'); ?>
<!--/Header--> 
<!--Detail Info-->
<div class="container detailinfo">
  <div class="row">
    <div class="col-md-12"><!--Job Detail-->
      
      <div class="row">
        <div class="col-md-12 text-center" style="font-size:32px; line-height:300px;"><strong> Page Not Found</strong> </div>
      </div>
    </div>
    <!--/Job Detail--> 
    
  </div>
</div>
<!--Footer-->
<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/before_body_close'); ?>
</body>
</html>