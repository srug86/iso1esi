<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

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
             alt="">Ver / Modificar evaluación</a>
          <a href="javascript:end_report(\'coordinator\');"
             alt="">Validar evaluación</a>
          <a href="javascript:woimp();" alt="">Asignar subárea</a>
        </div>
        <div class="title">Proyectos asignados</div>
        <table>
          <tr id="trtop">
            <td></td><td>Nombre</td><td>Subárea</td>
            <td>Estado de la evaluación</td>
          </tr>';

  foreach ($r as $row) {
    switch ($row['state']) {
    case "without_eval": $state = "Sin evaluación"; break;
    case "experts_evaluating": $state = "Expertos evaluando"; break;
    case "evaluated_experts": $state = "Evaluado por los expertos"; break;
    case "evaluated_attached": $state = "Evaluado por el adjunto"; break;
    case "validated_coordinator": $state = "Validado por el coordinador"; break;
    }

    if ($row['said']) 
      $subarea = $_mysql->field("SELECT name FROM subareas WHERE "
                                ."id={$row['said']} AND aid={$row['aid']}");
    else $subarea = "Sin asignar";
    
    $id = 'pp'.$row['pid'].'p'.$row['id'];
    echo '
          <tr>
            <td>
              <input type="checkbox" name="'.$id.'" />
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
             alt="">Realizar evaluación</a>
          <a href="javascript:end_report(\'attached\');"
             alt="">Finalizar evaluación</a>
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
    switch ($row['state']) {
    case "without_eval": $state = "Sin evaluación"; break;
    case "experts_evaluating": $state = "Expertos evaluando"; break;
    case "evaluated_experts": $state = "Evaluado por los expertos"; break;
    case "evaluated_attached": $state = "Evaluado por el adjunto"; break;
    case "validated_coordinator": $state = "Validado por el coordinador"; break;
    }
    $id = 'pp'.$row['pid'].'p'.$row['id'];
    echo '
          <tr>
            <td>
              <input type="checkbox" name="'.$id.'" />
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

  $r = $_mysql->rows("SELECT er.id, p.name, s.name AS sub, er.state, "
                     ."ep.assign_date, (ep.assign_date+p.eval_time*24*60*60) "
                     ."AS eval_time FROM `experts-projects` ep, projects p, "
                     ."eval_reports er, subareas s WHERE ep.uid=$_uid AND "
                     ."p.said = s.id AND s.aid = p.aid "
                     ."AND p.pid = ep.ppid AND p.id = ep.pid "
                     ."AND er.id = ep.rid ORDER BY ep.assign_date DESC");
  echo '
    <div id="content">
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
    $state = $row['state'] == "in_process" ? "En proceso" : "Terminada";
    
    echo '
          <tr>
            <td><input type="checkbox" name="'.$row['id'].'" /></td>
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
?>