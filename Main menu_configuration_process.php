<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "proyecto";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$currentUser = $_SESSION['user'];

$userColor = '#ff4f8b'; // default
$stmtColor = $conn->prepare("SELECT Color FROM users WHERE Username = ?");
if($stmtColor){
    $stmtColor->bind_param("s", $currentUser);
    $stmtColor->execute();
    $rowColor = $stmtColor->get_result()->fetch_assoc();
    if($rowColor) $userColor = $rowColor['Color'];
    $stmtColor->close();
}

// Calcula si el texto encima del color debe ser blanco o oscuro
function getContrastColor(string $hex): string {
    $hex = ltrim($hex, '#');
    if(strlen($hex) === 3){
        $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
    }
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    // Fórmula de luminancia percibida (YIQ)
    $luminance = ($r * 299 + $g * 587 + $b * 114) / 1000;
    return $luminance >= 128 ? '#333333' : '#ffffff';
}

$navTextColor = getContrastColor($userColor);

$lists = [];
$stmtLists = $conn->prepare("SELECT name, icon FROM lists WHERE Username = ?");
if($stmtLists){
    $stmtLists->bind_param("s", $currentUser);
    $stmtLists->execute();
    $resultLists = $stmtLists->get_result();
    while($row = $resultLists->fetch_assoc()){
        $lists[] = $row;
    }
    $stmtLists->close();
}

$tags = [];
$stmtTags = $conn->prepare("SELECT name, color FROM tags WHERE Username = ?");
if($stmtTags){
    $stmtTags->bind_param("s", $currentUser);
    $stmtTags->execute();
    $resultTags = $stmtTags->get_result();
    while($row = $resultTags->fetch_assoc()){
        $tags[] = $row;
    }
    $stmtTags->close();
}

$tasks = [];
$stmtTasks = $conn->prepare("SELECT id, tittle, tag, list, description, due_date, is_checked FROM tasks WHERE Username = ?");
if($stmtTasks){
    $stmtTasks->bind_param("s", $currentUser);
    $stmtTasks->execute();
    $resultTasks = $stmtTasks->get_result();
    while($row = $resultTasks->fetch_assoc()){
        $tasks[] = $row;
    }
    $stmtTasks->close();
}

$calendarPrefs = ['start_week_day' => 'Sunday', 'view_preference' => 'Month'];
$stmtCal = $conn->prepare("SELECT start_week_day, view_preference FROM calendar WHERE Username = ?");
if($stmtCal){
    $stmtCal->bind_param("s", $currentUser);
    $stmtCal->execute();
    $rowCal = $stmtCal->get_result()->fetch_assoc();
    if($rowCal) $calendarPrefs = $rowCal;
    $stmtCal->close();
}

// Mapeo view_preference -> FullCalendar view name
$viewMap = [
    'Month' => 'dayGridMonth',
    'Week'  => 'timeGridWeek',
    'Day'   => 'timeGridDay'
];
$calendarView = $viewMap[$calendarPrefs['view_preference']] ?? 'dayGridMonth';

// Mapeo start_week_day -> número (0=Sunday, 1=Monday, ...)
$dayMap = ['Sunday'=>0,'Monday'=>1,'Tuesday'=>2,'Wednesday'=>3,'Thursday'=>4,'Friday'=>5,'Saturday'=>6];
$calendarFirstDay = $dayMap[$calendarPrefs['start_week_day']] ?? 0;

$conn->close();
?>
