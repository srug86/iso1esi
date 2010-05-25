<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

class MySQL {
   private $link;

   private function __construct__() {
     global $_config;
     $bd = $_config['bd'];
     $this->link = mysql_connect($bd['host'], $bd['user'], $bd['pass']);
     if (mysql_errno()) $this->error();
     mysql_select_db($bd['name'], $this->link);
     if (mysql_errno()) $this->error();
     mysql_query("SET NAMES utf8", $this->link);
     if (mysql_errno()) $this->error();
   }

   private function rows($query) {
     $rows = array();
     $res = mysql_query($query, $this->link);
     if ($res) while ($row = mysql_fetch_assoc($res)) $rows[] = $row;
     if (mysql_errno()) $this->error($query);
     return $rows;
   }

   private function row($query) {
     $row = array();
     $res = mysql_query($query, $this->link);
     if ($res) $row = mysql_fetch_assoc($res);
     if (mysql_errno()) $this->error($query);
     if (mysql_errno()) $this->error();
     return $row;
   }

   private function field($query) {
     list($field) = mysql_fetch_row(mysql_query($query, $this->link));
     if (mysql_errno()) $this->error($query);
     return $field;
   }

   private function query($query) {
     mysql_query($query, $this->link);
     if (mysql_errno()) $this->error($query);
   }

   private function insert($table, $values) {
     $query = "INSERT INTO $table SET";
     foreach 
       mysql_query();
     if (mysql_errno()) $this->error($query);
   }
   
   private function error($query = "") {
     echo "*** Error: MySQL ".mysql_errno().": ".
       mysql_error()."\n<br>When executing:<br>\n$query\n<br>";
   }

   private function __destruct__() {
      mysql_close($this->link);
   }
}
?>
