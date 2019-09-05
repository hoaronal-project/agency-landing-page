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
            <h2>Dashboard</h2>
        </div>    
        </div>
       
       <div class="container">
       <?php if($this->session->flashdata('err_applied')): ?>
		<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  		<strong>Error!</strong> <?php echo $this->session->flashdata('err_applied');?>
		</div>
		<?php endif;?> 
<p><?php echo get_site_url($common_row->tech_text);?></p>
        	<div class="row">
            	<div class="col-md-3">
                	<?php $this->load->view('jobseeker/common/left_side');?>                
                </div>
            	<div class="col-md-9">
<div class="boxwraper">
<div class="titlebar">
<b>Jobs In Tech Friends</b>
</div>
<ul class="searchlist"> 
  <!--Job Row-->
 <?php if($result):
 	foreach($result as $row):
		if($this->session->userdata('user_id')){
			$is_already_applied = $this->applied_jobs_model->is_already_applied($this->session->userdata('user_id'), $row->ID);
		}
 ?>
  <li>
    <div class="intlist">
      <div class="row">
        <div class="col-md-8"> <a href="<?php echo base_url('job/'.url_title($row->job_title.'-'.$row->ID, '-', TRUE));?>" class="jobtitle"><?php echo $row->job_title;?></a>
          <div class="location"><span><?php echo $row->type_name;?></span> &nbsp;-&nbsp;  <strong><?php echo $row->city;?></strong> &nbsp;-&nbsp; <?php echo $row->state;?></div>
        </div>
        <div class="col-md-4"> 
        <?php if($is_already_applied):?>
        <a href="javascript:;" class="applybtn btn disabled">Already Applied</a>
        <?php else:?>
		<a href="<?php echo base_url('job/'.url_title($row->job_title.'-'.$row->ID, '-', TRUE));?>" class="applybtn">Apply Now</a>
		<?php endif;?>
          <div class="date"><?php echo date_formats($row->dated,'M d, Y');?></div>
        </div>       
      </div>
      <p><?php echo ellipsize(strip_tags($row->description),215,1);?></p>
      <div class="clear"></div>
    </div>
  </li>
  
  <?php endforeach; endif;?>
</ul>
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
