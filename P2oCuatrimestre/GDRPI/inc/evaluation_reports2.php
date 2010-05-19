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
  $id = $_POST['id'];
  $_mysql->sql("UPDATE eval_reports SET data='$data'$end WHERE id=$id");
  $_SESSION['msg'] = "Evaluación guardada con éxito";

  if ($end) evaluated_expert($id);
  
  header("Location: ./");
}

function end_report() {
  global $_mysql, $_user;

  $id = $_POST['id'];
  if ($_user['type'] == "expert") 
    $sql = "UPDATE eval_reports SET state='done' WHERE id=$id";
  else  {
    $ppid = substr($id, 2, strpos($id, "p", 2)-2);
    $pid = substr($id, strpos($id, "p", 2)+1);
    if ($_user['type'] == "coordinator")
      $sql = "UPDATE projects SET state='validated_coordinator' "
        ."WHERE id=$pid AND pid=$ppid";
    else if ($_user['type'] == "attached")
      $sql = "UPDATE projects SET state='evaluated_attached' "
        ."WHERE id=$pid AND pid=$ppid";
  }
  
  $_mysql-> sql($sql);
  if ($_user['type'] == "expert") evaluated_expert($id);
  $_SESSION['msg'] = "Evaluación finalizada con éxito";
}

function evaluated_expert($id) {
  global $_mysql;
  
  $r = $_mysql->
    row("SELECT COUNT(DISTINCT er.state) AS n, ep1.ppid, ep1.pid "
        ."FROM eval_reports er, `experts-projects` ep1, "
        ."`experts-projects` ep2 WHERE ep1.rid=$id AND "
        ."ep1.ppid=ep2.ppid AND ep1.pid=ep2.pid AND ep2.rid=er.id");

  if ($r['n'] == 1)
    $_mysql->sql("UPDATE projects SET state='evaluated_experts' "
                 ."WHERE pid={$r['ppid']} AND id={$r['pid']}");    
}
?>
