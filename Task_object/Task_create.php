<?php
if(session_status() === PHP_SESSION_NONE) session_start();

// Si se accede directamente (no incluido), fetches propios
if(!isset($tags) || !isset($lists)){
    $servername = "localhost";
    $username   = "admin";
    $password   = "admin";
    $dbname     = "proyecto";
    $conn_tc = new mysqli($servername, $username, $password, $dbname);
    $currentUser = $_SESSION['user'];

    $tags = [];
    $res = $conn_tc->query("SELECT name FROM tags WHERE Username = '$currentUser'");
    while($row = $res->fetch_assoc()) $tags[] = ['name' => $row['name']];

    $lists = [];
    $res = $conn_tc->query("SELECT name FROM lists WHERE Username = '$currentUser'");
    while($row = $res->fetch_assoc()) $lists[] = ['name' => $row['name']];

    $conn_tc->close();
    $standalone = true;
}

$formAction = isset($standalone) ? 'CRUD_task_CREATE.php' : 'Task_object/CRUD_task_CREATE.php';
?>

<?php if(isset($standalone)): ?>
<!doctype html>
<html>
<head>
    <title>Create Task</title>
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
    <div id="banner"><h1>Create Task</h1></div>
    <?php if(isset($_GET['created']) && $_GET['created'] == 1): ?>
        <div class="girly-alert">Task created successfully!</div>
    <?php endif; ?>
<?php endif; ?>

<form action="<?php echo $formAction; ?>" method="POST">
    <?php if(!isset($standalone)): ?>
        <input type="hidden" name="from" value="main">
    <?php endif; ?>
    <div class="p-3 girly-fields">

        Title:
        <input type="text" name="tittleA" class="form-control" required>

        Description:
        <input type="text" name="descriptionA" class="form-control">

        Due Date:
        <input type="date" name="due_dateA" class="form-control">

        Tag:
        <select name="tagA" class="form-control">
            <option value="">— No tag —</option>
            <?php foreach($tags as $tag): ?>
                <option value="<?php echo htmlspecialchars($tag['name']); ?>"><?php echo htmlspecialchars($tag['name']); ?></option>
            <?php endforeach; ?>
        </select>

        List:
        <select name="listA" class="form-control">
            <option value="">— No list —</option>
            <?php foreach($lists as $list): ?>
                <option value="<?php echo htmlspecialchars($list['name']); ?>"><?php echo htmlspecialchars($list['name']); ?></option>
            <?php endforeach; ?>
        </select>

    </div>
    <button type="submit" class="button d-block mx-auto mt-3">SUBMIT</button>
</form>

<?php if(isset($standalone)): ?>
</div>
</body>
</html>
<?php endif; ?>
