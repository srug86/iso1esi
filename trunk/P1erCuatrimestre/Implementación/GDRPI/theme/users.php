<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

function user_type() {
  global $_user;
  
  if (!isset($_user['typetxt'])) {
    $txt = "";
    switch ($_user['type']) {
    case "secretary": $txt = "Secretario"; break;
    case "coordinator": $txt = "Coordinador"; break;
    case "attached": $txt = "Adjunto"; break;
    case "expert": $txt = "Experto"; break;
    }
    $_user['typetxt'] = $txt;
    $_SESSION['user'] = $_user;
  }

  return $_user['typetxt'];
}

function user_refers() {
  global $_uid, $_mysql, $_user;

  if (!isset($_user['refers'])) {
    $position = "";
    switch($_user['type']) {
    case "coordinator": case "attached": case "expert":
      $area = $_mysql->
        field("SELECT name FROM areas WHERE id={$_user['area']}");
      $position = "<strong>Área</strong> $area<br />";
      break;
    case "attached":
      $subarea = $_mysql->field("SELECT name FROM subareas "
                                ."WHERE aid={$_user['area']} AND uid=$_uid");
      $position .= "<strong>Subárea</strong> $subarea<br />";
      break;
    }

    $refers = "{$_user['name']} {$_user['surnames']} "
      ."<br />$position<strong>Tlf</strong> {$_user['phone']}<br />"
      ."<strong>E-mail</strong> {$_user['email']}<br />"
      ."{$_user['institution']}";

    $_user['refers'] = $refers;
    $_SESSION['user'] = $_user;
  }

  return $_user['refers'];
}

function user_color() {
  global $_user;

  if (!isset($_user['color'])) {
    $color = "";
    switch ($_user['type']) {
    case "secretary": $color = "#ff950e"; break;
    case "coordinator": $color = "blue"; break;
    case "attached": $color = "green"; break;
    case "expert": $color = "#004586"; break;
    }
    $_user['color'] = $color;
    $_SESSION['user'] = $_user;
  }

  return $_user['color'];
}

function users_header() {
  global $_user;

  $type = user_type();
  $refers = user_refers();
  $color = user_color();

  echo '
<div id="header">
  <div id="type">'.$type.'</div>
  <div id="data">
    <div id="refers">'.$refers.'</div>
    <div id="photo">
      <img src="theme/images/'.$_user['type'].'.png" title="" />
    </div>
  </div>
</div>
     ';
}

function users_body() {
  echo '
<div id="body">
  <div id="left">
    <ul>
      <li class="loff">Paquetes de proyectos</li>
      <li id="lon">Modelos de evaluación</li>
      <li class="loff">Usuarios</li>
      <li class="loff">Áreas</li>
      <li class="loff">Datos personales</li>
    </ul>
  </div>
  <div id="right">
    <ul>
      <li id="ron">Vista general</li>
    </ul>
    <a id="logout" href="index.php?act=logout" alt="Salir">
      <strong>[ Salir ]</strong></a>
    <div id="content">
      <div id="buttons">
        <a href="#" alt="Añadir nuevo modelo">Añadir</a> |
        <a href="#" alt="Modificar modelo">Modificar</a> |
        <a href="#" alt="Eliminar modelo">Eliminar</a>
      </div>
    </div>
  </div>
  <div style="clear: both"></div>
</div>
  ';
}
?>
