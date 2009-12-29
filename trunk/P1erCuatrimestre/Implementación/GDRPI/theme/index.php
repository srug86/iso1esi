<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

function main_above() {
  $title = ;
  $style = '<link rel="stylesheet" type="text/css" href="css/{$css}.css">';    
  $onload = ;
  
  header('Content-Type: text/html; charset=UTF-8');

  echo '
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
          "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
$styles
<title>$title</title>
</head>

<body$onload>';
  <div id="container">
}

function main_footer() {
  echo '
    <div id="footer">
      <div id="authors">
        Sergio de la Rubia García-Carpintero | Miguel Millán Sánchez-Grande |
        Luis Muñoz Villarreal | Juan Miguel Torres Triviño
      </div>
      <div id="institutions">
        <div id="esi">
          
        </div>
        <div id="uclm">

        </div>
      </div>
      <div id="powered"></div>
    </div>
  ';
}

function main_below() {
  //Tiempo de ejecución
  //Créditos: autores, asignatura, escuela(dirección, teléfono, extensión), universidad
  //Logos: xhtml, css, mysql, php, javascript, escuela, uclm
  echo '
  </div>
</body>
</html>';

}
?>
