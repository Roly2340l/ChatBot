<?php
require_once "configuracion.php";
include 'data.php';
include 'index.php';

// datos del post
if (!isset($_POST["area"])) $_POST["area"] = '';
if (!isset($_POST["msg"])) $_POST["msg"] = '';
$msg = $_POST["msg"];
$area = $_POST["area"];
$user = $_POST["user"];
$rpta = "";
$tmp = strtolower($msg);

// Save in Database
$result = mysqli_query($link, "SELECT ID FROM conversations ORDER BY ID DESC LIMIT 1");
$lastID = mysqli_fetch_array($result, MYSQLI_NUM)[0] + 1;
if ($msg) {
  mysqli_query($link, "INSERT INTO conversations VALUES('$lastID','$user',CURRENT_TIME(),'$msg')");
}

//Main
if (Test($tmp, $saludos)) {
  $rpta = aleatorio($saludos) . " " . $user;
} else if (Test($tmp, $ofensas)) {
  $rpta = aleatorio($rpta_ofensas);
} else if (Test($tmp, $preguntas1)) {
  $rpta = aleatorio($respuestas1);
} else if (Test($tmp, $preguntas2)) {
  $rpta = aleatorio($respuestas2);
} else if (Test($tmp, $preguntas3)) {
  $rpta = aleatorio($respuestas3);
} else if (Test($tmp, $preguntas4)) {
  $rpta = aleatorio($respuestas4);
} else if (Test($tmp, $preguntas5)) {
  $rpta = aleatorio($respuestas5);
} else if (Test($tmp, $preguntas6)) {
  $rpta = aleatorio($respuestas6);
} else if (Test($tmp, $preguntas7)) {
  $rpta = aleatorio($respuestas7);
} else if (Test($tmp, $preguntas8)) {
  $rpta = aleatorio($respuestas8);
} else if (Test($tmp, $preguntas9)) {
  $rpta = aleatorio($respuestas9);
} else if (Test($tmp, $estado_hacer)) {
  $rpta = aleatorio($estado_hacer_rpta);
} else if (Test($tmp, $estado)) {
  $rpta = aleatorio($estadoBot);
} else if (Test($tmp, $causa)) {
  $rpta = aleatorio($consecuencia);
} else if (Test($tmp, $tema)) {
  $rpta = GiveHelp($tmp, $topics);
} else if (Test($tmp, $clima)) {
  $rpta = GetWeather($tmp, $cities);
} else if (Test($tmp, $hora)) {
  $rpta = "Son las " . date('H:i:s') . " en tu ciudad";
} else $rpta = aleatorio($mantener);

//Devolver respuesta
$rpta = ucfirst($rpta);
if ($msg) echo $area . "\nTu:  " . $msg . "\nBender:  " . $rpta . "\n";
else echo $area;
