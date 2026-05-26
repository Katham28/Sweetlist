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

$currentUser = $_SESSION['user'];

$stmt = $conn->prepare("DELETE FROM tasks WHERE tittle = ? AND Username = ?");
if($stmt){
    $stmt->bind_param("ss", $_POST['tittleA'], $currentUser);
    $stmt->execute();
    if($stmt->affected_rows > 0){
        $stmt->close();
        $conn->close();
        header("Location: Task_delete.php?deleted=1");
    } else {
        $stmt->close();
        $conn->close();
        header("Location: Task_delete.php?error=notfound");
    }
    exit();
}

$conn->close();
?>
