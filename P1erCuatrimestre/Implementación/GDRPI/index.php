<?php
/* PROBLEMAS
 - Las consultas sql se cargan en iso8859 en vez de itf8
 */

/* ---------------------------------------------------------------- *
 * Gestión Distribuída de la Revisión de Proyectos de Investigación *
 * ---------------------------------------------------------------- */         

/* Define +  Errors + Locals */
define('GDRPI', 1);
error_reporting(E_ALL);
//setlocale(LC_ALL, "esp", "es_ES", "es_ES@euro");

$time_start = microtime();

/* Includes */
include 'settings.php';
include 'source/mysql.php';
include 'source/loginout.php';
include 'theme/main.php';

session_start();
$_mysql = new MySQL();

//unset($_SESSION);

/* Global variables */
$_uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;
$_user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

/* Global request */
$_act = isset($_GET['act']) ? $_GET['act'] : null;
$_rng = isset($_GET['rng']) ? $_GET['rng'] : null;

/* User datas */
is_cookied();
load_user();

/* Functions action array */
$actionArray = array(
                     'login' => array('loginout.php', 'login'),
                     'logout' => array('loginout.php', 'logout'),
                     null => array('evaluations.php', 'evaluations')
                     );

require_once 'source/'.$actionArray[$_act][0];
call_user_func($actionArray[$_act][1]);
?>

