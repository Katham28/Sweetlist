<?php

session_start();

$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "proyecto";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Validate POST
if(isset($_POST["usernameA"]) && isset($_POST["passwordA"])){

  $Username = $_POST["usernameA"];
  $Password = $_POST["passwordA"]; 

  // SQL query
  $sql = "SELECT Username, Password FROM users WHERE Username=?";

  if($stmt = $conn->prepare($sql)) {

    $stmt->bind_param("s", $Username);

    if($stmt->execute()){
      $result = $stmt->get_result();

      if($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $hashed_password = $row['Password'];

        if(password_verify($Password, $hashed_password)){

          $_SESSION['user'] = $row['Username'];
          $_SESSION['authenticated'] = true;
		  $_SESSION['LoginError'] = false;

          header("Location: 2026_main.php");
          exit();

        } else {
          header("Location: Pantalla de inicio.php");
		  		  $_SESSION['LoginError'] = true;
          exit();
        }

      } else {
		  		  $_SESSION['LoginError'] = true;
        header("Location: Pantalla de inicio.php");
        exit();
      }
    }
  }

} else {
  echo "Datos no enviados";
}

$stmt->close();
$conn->close();

?>