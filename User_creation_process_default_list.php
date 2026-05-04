<?php
$sqlLists = "INSERT INTO lists (Username, icon, notes, name)
             SELECT ?, icon, notes, name FROM lists WHERE Username = 'default'";
if($stmtLists = $conn->prepare($sqlLists)){
    $stmtLists->bind_param("s", $Username);
    $stmtLists->execute();
    $stmtLists->close();
}
?>
