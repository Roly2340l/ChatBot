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
      	<form id="FF" action='server/server.php' method='post'>
      	  <div align="center">
      	    <input id="chat" type="text" name="msg" placeholder="Dile algo a Bender" autofocus/>
      	    <input type="submit" value="Enviar"/>
      	  </div>
      	  <div align="center">
      	    <br><br>
      	    <textarea id="chat_box" name="area" rows="20" cols="100" readonly></textarea>
      	  </div>
          <script>Send()</script>
      	</form>
      </div>
  </body>
</html>
