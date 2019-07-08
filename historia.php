<?php
session_start();
if($_SESSION['loggedin']==false) header("location:index.php");
?>
<html>
  <head>
    <img class="centrado" id="titulo" src="images/bender.gif" alt="Titulo">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1, shrink-to-fit=no, user-scalable=no">
  </head>
  <body>
    <div align="center">
      <div id="chat_box"> <br>
        Hola, soy Bender, te preguntarás que hace un robot tan genial como yo en una página para responder dudas de estudiantes.
        Bueno, todo comenzo cuando mi novia me dejó, mi vida perdió el sentido y me refugié en la programación web, llenando así este triste vacío.
        Ahora mi conciencia está en esta página para ayudar a novatos como tú a ser mejores desarroladores web cada vez.
        Por suerte soy un robot que lo sabe todo, y si quieres crear páginas increibles, ven y platiquemos...
        <br>
        <buttom id="boton" class="centrado" onclick="window.location.href = 'bot.php';" > <center> Platica conmigo! </center> </buttom>
        <?php echo "Para utilizar la aplicacion movil utiliza este codigo: <b> " . $_SESSION['code'] . "</b><br><br>"; ?>
      </div>
    </div>
  </body>
</html>
