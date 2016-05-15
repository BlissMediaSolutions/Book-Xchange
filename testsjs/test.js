describe('userController', function () {
	beforeEach(module('bookXChange'));

	var $controller;

	beforeEach(inject(function (_$controller_) {
		// The injector unwraps the underscores (_) from around the parameter names when matching
		$controller = _$controller_;
	}));

	describe('Login and out', function () {
		it('It logs the user in and ensures the user profile was saved to local storage.', function () {
			var $scope = {};
			var controller = $controller('userController', {
				$scope: $scope
			});
			
			$scope.performLogout();
			
			expect(localStorage.getItem('useraccount')).toEqual('null');
			
			var user = {
				"firstname": "John",
				"surname": "Smith",
				"email": "1111111@student.swin.edu.au",
				"studentID": "1111111",
				"telephone": "0412341234",
				"uuid": "00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000",
				"authenticated": true
			}
			$scope.completeLogin(user);
			
			expect(JSON.parse(localStorage.getItem('useraccount'))).toEqual(user);
			
			$scope.loadUserInfo;
		});
	});
});

describe('sharedProperties', function () {
	beforeEach(module('bookXChange'));

	var $controller;

	beforeEach(inject(function (_$controller_) {
		// The injector unwraps the underscores (_) from around the parameter names when matching
		$controller = _$controller_;
	}));
});