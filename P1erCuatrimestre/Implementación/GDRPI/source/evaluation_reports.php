<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

function save_report() {
  global $_mysql;
  
  $data = serialize($_POST['sec']);
  $end = $_POST['end'] == 1 ? ", state='done'" : "";
  $_mysql->
    sql("UPDATE eval_reports SET data='$data'$end WHERE id={$_POST['id']}");
  $_SESSION['msg'] = "Informe guardado con éxito";
  header("Location: index.php");
}
?>
