<?php
if($result = $conn->query("SELECT name, color, details FROM tags WHERE Username = '" . $_SESSION['user'] . "'")){
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo "<tr>
                    <td><div style='width:25px;height:25px;border-radius:50%;background-color:" . htmlspecialchars($row['color']) . ";'></div></td>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . htmlspecialchars($row['details']) . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3' class='text-center text-muted'>No hay tags</td></tr>";
    }
}
?>
