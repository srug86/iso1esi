<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

function theme_view($view = null) {
  switch ($view) {
  case 'login':
    $csss = array("login");
    theme_above($csss);
    include 'theme/login.php';
    login_header();
    login_page();
    breaK;
  }
  theme_footer();
}

function theme_above($csss, $onload = "") {
  global $_name, $_last_names, $_type;
  
  switch ($_type) {
  case "secretary": $type = "Secretario"; break;
  case "coordinator": $type = "Coordinador"; break;
  case "attached": $type = "Adjunto"; break;
  case "expert": $type = "Experto"; break;
  }
  
  $title = "GDPRI - Gestión Distribuída de la Revisión de "
    ."Proyectos de Investigación";
  if ($_name) $title = $_name." ".$_last_names." | ".$_type." | ".$title;

  $styles = "\n".'<link rel="stylesheet" type="text/css" href="css/main.css">
';
  foreach ($csss as $style) {
    $styles .= '<link rel="stylesheet" type="text/css" '
      .'href="css/'.$style.'.css">'."\n";
  }

  $date = time();
  $date = strftime("%d de ", $date).ucfirst(strftime("%B", $date)).
    strftime(" de %Y", $date);
  
  header('Content-Type: text/html; charset=UTF-8');

  echo '<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
          "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
'.$styles.'
<title>'.$title.'</title>
</head>

<body'.$onload.'>
  <div id="container">
    <div id="top">
      <div id="title">Gestión Distribuída de la 
        Revisión de Proyectos de Investigación</div>
      <div id="date">'.$date.'</div>
    </div>';
}

function theme_footer() {
  echo '
    <div id="footer">
      <div id="authors">
        Sergio de la Rubia García-Carpintero | Miguel Millán Sánchez-Grande |
        Luis Muñoz Villarreal | Alicia Serrano Sánchez | Juan Miguel Torres
        Triviño
      </div>
      <div id="institutions">
        <div id="esi">
          
        </div>
        <div id="uclm">

        </div>
      </div>
      <div id="powered"></div>
    </div>
  </div>
</body>
</html>';
}
?>
