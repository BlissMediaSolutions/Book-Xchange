describe('userController', function () {
	beforeEach(module('bookXChange'));

	var $controller;
	beforeEach(inject(function (_$controller_) {
		// The injector unwraps the underscores (_) from around the parameter names when matching
		$controller = _$controller_;
	}));

	var $scope = {};


	//create a demo user.
	var user = {
		"firstname": "John",
		"surname": "Smith",
		"email": "1111111@student.swin.edu.au",
		"studentID": "1111111",
		"telephone": "0412341234",
		"uuid": "00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000",
		"authenticated": true
	}

	describe('User management', function () {
		it('Logs the user out and then ensures that local storage hasn\'t stored a login', function () {
				var controller = $controller('userController', {
					$scope: $scope
				});

				//ensure we're logged out.
				$scope.performLogout();

				//ensure that logout makes useraccount null
				expect(localStorage.getItem('useraccount')).toEqual('null');
			}),
			it('It logs the user in and ensures the user profile was saved to local storage.', function () {

				var controller = $controller('userController', {
					$scope: $scope
				});

				//login with demo user.
				$scope.completeLogin(user);

				//get the local storage item, test that it is a user account and is equal to user
				expect(JSON.parse(localStorage.getItem('useraccount'))).toEqual(user);

				$scope.loadUserInfo;

			}),
			it('Tests that full name client-side generation works.', function () {
				var controller = $controller('userController', {
					$scope: $scope
				});

				$scope.completeLogin(user);

				expect($scope.getFullname()).toEqual('John Smith');
			})
	});
});