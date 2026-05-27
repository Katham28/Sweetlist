<?php
if(session_status() === PHP_SESSION_NONE) session_start();

// Si se accede directamente (no incluido desde User_object)
$standalone = !isset($userMenuIncluded);
$formAction = $standalone ? 'User_creation_process.php' : '../User_creation_process.php';
?>

<?php if($standalone): ?>
<!doctype html>
<html>
<head>
    <title>Users</title>
    <link rel="stylesheet" href="p1.css">
    <script src="p1.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('created') === '1') {
        const modal = new bootstrap.Modal(document.getElementById('Modal_User_Created'));
        modal.show();
        window.history.replaceState({}, document.title, window.location.pathname);
    }
});
</script>

<body>

<nav class="navbar navbar-expand-sm girly-navbar fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">SweetList-Users</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="irPantallaMain()">Main page</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="banner"><h1>SweetList</h1></div>

<?php if(isset($_GET['created']) && $_GET['created'] == 1): ?>
    <div class="girly-alert">User created successfully!</div>
<?php endif; ?>
<?php if(isset($_GET['error']) && $_GET['error'] == 'username'): ?>
    <div class="girly-alert" style="background: linear-gradient(45deg, #ff4f4f, #cc0000);">Username already taken, please choose another one!</div>
<?php endif; ?>
<?php endif; /* end standalone header */ ?>

<form action="<?php echo $formAction; ?>" method="POST">
<?php if(!$standalone): ?>
    <input type="hidden" name="from" value="usermenu">
<?php endif; ?>

<div id="s_create">
    <?php if($standalone): ?><h2>Create User</h2><?php endif; ?>

    <div class="row">
        <div class="col-12 col-md-6 mb-3">
            <div class="p-3 girly-fields">

                Name:
                <input type="text" name="nameA" class="form-control">

                Second Name:
                <input type="text" name="secondNameA" class="form-control">

                First Last Name:
                <input type="text" name="firstLastNameA" class="form-control">

                Second Last Name:
                <input type="text" name="secondLastNameA" class="form-control">

                Birthday:
                <input type="date" name="birthDayA" class="form-control">

                Color:
                <input type="color" name="colorA" class="form-control">

                Gender:
                <div class="radio-group">
                    <input type="radio" name="genderA" value="MALE" checked> Male <br>
                    <input type="radio" name="genderA" value="FEMALE"> Female <br>
                    <input type="radio" name="genderA" value="OTHER" onclick="Other(true)"> Other <br>
                </div>
                <div id="otherContainer" style="display:none;">
                    <input type="text" name="otherGender" class="form-control" placeholder="Specify...">
                </div>

            </div>
        </div>

        <div class="col-12 col-md-6 mb-3">
            <div class="p-3 girly-fields">

                Username:
                <input type="text" name="usernameA" class="form-control">

                Password:
                <input type="password" name="passwordA" class="form-control">

                Confirm password:
                <input type="password" class="form-control">

                Style:
                <select name="styleA" class="form-control">
                    <option value="Light">Light</option>
                    <option value="Dark">Dark</option>
                    <option value="Colored">Colored</option>
                </select>

                <br>
                Default settings:
                <div class="checkbox-group">
                    <label class="checkbox-item">
                        <input type="checkbox" name="defaultList" value="1">
                        <span>Default list</span>
                    </label>
                    <label class="checkbox-item">
                        <input type="checkbox" name="default_tag" value="1">
                        <span>Default tags</span>
                    </label>
                </div>

                <br>
                Motivational phrase:
                <textarea name="phraseA" rows="4" class="form-control"></textarea>

            </div>
        </div>
    </div>

    <button type="submit" class="button d-block mx-auto">SUBMIT</button>
</div>

</form>

<?php if($standalone): ?>
<div class="modal fade" id="Modal_User_Created">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">User CRUD</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">User created!</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<?php endif; ?>
