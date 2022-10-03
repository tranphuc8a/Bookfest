

<div name="form" class="container p-0" ng-init="init()" ng-show="view.show">
	<div class="row w-100 m-0 mb-3">
		<div class="col-sm-11 ps-0 center">
			<div class="input-group">				
				<input type="text" ng-model="view.searchkey" placeholder="Tìm kiếm hóa đơn" name="search" class="form-control input-group" ng-keypress="view.enter($event)">
				<div class="input-group-prepend m-0" style="width: 10%;">
					<div class="input-group-text btn btn-info w-100" ng-click="view.search()">
						<i class="fa fa-search"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="center col-sm-1">
			
		</div>
	</div>
	<div class="col-sm-12 m-0 p-0 center flex-wrap">
		<button class="btn btn-success m-1 w-auto" style="color: #FFC107;"
			ng-click="view.myFilter=view.filter.selectAll"> 
			Tất cả
		</button>
		<button class="btn btn-success m-1 w-auto" style="color: #FFC107;"
			ng-click="view.myFilter=view.filter.selectBeforeDelivering"> 
			Chưa giao hàng
		</button>
		<button class="btn btn-success m-1 w-auto" style="color: #FFC107;"
			ng-click="view.myFilter=view.filter.selectDelivering"> 
			Đang giao hàng
		</button>
		<button class="btn btn-success m-1 w-auto" style="color: #FFC107;"
			ng-click="view.myFilter=view.filter.selectAfterDelivering"> 
			Đã giao hàng
		</button>
		<button class="btn btn-success m-1 w-auto" style="color: #FFC107;"
			ng-click="view.myFilter=view.filter.selectFailed"> 
			Không thành công
		</button>
	</div>
</div>

<div class="container my-3" ng-show="view.show">
	<div class="row" >
		<div class="card background-card me-2 mb-2 p-0" ng-repeat="receipt in view.receipts | filter: view.myFilter()"
			style="width: 150px; height: 230px;">
			<a class="card-img-top m-0 p-0 text-decoration-none" ng-href="#receipt?id={{receipt.id}}" style="height: 140px;">
				<img ng-src="{{receipt.avatar}}" alt="" style="width: 100%; height: 120px;">
			</a>
			<a class="card-body background-card m-0 p-0 text-decoration-none" 
				style="height: 60px;" ng-href="#receipt?id={{receipt.id}}">
				<div class="card-title my-0 py-0 mx-2 center justify-content-start" 
					style="font-weight: bold; font-size: 0.85em; height: 50%;">
					<span class="text-truncate">{{receipt.name}}</span>
				</div>
				<div class="card-button my-0 py-0 mx-2" style="height: 50%;">
					<button class="btn btn-primary m-0 py-0 px-2" 
						style="height: 80%; font-weight: bold; font-size: 0.85em; color: white;">
						<span class="text-truncate">{{receipt.productcost}}</span>
					</button>
				</div>
			</a>
			<div class="card-footer m-0 p-0 center justify-content-around" style="height: 30px">
				<div class="font-bold center justify-content-between w-100 mx-2" style="height: 80%; font-size: 0.75em;">
					<div class="w-auto text-truncate">SL {{receipt.quantity}}</div>
					<div class="w-auto text-truncate">{{receipt.cost}} VNĐ</div>
				</div>
			</div>
			<div class="card-footer m-0 p-0 center justify-content-around" style="height: 30px; ">
				<button class="btn btn-success center text-truncate" style="height: 80%; font-size: 0.75em; color: #FFC107;">
					{{state[receipt.state]}}
				</button>
			</div>
		</div>
	</div>
</div>
