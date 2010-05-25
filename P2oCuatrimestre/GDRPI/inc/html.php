<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

/*
 *   MAIN
 *   ~~~~
 */

function theme_view($view = null, $args = null) {
  global $_mysql, $_user;
  
  if ($view) {
    $csss = array("users.php", "login.css");
    theme_above($csss);
    include 'theme/login.php';
    login_header();
    login_body($args);
  }
  else {
    include 'theme/users.php';

    switch ($_user['type']) {
    case "secretary":
      $csss = array("users.php", "evalmodels.css", "dialog.php");
      $jss = array("evalmodels.js", "dialog.js");
      theme_above($csss, $jss);
      users_header();
      user_nav();
      include 'theme/evaluation_models.php';
      evaluation_models();
      break;

    case "coordinator":
      $csss = array("users.php", "evalreports.css");
      $jss = array("evalreports.js");
      theme_above($csss, $jss);
      users_header();
      user_nav();
      include 'theme/projects.php';
      coordinator_projects();
      break;

    case "attached":
      $csss = array("users.php", "evalreports.css", "dialog.php");
      $jss = array("projects.js", "evalreports.js", "dialog.js");
      theme_above($csss, $jss);
      users_header();
      user_nav();
      include 'theme/projects.php';
      attached_projects();
      break;

    case "expert":
      $csss = array("users.php", "evalreports.css", "dialog.php");
      $jss = array("evalreports.js", "dialog.js");
      theme_above($csss, $jss);
      users_header();
      user_nav();
      include 'theme/projects.php';
      expert_projects();
      break;
    }                 
  }
  theme_footer();
}

