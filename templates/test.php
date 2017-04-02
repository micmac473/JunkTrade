<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.js"></script>

<body ng-app="myApp">

<p><a href="#/">Main</a></p>

<a href="#london">City 1</a>
<a href="#paris">City 2</a>

<p>Click on the links.</p>

<p>Note that each "view" has its own controller which each gives the "msg" variable a value.</p>

<div ng-view></div>

<script>
var app = angular.module("myApp", ["ngRoute"]);
app.config(function($routeProvider) {
    $routeProvider
    .when("/", {
        templateUrl : "test.htm",
    })
    .when("/items", {
        templateUrl : "items.htm",
        controller : "londonCtrl"
    })
    .when("/paris", {
        templateUrl : "users.htm",
        controller : "parisCtrl"
    });
});
app.controller("usersCtrl", function ($scope, $http) {
            var url = "../angular_php/users.php";

            $http.get(url).then( function(response) {
                console.log(response.data);
               $scope.users = response.data;
            });
});
app.controller("itemsCtrl", function ($scope, $http) {
            var url = "../angular_php/items.php";

            $http.get(url).then( function(response) {
                console.log(response.data);
               $scope.users = response.data;
            });
});

</script>

</body>
</html>