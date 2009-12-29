<?php
/* ---------------------------------------------------------------- *
 * Gestión Distribuída de la Revisión de Proyectos de Investigación *
 * ---------------------------------------------------------------- */

/* Define +  Errors + Locals */
define('GDRPI', 1);
error_reporting(E_ALL);
setlocale(LC_ALL, "esp", "es_ES", "es_ES@euro");

$time_start = microtime();

/* Includes */
include 'settings.php';
include 'source/mysql.php';
include 'source/login.php';

session_start();
$_mysql = MySQL();

/* Global variables */
$_uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;

/* Global request */
//$_mod = isset($_GET['mod']) ? $_GET['mod'] : null;
$_act = isset($_GET['act']) ? $_GET['act'] : null;
$_rng = isset($_GET['rng']) ? $_GET['rng'] : null;

loadUser();

/* Action array of functions */
$actionArray = array(
                     'login' => array('login.php', 'login'),
                     'logout' => array('login.php', 'logout'),
                     null => array('', '')
                     );


require_once $actionArray[$_act][0];
call_user_func($actionArray[$_act][1]);
?>

