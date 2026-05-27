<?php
session_start();

if(!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: ../Main page.php"); exit;
}

$servername = "localhost";
$username   = "admin";
$password   = "admin";
$dbname     = "proyecto";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$stmt = $conn->prepare("SELECT id, start_week_day, view_preference FROM calendar WHERE Username = ?");
$stmt->bind_param("s", $_SESSION['user']);
$stmt->execute();
$prefs = $stmt->get_result()->fetch_assoc();
$stmt->close();
$conn->close();
?>
<!doctype html>
<html>
<head>
    <title>Calendar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../p1.css">
</head>
<body>

<nav class="navbar navbar-expand-sm girly-navbar fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="User_menu.php">Back</a>
    </div>
</nav>

<div id="container">

    <div id="banner"><h1>Calendar</h1></div>

    <?php if(isset($_GET['updated']) && $_GET['updated'] == 1): ?>
        <div class="girly-alert">Calendar updated successfully!</div>
    <?php endif; ?>

    <div class="p-3 girly-fields">
        <form action="CRUD_user_calendar_UPDATE.php" method="POST">
            <?php if($prefs): ?>
                <input type="hidden" name="id" value="<?php echo $prefs['id']; ?>">
            <?php endif; ?>

            Start week day:
            <select name="start_week_day" class="form-control mb-3">
                <?php foreach(['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'] as $day): ?>
                    <option value="<?php echo $day; ?>" <?php if($prefs && $prefs['start_week_day'] === $day) echo 'selected'; ?>>
                        <?php echo $day; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            View preference:
            <select name="view_preference" class="form-control mb-3">
                <?php foreach(['Month','Week','Day'] as $view): ?>
                    <option value="<?php echo $view; ?>" <?php if($prefs && $prefs['view_preference'] === $view) echo 'selected'; ?>>
                        <?php echo $view; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="button d-block mx-auto mt-3">SAVE</button>
        </form>
    </div>

</div>
</body>
</html>
