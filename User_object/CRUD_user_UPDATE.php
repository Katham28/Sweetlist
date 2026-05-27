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

$stmt = $conn->prepare("UPDATE users SET Name=?, Second_Name=?, First_Last_Name=?, Second_Last_Name=?, Birthday=?, Color=?, Gender=?, Style=?, Default_list=?, Default_tag=?, Motivational_phrase=? WHERE Username=?");
if($stmt){
    $defaultList = intval($_POST['defaultListA']);
    $defaultTag  = intval($_POST['defaultTagA']);

    $stmt->bind_param("ssssssssiiss",
        $_POST['nameA'],
        $_POST['secondNameA'],
        $_POST['firstLastNameA'],
        $_POST['secondLastNameA'],
        $_POST['birthDayA'],
        $_POST['colorA'],
        $_POST['genderA'],
        $_POST['styleA'],
        $defaultList,
        $defaultTag,
        $_POST['phraseA'],
        $_POST['usernameA']
    );
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("Location: User_update.php?updated=1");
    exit();
}

$conn->close();
?>
