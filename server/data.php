<?php

//DATA (arreglos)
$saludos = array("hola", "hi", "hello");
$ofensas = array("inutil", "me llegas", "tonto", "idiota", "mierda", "asqueroso", "imbecil", "cabro", "webon", "maricon", "marica", "pinche", " cagon", "gil", "gilazo");
$rpta_ofensas = array("Creo que deberias ser mas educado", "Adios entonces ps", "Ya no me hables >:v");
$estado = array("como estas", "que tal", "como te va", "todo bien", "estas");
$estado_hacer = array("que haces", "bueno, que haces", "haciendo");
$preguntas1 = array("hablas ingles", "hablas español", "que idioma hablas", "que idiomas hablas?", "español", "ingles", "alemán");
$preguntas2 = array("hablame sobre ti", "cuentame sobre ti", "como va tu vida", "vida", "que es", "de ti");
$preguntas3 = array("estoy feliz", "estoy triste", "triste", "sad", "quiero llorar", "consejo", "no");
$preguntas4 = array("ayuda", "tarea");
$preguntas5 = array("hey", "oe", "amigo", "robot", "Bender");
$preguntas6 = array("que te parecio", "parecio", "gusto");
$preguntas7 = array("di que me quieres");
$preguntas8 = array("pasatiempo", "hobbit", "tiempo libre");
$preguntas9 = array("perdon", "lo siento", "perdonas", "disculpas");
$respuestas1 = array("Hablo español", "Digo algunas palabras en ingles para impresionar :'v", "Solo español", "Suelo hablar en español", "Me se muchos idiomas");
$respuestas2 = array("bastante bien", "horrible, pero no quiero hablar sobre eso =v", "sin quejas");
$respuestas3 = array("¿Por que?", "¿Todo bien?", "Ah ok =v", "¿Que fue?", "¿Que paso?");
$respuestas4 = array("Claro", "¿En que?", "Si es tarea no", "Estoy ocupado =v");
$respuestas5 = array("¿Si?", "Dime", "Habla =v", "Que quieres, digo... dime :3");
$respuestas6 = array("Bien", "Mal", "Supongo que bien", "No se =v");
$respuestas7 = array("Te quiero");
$respuestas8 = array("Normalmente jugar", "Pues muchas cosas", "No mucho, por ser desarrollador web", "Nada en espeial creo");
$respuestas9 = array("Esta bien", "Vale, estas disculpado");
$estado_hacer_rpta = array("Hablando contigo", "Nada interesante");
$causa = array("por que", "por que?", "¿por que?", "why");
$consecuencia = array("Por que asi es la vida!", "");
$estadoBot = array("bien! :D", "excelente!", "No puedo quejarme");
$mantener = array("en fin.. dime en que te puedo ayudar", "interesante", "Parece que no te entiendo :c", "Ah bueno", "Vale... :v", "Fingire que te entendi =v");
$tema = array("que es", "what is", "como puedo", "que deberia", "podrias", "recomiendas", "como funciona", "quiero aprender", "aprender", "quiero", "mejorar");
$clima = array("clima", "temperatura");
$cities = array("arequipa", "nueva york", "los angeles", "seul", "paris", "osaka", "shanghai", "chicago", "sao paulo", "houston", "colonia", "pekin", "washington d.c", "canton", "ciudad de mexico", "singapur", "buenos aires", "milan", "toronto", "rio de janeiro", "san diego", "londres", "miami", "tokio", "brasilia", "alaska", "puno", "cuzco");
$hora = array("hora es", "hora", "time");
$TopicsJson = file_get_contents('topics.json');
$topics = json_decode("$TopicsJson", true);

//Funciones!!
function GiveHelp($msg, $dict)
{
  foreach ($dict as $value) {
    if (strpos($msg, $value['name']) !== false) {
      $topic = $value;
    }
  }
  if (!$topic) return "No puedo ayudarte con ese tema, soy desarrollador web :c";
  return $topic['descrption'] . " Este sitio podria ayudarte: " . $topic['link'];
}

function GetWeather($message, $arreglo)
{
  $city = '';
  $result = "La ";
  $finded = false;
  foreach ($arreglo as $item) {
    if (strpos($message, $item) !== false) {
      $city = $item;
      $finded = true;
    }
  }
  if (!$finded) $city = 'arequipa';
  $apiKey = "030b6a74a170ad8fd6b926a4f246da7c";
  $googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?q=" . $city . "&lang=es&units=metric&APPID=" . $apiKey;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  $response = curl_exec($ch);
  curl_close($ch);
  $data = json_decode($response);
  if (!$finded) {
    $result = "No encontramos tal ciudad, pero la ";
  }
  return $result . "temperatura en " . $data->name . " es de " . $data->main->temp . " grados, " . $data->weather[0]->description;
}

function Test($tmp, $arreglo)
{
  foreach ($arreglo as $item) {
    if (strpos($tmp, $item) !== false) return true;
  }
  return false;
}

function aleatorio($list)
{
  $ind = rand(0, sizeof($list) - 1);
  return $list[$ind];
}
