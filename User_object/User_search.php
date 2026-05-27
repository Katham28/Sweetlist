<?php
session_start();
if(!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: ../Main page.php"); exit;
}
?>
<!doctype html>
<html ng-app="UserSearchApp">
<head>
    <title>Search User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../p1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.3/angular.min.js"></script>
</head>
<body ng-controller="UserSearchCtrl">

<nav class="navbar navbar-expand-sm girly-navbar fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="User_menu.php">Back</a>
    </div>
</nav>

<div id="container">

    <div id="banner"><h1>Search User</h1></div>

    <div class="p-3 girly-fields">
        Username:
        <input type="text" ng-model="searchValue" class="form-control" placeholder="Search by username..." ng-keypress="onEnter($event)">
        <button class="button d-block mx-auto mt-3" ng-click="search()">SEARCH</button>
    </div>

    <div id="mini_banner"><h1>Results</h1></div>

    <div class="p-3 girly-fields">

        <p class="text-muted text-center" ng-if="searched && results.length === 0">No results found.</p>

        <div ng-repeat="user in results"
             class="border rounded p-3 mb-2"
             style="background:#fff5f8;">
            <div class="d-flex align-items-center gap-2 mb-1">
                <strong>@{{ user.Username }}</strong>
                <span class="badge ms-auto" style="background:#ff4f8b;">{{ user.Gender }}</span>
                <span class="badge" style="background:#c084fc;">{{ user.Style }}</span>
            </div>
            <div>{{ user.Name }} {{ user.Second_Name }} {{ user.First_Last_Name }} {{ user.Second_Last_Name }}</div>
            <small class="text-muted">{{ user.Birthday }}</small>
            <p class="mb-0 fst-italic text-muted" ng-if="user.Motivational_phrase">"{{ user.Motivational_phrase }}"</p>
        </div>

    </div>

</div>

<script>
angular.module('UserSearchApp', [])
.controller('UserSearchCtrl', ['$scope', '$http', function($scope, $http) {
    $scope.results  = [];
    $scope.searched = false;

    $scope.search = function() {
        $http({
            method: 'POST',
            url: 'CRUD_user_Search.php',
            data: 'usernameA=' + encodeURIComponent($scope.searchValue || ''),
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        }).then(function(response) {
            $scope.results  = response.data;
            $scope.searched = true;
        });
    };

    $scope.onEnter = function($event) {
        if($event.keyCode === 13) $scope.search();
    };
}]);
</script>

</body>
</html>
