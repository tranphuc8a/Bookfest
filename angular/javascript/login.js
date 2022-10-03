
var app = angular.module('login',['ngMaterial', 'ngRoute']);

function createURL(baseURL, controller, method, ...params){
    let url = baseURL + "/" + controller + "/" + method;
    for (param of params){
        url = url + "/" + param;
    }
    return url;
}

function prototypeDate(date){
    if (date == "") return "";
    return date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
}

app.controller('loginPageController', function($scope, $mdToast, $http) {
    function showMessage(content, delay = 2000) {
        $mdToast.show($mdToast.simple().textContent(content).hideDelay(delay));
    };
    $scope.active = ["active", "", ""];
    $scope.change = function(index){
        $scope.active = ["", "", ""];
        $scope.active[index] = "active";
    }
});

app.config(function ($routeProvider, $locationProvider) {
    $routeProvider.when('/login', {
        templateUrl: baseURL + 'angular/supportview/login.php',
        controller: 'loginController'
    }).when('/register',{
        templateUrl: baseURL + 'angular/supportview/register.php',
        controller: 'registerController'
    }).when('/forgotpass',{
        templateUrl: baseURL + 'angular/supportview/forgotpass.php',
        controller: 'forgotPassController'
    }).otherwise({
        redirectTo: '/login'
    });
});

app.controller('loginController', function($scope, $mdToast, $http, $location, $window) {
    $scope.usercode = "";
    $scope.randomcode = "";
    $scope.account = {
        email: "",
        password: ""
    };
    $scope.checkPassword = true;

    $scope.refreshCode = function(){
        $scope.usercode = "";
        let code = "";
        for (let i = 1; i <= 6; i++){
            code += Math.floor(Math.random() * 10).toString();
        }
        $scope.randomcode = code;
    }
    $scope.refreshCode();
    
    
    $scope.login = function(){
        console.log(JSON.stringify($scope.account));
        $http({
            url: createURL(baseURL + 'index.php/', 'login', 'login'),
            method: "POST",
            headers: {
                'Content-Type' : 'application/x-www-form-urlencoded;charset=utf-8'
            },
            data: $.param($scope.account)
        }).then(function(res){
            console.log(res.data);
            $scope.notification = res.data;
            if (res.data.includes("success")){
                // $location.path(res.data);
                location.href = baseURL + 'index.php/' + "/welcome";
                // $window.location.reload();
            } else {
                $scope.refreshCode();
            }
        }, function(res){

        });
    }
});

app.controller('registerController', function($scope, $mdToast, $http) {

    $scope.register = function(){
        $scope.account.strdob = prototypeDate($scope.account.dob);
        $http({
            url: createURL(baseURL + 'index.php/', 'login', 'register'),
            method: "POST",
            headers: {
                'Content-Type' : 'application/x-www-form-urlencoded;charset=utf-8'
            },
            data: $.param($scope.account)
        }).then(function(res){
            if (res.data.includes("Đăng ký thành công")){
                // $scope.refresh();
            }
            console.log(res.data);
            $scope.notification = res.data;
        }, function(res){

        });
    }
    $scope.requestCode = function(){
        $http({
            url: createURL(baseURL + 'index.php/', 'login', 'api_code_register'),
            method: "POST",
            headers: {
                'Content-Type' : 'application/x-www-form-urlencoded;charset=utf-8'
            },
            data: $.param($scope.account)
        }).then(function(res){
            console.log(res.data);
            $scope.notification = res.data;
        }, function(res){

        });
    }
    $scope.back = function(){
        $scope.showInputCode = false;
        $scope.notification = "";
    }
    $scope.submitCode = function(){
        $scope.showInputCode = true;
        $scope.requestCode();   
    }
    $scope.refresh = function(){
        $scope.showInputCode = false;
        $scope.notification = "";
        $scope.change(1);
        $scope.checkInfo = true;
        $scope.account = {
            email: "",
            password: "",
            repassword: "",
            name: "",
            phone: "",
            role: "customer",
            code: "",
            dob: "",
            strdob: "",
        };  
    }
});

app.controller('forgotPassController', function($scope, $mdToast, $http) {
    $scope.requestCode = function(){
        $http({
            url: createURL(baseURL + 'index.php/', 'login', 'api_code_forgot_pass'),
            method: "POST",
            headers: {
                'Content-Type' : 'application/x-www-form-urlencoded;charset=utf-8'
            },
            data: $.param($scope.account)
        }).then(function(res){
            console.log(res.data);
            $scope.notification = res.data;
        }, function(res){

        });
    }

    $scope.sendCode = function(){
        // $scope.account.strdob = prototypeDate($scope.account.dob);
        $http({
            url: createURL(baseURL + 'index.php/', 'login', 'validate_code'),
            method: "POST",
            headers: {
                'Content-Type' : 'application/x-www-form-urlencoded;charset=utf-8'
            },
            data: $.param($scope.account)
        }).then(function(res){
            $scope.notification = res.data ;    
            if (res.data.includes("success")){
                $scope.show = [false, false, true];
                $scope.notification = "";
            } else {
            }
            console.log(res.data);
        }, function(res){

        });
    }
    $scope.changePassword = function(){
        $scope.account.strdob = prototypeDate($scope.account.dob);
        $http({
            url: createURL(baseURL + 'index.php/', 'login', 'forgot_pass'),
            method: "POST",
            headers: {
                'Content-Type' : 'application/x-www-form-urlencoded;charset=utf-8'
            },
            data: $.param($scope.account)
        }).then(function(res){
            $scope.refresh();
            $mdToast.show($mdToast.simple().textContent(res.data).hideDelay(2000));
            console.log(res.data);
        }, function(res){

        });   
    }    
    $scope.back = function(index){
        $scope.show = [true, false, false];
        $scope.notification = "";
    }
    $scope.submitCode = function(){
        $scope.show = [false, true, false];
        $scope.requestCode();   
    }
    $scope.refresh = function(){
        $scope.show = [true, false, false];
        $scope.notification = "";
        $scope.change(2);
        $scope.checkInfo = true;
        $scope.account = {
            email: "",
            password: "",
            repassword: "",
            newpassword: "",
            name: "",
            phone: "",
            role: "customer",
            code: "",
            dob: "",
            strdob: ""
        };
    }
});





