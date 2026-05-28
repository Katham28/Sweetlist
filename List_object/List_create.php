<?php
session_start();
if(!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: ../Main page.php"); exit;
}
?>
<!doctype html>
<html>
<head>
    <title>Create List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../p1.css">
</head>
<body>

<nav class="navbar navbar-expand-sm girly-navbar fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="List_menu.php">Back</a>
    </div>
</nav>

<div id="container">

    <div id="banner"><h1>Create List</h1></div>

    <?php if(isset($_GET['created']) && $_GET['created'] == 1): ?>
        <div class="girly-alert">List created successfully!</div>
    <?php endif; ?>

    <?php if(isset($_GET['error']) && $_GET['error'] == 'name'): ?>
        <div class="girly-alert" style="background: linear-gradient(45deg, #ff4f4f, #cc0000);">List name already exists!</div>
    <?php endif; ?>

    <form action="CRUD_list_CREATE.php" method="POST">
        <div class="p-3 girly-fields">

            Name:
            <input type="text" name="nameA" class="form-control" required>

            Icon:
            <select name="iconA" class="form-control">
                <option value="home.png">Home</option>
                <option value="list.png">List</option>
                <option value="shopping.png">Shopping</option>
                <option value="study.png"> Study</option>
                <option value="work.png"> Work</option>
            </select>

            Notes:
            <input type="text" name="notesA" class="form-control">

        </div>
        <button type="submit" class="button d-block mx-auto mt-3">SUBMIT</button>
    </form>

</div>
</body>
</html>
