<?php
if (defined('GDRPI')) include 'inc/area.php';
else include '../inc/area.php';

class User {
  private $uid, $email, $password, $name, $surnames, $phone, $institution,     
    $tags, $cv, $area, $type;

  public function __construct($id) {
    global $mysql;

    $r = $mysql->row("SELECT * FROM users WHERE id=$id");
    $this->uid = $r['id']; $this->type = $r['type']; $this->email = $r['email'];
    $this->name = $r['name']; $this->surnames = $r['surnames'];
    $this->phone = $r['phone']; $this->institution = $r['institution'];
    $this->curriculum = $r['curriculum']; $this->tags = $r['keywords'];
    
    $this->area = new Area($r['aid']);
    $this->typetxt = $this->type();
    $this->refers = $this->refers();
    $this->color = $this->color();
  }

  public function getUid() {
    return $this->uid;
  }

  public function getName() {
    return $this->name;
  }

  public function getSurNames() {
    return $this->surnames;
  }

  public function getType() {
    return $this->type;
  }

  public function getTypeTxt() {
    return $this->typetxt;
  }

  public function getRefers() {
    return $this->refers;
  }

  public function getColor() {
    return $this->color;
  }

  private function type() {
    $txt = "";
    switch ($this->type) {
    case "secretary": $txt = "Secretario"; break;
    case "coordinator": $txt = "Coordinador"; break;
    case "attached": $txt = "Adjunto"; break;
    case "expert": $txt = "Experto"; break;
    }
    return $txt;
  }

  private function refers() {
    global $mysql;
    
    $position = "";
    if ($this->type != "secretary") {
      $area = $this->area->getName();
      $position = "<strong>Área</strong> $area<br />";
        
      if ($this->type == "attached") {
        $subarea = $mysql->
          field("SELECT name FROM subareas "
                ."WHERE aid=".$this->area->getAid()." AND uid=$this->uid"); 
        $position .= "<strong>Subárea</strong> $subarea<br />";
      }
    }
      
    return "{$this->name} {$this->surnames} "
      ."<br />$position<strong>Tlf</strong> {$this->phone}<br />"
      ."<strong>E-mail</strong> {$this->email}<br />"
      ."{$this->institution}";
  }
  
  private function color() {
    $color = "";
    switch ($this->type) {
    case "secretary": $color = "#db871a"; break;
    case "coordinator": $color = "#6e407b"; break;
    case "attached": $color = "green"; break;
    case "expert": $color = "#004586"; break;
    }
    return $color;
  }
}
?>