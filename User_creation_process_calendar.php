<?php
$sqlCalendar = "INSERT INTO calendar (start_week_day, view_preference, Username) VALUES ('Sunday', 'Month', ?)";
if($stmtCalendar = $conn->prepare($sqlCalendar)){
    $stmtCalendar->bind_param("s", $Username);
    $stmtCalendar->execute();
    $stmtCalendar->close();
}
?>
