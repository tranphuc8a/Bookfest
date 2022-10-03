<!-- ADD BOOK -->
<div class="container full" method="post" enctype="multipart/form-data" name="form1" ng-init="init()"
	action="{{view.baseURL + 'index.php/product/addBook'}}" >
	<div class="row full h4 mb-3">
		<div class="col-12">
			<a ng-click="viewUser(view.owner.email)" class="h6 text-decoration-none" href="">
				<img class="rounded-circle me-2" style="width:35px; height: 35px; border: 1px solid black;" 
					ng-src="{{view.owner.avatar}}">
				{{view.owner.name}}
			</a>
		</div>
	</div>
	<div class="row full">
		<div class="col-md-5 col-sm-12 mt-3">
		  	<div class="w-100 center flex-column mb-3">
		  		<img ng-src="{{view.book.avatar}}" alt="avatar" class="rounded-circle btn m-0 p-0" 
		  			style="height: 150px; width: 150px; border: 1px black solid;"
		  			ng-click="image.view(-1)">
		 	</div>
		 	<style> 
		 		.input-image{ width: 50px; height: 50px; border: 1px solid black; display: "inline-flex;"; margin: 0;}
		 	</style>
		 	<div class="w-100 my-2 center flex-wrap">
		 		<div class="mx-1 my-1" ng-repeat="i in [0,1,2,3,4]">
			 		<img class="rounded btn m-0 p-0 input-image" ng-src="{{view.book.images[i]}}" ng-click="image.view(i)">
		 		</div>		 		
		 	</div>
		 	<div ng-if="account.role=='provider'&&account.email==book.email" class="row center justify-content-around my-3">
				<a class="btn btn-info mx-1 border-0 bg-secondary" href="#update" style="width: 100px; color: white;" >
					<i class="fa fa-wrench px-2 fa-2x"></i>
				</a>
				<div class="btn btn-info mx-1 border-0 bg-danger" ng-click="confirm.message(view.book.id)" 
					style="width: 100px; color: white;">
					<i class="fa fa-trash px-2 fa-2x"></i>
				</div>
			</div>
			<div class="col-sm-12 m-0 p-0 center my-2">
				<div class="col-sm-3 m-0 p-0">Số lượng:</div>
				<div class="col-sm-9 m-0 p-0">				
					<input type="number" name="quantity" ng-model="view.quantity" class="form-control">
				</div>
			</div>
			<div ng-if="account.role=='customer'" class="row center justify-content-around m-0 p-0 my-2">
				<div class="btn btn-info m-1 p-1 border-box" ng-click="view.buynow()" style="width: 100px" >
					Mua ngay
				</div>
				<div class="btn btn-info m-1 p-1 border-box" ng-click="view.addtocart()" style="width: 150px">
					Thêm vào giỏ hàng
				</div>
			</div>
		</div>

		<div class="col-md-7 col-sm-12">
			<!-- Name, author, NXB, số trang, Mô tả chi tiết
			Cost, quantity, sell -->
			<div class="row m-0 p-0">
				<div class="col-sm-12 m-0 my-2 p-0 h1">
					{{view.book.name}}
				</div>
			</div>
			<div class="row m-0 p-0">
				<div class="col-sm-6 m-0 p-0 h6">
					Tác giả: {{view.book.author}}
				</div>
				<div class="col-sm-6 m-0 p-0 d-flex flex-row-reverse">
					Số trang: {{view.book.pages}}
				</div>
				<div class="col-sm-12 m-0 p-0 d-flex flex-row-reverse">
					Nhà xuất bản: {{view.book.publisher}}
				</div>
			</div>
			<hr class="my-1 p-0">
			<div class="row m-0 p-0">
				<div class="col-sm-6 p-0">
					Số lượng: {{view.book.quantity}}
				</div>
				<div class="col-sm-6 p-0 d-flex flex-row-reverse">
					Đã bán: {{view.book.sell}}
				</div>
			</div>
			<hr class="my-1 p-0">
			<div class="row m-0 p-0 d-flex flex-row-reverse">
				<span class="my-2 btn btn-primary" style="width: auto;">
					Giá: {{view.book.cost}} VNĐ
				</span>
			</div>
			<hr class="my-1 p-0">
			<div class="row m-0 p-0" ng-init="view.showDetail=false">
				<a href="" class="row m-0 p-0 text-decoration-none" ng-click="view.showDetail=!view.showDetail">
					Chi tiết sản phẩm
				</a>
				<div class="row m-0 p-0" ng-show="view.showDetail">
					<div class="col-sm-12">
						{{view.book.detail}}
					</div>
					<a href="" class="col-sm-12 m-0 p-0 text-decoration-none" ng-click="view.showDetail=!view.showDetail">
						Ẩn chi tiết
					</a>
				</div>
			</div>
		</div>

	</div>
	
</div>


<!-- DELETE CONFIRM -->
<div class="confirm fixed-top vw-100 vh-100 center" ng-show="confirm.show" style="background-color: rgba(0, 0, 0, 0.5);">
	<div class="card bg-light" style="height: 200px; width: 300px;">
		<div class="card-header h-25 center" style="font-weight: bold;"> THÔNG BÁO </div>
		<div class="card-body center" style="font-weight: bold;">
			{{confirm.announce}}
		</div>
		<div class="card-footer center justify-content-around h-25">
			<button class="btn btn-primary" ng-click="confirm.okay()" style="font-weight: bold;">
				Đồng ý
			</button>
			<button class="btn btn-danger" ng-click="confirm.cancel()" style="font-weight: bold;">
				Hủy bỏ
			</button>
		</div>
	</div>
</div>



<!-- SHOW IMAGE -->
<div class="vw-100 vh-100 fixed-top center" ng-show="image.show"
	style="background-color: rgba(0, 0, 0, 0.5);">
	<div class="rounded center" style="width: 1200px; height: 600px;">
		<div class="m-0 p-0 rounded center" style="width: 900px; height: 600px; background-color: black;">
			<img ng-src="{{image.url}}" alt="" class="rounded" 
				style="width: {{image.size.width}}px; height: {{image.size.height}}px;">
		</div>
		<div class="bg-dark m-0 p-0 rounded center flex-column" style="width: 300px; height: 600px;">
			<div class="row m-0 p-0 rounded-circle border-black" ng-click="image.change(-1)"
				style="width: 250px; height: 250px; background-image: url({{view.book.avatar}}); background-size: 100% 100%;">
				<div class="m-0 p-0 rounded-circle" 
					style=" widows: 250px; height: 250px;
					background-color: rgba(0, 0, 0, 0.5);" ng-show="!image.cover[-1]">
				</div>
			</div>
			<div class="row m-0 p-0 my-2">
				<div class="rounded-circle me-1 m-0 p-0 border-black" ng-repeat="i in [0,1,2,3,4]" ng-click="image.change(i);"
					style="background-color: gray; width: 50px; height: 50px; 
					background-image: url({{view.book.images[i]}}); background-size: 100% 100%;">
					<div ng-show="!image.cover[i]" class="rounded-circle" style=" width: 50px; height: 50px;
					background-color: rgba(0, 0, 0, 0.5);">
						
					</div>
				</div>
			</div>
			<button class="btn btn-primary my-3 w-50" ng-click="image.done()">
				Thoát
			</button>
		</div>
	</div>
</div>


