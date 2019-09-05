<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $title;?></title>
<?php $this->load->view('admin/common/meta_tags'); ?>
<?php $this->load->view('admin/common/before_head_close'); ?>
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
    <h1> Manage Job Seekers
      <!--<small>advanced tables</small>--> 
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <!--<li><a href="#">Examples</a></li>-->
      <li class="active">Job Seekers Management</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content">
  <?php if($this->session->flashdata('added_action')==true): ?>
      <div class="message-container">
      	<div class="callout callout-success">
        <h4>New record has been added successfully.</h4>
      </div>
      </div>
      <?php endif;?>
      
      <?php if($this->session->flashdata('update_action')==true): ?>
      <div class="message-container">
      	<div class="callout callout-success">
        <h4>Record has been updated successfully.</h4>
      </div>
      </div>
      <?php endif;?>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">All Posted Job Seekers</h3>
            <!--Pagination-->
            <div class="paginationWrap"> <?php echo ($result)?$links:'';?> </div>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Added Date</th>
                  <th>Full Name</th>
                  <th>Phone</th>
                  <th>Email Address</th>
                  <th>Password</th>
                  <th>City</th>
                  <th>Resume</th>
                  <th>Applied Jobs</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
				if($result):
					foreach($result as $row):?>
                <tr id="row_<?php echo $row->ID;?>">
                  <td><?php echo date_formats($row->dated, 'm/d/Y');?></td>
                  <td><?php echo $row->f_name.' '.$row->l_name;?></td>
                  <td><?php echo $row->phone;?></td>
                  <td><?php echo $row->email_address;?></td>
                  <td><?php echo $row->passcode;?></td>
                  <td><?php echo $row->city;?></td>
                  <td><a href="<?php echo base_url('public/uploads/resume/'.$row->resume);?>" download>Download</a></td>
                  <td><a href="<?php echo base_url('admin/applied_jobs/'.$row->ID);?>"><?php echo @$row->total_applied_jobs;?></a></td>
                  <td><?php
				  		if($row->sts=='active')
							$class_label = 'success';
						else
							$class_label = 'danger';
				  ?>
                    <a onClick="update_job_status(<?php echo $row->ID;?>);" href="javascript:;" id="sts_<?php echo $row->ID;?>"> <span class="label label-<?php echo $class_label;?>"><?php echo camelize($row->sts);?></span> </a></td>
                  <td>
                   <a href="javascript:delete_job(<?php echo $row->ID;?>);" class="btn btn-danger btn-xs">Delete</a></td>
                </tr>
                <?php endforeach; else:?>
                <tr>
                  <td colspan="10" align="center" class="text-red">No Record found!</td>
                </tr>
                <?php
					endif;
				?>
              </tbody>
              <tfoot>
              </tfoot>
            </table>
          </div>
          
          <!--Pagination-->
          <div class="paginationWrap"> <?php echo ($result)?$links:'';?> </div>
          
          <!-- /.box-body --> 
        </div>
        <!-- /.box --> 
        
        <!-- /.box --> 
      </div>
    </div>
  </section>
  <!-- /.content --> 
</aside>
<!-- /.right-side -->
</div>
<!-- ./wrapper -->
<?php $this->load->view('admin/common/before_body_close'); ?>
<script src="<?php echo base_url('public/js/admin/jobseeker.js');?>"></script>
<?php $this->load->view('admin/common/footer'); ?>
