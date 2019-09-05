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
    <h1> Gallery Management
      <!--<small>advanced tables</small>--> 
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <!--<li><a href="#">Examples</a></li>-->
      <li class="active">Manage Gallery</li>
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
            <h3 class="box-title">All Gallery Images</h3>
            <!--Pagination-->
            <div class="paginationWrap"> <?php echo ($result)?$links:'';?> </div>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <div class="text-right" style="padding-bottom:2px;">
            <a type="button" class="btn btn-primary btn-sm" id="addpage" href="javascript:;" onClick="load_popup('add','');">Add New Image</a>
            </div>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Added Date</th>
                  <th>Image</th>
                  <th>Caption</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
				if($result):
					foreach($result as $row):?>
                <tr id="row_<?php echo $row->ID;?>">
                  <td><?php echo date_formats($row->dated, 'd/m/Y');?></td>
                  <td><img src="<?php echo base_url('public/uploads/gallery/thumb/'.$row->image_name);?>" width="200" /></td>
                  <td><?php echo ellipsize($row->image_caption,36,.8);?></td>
                  <td><?php
				  		if($row->sts=='active')
							$class_label = 'success';
						else
							$class_label = 'danger';
				  ?>
                    <a onClick="update_status(<?php echo $row->ID;?>);" href="javascript:;" id="sts_<?php echo $row->ID;?>"> <span class="label label-<?php echo $class_label;?>"><?php echo $row->sts;?></span> </a></td>
                  <td>
                  <a href="javascript:;" onClick="load_popup('update',<?php echo $row->ID;?>);" class="btn btn-success btn-xs">Edit</a>
                   <a href="javascript:delete_record(<?php echo $row->ID;?>);" class="btn btn-danger btn-xs">Delete</a></td>
                </tr>
                <?php endforeach; else:?>
                <tr>
                  <td colspan="6" align="center" class="text-red">No Record found!</td>
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
<form name="frm_gallery" id="frm_gallery" method="post" enctype="multipart/form-data">
  <div class="modal fade" id="popup_box">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Photo Gallery</h4>
        </div>
        <div class="modal-body">
          <div id="msg_box" style="padding-bottom:5px;"></div>
          <div class="box-body">
            <div id="load_form"><i class="fa fa-refresh fa-spin" style="font-size:20px;"></i></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" name="frm_submit" id="frm_submit" class="btn btn-primary">Sumbit <span id="spinner_profile" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span></button>
          </div>
        </div>
      </div>
      <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
  </div>
</form>
<!-- /.right-side -->
</div>
<!-- ./wrapper -->
<?php $this->load->view('admin/common/before_body_close'); ?>
<script src="<?php echo base_url('public/js/admin/gallery.js');?>"></script>
<?php $this->load->view('admin/common/footer'); ?>
