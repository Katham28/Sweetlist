<?php
session_start();

$servername = "localhost";
$username   = "admin";
$password   = "admin";
$dbname     = "proyecto";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$currentUser = $_SESSION['user'];
$tag = null;

if(isset($_GET['name'])){
    $stmt = $conn->prepare("SELECT id, name, color, details FROM tags WHERE name = ? AND Username = ?");
    $stmt->bind_param("ss", $_GET['name'], $currentUser);
    $stmt->execute();
    $tag = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}
$conn->close();
?>
<!doctype html>
<html>
<head>
    <title>Update Tag</title>
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

    <div id="banner"><h1>Update Tag</h1></div>

    <?php if(isset($_GET['updated']) && $_GET['updated'] == 1): ?>
        <div class="girly-alert">Tag updated successfully!</div>
    <?php endif; ?>

    <?php if(isset($_GET['error']) && $_GET['error'] == 'notfound'): ?>
        <div class="girly-alert" style="background: linear-gradient(45deg, #ff4f4f, #cc0000);">Tag not found!</div>
    <?php endif; ?>

    <!-- Search -->
    <div class="p-3 girly-fields mb-3">
        <form method="GET" action="Tag_update.php">
            Search by name:
            <input type="text" name="name" class="form-control" value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : ''; ?>" required>
            <button type="submit" class="button d-block mx-auto mt-3">SEARCH</button>
        </form>
    </div>

    <!-- Update form -->
    <?php if($tag): ?>
    <div class="p-3 girly-fields">
        <form action="CRUD_tag_UPDATE.php" method="POST">
            <input type="hidden" name="idA" value="<?php echo $tag['id']; ?>">

            Name:
            <input type="text" name="nameA" class="form-control" value="<?php echo htmlspecialchars($tag['name']); ?>" required>

            Color:
            <input type="color" name="colorA" class="form-control" value="<?php echo htmlspecialchars($tag['color']); ?>">

            Details:
            <input type="text" name="detailsA" class="form-control" value="<?php echo htmlspecialchars($tag['details']); ?>">

            <button type="submit" class="button d-block mx-auto mt-3">UPDATE</button>
        </form>
    </div>
    <?php elseif(isset($_GET['name'])): ?>
        <p class="text-center text-muted">Tag not found.</p>
    <?php endif; ?>

</div>
</body>
</html>
