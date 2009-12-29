<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

class MySQL {
   private $link;

   private function __construct() {
     global $_config;
     $bd = $_config['bd'];
     $this->link = mysql_connect($bd['host'], $bd['user'], $bd['pass']);
     mysql_select_db($bd['name'], $this->link);
   }

   private function assoc($query) {
     $res = mysql_query($query, $this->link);
     while ($row = mysql_fetch_assoc($res)) $rows[] = $row;
     return $rows;
   }

   private function row($query) {
     list($row) = mysql_fetch_row(mysql_query($query, $this->link));
     return $row;
   }
   
   private function errors($str_error) {

   }
       
   private function __destruct() {
      mysql_close($this->link);
   }
}
?>
