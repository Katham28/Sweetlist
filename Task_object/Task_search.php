<?php
session_start();
if(!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: ../Main page.php"); exit;
}
?>
<!doctype html>
<html ng-app="TaskSearchApp">
<head>
    <title>Search Task</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../p1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.3/angular.min.js"></script>
</head>
<body ng-controller="TaskSearchCtrl">

<nav class="navbar navbar-expand-sm girly-navbar fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="Task_menu.php">Back</a>
    </div>
</nav>

<div id="container">

    <div id="banner"><h1>Search Task</h1></div>

    <div class="p-3 girly-fields">
        Title:
        <input type="text" ng-model="searchValue" class="form-control" placeholder="Search by title..." ng-keypress="onEnter($event)">
        <button class="button d-block mx-auto mt-3" ng-click="search()">SEARCH</button>
    </div>

    <div id="mini_banner"><h1>Results</h1></div>

    <div class="p-3 girly-fields">

        <p class="text-muted text-center" ng-if="searched && results.length === 0">No results found.</p>

        <div ng-repeat="task in results"
             class="border rounded p-3 mb-2"
             style="background:#fff5f8;">
            <div class="d-flex align-items-center gap-2">
                <span ng-if="task.is_checked == 1">✅</span>
                <span ng-if="task.is_checked == 0">⬜</span>
                <strong>{{ task.tittle }}</strong>
                <span class="badge ms-auto" style="background:#ff4f8b;">{{ task.tag }}</span>
                <span class="badge" style="background:#c084fc;">{{ task.list }}</span>
            </div>
            <p class="mb-0 mt-1 text-muted" ng-if="task.description">{{ task.description }}</p>
            <small class="text-muted" ng-if="task.due_date">{{ task.due_date }}</small>
        </div>

    </div>

</div>

<script>
angular.module('TaskSearchApp', [])
.controller('TaskSearchCtrl', ['$scope', '$http', function($scope, $http) {
    $scope.results  = [];
    $scope.searched = false;

    $scope.search = function() {
        $http({
            method: 'POST',
            url: 'CRUD_task_Search.php',
            data: 'tittleA=' + encodeURIComponent($scope.searchValue || ''),
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
