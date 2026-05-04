<?php
session_start();

if (isset($_SESSION["authenticated"])) {
    if ($_SESSION["authenticated"] != true) {
        $_SESSION["LoginError"] = true;
        header("Location: Pantalla de inicio.php");
        exit;
    }
} else {
    $_SESSION["LoginError"] = true;
    header("Location: Pantalla de inicio.php");
    exit;
}

$_SESSION["LoginError"] = false;
?>

<!doctype html>
<html>
<head>
    <title>Main menu</title>
    <link rel="stylesheet" href="p1.css">
    <script src="p1.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
</head>

<script>
//For the modals
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('created') === '1') {
        const modal = new bootstrap.Modal(document.getElementById('Modal_User_Created'));
        modal.show();
        
        // Limpiar la URL para que no muestre el parámetro
        const newUrl = window.location.pathname;
        window.history.replaceState({}, document.title, newUrl);
    }
});
</script>

<body>

<nav class="navbar navbar-expand-sm girly-navbar  fixed-top">
    <div class="container-fluid">

	
	<a class="navbar-brand" href="Pantalla de inicio.php">Log out</a>
	<a class="navbar-brand" href="Menu principal php">Main Menu</a>
		

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">


				
				<li class="nav-item">
                <a class="nav-link" href="#" onclick="irPantallaMain()">Calendar</a>
                </li>
				
				<li class="nav-item">
                    <a class="nav-link" href="#" onclick="irPantallaMain()">User</a>
                </li>
				
				<li class="nav-item">
                    <a class="nav-link" href="#" onclick="irPantallaMain()">Lists</a>
                </li>
				
				<li class="nav-item">
                    <a class="nav-link" href="#" onclick="irPantallaMain()">Tasks</a>
                </li>
				
				<li class="nav-item">
                    <a class="nav-link" href="#" onclick="irPantallaMain()">Tags</a>
                </li>


            </ul>
        </div>
    </div>
</nav>


    <div id="banner">
        <h1>Welcome to SweetList, <?php echo $_SESSION['user']; ?>!</h1>
    </div>

    <div id="mini_banner">
        <h1>General View</h1>
    </div>
	
    <div class="row">

        <div class="col-12 col-md-3 mb-3">
            <div class="p-3 girly-fields">
                <h5>List selection</h5>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="list1">
                    <label class="form-check-label" for="list1">List 1</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="list2">
                    <label class="form-check-label" for="list2">List 2</label>
                </div>

                <hr>

                <h5>Filter by tag</h5>
                <select class="form-select form-select-sm">
                    <option>Tag</option>
                </select>
            </div>
        </div>

        <div class="col-12 col-md-9 mb-3">
            <div class="p-3 girly-fields">
                <h5>Task View</h5>
                <div class="border rounded p-3 mb-3">Task 1</div>
                <div class="border rounded p-3 mb-3">Task 2</div>
            </div>
        </div>

    </div>


    <div id="mini_banner">
        <h1>Calendar View</h1>
    </div>

    <div class="p-3 girly-fields mb-4">
        <div id="calendar"></div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            locale: 'en',
            height: 'auto'
        });
        calendar.render();
    });
    </script>




<div class="modal fade" id="Modal_User_Created">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">User CRUD</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	User created!!!!
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



</body>
</html>