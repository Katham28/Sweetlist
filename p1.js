function Other(show){
    let container = document.getElementById("otherContainer");

    if(show){
        container.style.display = "block";
    }else{
        container.style.display = "none";
        document.getElementById("sexOtText").value = "";
    }
}

function s_create()
{
	document.getElementById("s_create").style.display = "block";
	document.getElementById("s_delete").style.display = "none";
	document.getElementById("s_search").style.display = "none";
	document.getElementById("s_update").style.display = "none";
	document.getElementById("s_report").style.display = "none";
}

function s_delete()
{
	document.getElementById("s_create").style.display = "none";
	document.getElementById("s_delete").style.display = "block";
	document.getElementById("s_search").style.display = "none";
	document.getElementById("s_update").style.display = "none";
	document.getElementById("s_report").style.display = "none";
}


function s_update()
{
	document.getElementById("s_create").style.display = "none";
	document.getElementById("s_delete").style.display = "none";
	document.getElementById("s_search").style.display = "none";
	document.getElementById("s_update").style.display = "block";
	document.getElementById("s_report").style.display = "none";
}


function s_search()
{
	document.getElementById("s_create").style.display = "none";
	document.getElementById("s_delete").style.display = "none";
	document.getElementById("s_search").style.display = "block";
	document.getElementById("s_update").style.display = "none";
	document.getElementById("s_report").style.display = "none";
}


function s_report()
{
	document.getElementById("s_create").style.display = "none";
	document.getElementById("s_delete").style.display = "none";
	document.getElementById("s_search").style.display = "none";
	document.getElementById("s_update").style.display = "none";
	document.getElementById("s_report").style.display = "block";

	    fetch('User_report.php')
        .then(response => response.text())
        .then(html => {
            const tbody = document.getElementById('reportBody');
            if (html.trim() === "") {
                tbody.innerHTML = `<tr>
                    <td colspan="12" style="text-align:center; color:#ff4f8b; font-weight:bold;">
                        No hay registros
                    </td>
                </tr>`;
            } else {
                tbody.innerHTML = html;
            }
        })
        .catch(err => console.error('Error al cargar report:', err));

}

function search(){
    const field = document.getElementById("FieldS").value;
    const value = document.getElementById("Value").value;

    fetch('User_search.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'FieldS=' + encodeURIComponent(field) + 
              '&Value=' + encodeURIComponent(value)
    })
    .then(response => response.text())
    .then(html => {
        const tbody = document.getElementById('reportBody2');

        if (html.trim() === "") {
            tbody.innerHTML = `<tr>
                <td colspan="12">No hay registros</td>
            </tr>`;
        } else {
            tbody.innerHTML = html;
        }
    });
}


function irPantallaCRUD_Usuario() {
	window.location.href = 'CRUD_usuarios.php';
}

function irPantallaMain() {
	window.location.href = 'Pantalla de inicio.php';
}

function irPantallaUser_Creation() {
	window.location.href = 'User_creation.php';
}


// jQuery: mostrar una sección y ocultar las demás (usado en todos los menús CRUD)
function showSection(sectionId, allSections) {
    $.each(allSections, function(i, id) {
        $('#' + id).hide();
    });
    $('#' + sectionId).fadeIn(200);
}

function irPantalla_Tag_menu() {
	window.location.href = 'Tag_object/Tag_menu.php';
}

function irPantalla_Calendar_menu() {
	window.location.href = 'Calendar_object/Tag_menu.php';
}

function irPantalla_User_menu() {
	window.location.href = 'User_object/User_menu.php';
}

function irPantalla_List_menu() {
	window.location.href = 'List_object/List_menu.php';
}

function irPantalla_Task_menu() {
	window.location.href = 'Task_object/Task_menu.php';
}