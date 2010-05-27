<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

/*
 *   HTML
 *   ~~~~
 */
  
function default_() {
  global $mysql, $user;
  
  switch ($user->getType()) {
  case "secretary":
    $css = array("users.php", "models.css", "dialog.php");
    $js = array("models.js", "dialog.js");
    above($css, $js);
    header_();
    navigator();
    ModelManager::list_models();
    break;
    
  case "coordinator":
    $css = array("users.php", "reports.css");
    $js = array("reports.js");
    above($css, $js);
    header_();
    navigator();
    ProjectManager::coordinator_projects();
    break;
    
  case "attached":
    $css = array("users.php", "reports.css", "dialog.php");
    $js = array("projects.js", "reports.js", "dialog.js");
    above($css, $js);
    header_();
    navigator();
    ProjectManager::attached_projects();
    break;
    
  case "expert":
    $css = array("users.php", "reports.css", "dialog.php");
    $js = array("reports.js", "dialog.js"); 
    above($css, $js);
    header_();
    navigator();
    ProjectManager::expert_projects();
    break;
  }
  footer();
}

function header_() {
  global $user;
  
  $type = $user->getType();
  $typetxt = $user->getTypeTxt();
  $refers = $user->getRefers();
  
  echo '
      <div id="header">
        <div id="type">'.$typetxt.'</div>
        <div id="data">
          <div id="refers">'.$refers.'</div>
          <div id="photo">
            <img src="img/'.$type.'.png" title="" />
          </div>
        </div>
      </div>
           ';
}

function navigator() {
  global $user;
  
  echo '
      <div id="body">
        <div id="left">
          <ul>';
  switch($user->getType()) {
  case "secretary":
    echo '
            <li class="loff">Paquetes de proyectos</li>
            <li id="lon">Modelos de evaluación</li>
            <li class="loff">Usuarios</li>
            <li class="loff">Áreas</li>
            <li class="loff">Datos personales</li>';
    break;
    
  case "coordinator":
    echo '
            <li id="lon">Proyectos</li>
            <li class="loff">Subáreas</li>
            <li class="loff">Datos personales</li>';
    break;
    
  case "attached":
    echo '
            <li id="lon">Proyectos</li>
            <li class="loff">Datos personales</li>';
    break;
    
  case "expert":
    echo '
            <li id="lon">Proyectos</li>
            <li class="loff">Datos personales</li>';
    break;
  }
  
  $msg = "";
  if (isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
  }
  echo '
          </ul>
        </div>
        <div id="right">
          <p id="msg">'.$msg.'</p>
          <a id="logout" href="index.php?act=logout" alt="Salir">
            <strong>[ Salir ]</strong></a>
      ';
}

function above($css, $js = array(), $onload = "") {
  global $user;

  
  $title = "GDPRI - Gestión Distribuída de la Revisión de "
    ."Proyectos de Investigación";
  
  if ($user) {
    $name = $user->getName();
    $surnames = $user->getSurNames();
    $typetxt = $user->getTypeTxt();

    $title = $name." ".$surnames." | ".$typetxt." | ".$title;
  }

  /* Styles */
  $styles = "\n".'<link rel="stylesheet" type="text/css" '
    .'href="css/main.css">'."\n";
  foreach ($css as $style) {
    $styles .= '<link rel="stylesheet" type="text/css" '
      .'href="css/'.$style.'">'."\n";
  }

  /* JavaScripts */
  $javascripts = "\n"
    .'<script type="text/javascript" src="js/jquery.js"></script>'."\n"
    .'<script type="text/javascript" src="js/main.js"></script>'."\n";
  foreach ($js as $j) {
    $javascripts .= '<script type="text/javascript" src="js/'
      .$j.'"></script>'."\n";
  }

  $date = time();
  $date = strftime("%e de ", $date).ucfirst(strftime("%B", $date)).
    strftime(" de %Y", $date);

  header('Content-Type: text/html; charset=UTF-8');

  echo '<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
          "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
<title>'.$title.'</title>
'.$styles.'
'.$javascripts.'
</head>

<body'.$onload.'>
<div id="container">
  <div id="top">
    <div id="title">Gestión Distribuída de la
      Revisión de Proyectos de Investigación</div>
    <div id="date">'.$date.'</div>
  </div>';
}

function footer() {
  echo '
    <div id="footer">
      <div id="institutions">
        <div id="esi">
          <a target="_blank" href="http://www.esi.uclm.es" alt="UCLM">
            <img src="img/esi-g.png" width="63" height="70"
                 title="Escuela Superior de Informática" /></a>
        </div>
        <div id="uclm">
          <a target="_blank" href="http://www.uclm.es" alt="ESI UCLM">
            <img src="img/uclm-g.jpg" width="105" height="70"
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
            <img src="img/valid-xhtml10-g.gif" width="88" height="31"
               title="XHTML 1.0 Estricto Válido" /></a>
          <a target="_blank" alt="CSS Válido"
             href="http://jigsaw.w3.org/css-validator/check/referer">
            <img src="img/valid-css-g.gif" width="88" height="31"
                 title="CSS Válido" /></a>
        </div>
        <div id="right">
          <a target="_blank" href="http://www.mysql.com/" alt="MySQL">
            <img src="img/mysql-g.gif" width="88" height="31"
               title="MySQL" /></a>
          <a target="_blank" href="http://jquery.com/" alt="jQuery">
          <img src="img/jquery-g.png" width="88" height="31"
               title="jQuery" /></a>
        </div>
        <a target="_blank" href="http://www.apache.com/" alt="Apache 2.0">
          <img src="img/apache-g.gif" width="88" height="31"
               title="Apache 2.0" /></a>
        <a target="_blank" href="http://www.php.net/" alt="PHP">
          <img src="img/php-g.gif" width="88" height="31"
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

/*
 *   LOGIN
 *   ~~~~~
 */

function login_form($error = null) {
  $css = array("users.php", "login.css");
  above($css);
  login_header();
  login_body($error);
  footer();
}

function login_header() {
  echo '
        <div id="header" style="background-color: red;">
          <div id="type">Acceso</div>
        </div>
        ';
}

function login_body($error = false) {
  global $_uid, $_op;
  
  $error = $error ? "Usuario o contraseña incorrecta" : "";

  echo '<div id="body">
          <div id="error">'.$error.'</div>
          <div id="loginform">
            <form action="index.php?act=login" method="post" name="acceso">
	      <table>
	        <tr>
                  <td class="tright"><b>ID Usuario</b></td>
		  <td class="tleft"><input type="text" name="userid" /></td>
                </tr>
  	        <tr>
                  <td class="tright"><b>Contraseña</b></td>
                  <td class="tleft"><input type="password" name="pass" /></td>
                </tr>
	        <tr>
                  <td colspan="2">
                    <input type="checkbox" value="1" name="remind" /> 
                    Recordarme &nbsp;&nbsp;&nbsp;
                    <input type="submit" value="Entrar" /></td></tr>
	      </table>
	    </form>
	  </div>
	  <div id="forgot">
            <a href="" alt="">¿Ha olvidado su contraseña?</a></div>
        </div>
        ';
}

