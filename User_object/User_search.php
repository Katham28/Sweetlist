<?php session_start(); ?>
<!doctype html>
<html>
<head>
    <title>Search User</title>
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

    <div id="banner"><h1>Search User</h1></div>

    <div class="p-3 girly-fields">
        Username:
        <input type="text" id="searchValue" class="form-control">
        <button class="button d-block mx-auto mt-3" onclick="searchUser()">SEARCH</button>
    </div>

    <div id="mini_banner"><h1>Results</h1></div>

    <div class="table-responsive">
        <table class="s_table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Last Name</th>
                    <th>Birthday</th>
                    <th>Gender</th>
                    <th>Style</th>
                    <th>Phrase</th>
                </tr>
            </thead>
            <tbody id="searchResults">
                <tr><td colspan="7" class="text-center text-muted">No results</td></tr>
            </tbody>
        </table>
    </div>

</div>

<script>
function searchUser(){
    const value = document.getElementById('searchValue').value;
    fetch('CRUD_user_Search.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'usernameA=' + encodeURIComponent(value)
    })
    .then(r => r.text())
    .then(html => {
        const tbody = document.getElementById('searchResults');
        tbody.innerHTML = html.trim() !== '' ? html : '<tr><td colspan="7" class="text-center text-muted">No results</td></tr>';
    });
}
</script>

</body>
</html>
