<?php
session_start();

$servername = "localhost";
$username   = "admin";
$password   = "admin";
$dbname     = "proyecto";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$currentUser = $_SESSION['user'];
$name = "%" . $_POST['nameA'] . "%";

$stmt = $conn->prepare("SELECT name, color, details FROM tags WHERE name LIKE ? AND Username = ?");
if($stmt){
    $stmt->bind_param("ss", $name, $currentUser);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
        echo "<tr>
                <td><div style='width:25px;height:25px;border-radius:50%;background-color:" . htmlspecialchars($row['color']) . ";'></div></td>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['details']) . "</td>
              </tr>";
    }
    $stmt->close();
}

$conn->close();
?>
