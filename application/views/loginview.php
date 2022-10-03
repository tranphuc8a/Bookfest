<!DOCTYPE html>
<html lang="en"  >
<head>
	<title> Document  </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 	
	<script> var baseURL = "<?php echo base_url(); ?>"; </script>
	
	<link rel="stylesheet" href="<?php echo base_url();?>/angular/vendor/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url();?>/angular/vendor/angular-material.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>/angular/vendor/font-awesome.css">
	<link rel="stylesheet" href="<?php echo base_url();?>/angular/css/1.css">
</head>
<body ng-app="login" ng-controller="loginPageController" class="background-body">
	<!-- <div ng-include="'<?php echo base_url();?>/angular/supportview/header.php'"></div> -->
	
	<div class="container">
		<div class="row vh-100 center">
			<div class="d-flex flex-column align-items-center pb-0" style="width: max(600px, calc(100% - 600px));">
				<div class="w-75 display-3">Bookfest</div>
				<div class="w-75 h1">Mua sách thả ga và an toàn cùng Bookfest</div>
			</div>
			<div class="" style="width: 600px;">
				<div class="card rounded shadow border-0 bg-light">
					<div class="card-header border-0 bg-light">
						<div class="nav nav-tabs">
							<a href="#login" ng-click="change(0)" class="nav-link {{active[0]}}">Đăng nhập</a>
							<a href="#register" ng-click="change(1)" class="nav-link {{active[1]}}">Đăng ký</a>
							<a href="#forgotpass" ng-click="change(2)" class="nav-link {{active[2]}}">Quên mật khẩu</a>
						</div>
					</div>
					<div class="card-body border-0">
						<div ng-view></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- <div ng-include="'<?php echo base_url();?>/angular/supportview/footer.php'"></div> -->
	
	
	<script type="text/javascript" src="<?php echo base_url();?>/angular/vendor/jquery.js"></script>  
	<script type="text/javascript" src="<?php echo base_url();?>/angular/vendor/bootstrap.js"></script>  
	<script type="text/javascript" src="<?php echo base_url();?>/angular/vendor/angular-1.5.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/angular/vendor/angular-route.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/angular/vendor/angular-animate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/angular/vendor/angular-aria.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/angular/vendor/angular-messages.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/angular/vendor/angular-material.min.js"></script>  
	<script type="text/javascript" src="<?php echo base_url();?>/angular/javascript/login.js"></script>
	

</body>
</html>