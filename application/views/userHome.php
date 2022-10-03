<!DOCTYPE html>
<html lang="en"  >
<head>
	<title> Document  </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 	

	<script> var baseURL = "<?php echo base_url(); ?>" </script>
	<link rel="stylesheet" href="<?php echo base_url();?>/angular/vendor/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url();?>/angular/vendor/angular-material.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>/angular/vendor/font-awesome.css">
	<link rel="stylesheet" href="<?php echo base_url();?>/angular/css/1.css">
</head>
<body ng-app="home" ng-controller="customerHome" class="background-body" ng-init="init()">
	<!-- <div ng-include="'<?php echo base_url();?>/angular/supportview/header.php'"></div> -->
	<div class="container-fluid">
		<div class="bg-dark fixed-top" style="height: 100px; width: 100vw; 
			background-image: url(<?php echo base_url(); ?>image/bg-image.jpg);
			background-repeat: no-repeat; background-position: left top; background-size: 100% 100%;">
		<div class="h-100 w-100" style="background-color: rgba(0, 0, 0, 0.5);">
			
			<div class="container-fluid h-100">
				<div class="row center h-100">
					<div class="row h-75" style="width: min(90%, max(60%, 600px));">
						<div class="col-sm-6 d-flex align-items-center">
							<a class="display-4 text-decoration-none" style="font-weight: bold; color: orangered;" 
							href="<?php echo base_url(); ?>"> 
								Bookfest 
							</a>
						</div>
						<div class="col-sm-6 d-flex align-items-center flex-row-reverse">
							<a href="<?php echo base_url();?> index.php/customer/me" class="ms-3">
								<img ng-src="{{account.avatar}}" 
								alt="{{account.name}}" class="rounded-circle bg-light" style="width: 50px; height: 50px;">
							</a>
							<span class="" style=" color: white; font-size: 1.25em;"> 
								Hello, {{account.name}} 
							</span>
						</div>
					</div>	
				</div>
			</div>
		</div>
		</div>
		<div class="row bg-dark" style="height: 100px;"> </div>
	</div>
	<div class="container-fluid background-body my-4">
		<div class="row center">
			<div class="card border-0 rounded background-body px-0" style="width: min(90%, max(60%, 600px));">
				<div class="card-header background-body border-0 p-0">
					<div class="nav nav-tabs border-0 p-0">
						<a href="#product" ng-click="change(0)" class="nav-link border-0 {{active[0]}}">Sản phẩm</a>
						<a ng-if="account.role=='customer'" href="#cart" ng-click="change(1)" class="nav-link border-0 {{active[1]}}">Giỏ hàng</a>
						<a ng-if="account.role=='provider'" href="#repository" ng-click="change(1)" class="nav-link border-0 {{active[1]}}">Kho hàng</a>
						<a href="#receipt" ng-click="change(2)" class="nav-link border-0 {{active[2]}}">Hóa đơn</a>
					</div>
				</div>
				<div class="card-body bg-light border-0 rounded shadow px-5">
					<div>
						<div ng-view>
							
						</div>
					</div>
					<div class="row center py-3">
						<div class="btn btn-secondary w-25">
							<a class="text-decoration-none" style="color: white;" 
								href="<?php echo base_url(); ?>index.php/login/logout">
								Đăng xuất
							</a>
						</div>
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
	<script type="text/javascript" src="<?php echo base_url();?>/angular/javascript/home.js"></script>
	

</body>
</html>