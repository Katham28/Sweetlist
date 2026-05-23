<?php
session_start();

if(!isset($_SESSION["authenticated"]) || !$_SESSION["authenticated"]){
    http_response_code(403);
    exit;
}

$servername = "localhost";
$username   = "admin";
$password   = "admin";
$dbname     = "proyecto";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    http_response_code(500);
    exit;
}

$id         = intval($_POST["id"]);
$is_checked = intval($_POST["is_checked"]);

$stmt = $conn->prepare("UPDATE tasks SET is_checked = ? WHERE id = ? AND Username = ?");
if($stmt){
    $stmt->bind_param("iis", $is_checked, $id, $_SESSION["user"]);
    $stmt->execute();
    $stmt->close();
    echo "ok";
} else {
    http_response_code(500);
}

$conn->close();
?>
