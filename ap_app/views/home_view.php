<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/before_head_close');?>
</head>
    <body class="home"> 
        <!-- #header-wrapper start -->
        <?php $this->load->view('common/header');?>
		<!-- #header-wrapper end -->
        <?php echo get_site_url($common_row->slider);?>
        <!-- .tp-wrapper end -->
        <!-- .page-content start -->
        <?php echo get_site_url($common_row->services);?>
        <!-- .page-content end -->
		<?php echo get_site_url($common_row->about_tech);?>
        <!-- .page-content.parallax end -->
		<?php echo get_site_url($common_row->how_we_work);?>
        <!-- .page-content.parallax end -->
		<?php echo get_site_url($common_row->become_client);?>
        <!-- .page-content.parallax end -->
        <!-- .footer-wrapper start -->
        <?php $this->load->view('common/footer');?>
        <!-- .footer-wrapper end -->
		<?php $this->load->view('common/before_body_close');?>
        
        <script>
            /* <![CDATA[ */
            jQuery(document).ready(function($) {
                'use strict';
                //REVOLUTION SLIDE
                var revapi;
                revapi = jQuery('.tp-banner').revolution(
                        {
                            delay: 5000,
                            startwidth: 1140,
                            startheight: 600,
                            hideThumbs: 10,
                            fullWidth: "on",
                            forceFullWidth: "on",
                            navigationType: "none" // bullet, thumb, none
                        });
                //JQUERY SHARRE PLUGIN END
                $('.sharre-facebook').sharrre({
                    share: {
                        facebook: true
                    },
                    enableHover: false,
                    enableTracking: true,
                    click: function(api, options) {
                        api.simulateClick();
                        api.openPopup('facebook');
                    }
                });
                $("#owl-testimonial").owlCarousel({
                    autoPlay: true,
                    items: 1,
                    stopOnHover: true,
                    navigation: false,
                    paginationSpeed: 1000,
                    goToFirstSpeed: 2000,
                    singleItem: true,
                    autoHeight: true,
                    transitionStyle: "fade"
                });
            });
            /* ]]> */
        </script>
    </body>
</html>