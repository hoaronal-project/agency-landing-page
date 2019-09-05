<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('common/before_head_close');?>
<link rel="stylesheet" href="<?php echo base_url('public/css/magnific-popup.css');?>" />
<link rel="stylesheet" href="<?php echo base_url('public/css/jquery.fancybox.css');?>" />
</head>
<body class="home">
<!-- #header-wrapper start -->
<?php $this->load->view('common/header');?>
<!-- #header-wrapper end --> 
<!-- .page-content start -->
<div class="page-title-container">
  <div class="container">
    <h2>Photo Gallery</h2>
  </div>
</div>
<div class="container">
  <div class="innerpagebx">
    <div class="portfolio-container popup-gallery">
      <div class="row">
        <div class="portfolio">
          <?php if($result):
 		foreach($result as $row): ?>
          <div class="col-sm-4 col-md-3 el">
            <div class="portfolio-inner-item view"> <img src="<?php echo base_url('public/uploads/gallery/thumb/'.$row->image_name);?>" alt="<?php echo $row->image_caption;?>">
              <div class="mask"> <a href="<?php echo base_url('public/uploads/gallery/'.$row->image_name);?>" title="<?php echo $row->image_caption;?>" class="info middle fancybox-effects-a"><i class="icon-search"></i></a> </div>
<p><?php echo $row->image_caption;?></p>
            </div>
          </div>
          <?php endforeach; endif;?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- .footer-wrapper start -->
<?php $this->load->view('common/footer');?>
<!-- .footer-wrapper end -->
<?php $this->load->view('common/before_body_close');?>
<script src="<?php echo base_url('public/js/jquery.fancybox.js');?>"></script> 
<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */
			$('.fancybox').fancybox();
			/*
			 *  Different effects
			 */
			// Change title type, overlay closing speed
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});
			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */
			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',
				prevEffect : 'none',
				nextEffect : 'none',
				closeBtn  : false,
				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},
				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});
			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */
			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',
				closeBtn  : false,
				arrows    : false,
				nextClick : true,
				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});
			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',
					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});
		});
	</script>
</body>
</html>
