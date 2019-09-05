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
            <h2>News</h2>
        </div>    
        </div>
       <div class="container">
        	<div class="innerpagebx">
            
            <ul class="newslisting row">
            	<?php if($result):
 	foreach($result as $row): ?>
                <li class="col-sm-4">
                	<div class="newswrap">
                	<div class="newstitle"><a href="<?php echo base_url('news/'.url_title($row->news_title.'-'.$row->ID, '-', TRUE));?>"><?php echo $row->news_title;?></a></div>
                    <div class="date"><?php echo date_formats($row->dated,'F d, Y');?></div>
                    <p><?php echo ellipsize(strip_tags($row->news_details),70,1);?></p>
                    </div>
                </li>
                <?php endforeach; endif;?>
            </ul>
		</div>
            
        </div>
        
        <!-- .footer-wrapper start -->
        <?php $this->load->view('common/footer');?>
        <!-- .footer-wrapper end -->
		<?php $this->load->view('common/before_body_close');?>
        
        
    </body>
</html>
