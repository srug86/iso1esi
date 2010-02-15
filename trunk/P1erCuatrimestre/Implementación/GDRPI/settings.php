<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

/* Errors */
error_reporting(E_ALL);

/* Locals */
setlocale(LC_ALL, "es_ES.utf-8");

/* Data base */
$_config['bd']['host'] = "localhost";
$_config['bd']['name'] = "gdrpi";
$_config['bd']['user'] = "root";
$_config['bd']['pass'] = "";

/* Main directory */
$_config['base_dir'] = ""; //In the .htaccess too
?>
