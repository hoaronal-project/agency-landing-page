<section id="footer-wrapper">
  <footer id="footer">
    <!-- container start -->
    
    <div class="container"> 
      <!-- .row start -->
      <div class="row"> 
        <!-- .footer-widget-container start -->
        <ul class="col-md-3 footer-widget-container">
          <li class="widget widget_text">
            <h5>Abour Our Company</h5>
            <p> <?php echo get_site_url($common_row->meet_tech_footer);?> </p>
          </li>
          <!-- .widget.widget_text end -->
        </ul>
        <!-- .col-md-3.footer-widget-container -->
        
        <ul class="col-md-3 footer-widget-container">
          <li class="widget">
            <h5>Quick Links</h5>
            <ul>
              <li><a href="<?php echo base_url();?>">HOME</a></li>
              <?php if($menuTop):
					foreach($menuTop as $menuTopRow):
			?>
              <li><a href="<?php echo base_url($menuTopRow->pageSlug);?>"><?php echo strtoupper($menuTopRow->pageTitle);?></a></li>
              <?php endforeach; endif;?>
              <li><a href="<?php echo base_url('staffing');?>">STAFFING</a></li>
              <li><a href="<?php echo base_url('gallery');?>">PHOTO GALLERY</a></li>
              <li><a href="<?php echo base_url('news');?>">News</a></li>
              <li><a href="<?php echo base_url('contact');?>">CONTACT</a></li>
            </ul>
          </li>
        </ul>
        <!-- .col-md-3.footer-widget-container -->
        
        <ul class="col-md-3 footer-widget-container">
          <li class="widget">
            <h5>latest News</h5>
            <ul class="news">
              <?php if($news_result):
				foreach($news_result as $row_news):
			?>
              <li>
                <div class="newstitle"> <a href="<?php echo base_url('news/'.url_title($row_news->news_title.'-'.$row_news->ID, '-', TRUE));?>"><?php echo $row_news->news_title;?></a></div>
                <div class="date"><?php echo date_formats($row_news->dated,'F d, Y');?></div>
                <p><?php echo ellipsize(strip_tags($row_news->news_details),70,1);?></p>
              </li>
              <?php endforeach; endif;?>
            </ul>
            <div class="newstitle text-right"> <a href="<?php echo base_url('news');?>"><strong>View All News</strong></a> </div>
          </li>
          <!-- .widget#tweetscroll-wrapper end -->
        </ul>
        <!-- .col-md-3.footer-widget-container end -->
        
        <ul class="col-md-3 footer-widget-container">
          <li class="widget widget_text widget_contact">
            <h5>contact info</h5>
            <?php echo get_site_url($common_row->contact_info_footer);?> </li>
          <!-- .widget.widget_text end -->
        </ul>
        <!-- .col-md-3.footer-widget-container end --> 
      </div>
      <!-- .row end --> 
    </div>
    <!-- .container end -->
    </footer>
    <!-- #footer end --> 
    
    <!-- .copyright-container start -->
    <section id="copyright-container">
      <div class="container">
        <div class="row">
          <div class="col-md-6"> <img class="float-left" src="<?php echo base_url('public/images/logo.jpg');?>" alt="Tech Friends"/>
            <p>Copyright &copy; <?php echo date('Y');?></p>
          </div>
          <!-- .col-md-6 end -->
          
          <div class="col-md-6">
            <ul class="breadcrumb footer-breadcrumb">
              <!-- <li><a href="#">Home</a></li>
                                <li><a href="#">About</a></li>
                                <li><a href="#">Portfolio</a></li>
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">Contact</a></li>-->
            </ul>
          </div>
          <!-- .col-md-6 end --> 
        </div>
        <!-- .row end --> 
      </div>
      <!-- .container end --> 
    </section>
    <!-- #copyright-container end --> 
    
    <a href="#" class="scroll-up">Scroll</a> 
</section>