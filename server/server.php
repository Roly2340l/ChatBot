<?php
require_once "configuracion.php";
include 'data.php';

// datos del post
if(!isset($_POST["area"])) $_POST["area"]='';
if(!isset($_POST["msg"])) $_POST["msg"]='';
$msg = $_POST["msg"];
$area = $_POST["area"];
$user = $_POST["user"];
$rpta = "";
$tmp = strtolower($msg);

// Save in Database
$result = mysqli_query($link, "SELECT ID FROM conversations ORDER BY ID DESC LIMIT 1");
$lastID = mysqli_fetch_array($result, MYSQLI_NUM)[0] + 1;
if($msg){
  mysqli_query($link,"INSERT INTO conversations VALUES('$lastID','$user',CURRENT_TIME(),'$msg')");
}

//Main
if(Test($tmp,$saludos))
  $rpta = aleatorio($saludos) . " " . $user;
else if(Test($tmp,$estado))
  $rpta = aleatorio($estadoBot);
else if(Test($tmp,$estadoBot))
  $rpta = "Por que??";
else if(Test($tmp,$causa))
  $rpta = aleatorio($consecuencia);
else if(Test($tmp,$ofensas))
  $rpta = "Se mas educado";
else if(Test($tmp,$tema))
  $rpta= GiveHelp($tmp,$topics);
else if(Test($tmp,$clima))
  $rpta = GetWeather($tmp,$cities);
else if(Test($tmp,$hora))
  $rpta = "Son las " . date('H:i:s') . " en tu ciudad";
else $rpta = aleatorio($mantener);

$rpta = ucfirst($rpta);
if($msg) echo $area . "\nTu:  " . $msg . "\nBender:  " . $rpta . "\n";
else echo $area;
?>
