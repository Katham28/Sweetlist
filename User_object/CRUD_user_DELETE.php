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

$stmt = $conn->prepare("DELETE FROM users WHERE Username = ?");
if($stmt){
    $stmt->bind_param("s", $_POST['usernameA']);
    $stmt->execute();
    if($stmt->affected_rows > 0){
        $stmt->close();
        $conn->close();
        session_destroy();
        header("Location: ../Pantalla de inicio.php");
    } else {
        $stmt->close();
        $conn->close();
        header("Location: User_delete.php?error=notfound");
    }
    exit();
}

$conn->close();
?>
