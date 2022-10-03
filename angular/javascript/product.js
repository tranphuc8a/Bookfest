
function createURL(baseURL, controller, method, ...params){
    let url = baseURL;
    if (controller != "") url = url + "/" + controller;
    if (method != "") url = url + "/" + method;
    for (param of params){
        url = url + "/" + param;
    }
    return url;
}

function prototypeDate(date){
    if (date == "") return "";
    return date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
}

function showMessage(mdToast, content, delay = 2000) {
    mdToast.show(mdToast.simple().textContent(content).hideDelay(delay));
};

function getSize(url) {   
    var img = new Image();
    img.src = url;
    return {
    	width: img.width,
    	height: img.height
    }
}


var app = angular.module('product', ['ngRoute', 'ngMaterial']);

app.controller('productView', function($scope, $http, $mdToast){
	$scope.formatBook = function(book){
		$scope.book.pages = Number($scope.book.pages);
		$scope.book.cost = Number($scope.book.cost);
		$scope.book.quantity = Number($scope.book.quantity);
		$scope.book.sell = Number($scope.book.sell);
		let tmpURL = baseURL + "image/404.jpg";
		if (!book.avatar){
			book.avatar = tmpURL;
		}
		if (!book.images){
			book.images = [0, 0, 0, 0, 0];
		}
		for (let i = 0; i < 5; i++){
			if (!book.images[i]){
				book.images[i] = tmpURL;
			}
		}
	};
	$scope.init = function(){
		$scope.account = {};
		$scope.book = {}
		$http({
			method: "get",
			url: createURL(baseURL + "index.php", "user", "getUserProfile")
		}).then(function(res){
			$scope.account = res.data;
			// console.log($scope.account);
		});
		$http({
			method: "get",
			url: createURL(baseURL + "index.php", "product", "selectDetailBook", productid)
		}).then(function(res){
			$scope.book = res.data;
			console.log(res.data);
			$scope.formatBook($scope.book);
			// console.log($scope.book);
		});
	}
	$scope.viewUser = function(email){
		location.href = createURL(baseURL + "index.php", "user", "view", encodeURIComponent(email));
	}

	$scope.active = ["active", ""];
    $scope.change = function(index){
        $scope.active = ["", ""];
        $scope.active[index] = "active";
    }
});


app.config(function($routeProvider){
	$routeProvider.when('/detail', {
		templateUrl: baseURL + 'angular/supportview/productDetail.php',
		controller: 'productDetail'
	}).when('/update', {
		templateUrl: baseURL + 'angular/supportview/productUpdate.php',
		controller: 'productUpdate'
	}).when('/comment', {
		templateUrl: baseURL + 'angular/supportview/productComment.php',
		controller: 'productComment'
	}).otherwise({
		redirectTo: '/detail'
	});
});


app.controller('productDetail', function($scope, $http, $mdToast){
	$scope.getUser = function(email){
		$http({
			method: "get",
			url: createURL(baseURL + "index.php", "user", "getUserProfile", encodeURIComponent(email))
		}).then(function(response){
			$scope.view.owner = response.data;
		});
	}
	$scope.deleteBook = function(id){
		$http({
			method: "GET",
			url: createURL(baseURL + "index.php", "product", "deleteBook", id)
		}).then(function(res){
			console.log(res.data);
			if (res.data.success){
				showMessage($mdToast, "Đã xóa thành công", 1000);
				location.href = createURL(baseURL + "index.php", "user", "") + "#/repository";
			}
		}, function(res){});	
	}
	$scope.init = function(){
		// view controller
		$scope.view = {
			book: {}, owner: {}, quantity: 1,
			init: function(){
				this.book = $scope.book;
				if (!this.book.email){
					setTimeout(this.init.bind(this), 500);
				} else {
					$scope.getUser(this.book.email);
					// console.log(this.book);
				}
			}, addtocart: function(){
				if (this.quantity <= 0 || this.quantity + this.book.sell > this.book.quantity){
					showMessage($mdToast, "Số lượng không hợp lệ!", 1000);
					return;
				}
				$http({
					method: "post", url: createURL(baseURL + "index.php", "user", "insertBookToCart"),
					headers: {"Content-Type" : "application/x-www-form-urlencoded;charset=utf-8"},
					data: $.param({
						email: $scope.account.email,
						id: $scope.book.id,
						quantity: this.quantity
					})
				}).then(function(res){
					if (res.data.success){
						this.quantity = 0;
						showMessage($mdToast, "Đã thêm vào giỏ hàng", 1000);
					}
				});
			}, buynow: function(){
				if (this.quantity <= 0 || this.quantity + this.book.sell > this.book.quantity){
					showMessage($mdToast, "Số lượng không hợp lệ", 1000);
					return;
				}
				location.href = createURL(baseURL + "index.php", "user", "buynow", this.book.id, this.quantity);

			}
		};
		// delete confirm controller
		$scope.confirm = {
			show: false,
			announce: "Bạn có chắc chắn muốn xóa sản phẩm này không?",
			message: function(id){
				this.id = id;
				this.show = true;
			}, okay: function(){
				this.show = false;
				$scope.deleteBook(this.id);
			}, cancel(){
				this.show = false;
			}
		}
		// view image controller
		$scope.image = {
			show: false, size: {}, url: "", cover: [],
			view: function(index){
				this.show = true;
				this.change(index);
			}, change: function(index){
				this.cover = [false, false, false, false, false, false];
				this.cover[index] = true;
				this.url = $scope.view.book.avatar;
				if (index >= 0){
					this.url = $scope.view.book.images[index];
				}
				this.size = getSize(this.url);
				if (this.size.width > this.size.height * 1.5){
					this.size = {
						width: 900, height: Math.floor(this.size.height * 900 / this.size.width)
					}
				} else {
					this.size = {
						width: Math.floor(this.size.width * 600 / this.size.height), height: 600
					}
				}
			}, done: function(){
				this.show = false;
			}
		};
		$scope.view.init();
	}

});

