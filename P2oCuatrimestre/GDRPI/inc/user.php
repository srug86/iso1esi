<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

class User() {
  private $uid, $email, $password, $name, $surnames, $phone, $institution,     
    $tags, $cv, $area, $type;

  function __contruct__() {
    
  }

  function __destruct__() {


  }

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
      if ($_user['type'] != "secretary") {
        $area = $_mysql->
          field("SELECT name FROM areas WHERE id={$_user['aid']}");
        $position = "<strong>Área</strong> $area<br />";
        
        if ($_user['type'] == "attached") {
          $subarea = $_mysql->
            field("SELECT name FROM subareas "
                  ."WHERE aid={$_user['aid']} AND uid=$_uid"); 
          $position .= "<strong>Subárea</strong> $subarea<br />";
        }
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
      case "secretary": $color = "#db871a"; break; //ff950e
      case "coordinator": $color = "#6e407b"; break; //
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
  
  function user_nav() {
    global $_user;
    
    echo '
        <div id="body">
          <div id="left">
            <ul>';
    switch($_user['type']) {
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
}
?>
  