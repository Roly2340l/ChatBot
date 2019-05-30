<?php

$dbname = 'chatbot';

$dbuser = 'root'; /*Aquí colocar usuario*/

$dbpass = 'bender'; /*Aquí colocar la contraseña*/

$dbhost = '127.0.0.1';

$connect = mysqli_connect($dbhost, $dbuser, $dbpass) or die("No se puede conectar a '$dbhost'");

mysqli_select_db($connect,$dbname ) or die("No se puede abrir '$dbname'");

$result = mysqli_query($connect,"SELECT ID, Message FROM conversations");

while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {

printf("ID: %s Message: %s <br>", $row[0], $row[1]);

}

?>
