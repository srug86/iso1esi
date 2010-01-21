<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

function save_report() {
  global $_user;

  if ($_user['type'] == "expert") save_expert_report();
  else if ($_user['type'] == "attached") save_attached_report();
}

function save_expert_report() {
  global $_mysql;
  
  $data = serialize($_POST['sec']);
  $end = $_POST['end'] == 1 ? ", state='done'" : "";
  $_mysql->
    sql("UPDATE eval_reports SET data='$data'$end WHERE id={$_POST['id']}");
  $_SESSION['msg'] = "Evaluación guardada con éxito";
  header("Location: index.php");
}

function save_attached_report() {
  global $_mysql;

  $id = $_POST['id'];
  $ppid = substr($id, 2, strpos($id, "p", 2)-2);
  $pid = substr($id, strpos($id, "p", 2)+1);
  
  $data = serialize($_POST['sec']);
  $end = $_POST['end'] == 1 ? ", state='evaluated_attached'" : "";
  $_mysql->sql("UPDATE projects SET final_report='$data'$end "
               ."WHERE id=$pid AND pid=$ppid");
  $_SESSION['msg'] = "Informe guardado con éxito";
  header("Location: index.php");
}

function end_report() {
  global $_mysql;

  $id = $_POST['id'];
  if ($_user['type'] == "expert")
    $sql = "UPDATE eval_reports SET state='done' WHERE id=$id";
  else if ($_user['type'] = "attached") {
    $ppid = substr($id, 2, strpos($id, "p", 2)-2);
    $pid = substr($id, strpos($id, "p", 2)+1);
    $sql = "UPDATE projects SET state='evaluated_attached' "
      ."WHERE id=$pid AND pid=$ppid";
  }
  
  $_mysql-> sql($sql);
  $_SESSION['msg'] = "Evaluación finalizada con éxito";
}
?>
