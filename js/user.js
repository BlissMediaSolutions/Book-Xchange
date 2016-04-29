/**
 *	User class for Book Exchange
 *	Last edit date: 28.04.2016
 *
 *	Purpose: Manage user information and interface it with AngularJS.
 */

var app = angular.module("bookXChange", []);

//app.controller("userController", function ($scope, $http) {
app.controller("userController", function ($scope, $http, $location) {


	$scope.user = {
		'authenticated': false
	};

	$scope.init = function () {
		$scope.loadUserInfo();
		$scope.showIt = false;
	};

	$scope.loadUserInfo = function () {
//		$scope.user.firstname = "John";
//		$scope.user.surname = "Smith";
//		$scope.user.email = "user@example.com";
//		$scope.user.studentID = "12345678";
//		$scope.user.telephone = "0400 000 000"
//		$scope.user.fullname = $scope.user.firstname + ' ' + $scope.user.surname;
		
		var savedUser = localStorage.getItem('useraccount');
		if (savedUser){
			$scope.user = JSON.parse(savedUser);
		}
	};
	
	$scope.completeLogin = function (newUser) {
		$scope.user = newUser;
		localStorage.setItem('useraccount', JSON.stringify($scope.user));
	}

	$scope.performLogout = function () {
//		alert("Logout stub.");
		$scope.user = {'authenticated': false};
//		$location.path('../index.html');
		window.location.replace('index.html');
		localStorage.setItem('useraccount', null);
	};

	$scope.registerUser = function (registrant) {
		console.log($scope.user);
		if (registrant.password !== registrant.passwordConfirm) {
			alert("The provided passwords do not match.");
		} else if (registrant.acceptedTOS === false) {
			alert("Please accept the terms and conditions.");
		} else {
			// Simple GET request example:
			$http({
				url: 'php/register.php',
				method: "GET", 
				params: {
					fname: registrant.fname, 
					lname: registrant.lname, 
					email: registrant.email, 
					studid: registrant.studentID, 
					phone: registrant.phone, 
					password: registrant.password,
					repeatPassword : registrant.passwordConfirm
				}
			}).then(function successCallback(response) {
				var data = response.data;
				if(data.result === "ok"){
					$scope.completeLogin(data.user);
				}
			}, function errorCallback(response) {
				console.log(response);
			});
		}
		$scope.user.authenticated = true;
	};

	$scope.init();

});