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

		
	<a class="navbar-brand" href="#">SweetList-Users</a>
		

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="s_create()">Create</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="s_delete()">Delete</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="s_update()">Update</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="s_search()">Search</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="s_report()">Report</a>
                </li>

            </ul>
        </div>
    </div>
</nav>


    <div id="banner">
        <h1>SweetList</h1>
    </div>

   <form action="User_create.php" method="POST">

<div id="s_create">
    <h2>Create User</h2>

    <div class="row">

        <div class="col-12 col-md-6 mb-3">
            <div class="p-3 girly-fields">

                Name:
                <input type="text" id="nameA" name="nameA" class="form-control">

                Second Name:
                <input type="text" id="secondnameA" name="secondNameA" class="form-control">

                First Last Name:
                <input type="text" id="firstLastNameA" name="firstLastNameA" class="form-control">

                Second Last Name:
                <input type="text" id="secondLastNameA" name="secondLastNameA" class="form-control">

                Birthday:
                <input type="date" id="birthDayA" name="birthDayA" class="form-control">

                Color:
                <input type="color" id="colorA" name="colorA" class="form-control">


                Gender:
                <div class="radio-group">
                    <input type="radio" id="male" name="genderA" value="MALE" onclick="Other(false)" checked> Male <br>
                    <input type="radio" id="female" name="genderA" value="FEMALE" onclick="Other(false)"> Female <br>
                    <input type="radio" id="other" name="genderA" value="OTHER" onclick="Other(true)"> Other <br>
                </div>

                <div id="otherContainer" style="display:none;">
                    <input type="text" id="sexOtText" name="otherGender" class="form-control" placeholder="Specify...">
                </div>

            </div>
        </div>


        <div class="col-12 col-md-6 mb-3">
            <div class="p-3 girly-fields">

                Username:
                <input type="text" id="usernameA" name="usernameA" class="form-control">

                Password:
                <input type="password" id="passA" name="passwordA" class="form-control">

                Confirm password:
                <input type="password" id="pass2A" class="form-control">

                Style:
                <select id="styleA" name="styleA" class="form-control">
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
                <textarea id="addressA" name="phraseA" rows="4" class="form-control"></textarea>

            </div>
        </div>

    </div>

	<button type="submit" class="button d-block mx-auto">
		SUBMIT
	</button>

</div>

</form>


   <div id="s_delete" style="display:none">
        <h2>Delete User</h2>

        ID:<input type="text" id="IDB">

        <button class="button" onclick="deleteData()">DELETE</button>
    </div>


    <div id="s_update" style="display:none">
        <h2>Update User</h2>

        ID:<input type="text" id="searchC">
        <button class="button" onclick="changeData()">Buscar</button>

        <div id="formUpdate" style="display:none">

            ID:<input type="text" id="IDC">
            Name:<input type="text" id="nameC">

            <button class="button" onclick="updateData()">Update</button>

        </div>
    </div>

		<form action="User_search.php" method="POST">
    <div id="s_search" style="display:none">
        <h2>Search User</h2>

			Search by:
<select id="FieldS" name="FieldS">
    <option value="Username">Username</option>
    <option value="Name">Name</option>
    <option value="First_Last_Name">First_Last_Name</option>
</select>

Field Value: 
<input type="text" id="Value" name="Value">

            <br><br>

            <button type="button" class="button d-block mx-auto" onclick="search()">
                SEARCH
            </button>

       

			<br><br>
			        <h2>Search Result</h2>
            <div class="table-responsive">
        <table class="s_table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Second Name</th>
                    <th>First Last Name</th>
                    <th>Second Last Name</th>
                    <th>Birthday</th>
                    <th>Color</th>
                    <th>Gender</th>
                    <th>Username</th>
                    <th>Style</th>
                    <th>Default List</th>
                    <th>Default Tags</th>
                    <th>Motivational Phrase</th>
                </tr>
            </thead>
            <tbody id="reportBody2">
                <tr>
                    <td colspan="12" class="text-center text-danger fw-bold">
                        No hay registros
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>
 </form>
	
<div id="s_report"  style="display:none;">
    <h2>User Report</h2>

    <div class="table-responsive">
        <table class="s_table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Second Name</th>
                    <th>First Last Name</th>
                    <th>Second Last Name</th>
                    <th>Birthday</th>
                    <th>Color</th>
                    <th>Gender</th>
                    <th>Username</th>
                    <th>Style</th>
                    <th>Default List</th>
                    <th>Default Tags</th>
                    <th>Motivational Phrase</th>
                </tr>
				
            </thead>
            <tbody id="reportBody">
                <tr>
                    <td colspan="12" class="text-center text-danger fw-bold">
                        No hay registros
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

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