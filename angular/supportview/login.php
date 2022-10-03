<form class="container" name="form">
	<div class="row mt-3">
		<div class="col-sm-2 center">
			Email
		</div>
		<div class="col-sm-10">
			<input name="email" type="email" class="form-control border-primary py-2" ng-model="account.email" required autocomplete>
		</div>
		<div class="col-sm-10 offset-sm-2" style="color:#E83E8C;"  ng-show="form.email.$invalid && form.email.$dirty">
			Email không hợp lệ
		</div>
	</div>
	<div class="row mt-3">
		<div class="col-sm-2 center">
			Mật khẩu
		</div>
		<div class="col-sm-10">
			<input name="password" type="password" class="form-control border-primary py-2" ng-model="account.password" required autocomplete>
		</div>
<!-- 		<div class="col-sm-10 offset-sm-2" style="color:#E83E8C;" ng-show="!form.password.$valid">
			Mật khẩu không hợp lệ
		</div> -->
	</div>
	<div class="row mt-4">
		<div class="col-sm-2 center">
			Code
		</div>
		<div class="col-sm-4">
			<input type="text" class="form-control border-primary py-2 text-center border-0" ng-model="randomcode" disabled style="color:white; font-weight: bold; background-color: gray; font-size: 1.25em;">
		</div>
		<div class="col-sm-1 center" ng-click="refreshCode()">
			<div class="btn btn-info fa fa-refresh"></div>
		</div>
		<div class="col-sm-5">
			<input type="text" class="form-control border-primary py-2" ng-model="usercode" required autocomplete placeholder="Nhập code" name="recode">
		</div>
		<div class="col-sm-10 offset-sm-2" style="color:#E83E8C;" ng-show="usercode!=randomcode && form.recode.$dirty">
			Mã code không trùng khớp
		</div>
	</div>

	<div class="row my-4">
		<div class="col-sm-6 offset-sm-3 center">
			<button class="btn btn-primary btn-block btn-lg px-sm-5" ng-click="login()" 
			ng-disabled="!form.email.$valid || !form.password.$valid || usercode!=randomcode">
				Đăng nhập
			</button>	
		</div>
		<div class="center" style="color:#E83E8C;">
			{{notification}}
		</div>
	</div>	
</form>



