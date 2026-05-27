<?php
session_start();
if(!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: ../Main page.php"); exit;
}
?>
<!doctype html>
<html ng-app="TagSearchApp">
<head>
    <title>Search Tag</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../p1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.3/angular.min.js"></script>
</head>
<body ng-controller="TagSearchCtrl">

<nav class="navbar navbar-expand-sm girly-navbar fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="Tag_menu.php">Back</a>
    </div>
</nav>

<div id="container">

    <div id="banner"><h1>Search Tag</h1></div>

    <div class="p-3 girly-fields">
        Name:
        <input type="text" ng-model="searchValue" class="form-control" placeholder="Search by name..." ng-keypress="onEnter($event)">
        <button class="button d-block mx-auto mt-3" ng-click="search()">SEARCH</button>
    </div>

    <div id="mini_banner"><h1>Results</h1></div>

    <div class="p-3 girly-fields">

        <p class="text-muted text-center" ng-if="searched && results.length === 0">No results found.</p>

        <div ng-repeat="tag in results"
             class="border rounded p-3 mb-2 d-flex align-items-center gap-3"
             style="background:#fff5f8;">
            <div style="width:30px;height:30px;border-radius:50%;flex-shrink:0;"
                 ng-style="{'background-color': tag.color}"></div>
            <div>
                <strong>{{ tag.name }}</strong>
                <p class="mb-0 text-muted" ng-if="tag.details">{{ tag.details }}</p>
            </div>
            <span class="ms-auto badge" ng-style="{'background-color': tag.color}">{{ tag.color }}</span>
        </div>

    </div>

</div>

<script>
angular.module('TagSearchApp', [])
.controller('TagSearchCtrl', ['$scope', '$http', function($scope, $http) {
    $scope.results  = [];
    $scope.searched = false;

    $scope.search = function() {
        $http({
            method: 'POST',
            url: 'CRUD_tag_Search.php',
            data: 'nameA=' + encodeURIComponent($scope.searchValue || ''),
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
