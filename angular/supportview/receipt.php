
<form class="container-fluid m-0 p-0" ng-show="receipt.show" ng-init="init()" name="form">
	<div class="row full">
		<div class="col-md-5 col-sm-12 mt-3">
			<!-- product avatar and image -->
		  	<div class="w-100 center flex-column mb-3">
		  		<img ng-src="{{receipt.product.avatar}}" alt="avatar" class="rounded-circle btn m-0 p-0" 
		  			style="height: 150px; width: 150px; border: 1px black solid;"
		  			ng-click="receipt.viewProduct()">
		 	</div>
		 	<style> 
		 		.input-image{ width: 50px; height: 50px; border: 1px solid black; display: "inline-flex;"; margin: 0;}
		 	</style>
		 	<div class="w-100 my-2 center flex-wrap">
		 		<div class="mx-1 my-1" ng-repeat="i in [0,1,2,3,4]">
			 		<img class="rounded btn m-0 p-0 input-image" ng-src="{{receipt.product.images[i]}}">
		 		</div>		 		
		 	</div>
		 	<!-- buttons -->	
		 	<!-- not_submitted and edit of submitted -->
			<div ng-if="account.role=='customer'&&(receipt.receipt.state=='not_submitted' || receipt.edit)" 
				class="col-sm-12 center flex-column m-0 p-0 my-2">
				<div class="m-0 p-0 center justify-content-between flex-wrap">
					<div class="btn btn-success m-1 p-1 px-2" ng-click="receipt.save();receipt.edit=false">
						Lưu lại
					</div>
					<div class="btn btn-danger m-1 p-1 px-2" ng-click="delete.run(receipt.receipt.id)">
						Xóa hóa đơn
					</div>	
				</div>
				<div class="btn btn-lg btn-warning m-1 p-1 px-3 mt-3 font-bold" ng-click="receipt.buynow();receipt.edit=false">
					Mua ngay
				</div>
			</div>
			<!-- submitted -->
			<div ng-if="receipt.receipt.state=='submitted'">
				<!-- customer and not edit -->
				<div ng-if="account.role=='customer'&&!receipt.edit" 
					class="col-sm-12 center flex-column m-0 p-0 my-2">
					<div class="m-0 p-0 center justify-content-between flex-wrap">
						<div class="btn btn-success m-1 p-1 px-2" ng-click="receipt.edit=true">
							Sửa đơn hàng
						</div>
						<div class="btn btn-danger m-1 p-1 px-2" ng-click="delete.run(receipt.receipt.id)">
							Hủy đơn hàng
						</div>	
					</div>
				</div>
				<!-- provider -->
				<div ng-if="account.role=='provider'" 
					class="col-sm-12 center flex-column m-0 p-0 my-2">
					<div class="m-0 p-0 center justify-content-between flex-wrap">
						<div class="btn btn-success m-1 p-1 px-2" ng-click="receipt.accept()">
							Chấp nhận
						</div>
						<div class="btn btn-danger m-1 p-1 px-2" ng-click="receipt.deny()">
							Từ chối
						</div>	
					</div>
				</div>
			</div>

			<!-- accepted -->
			<div ng-if="receipt.receipt.state=='accepted'">
				<!-- customer -->
				<div ng-if="account.role=='customer'" 
					class="col-sm-12 center flex-column m-0 p-0 my-2">
				</div>
				<!-- provider -->
				<div ng-if="account.role=='provider'" 
					class="col-sm-12 center flex-column m-0 p-0 my-2">
					<div class="m-0 p-0 center justify-content-between flex-wrap">
						<div class="btn btn-success m-1 p-1 px-2" ng-click="receipt.deliver()">
							Giao hàng ngay
						</div>
						<div class="btn btn-danger m-1 p-1 px-2" ng-click="receipt.cancel()">
							Hủy đơn
						</div>	
					</div>
				</div>
			</div>

			<!-- deny -->
			<div ng-if="receipt.receipt.state=='deny'">
				<!-- customer -->
				<div ng-if="account.role=='customer'" 
					class="col-sm-12 center flex-column m-0 p-0 my-2">
					<div class="m-0 p-0 center justify-content-between flex-wrap">
						<div class="btn btn-danger m-1 p-1 px-2" ng-click="delete.run(receipt.receipt.id)">
							Xóa đơn hàng
						</div>	
					</div>
				</div>
				<!-- provider -->
				<div ng-if="account.role=='provider'" 
					class="col-sm-12 center flex-column m-0 p-0 my-2">
					
				</div>
			</div>

			<!-- cancel -->
			<div ng-if="receipt.receipt.state=='cancel'">
				<!-- customer -->
				<div ng-if="account.role=='customer'" 
					class="col-sm-12 center flex-column m-0 p-0 my-2">
					<div class="m-0 p-0 center justify-content-between flex-wrap">
						<div class="btn btn-danger m-1 p-1 px-2" ng-click="delete.run(receipt.receipt.id)">
							Xóa đơn hàng
						</div>	
					</div>
				</div>
				<!-- provider -->
				<div ng-if="account.role=='provider'" 
					class="col-sm-12 center flex-column m-0 p-0 my-2">
					
				</div>
			</div>

			<!-- delivering -->
			<div ng-if="receipt.receipt.state=='delivering'">
				<!-- customer -->
				<div ng-if="account.role=='customer'" 
					class="col-sm-12 center flex-column m-0 p-0 my-2">
					<div class="m-0 p-0 center justify-content-between flex-wrap">
						<div class="btn btn-success m-1 p-1 px-2" ng-click="receipt.received()">
							Đã nhận được hàng
						</div>
						<div class="btn btn-danger m-1 p-1 px-2" ng-click="receipt.complain()">
							Khiếu nại đơn quá hạn
						</div>	
					</div>
				</div>
				<!-- provider -->
				<div ng-if="account.role=='provider'" 
					class="col-sm-12 center flex-column m-0 p-0 my-2">
					<div class="m-0 p-0 center justify-content-between flex-wrap">
						<div class="btn btn-success m-1 p-1 px-2" ng-click="receipt.takeback()">
							Rút đơn quá hạn
						</div>
					</div>
				</div>
			</div>

			<!-- failed -->
			<div ng-if="receipt.receipt.state=='failed'">
				<!-- customer -->
				<div ng-if="account.role=='customer'" 
					class="col-sm-12 center flex-column m-0 p-0 my-2">
					<div class="m-0 p-0 center justify-content-between flex-wrap">
						<div class="btn btn-danger m-1 p-1 px-2" ng-click="delete.run(receipt.receipt.id)">
							Xóa đơn hàng
						</div>	
					</div>
				</div>
				<!-- provider -->
				<div ng-if="account.role=='provider'" 
					class="col-sm-12 center flex-column m-0 p-0 my-2">
					
				</div>
			</div>

			<!-- received -->
			<div ng-if="receipt.receipt.state=='received'">
				<!-- customer and not edit -->
				<div ng-if="account.role=='customer'&&!receipt.edit" 
					class="col-sm-12 center flex-column m-0 p-0 my-2">
					<div class="m-0 p-0 center justify-content-between flex-wrap">
						<div class="btn btn-success m-1 p-1 px-2" ng-click="receipt.comment()">
							Đánh giá hàng
						</div>
					</div>
				</div>
			</div>

			<!-- success -->
			<div ng-if="receipt.receipt.state=='success'">
				<!-- customer and not edit -->
				<div ng-if="account.role=='customer'&&!receipt.edit" 
					class="col-sm-12 center flex-column m-0 p-0 my-2">
					<div class="m-0 p-0 center justify-content-between flex-wrap">
						<div class="btn btn-success m-1 p-1 px-2" ng-click="receipt.rebuy()">
							Mua lại
						</div>
					</div>
					<div class="m-0 p-0 center justify-content-between flex-wrap">
						<div class="btn btn-danger m-1 p-1 px-2" ng-click="delete.run(receipt.receipt.id)">
							Xóa đơn hàng
						</div>	
					</div>
				</div>
			</div>

		</div>


		<!-- receipt info -->
		<div class="col-md-7 col-sm-12" ng-init="receipt.showInfo=false">
			<!-- product Info -->
			<div class="row m-0 p-0">
				<div class="col-sm-12 m-0 my-2 p-0 h1"> {{receipt.product.name}} </div>
			</div>
			<a href="" ng-if="!receipt.showInfo" class="row m-0 p-0 text-decoration-none" ng-click="receipt.showInfo=!receipt.showInfo">
				Xem thông tin sản phẩm
			</a>
			<a href="" ng-if="receipt.showInfo" class="col-sm-12 m-0 p-0 text-decoration-none" ng-click="receipt.showInfo=!receipt.showInfo">
				Ẩn thông tin
			</a>
			<div class="row m-0 p-0" ng-show="receipt.showInfo">
				<div class="row m-0 p-0 center justify-content-between">
					<div class="m-0 p-0 h6 w-auto"> Tác giả: {{receipt.product.author}} </div>
					<div class="m-0 p-0 w-auto"> Số trang: {{receipt.product.pages}} </div>
				</div>
				<div class="col-sm-12 m-0 p-0 d-flex flex-row-reverse">
					Nhà xuất bản: {{receipt.product.publisher}}
				</div>
				<hr class="my-1 p-0">
				<div class="row m-0 p-0 center justify-content-between">
					<div class="m-0 p-0 w-auto"> Số lượng: {{receipt.product.quantity}} </div>
					<div class="m-0 p-0 w-auto"> Đã bán: {{receipt.product.sell}} </div>
				</div>
				<div class="row m-0 p-0">
					<div class="col-sm-12 m-0 p-0 center justify-content-start" ng-click="receipt.viewUser(receipt.sell);"
						ng-if="account.role=='customer'">
						Cửa hàng: <a href="" class="font-bold text-decoration-none ms-2"> {{receipt.sell.name}} </a>
					</div>
					<div class="col-sm-12 m-0 p-0 center justify-content-start" ng-click="receipt.viewUser(receipt.buy);"
						ng-if="account.role=='provider'">
						Người mua: <a href="" class="font-bold text-decoration-none ms-2"> {{receipt.buy.name}} </a>
					</div>
				</div>

				<div class="row m-0 p-0" ng-init="receipt.showDetail=false">
					<a href="" ng-if="!receipt.showDetail" class="row m-0 p-0 text-decoration-none" ng-click="receipt.showDetail=!receipt.showDetail">
						Xem chi tiết sản phẩm
					</a>
					<a href="" ng-if="receipt.showDetail" class="col-sm-12 m-0 p-0 text-decoration-none" ng-click="receipt.showDetail=!receipt.showDetail">
						Ẩn chi tiết
					</a>
					<div class="row m-0 p-0" ng-show="receipt.showDetail">
						<div class="col-sm-12"> {{receipt.product.detail}} </div>
					</div>
				</div>
			</div>
			<hr class="my-1 p-0">
			<!-- Address and Message -->
			<div class="row m-0 p-0 center justify-content-between">
				<div class="m-0 p-0 w-auto">Địa chỉ</div>
				<div class="m-0 p-0 w-75" ng-if="receipt.isEdit()">
					<textarea class="form-control m-0 p-1 w-100" ng-model="receipt.receipt.address" placeholder="Địa chỉ giao hàng" style="height: 30px; max-height: 50px; font-size: 0.75em;" required name="address"></textarea>
				</div>
				<div class="m-0 p-0 w-auto" ng-if="!receipt.isEdit()">
					{{receipt.receipt.address}}
				</div>
			</div>
			<div class="row m-0 p-0 mt-1 center justify-content-between">
				<div class="m-0 p-0 w-auto">Lời nhắn</div>
				<div class="m-0 p-0 w-75" ng-if="receipt.isEdit()">
					<textarea class="form-control m-0 p-1 w-100" ng-model="receipt.receipt.message" placeholder="Lời nhắn tới người bán"
					style="height: 30px; max-height: 50px; font-size: 0.75em;" required name="message"></textarea>
				</div>
				<div class="m-0 p-0 w-auto" ng-if="!receipt.isEdit()">
					{{receipt.receipt.message}}
				</div>
			</div>
			<hr class="my-1 p-0">
			<!-- Buy info -->
			<div class="row m-0 p-0 center">
				<div class="row m-0 p-0 center justify-content-between">
					<div class="m-0 p-0 w-auto">Đơn giá</div>
					<div class="m-0 p-0 w-auto">{{receipt.product.cost}} VNĐ</div>
				</div>
				<div class="row m-0 p-0 center justify-content-between">
					<div class="m-0 p-0 w-auto">Số lượng</div>
					<div class="m-0 p-0 w-50 center justify-content-end" ng-if="receipt.isEdit()">
						<input class="form-control w-100 py-1 my-0" type="number" min="0" name="quantity" ng-model="receipt.receipt.quantity">
					</div>
					<div class="m-0 p-0 w-auto" ng-if="!receipt.isEdit()">
						{{receipt.receipt.quantity}}
					</div>
				</div>
				<div class="row m-0 p-0 center justify-content-between">
					<div class="m-0 p-0 w-auto">Thành tiền</div>
					<div class="m-0 p-0 w-auto font-bold">
						{{receipt.receipt.cost=receipt.receipt.quantity*receipt.product.cost}} VNĐ
					</div>
				</div>
			</div>
			<div class="row m-0 p-0 center justify-content-between"
			ng-if="receipt.receipt.state=='accepted'&&account.role=='provider'">
				<div class="m-0 p-0 w-auto">Thời gian giao hàng</div>
				<div class="m-0 p-0 w-auto center">				
					<input class="form-control m-1 p-1" type="number" min="0" ng-model="receipt.receipt.during"
				placeholder="đơn vị giờ" style="width: 80px;">
					tiếng
				</div>
			</div>
			<hr class="my-1 p-0">
			<!-- State -->
			<div class="row m-0 p-0 center justify-content-between">
				<div class="m-0 p-0 w-auto">Trạng thái</div>
				<div class="m-0 p-0 w-auto">{{state[receipt.receipt.state]}}</div>
			</div>
			<div ng-if="receipt.receipt.state=='delivering'" class="row m-0 p-0 center justify-content-between">
				<div class="m-0 p-0 w-auto">Thời gian nhận hàng dự kiến</div>
				<div class="m-0 p-0 w-auto">{{receipt.expectTime()}}</div>
			</div>
		</div>

	</div>
</form>


<!-- DELETE CONFIRM -->
<div class="confirm fixed-top vw-100 vh-100 center" ng-show="delete.show" style="background-color: rgba(0, 0, 0, 0.5);">
	<div class="card bg-light" style="height: 200px; width: 300px;">
		<div class="card-header h-25 center" style="font-weight: bold;"> THÔNG BÁO </div>
		<div class="card-body center" style="font-weight: bold;">
			{{delete.announce}}
		</div>
		<div class="card-footer center justify-content-around h-25">
			<button class="btn btn-primary" ng-click="delete.okay()" style="font-weight: bold;">
				Đồng ý
			</button>
			<button class="btn btn-danger" ng-click="delete.cancel()" style="font-weight: bold;">
				Hủy bỏ
			</button>
		</div>
	</div>
</div>





