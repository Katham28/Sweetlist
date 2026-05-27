<?php
session_start();

if (isset($_SESSION["authenticated"])) {
    if ($_SESSION["authenticated"] != true) {
        $_SESSION["LoginError"] = true;
        header("Location: Main page.php");
        exit;
    }
} else {
    $_SESSION["LoginError"] = true;
    header("Location: Main page.php");
    exit;
}

$_SESSION["LoginError"] = false;

include 'Main menu_configuration_process.php';
?>

<!doctype html>
<html>
<head>
    <title>Main menu</title>
    <link rel="stylesheet" href="p1.css">
    <style>
        #banner { background: linear-gradient(45deg, #ff4f8b, <?php echo $userColor; ?>) !important; color: <?php echo $navTextColor; ?>; }
        .task-item { border-left: 4px solid <?php echo $userColor; ?> !important; }
    </style>
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
                    <a class="nav-link" href="#" onclick="irPantalla_User_menu()">User</a>
                </li>

				<li class="nav-item">
                    <a class="nav-link" href="#" onclick="irPantalla_List_menu()">Lists</a>
                </li>

				<li class="nav-item">
                    <a class="nav-link" href="#" onclick="irPantalla_Task_menu()">Tasks</a>
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

                <?php include 'Task_object/Task_create.php'; ?>
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
                        <div class="task-item border rounded p-3 mb-3" data-tag="<?php echo htmlspecialchars($task['tag']); ?>" data-list="<?php echo htmlspecialchars($task['list']); ?>" style="background-color: <?php echo $bgColor; ?>33;">
                            <div class="d-flex align-items-start gap-2">
                                <!-- Checkbox is_checked -->
                                <input class="form-check-input task-check flex-shrink-0 mt-1" type="checkbox" data-id="<?php echo $task['id']; ?>" <?php if($task['is_checked']): ?>checked<?php endif; ?>>
                                <!-- Contenido -->
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <strong class="task-content <?php if($task['is_checked']): ?>task-done<?php endif; ?>"><?php echo htmlspecialchars($task['tittle']); ?></strong>
                                        <?php if($task['due_date']): ?>
                                            <small class="text-muted text-nowrap ms-2"><?php echo htmlspecialchars($task['due_date']); ?></small>
                                        <?php endif; ?>
                                    </div>
                                    <?php if($task['description']): ?>
                                        <p class="mb-1 text-muted" style="font-size:0.9rem;"><?php echo htmlspecialchars($task['description']); ?></p>
                                    <?php endif; ?>
                                    <div class="d-flex gap-2 mt-1">
                                        <span class="badge" style="background:<?php echo $bgColor; ?>dd; color:#333;"><?php echo htmlspecialchars($task['tag']); ?></span>
                                        <span class="badge" style="background:#e0e0e0; color:#555;"><?php echo htmlspecialchars($task['list']); ?></span>
                                    </div>
                                </div>
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
            initialView: '<?php echo $calendarView; ?>',
            firstDay: <?php echo $calendarFirstDay; ?>,
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
                    $calendarEvents[] = [
                        'title'           => $task['tittle'],
                        'start'           => $task['due_date'],
                        'backgroundColor' => $color . '33',
                        'borderColor'     => $color,
                        'textColor'       => '#333333'
                    ];
                }
                echo json_encode($calendarEvents);
            ?>
        });
        calendar.render();
    });
    </script>




<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function() {

    // jQuery: filtrar tasks por tag y lista con checkboxes
    function filterTasks() {
        const selectedTags  = $('[id^="tag_"]:checked').map(function()  { return $(this).attr('id').replace('tag_',  ''); }).get();
        const selectedLists = $('[id^="list_"]:checked').map(function() { return $(this).attr('id').replace('list_', ''); }).get();

        let visible = 0;

        // jQuery: iterar task-items y mostrar/ocultar con toggle
        $('.task-item').each(function() {
            const taskTag  = $(this).data('tag');
            const taskList = $(this).data('list');
            const matchesTag  = $.inArray(taskTag,  selectedTags)  !== -1;
            const matchesList = $.inArray(taskList, selectedLists) !== -1;

            if(matchesTag && matchesList) {
                $(this).removeClass('d-none').addClass('d-flex');
                visible++;
            } else {
                $(this).removeClass('d-flex').addClass('d-none');
            }
        });

        // jQuery: mostrar/ocultar mensaje vacío con fadeIn/fadeOut
        if(visible === 0) {
            $('#no-coincidencias').fadeIn(150);
        } else {
            $('#no-coincidencias').fadeOut(150);
        }
    }

    // jQuery: escuchar cambios en checkboxes
    $('[id^="tag_"], [id^="list_"]').on('change', filterTasks);
    filterTasks();

    // jQuery: toggle is_checked con $.post
    $('.task-check').on('change', function() {
        const id         = $(this).data('id');
        const is_checked = $(this).is(':checked') ? 1 : 0;
        $(this).closest('.task-item').find('.task-content').toggleClass('task-done', $(this).is(':checked'));
        $.post('Task_check_process.php', { id: id, is_checked: is_checked });
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