<?php
session_start();

$servername = "localhost";
$username   = "admin";
$password   = "admin";
$dbname     = "proyecto";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$search = "%" . $_POST['usernameA'] . "%";

$stmt = $conn->prepare("SELECT Username, Name, Second_Name, First_Last_Name, Second_Last_Name, Birthday, Gender, Style, Motivational_phrase FROM users WHERE Username LIKE ?");
if($stmt){
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
        echo "<tr>
                <td>" . htmlspecialchars($row['Username']) . "</td>
                <td>" . htmlspecialchars($row['Name'] . ' ' . $row['Second_Name']) . "</td>
                <td>" . htmlspecialchars($row['First_Last_Name'] . ' ' . $row['Second_Last_Name']) . "</td>
                <td>" . htmlspecialchars($row['Birthday']) . "</td>
                <td>" . htmlspecialchars($row['Gender']) . "</td>
                <td>" . htmlspecialchars($row['Style']) . "</td>
                <td>" . htmlspecialchars($row['Motivational_phrase']) . "</td>
              </tr>";
    }
    $stmt->close();
}

$conn->close();
?>
