<?php
session_start();
session_destroy();
header("Location: Pantalla de inicio.php");
exit;
?>