<?php

  //DATA (arreglos)
  $saludos = array("hola","hi","hola","hello");
  $ofensas = array("inutil","me llegas","eres un");
  $estado = array("como estas","que tal","como te va");
  $causa = array("por","why");
  $consecuencia = array("por que asi es la vida", "no lo se rick","por que me dejo mi novia");
  $estadoBot = array("bien","mal","Sad");
  $mantener = array("y.. cuentame algo","Como te va","eeen fin..","No entiendo");
  $tema = array("que es","what is","como puedo","que deberia","podrias");
  $clima = array("clima","temperatura");
  $cities = array("arequipa","londres","miami","tokio","brasilia","alaska","puno","cuzco");
  $hora = array("hora es", "hora","time");
  $TopicsJson = file_get_contents('topics.json');
  $topics = json_decode("$TopicsJson",true);


  //Funciones!!
  function GiveHelp($msg,$dict){
    foreach($dict as $value){
      if(strpos($msg,$value['name']) !== false) {
        $topic = $value;
      }
    }
    if(!$topic) return "No puedo ayudarte con ese tema :c";
    return $topic['descrption']. " Este sitio podria ayudarte: " . $topic['link'];
  }

  function GetWeather($message,$arreglo){
    $city = '';
    $result = "La ";
    $finded = false;
    foreach($arreglo as $item){
      if(strpos($message,$item) !== false) {
        $city = $item;
        $finded = true;
      }
    }
    if(!$finded) $city='arequipa';
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
    if(!$finded){
      $result = "No encontramos tal ciudad, pero la ";
    }
    return $result . "temperatura en " . $data->name . " es de " . $data->main->temp . " grados, " . $data->weather[0]->description;

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
?>
