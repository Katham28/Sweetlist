<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "proyecto";

// Conexión
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$sql = "SELECT * FROM users"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        echo "<tr>
                <td>{$row["Name"]}</td>
                <td>{$row["Second_Name"]}</td>
                <td>{$row["First_Last_Name"]}</td>
                <td>{$row["Second_Last_Name"]}</td>
                <td>{$row["Birthday"]}</td>
				<td>{$row["Color"]}</td>

                <td>{$row["Gender"]}</td>
                <td>{$row["Username"]}</td>
                <td>{$row["Style"]}</td>
                <td>" . ($row["Default_list"] == 1 ? "Yes" : "No") . "</td>
                <td>" . ($row["Default_tag"] == 1 ? "Yes" : "No") . "</td>
                <td>{$row["Motivational_phrase"]}</td>
              </tr>";
    }
}

$conn->close();
?>