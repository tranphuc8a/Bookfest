<!-- ADD BOOK -->
<form class="container full" method="post" enctype="multipart/form-data" name="form1" ng-init="init()"
	action="{{baseURL + 'index.php/product/updateBook'}}" >
	<input type="text" name="id" ng-model="book.id" ng-show="false">
	<input type="text" name="oldAvatar" ng-model="book.avatar" ng-show="false" class="form-control">
	<input type="text" name="oldImage0" ng-model="book.images[0]" ng-show="false" class="form-control">
	<input type="text" name="oldImage1" ng-model="book.images[1]" ng-show="false" class="form-control">
	<input type="text" name="oldImage2" ng-model="book.images[2]" ng-show="false" class="form-control">
	<input type="text" name="oldImage3" ng-model="book.images[3]" ng-show="false" class="form-control">
	<input type="text" name="oldImage4" ng-model="book.images[4]" ng-show="false" class="form-control">
	<div class="row h4 mb-3">
		Cập nhật thông tin sản phẩm
	</div>
	<div class="row full">
		<div class="col-md-5 col-sm-12">
		  	<div class="w-100 center flex-column mb-3">
	  			<label for="avatar" class="rounded-circle center full border-dark" 
  					style="height: 150px; width: 150px; border: 1px black solid; 
  					background-image: url({{tempBook.avatar}}); background-size: 100% 100%;"
  					ng-mouseover="showUpload.avatar=true" 
  					ng-mouseleave="showUpload.avatar=false"> 
  					<i class="fa fa-upload fa-3x" style="color: blue;" ng-show="showUpload.avatar"> </i>
		  		</label>
				<input type="file" id="avatar" name="avatar" accept=".jpg,.jpeg,.png" ng-show="false" 
					onchange="angular.element(this).scope().showAvatar(this.files[0])">
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
			 			ng-mouseover="showUpload.image[0]=true" ng-mouseleave="showUpload.image[0]=false"
			 			style="background-image: url({{tempBook.images[0]}});">
			 			<div class="fa fa-plus fa-2x" style="color: blue;" ng-show="showUpload.image[0];"> </div>
			 		</label>
			 		<input type="file" id="image0" name="image0" accept=".png,.jpeg,.jpg" ng-show="false"
			 			onchange="angular.element(this).scope().showImage(0, this.files[0])">
		 		</div>
		 		<!-- 2 -->
		 		<div class="mx-1 my-1">	 			
			 		<label for="image1" class="div rounded center bg-secondary input-image"
			 			ng-mouseover="showUpload.image[1]=true" ng-mouseleave="showUpload.image[1]=false"
			 			style="background-image: url({{tempBook.images[1]}});">
			 			<div class="fa fa-plus fa-2x" style="color: blue;" ng-show="showUpload.image[1];"> </div>
			 		</label>
			 		<input type="file" id="image1" name="image1" accept=".png,.jpeg,.jpg" ng-show="false"
			 			onchange="angular.element(this).scope().showImage(1, this.files[0])">
		 		</div>
		 		<!-- 3 -->
		 		<div class="mx-1 my-1">	 			
			 		<label for="image2" class="div rounded center bg-secondary input-image"
			 			ng-mouseover="showUpload.image[2]=true" ng-mouseleave="showUpload.image[2]=false"
			 			style="background-image: url({{tempBook.images[2]}});">
			 			<div class="fa fa-plus fa-2x" style="color: blue;" ng-show="showUpload.image[2];"> </div>
			 		</label>
			 		<input type="file" id="image2" name="image2" accept=".png,.jpeg,.jpg" ng-show="false"
			 			onchange="angular.element(this).scope().showImage(2, this.files[0])">
		 		</div>
		 		<!-- 4 -->
		 		<div class="mx-1 my-1">	 			
			 		<label for="image3" class="div rounded center bg-secondary input-image"
			 			ng-mouseover="showUpload.image[3]=true" ng-mouseleave="showUpload.image[3]=false"
			 			style="background-image: url({{tempBook.images[3]}});">
			 			<div class="fa fa-plus fa-2x" style="color: blue;" ng-show="showUpload.image[3];"> </div>
			 		</label>
			 		<input type="file" id="image3" name="image3" accept=".png,.jpeg,.jpg" ng-show="false"
			 			onchange="angular.element(this).scope().showImage(3, this.files[0])">
		 		</div>
		 		<!-- 5 -->
		 		<div class="mx-1 my-1">
			 		<label for="image4" class="div rounded center bg-secondary input-image"
			 			ng-mouseover="showUpload.image[4]=true" ng-mouseleave="showUpload.image[4]=false"
			 			style="background-image: url({{tempBook.images[4]}});">
			 			<div class="fa fa-plus fa-2x" style="color: blue;" ng-show="showUpload.image[4];"> </div>
			 		</label>
			 		<input type="file" id="image4" name="image4" accept=".png,.jpeg,.jpg" ng-show="false"
			 			onchange="angular.element(this).scope().showImage(4, this.files[0])">
		 		</div>		 		
		 	</div>
		 	
		</div>
		<div class="col-md-7 col-sm-12">
			<!-- Name, author, NXB, số trang, Mô tả chi tiết
			Cost, quantity, sell -->
			<div class="h4"> Thông tin sản phẩm </div>
			<div class="row m-0 p-0 center mb-1">
				<div class="col-sm-4 m-0 p-0 center justify-content-end pe-2"> Tên sản phẩm </div>
				<div class="col-sm-8 m-0 p-0">
					<input style="font-size: 0.75em;" name="name" type="text" class="form-control border-primary m-0" 
					ng-model="tempBook.name" required autocomplete placeholder="Tên sản phẩm">
					<div class="col-sm-12 m-0 p-0" style="color:#E83E8C;" ng-show="!form1.name.$valid && form1.name.$dirty">
						Tên sản phẩm không hợp lệ
					</div>
				</div>
			</div>
			<div class="row m-0 p-0 center mb-1">
				<div class="col-sm-4 m-0 p-0 center justify-content-end pe-2"> Số trang </div>
				<div class="col-sm-8 m-0 p-0">
					<input style="font-size: 0.75em;" name="page" type="number" class="form-control border-primary" 
					ng-model="tempBook.page" autocomplete placeholder="Số trang">
					<div class="col-sm-12 m-0 p-0" style="color:#E83E8C;" ng-show="!form1.page.$valid && form1.page.$dirty">
						Thông tin không hợp lệ
					</div>
				</div>
			</div>
			<div class="row m-0 p-0 center mb-1">
				<div class="col-sm-4 m-0 p-0 center justify-content-end pe-2"> Tác giả </div>
				<div class="col-sm-8 p-0">
					<input style="font-size: 0.75em;" name="author" type="text" class="form-control border-primary" 
					ng-model="tempBook.author" autocomplete placeholder="Tác giả">
					<div class="col-sm-12 m-0 p-0" style="color:#E83E8C;" ng-show="!form1.author.$valid && form1.author.$dirty">
						Thông tin không hợp lệ
					</div>
				</div>
			</div>
			<div class="row m-0 p-0 center mb-1">
				<div class="col-sm-4 m-0 p-0 center justify-content-end pe-2"> Nhà xuất bản </div>
				<div class="col-sm-8 p-0">
					<input style="font-size: 0.75em;" name="publisher" type="text" class="form-control border-primary" 
					ng-model="tempBook.publisher" autocomplete placeholder="Nhà xuất bản">
					<div class="col-sm-12 m-0 p-0" style="color:#E83E8C;" ng-show="!form1.publisher.$valid && form1.publisher.$dirty">
						Thông tin không hợp lệ
					</div>
				</div>	
			</div>
			<div class="row m-0 p-0 center mb-1">
				<div class="col-sm-4 m-0 p-0 center justify-content-end pe-2"> Thông tin chi tiết </div>		
				<div class="col-sm-8 m-0 p-0 center">
					<textarea name="detail" class="form-control border-primary" ng-model="tempBook.detail" placeholder="Thông tin chi tiết"
					style="font-size: 0.75em;">
					</textarea>
					<div class="col-sm-12 m-0 p-0" style="color:#E83E8C;" ng-show="!form1.detail.$valid && form1.detail.$dirty">
						Thông tin không hợp lệ
					</div>
				</div>
			</div>
			
			<div class="h4 mt-2"> Thông tin bán hàng </div>
			<div class="row m-0 p-0 center mb-1">
				<div class="col-sm-4 m-0 p-0 center justify-content-end pe-2"> Giá bán </div>		
				<div class="col-sm-8 p-0">
					<input style="font-size: 0.75em;" name="cost" type="number" class="form-control border-primary" 
					ng-model="tempBook.cost" autocomplete placeholder="Giá sản phẩm" required>
					<div class="col-sm-12 m-0 p-0" style="color:#E83E8C;" ng-show="!form1.cost.$valid && form1.cost.$dirty">
						Giá bán không hợp lệ
					</div>
				</div>
			</div>
			<div class="row m-0 p-0">
				<div class="col-sm-4 m-0 p-0 center justify-content-end pe-2"> Số lượng </div>		
				<div class="col-sm-8 p-0">
					<input style="font-size: 0.75em;" name="quantity" type="number" class="form-control border-primary" ng-model="tempBook.quantity" autocomplete placeholder="Số lượng" required>
					<div class="col-sm-12 m-0 p-0" style="color:#E83E8C;" ng-show="!form1.quantity.$valid && form1.quantity.$dirty">
						Thông tin không hợp lệ
					</div>
				</div>
				<div class="col-sm-4 m-0 p-0 center justify-content-end pe-2"> Đã bán </div>
				<div class="col-sm-8 p-0">
					<input style="font-size: 0.75em;" name="sell" type="number" class="form-control border-primary" 
					ng-model="tempBook.sell" autocomplete placeholder="Đã bán" required>
					<div class="col-sm-12 m-0 p-0" style="color:#E83E8C;" ng-show="!form1.sell.$valid && form1.sell.$dirty">
						Thông tin không hợp lệ
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row center justify-content-around my-4">
		<a class="btn btn-info mx-1 border-box" href="#repository" style="width: 100px" >
			Back
		</a>
		<div class="btn btn-info mx-1 border-box" ng-click="init()" style="width: 100px">
			Reset data
		</div>
		<input type="submit" name="addproduct" class="btn btn-info mx-1 border-box" style="width: 150px" value="Update product">
	</div>
</form>


