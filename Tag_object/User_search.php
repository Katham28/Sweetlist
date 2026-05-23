<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "proyecto";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$Field = $_POST["FieldS"];
$Value = $_POST["Value"];

switch($Field)
{
    case "Username":
        $stmt = $conn->prepare("SELECT Name, Second_Name, First_Last_Name, Second_Last_Name, Birthday, Color, Gender, Username, Style, Default_list, Default_tag, Motivational_phrase 
        FROM users 
        WHERE Username = ?");
        $stmt->bind_param("s", $Value);
    break;

    case "Name":
        $stmt = $conn->prepare("SELECT Name, Second_Name, First_Last_Name, Second_Last_Name, Birthday, Color, Gender, Username, Style, Default_list, Default_tag, Motivational_phrase 
        FROM users 
        WHERE Name = ?");
        $stmt->bind_param("s", $Value);
    break;

    case "First_Last_Name":
        $stmt = $conn->prepare("SELECT Name, Second_Name, First_Last_Name, Second_Last_Name, Birthday, Color, Gender, Username, Style, Default_list, Default_tag, Motivational_phrase 
        FROM users 
        WHERE First_Last_Name = ?");
        $stmt->bind_param("s", $Value);
    break;

    default:
        die("Campo inválido");
}

if($stmt->execute()){
    $result = $stmt->get_result();

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

    } else {
        echo "";
    }

} else {
    echo "Error executing query";
}

$stmt->close();
$conn->close();
?>