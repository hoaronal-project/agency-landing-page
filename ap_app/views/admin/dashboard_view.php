<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $title;?></title>
<?php $this->load->view('admin/common/meta_tags'); ?>
<?php $this->load->view('admin/common/before_head_close'); ?>
<style type="text/css">
.awesome_style{
	font-size:100px;
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
      <h1> Dashboard</h1></section>
    
    <!-- Main content -->
    <section class="content">
     <table width="100%" border="0" align="left">
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="19%" align="center"><a href="<?php echo base_url('admin/jobseeker');?>"><i class="fa awesome_style fa-users"></i><br>
                  Manage Jobseekers</a></td>
                <td width="19%" align="center"><a href="<?php echo base_url('admin/jobs');?>"><i class="fa awesome_style fa-clipboard"></i><br>
                  Manage Posted Jobs</a></td>
                <td width="19%" align="center"><a href="<?php echo base_url('admin/pages');?>"><i class="fa awesome_style fa-file-text"></i><br>
                  Content Management</a></td>
                <td width="19%" align="center"><a href="<?php echo base_url('admin/news');?>"><i class="fa awesome_style fa-globe"></i><br>
                  Manage News</a></td>
                <td width="19%" align="center"></td>
              </tr>
              <tr>
                <td align="center"><a href="<?php echo base_url('admin/gallery');?>"><i class="fa awesome_style fa-image"></i><br>
                  Manage Gallery</a></td>
                <td align="center"><a href="<?php echo base_url('admin/home_content');?>"><i class="fa awesome_style fa-tachometer"></i><br>
                  Manage Homepage Content</a></td>
                  <td align="center"><a href="<?php echo base_url('admin/changepass');?>"><i class="fa awesome_style fa-key"></i><br>
                  Change Password</a></td>
                <td align="center"><a href="<?php echo base_url('admin/home/logout');?>"><i class="fa awesome_style fa-lock"></i><br>
                  Logout</a></td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
              </tr>
            </table>
    </section>
    <!-- /.content --> 
  </aside>
  <!-- /.right-side --> 
<?php $this->load->view('admin/common/before_body_close'); ?>
<?php $this->load->view('admin/common/footer'); ?>