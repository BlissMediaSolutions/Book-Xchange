/**
 *	User class for Book Exchange
 *	Last edit date: 28.04.2016
 *
 *	Purpose: Manage user information and interface it with AngularJS.
 */

var app = angular.module("bookXChange", []);

app.controller("userController", function ($scope) {
	
	$scope.user = {'authenticated': false};
	
	$scope.init = function () {
		$scope.user.authenticated = $scope.userIsAuthenticated();
		if ($scope.user.authenticated === true){
			$scope.loadUserInfo();
		}
    };
	
	$scope.userIsAuthenticated = function(){
		return true;
	}
	
	$scope.loadUserInfo = function(){
//		$scope.user.username = "Demo";
		$scope.user.firstname = "John";
		$scope.user.surname = "Smith";
		$scope.user.email = "user@example.com";
		$scope.user.telephone = "0400 000 000"
		$scope.user.fullname = $scope.user.firstname + ' ' + $scope.user.surname;
	}
	
	$scope.performLogout = function(){
		alert("Logout stub.");
	}
	
	$scope.init ();

});