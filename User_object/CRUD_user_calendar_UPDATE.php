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
if($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Si ya existe registro -> UPDATE, si no -> INSERT
if(!empty($_POST['id'])){
    $stmt = $conn->prepare("UPDATE calendar SET start_week_day = ?, view_preference = ? WHERE id = ? AND Username = ?");
    $id = intval($_POST['id']);
    $stmt->bind_param("ssis", $_POST['start_week_day'], $_POST['view_preference'], $id, $_SESSION['user']);
} else {
    $stmt = $conn->prepare("INSERT INTO calendar (start_week_day, view_preference, Username) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $_POST['start_week_day'], $_POST['view_preference'], $_SESSION['user']);
}

$stmt->execute();
$stmt->close();
$conn->close();

header("Location: User_calendar.php?updated=1");
exit();
?>
