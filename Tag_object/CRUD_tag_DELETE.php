<?php
session_start();

$servername = "localhost";
$username   = "admin";
$password   = "admin";
$dbname     = "proyecto";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$currentUser = $_SESSION['user'];

$stmt = $conn->prepare("DELETE FROM tags WHERE name = ? AND Username = ?");
if($stmt){
    $stmt->bind_param("ss", $_POST['nameA'], $currentUser);
    $stmt->execute();
    if($stmt->affected_rows > 0){
        $stmt->close();
        $conn->close();
        header("Location: Tag_delete.php?deleted=1");
    } else {
        $stmt->close();
        $conn->close();
        header("Location: Tag_delete.php?error=notfound");
    }
    exit();
}

$conn->close();
?>
