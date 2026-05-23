<?php session_start(); ?>
<!doctype html>
<html>
<head>
    <title>Create Tag</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../p1.css">
</head>
<body>

<nav class="navbar navbar-expand-sm girly-navbar fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="Tag_menu.php">Back</a>
    </div>
</nav>

<div id="container">

    <div id="banner"><h1>Create Tag</h1></div>

    <?php if(isset($_GET['created']) && $_GET['created'] == 1): ?>
        <div class="girly-alert">Tag created successfully!</div>
    <?php endif; ?>

    <?php if(isset($_GET['error']) && $_GET['error'] == 'name'): ?>
        <div class="girly-alert" style="background: linear-gradient(45deg, #ff4f4f, #cc0000);">Tag name already exists!</div>
    <?php endif; ?>

    <form action="CRUD_tag_CREATE.php" method="POST">
        <div id="s_create">
            <div class="p-3 girly-fields">

                Name:
                <input type="text" name="nameA" class="form-control" required>

                Color:
                <input type="color" name="colorA" class="form-control" value="#ff4f8b">

                Details:
                <input type="text" name="detailsA" class="form-control">

            </div>

            <button type="submit" class="button d-block mx-auto mt-3">SUBMIT</button>
        </div>
    </form>

</div>
</body>
</html>
