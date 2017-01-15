
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="Materia - Admin Template with Angularjs">
	<meta name="keywords" content="materia, webapp, admin, dashboard, template, ui, material admin, material design, themeforest, materialup, material, material template">
	<meta name="author" content="solutionportal">
	<!-- <base href="/"> -->

	<title>Materia - Material Design Admin Template</title>

	<!-- Icons -->
	<link rel="stylesheet" href="<?php echo site_url("assets/materia/fonts/ionicons/css/ionicons.min.css"); ?>">
	<link rel="stylesheet" href="<?php echo site_url("assets/materia/fonts/font-awesome/css/font-awesome.min.css"); ?>">

	
	<!-- Css/Less Stylesheets -->
	<!-- build:css styles/angular-material.min.css -->
	<link rel="stylesheet" href="<?php echo site_url("assets/materia/styles/vendors/angular-material.min.css"); ?>">
	<!-- /build -->
	<!-- build:css styles/bootstrap.min.css -->
	<link rel="stylesheet" href="<?php echo site_url("assets/materia/styles/vendors/bootstrap.min.css"); ?>">
	<!-- /build -->
	<!-- build:css styles/main.min.css -->
	<link rel="stylesheet/less" href="<?php echo site_url("assets/materia/styles/main.less"); ?>">
	<!-- /build -->
	
	<!-- <link rel="stylesheet" href="<?php echo site_url("assets/materia/styles/vendors/bootstrap.min.css"); ?>"> -->
	<!-- <link rel="stylesheet" href="<?php echo site_url("assets/materia/_tmp/main.min.css"); ?>"> -->
	 
 	<link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300' rel='stylesheet' type='text/css'>

	<!-- Match Media polyfill for IE9 -->
	<!--[if IE 9]> <script src="<?php echo site_url("assets/materia/scripts/ie/matchMedia.js"); ?>"></script>  <![endif]--> 
<base href="/winjob/assets/materia/">

	</head>
