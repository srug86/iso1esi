<?php
/* ---------------------------------------------------------------- *
 * Gestión Distribuída de la Revisión de Proyectos de Investigación *
 * ---------------------------------------------------------------- */

/* Define */
define('GDRPI', 1);

/* Includes */
include 'settings.php';
include 'inc/mysql.php';
include 'inc/loginout.php';
include 'inc/html.php';
include 'inc/user.php';

session_start();
$mysql = new MySQL();

/* Global request */
$_act = isset($_GET['act']) ? $_GET['act'] : null;
$_rng = isset($_GET['rng']) ? $_GET['rng'] : null;

/* Global variables */
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$_uid = $user != null ? $user->getUid() : null;

/* User datas */
LoginOut::is_cookied();

if ($user) {  
  if ($user->getType() == "secretary") include 'inc/modelmanager.php';
  else {
    if ($user->getType() == "attached") include 'inc/usermanager.php';
    include 'inc/projectmanager.php';
    include 'inc/reportmanager.php'; 
  }
}

/* Action Switch */
switch ($_act) {

  /* Loginout */
case 'login': LoginOut::login(); break;
case 'logout': LoginOut::logout(); break;

  /* Models */
case 'newmod': ModelManager::new_model(); break;
case 'modmod': ModelManager::modify_model(); break;
case 'savemod': ModelManager::save_model(); break;
case 'delmod': ModelManager::delete_model(); break;
case 'viewconv': ModelManager::view_convocatory(); break;

  /* Reports */
case 'makerep': ReportManager::make_report(); break;
case 'saverep': ReportManager::save_report(); break;
case 'endrep': ReportManager::end_report(); break;
case 'viewrep': ReportManager::view_report(); break;
case 'valurep': ReportManager::valuate_expert(); break;
case 'savval': ReportManager::save_valuate(); break;

  /* Projects */
case 'proexp': ProjectManager::projects_experts(); break;
  
case 'srchfrm': UserManager::search_form(); break;
case 'srchexp': UserManager::search_experts(); break;
case 'asgexp': ProjectManager::assign_experts(); break;

  /* Default */
default: default_();
}
?>