<?php
session_start();
if(!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: ../Main page.php"); exit;
}
?>
<!doctype html>
<html>
<head>
    <title>Delete Account</title>
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

    <div id="banner"><h1>Delete Account</h1></div>

    <div class="p-3 girly-fields text-center">
        <p>You are about to permanently delete your account <strong><?php echo htmlspecialchars($_SESSION['user']); ?></strong> and all your data.</p>
        <p>This action cannot be undone.</p>
        <form action="CRUD_user_DELETE.php" method="POST">
            <input type="hidden" name="usernameA" value="<?php echo htmlspecialchars($_SESSION['user']); ?>">
            <button type="button" class="btn btn-secondary me-2" onclick="history.back()">Cancel</button>
            <button type="submit" class="btn btn-danger">Yes, delete my account</button>
        </form>
    </div>

</div>
</body>
</html>
