<?php
// Partial: usa $tags y $lists ya cargados por Menu principal_configuration_process.php
?>
<hr>
<h5>Quick Add Task</h5>
<?php if(isset($_GET['task_created']) && $_GET['task_created'] == 1): ?>
    <div class="girly-alert" style="font-size:0.85rem; padding:6px 12px;">Task added!</div>
<?php endif; ?>
<form action="Task_object/CRUD_task_CREATE.php" method="POST">
    <input type="hidden" name="from" value="main">

    Title:
    <input type="text" name="tittleA" class="form-control mb-2" required>

    Description:
    <input type="text" name="descriptionA" class="form-control mb-2">

    Due Date:
    <input type="date" name="due_dateA" class="form-control mb-2">

    Tag:
    <select name="tagA" class="form-control mb-2">
        <?php foreach($tags as $tag): ?>
            <option value="<?php echo htmlspecialchars($tag['name']); ?>"><?php echo htmlspecialchars($tag['name']); ?></option>
        <?php endforeach; ?>
    </select>

    List:
    <select name="listA" class="form-control mb-2">
        <?php foreach($lists as $list): ?>
            <option value="<?php echo htmlspecialchars($list['name']); ?>"><?php echo htmlspecialchars($list['name']); ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit" class="button d-block mx-auto mt-2">ADD</button>
</form>
