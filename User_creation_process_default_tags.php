<?php
$sqlTags = "INSERT INTO tags (Username, color, details, name)
            SELECT ?, color, details, name FROM tags WHERE Username = 'default'";
if($stmtTags = $conn->prepare($sqlTags)){
    $stmtTags->bind_param("s", $Username);
    $stmtTags->execute();
    $stmtTags->close();
}
?>
