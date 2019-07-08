<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'Rolinson'); //El usuario mysql
define('DB_PASSWORD', 'lvnecuq23052001'); //La contraseña, si es que tiene
define('DB_NAME', 'ChatBot'); //EL nombre de la base de datos

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link === false) {
    die("ERROR DE CONEXION gg da laif" . mysqli_connect_error());
}
date_default_timezone_set('America/Lima');