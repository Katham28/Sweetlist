<?php
session_start();

$servername = "localhost";
$username   = "admin";
$password   = "admin";
$dbname     = "proyecto";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$stmt = $conn->prepare("SELECT Username, Name, Second_Name, First_Last_Name, Second_Last_Name, Birthday, Color, Gender, Style, Default_list, Default_tag, Motivational_phrase FROM users WHERE Username = ?");
$stmt->bind_param("s", $_SESSION['user']);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();
$conn->close();
?>
<!doctype html>
<html>
<head>
    <title>Update Profile</title>
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

    <div id="banner"><h1>Update Profile</h1></div>

    <?php if(isset($_GET['updated']) && $_GET['updated'] == 1): ?>
        <div class="girly-alert">Profile updated successfully!</div>
    <?php endif; ?>

    <div class="p-3 girly-fields">
        <form action="CRUD_user_UPDATE.php" method="POST">
            <input type="hidden" name="usernameA" value="<?php echo htmlspecialchars($user['Username']); ?>">

            <div class="row">
                <div class="col-12 col-md-6 mb-3">

                    Name:
                    <input type="text" name="nameA" class="form-control" value="<?php echo htmlspecialchars($user['Name']); ?>">

                    Second Name:
                    <input type="text" name="secondNameA" class="form-control" value="<?php echo htmlspecialchars($user['Second_Name']); ?>">

                    First Last Name:
                    <input type="text" name="firstLastNameA" class="form-control" value="<?php echo htmlspecialchars($user['First_Last_Name']); ?>">

                    Second Last Name:
                    <input type="text" name="secondLastNameA" class="form-control" value="<?php echo htmlspecialchars($user['Second_Last_Name']); ?>">

                    Birthday:
                    <input type="date" name="birthDayA" class="form-control" value="<?php echo htmlspecialchars($user['Birthday']); ?>">

                    Color:
                    <input type="color" name="colorA" class="form-control" value="<?php echo htmlspecialchars($user['Color']); ?>">

                    Gender:
                    <select name="genderA" class="form-control">
                        <option value="MALE"   <?php if($user['Gender']==='MALE')   echo 'selected'; ?>>Male</option>
                        <option value="FEMALE" <?php if($user['Gender']==='FEMALE') echo 'selected'; ?>>Female</option>
                        <option value="OTHER"  <?php if($user['Gender']==='OTHER')  echo 'selected'; ?>>Other</option>
                    </select>

                </div>
                <div class="col-12 col-md-6 mb-3">

                    Style:
                    <select name="styleA" class="form-control">
                        <option value="Light"   <?php if($user['Style']==='Light')   echo 'selected'; ?>>Light</option>
                        <option value="Dark"    <?php if($user['Style']==='Dark')    echo 'selected'; ?>>Dark</option>
                        <option value="Colored" <?php if($user['Style']==='Colored') echo 'selected'; ?>>Colored</option>
                    </select>

                    Default list:
                    <select name="defaultListA" class="form-control">
                        <option value="1" <?php if($user['Default_list']==1) echo 'selected'; ?>>Yes</option>
                        <option value="0" <?php if($user['Default_list']==0) echo 'selected'; ?>>No</option>
                    </select>

                    Default tag:
                    <select name="defaultTagA" class="form-control">
                        <option value="1" <?php if($user['Default_tag']==1) echo 'selected'; ?>>Yes</option>
                        <option value="0" <?php if($user['Default_tag']==0) echo 'selected'; ?>>No</option>
                    </select>

                    Motivational phrase:
                    <textarea name="phraseA" rows="4" class="form-control"><?php echo htmlspecialchars($user['Motivational_phrase']); ?></textarea>

                </div>
            </div>

            <button type="submit" class="button d-block mx-auto mt-3">UPDATE</button>
        </form>
    </div>

</div>
</body>
</html>