app.controller('productUpdate', function($scope, $http, $mdToast){
	$scope.getBook = function(){
		if (!$scope.book.id){
			setTimeout($scope.getBook, 500);
		} else {
			$scope.tempBook = Object.assign({}, $scope.book);
			// console.log($scope.book);
		}
	};

	$scope.showAvatar = function(file){
		let url = URL.createObjectURL(file);
		$scope.tempBook.avatar = url;
	};

	$scope.showImage = function(index, file){
		let url = URL.createObjectURL(file);
		$scope.tempBook.images[index] = url;
	};

	$scope.init = function(){
		$scope.getBook();
		$scope.baseURL = baseURL;
	};
});


app.controller('productComment', function($scope, $http, $mdToast){
	$scope.getComments = function(productid){
		$http({
			method: "get",
			url: createURL(baseURL + "index.php", "product", "getComments", productid)
		}).then(function(res){
			$scope.view.comments = res.data;
			$scope.view.calculateStar();
			// console.log(res.data);
		});
	};
	$scope.init = function(){
		$scope.change(1);
		$scope.view = {
			filter: {
				selectAll: function(){
					return function(comment) {return true;}
				},selectNotEmpty: function(){
					return function(comment) {return comment.content.length > 0;}
				},selectZeroStar: function(){
					return function(comment) {return Number(comment.star) == 0;}
				},selectOneStar: function(){
					return function(comment) {return Number(comment.star) == 1;}
				},selectTwoStar: function(){
					return function(comment) {return Number(comment.star) == 2;}
				},selectThreeStar: function(){
					return function(comment) {return Number(comment.star) == 3;}
				},selectFourStar: function(){
					return function(comment) {return Number(comment.star) == 4;}
				},selectFiveStar: function(){
					return function(comment) {return Number(comment.star) == 5;}
				},
			},
			productid: null, show: true, comments: [], star: 0,
			calculateStar: function(){
				if (this.comments.length <= 0) {
					this.star = 0;
					return;
				}
				let sumStar = 0;
				for (let comment of this.comments){
					sumStar += Number(comment.star);
				}
				console.log(this.comments);
				this.star = Math.floor(10 * sumStar / this.comments.length) / 10;
			}, init: function(){
				this.productid = $scope.book.id; 
				this.myFilter = this.filter.selectAll;
				if (!this.productid){
					setTimeout(this.init.bind(this), 500);
				} else {
					$scope.getComments(this.productid);
					let that = this;
					setTimeout(function(){
						$scope.getComments(that.productid);
					}, 10000);
				}
			}
		};

		$scope.view.init();

		$scope.commentCtrl = {
			show: false, comment: {}, tempStar: 0,
			init: function(){
				this.show = true;
				this.comment = {
					star: 0, content: "", productid: $scope.book.id, email: $scope.account.email
				};
				this.tempStar = 0;
			}, addComment: function(){
				this.init();
				this.add = true; this.edit = false;
				// console.log(this.comment);
			}, editComment: function(comment){
				this.init();
				this.edit = true; this.add = false;
				this.comment = {...comment};
				this.tempStar = comment.star;
			}, send: function(){
				$http({
					method: "post", headers: {"Content-Type":"application/x-www-form-urlencoded;charset=utf-8"},
					url: createURL(baseURL + "index.php", "product", "insertComment"),
					data: $.param(this.comment)
				}).then(function(res){
					if (res.data.success){
						$scope.view.init();
					} else {
						console.log("Fail in upload comment");
					}
				});
				this.show = false;
			}, update: function(){
				console.log(this.comment);
				$http({
					method: "post", headers: {"Content-Type":"application/x-www-form-urlencoded;charset=utf-8"},
					url: createURL(baseURL + "index.php", "product", "updateComment"),
					data: $.param(this.comment)
				}).then(function(res){
					if (res.data.success){
						showMessage($mdToast, "Đã cập nhật bình luận", 500)
						$scope.view.init();
					} else {
						showMessage($mdToast, "Cập nhật lỗi", 500)
						$scope.view.init();
					}
				});
				this.show = false;
			}, cancel: function(){
				this.show = false;
			}
		};

		$scope.deleteComment = {
			show: false, announce: "Bạn có chắc chắn muốn xóa bình luận này không?",
			run: function(comment){
				this.comment = {...comment};
				this.show = true;
			}, okay: function(){
				this.show = false;
				$http({
					method: "get",
					url: createURL(baseURL + "index.php", "product", "deleteComment", this.comment.id)
				}).then(function(res){
					if (res.data.success){
						showMessage($mdToast, "Đã xóa bình luận", 500);
						$scope.view.init();
					}
				})
			}, cancel(){
				this.show = false;
			}
		}
	}
});





