<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "proyecto";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$currentUser = $_SESSION['user'];

$lists = [];
$stmtLists = $conn->prepare("SELECT name, icon FROM lists WHERE Username = ?");
if($stmtLists){
    $stmtLists->bind_param("s", $currentUser);
    $stmtLists->execute();
    $resultLists = $stmtLists->get_result();
    while($row = $resultLists->fetch_assoc()){
        $lists[] = $row;
    }
    $stmtLists->close();
}

$tags = [];
$stmtTags = $conn->prepare("SELECT name, color FROM tags WHERE Username = ?");
if($stmtTags){
    $stmtTags->bind_param("s", $currentUser);
    $stmtTags->execute();
    $resultTags = $stmtTags->get_result();
    while($row = $resultTags->fetch_assoc()){
        $tags[] = $row;
    }
    $stmtTags->close();
}

$tasks = [];
$stmtTasks = $conn->prepare("SELECT id, tittle, tag, list, description, due_date, is_checked FROM tasks WHERE Username = ?");
if($stmtTasks){
    $stmtTasks->bind_param("s", $currentUser);
    $stmtTasks->execute();
    $resultTasks = $stmtTasks->get_result();
    while($row = $resultTasks->fetch_assoc()){
        $tasks[] = $row;
    }
    $stmtTasks->close();
}

$conn->close();
?>
