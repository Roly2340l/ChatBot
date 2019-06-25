<html>
<head>
  <script type="text/javascript">
    window.onload = function () {
      document.getElementById('ans').Submit1.click();
    }
  </script>
</head>
<body background = "../images/space.jpg">
<?php
if(isset($_POST["msg"])==false) $_POST["msg"]='';
if(isset($_POST["area"])==false) $_POST["area"]='';
$msg = $_POST["msg"];
$area = $_POST["area"];
$rpta = "";
$user = "Admin";
$saludos = array("hola","hi","hola","hello");
$ofensas = array("inutil","me llegas","eres un");
$estado = array("como estas","que tal","como te va");
$causa = array("por","why");
$consecuencia = array("por que asi es la vida", "no lo se rick","por que me dejo mi novia");
$estadoBot = array("bien","Mal","Sad");
$mantener = array("Y.. cuentame algo","Como te va","eeen fin..","No entiendo");
$tema = array("que es html", "que es desarrollo web","que es perder el tiempo");

$connect = mysqli_connect('127.0.0.1', 'root', 'bender') or die("No se puede conectar a tu host");
mysqli_select_db($connect,'chatbot') or die("No se pudo acceder a la database");
$result = mysqli_query($connect, "SELECT ID FROM conversations ORDER BY ID DESC LIMIT 1");
$lastID = mysqli_fetch_array($result, MYSQLI_NUM)[0] + 1;
if($msg){
  mysqli_query($connect,"INSERT INTO conversations VALUES('$lastID','$user',CURRENT_TIME(),'$msg')");
}

function Test($msg,$arreglo){
  foreach($arreglo as $item){
    if(strpos($msg,$item) !== false) return true;
  }
  return false;
}

function aleatorio($list){
  $ind = rand(0,sizeof($list)-1);
  return $list[$ind];
}

function write($msg,$area,$rpta){
    $tex = $area."Tu: ".$msg."\n\t    Bender: ".$rpta."\n\n";
    return $tex;
}

if(Test($msg,$saludos)) $rpta = aleatorio($saludos).$nombre;
else if(Test($msg,$estado)) $rpta = aleatorio($estadoBot);
else if(Test($msg,$estadoBot)) $rpta = "Por que??";
else if(Test($msg,$causa)) $rpta = aleatorio($consecuencia);
else if(Test($msg,$ofensas)) $rpta = "Se mas educado";
else if(Test($msg,$tema)) $rpta= "Es lo que hace tu profe Atencio";
else $rpta = aleatorio($mantener);

?>
<div class="Main" align="center">
  <form id='ans' action='../bot.php' method="post">
      <textarea name="rpta"><?php echo write($msg,$area,$rpta); ?></textarea>
      <input name="Submit1" type="submit" value="submit" />
  </form>
</div>
</body>
</html>
