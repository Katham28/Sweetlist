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

$search = "%" . $_POST['usernameA'] . "%";
$results = [];

$stmt = $conn->prepare("SELECT Username, Name, Second_Name, First_Last_Name, Second_Last_Name, Birthday, Gender, Style, Motivational_phrase FROM users WHERE Username LIKE ?");
if($stmt){
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()) $results[] = $row;
    $stmt->close();
}

$conn->close();
echo json_encode($results);
?>
