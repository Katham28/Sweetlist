<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Main page</title>
    <link rel="stylesheet" href="p1.css">
    <script src="p1.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
   
</head>

<nav class="navbar navbar-expand-sm girly-navbar fixed-top">
    <div class="container-fluid">

        <a class="navbar-brand" href="#">SweetList-Main</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="#section1">Top</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#section2">Down</a>
                </li>


            </ul>
        </div>
    </div>
</nav>
<div id="section1">
<br><br>
    <div id="banner">
        <h1>SweetList</h1>
        <span class="badge bg-secondary">By Alondra Martinez & Katia Carpio</span>
    </div>

    <div class="alert alert-dismissible fade show girly-alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong> Hello!</strong> Welcome to SweetList. 
    </div>

    <!-- Carousel -->
    <div id="demo" class="carousel slide container mt-4" data-bs-ride="carousel">
        <!-- Indicators/dots -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="4"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="5"></button>
        </div>

        <!-- The slideshow/carousel -->
        <div class="carousel-inner rounded-4 shadow">
            <div class="carousel-item active">
                <img src="imagenes/uno.jpg" alt="Pegaso" class="d-block carousel-image">
                <div class="carousel-caption">
                    <h3>Keep moving forward.</h3>

                </div>
            </div>
            <div class="carousel-item">
                <img src="imagenes/dos.jpg" alt="Sabrina Carpenter" class="d-block carousel-image">
                <div class="carousel-caption">
                    <h3>Discipline beats motivation.</h3>

                </div>
            </div>
            <div class="carousel-item">
                <img src="imagenes/tres.jpg" alt="Olivia Rodrigo" class="d-block carousel-image">
                <div class="carousel-caption">
                    <h3>One task at a time.</h3>

                </div>
            </div>
            <div class="carousel-item">
                <img src="imagenes/cuatro.jpg" alt="Pink Drink" class="d-block carousel-image">
                <div class="carousel-caption">
                    <h3> Focus. Plan. Achieve.</h3>

                </div>
            </div>
            <div class="carousel-item">
                <img src="imagenes/cinco.jpg" alt="Fairytopia" class="d-block carousel-image">
                <div class="carousel-caption">
                    <h3>Small steps, big results</h3>

                </div>
            </div>
            <div class="carousel-item">
                <img src="imagenes/seis.jpg" alt="Mi buen Amor" class="d-block carousel-image">
                <div class="carousel-caption">
                    <h3>Work smart, not hard</h3>

                </div>
            </div>
        </div>

        <!-- Left and right controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</div>

<br><br>

<div id="section2" class="container-fluid mt-5 px-5">
    <div id="mini_page">
        <h2> User Management</h2>

        <div class="row">
            <div class="col-12 col-md-6 mb-3">
                <div class="p-3 girly-fields">
                    <h3 class="text-center mb-3"> Login</h3>
                    <form action="User_Log_in.php" method="POST">
                        <label>Username:</label>
                        <input type="text" id="usernameA" name="usernameA" class="form-control mb-3">

                        <label>Password:</label>
                        <input type="password" id="passA" name="passwordA" class="form-control mb-3">

                        <button type="submit" class="button d-block mx-auto">
                            SUBMIT
                        </button>
                    </form>
                    <?php if (!empty($_SESSION['LoginError'])): unset($_SESSION['LoginError']); ?>
                        <p class="text-danger text-center mt-2">Usuario o contraseña incorrectos.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <div class="p-3 girly-fields d-flex flex-column justify-content-center">
                    <h3 class="text-center mb-3"> Administration</h3>
                    <button class="button d-block mx-auto" onclick="irPantallaUser_Creation()">
                         Create user
                    </button>
                    <p class="text-center mt-3 text-muted">Create your own account</p>
                </div>
            </div>
        </div>
    </div>
</div>



</body>
</html>