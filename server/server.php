<?php
if(!isset($_POST["area"])) $_POST["area"]='';
if(!isset($_POST["msg"])) $_POST["msg"]='';
$msg = $_POST["msg"];
$area = $_POST["area"];
$rpta = "";
$user = "Admin";
$tmp = strtolower($msg);
$saludos = array("hola","hi","hola","hello");
$ofensas = array("inutil","me llegas","eres un");
$estado = array("como estas","que tal","como te va");
$causa = array("por","why");
$consecuencia = array("por que asi es la vida", "no lo se rick","por que me dejo mi novia");
$estadoBot = array("bien","mal","Sad");
$mantener = array("y.. cuentame algo","Como te va","eeen fin..","No entiendo");
$tema = array("que es html", "que es desarrollo web","que es perder el tiempo");
$clima = array("clima","temperatura");
$cities = array("arequipa","londres","miami","tokio","brasilia","alaska");

$connect = mysqli_connect('127.0.0.1', 'root', 'bender') or die("No se puede conectar a tu host");
mysqli_select_db($connect,'chatbot') or die("No se pudo acceder a la database");
$result = mysqli_query($connect, "SELECT ID FROM conversations ORDER BY ID DESC LIMIT 1");
$lastID = mysqli_fetch_array($result, MYSQLI_NUM)[0] + 1;
if($msg){
  mysqli_query($connect,"INSERT INTO conversations VALUES('$lastID','$user',CURRENT_TIME(),'$msg')");
}

function GetWeather($message,$arreglo){
  $city = '';
  foreach($arreglo as $item){
    if(strpos($message,$item) !== false) $city=$item;
  }
  if(!$city) return "Ciudad no encontrada.. Lo siento :c";

  $apiKey = "030b6a74a170ad8fd6b926a4f246da7c";
  $googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?q=" . $city . "&lang=es&units=metric&APPID=" . $apiKey;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_VERBOSE, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $response = curl_exec($ch);
  curl_close($ch);
  $data = json_decode($response);
  return "La temperatura en " . $data->name . " es de " . $data->main->temp . " grados, " . $data->weather[0]->description;
}

function Test($tmp,$arreglo){
  foreach($arreglo as $item){
    if(strpos($tmp,$item) !== false) return true;
  }
  return false;
}

function aleatorio($list){
  $ind = rand(0,sizeof($list)-1);
  return $list[$ind];
}

function write($msg,$area,$rpta){
    $tex = $area."\n\tTu:  ".$msg."\n\tBender:  ".$rpta."\n";
    return $tex;
}

if(Test($tmp,$saludos)) $rpta = aleatorio($saludos)." ".$user;
else if(Test($tmp,$estado)) $rpta = aleatorio($estadoBot);
else if(Test($tmp,$estadoBot)) $rpta = "Por que??";
else if(Test($tmp,$causa)) $rpta = aleatorio($consecuencia);
else if(Test($tmp,$ofensas)) $rpta = "Se mas educado";
else if(Test($tmp,$tema)) $rpta= "Es lo que hace tu profe Atencio";
else if(Test($tmp,$clima)) $rpta = GetWeather($tmp,$cities);
else $rpta = aleatorio($mantener);
$rpta = ucfirst($rpta);

if($msg) echo write($msg,$area,$rpta);
else echo $area;
?>
