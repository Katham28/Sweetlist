<?php
session_start();

if(!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: ../Main page.php"); exit;
}

$servername = "localhost";
$username   = "admin";
$password   = "admin";
$dbname     = "proyecto";

$conn = new mysqli($servername, $username, $password, $dbname);
?>

<!doctype html>
<html>
<head>
    <title>List Menu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../p1.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../p1.js"></script>
</head>

<body>

<nav class="navbar navbar-expand-sm girly-navbar fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#" data-bs-toggle="modal" data-bs-target="#Modal_login_out">Log out</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="window.location.href='../Main%20menu.php'">Main Menu</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="container">

    <div id="banner">
        <h1>List CRUD</h1>
    </div>

    <div class="d-flex flex-wrap gap-3 justify-content-center mb-4">
        <a href="List_create.php" class="button">Create List</a>
        <a href="List_search.php" class="button">Search List</a>
        <a href="List_update.php" class="button">Update List</a>
        <a href="List_delete.php" class="button">Delete List</a>
    </div>

    <div id="mini_page">
        <h2 class="mb-4">My Lists</h2>
        <table class="s_table">
            <thead>
                <tr>
                    <th>Icon</th>
                    <th>Name</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                <?php include 'List_report.php'; ?>
            </tbody>
        </table>
    </div>

</div>

<div class="modal fade" id="Modal_login_out">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Log out</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">Are you sure you want to log out?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="../User_log_out.php" class="btn btn-danger">Yes</a>
      </div>
    </div>
  </div>
</div>

</body>
</html>
