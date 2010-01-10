<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

function make_report() {
  global $_mysql;
  
  $rep = $_POST['rep'];

  $r = $_mysql->assoc("SELECT em.structure, er.data, p.memory "
                      ."FROM eval_models em, eval_reports er, projects p, "
                      ."`experts-projects` ep WHERE er.id=$rep "
                      ."AND em.id=er.emid AND er.id=ep.rid AND ep.pid = p.id "
                      ."AND ep.ppid = p.pid");

  $st = unserialize($r[0]['structure']);
  $data = unserialize($r[0]['data']);

  echo '
    <div id="mem">'.$r[0]['memory'].'</div>
    <div id="report">
      <form method="post" action="index.php?act=saverep">
        <input type="hidden" name="id" value="'.$rep.'" />
        ';

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
  echo '
    <input type="submit" value="Guardar" />
    <input type="hidden" name="end" value="0" />
    <input type="submit" value="Finalizar" onclick="end_report()" />
</form></div>';
}
?>