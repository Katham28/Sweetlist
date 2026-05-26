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

$check = $conn->prepare("SELECT id FROM lists WHERE name = ? AND Username = ?");
$check->bind_param("ss", $_POST['nameA'], $currentUser);
$check->execute();
$check->store_result();
if($check->num_rows > 0){
    $check->close();
    $conn->close();
    header("Location: List_create.php?error=name");
    exit();
}
$check->close();

$stmt = $conn->prepare("INSERT INTO lists (Username, icon, notes, name) VALUES (?, ?, ?, ?)");
if($stmt){
    $stmt->bind_param("ssss", $currentUser, $_POST['iconA'], $_POST['notesA'], $_POST['nameA']);
    if($stmt->execute()){
        $stmt->close();
        $conn->close();
        header("Location: List_create.php?created=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
