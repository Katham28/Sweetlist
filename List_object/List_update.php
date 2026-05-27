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
$list = null;

if(isset($_GET['name'])){
    $stmt = $conn->prepare("SELECT id, name, icon, notes FROM lists WHERE name = ? AND Username = ?");
    $stmt->bind_param("ss", $_GET['name'], $currentUser);
    $stmt->execute();
    $list = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}
$conn->close();
?>
<!doctype html>
<html>
<head>
    <title>Update List</title>
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

    <div id="banner"><h1>Update List</h1></div>

    <?php if(isset($_GET['updated']) && $_GET['updated'] == 1): ?>
        <div class="girly-alert">List updated successfully!</div>
    <?php endif; ?>

    <?php if(isset($_GET['error']) && $_GET['error'] == 'notfound'): ?>
        <div class="girly-alert" style="background: linear-gradient(45deg, #ff4f4f, #cc0000);">List not found!</div>
    <?php endif; ?>

    <div class="p-3 girly-fields mb-3">
        <form method="GET" action="List_update.php">
            Search by name:
            <input type="text" name="name" class="form-control" value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : ''; ?>" required>
            <button type="submit" class="button d-block mx-auto mt-3">SEARCH</button>
        </form>
    </div>

    <?php if($list): ?>
    <div class="p-3 girly-fields">
        <form action="CRUD_list_UPDATE.php" method="POST">
            <input type="hidden" name="idA" value="<?php echo $list['id']; ?>">

            Name:
            <input type="text" name="nameA" class="form-control" value="<?php echo htmlspecialchars($list['name']); ?>" required>

            Icon:
            <select name="iconA" class="form-control">
                <?php foreach(['home.png'=>'🏠 Home','list.png'=>'📋 List','shopping.png'=>'🛒 Shopping','study.png'=>'📚 Study','work.png'=>'💼 Work'] as $val => $label): ?>
                    <option value="<?php echo $val; ?>" <?php if($list['icon'] === $val) echo 'selected'; ?>><?php echo $label; ?></option>
                <?php endforeach; ?>
            </select>

            Notes:
            <input type="text" name="notesA" class="form-control" value="<?php echo htmlspecialchars($list['notes']); ?>">

            <button type="submit" class="button d-block mx-auto mt-3">UPDATE</button>
        </form>
    </div>
    <?php elseif(isset($_GET['name'])): ?>
        <p class="text-center text-muted">List not found.</p>
    <?php endif; ?>

</div>
</body>
</html>
