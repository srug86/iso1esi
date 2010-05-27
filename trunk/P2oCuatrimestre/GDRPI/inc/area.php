<?php
class Area {
  private $aid, $name;

  public function __construct($id) {
    global $mysql;

    $r = $mysql->row("SELECT * FROM areas WHERE id=$id");
    $this->aid = $r['id']; $this->name = $r['name'];
  }

  public function getName() {
    return $this->name;
  }

  public function getAid() {
    return $this->aid;
  }
}