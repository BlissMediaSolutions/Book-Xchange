/**
 *	Book class for Book Exchange
 *	Last edit date: 07.05.2016
 *
 *	Purpose: Manage book information and interface it with AngularJS.
 */

app.controller("bookController", function ($scope, $http, $location) {
	
	$scope.init = function () {
		
	};

	$scope.addBook = function (registrant) {
		console.log($scope.user);
		if (registrant.password !== registrant.passwordConfirm) {
			alert("The provided passwords do not match.");
		} else if (registrant.acceptedTOS === false) {
			alert("Please accept the terms and conditions.");
		} else {
			$http({
				url: 'php/addbook.php',
				method: "GET", 
				params: {
					title: registrant.title, 
					isbn: registrant.isbn, 
					author: registrant.author, 
					publisher: registrant.publisher, 
					edition: registrant.edition
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