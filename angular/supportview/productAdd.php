<!-- ADD BOOK -->
<form class="container full" method="post" enctype="multipart/form-data" name="form1" ng-init="addition.init()"
	action="{{addition.baseURL + 'index.php/product/addBook'}}" >
	<div class="row h4 mb-3">
		Thêm sản phẩm vào kho
	</div>
	<div class="row full">
		<div class="col-md-5 col-sm-12">
		  	<div class="w-100 center flex-column mb-3">
	  			<label for="avatar" class="rounded-circle center full border-dark" 
  					style="height: 150px; width: 150px; border: 1px black solid; 
  					background-image: url({{addition.book.avatar}}); background-size: 100% 100%;"
  					ng-mouseover="addition.showUpload.avatar=true" 
  					ng-mouseleave="addition.showUpload.avatar=false"> 
  					<i class="fa fa-upload fa-3x" style="color: blue;" ng-show="addition.showUpload.avatar"> </i>
		  		</label>
				<input type="file" id="avatar" name="avatar" accept=".jpg,.jpeg,.png" ng-show="false" 
					onchange="angular.element(this).scope().addition.showAvatar(this.files[0])">
				<span style="font-weight: bold;">Ảnh đại diện</span>
		 	</div>
		 	<span style="font-weight: bold;">Ảnh chi tiết sản phẩm</span>
		 	<style> 
		 		.input-image{ width: 50px; height: 50px; background-size: 100% 100%; border: 1px solid black; display: "inline-flex;"; margin: 0;}
		 	</style>
		 	<div class="w-100 my-2 center flex-wrap">
		 		<!-- 1 -->
		 		<div class="mx-1 my-1">
			 		<label for="image0" class="div rounded center bg-secondary input-image"
			 			ng-mouseover="addition.showUpload.image[0]=true" ng-mouseleave="addition.showUpload.image[0]=false"
			 			style="background-image: url({{addition.book.image[0]}});">
			 			<div class="fa fa-plus fa-2x" style="color: blue;" ng-show="addition.showUpload.image[0];"> </div>
			 		</label>
			 		<input type="file" id="image0" name="image0" accept=".png,.jpeg,.jpg" ng-show="false"
			 			onchange="angular.element(this).scope().addition.showImage(0, this.files[0])">
		 		</div>
		 		<!-- 2 -->
		 		<div class="mx-1 my-1">	 			
			 		<label for="image1" class="div rounded center bg-secondary input-image"
			 			ng-mouseover="addition.showUpload.image[1]=true" ng-mouseleave="addition.showUpload.image[1]=false"
			 			style="background-image: url({{addition.book.image[1]}});">
			 			<div class="fa fa-plus fa-2x" style="color: blue;" ng-show="addition.showUpload.image[1];"> </div>
			 		</label>
			 		<input type="file" id="image1" name="image1" accept=".png,.jpeg,.jpg" ng-show="false"
			 			onchange="angular.element(this).scope().addition.showImage(1, this.files[0])">
		 		</div>
		 		<!-- 3 -->
		 		<div class="mx-1 my-1">	 			
			 		<label for="image2" class="div rounded center bg-secondary input-image"
			 			ng-mouseover="addition.showUpload.image[2]=true" ng-mouseleave="addition.showUpload.image[2]=false"
			 			style="background-image: url({{addition.book.image[2]}});">
			 			<div class="fa fa-plus fa-2x" style="color: blue;" ng-show="addition.showUpload.image[2];"> </div>
			 		</label>
			 		<input type="file" id="image2" name="image2" accept=".png,.jpeg,.jpg" ng-show="false"
			 			onchange="angular.element(this).scope().addition.showImage(2, this.files[0])">
		 		</div>
		 		<!-- 4 -->
		 		<div class="mx-1 my-1">	 			
			 		<label for="image3" class="div rounded center bg-secondary input-image"
			 			ng-mouseover="addition.showUpload.image[3]=true" ng-mouseleave="addition.showUpload.image[3]=false"
			 			style="background-image: url({{addition.book.image[3]}});">
			 			<div class="fa fa-plus fa-2x" style="color: blue;" ng-show="addition.showUpload.image[3];"> </div>
			 		</label>
			 		<input type="file" id="image3" name="image3" accept=".png,.jpeg,.jpg" ng-show="false"
			 			onchange="angular.element(this).scope().addition.showImage(3, this.files[0])">
		 		</div>
		 		<!-- 5 -->
		 		<div class="mx-1 my-1">
			 		<label for="image4" class="div rounded center bg-secondary input-image"
			 			ng-mouseover="addition.showUpload.image[4]=true" ng-mouseleave="addition.showUpload.image[4]=false"
			 			style="background-image: url({{addition.book.image[4]}});">
			 			<div class="fa fa-plus fa-2x" style="color: blue;" ng-show="addition.showUpload.image[4];"> </div>
			 		</label>
			 		<input type="file" id="image4" name="image4" accept=".png,.jpeg,.jpg" ng-show="false"
			 			onchange="angular.element(this).scope().addition.showImage(4, this.files[0])">
		 		</div>		 		
		 	</div>
		 	
		</div>
		<div class="col-md-7 col-sm-12">
			<!-- Name, author, NXB, số trang, Mô tả chi tiết
			Cost, quantity, sell -->
			<div> Thông tin sản phẩm </div>
			<div class="row m-0 p-0">
				<div class="col-sm-9 m-0 p-0">
					<input style="font-size: 0.75em;" name="name" type="text" class="form-control border-primary" 
					ng-model="addition.book.name" required autocomplete placeholder="Tên sản phẩm">
					<div class="col-sm-12 m-0 p-0" style="color:#E83E8C;" ng-show="!form1.name.$valid && form1.name.$dirty">
						Tên sản phẩm không hợp lệ
					</div>
				</div>
				<div class="col-sm-3 m-0 p-0">
					<input style="font-size: 0.75em;" name="page" type="number" class="form-control border-primary" 
					ng-model="addition.book.page" autocomplete placeholder="Số trang">
					<div class="col-sm-12 m-0 p-0" style="color:#E83E8C;" ng-show="!form1.page.$valid && form1.page.$dirty">
						Thông tin không hợp lệ
					</div>
				</div>
			</div>
			<div class="row m-0 p-0">
				<div class="col-sm-6 p-0">
					<input style="font-size: 0.75em;" name="author" type="text" class="form-control border-primary" 
					ng-model="addition.book.author" autocomplete placeholder="Tác giả">
					<div class="col-sm-12 m-0 p-0" style="color:#E83E8C;" ng-show="!form1.author.$valid && form1.author.$dirty">
						Thông tin không hợp lệ
					</div>
				</div>
				<div class="col-sm-6 p-0">
					<input style="font-size: 0.75em;" name="publisher" type="text" class="form-control border-primary" 
					ng-model="addition.book.publisher" autocomplete placeholder="Nhà xuất bản">
					<div class="col-sm-12 m-0 p-0" style="color:#E83E8C;" ng-show="!form1.publisher.$valid && form1.publisher.$dirty">
						Thông tin không hợp lệ
					</div>
				</div>
			</div>
			<div class="row m-0 p-0">
				<div class="col-sm-12 m-0 p-0">
					<textarea name="detail" class="form-control border-primary" ng-model="addition.book.detail" placeholder="Thông tin chi tiết"
					style="font-size: 0.75em;">
					</textarea>
					<div class="col-sm-12 m-0 p-0" style="color:#E83E8C;" ng-show="!form1.detail.$valid && form1.detail.$dirty">
						Thông tin không hợp lệ
					</div>
				</div>	
			</div>
			<div> Thông tin bán hàng </div>
			<div class="row m-0 p-0">
				<div class="col-sm-12 p-0">
					<input style="font-size: 0.75em;" name="cost" type="number" class="form-control border-primary" 
					ng-model="addition.book.cost" autocomplete placeholder="Giá sản phẩm" required>
					<div class="col-sm-12 m-0 p-0" style="color:#E83E8C;" ng-show="!form1.cost.$valid && form1.cost.$dirty">
						Giá bán không hợp lệ
					</div>
				</div>
			</div>
			<div class="row m-0 p-0">
				<div class="col-sm-6 p-0">
					<input style="font-size: 0.75em;" name="quantity" type="number" class="form-control border-primary" ng-model="addition.book.quantity" autocomplete placeholder="Số lượng" required>
					<div class="col-sm-12 m-0 p-0" style="color:#E83E8C;" ng-show="!form1.quantity.$valid && form1.quantity.$dirty">
						Thông tin không hợp lệ
					</div>
				</div>
				<div class="col-sm-6 p-0">
					<input style="font-size: 0.75em;" name="sell" type="number" class="form-control border-primary" 
					ng-model="addition.book.sell" autocomplete placeholder="Đã bán" required>
					<div class="col-sm-12 m-0 p-0" style="color:#E83E8C;" ng-show="!form1.sell.$valid && form1.sell.$dirty">
						Thông tin không hợp lệ
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row full center justify-content-around">
		<a class="btn btn-info mx-1 border-box" href="#repository" style="width: 100px" >
			Back
		</a>
		<div class="btn btn-info mx-1 border-box" ng-click="addition.init()" style="width: 100px">
			Reset data
		</div>
		<input type="submit" name="addproduct" class="btn btn-info mx-1 border-box" style="width: 150px" value="Add product">
	</div>
</form>


