
<form class="container" name="form" novalidate ng-show="!showInputCode" ng-init="refresh()">
	<!-- Email -->
	<div class="row my-1">
		<div class="col-sm-12">
			<input name="email" type="email" class="form-control border-primary" ng-model="account.email" required autocomplete placeholder="Nhập email">
		</div>
		<div class="col-sm-12" style="color:#E83E8C;" ng-show="!form.email.$valid && form.email.$dirty">
			Email không hợp lệ
		</div>
	</div>
	<!-- Password -->
	<div class="row my-1">
		<div class="col-sm-6">
			<input name="password" type="password" class="form-control border-primary" ng-model="account.password" required autocomplete placeholder="Nhập mật khẩu">
			<div class="col-sm-12" style="color:#E83E8C;" ng-show="!form.password.$valid && form.password.$dirty">
				Mật khẩu không hợp lệ
			</div>
		</div>
		<div class="col-sm-6">
			<input name="repassword" type="password" class="form-control border-primary" ng-model="account.repassword" required autocomplete placeholder="Nhập lại mật khẩu" name="repassword">
			<div class="col-sm-12" style="color:#E83E8C;" ng-show="account.password != account.repassword && form.repassword.$dirty">
				Mật khẩu không trùng khớp
			</div>
		</div>
	</div>
	<!-- Tên và ngày sinh -->
	<div class="row my-1">
		<div class="col-sm-12">
			<input name="name" type="text" class="form-control border-primary" ng-model="account.name" required autocomplete placeholder="Họ tên">
			<div class="col-sm-12" style="color:#E83E8C;" ng-show="!form.name.$valid && form.name.$dirty" >
				Tên không hợp lệ
			</div>
		</div>
	</div>
	<!-- Số điện thoại -->
	<div class="row my-1">
		<div class="col-sm-6">
			<input name="phone" type="text" class="form-control border-primary" ng-model="account.phone" required autocomplete placeholder="Số điện thoại">
			<div class="col-sm-12" style="color:#E83E8C;" ng-show="!form.phone.$valid && form.phone.$dirty">
				Số điện thoại không hợp lệ
			</div>
		</div>
		<div class="col-sm-6">
			<input name="dob" type="date" class="form-control border-primary" ng-model="account.dob" required autocomplete placeholder="Ngày sinh">
			<div class="col-sm-12" style="color:#E83E8C;" ng-show="!form.dob.$valid && form.dob.$dirty">
				Ngày sinh không hợp lệ
			</div>
		</div>
	</div>
	<!-- Vai trò -->
	<div class="row mt-2 mb-4">
		<div class="col-sm-12">
			Vai trò:
			<label class="d-inline ms-sm-5"> 
				<input type="radio" name="role" value="customer" ng-model="account.role"> 
				Mua hàng 
			</label>
			<label class="d-inline ms-sm-5"> 
				<input type="radio" name="role" value="provider" ng-model="account.role"> 
				Bán hàng 
			</label>
		</div>
	</div>

	<div class="row my-2">
		<div class="col-sm-6 offset-sm-3 center">
			<button class="btn btn-primary btn-block btn-lg px-sm-5" ng-click="submitCode()" ng-disabled="!form.$valid">
				Đăng ký
			</button>	
		</div>
	</div>
	<div class="row center" style="color:#E83E8C;">
		{{notification}}
	</div>
</form>

<form novalidate ng-show="showInputCode" name="form2">
	<!-- <div class="row mb-4">
		<div class="center" style="color:#E83E8C;">
			Mã code đã được gửi tới email của bạn, hiệu lực trong vòng 2 phút
		</div>
	</div>
 -->	<div class="row mt-4">
		<div class="col-sm-4 center">
			Nhập code
		</div>
		<div class="col-sm-7">
			<input type="number" class="form-control border-primary py-2" ng-model="account.code" required autocomplete placeholder="Nhập code">
		</div>
	</div>
	<div class="row my-4">
		<div class="col-sm-4 center">
			Gửi lại code
		</div>
		<div class="col-sm-7">
			<div class="btn btn-info center" ng-click="requestCode()" style="width: 100px; height: 30px;"><i class="fa fa-refresh"></i></div>
		</div>
	</div>
	<div class="row my-2">
		<div class="center">
			<button class="mx-3 btn btn-primary btn-block btn-lg px-sm-5" ng-click="back()">
				Trở lại
			</button>	
			<button class="mx-3 btn btn-primary btn-block btn-lg px-sm-5" ng-click="register()" ng-disabled="!form2.$valid">
				Gửi code
			</button>	
		</div>
	</div>
	<div class="row center" style="color:#E83E8C;">
		{{notification}}
	</div>
</form>

