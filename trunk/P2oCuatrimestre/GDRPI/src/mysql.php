<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

class MySQL {
   private $link;

   public function __construct() {
     global $_config;
     $bd = $_config['bd'];
     $this->link = mysql_connect($bd['host'], $bd['user'], $bd['pass']);
     mysql_select_db($bd['name'], $this->link);
     mysql_query("SET NAMES utf8", $this->link);
   }

   public function rows($query) {
     $rows = array();
     $res = mysql_query($query, $this->link);
     if ($res) while ($row = mysql_fetch_assoc($res)) $rows[] = $row;
     return $rows;
   }

   public function row($query) {
     $row = array();
     $res = mysql_query($query, $this->link);
     if ($res) $row = mysql_fetch_assoc($res);
     return $row;
   }

   public function field($query) {
     list($field) = mysql_fetch_row(mysql_query($query, $this->link));
     return $field;
   }

   public function sql($query) {
     mysql_query($query, $this->link);
   }     
   
   private function errors($str_error) {
     null;
   }
       
   public function __destruct() {
      mysql_close($this->link);
   }
}
?>