function theme_above($csss, $jss = array(), $onload = "") {
  global $_user;
  
  $title = "GDPRI - Gestión Distribuída de la Revisión de "
    ."Proyectos de Investigación";
  if ($_user) $title = $_user['name']." ".$_user['surnames']." | "
                .user_type($_user['type'])." | ".$title;

  /* Styles */
  $styles = "\n".'<link rel="stylesheet" type="text/css" '
    .'href="theme/css/main.css">'."\n";
  foreach ($csss as $style) {
    $styles .= '<link rel="stylesheet" type="text/css" '
      .'href="theme/css/'.$style.'">'."\n";
  }

  /* JavaScripts */
  $javascripts = "\n"
    .'<script type="text/javascript" src="js/jquery.js"></script>'."\n"
    .'<script type="text/javascript" src="js/main.js"></script>'."\n";
  foreach ($jss as $js) {
    $javascripts .= '<script type="text/javascript" src="js/'
      .$js.'"></script>'."\n";
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

/*
 *   PROJECTS
 *   ~~~~~~~~
 */

function coordinator_projects() {
  global $_mysql, $_uid, $_user;

  $r = $_mysql->rows("SELECT p.id, p.pid, p.name, p.state, p.aid, p.said "
                     ."FROM projects p, users u WHERE p.aid=u.aid "
                     ."AND u.id=$_uid ORDER BY p.id, p.pid DESC");
  echo '
    <div id="content">
      <div id="projects">
        <div id="buttons">
          <a href="javascript:make_report(\'coordinator\');"
             alt="">Ver / Modificar informe</a>
          <a href="javascript:end_report(\'coordinator\');"
             alt="">Validar informe</a>
          <a href="javascript:woimp();" alt="">Asignar subárea</a>
        </div>
        <div class="title">Proyectos asignados</div>
        <table>
          <tr id="trtop">
            <td></td><td>Nombre</td><td>Subárea</td>
            <td>Estado de la evaluación</td>
          </tr>';

  foreach ($r as $row) {
    $eval = 0;
    switch ($row['state']) {
    case "without_eval": $state = "Sin evaluación"; break;
    case "experts_evaluating": $state = "Expertos evaluando"; break;
    case "evaluated_experts": $state = "Evaluado por los expertos"; break;
    case "evaluated_attached": $state = "Evaluado por el adjunto"; break;
    case "validated_coordinator":
      $eval = 1; $state = "Validado por el coordinador"; break;
    }

    if ($row['said']) 
      $subarea = $_mysql->field("SELECT name FROM subareas WHERE "
                                ."id={$row['said']} AND aid={$row['aid']}");
    else $subarea = "Sin asignar";
    
    $id = 'pp'.$row['pid'].'p'.$row['id'];
    echo '
          <tr>
            <td>
              <input type="checkbox" name="'.$id.'" value="'.$eval.'" />
            </td>
            <td>'.$row['name'].'</td><td>'.$subarea.'</td><td>'.$state.'</td>
          </tr>';
  }
  echo '
        </table>
      </div>
    </div>
  </div>
  <div style="clear: both"></div>
</div>
        ';
}

function attached_projects() {
  global $_mysql, $_uid, $_user;

  $r = $_mysql->rows("SELECT p.id, p.pid, p.name, s.name AS sub, p.state "
                     ."FROM projects p, subareas s "
                     ."WHERE s.uid=$_uid AND p.said = s.id "
                     ."AND s.aid = p.aid ORDER BY p.id, p.pid DESC");
  echo '
    <div id="content">
      <div id="reports"></div>
      <div id="projects">
        <div id="buttons">
          <a href="javascript:make_report(\'attached\');"
             alt="">Realizar informe</a>
          <a href="javascript:end_report(\'attached\');"
             alt="">Finalizar informe</a>
          <a href="javascript:woimp();" alt="">Asignar expertos</a>
          <a href="javascript:woimp();" alt="">Valorar experto</a>
          <a href="javascript:woimp();" alt="">Subárea errónea</a>
        </div>
        <div class="title">Proyectos asignados</div>
        <table>
          <tr id="trtop">
            <td></td><td>Exps.</td><td>Nombre</td><td>Subárea</td>
            <td>Estado de la evaluación</td>
          </tr>';

  foreach ($r as $row) {
    $eval = 0; $locked = false;
    switch ($row['state']) {
    case "without_eval": $state = "Sin evaluación"; break;
    case "experts_evaluating": $state = "Expertos evaluando"; break;
    case "evaluated_experts": $state = "Evaluado por los expertos"; break;
    case "evaluated_attached":
    $eval = 1; $state = "Evaluado por el adjunto"; break;
    case "validated_coordinator":
    $locked = true; $state = "Validado por el coordinador"; break;
    }
    $id = 'pp'.$row['pid'].'p'.$row['id'];
    echo '
          <tr>
            <td>';
    
    if (!$locked)
      echo '<input type="checkbox" name="'.$id.'" value="'.$eval.'" />';
    else
      echo '<a href="javascript:view_report('.$id.')"
                   alt="Ver informe de evaluación">
                <img src="theme/images/view.png" alt="" /></a>';

    echo '
            </td>
            <td><a id="'.$id.'"
                  href="javascript:expand(\''.$id.'\')"
                  alt=""><img src="theme/images/expand.png" /></a></td>
            <td>'.$row['name'].'</td><td>'.$row['sub'].'</td><td>'.$state.'</td>
          </tr>';
  }
  echo '
        </table>
      </div>
    </div>
  </div>
  <div style="clear: both"></div>
</div>
        ';
}

/* Table of the experts assigned to a project */
function projects_experts() {
  global $_mysql, $_uid;

  $id = explode("p", substr($_POST['pro'], 2)); 

  $r = $_mysql->rows("SELECT er.id, u2.name, u2.surnames, er.state, "
                     ."u2.keywords "
                     ."FROM users u1, users u2, `experts-projects` ep, "
                     ."eval_reports er, subareas s, projects p "
                     ."WHERE u1.id=$_uid AND u1.id=s.uid AND s.id=p.said "
                     ."AND s.aid=p.aid AND p.id=ep.pid AND p.pid=ep.ppid "
                     ."AND ep.uid=u2.id AND p.pid=$id[0] AND p.id=$id[1] "
                     ."AND ep.rid=er.id ORDER BY ep.assign_date DESC");
  echo '
        <table>
          <tr id="trtop">
            <td></td><td>Nombre</td><td>Estado de la evaluación</td>
            <td>Palabras clave</td>
          </tr>';

  foreach ($r as $row) {
    $state = $row['state'] == "in_process" ? "En proceso" : "Terminada";
    
    echo '
          <tr>
            <td><a href="javascript:view_report('.$row['id'].')"
                   alt="Ver informe de evaluación">
                <img src="theme/images/view.png" alt="" /></a></td>
            <td>'.$row['name'].' '.$row['surnames'].'</td><td>'.$state.'</td>
            <td>'.$row['keywords'].'</td>
          </tr>';
  }
  echo '
        </table>';
}

/* Table of projects assigned to an expert */
function expert_projects() {
  global $_mysql, $_uid, $_user;

  $r = $_mysql->rows("SELECT er.id, p.name, s.name AS sub, er.state AS erst, "
                     ."p.state AS pst, "
                     ."ep.assign_date, (ep.assign_date+p.eval_time*24*60*60) "
                     ."AS eval_time FROM `experts-projects` ep, projects p, "
                     ."eval_reports er, subareas s WHERE ep.uid=$_uid AND "
                     ."p.said = s.id AND s.aid = p.aid "
                     ."AND p.pid = ep.ppid AND p.id = ep.pid "
                     ."AND er.id = ep.rid ORDER BY ep.assign_date DESC");
  echo '
    <div id="content">
      <div id="reports"></div>
      <div id="projects">
        <div id="buttons">
          <a href="javascript:make_report(\'expert\');"
             alt="">Realizar evaluación</a>
          <a href="javascript:end_report(\'expert\');"
             alt="">Finalizar evaluación</a>
        </div>
        <div class="title">Proyectos asignados</div>
        <table>
          <tr id="trtop">
            <td></td><td>Nombre</td><td>Subárea</td>
            <td>Estado de la evaluación</td>
            <td>Fecha de asignación</td><td>Fecha límite</td>
          </tr>';

  foreach ($r as $row) {
    $atime = strftime("%e/%I/%Y", $row['assign_date']);
    $etime = strftime("%e/%I/%Y", $row['eval_time']);

    $locked = true;
    if ($row['pst'] == "evaluated_attached") $state = "Evaluado por el adjunto";
    elseif ($row['pst'] == "validated_coordinator")
      $state = "Validado por el coordinador";
    else {
      $state = $row['erst'] == "in_process" ? "En proceso" : "Terminada";
      $locked = false;
      $eval = $state == "Terminada" ? 1 : 0;
    }

    echo '
          <tr>
            <td>';

    if (!$locked)
      echo '<input type="checkbox" name="'.$row['id'].'" value="'.$eval.'" />';
    else
      echo '<a href="javascript:view_report('.$row['id'].')"
                   alt="Ver informe de evaluación">
                <img src="theme/images/view.png" alt="" /></a>';

    echo '</td>
            <td>'.$row['name'].'</td><td>'.$row['sub'].'</td><td>'.$state.'</td>
            <td>'.$atime.'</td><td>'.$etime.'</td>
          </tr>';
  }
  echo '
        </table>
      </div>
    </div>
  </div>
  <div style="clear: both"></div>
</div>
        ';
}

/*
 *   MODELS
 *   ~~~~~~
 */

function list_models() {
  global $_mysql;
  
  echo '
    <div id="content">
      <div id="evmods">
        <div id="buttons">
          <a href="javascript:new_model();" alt="Añadir modelo">Añadir</a>
          <a href="javascript:mod_model();"
             alt="Modificar modelo">Modificar</a>
          <a href="javascript:del_model();" alt="Eliminar modelo">Eliminar</a>
        </div>
        <div id="new"></div>
        <div class="title">Modelos de evaluación registrados</div>
        <table>
          <tr id="trtop">
            <td></td><td>ID</td><td>Paquete de la convocatoria</td>
            <td>Nº Proyectos</td><td>Nº Secciones</td><td>Nº Elementos</td>
          </tr>';

  $rows = $_mysql->
    rows("SELECT e.id, p.name, e.sections, e.elements "
         ."FROM eval_models e, projects_packages p "
         ."WHERE p.id=e.cppid ORDER by e.id DESC");
    
  foreach ($rows as $r) {
    $num = $_mysql->
      field("SELECT count(id) FROM projects WHERE emid={$r['id']}");
    echo '<tr><td><input type="checkbox" name="'.$r['id'].'" value="'.$num
      .'" /></td>'
      .'<td>'.$r['id'].'</td><td>'.$r['name'].'</td>'
      .'<td>'.$num.'</td><td>'.$r['sections'].'</td><td>'
      .$r['elements'].'</td></tr>';
  }
  
   echo '
        </table>
      </div>
    </div>
  </div>
  <div style="clear: both"></div>
</div>
  ';
}
