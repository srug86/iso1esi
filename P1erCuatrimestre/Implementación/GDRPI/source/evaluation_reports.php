<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

function save_report() {
  global $_user;

  if ($_user['type'] == "expert") save_expert_report();
  else save_cooratta_report();
}

function save_cooratta_report() {
  global $_mysql, $_user;

  $id = $_POST['id'];
  $ppid = substr($id, 2, strpos($id, "p", 2)-2);
  $pid = substr($id, strpos($id, "p", 2)+1);
  
  $data = serialize($_POST['sec']);

  $end = "";
  if ($_POST['end'] == 1) {
    $state = $_user['type'] == "coordinator" ? "validated_coordinator"
      : "evaluated_attached";
    $end = ", state='$state'";
  }

  $_mysql->sql("UPDATE projects SET final_report='$data'$end "
               ."WHERE id=$pid AND pid=$ppid");
  $_SESSION['msg'] = "Informe guardado con éxito";
  header("Location: ./");
}

function save_expert_report() {
  global $_mysql;
  
  $data = serialize($_POST['sec']);
  $end = $_POST['end'] == 1 ? ", state='done'" : "";
  $_mysql->
    sql("UPDATE eval_reports SET data='$data'$end WHERE id={$_POST['id']}");
  $_SESSION['msg'] = "Evaluación guardada con éxito";
  header("Location: ./");
}

function end_report() {
  global $_mysql;

  $id = $_POST['id'];
  if ($_user['type'] == "expert")
    $sql = "UPDATE eval_reports SET state='done' WHERE id=$id";
  else  {
    $ppid = substr($id, 2, strpos($id, "p", 2)-2);
    $pid = substr($id, strpos($id, "p", 2)+1);
    if ($_user['type'] = "coordinator")
      $sql = "UPDATE projects SET state='validated_coordinator' "
        ."WHERE id=$pid AND pid=$ppid";
    else if ($_user['type'] = "attached")
      $sql = "UPDATE projects SET state='evaluated_attached' "
        ."WHERE id=$pid AND pid=$ppid";
  }
  
  $_mysql-> sql($sql);
  $_SESSION['msg'] = "Evaluación finalizada con éxito";
}
?>
