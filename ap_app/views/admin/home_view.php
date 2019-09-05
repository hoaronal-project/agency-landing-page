<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $title;?></title>
<?php $this->load->view('admin/common/meta_tags'); ?>
<?php $this->load->view('admin/common/before_head_close'); ?>
</head>
<body>
<div class="loginwrap">
  <div class="loginfrm">
   <div align="center"><img src="<?php echo base_url('public/images/logo.jpg');?>"  class="mainlogologin"></div>
    <div class="err"><?php echo $msg;?></div>
    <form method="post" action="">
      <div class="formwrp">
        <label>Username</label>
        <input name="username" class="frmfield" id="username" type="text">
        <?php echo form_error('username', '<div class="err"><span>', '</span></div>'); ?>
        <label>Password</label>
        <input name="password" class="frmfield" id="password" type="password">
        <?php echo form_error('password', '<div class="err"><span>', '</span></div>'); ?>
        <div class="logbtnwr">
          <input value="Login" class="loginbtn" type="submit">
        </div>
        <div class="clear"></div>
      </div>
    </form>
  </div>
  
  <div class="clear"></div>
</div>
<div class="siteby">Develop By: <a href="http://www.codeareena.com" target="_blank">Codeareena</a></div>
</body>
</html>