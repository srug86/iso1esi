<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

function theme_view($view = null, $args = null) {
  switch ($view) {
  case "login":
    $csss = array("users.php", "login.css");
    theme_above($csss);
    include 'theme/login.php';
    login_header();
    login_body($args);
    break;

  case "user":
    $csss = array("users.php");
    theme_above($csss);
    include 'theme/users.php';
    users_header();
    users_body();
    break;
                 
  }
  theme_footer();
}

function theme_above($csss, $jss = array(), $onload = "") {
  global $_name, $_last_names, $_type;
  
  $title = "GDPRI - Gestión Distribuída de la Revisión de "
    ."Proyectos de Investigación";
  if ($_name) $title = $_name." ".$_last_names." | ".user_type($_type)
                ." | ".$title;

  /* Styles */
  $styles = "\n".'<link rel="stylesheet" type="text/css" href="css/main.css">
';
  foreach ($csss as $style) {
    $styles .= '<link rel="stylesheet" type="text/css" '
      .'href="css/'.$style.'">'."\n";
  }

  /* JavaScripts */
  $javascripts = "\n"
    .'<script type="text/javascript" src="js/jquery.js"></script>'."\n"
    .'<script type="text/javascript" src="js/main.js"></script>'."\n";
  foreach ($jss as $js) {
    $javascripts .= '<script type="text/javascript" src="js/'
      .$js.'.js"></script>';
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
'.$javascripts.'
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
      <div id="institutions">
        <div id="esi">
          <a target="_blank" href="http://www.esi.uclm.es" alt="UCLM">
            <img src="theme/images/esi-g.png" width="63" height="70"
                 title="Escuela Superior de Informática" /></a>
        </div>
        <div id="uclm">
          <a target="_blank" href="http://www.uclm.es" alt="ESI UCLM">
            <img src="theme/images/uclm-g.jpg" width="105" height="70"
                 title="Universidad de Castilla-La Mancha" /></a>
        </div>
        <div id="txt">Escuela Superior de Informática<br />
          Paseo de la Universidad, 4<br />
          13071 Ciudad Real<br />
          Tlf: 926 29 53 00 Fax: 926 29 53 54</div>
      </div>
      <div id="powered">
        <div id="left">
          <a target="_blank" href="http://validator.w3.org/check?uri=referer"
             alt="XHTML 1.0 Estricto Válido">
            <img src="theme/images/valid-xhtml10-g.gif" width="88" height="31"
               title="XHTML 1.0 Estricto Válido" /></a>
          <a target="_blank" alt="CSS Válido"
             href="http://jigsaw.w3.org/css-validator/check/referer">
            <img src="theme/images/valid-css-g.gif" width="88" height="31"
                 title="CSS Válido" /></a>
        </div>
        <div id="right">
          <a target="_blank" href="http://www.mysql.com/" alt="MySQL">
            <img src="theme/images/mysql-g.gif" width="88" height="31"
               title="MySQL" /></a>
          <a target="_blank" href="http://jquery.com/" alt="jQuery">
          <img src="theme/images/jquery-g.png" width="88" height="31"
               title="jQuery" /></a>
        </div>
        <a target="_blank" href="http://www.apache.com/" alt="Apache 2.0">
          <img src="theme/images/apache-g.gif" width="88" height="31"
               title="Apache 2.0" /></a>
        <a target="_blank" href="http://www.php.net/" alt="PHP">
          <img src="theme/images/php-g.gif" width="88" height="31"
               title="PHP" /></a>
      </div>
      <div id="authors">
        <a target="_blank" href=
           "https://campusvirtual.uclm.es/user/view.php?id=98387&course=6750"
           alt="Perfil en Campus Virtual">
          Sergio de la Rubia García-Carpintero</a> |
        <a target="_blank" href=
           "https://campusvirtual.uclm.es/user/view.php?id=100255&course=6750"
           alt="Perfil en Campus Virtual">
          Miguel Millán Sánchez-Grande</a> |
        <a target="_blank" href=
           "https://campusvirtual.uclm.es/user/view.php?id=99750&course=6750"
           alt="Perfil en Campus Virtual">
          Luis Muñoz Villarreal</a> |
        <a target="_blank" href=
           "https://campusvirtual.uclm.es/user/view.php?id=107335&course=6750"
           alt="Perfil en Campus Virtual">
          Alicia Serrano Sánchez</a> |
        <a target="_blank" href=
           "https://campusvirtual.uclm.es/user/view.php?id=100233&course=6750"
           alt="Perfil en Campus Virtual">
          Juan Miguel Torres Triviño</a>
      </div>
    </div>
  </div>
</body>
</html>';
}
?>
