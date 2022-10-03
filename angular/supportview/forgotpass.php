
<form class="container" name="form" novalidate ng-show="show[0]" ng-init="refresh()">
	<!-- Email -->
	<div class="row my-1">
		<div class="col-sm-12">
			<input name="email" type="email" class="form-control border-primary" ng-model="account.email" required autocomplete placeholder="Nhập email">
		</div>
		<div class="col-sm-12" style="color:#E83E8C;" ng-show="!form.email.$valid && form.email.$dirty">
			Email không hợp lệ
		</div>
	</div>

	<div class="row my-4">
		<div class="col-sm-6 offset-sm-3 center">
			<button class="btn btn-primary btn-block btn-lg px-sm-5" ng-click="submitCode()" ng-disabled="!form.$valid">
				Lấy lại mật khẩu
			</button>	
		</div>
	</div>
	<div class="row center" style="color:#E83E8C;">
		{{notification}}
	</div>
</form>

<form novalidate ng-show="show[1]" name="form2">
		<div class="row mt-4">
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
			<button class="mx-3 btn btn-primary btn-block btn-lg px-sm-5" ng-click="sendCode()" ng-disabled="!form2.$valid">
				Gửi code
			</button>	
		</div>
	</div>
	<div class="row center" style="color:#E83E8C;">
		{{notification}}
	</div>
</form>

<form novalidate ng-show="show[2]" name="form3">
	<div class="row mt-4">
		<div class="col-sm-4 center">
			Mật khẩu mới
		</div>
		<div class="col-sm-7">
			<input type="password" class="form-control border-primary py-2" ng-model="account.password" required autocomplete placeholder="Mật khẩu mới" name="newpassword">
		</div>
		<div class="row center" style="color:#E83E8C;" ng-show="!form3.newpassword.$valid && form.newpassword.$dirty">
			Mật khẩu không hợp lệ
		</div>
	</div>
	<div class="row mt-2 mb-4">
		<div class="col-sm-4 center">
			Nhập lại
		</div>
		<div class="col-sm-7">
			<input type="password" class="form-control border-primary py-2" ng-model="account.repassword" required autocomplete placeholder="Nhập lại mật khẩu">
		</div>
		<div class="row center" style="color:#E83E8C;" ng-show="account.password!=account.repassword && form.repassword.$dirty">
			Mật khẩu không trùng
		</div>
	</div>
	<div class="row my-2">
		<div class="center">
			<button class="mx-3 btn btn-primary btn-block btn-lg px-sm-5" ng-click="back()">
				Trở lại
			</button>	
			<button class="mx-3 btn btn-primary btn-block btn-lg px-sm-5" ng-click="changePassword()" 
			ng-disabled="!form3.$valid || account.password!=account.repassword">
				Đổi mật khẩu
			</button>	
		</div>
	</div>
	<div class="row center" style="color:#E83E8C;">
		{{notification}}
	</div>
</form>

