<?php
session_start();

$servername = "localhost";
$username   = "admin";
$password   = "admin";
$dbname     = "proyecto";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$currentUser = $_SESSION['user'];

$stmt = $conn->prepare("UPDATE tags SET name = ?, color = ?, details = ? WHERE id = ? AND Username = ?");
if($stmt){
    $id = intval($_POST['idA']);
    $stmt->bind_param("sssss", $_POST['nameA'], $_POST['colorA'], $_POST['detailsA'], $id, $currentUser);
    $stmt->execute();
    if($stmt->affected_rows > 0){
        $stmt->close();
        $conn->close();
        header("Location: Tag_update.php?updated=1");
    } else {
        $stmt->close();
        $conn->close();
        header("Location: Tag_update.php?error=notfound");
    }
    exit();
}

$conn->close();
?>
