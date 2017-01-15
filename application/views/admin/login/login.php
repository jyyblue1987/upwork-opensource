<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <title><?php echo $title; ?></title>
  <link rel="apple-touch-icon" href="<?php echo site_url("assets/adminassets/images/apple-touch-icon.png"); ?>">
  <link rel="shortcut icon" href="<?php echo site_url("assets/adminassets/images/favicon.ico"); ?>">
  <!-- Stylesheets -->
  <link rel="stylesheet" href="<?php echo site_url("assets/global/css/bootstrap.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo site_url("assets/global/css/bootstrap-extend.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo site_url("assets/adminassets/css/site.min.css"); ?>">
  <!-- Plugins -->
  <link rel="stylesheet" href="<?php echo site_url("assets/global/vendor/animsition/animsition.css"); ?>">
  <link rel="stylesheet" href="<?php echo site_url("assets/global/vendor/asscrollable/asScrollable.css"); ?>">
  <link rel="stylesheet" href="<?php echo site_url("assets/global/vendor/switchery/switchery.css"); ?>">
  <link rel="stylesheet" href="<?php echo site_url("assets/global/vendor/intro-js/introjs.css"); ?>">
  <link rel="stylesheet" href="<?php echo site_url("assets/global/vendor/slidepanel/slidePanel.css"); ?>">
  <link rel="stylesheet" href="<?php echo site_url("assets/global/vendor/flag-icon-css/flag-icon.css"); ?>">
  <link rel="stylesheet" href="<?php echo site_url("assets/global/vendor/waves/waves.css"); ?>">
  <link rel="stylesheet" href="<?php echo site_url("assets/adminassets/examples/css/pages/login-v3.css"); ?>">
  <!-- Fonts -->
  <link rel="stylesheet" href="<?php echo site_url("assets/global/fonts/material-design/material-design.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo site_url("assets/global/fonts/brand-icons/brand-icons.min.css"); ?>">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
  <!--[if lt IE 9]>
    <script src="<?php echo site_url("assets/global/vendor/html5shiv/html5shiv.min.js"); ?>"></script>
    <![endif]-->
  <!--[if lt IE 10]>
    <script src="<?php echo site_url("assets/global/vendor/media-match/media.match.min.js"); ?>"></script>
    <script src="<?php echo site_url("assets/global/vendor/respond/respond.min.js"); ?>"></script>
    <![endif]-->
  <!-- Scripts -->
  <script src="<?php echo site_url("assets/global/vendor/modernizr/modernizr.js"); ?>"></script>
  <script src="<?php echo site_url("assets/global/vendor/breakpoints/breakpoints.js"); ?>"></script>
  <script>
  Breakpoints();
  </script>
</head>
<body class="page-login-v3 layout-full">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
  <!-- Page -->
  <div class="page animsition vertical-align text-center" data-animsition-in="fade-in"
  data-animsition-out="fade-out">>
    <div class="page-content vertical-align-middle">
      <div class="panel">
        <div class="panel-body">
          <div class="brand">
            <img class="brand-img" src="<?php echo site_url("assets/adminassets/images/logofull.png"); ?>" alt="...">
          </div>
            
		<?php if(isset($errormsg)){ if($errormsg==""){}else{	?><p style="color:red;"><?php echo $errormsg; ?></p><?php }} ?>
	<?php if(isset($sentemail)){ if($sentemail==""){}else{	?><p style="color:green;"><?php echo $sentemail; ?><?php }} ?>
            
            
          <form method="post" action="<?php echo site_url("administrator/login/check"); ?>" autocomplete="off">
            <div class="form-group form-material floating">
              <input type="text" class="form-control" name="email"  id="<?php if(isset($username)){if($username==""){  echo "focus"; }}else{  echo "focus";} ?>"  value="<?php if(isset($username)){echo urldecode($username); } ?>"/>
              <label class="floating-label">Email/Username</label>
            </div>
            <div class="form-group form-material floating">
              <input type="password" class="form-control" name="password"  id="<?php  if(isset($username)){if($username==""){ }else{ echo "focus"; }} ?>"/>
              <label class="floating-label">Password</label>
            </div>
            <div class="form-group clearfix">
              <div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg pull-left">
                <input type="checkbox" id="inputCheckbox" name="remember_me">
                <label for="inputCheckbox">Remember me</label>
              </div>
              <a class="pull-right" href="<?php echo site_url("administrator/login/forget/"); ?>">Forgot password?</a>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-lg margin-top-40">Sign in</button>
          </form>
        </div>
      </div>
      <footer class="page-copyright page-copyright-inverse">
          <p>Developed by <a href="http://www.winjob.com" target="_Blank" style="color:orange;">WINJOB</a></p>
        <p>© 2016. All RIGHT RESERVED.</p>
        <div class="social">
          <a class="btn btn-icon btn-pure" href="<?php echo $text['twlink']; ?>" target="_Blank">
            <i class="icon bd-twitter" aria-hidden="true"></i>
          </a>
          <a class="btn btn-icon btn-pure" href="<?php echo $text['fblink']; ?>" target="_Blank">
            <i class="icon bd-facebook" aria-hidden="true"></i>
          </a>
          <a class="btn btn-icon btn-pure" href="<?php echo $text['gplink']; ?>" target="_Blank">
            <i class="icon bd-google-plus" aria-hidden="true"></i>
          </a>
        </div>
      </footer>
    </div>
  </div>
  <!-- End Page -->
  <!-- Core  -->
  <script src="<?php echo site_url("assets/global/vendor/jquery/jquery.js"); ?>"></script>
  <script src="<?php echo site_url("assets/global/vendor/bootstrap/bootstrap.js"); ?>"></script>
  <script src="<?php echo site_url("assets/global/vendor/animsition/animsition.js"); ?>"></script>
  <script src="<?php echo site_url("assets/global/vendor/asscroll/jquery-asScroll.js"); ?>"></script>
  <script src="<?php echo site_url("assets/global/vendor/mousewheel/jquery.mousewheel.js"); ?>"></script>
  <script src="<?php echo site_url("assets/global/vendor/asscrollable/jquery.asScrollable.all.js"); ?>"></script>
  <script src="<?php echo site_url("assets/global/vendor/ashoverscroll/jquery-asHoverScroll.js"); ?>"></script>
  <script src="<?php echo site_url("assets/global/vendor/waves/waves.js"); ?>"></script>
  <!-- Plugins -->
  <script src="<?php echo site_url("assets/global/vendor/switchery/switchery.min.js"); ?>"></script>
  <script src="<?php echo site_url("assets/global/vendor/intro-js/intro.js"); ?>"></script>
  <script src="<?php echo site_url("assets/global/vendor/screenfull/screenfull.js"); ?>"></script>
  <script src="<?php echo site_url("assets/global/vendor/slidepanel/jquery-slidePanel.js"); ?>"></script>
  <script src="<?php echo site_url("assets/global/vendor/jquery-placeholder/jquery.placeholder.js"); ?>"></script>
  <!-- Scripts -->
  <script src="<?php echo site_url("assets/global/js/core.js"); ?>"></script>
  <script src="<?php echo site_url("assets/adminassets/js/site.js"); ?>"></script>
  <script src="<?php echo site_url("assets/adminassets/js/sections/menu.js"); ?>"></script>
  <script src="<?php echo site_url("assets/adminassets/js/sections/menubar.js"); ?>"></script>
  <script src="<?php echo site_url("assets/adminassets/js/sections/gridmenu.js"); ?>"></script>
  <script src="<?php echo site_url("assets/adminassets/js/sections/sidebar.js"); ?>"></script>
  <script src="<?php echo site_url("assets/global/js/configs/config-colors.js"); ?>"></script>
  <script src="<?php echo site_url("assets/adminassets/js/configs/config-tour.js"); ?>"></script>
  <script src="<?php echo site_url("assets/global/js/components/asscrollable.js"); ?>"></script>
  <script src="<?php echo site_url("assets/global/js/components/animsition.js"); ?>"></script>
  <script src="<?php echo site_url("assets/global/js/components/slidepanel.js"); ?>"></script>
  <script src="<?php echo site_url("assets/global/js/components/switchery.js"); ?>"></script>
  <script src="<?php echo site_url("assets/global/js/components/tabs.js"); ?>"></script>
  <script src="<?php echo site_url("assets/global/js/components/jquery-placeholder.js"); ?>"></script>
  <script src="<?php echo site_url("assets/global/js/components/material.js"); ?>"></script>
  <script>
      
      
$('document').ready(function(){
	 var input = document.getElementById("focus").focus();
});


  (function(document, window, $) {
    'use strict';
    var Site = window.Site;
    $(document).ready(function() {
      Site.run();
    });
  })(document, window, jQuery);
  </script>
</body>
</html>