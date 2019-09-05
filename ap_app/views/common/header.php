<div id="header-wrapper">
  <div id="top-bar">
    <div class="container">
      <ul class="contact-info">
        <li> <i class="icon-phone"></i> <span>408-326-0602</span> </li>
        <li> <i class="icon-envelope-alt"></i> <a href="<?php echo base_url('contact');?>">Contact us Today</a> </li>
      </ul>
      
      <!-- .contact-info end -->
      
      <ul class="social-links">
        <li><a href="https://twitter.com" target="_blank" class="pixons-twitter-1"></a></li>
        <li><a href="https://facebook.com" target="_blank" class="pixons-facebook-2"></a></li>
        <?php if($this->session->userdata('user_id')):?>
        <li><a href="<?php echo base_url('jobseeker/dashboard');?>">Dashboard</a></li>
        <li><a href="<?php echo base_url('logout');?>">Logout</a></li>
        <?php endif?>
      </ul>
      
      <!-- .social-links end --> 
      
    </div>
    
    <!-- .container end --> 
    
  </div>
  
  <!-- #top-bar end --> 
  
  <!-- #header start -->
  
  <header id="header"> 
    
    <!-- .container start -->
    
    <div class="container"> 
      
      <!-- #logo start -->
      
      <div id="logo"> <a href="<?php echo base_url();?>"> <img src="<?php echo base_url('public/images/logo.jpg');?>" alt=""/> </a> </div>
      
      <!-- #logo end -->
      
      <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-collapse">
          <ul class="nav navbar-nav">
            <li <?php echo active_link('');?>><a class="navbar-toggle" href="<?php echo base_url();?>">Home</a></li>
            <li <?php echo active_link('staffing');?>><a class="navbar-toggle" href="<?php echo base_url('staffing');?>">Staffing</a></li>
            <?php if($menuTop):
					foreach($menuTop as $menuTopRow):
			?>
            <li <?php echo active_link($menuTopRow->pageSlug);?>><a class="navbar-toggle" href="<?php echo base_url($menuTopRow->pageSlug);?>"><?php echo $menuTopRow->pageTitle;?></a></li>
            <?php endforeach; endif;?>
            <li><a href="<?php echo base_url('gallery');?>">PHOTO GALLERY</a></li>
            <li><a href="<?php echo base_url('news');?>">News</a></li>
            <li <?php echo active_link('contact');?>><a href="<?php echo base_url('contact');?>" class="navbar-toggle">Contact</a></li>
          </ul>
        </div>
      </nav>
    </div>
    
    <!-- .container end --> 
    
  </header>
  
  <!-- #header end --> 
  
</div>
