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
            <h2><?php echo $row->news_title;?></h2>
        </div>    
        </div>
       <div class="container">
        	<div class="innerpagebx">
            <p>
            <?php if($row->news_image):?>
            <img src="<?php echo base_url('public/uploads/news/'.$row->news_image);?>" class="img" />
            <?php endif;?>
			<?php echo $row->news_details;?>
            </p>
            
            
            <div class="clearfix"></div>
</div>
            
            
            
        </div>
        
        <!-- .footer-wrapper start -->
        <?php $this->load->view('common/footer');?>
        <!-- .footer-wrapper end -->
		<?php $this->load->view('common/before_body_close');?>
        
        
    </body>
</html>
