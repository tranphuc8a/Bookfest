
<div class="container-fluid m-0 p-0" ng-init="init()" ng-show="view.show">
	<div class="row m-0 p-0 my-3">
		<div class="col-sm-4 m-0 p-0 mb-2 d-flex flex-column justify-content-center" style="font-size: 1.5em;">
			<div class="col-sm-12 m-0 mb-1 p-0 center">
				<span> 
					{{view.star}}<i class="m-0 p-0 fa fa-star" style="color: #FFC107;"></i>
					/ 5<i class="m-0 p-0 fa fa-star" style="color: #FFC107;"></i>
				</span>
			</div>
			<div class="col-sm-12 m-0 p-0 center">
				<div class="btn btn-primary" ng-click="commentCtrl.addComment()">
					Viết đánh giá
				</div>
			</div>
		</div>
		<div class="col-sm-8 m-0 p-0 my-3">
			<div class="col-sm-12 m-0 p-0 mb-1">
				<button class="btn btn-success mb-1" ng-click="view.myFilter=view.filter.selectAll"> Tất cả </button>	
				<button class="btn btn-success mb-1" ng-click="view.myFilter=view.filter.selectNotEmpty"> Có bình luận </button>
			</div>
			<div class="col-sm-12 m-0 p-0">
				<button class="btn btn-success mb-1" ng-click="view.myFilter=view.filter.selectFiveStar"> 
					5 <i class="m-0 p-0 fa fa-star" style="color: #FFC107;"></i> 
				</button>
				<button class="btn btn-success mb-1" ng-click="view.myFilter=view.filter.selectFourStar"> 
					4 <i class="m-0 p-0 fa fa-star" style="color: #FFC107;"></i> 
				</button>
				<button class="btn btn-success mb-1" ng-click="view.myFilter=view.filter.selectThreeStar"> 
					3 <i class="m-0 p-0 fa fa-star" style="color: #FFC107;"></i> 
				</button>
				<button class="btn btn-success mb-1" ng-click="view.myFilter=view.filter.selectTwoStar"> 
					2 <i class="m-0 p-0 fa fa-star" style="color: #FFC107;"></i> 
				</button>
				<button class="btn btn-success mb-1" ng-click="view.myFilter=view.filter.selectOneStar"> 
					1 <i class="m-0 p-0 fa fa-star" style="color: #FFC107;"></i> 
				</button>
				<button class="btn btn-success mb-1" ng-click="view.myFilter=view.filter.selectZeroStar"> 
					0 <i class="m-0 p-0 fa fa-star" style="color: #FFC107;"></i> 
				</button>
			</div>			
		</div>
		<hr class="p-0 m-0 my-3">
	</div>
	<div class="row m-0 p-0 my-3">
		<div class="row m-0 p-0 mb-2 center h4" ng-if="view.comments.length <= 0">
			Không có đánh giá nào
		</div>
		<div class="row m-0 p-0 mb-2" ng-repeat="comment in view.comments | filter: view.myFilter()">
			<div class="col-sm-12 m-0 p-0 center justify-content-start" style="height: 40px;">
				<img class="rounded-circle" ng-src="{{comment.avatar}}" ng-click="viewUser(comment.email)"
					style="width: 35px; height: 35px; border: 1px solid black; margin-right: 5px;">
				<div class="div">
					<div class="row m-0 p-0 font-bold" ng-click="viewUser(comment.email)"> {{comment.name}} </div>
					<div class="row m-0 p-0" style="font-size: 0.75em;"> {{comment.time}} </div>
					<hr class="m-0 p-0">
				</div>
				<div ng-if="comment.email == account.email">
					<div class="col-sm-12 m-0 p-0 ms-3 center justify-content-start">
						<i class="btn btn-secondary m-0 mx-1 p-1 px-2 fa fa-wrench d-inline-block"
							ng-click="commentCtrl.editComment(comment)"></i>
						<i class="btn btn-danger m-0 mx-1 p-1 px-2 fa fa-trash d-inline-block"
							ng-click="deleteComment.run(comment)"></i>
					</div>
				</div>
			</div>
			<div class="col-sm-12 p-0 m-0 center justify-content-start w-100">
				<div class="" style="width: 40px; height: 2px;"> </div>
				<div class="div w-100">
					<div class="row m-0 p-0 center justify-content-start" style="width: calc(100% - 40px);">
						<div class="d-inline-block m-0 p-0" ng-repeat="i in [0,1,2,3,4]" style="width: auto;">
							<i ng-if="comment.star>i" class="m-0 p-0 fa fa-star" style="color: #FFC107;"></i>
							<i ng-if="comment.star<=i" class="m-0 p-0 fa fa-star" style="color: gray;"></i>
						</div>
					</div>
					<div class="row m-0 p-0">
						{{comment.content}}
					</div>
				</div>
			</div>
			<hr class="m-0 p-0 my-3">
		</div>
	</div>
