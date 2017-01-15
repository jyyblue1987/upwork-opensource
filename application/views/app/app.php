<!DOCTYPE html>
<html lang="en"  ng-app="Dashboard">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>App</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="<?php echo site_url("assets/apple-touch-icon.png"); ?>">
        <link rel="stylesheet" href="<?php echo site_url("assets/css/bootstrap.min.css"); ?>">
        <link rel="stylesheet" href="<?php echo site_url("assets/css/font-awesome.min.css"); ?>">
        <link rel="stylesheet" href="<?php echo site_url("assets/css/normalize.css"); ?>">
        <link rel="stylesheet" href="<?php echo site_url("assets/appassets/css/main.css"); ?>">
        <script src="<?php echo site_url("assets/js/vendor/modernizr-2.8.3.min.js"); ?>"></script>
        <script src="<?php echo site_url("assets/js/angular-1.5.2/angular.js"); ?>"></script>
        <script src="<?php echo site_url("assets/js/angular-1.5.2/angular-route.min.js"); ?>"></script>
        <script src="<?php echo site_url("assets/js/angular-1.5.2/angular-animate.min.js"); ?>"></script>
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo site_url("assets/js/vendor/jquery-1.12.0.min.js"); ?>"><\/script>')</script>
        <script src="<?php echo site_url("assets/js/bootstrap.min.js"); ?>"></script>
        <script src="<?php echo site_url("assets/js/plugins.js"); ?>"></script>
        <script src="<?php echo site_url("assets/appassets/js/main.js"); ?>"></script>
        <script src="<?php echo site_url("assets/appassets/js/route.js"); ?>"></script>
        <script src="<?php echo site_url("assets/appassets/js/controller.js"); ?>"></script>
		<base href="/winjob/app/">
    </head>
    <body>
	
	<div ng-include=" '../apptemp/nav.html' "></div>
		<div class="main" ng-view></div>
    </body>
</html>