<body ng-app="app" 
	id="app" custom-page
	class="app off-canvas {{themeActive}}" ng-class="{'nav-expand': navFull, 'body-full': bodyFull}"
	ng-controller="AppCtrl">


	<header class="site-head" ng-controller="HeadCtrl"
		id="site-head" ng-class="{'fixedHeader': fixedHeader}"
		ng-include=" 'views/header.html' ">
		<!-- linked header (static) view -->
	</header>


	<!-- main-container -->
	<div class="main-container clearfix" ng-class="{'nav-expand': navFull, 'nav-horizontal': navHorizontal}">
		<aside class="nav-wrap" ng-class="{'nav-expand': navFull, 'nav-offcanvas': navOffCanvas}"
			id="site-nav" custom-scrollbar
			ng-include=" 'views/nav.html' ">
		
		</aside>

		<!-- content-here -->
		<div ng-class="{'nav-expand': navFull, 'fixedHeader': fixedHeader}"
			class="content-container" 
			id="content"
			ng-view>
		</div>

	</div> <!-- #end main-container -->

	
	<!-- settings -->
	<div class="site-settings clearfix hidden-xs" ng-class="{'open': isSettingsOpen}">
		<div class="settings clearfix">
			<div class="trigger ion ion-settings left" ng-click="toggleSettingsBox()"></div>
			<div class="wrapper left">
				<ul class="list-unstyled other-settings">
					<li class="clearfix mb10">
						<div class="left small">Nav Horizontal</div>
						<md-switch class="right" ng-model="navHorizontal" style="margin: 0" ng-change="onNavHorizontal()">
						</md-switch>
					</li>
					<li class="clearfix mb10">
						<div class="left small">Fixed Header</div>
						<md-switch class="right" ng-model="fixedHeader" style="margin: 0" ng-change="onFixedHeader()">
						</md-switch>
					</li>
					<li class="clearfix mb10">
						<div class="left small">Nav Full</div>
						<md-switch class="right" ng-model="navFull" style="margin: 0" ng-change="onNavFull()">
						</md-switch>
					</li>
				</ul>
				<hr/>
				<ul class="themes list-unstyled">
					<li ng-class="{active: theme-zero}" ng-model="themeModel" btn-radio="'theme-zero'" ng-change="onThemeChange(themeModel)"></li>
					<li ng-class="{active: theme-one}" ng-model="themeModel" btn-radio="'theme-one'" ng-change="onThemeChange(themeModel)"></li>
					<li ng-class="{active: theme-two}" ng-model="themeModel" btn-radio="'theme-two'" ng-change="onThemeChange(themeModel)"></li>
					<li ng-class="{active: theme-three}" ng-model="themeModel" btn-radio="'theme-three'" ng-change="onThemeChange(themeModel)"></li>
					<li ng-class="{active: theme-four}" ng-model="themeModel" btn-radio="'theme-four'" ng-change="onThemeChange(themeModel)"></li>
					<li ng-class="{active: theme-five}" ng-model="themeModel" btn-radio="'theme-five'" ng-change="onThemeChange(themeModel)"></li>
					<li ng-class="{active: theme-six}" ng-model="themeModel" btn-radio="'theme-six'" ng-change="onThemeChange(themeModel)"></li>
					<li ng-class="{active: theme-seven}" ng-model="themeModel" btn-radio="'theme-seven'" ng-change="onThemeChange(themeModel)"></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- #settings -->


	
	
	<!-- Dev only -->
	<!-- build:remove -->
	<script src="<?php echo site_url("assets/materia/scripts/dev/less.min.js"); ?>"></script>	
	<!-- /build -->

	<!-- build:js scripts/vendors.js -->
	<!-- Vendors -->
	<script src="<?php echo site_url("assets/materia/scripts/vendors/jquery.min.js"); ?>"></script> <!-- load before angular -->
	<script src="<?php echo site_url("assets/materia/scripts/vendors/angular.min.js"); ?>"></script>
	<!-- /build -->

	<!-- build:js scripts/plugins.js -->
	<!-- Plugins -->
	<script src="<?php echo site_url("assets/materia/scripts/plugins/angular-route.min.js"); ?>"></script>
	<script src="<?php echo site_url("assets/materia/scripts/plugins/angular-animate.min.js"); ?>"></script>
	<script src="<?php echo site_url("assets/materia/scripts/plugins/angular-aria.min.js"); ?>"></script>
	<script src="<?php echo site_url("assets/materia/scripts/plugins/angular-sanitize.min.js"); ?>"></script>
	<script src="<?php echo site_url("assets/materia/scripts/plugins/ui-bootstrap-tpls.min.js"); ?>"></script>
	<script src="<?php echo site_url("assets/materia/scripts/plugins/angular-material.min.js"); ?>"></script>
	<script src="<?php echo site_url("assets/materia/scripts/plugins/ocLazyLoad.min.js"); ?>"></script>
	<script src="<?php echo site_url("assets/materia/scripts/plugins/loading-bar.min.js"); ?>"></script>
	<script src="<?php echo site_url("assets/materia/scripts/plugins/angular-fullscreen.js"); ?>"></script>
	<script src="<?php echo site_url("assets/materia/scripts/plugins/perfect-scrollbar.min.js"); ?>"></script>
	<!-- /build -->

	
	<!-- build:js scripts/app.js -->
	<!-- Custom scripts -->
	<script src="<?php echo site_url("assets/materia/scripts/app.js"); ?>"></script>
	<script src="<?php echo site_url("assets/materia/scripts/shared/app.ctrls.js"); ?>"></script>
	<script src="<?php echo site_url("assets/materia/scripts/shared/app.directives.js"); ?>"></script>
	<script src="<?php echo site_url("assets/materia/scripts/shared/app.services.js"); ?>"></script>
	<script src="<?php echo site_url("assets/materia/scripts/ui/app.ui.ctrls.js"); ?>"></script>
	<script src="<?php echo site_url("assets/materia/scripts/ui/app.ui.directives.js"); ?>"></script>
	<script src="<?php echo site_url("assets/materia/scripts/forms/app.form.ctrls.js"); ?>"></script>
	<script src="<?php echo site_url("assets/materia/scripts/tables/app.table.ctrls.js"); ?>"></script>
	<script src="<?php echo site_url("assets/materia/scripts/email/app.email.ctrls.js"); ?>"></script>
	<script src="<?php echo site_url("assets/materia/scripts/todo/app.todo.js"); ?>"></script>
	<!-- /build -->
	

	

</body>
</html>