</div>


<div class="container-fluid m-0 p-0 fixed-top vw-100 vh-100 center" ng-init="" ng-show="commentCtrl.show" 
	style="background-color: rgba(0, 0, 0, 0.5);">
	<div class="bg-light rounded center" style="width: 800px; height: 500px;">
		<div class="col-sm-12 m-0 p-0 px-5 center justify-content-start flex-wrap">
			<div class="col-sm-12 center justify-content-start flex-wrap">
				<div class="" style="width: 50px; height: 50px;">
					<img class="rounded-circle" ng-src="{{account.avatar}}" alt="" 
						style="width: 100%; height: 100%; border: 1px solid black;">
				</div>
				<div class="font-bold mx-2" style="font-size: 1.25em;">
					{{account.name}}
				</div>	
			</div>
			<div class="col-sm-12 m-0 p-0 px-5 center justify-content-start">
				<div class="" style="width: 50px;"></div>
				<div class="col-sm-12 m-0 p-0">
					<div class="mx-2 col-sm-12" style="font-size: 1.5em;">
						<div class="d-inline-block m-0 p-0" ng-repeat="i in [0,1,2,3,4]" 
						 style="width: auto;" ng-mouseover="commentCtrl.tempStar=i+1;" 
								 ng-mouseleave="commentCtrl.tempStar=commentCtrl.comment.star" 		
								 ng-click="commentCtrl.comment.star=commentCtrl.tempStar">
							<i ng-if="commentCtrl.tempStar>i" class="m-0 p-0 me-1 fa fa-star" style="color: #FFC107;"></i>
							<i ng-if="commentCtrl.tempStar<=i" class="m-0 p-0 me-1 fa fa-star" style="color: gray;"></i>
						</div>
						<i class="fa fa-refresh d-inline-block mx-3" ng-click="commentCtrl.tempStar=0"></i>
					</div>
					<div class="col-sm-12 mx-2 w-100">
						<textarea class="form-control m-0 p-3 mt-3" placeholder="Viết đánh giá" 
							ng-model="commentCtrl.comment.content"
							style="width: 100%; min-height: 200px; max-height: 200px; background-color: lightgray;">
						</textarea>
					</div>
				</div>
			</div>
			<div class="col-sm-12 m-0 p-0 px-5 mt-4 center justify-content-around">
				<button ng-if="commentCtrl.add" class="btn btn-primary" style="width: 100px;" ng-click="commentCtrl.send()"> Gửi </button>
				<button ng-if="commentCtrl.edit" class="btn btn-primary" style="width: 100px;" ng-click="commentCtrl.update()"> Cập nhật </button>
				<button class="btn btn-primary" style="width: 100px;" ng-click="commentCtrl.cancel()"> Hủy </button>
			</div>
		</div>
	</div>
</div>


<!-- DELETE CONFIRM -->
<div class="fixed-top vw-100 vh-100 center" ng-show="deleteComment.show" style="background-color: rgba(0, 0, 0, 0.5);">
	<div class="card bg-light" style="height: 200px; width: 300px;">
		<div class="card-header h-25 center" style="font-weight: bold;"> THÔNG BÁO </div>
		<div class="card-body center" style="font-weight: bold;">
			{{deleteComment.announce}}
		</div>
		<div class="card-footer center justify-content-around h-25">
			<button class="btn btn-primary" ng-click="deleteComment.okay()" style="font-weight: bold;">
				Đồng ý
			</button>
			<button class="btn btn-danger" ng-click="deleteComment.cancel()" style="font-weight: bold;">
				Hủy bỏ
			</button>
		</div>
	</div>
</div>

