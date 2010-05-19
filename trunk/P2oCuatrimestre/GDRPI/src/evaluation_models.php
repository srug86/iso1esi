<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

function save_model() {
  global $_mysql;
  $conv = $_POST['conv'];
  $secs = $_POST['sec'];

  $nsec = count($secs); $nele = 0;
  foreach ($secs as $sec) $nele += count($sec['els']);
    
  $struct = serialize($secs);

  if (!isset($_POST['id']))
      $sql = "INSERT INTO eval_models "
        ."VALUES (NULL, $conv, '$struct', $nsec, $nele)";
  else $sql = "UPDATE eval_models SET cppid=$conv, structure='$struct', "
         ."sections=$nsec, elements=$nele WHERE id={$_POST['id']}";
  
  $_mysql->sql($sql);
  $_SESSION['msg'] = "Modelo guardado con éxito";
  header("Location: ./");
}

function delete_model() {
  global $_mysql;
  $ids = substr($_POST['ids'], 0, -1);
  $_mysql->sql("DELETE FROM eval_models WHERE id IN ($ids)");
}
?>
