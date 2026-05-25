<?php
if($result = $conn->query("SELECT name, icon, notes FROM lists WHERE Username = '" . $_SESSION['user'] . "'")){
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo "<tr>
                    <td>" . htmlspecialchars($row['icon']) . "</td>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . htmlspecialchars($row['notes']) . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3' class='text-center text-muted'>No hay listas</td></tr>";
    }
}
?>
