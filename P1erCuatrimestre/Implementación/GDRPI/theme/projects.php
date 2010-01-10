<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

function projects() {
  global $_mysql, $_user;

  $r = $_mysql->assoc("SELECT er.id, p.name, s.name AS sub, er.state, "
                      ."ep.assign_date, "
                      ."(ep.assign_date+p.eval_time*24*60*60) AS eval_time "
                      ."FROM `experts-projects` ep, projects p, eval_reports er"
                      .", subareas s WHERE p.said = s.id AND s.aid = p.aid "
                      ."AND p.pid = ep.ppid AND p.id = ep.pid "
                      ."AND er.id = ep.rid ORDER BY ep.assign_date DESC");

  echo '
    <div id="content">
      <div id="projects">
        <div id="buttons">
          <a href="javascript:make_report();" alt="">Realizar evaluación</a>
          <a href="javascript:end_report();" alt="">Finalizar evaluación</a>
        </div>
        <div id="new"></div>
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