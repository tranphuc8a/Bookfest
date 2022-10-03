
<div name="form" class="container p-0" ng-init="init()">
	<div class="row w-100 m-0">
		<div class="col-sm-11 ps-0 center">
			<div class="input-group">				
				<input type="text" ng-model="searchkey" placeholder="Tìm kiếm sản phẩm" name="search" class="form-control input-group" ng-keypress="enter()">
				<div class="input-group-prepend" style="width: 10%;">
					<div class="input-group-text btn btn-info w-100" ng-click="search()">
						<i class="fa fa-search"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container my-3">
	<div class="row center flex-wrap justify-content-start">
		<div class="card background-card me-2 mb-2 p-0" ng-click="view(book.id);" style="width: 150px; height: 200px;" ng-repeat="book in products">
			<div class="card-img-top m-0 p-0" style="height: 140px;">
				<img ng-src="{{book.avatar}}" alt="" style="width: 100%; height: 120px;">
			</div>
			<div class="card-body background-card m-0 p-0" style="height: 60px;">
				<div class="card-title my-0 py-0 mx-2 center justify-content-start" 
					style="font-weight: bold; font-size: 0.85em; height: 50%;">
					<span class="text-truncate">{{book.name}}</span>
				</div>
				<div class="card-button my-0 py-0 mx-2" style="height: 50%;">
					<button class="btn btn-primary m-0 py-0 px-2" 
					style="height: 90%; font-weight: bold; font-size: 0.85em; color: white; text-overflow: ellipsis;">
						<span class="text-truncate">{{book.cost}}</span>
					</button>
				</div>
			</div>
			
		</div>
	</div>
</div>



