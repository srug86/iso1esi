<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

class ProjectManager {
  public function coordinator_projects() {
    global $mysql, $_uid;
  
    $r = $mysql->
      rows("SELECT p.id, p.pid, p.name, p.state, p.aid, p.said "
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
        $subarea = $mysql->field("SELECT name FROM subareas WHERE "
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
  
  public function attached_projects() {
    global $mysql, $_uid;
  
    $r = $mysql->rows("SELECT p.id, p.pid, p.name, s.name AS sub, p.state "
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
         <a href="javascript:assign_experts(false);" alt="">Asignar expertos</a>
            <a href="javascript:valuate_expert();" alt="">Valorar experto</a>
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
        echo '<a href="javascript:view_report(\''.$id.'\')"
                     alt="Ver informe de evaluación">
                  <img src="img/view.png" alt="" /></a>';
  
      echo '
              </td>
              <td><a id="'.$id.'"
                    href="javascript:expand(\''.$id.'\')"
                    alt=""><img src="img/expand.png" /></a></td>
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
  public function projects_experts() {
    global $mysql, $_uid;
  
    $id = explode("p", substr($_POST['pro'], 2)); 
  
    $r = $mysql->
      rows("SELECT er.id, u2.name, u2.surnames, er.state, "
           ."u2.keywords "
           ."FROM users u1, users u2, `experts-projects` ep, "
           ."eval_reports er, subareas s, projects p "
           ."WHERE u1.id=$_uid AND u1.id=s.uid AND s.id=p.said "
           ."AND s.aid=p.aid AND p.id=ep.pid AND p.pid=ep.ppid "
           ."AND ep.uid=u2.id AND p.pid=$id[0] AND p.id=$id[1] "
           ."AND ep.rid=er.id ORDER BY ep.assign_date DESC");
    echo '
          <table id="experts">
            <tr id="trtop">
              <td></td><td></td><td>Nombre</td><td>Estado de la evaluación</td>
              <td>Palabras clave</td>
            </tr>';
  
    foreach ($r as $row) {
      $state = $row['state'] == "in_process" ? "En proceso" : "Terminada";
      
      echo '
            <tr>
              <td><a href="javascript:view_report('.$row['id'].')"
                     alt="Ver informe de evaluación">
                  <img src="img/view.png" alt="" /></a></td>
              <td><input type="checkbox" name="'.$row['id'].'" />
              <td>'.$row['name'].' '.$row['surnames'].'</td><td>'.$state.'</td>
              <td>'.$row['keywords'].'</td>
            </tr>';
    }
    echo '
          </table>';
  }
  
  /* Table of projects assigned to an expert */
  public function expert_projects() {
    global $mysql, $_uid;
  
    $r = $mysql->rows("SELECT er.id, p.name, s.name AS sub, er.state AS erst, "
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
      if ($row['pst'] == "evaluated_attached")
        $state = "Evaluado por el adjunto";
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
        echo '<input type="checkbox" name="'.$row['id'].'" value="'.
          $eval.'" />';
      else
        echo '<a href="javascript:view_report('.$row['id'].')"
                     alt="Ver informe de evaluación">
                  <img src="img/view.png" alt="" /></a>';
  
      echo '</td>
              <td>'.$row['name'].'</td><td>'.$row['sub'].'</td><td>'.
        $state.'</td>
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

  public function assign_experts() {
    global $mysql;

    $p = explode("p", substr($_POST['pro'], 2));
    $ppid = $p[0];
    $pid = $p[1];
    $date = time();
    $ids = split(",", $_POST['ids']);
    foreach ($ids as $uid) {
      $mod = $mysql->field("SELECT emid FROM projects "
                           ."WHERE id=$pid AND pid=$ppid");
      $mysql->query("INSERT INTO eval_reports SET emid=$mod");
      $rid = $mysql->field("SELECT id FROM eval_reports ORDER BY id DESC");
      $mysql->query("INSERT INTO `experts-projects` SET uid=$uid, ppid=$ppid, "
                    ."pid=$pid, rid=$rid, assign_date=$date");
    }
  }
}