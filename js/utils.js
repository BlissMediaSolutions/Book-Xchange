var app = angular.module("statusPostApp", []);

app.controller("myCtrl", function ($scope) {

    getClass = function (path) {
        return 'active';
        return ($location.path().substr(0, path.length) === path) ? 'active' : '';
    }

});