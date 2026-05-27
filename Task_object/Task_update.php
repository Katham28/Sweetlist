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

$currentUser = $_SESSION['user'];
$task = null;

$tags = [];
$res = $conn->query("SELECT name FROM tags WHERE Username = '$currentUser'");
while($row = $res->fetch_assoc()) $tags[] = $row['name'];

$lists = [];
$res = $conn->query("SELECT name FROM lists WHERE Username = '$currentUser'");
while($row = $res->fetch_assoc()) $lists[] = $row['name'];

if(isset($_GET['tittle'])){
    $stmt = $conn->prepare("SELECT id, tittle, description, due_date, tag, list, is_checked FROM tasks WHERE tittle = ? AND Username = ?");
    $stmt->bind_param("ss", $_GET['tittle'], $currentUser);
    $stmt->execute();
    $task = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}
$conn->close();
?>
<!doctype html>
<html>
<head>
    <title>Update Task</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../p1.css">
</head>
<body>

<nav class="navbar navbar-expand-sm girly-navbar fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="Task_menu.php">Back</a>
    </div>
</nav>

<div id="container">

    <div id="banner"><h1>Update Task</h1></div>

    <?php if(isset($_GET['updated']) && $_GET['updated'] == 1): ?>
        <div class="girly-alert">Task updated successfully!</div>
    <?php endif; ?>

    <?php if(isset($_GET['error']) && $_GET['error'] == 'notfound'): ?>
        <div class="girly-alert" style="background: linear-gradient(45deg, #ff4f4f, #cc0000);">Task not found!</div>
    <?php endif; ?>

    <div class="p-3 girly-fields mb-3">
        <form method="GET" action="Task_update.php">
            Search by title:
            <input type="text" name="tittle" class="form-control" value="<?php echo isset($_GET['tittle']) ? htmlspecialchars($_GET['tittle']) : ''; ?>" required>
            <button type="submit" class="button d-block mx-auto mt-3">SEARCH</button>
        </form>
    </div>

    <?php if($task): ?>
    <div class="p-3 girly-fields">
        <form action="CRUD_ltask_UPDATE.php" method="POST">
            <input type="hidden" name="idA" value="<?php echo $task['id']; ?>">

            Title:
            <input type="text" name="tittleA" class="form-control" value="<?php echo htmlspecialchars($task['tittle']); ?>" required>

            Description:
            <input type="text" name="descriptionA" class="form-control" value="<?php echo htmlspecialchars($task['description']); ?>">

            Due Date:
            <input type="date" name="due_dateA" class="form-control" value="<?php echo htmlspecialchars($task['due_date']); ?>">

            Tag:
            <select name="tagA" class="form-control">
                <?php foreach($tags as $tag): ?>
                    <option value="<?php echo htmlspecialchars($tag); ?>" <?php if($task['tag'] === $tag) echo 'selected'; ?>><?php echo htmlspecialchars($tag); ?></option>
                <?php endforeach; ?>
            </select>

            List:
            <select name="listA" class="form-control">
                <?php foreach($lists as $list): ?>
                    <option value="<?php echo htmlspecialchars($list); ?>" <?php if($task['list'] === $list) echo 'selected'; ?>><?php echo htmlspecialchars($list); ?></option>
                <?php endforeach; ?>
            </select>

            Done:
            <select name="is_checkedA" class="form-control">
                <option value="0" <?php if(!$task['is_checked']) echo 'selected'; ?>>No</option>
                <option value="1" <?php if($task['is_checked']) echo 'selected'; ?>>Yes</option>
            </select>

            <button type="submit" class="button d-block mx-auto mt-3">UPDATE</button>
        </form>
    </div>
    <?php elseif(isset($_GET['tittle'])): ?>
        <p class="text-center text-muted">Task not found.</p>
    <?php endif; ?>

</div>
</body>
</html>
