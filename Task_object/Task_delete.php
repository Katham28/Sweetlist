<?php session_start(); ?>
<!doctype html>
<html>
<head>
    <title>Delete Task</title>
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

    <div id="banner"><h1>Delete Task</h1></div>

    <?php if(isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
        <div class="girly-alert">Task deleted successfully!</div>
    <?php endif; ?>

    <?php if(isset($_GET['error']) && $_GET['error'] == 'notfound'): ?>
        <div class="girly-alert" style="background: linear-gradient(45deg, #ff4f4f, #cc0000);">Task not found!</div>
    <?php endif; ?>

    <div class="p-3 girly-fields">
        <form action="CRUD_task_DELETE.php" method="POST">
            Title:
            <input type="text" name="tittleA" class="form-control" required>
            <button type="submit" class="button d-block mx-auto mt-3">DELETE</button>
        </form>
    </div>

</div>
</body>
</html>
