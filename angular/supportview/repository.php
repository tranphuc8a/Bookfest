

<!-- MAIN REPOSITORY -->
<div name="form" class="container p-0" ng-init="init()" ng-show="repository.show">
	<div class="row w-100 m-0">
		<div class="col-sm-11 ps-0 center">
			<div class="input-group">				
				<input type="text" ng-model="repository.searchkey" placeholder="Tìm kiếm sản phẩm trong kho hàng" name="search" class="form-control input-group" ng-keypress="repository.enter($event)">
				<div class="input-group-prepend m-0" style="width: 10%;">
					<div class="input-group-text btn btn-info w-100" ng-click="repository.search()">
						<i class="fa fa-search"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="center col-sm-1">
			<a class="btn btn-info" href="#add">
				<i class="fa fa-plus p-1"></i>
			</a>
		</div>
	</div>
</div>

<div class="container my-3" ng-show="repository.show">
	<div class="row" >
		<div class="card background-card me-2 mb-2 p-0" ng-repeat="book in repository.products" style="width: 150px; height: 230px;">
			<div class="card-img-top m-0 p-0" ng-click="repository.view(book.id);" style="height: 140px;">
				<img ng-src="{{book.avatar}}" alt="" style="width: 100%; height: 120px;">
			</div>
			<div class="card-body background-card m-0 p-0" 
				style="height: 60px;" ng-click="repository.view(book.id);">
				<div class="card-title my-0 py-0 mx-2 center justify-content-start" 
					style="font-weight: bold; font-size: 0.85em; height: 50%;">
					<span class="text-truncate">{{book.name}}</span>
				</div>
				<div class="card-button my-0 py-0 mx-2" style="height: 50%;">
					<button class="btn btn-primary m-0 py-0 px-2 text-truncate" 
						style="height: 90%; font-weight: bold; font-size: 0.85em; color: white;">
						<span class="text-truncate">{{book.cost}}</span>
					</button>
				</div>
			</div>
			<div class="card-footer m-0 p-0 center justify-content-around" style="height: 30px">
				<button class="btn btn-secondary my-0 py-0" ng-click="repository.edit(book.id)" style="height: 90%;">
					<i class="fa fa-wrench px-2"></i>
				</button>
				<button class="btn btn-danger my-0 py-0" ng-click="confirm.message(book.id);" style="height: 90%;">
					<i class="fa fa-trash px-2"></i>
				</button>
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




