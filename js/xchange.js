/**
 *	Controller management class.
 *	Last edit date: 14.05.2016
 *
 *	Purpose: Manage controllers and share variables between them.
 */

var app = angular.module("bookXChange", []);

// allows sharing properties between controllers.
app.service("sharedProperties", function () {
	var user = {
		'authenticated': false
	};

	return {
		getUser: function () {
			return user;
		}
		, setUser: function (value) {
			user = value;
		}
	}
});

// handles user related management, logging in and out, loading the user from local storage, etc.
app.controller("userController", function ($scope, $http, $location, sharedProperties) {


	$scope.user = sharedProperties.getUser();
	$scope.setUser = function (newUser) {
		$scope.user = newUser;
		sharedProperties.setUser(newUser);
	};

	$scope.init = function () {
		$scope.loadUserInfo();
	};

	$scope.loadUserInfo = function () {
		var savedUser = localStorage.getItem('useraccount');
		if (savedUser) {
			$scope.setUser(JSON.parse(savedUser));
		}
	};

	$scope.completeLogin = function (newUser) {
		$scope.setUser(newUser);
		localStorage.setItem('useraccount', JSON.stringify($scope.user));
	}

	$scope.performLogout = function () {
		$scope.setUser({
			'authenticated': false
		});
		window.location.replace('index.html');
		localStorage.setItem('useraccount', null);
	};

	$scope.registerUser = function (registrant) {
		var user = $scope.user;
		if (registrant.password !== registrant.passwordConfirm) {
			alert("The provided passwords do not match.");
		} else if (registrant.acceptedTOS === false) {
			alert("Please accept the terms and conditions.");
		} else {
			// Simple GET request example:
			$http({
				url: 'php/register.php'
				, method: "GET"
				, params: {
					fname: registrant.fname
					, lname: registrant.lname
					, email: registrant.email
					, studid: registrant.studentID
					, phone: registrant.phone
					, password: registrant.password
					, repeatPassword: registrant.passwordConfirm
				}
			}).then(function successCallback(response) {
				var data = response.data;
				if (data.result === "ok") {
					$scope.completeLogin(data.user);
				}
			}, function errorCallback(response) {
				console.log(response);
			});
		}
		user.authenticated = true;
	};
	
	$scope.loginError = '';

	$scope.loginUser = function (login) {
		if (!login.id) {
			$scope.loginError = 'Please enter an email address.';
			$scope.showLoginError = true;
		} else if (!login.password) {
			$scope.loginError = 'Please enter a password.';
			$scope.showLoginError = true;
		} else {
			$http({
				url: 'php/login.php',
				method: "POST",
				params: {
					studid: login.id,
					password: login.password
				}
			}).then(function successCallback(response) {
				var data = response.data;
				if (data.result === "ok") {
					$scope.showLoginError = false;
					$scope.completeLogin(data.user);
					window.location.replace('index.html');
				} else {
					$scope.showLoginError = true;
					$scope.loginError = 'Invalid email or password.';
				}
			}, function errorCallback(response) {
				console.log(response);
			});
		}
	};

	
	$scope.getFullname = function () {
		var user = $scope.user;
		var fn = user.firstname;
		var ln = user.surname;
		return fn + " " + ln;
	};

	$scope.init();

});

/**
 * @brief Book controller handles book related functionality – used in sell.html.
 */
app.controller("bookController", function ($scope, $http, $location, $controller, sharedProperties, $timeout) {
	
	$scope.conditions = [{
	id: -1
	, name: 'Please Select...'
	}, {
	id: 1
	, name: 'Very Good'
	}, {
	id: 2
	, name: 'Good'
	}, {
	id: 3
	, name: 'Average'
	}, {
	id: 4
	, name: 'Poor'
	}, {
	id: 5
	, name: 'Very Poor'
	}];
	
	$scope.user = sharedProperties.getUser;
	
	/**
	 * @brief Sets the listing error, which will be displayed on the sell.html page.
	 */
	$scope.setListingError = function(error){
		$scope.showListingError = true;
		$scope.showListingSuccess = false;
		$scope.listingMessage = error;
	}
	
	/**
	 * @brief Sets the listing success message, which will be displayed on the sell.html page. This cancels out previous error messages.
	 */
	$scope.setListingSuccess = function(success){
		$scope.showListingError = false;
		$scope.showListingSuccess = true;
		$scope.listingMessage = success;
	}

	/**
	* @brief Adds an exchange and optionally a book to the database.
	* @param [in] hashmap book The book object (JSON) to be added to the book database.
	*/
	$scope.addBook = function (book) {
		var user = sharedProperties.getUser();
		if (!book.title){
			$scope.setListingError("Please enter a title.");
		}else if(!book.publisher){
			$scope.setListingError("Please enter a publisher.");
		}else if(!book.author){
			$scope.setListingError("Please enter an author.");
		}else if(!book.edition){
			$scope.setListingError("Please enter an edition number.");
		}else if(!book.isbn){
			$scope.setListingError("Please enter an ISBN.");
		}else if(!book.condition || book.condition === $scope.conditions[0]){
			// Book condition must exist and must not be 'Please select...'.
			$scope.setListingError("Please select a condition.");
		}else if(!user.uuid){
			$scope.setListingError("Authorisation error.");
			window.location.replace('login.html');
		}else{
			$http({
				url: 'php/addbook.php',
				 method: "GET",
				 params: {
					title: book.title,
					isbn: book.isbn,
					author: book.author,
					publisher: book.publisher,
					edition: book.edition,
					uuid: user.uuid
				}
			}).then(function successCallback(response) {
				var data = response.data;
				if (data.result === "ok") {
					$scope.setListingSuccess(data.message);
					// redirect the user to the index page. Their listing was added.
					// Allow them time to read the success message (one second).
					$timeout(function () {
						window.location.replace('index.html');
					}, 1000);
				} else {
					$scope.setListingError(data.message);
				}
			}, function errorCallback(response) {
				if (response.data.message){
					$scope.setListingError(data.message);
				}else{
					// We couldn't communicate with the PHP backend, the server is experiencing troubles.
					$scope.setListingError("An internal server error occurred. Please try again.");
				}
			});
		}
	};

});

/**
 * @brief Handles book search functionality.
 */
app.controller("searchController", function ($scope, $http, $location, $controller, sharedProperties, $timeout) {
	
	$scope.searchResults = null;
	$scope.searchedTerm = null;
	
	/**
	 * @brief Some brief description.
	 * @param [query] The term that is to be searched.
	 * @return An array of books in JSON format, books have an additional mapping known as 'xchanges' which has listings for each book..
	 */
	$scope.searchBooks = function(query){
		// the last searched term is stored so it can be referenced on the search page.
		$scope.searchedTerm = query;
		$http({
				url: 'php/search.php',
				method: "GET",
				params: {
					query: query
				}
			}).then(function successCallback(response) {
				var data = response.data;
				if (data.result === "ok") {
					$scope.searchResults = data.search_results;
				} else {
					// clear search results, this way the user knows the search went through.
					$scope.searchResults = null;
				}
			}, function errorCallback(response) {
				console.log(response);
			});
	}

});