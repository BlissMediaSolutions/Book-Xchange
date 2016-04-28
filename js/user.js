var app = angular.module("bookXChange", []);

app.controller("userController", function ($scope) {
	
	$scope.user = {'authenticated': false};
	
	$scope.init = function () {
		$scope.user.authenticated = userIsAuthenticated();
		if ($scope.user.authenticated === true){
			loadUserInfo();
		}
    };
	
	userIsAuthenticated = function(){
		return true;
	}
	
	loadUserInfo = function(){
		$scope.user.username = "Demo";
	}
	
	$scope.init ();

});