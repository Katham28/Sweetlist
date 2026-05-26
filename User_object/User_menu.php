<?php
session_start();

if(!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: ../Pantalla de inicio.php"); exit;
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
    <title>My Profile</title>
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
                    <a class="nav-link" href="#" onclick="window.location.href='../Menu%20principal.php'">Main Menu</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="container">

    <div id="banner">
        <h1>My Profile</h1>
    </div>

    <?php if(isset($_GET['updated']) && $_GET['updated'] == 1): ?>
        <div class="girly-alert">Profile updated successfully!</div>
    <?php endif; ?>

    <div class="d-flex flex-wrap gap-3 justify-content-center mb-4">
        <button class="button" onclick="showSection('s_report')">My Data</button>
        <button class="button" onclick="window.location.href='User_update.php'">Update Profile</button>
        <button class="button" onclick="window.location.href='User_calendar.php'">Calendar</button>
        <button class="button" onclick="window.location.href='User_delete.php'">Delete Account</button>
    </div>

    <div id="s_report">
        <div id="mini_banner"><h1>My Data</h1></div>
        <?php include 'User_report.php'; ?>
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

<script>
function showSection(id) {
    document.getElementById('s_report').style.display = 'none';
    document.getElementById(id).style.display = 'block';
}
</script>

</body>
</html>
