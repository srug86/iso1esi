<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

function make_report() {
  global $_user;

  if ($_user['type'] == "expert") make_expert_report();
  else make_attached_report();
}

function make_expert_report() {
  global $_mysql, $_uid;
  
  $rep = $_POST['rep'];

  $r = $_mysql->row("SELECT em.structure, er.data, p.memory "
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

  struct_report($st, $data);
  
  echo '
    <input type="submit" value="Guardar" />
    <input type="hidden" name="end" value="0" />
    <input type="submit" value="Finalizar" onclick="set_end_report()" />
</form></div>';
}

function make_attached_report() {
  global $_mysql, $_uid;

  $rep = $_POST['rep'];
  $ppid = substr($rep, 2, strpos($rep, "p", 2)-2);
  $pid = substr($rep, strpos($rep, "p", 2)+1);

  $r = $_mysql->row("SELECT em.structure, p.final_report "
                    ."FROM eval_models em, projects p "
                    ."WHERE em.id=p.emid AND p.id=$pid AND p.pid=$ppid");

  $st = unserialize($r['structure']);
  $data = unserialize($r['final_report']);
  
  echo '
    <div id="report">
      <form method="post" action="index.php?act=saverep">
        <input type="hidden" name="id" value="'.$rep.'" />
        ';

  struct_report($st, $data);
  
  echo '
    <input type="submit" value="Guardar" />
    <input type="hidden" name="end" value="0" />
    <input type="submit" value="Finalizar" onclick="set_end_report()" />
</form></div>';
}

function struct_report($st, $data) {
  $nsec = 0;
  foreach ($st as $i => $sec) {
    echo '<p class="sec">'.($i+1).'. '.$sec['txt'].'</p>';
    $nel = 0;
    foreach ($sec['els'] as $j => $el) {
      $type = key($el);
      $el = $el[$type];
      $datrep = isset($data[$i]['els'][$j][$type]) ?
        $data[$i]['els'][$j][$type] : "";

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

function view_report() {
  global $_mysql;

  $id = $_POST['id'];

  $r = $_mysql->row("SELECT p.name as pname, u.name, u.surnames, "
                    ."em.structure, er.data"
                    ." FROM eval_models em, eval_reports er, users u, "
                    ."projects p, `experts-projects` ep WHERE er.id=$id AND "
                    ."er.emid=em.id AND ep.rid=er.id AND ep.ppid=p.pid AND "
                    ."ep.pid=p.id AND ep.uid=u.id");

  $st = unserialize($r['structure']);
  $data = unserialize($r['data']);

  $txt = "";
  foreach ($st as $i => $sec) {
    $txt .= '<p class="sec">'.($i+1).'. '.$sec['txt'].'</p>';
    foreach ($sec['els'] as $j => $el) {
      $type = key($el);
      $el = $el[$type];
      $datrep = isset($data[$i]['els'][$j][$type]) ?
        $data[$i]['els'][$j][$type] : "";

      switch ($type) {
      case "are": $txt .= '<p>'.$datrep.'</p>'; break;
      case "fie": $txt .= '<p>'.$el.'</p>'; break;
      case "lst": $txt .= '<p>'.$datrep == "" ? $el[$datrep] : ""
        .'</p>'; break;
      case "rad": $txt .= '<p>'.$el[$datrep].'</p>'; break;
      case "chk":
        foreach ($el as $k => $str)
          if (isset($datrep[$k])) $txt .= '<p>'.$str.'</p>';
        break;
      }
    }
  }

  echo '
      <div id="report'.$id.'" title="'.$r['pname'].'. '.$r['name'].' '.
        $r['surnames'].'" style="display: none;" class="reports">'.
        $txt.'</div>';
}
?>