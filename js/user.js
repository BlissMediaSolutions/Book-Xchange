/**
 *	User class for Book Exchange
 *	Last edit date: 28.04.2016
 *
 *	Purpose: Manage user information and interface it with AngularJS.
 */

var app = angular.module("bookXChange", []);

//var app = angular.module('bookXChange', [])
//    .service('sharedProperties', function () {
//        var user = {
//			'authenticated': false
//		};
//
//        return {
//            getUser: function () {
//                return user;
//            },
//            setUser: function(value) {
//                user = value;
//            }
//        };
//    });

//app.service('sharedProperties', function () {
//        var user = {
//			'authenticated': false
//		};
//
//        return {
//            getUser: function () {
//                return user;
//            },
//            setUser: function(value) {
//                user = value;
//            }
//        };
//});

app.service("sharedProperties", function() {
	var user = {
		'authenticated': false
	};
    
    return {
        getUser: function() {
            return user;
        },
        setUser: function(value) {
            user = value;
        }
    }
});

app.controller("userController", function ($scope, $http, $location, sharedProperties) {
	
	$scope.invalidPassword = false;
	
	$scope.user = sharedProperties.getUser();
	$scope.setUser = function(newUser) {
        $scope.user = newUser;
        sharedProperties.setUser(newUser);
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
		
//			console.log(sharedProperties.getUser());
		var savedUser = localStorage.getItem('useraccount');
		if (savedUser){
			$scope.setUser(JSON.parse(savedUser));
		}
	};
	
	$scope.completeLogin = function (newUser) {
		console.log("completing login:");
		console.log(newUser);
		$scope.setUser(newUser);
		localStorage.setItem('useraccount', JSON.stringify($scope.user));
	}

	$scope.performLogout = function () {
//		alert("Logout stub.");
		$scope.setUser({'authenticated': false});
//		$location.path('../index.html');
		window.location.replace('index.html');
		localStorage.setItem('useraccount', null);
	};

	$scope.registerUser = function (registrant) {
		var user = $scope.user;
		console.log(user);
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
		user.authenticated = true;
	};
	
	$scope.loginUser = function (login) {
		if (!login.email){
			alert("Please enter an email address.");
		}else if(!login.password){
			alert("Please enter a password.");
		}else{
			$http({
				url: 'php/login.php',
				method: "POST", 
				params: {
					email: login.email, 
					password: login.password
				}
			}).then(function successCallback(response) {
				var data = response.data;
				if(data.result === "ok"){
					$scope.completeLogin(data.user);
					window.location.replace('index.html');
				}else{
					$scope.invalidPassword = true;
				}
			}, function errorCallback(response) {
				console.log(response);
			});
		}
	};
	
	$scope.getFullname = function (){
		var user = sharedProperties.getUser();
		var fn = user.firstname;
		var ln = user.surname;
		return fn + " " + ln;
	};

	$scope.init();

});

app.controller("bookController", function ($scope, $http, $location, $controller) {
	
	$scope.init = function () {
		
	};

	$scope.addBook = function (book) {
		console.log($scope.user);
		if (book.password !== book.passwordConfirm) {
			$http({
				url: 'php/addbook.php',
				method: "GET", 
				params: {
					title: book.title, 
					isbn: book.isbn, 
					author: book.author, 
					publisher: book.publisher, 
					edition: book.edition,
					
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
	};

	$scope.init();

});