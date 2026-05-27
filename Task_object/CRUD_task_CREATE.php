<?php
session_start();

if(!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: ../Main page.php"); exit;
}

$servername = "localhost";
$username   = "admin";
$password   = "admin";
$dbname     = "proyecto";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$currentUser = $_SESSION['user'];

$stmt = $conn->prepare("INSERT INTO tasks (Username, tittle, description, due_date, tag, list, is_checked) VALUES (?, ?, ?, ?, ?, ?, 0)");
if($stmt){
    $stmt->bind_param("ssssss",
        $currentUser,
        $_POST['tittleA'],
        $_POST['descriptionA'],
        $_POST['due_dateA'],
        $_POST['tagA'],
        $_POST['listA']
    );
    if($stmt->execute()){
        $stmt->close();
        $conn->close();
        if(isset($_POST['from']) && $_POST['from'] === 'main'){
            header("Location: ../Main%20menu.php?task_created=1");
        } else {
            header("Location: Task_create.php?created=1");
        }
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
