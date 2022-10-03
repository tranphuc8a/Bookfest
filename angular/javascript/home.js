
function createURL(baseURL, controller, method, ...params){
    let url = baseURL;
    if (controller != "") url = url + "/" + controller;
    if (method != "") url = url + "/" + method;
    for (param of params){
        url = url + "/" + encodeURIComponent(param);
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

function formatBook(book){
	book.pages = Number(book.pages);
	book.cost = Number(book.cost);
	book.quantity = Number(book.quantity);
	book.sell = Number(book.sell);
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

var app1 = angular.module('home', ['ngRoute', 'ngMaterial']);

app1.controller('customerHome', function($scope, $http, $mdToast){
	$scope.init = function(){
		$scope.account = {};
		$http({
			url: createURL(baseURL + "index.php", "user", "getProfile"),
			method: "GET",
			headers: {
				'Content-Type' : 'application/x-www-form-urlencoded;charset=utf-8'
			}
		}).then(function(res){
			$scope.account = {...$scope.account, ...res.data};
			// console.log(res.data);
		}, function(){

		});
		$http({
			url: createURL(baseURL + "index.php", "user", "getUser"),
			method: "GET",
			headers: {
				'Content-Type' : 'application/x-www-form-urlencoded;charset=utf-8'
			}
		}).then(function(res){
			$scope.account = {...$scope.account, ...res.data};
			// console.log(res.data);
		}, function(){

		});
		$scope.account = {
			name: "",
		}
	}

	$scope.active = ["active", "", ""];
    $scope.change = function(index){
        $scope.active = ["", "", ""];
        $scope.active[index] = "active";
    }
});


app1.config(function($routeProvider){
	$routeProvider.when('/product', {
		templateUrl: baseURL + 'angular/supportview/product.php',
		controller: 'productController'
	}).when('/cart', {
		templateUrl: baseURL + 'angular/supportview/cart.php',
		controller: 'cartController'
	}).when('/repository', {
		templateUrl: baseURL + 'angular/supportview/repository.php',
		controller: 'repositoryController'
	}).when('/receipt', {
		templateUrl: baseURL + 'angular/supportview/receipt.php',
		controller: 'receiptController'
	}).when('/listreceipt', {
		templateUrl: baseURL + 'angular/supportview/listreceipt.php',
		controller: 'listReceiptController'
	}).when('/add', {
		templateUrl: baseURL + 'angular/supportview/productAdd.php',
		controller: 'productAdd'
	}).otherwise({
		redirectTo: '/product'
	});
});


app1.controller('productController', function($scope, $http, $mdToast, $location){
	$scope.search = function(){
		let newUrl = createURL(baseURL + "index.php", "user", "") + "#/product?searchkey=" + $scope.searchkey;
		location.href = newUrl;
		// alert(newUrl);
		// location.href = "http://localhost:8080/prj1/Bookfest/index.php/user#/product?searchkey="+$scope.searchkey;
	}
	$scope.searchAPI = function(){
		$http({
			method: "GET",
			url: createURL(baseURL + "index.php", "product", "searchBook", $scope.searchkey)
		}).then(function(res){
			$scope.products = res.data;
			console.log(res.data);
		}, function(res){

		});
	}
	$scope.view = function(id){
		location.href = createURL(baseURL + "index.php", "product", "view", id);
	}
	$scope.init = function(){
		$scope.change(0);
		$scope.products = [];
		$scope.searchkey = "";
		let key = $location.search().searchkey;	
		if (key){
			$scope.searchkey = key;	
			$scope.searchAPI();
		} else {
			$http({
				method: "GET",
				url: createURL(baseURL + "index.php", "product", "selectAllBook")
			}).then(function(res){
				$scope.products = res.data;
				console.log(res.data);
			}, function(res){

			});			
		}
	}
});

app1.controller('cartController', function($scope, $http, $mdToast, $location){
	function formatBook(book){
		book.quantity = Number(book.quantity);
		book.tempQuantity = book.quantity;
		book.sell = Number(book.sell);
		book.bookquantity = Number(book.bookquantity);
	}
	// API call
	$scope.searchAPI = function(){
		$http({
			method: "GET",
			url: createURL(baseURL + "index.php", "user", "searchBookCart", $scope.cart.searchkey)
		}).then(function(res){
			for (let product of res.data){
				formatBook(product);
			}
			$scope.cart.products = res.data;
			// console.log(res.data);
		}, function(res){});
	}
	$scope.selectAll = function(){
		$http({
			method: "GET",
			url: createURL(baseURL + "index.php", "user", "selectAllBookCart")
		}).then(function(res){
			for (let product of res.data){
				formatBook(product);
			}
			$scope.cart.products = res.data;
			// console.log(res.data);
		}, function(res){});
	}
	$scope.delete = function(id){
		$http({
			method: "GET",
			url: createURL(baseURL + "index.php", "user", "deleteBookFromCart", id)
		}).then(function(res){
			// console.log(res.data);
			if (res.data.success){			
				for (let i = 0; i < $scope.cart.products.length; i++){
					if ($scope.cart.products[i].id == id){
						$scope.cart.products.splice(i, 1);
						break;
					}
				}
				showMessage($mdToast, "Đã xóa thành công", 1000);
			}
		}, function(res){});	
	}
	// INIT
	$scope.init = function(){
		$scope.change(1);
		// main cart controller		
		$scope.cart = {
			show: true, searchkey: "", products: [],
			search: function(){
				let newUrl = createURL(baseURL + "index.php", "user", "") + "#/cart?searchkey=" + this.searchkey;
				location.href = newUrl;
			}, view: function(id){
				location.href = createURL(baseURL + "index.php", "product", "view", id);
			}, enter: function(event){
				if (event.which == 13){
					this.search();
				}
			}, save: function(book){
				if (book.tempQuantity <= 0){
					$scope.confirm.message(book.id);
				} else {
					if (book.tempQuantity + book.sell > book.bookquantity){
						book.tempQuantity = book.quantity;
						showMessage($mdToast, "Số lượng không hợp lệ", 1000);
					} else {
						book.quantity = book.tempQuantity;
						$http({
							method: "post", url: createURL(baseURL + "index.php", "user", "updateBookFromCart"),
							headers: {"Content-Type" : "application/x-www-form-urlencoded;charset=utf-8"},
							data: $.param(book)
						}).then(function(res){
							if (res.data.success){
								showMessage($mdToast, "Đã cập nhật số lượng", 1000);
							}
						});
					}
				}
			}, buynow: function(book) {
				location.href = createURL(baseURL + "index.php", "user", "buynow", book.id, book.quantity);
			}
		};
		// delete confirm controller
		$scope.confirm = {
			show: false,
			announce: "Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng không?",
			message: function(id){
				this.id = id;
				this.show = true;
			}, okay: function(){
				this.show = false;
				$scope.delete(this.id);
			}, cancel(){
				this.show = false;
			}
		}
		
		// check url
		let key = $location.search().searchkey;	
		if (key){
			$scope.cart.searchkey = key;	
			$scope.searchAPI();
		} else {
			$scope.selectAll();						
		}
	}
});

app1.controller('repositoryController', function($scope, $http, $mdToast, $location){
	// API call
	$scope.searchAPI = function(){
		$http({
			method: "GET",
			url: createURL(baseURL + "index.php", "user", "searchBookRepository", $scope.repository.searchkey)
		}).then(function(res){
			$scope.repository.products = res.data;
			console.log(res.data);
		}, function(res){});
	}
	$scope.selectAll = function(){
		$http({
			method: "GET",
			url: createURL(baseURL + "index.php", "user", "selectAllBookRepository")
		}).then(function(res){
			$scope.repository.products = res.data;
			console.log(res.data);
		}, function(res){});
	}
	$scope.delete = function(id){
		$http({
			method: "GET",
			url: createURL(baseURL + "index.php", "product", "deleteBook", id)
		}).then(function(res){
			console.log(res.data);
			if (res.data.success){			
				for (let i = 0; i < $scope.repository.products.length; i++){
					if ($scope.repository.products[i].id == id){
						$scope.repository.products.splice(i, 1);
						break;
					}
				}
				showMessage($mdToast, "Đã xóa thành công", 1000);
			}
		}, function(res){});	
	}
	// INIT
	$scope.init = function(){
		$scope.change(1);
		// main repository controller		
		$scope.repository = {
			show: true, searchkey: "", products: [],
			search: function(){
				let newUrl = createURL(baseURL + "index.php", "user", "") + "#/repository?searchkey=" + this.searchkey;
				location.href = newUrl;
			}, view: function(id){
				location.href = createURL(baseURL + "index.php", "product", "view", id);
			}, enter: function(event){
				if (event.which == 13){
					this.search();
				}
			}, edit: function(id){
				location.href = createURL(baseURL + "index.php", "product", "view", id) + "#update";
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
				$scope.delete(this.id);
			}, cancel(){
				this.show = false;
			}
		}
		
		// check url
		let key = $location.search().searchkey;	
		if (key){
			$scope.repository.searchkey = key;	
			$scope.searchAPI();
		} else {
			$scope.selectAll();						
		}
	}
});

app1.controller('productAdd', function($scope, $http, $mdToast){
	// add Book controller
	$scope.change(1);
	$scope.addition = {
		book: {}, baseURL:"",
		log: function(x){
			console.log(x);
			// alert("ok");
		}, showAvatar: function(file){
			this.book.avatar = URL.createObjectURL(file);
			// console.log(this.book.avatar);
		}, showImage: function(index, file){
			this.book.image[index] = URL.createObjectURL(file);
			// console.log(this.book.avatar);
		}, init: function(){
			this.baseURL = baseURL;
			let tmpURL = baseURL + "/image/404.jpg";
			this.book = {
				avatar: tmpURL,
				image: [tmpURL, tmpURL, tmpURL, tmpURL, tmpURL],
				name: "", page: "", author: "", publisher: "", detail:"",
				cost: "", quantity: "", sell: ""
			}
		}
	};
});

app1.controller('receiptController', function($scope, $http, $mdToast, $location){
	$scope.getUser = function (email, resolve = null) {
		$http.get(createURL(baseURL + "index.php", "user", "getUserProfile", email))
		.then(function(res){ if (resolve) resolve(res); });
	};
	$scope.getProduct = function(productid, resolve = null){
		$http.get(createURL(baseURL + "index.php", "product", "selectDetailBook", productid))
		.then(function(res){ if (resolve) resolve(res);});
	}
	$scope.getReceipt = function(receiptid, resolve = null){
		$http.get(createURL(baseURL + "index.php", "receiptController", "selectReceipt", receiptid))
		.then(function(res){ if (resolve) resolve(res) });
	};
	$scope.updateReceipt = function(receipt, resolve = null){
		$http({ method: "post", url: createURL(baseURL + "index.php", "receiptController", "updateReceipt"),
			headers: {"Content-Type" : "application/x-www-form-urlencoded;charset=utf-8"},
			data: $.param(receipt)
		}).then(function(res){ if (resolve) resolve(res); });
	};
	$scope.deleteReceipt = function(receiptid, resolve = null){
		$http.get(createURL(baseURL + "index.php", "receiptController", "deleteReceipt", receiptid))
		.then(function(res){ if(resolve) resolve(res); });
	};
	$scope.submitReceipt = function(receipt, resolve = null){
		$http({ method: "post", url: createURL(baseURL + "index.php", "receiptController", "submitReceipt"),
			headers: {"Content-Type" : "application/x-www-form-urlencoded;charset=utf-8"},
			data: $.param(receipt)
		}).then(function(res){ if (resolve) resolve(res); });	
	}
	$scope.init = function(){
		$scope.change(2);

		$scope.state = {
			not_submitted: "Chưa gửi hóa đơn", submitted: "Đã gửi hóa đơn, đang chờ xác nhận...", 
			accepted: "Hóa đơn đã được chấp nhận", delivering: "Đang giao hàng...", 
			success: "Giao hàng thành công", failed: "Đơn hàng thất bại", cancel: "Đã hủy",
			deny: "Bị từ chối", deleted: "Đã xóa", received: "Đã nhận được hàng"
		};

		$scope.receipt = {
			show: false, id:null, receipt: {}, product: {}, buy: {}, sell: {},
			init: function(){
				this.show = true;
				let that = this;
				$scope.getReceipt(this.id, function(res){
					res.data.quantity = Number(res.data.quantity);
					res.data.cost = Number(res.data.cost);
					res.data.during = Number(res.data.during);
					that.receipt = res.data;
					$scope.getUser(that.receipt.buyemail, function(res){
						that.buy = res.data;
					});
					$scope.getUser(that.receipt.sellemail, function(res){
						that.sell = res.data;
					});
					$scope.getProduct(that.receipt.productid, function(res){
						res.data.cost = Number(res.data.cost);
						that.product = res.data;
						formatBook(that.product);
					})
				});
			}, viewUser: function(user){
				location.href = createURL(baseURL + "index.php", "user", "view", user.email);
			}, save: function(){
				let a = Number(this.receipt.quantity), b = Number(this.product.sell), c = Number(this.product.quantity);
				if (a <= 0 || a + b > c){
					showMessage($mdToast, "Số lượng không hợp lệ", 1000);
					return;
				}
				$scope.updateReceipt(this.receipt, function(res){
					if (res.data.success){
						showMessage($mdToast, "Lưu thành công", 1000);
					} else {
						showMessage($mdToast, "Lưu thất bại", 1000);
					}
				});
				this.edit = false;
			}, buynow: function(){
				let a = Number(this.receipt.quantity), b = Number(this.product.sell), c = Number(this.product.quantity);
				if (a <= 0 || a + b > c){
					showMessage($mdToast, "Số lượng không hợp lệ", 1000);
					return;
				}
				console.log(this.receipt);
				if (this.receipt.address.length <= 0){
					showMessage($mdToast, "Địa chỉ không hợp lệ", 1000);
					return;
				}
				let that = this;
				$scope.submitReceipt(this.receipt, function(res){
					if (res.data.success){
						that.receipt.state = "submitted";
						showMessage($mdToast, "Đã gửi hóa đơn tới chủ cửa hàng", 1000);
					}
				});
				this.edit = false;
			}, isEdit: function(){
				// return false;
				if ($scope.account.role == 'customer'){
					if (this.receipt.state == 'not_submitted') return true;
					if (this.receipt.state == 'submitted'){
						return this.edit;
					}
					return false;	
				} else if ($scope.account.role == 'provider'){
					return false;
				}
				return false;
			}, accept: function(){
				$http.get(createURL(baseURL+"index.php", "receiptController", "accept", this.receipt.id))
				.then(function(res){
					if (res.data.success){
						showMessage($mdToast, "Đã cập nhật đơn hàng", 1000);
						location.reload();
					} else {
						showMessage($mdToast, "Thất bại", 1000);
					}
				});
			}, deny: function(){
				$http.get(createURL(baseURL+"index.php", "receiptController", "deny", this.receipt.id))
				.then(function(res){
					if (res.data.success){
						showMessage($mdToast, "Đã từ chối đơn hàng", 1000);
						location.reload();
					} else {
						showMessage($mdToast, "Thất bại", 1000);
					}
				});
			}, deliver: function(){
				if (this.receipt.during <= 0) {
					showMessage($mdToast, "Thời gian giao hàng không hợp lệ", 1000);
					return;
				}
				$http({ url: createURL(baseURL+"index.php", "receiptController", "deliver", this.receipt.id),
					method: "post", headers:{"Content-Type" : "application/x-www-form-urlencoded;charset=utf-8"},
					data: $.param(this.receipt)
				}).then(function(res){
					if (res.data.success){
						showMessage($mdToast, "Đã cập nhật đơn hàng", 1000);
						location.reload();
					} else {
						showMessage($mdToast, "Thất bại", 1000);
					}
				});
			}, cancel: function(){
				$http.get(createURL(baseURL+"index.php", "receiptController", "cancel", this.receipt.id))
				.then(function(res){
					if (res.data.success){
						showMessage($mdToast, "Đã cập nhật đơn hàng", 1000);
						location.reload();
					} else {
						showMessage($mdToast, "Thất bại", 1000);
					}
				});
			}, received: function(){
				$http.get(createURL(baseURL+"index.php", "receiptController", "received", this.receipt.id))
				.then(function(res){
					if (res.data.success){
						showMessage($mdToast, "Đã cập nhật đơn hàng", 1000);
						location.reload();
					} else {
						showMessage($mdToast, "Thất bại", 1000);
					}
				});
			}, complain: function(){
				$http.get(createURL(baseURL+"index.php", "receiptController", "complain", this.receipt.id))
				.then(function(res){
					if (res.data.success){
						showMessage($mdToast, "Đã cập nhật đơn hàng", 1000);
						location.reload();
					} else {
						showMessage($mdToast, "Thất bại", 1000);
					}
				});
			}, takeback: function(){
				$http.get(createURL(baseURL+"index.php", "receiptController", "takeback", this.receipt.id))
				.then(function(res){
					if (res.data.success){
						showMessage($mdToast, "Đã cập nhật đơn hàng", 1000);
						location.reload();
					} else {
						showMessage($mdToast, "Thất bại", 1000);
					}
				});
			}, comment: function(){
				$http.get(createURL(baseURL+"index.php", "receiptController", "comment", this.receipt.id))
				.then(function(res){
					if (res.data.success){
						showMessage($mdToast, "Đã cập nhật đơn hàng", 1000);
					} else {
						showMessage($mdToast, "Thất bại", 1000);
					}
				});
				location.href = createURL(baseURL + 'index.php', "product", "view", this.product.id) + "#/comment";
			}, rebuy: function(){
				location.href = createURL(baseURL + 'index.php', "product", "view", this.product.id) + "#/detail";
			}, viewProduct: function(){
				location.href = createURL(baseURL + 'index.php', "product", "view", this.product.id) + "#/detail";
			}, expectTime: function() {
				let cur = new Date(this.receipt.time);
				return cur;
			}
		};

		// delete confirm controller
		$scope.delete = {
			show: false, announce: "Bạn có chắc chắn muốn xóa hóa đơn này không?",
			run: function(id){
				this.id = id;
				this.show = true;
			}, okay: function(){
				this.show = false;
				$scope.deleteReceipt(this.id, function(res){
					if (res.data.success){
						showMessage($mdToast, "Đã xóa hóa đơn thành công!", 1000);
						location.href = createURL(baseURL + "index.php", "user", "") + "#/receipt";
					} else {
						showMessage($mdToast, "Xóa hóa đơn thất bại", 1000);
					}
				});
			}, cancel(){
				this.show = false;
			}
		}

		let id = $location.search().id;	
		if (id){
			$scope.receipt.id = id;	
			$scope.receipt.init();	
		} else {
			location.href = createURL(baseURL + "index.php", "user", "") + "#/listreceipt";
		}
	}
});



app1.controller('listReceiptController', function($mdToast, $scope, $http, $location){
	$scope.state = {
		not_submitted: "Chưa gửi", submitted: "Chờ xác nhận...", accepted: "Đã được chấp nhận",
		delivering: "Đang giao hàng...", success: "Thành công", failed: "Thất bại", cancel: "Đã hủy",
		deny: "Bị từ chối", deleted: "Đã xóa", received: "Đã nhận hàng"
	};

	$scope.getReceipt = function(resolve = null){
		let method = "selectReceiptsCustomer";
		if ($scope.account.role == 'provider'){
			method = "selectReceiptsProvider";
		}
		let url = createURL(baseURL + "index.php", "receiptController", method, $scope.account.email);
		$http.get(url).then(function(res){ if(resolve) resolve(res); });
	};

	$scope.searchAPI = function(key, resolve = null) {
		$http.get(createURL(baseURL + "index.php", "receiptController", "search", key))
		.then(function(res) { if(resolve) resolve(res); });
	};

	$scope.init = function(){
		$scope.change(2);

		$scope.view = {
			filter : {
				selectAll : function(){
					return function(receipt){ return true; };
				}, selectBeforeDelivering: function(){
					return function(receipt){ 
						return receipt.state == 'not_submitted' || receipt.state == 'submitted' 
							|| receipt.state == 'accepted'; 
					};
				}, selectDelivering: function(){
					return function(receipt){ return receipt.state == 'delivering'; };
				}, selectAfterDelivering: function(){
					return function(receipt){ 
						return receipt.state == 'success' || receipt.state == 'received'; 
					};
				}, selectFailed: function(){
					return function(receipt){ 
						return receipt.state == 'failed' || receipt.state == 'cancel' 
							|| receipt.state == 'deny' || receipt.state == 'deleted'; 
					};
				}
			},
			receipts : [], show: true, searchkey: "",
			init: function(key = null){
				this.show = true;
				let that = this;
				if (key) {
					this.searchkey = key;
					$scope.searchAPI(key, function(res){
						that.receipts = res.data;
					});
				} else {
					$scope.getReceipt(function(res){
						that.receipts = res.data;

					})
				}
				this.myFilter = this.filter.selectAll;
			}, search: function(key = null){
				if (key) {
					this.searchkey = key;
				}
				location.href = createURL(baseURL + "index.php", "user", "") + "#/listreceipt?searchkey=" + this.searchkey; 
			}
		};

		let key = $location.search().searchkey;
		$scope.view.init(key);


	};
});

