<?php

echo<<< _END
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="Vstiles.css">
    <title>Lunar Abyss</title>
</head>
<body background="Abyss.png" id='img'>
<script src="javascript.js"></script>
    <script src="jquery-2.2.4.min.js"></script>
    <script src="jquery.mobile-1.4.5.min.js"></script>
</body>
</html>
_END;
require_once 'Funciones.php';
session_start();
echo '<h1 id="titulo"> ABYSS OF ALBA </h1>"';
echo<<< _GUEST
<div class='text'>
<a data-role='button' data-inline='true' data-icon='plus'
data-transition="slide" href='Sesion.php'>Iniciar sesion</a>
</br>
</br>
<a data-role='button' data-inline='true' data-icon='plus'
data-transition="slide" href='Posters.php'> Ver productos</a>
</br>
</br>
<a data-role='button' data-inline='true' data-icon='plus'
data-transition="slide" href='Registro.php'> Crear cuenta</a>
</div>
_GUEST;
?>