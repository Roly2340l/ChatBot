<!DOCTYPE html>
<html>
  <head>
    <title>Bender Bot</title>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="css/styles.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1, shrink-to-fit=no, user-scalable=no">
  </head>
  <body>
      <div class="Top">
        <center><br>
    	     <img class="centrado" id="titulobot" src="images/Portada.jpg" alt="Titulo">
        </center>
      </div>
      <div class="Main">
        <br>
	<?php
	 if(isset($_POST["msg"])==false) $_POST["msg"]="";
	 if(isset($_POST["area"])==false) $_POST["area"]="";
	 if(isset($_POST["name"])==false) $_POST["name"]="";
	 $msg = $_POST["msg"];
	 $area = $_POST["area"];
	 $nombre = $_POST["name"];
	 $rpta = "";
	 $saludos = array("hola","hi","hola","hello");
	 $ofensas = array("inutil","me llegas","eres un");
	 $estado = array("como estas","que tal","como te va");
	 $causa = array("por","why");
	 $consecuencia = array("por que asi es la vida", "no lo se rick","por que me dejo mi novia");
	 $estadoBot = array("bien","Mal","Sad");
	 $mantener = array("Y.. cuentame algo","Como te va","eeen fin..","No entiendo");
	 $tema = array("que es html", "que es desarrollo web","que es perder el tiempo");
	 $connect = mysqli_connect('127.0.0.1', 'root', 'palma63') or die("No se puede conectar a tu host");
	 mysqli_select_db($connect,'conversations');
	 

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
	     echo $area=$area."Tu: ".$msg."\n". "\t    Bender: ".$rpta."\n\n";
	 }
	 
	 if(Test($msg,$saludos)) $rpta = aleatorio($saludos).$nombre;
	 else if(Test($msg,$estado)) $rpta = aleatorio($estadoBot);
	 else if(Test($msg,$estadoBot)) $rpta = "Por que??";
	 else if(Test($msg,$causa)) $rpta = aleatorio($consecuencia);
	 else if(Test($msg,$ofensas)) $rpta = "Se mas educado";
	 else if(Test($msg,$tema)) $rpta= "Es lo que hace tu profe Atencio";
	 else $rpta = aleatorio($mantener);

	 if($_POST['msg']){
	?>
	<form name="f1" action="" method="post">
	  <div align="center">
	    <input type="text" name="msg" placeholder="Dile algo a Bender" autofocus/ id="chat" onclick="enviar()">
	    <input type="submit" onclick="enviar()"/>
	  </div>
	  <div align="center">
	    <br><br>
	    <textarea id="chat_box" name="area" rows="20" cols="100" >
	      <?php write($msg,$area,$rpta); ?>
	    </textarea>
	  </div>
	</form>
	<?php
	}
	else{
	?>
	<form name="f1" action="" method="post">
	  <div align="center">
	    <input type="text" name="msg" placeholder="Dile algo a Bender" autofocus/ id="chat" onclick="enviar()">
	    <input type="submit" onclick="enviar()"/>
	  </div>
	  <div align="center">
	    <br><br>
	    <textarea id="chat_box" name="area" rows="20" cols="100" >
	      <?php echo "\n"; ?>
	    </textarea>
	  </div>
	</form>
	<?php 
	 }
	?>
      </div>
  </body>
</html>
