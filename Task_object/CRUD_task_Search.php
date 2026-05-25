<?php
session_start();

$servername = "localhost";
$username   = "admin";
$password   = "admin";
$dbname     = "proyecto";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$currentUser = $_SESSION['user'];
$tittle = "%" . $_POST['tittleA'] . "%";

$stmt = $conn->prepare("SELECT tittle, description, due_date, tag, list, is_checked FROM tasks WHERE tittle LIKE ? AND Username = ?");
if($stmt){
    $stmt->bind_param("ss", $tittle, $currentUser);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
        $checked = $row['is_checked'] ? '✅' : '⬜';
        echo "<tr>
                <td>" . $checked . "</td>
                <td>" . htmlspecialchars($row['tittle']) . "</td>
                <td>" . htmlspecialchars($row['description']) . "</td>
                <td>" . htmlspecialchars($row['due_date']) . "</td>
                <td>" . htmlspecialchars($row['tag']) . "</td>
                <td>" . htmlspecialchars($row['list']) . "</td>
              </tr>";
    }
    $stmt->close();
}

$conn->close();
?>
