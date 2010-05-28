<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

class ReportManager {
  public function make_report() {
    global $user;
  
    if ($user->getType() == "expert") ReportManager::make_expert_report();
    else ReportManager::make_attached_report();
  }
  
  public function make_expert_report() {
    global $mysql, $_uid;
    
    $rep = $_POST['rep'];
  
    $r = $mysql->row("SELECT em.structure, er.data, p.memory "
                      ."FROM eval_models em, eval_reports er, projects p, "
                      ."`experts-projects` ep WHERE er.id=$rep AND ep.uid=$_uid"
                      ." AND em.id=er.emid AND er.id=ep.rid AND ep.pid = p.id "
                      ."AND ep.ppid = p.pid");
  
    $st = unserialize($r['structure']);
    $data = unserialize($r['data']);
  
    echo '
      <div id="mem">'.$r['memory'].'</div>
      <div id="report">
        <form method="post" action="index.php?act=saverep">
          <input type="hidden" name="id" value="'.$rep.'" />
          ';
  
    ReportManager::struct_report($st, $data);
    
    echo '
      <input type="submit" value="Guardar" />
      <input type="hidden" name="end" value="0" />
      <input type="submit" value="Finalizar" onclick="set_end_report()" />
  </form></div>';
  }
  
  public function make_attached_report() {
    global $mysql, $_uid;
  
    $rep = $_POST['rep'];
    $ppid = substr($rep, 2, strpos($rep, "p", 2)-2);
    $pid = substr($rep, strpos($rep, "p", 2)+1);
  
    $r = $mysql->row("SELECT em.structure, p.final_report "
                      ."FROM eval_models em, projects p "
                      ."WHERE em.id=p.emid AND p.id=$pid AND p.pid=$ppid");
  
    $st = unserialize($r['structure']);
    $data = unserialize($r['final_report']);
    
    echo '
      <div id="report">
        <form method="post" action="index.php?act=saverep">
          <input type="hidden" name="id" value="'.$rep.'" />
          ';
  
    ReportManager::struct_report($st, $data);
    
    echo '
      <input type="submit" value="Guardar" />
      <input type="hidden" name="end" value="0" />
      <input type="submit" value="Finalizar" onclick="set_end_report()" />
  </form></div>';
  }
  
  public function struct_report($st, $data) {
    $nsec = 0;
    foreach ($st as $i => $sec) {
      echo '<p class="sec">'.($i+1).'. '.$sec['txt'].'</p>';
      $nel = 0;
      foreach ($sec['els'] as $j => $el) {
        $type = key($el);
        $el = $el[$type];
        $datrep = isset($data[$nsec]['els'][$nel][$type]) ?
          $data[$nsec]['els'][$nel][$type] : "";
  
        switch ($type) {
        case "are":
          echo '<div class="form"><textarea name="'
            .'sec['.$nsec.'][els]['.$nel.']['.$type.']">'
            .$datrep.'</textarea></div>';
          break;
  
        case "fie":
          echo '<div class="form"><p>'.$el.'</p></div>';
          break;
  
        case "lst": 
          echo '
            <div class="form">
              <select name="sec['.$nsec.'][els]['.$nel.']['.$type.']">
               ';
          foreach ($el as $k => $txt) {
            $selected = $k == $datrep ? ' selected="selected"' : '';
            echo '<option value="'.$k.'"'.$selected.'>'.$txt.'</option>';
          }
          echo '</select></div>';
          break;
          
        case "rad":
          echo '<div class="form">';
          foreach ($el as $k => $txt) {
            $check = $k == $datrep ? ' checked="checked"' : '';
            echo '<p><input type="radio" '
                 .'name="sec['.$nsec.'][els]['.$nel.']['.$type.']" '
                 .'value="'.$k.'"'.$check.' /> '.$txt.'</p>';
          }
          echo '</div>';
          break;
          
        case "chk":
          echo '<div class="form">';
          foreach ($el as $k => $txt) {
            $check = isset($datrep[$k]) ? ' checked="checked"' : '';
            echo '<p><input type="checkbox" '
                 .'name="sec['.$nsec.'][els]['.$nel.']['.$type.']['.$k.']" '
                 .'value="1"'.$check.' /> '.$txt.'</p>';
          }
          echo '</div>';
          break;
        }
        $nel++;
      }
      $nsec++;
    }
  }
  
