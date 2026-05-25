<?php
if($result = $conn->query("SELECT tittle, description, due_date, tag, list, is_checked FROM tasks WHERE Username = '" . $_SESSION['user'] . "'")){
    if($result->num_rows > 0){
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
    } else {
        echo "<tr><td colspan='6' class='text-center text-muted'>No hay tasks</td></tr>";
    }
}
?>
