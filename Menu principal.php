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

include 'Menu principal_configuration_process.php';
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



<body>

<nav class="navbar navbar-expand-sm girly-navbar  fixed-top">
    <div class="container-fluid">

	
	<a class="navbar-brand" href="#" data-bs-toggle="modal" data-bs-target="#Modal_login_out">Log out</a>
	<a class="navbar-brand" href="#Calendar_View">Calendar View</a>
	<a class="navbar-brand" href="#General_View">General View</a>
		

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
                    <a class="nav-link" href="#" onclick="irPantalla_Tag_menu()">Tags</a>
                </li>


            </ul>
        </div>
    </div>
</nav>

	<div id="General_View">
	 
	 </div>

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
                <?php if(empty($lists)): ?>
                    <p class="text-muted">No hay listas</p>
                <?php else: ?>
                    <?php foreach($lists as $list): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="list_<?php echo htmlspecialchars($list['name']); ?>" checked>
                            <label class="form-check-label" for="list_<?php echo htmlspecialchars($list['name']); ?>"><?php echo htmlspecialchars($list['name']); ?></label>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <hr>

                <h5>Filter by tag</h5>
                <?php if(empty($tags)): ?>
                    <p class="text-muted">No hay tags</p>
                <?php else: ?>
                    <?php foreach($tags as $tag): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="tag_<?php echo htmlspecialchars($tag['name']); ?>" checked>
                            <label class="form-check-label" for="tag_<?php echo htmlspecialchars($tag['name']); ?>"><?php echo htmlspecialchars($tag['name']); ?></label>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-12 col-md-9 mb-3">
            <div class="p-3 girly-fields">
                <h5>Task View</h5>
                <?php
                    $tagColors = [];
                    foreach($tags as $t) $tagColors[$t['name']] = $t['color'];
                ?>
                <?php if(empty($tasks)): ?>
                    <p class="text-muted">No hay tasks</p>
                <?php else: ?>
                    <?php foreach($tasks as $task): ?>
                        <?php $bgColor = isset($tagColors[$task['tag']]) ? $tagColors[$task['tag']] : '#ffffff'; ?>
                        <div class="task-item border rounded p-3 mb-3 d-flex align-items-start gap-2" data-tag="<?php echo htmlspecialchars($task['tag']); ?>" data-list="<?php echo htmlspecialchars($task['list']); ?>" style="background-color: <?php echo $bgColor; ?>33;">
                            <input class="form-check-input task-check mt-1" type="checkbox" data-id="<?php echo $task['id']; ?>" <?php if($task['is_checked']): ?>checked<?php endif; ?>>
                            <div class="task-content <?php if($task['is_checked']): ?>task-done<?php endif; ?>">
                                <strong><?php echo htmlspecialchars($task['tittle']); ?></strong>
                                <?php if($task['description']): ?>
                                    <p class="mb-1"><?php echo htmlspecialchars($task['description']); ?></p>
                                <?php endif; ?>
                                <?php if($task['due_date']): ?>
                                    <small class="text-muted"><?php echo htmlspecialchars($task['due_date']); ?></small>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <p id="no-coincidencias" class="text-muted" style="display:none;">No hay coincidencias</p>
                <?php endif; ?>
            </div>
        </div>

    </div>
    </div>

	<div id="Calendar_View">
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
            height: 'auto',
            events: <?php
                $calendarEvents = [];
                foreach($tasks as $task) {
                    $color = isset($tagColors[$task['tag']]) ? $tagColors[$task['tag']] : '#cccccc';
                    $event = [
                        'title' => $task['tittle'],
                        'start' => $task['due_date'],
                        'color' => $color
                    ];
                    if($task['is_checked']) $event['classNames'] = ['task-checked'];
                    $calendarEvents[] = $event;
                }
                echo json_encode($calendarEvents);
            ?>
        });
        calendar.render();
    });
    </script>




<script>
document.addEventListener('DOMContentLoaded', function() {
    const tagCheckboxes  = document.querySelectorAll('[id^="tag_"]');
    const listCheckboxes = document.querySelectorAll('[id^="list_"]');

    function filterTasks() {
        const selectedTags  = Array.from(tagCheckboxes).filter(cb => cb.checked).map(cb => cb.id.replace('tag_', ''));
        const selectedLists = Array.from(listCheckboxes).filter(cb => cb.checked).map(cb => cb.id.replace('list_', ''));

        let visible = 0;

        document.querySelectorAll('.task-item').forEach(function(task) {
            const matchesTag  = selectedTags.length  === 0 || selectedTags.includes(task.dataset.tag);
            const matchesList = selectedLists.length === 0 || selectedLists.includes(task.dataset.list);

            if(matchesTag && matchesList) {
                task.style.display = '';
                visible++;
            } else {
                task.style.display = 'none';
            }
        });

        const noCoincidencias = document.getElementById('no-coincidencias');
        if(noCoincidencias) {
            noCoincidencias.style.display = visible === 0 ? '' : 'none';
        }
    }

    tagCheckboxes.forEach(cb  => cb.addEventListener('change', filterTasks));
    listCheckboxes.forEach(cb => cb.addEventListener('change', filterTasks));

    document.querySelectorAll('.task-check').forEach(function(cb) {
        cb.addEventListener('change', function() {
            const id         = this.dataset.id;
            const is_checked = this.checked ? 1 : 0;
            const content    = this.nextElementSibling;

            content.classList.toggle('task-done', this.checked);

            fetch('Task_check_process.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'id=' + id + '&is_checked=' + is_checked
            });
        });
    });
});
</script>

<div class="modal fade" id="Modal_login_out">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">You are about to log out.</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
		Are you sure?
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="User_log_out.php" class="btn btn-danger">Yes</a>
      </div>

    </div>
  </div>
</div>



</body>
</html>