  public function view_report() {
    global $mysql;
  
    $id = $_POST['id'];
  
    if (preg_match('/^pp([[:digit:]]+)p([[:digit:]]+)$/', $id, $matches)) {
      $pp = $matches[1];
      $p = $matches[2];
      $r = $mysql->
        row("SELECT p.name as pname, u.name, u.surnames, "
            ."em.structure, p.final_report as data FROM eval_models "
            ."em, users u, projects p WHERE p.pid=$pp AND p.id=$p "
            ."AND em.id=p.emid AND u.aid=p.aid AND "
            ."u.type='coordinator'");
    }
    else
      $r = $mysql->
        row("SELECT p.name as pname, u.name, u.surnames, "
            ."em.structure, er.data"
            ." FROM eval_models em, eval_reports er, users u, "
            ."projects p, `experts-projects` ep WHERE er.id=$id AND "
            ."er.emid=em.id AND ep.rid=er.id AND ep.ppid=p.pid AND "
            ."ep.pid=p.id AND ep.uid=u.id");
  
    $st = unserialize($r['structure']);
    $data = unserialize($r['data']);
  
    $txt = "";
    if (!$data) $txt = "El informe de evaluación está vacío";
    else {
      $nsec = 0;
      foreach ($st as $i => $sec) {
        $txt .= '<p class="sec">'.($i+1).'. '.$sec['txt'].'</p>';
        $nel = 0;
        foreach ($sec['els'] as $j => $el) {
          $type = key($el);
          $el = $el[$type];
          $datrep = isset($data[$nsec]['els'][$nel][$type]) ?
            $data[$nsec]['els'][$nel][$type] : "";
  
          switch ($type) {
          case "are": $txt .= '<p>'.$datrep.'</p>'; break;
          case "fie": $txt .= '<p>'.$el.'</p>'; break;
          case "lst": $txt .= '<p>'.$datrep != "" ? $el[$datrep] : ""
            .'</p>'; break;
          case "rad": $txt .= '<p>'.$el[$datrep].'</p>'; break;
          case "chk":
            foreach ($el as $k => $str)
              if (isset($datrep[$k])) $txt .= '<p>'.$str.'</p>';
            break;
          }
          $nel++;
        }
        $nsec++;
      }
    }
  
    echo '
        <div id="report'.$id.'" title="'.$r['pname'].'. '.$r['name'].' '.
          $r['surnames'].'" style="display: none;" class="reports">'.
          $txt.'</div>';
  }
  
  public function save_report() {
    global $user;
  
    if ($user->getType() == "expert") ReportManager::save_expert_report();
    else ReportManager::save_cooratta_report();
  }
  
  public function save_cooratta_report() {
    global $mysql, $user;
  
    $id = $_POST['id'];
    $ppid = substr($id, 2, strpos($id, "p", 2)-2);
    $pid = substr($id, strpos($id, "p", 2)+1);
    
    $data = serialize($_POST['sec']);
  
    $end = "";
    if ($_POST['end'] == 1) {
      $state = $user->getType() == "coordinator" ? "validated_coordinator"
        : "evaluated_attached";
      $end = ", state='$state'";
    }
  
    $mysql->query("UPDATE projects SET final_report='$data'$end "
                 ."WHERE id=$pid AND pid=$ppid");
    $_SESSION['msg'] = "Informe guardado con éxito";
    header("Location: ./");
  }
  
  public function save_expert_report() {
    global $mysql;
    
    $data = serialize($_POST['sec']);
    $end = $_POST['end'] == 1 ? ", state='done'" : "";
    $id = $_POST['id'];
    $mysql->query("UPDATE eval_reports SET data='$data'$end WHERE id=$id");
    $_SESSION['msg'] = "Evaluación guardada con éxito";
  
    if ($end) ReportManager::evaluated_expert($id);
    
    header("Location: ./");
  }
  
  public function end_report() {
    global $mysql, $user;
  
    $id = $_POST['id'];
    if ($user->getType() == "expert") 
      $sql = "UPDATE eval_reports SET state='done' WHERE id=$id";
    else  {
      $ppid = substr($id, 2, strpos($id, "p", 2)-2);
      $pid = substr($id, strpos($id, "p", 2)+1);
      if ($user->getType() == "coordinator")
        $sql = "UPDATE projects SET state='validated_coordinator' "
          ."WHERE id=$pid AND pid=$ppid";
      else if ($user->getType() == "attached")
        $sql = "UPDATE projects SET state='evaluated_attached' "
          ."WHERE id=$pid AND pid=$ppid";
    }
    
    $mysql-> query($sql);
    if ($user->getType() == "expert") ReportManager::evaluated_expert($id);
    $_SESSION['msg'] = "Evaluación finalizada con éxito";
  }
  
  public function evaluated_expert($id) {
    global $mysql;
    
    $r = $mysql->
      row("SELECT COUNT(DISTINCT er.state) AS n, ep1.ppid, ep1.pid "
          ."FROM eval_reports er, `experts-projects` ep1, "
          ."`experts-projects` ep2 WHERE ep1.rid=$id AND "
          ."ep1.ppid=ep2.ppid AND ep1.pid=ep2.pid AND ep2.rid=er.id");
  
    if ($r['n'] == 1)
      $mysql->query("UPDATE projects SET state='evaluated_experts' "
                   ."WHERE pid={$r['ppid']} AND id={$r['pid']}");    
  }

  public function valuate_expert() {
    $id = $_POST['id'];
    echo '<form action="#" method="post"
        onsubmit="save_valuated(this, '.$id.'); return false">
        <br><div style="text-align:left;width:400px;margin:auto">
        <b>Evaluación</b></div>
        <textarea name="eval" style="width:400px;height:200px"></textarea><br>
        <br><span><b>Valoración:</b></span>
        <input type="text" name="valu" size="1" />
        <input type="submit" value="Valorar" /><br><br>
        </form>';
  }

  public function save_valuate() {
    global $mysql;

    $pro = $_POST['pro'];
    $p = explode("p", substr($pro, 2));
    $ppid = $p[0];
    $pid = $p[1];
    $uid = $_POST['id'];
    $eval = $_POST['eval'];
    $val = $_POST['valu'];

    $mysql->
      query("UPDATE `experts-projects` SET evaluation='$eval', ".
            "valuation='$val' WHERE uid=$uid AND ppid=$ppid AND pid=$pid");
  }
}