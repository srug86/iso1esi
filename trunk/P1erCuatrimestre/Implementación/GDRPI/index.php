<?php
/*

  PROBLEMAS
   - Al eleminar de un formulario de un modelo una sección, no siendo esta la
     última la numeración, no aparece correctamente

   DUDAS
   - ¿Los paquetes de proyectos y los proyectos no deberían tener un nombre?
   - ¿No que relacionar los modelos con los proyectos? 
     Creo que habría que hacer la siguiente relación:
     Proyecto --> Modelo --> Paquete
   - Experto-proyecto debe tener una clave ajena al paquete de proyectos
     porque sólo con el proyecto no es suficiente

   HACER
   - Foto de los usuarios de colores u otra foto mejor
   - Colores de la vista de las evaluaciones
   - Color X de las capas del formulario de los modelos
 */

/* ---------------------------------------------------------------- *
 * Gestión Distribuída de la Revisión de Proyectos de Investigación *
 * ---------------------------------------------------------------- */         

/* Define +  Errors + Locals */
define('GDRPI', 1);
error_reporting(E_ALL);
setlocale(LC_ALL, "es_ES.utf-8");

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
        /* Login */
        'login' => array('s', 'loginout.php', 'login'),
        'logout' => array('s', 'loginout.php', 'logout'),

        /* Models */
        'newmod' => array('t', 'evaluation_models.php', 'new_model'),
        'modmod' => array('t', 'evaluation_models.php', 'modify_model'),
        'savemod' => array('s', 'evaluation_models.php', 'save_model'),
        'delmod' => array('s', 'evaluation_models.php', 'delete_model'),
        'viewconv' => array('t', 'evaluation_models.php', 'view_convocatory'),

        /* Reports */
        'makerep' => array('t', 'evaluation_reports.php', 'make_report'),
        'saverep' => array('s', 'evaluation_reports.php', 'save_report'),
        'endrep' => array('s', 'evaluation_reports.php', 'end_report'),
        'viewrep' => array('s', 'evaluation_reports.php', 'view_report'),

        /* Default */
        null => array('t', 'main.php', 'theme_view')
        );

$path = array('s' => 'source/', 't' => 'theme/');
require_once $path[$actionArray[$_act][0]].$actionArray[$_act][1];
call_user_func($actionArray[$_act][2]);
?>

