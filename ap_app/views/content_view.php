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
            <h2><?php echo $row->pageTitle;?></h2>
        </div>    
        </div>
       <div class="container">
            
        	<div class="innerpagebx">
            <p>
            <?php if($row->pageImage):?>
            <img src="<?php echo base_url('public/uploads/'.$row->pageImage);?>" class="img" />
            <?php endif;?>
			<?php echo $row->pageContent;?>
            </p>
            
            <?php if($page_gallery_result): ?>
            <div class="clearfix">&nbsp;</div>
            <ul class="row pageimgs">
			 <?php foreach($page_gallery_result as $pg_row):?>
      			<li class="col-md-6"><img src="<?php echo base_url('public/uploads/page_gallery/'.$pg_row->galleryImageFile);?>" /></li>
      		<?php endforeach; endif;?>
            </ul>
            <div class="clearfix"></div>
</div>
            
            
            
        </div>
        
        <!-- .footer-wrapper start -->
        <?php $this->load->view('common/footer');?>
        <!-- .footer-wrapper end -->
		<?php $this->load->view('common/before_body_close');?>
        
        
    </body>
</html>
