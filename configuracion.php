<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root'); //El usuario mysql
define('DB_PASSWORD', ''); //La contraseña, si es que tiene
define('DB_NAME', 'ChatBot'); //EL nombre de la base de datos

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link === false) {
    die("ERROR DE CONEXION " . mysqli_connect_error());
}
