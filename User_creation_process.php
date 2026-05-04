<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "proyecto";

// Conexión
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO users 
(Name, Second_Name, First_Last_Name, Second_Last_Name, Birthday, Color, Gender, Username, Password, Style, Default_list, Default_tag, Motivational_phrase) 
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";

if($stmt = $conn->prepare($sql)) {

    $Name = $_POST["nameA"];
    $Second_Name = $_POST["secondNameA"];
    $First_Last_Name = $_POST["firstLastNameA"];
    $Second_Last_Name = $_POST["secondLastNameA"];
    $Birthday = $_POST["birthDayA"];
    $Color = $_POST["colorA"];
    $Gender = $_POST["genderA"];
    
    if($Gender === "OTHER"){
        $Gender = !empty($_POST["otherGender"]) ? $_POST["otherGender"] : "OTHER";
    }
    $Username = $_POST["usernameA"];
    $Password = password_hash($_POST["passwordA"],PASSWORD_ARGON2ID);
    $Style = $_POST["styleA"];
    $Default_list = isset($_POST["defaultList"]) ? 1 : 0;
    $Default_tag = isset($_POST["default_tag"]) ? 1 : 0;
    $Motivational_phrase = $_POST["phraseA"];

    $stmt->bind_param("ssssssssssiis",
        $Name,
        $Second_Name,
        $First_Last_Name,
        $Second_Last_Name,
        $Birthday,
        $Color,
        $Gender,
        $Username,
        $Password,
        $Style,
        $Default_list,
        $Default_tag,
        $Motivational_phrase
    );

    if($stmt->execute()){
        if($Default_list == 1) include 'User_creation_process_default_list.php';
        if($Default_tag == 1) include 'User_creation_process_default_tags.php';

        header("Location: CRUD_usuarios.html?created=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>