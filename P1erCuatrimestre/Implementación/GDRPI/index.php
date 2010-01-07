<?php
/*

  PROBLEMAS
   - Las consultas sql se cargan en iso8859 en vez de utf8

   DUDAS
   - ¿Los paquetes de proyectos y los proyectos no deberían tener un nombre?
   - ¿No que relacionar los modelos con los proyectos? 
     Creo que habría que hacer la siguiente relación:
     Proyecto --> Modelo --> Paquete

   HACER
   - Foto de los usuarios de colores u otra foto mejor
   - Colores de la vista de las evaluaciones
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
$actionArray =
  array(
        'login' => array('s', 'loginout.php', 'login'),
        'logout' => array('s', 'loginout.php', 'logout'),
        'newmod' => array('t', 'evaluation_models.php', 'new_model'),
        'modmod' => array('t', 'evaluation_models.php', 'modify_model'),
        'savemod' => array('s', 'evaluation_models.php', 'save_model'),
        'endmod' => array('s', 'evaluation_models.php', 'end_model'),
        'viewconv' => array('t', 'evaluation_models.php', 'view_convocatory'),
        'newrep' => array('t', 'evaluation_reports.php', 'new_report'),
        'modrep' => array('t', 'evaluation_reports.php', 'modify_report'),
        'saverep' => array('s', 'evaluation_reports.php', 'save_report'),
        'endrep' => array('s', 'evaluation_reports.php', 'end_report'),
        'viewrep' => array('s', 'evaluation_reports.php', 'view_report'),
        null => array('t', 'main.php', 'theme_view')
        );

$dir = array('s' => 'source/', 't' => 'theme/');
require_once $dir[$actionArray[$_act][0]].$actionArray[$_act][1];
call_user_func($actionArray[$_act][2]);
?>

