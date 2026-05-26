<?php
session_start();

if(!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    echo json_encode([]); exit;
}

header('Content-Type: application/json');

$servername = "localhost";
$username   = "admin";
$password   = "admin";
$dbname     = "proyecto";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) { echo json_encode([]); exit; }

$currentUser = $_SESSION['user'];
$name = "%" . $_POST['nameA'] . "%";
$results = [];

$stmt = $conn->prepare("SELECT name, icon, notes FROM lists WHERE name LIKE ? AND Username = ?");
if($stmt){
    $stmt->bind_param("ss", $name, $currentUser);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()) $results[] = $row;
    $stmt->close();
}

$conn->close();
echo json_encode($results);
?>
