<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

class UserManager {
  public function search_form() {
    echo '<div class="asig">Asignados</div>';
    ProjectManager::projects_experts();
    echo '<div class="asig"><br>Búsqueda</div>';
    echo '
        <div id="srch">
          <form method="post" action="#" onsubmit="search(this, \''.
      $_POST['pro'].'\')">
            Nombre &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="text" name="name" />&nbsp;&nbsp;&nbsp;
            Apellidos &nbsp;
              <input type="text" name="surnames" />&nbsp;&nbsp;&nbsp;
            Palabras clave &nbsp;
              <input type="text" name="keywords" /><br /><br />
            Institución &nbsp;
              <input type="text" name="institution" />&nbsp;&nbsp;&nbsp;
            Nº de proyectos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <select name="pord"><option id="min"><=</option>
              <option id="max">>=</option></select>
              <input type="text" name="projs" size="1" />
              &nbsp;&nbsp;&nbsp;
            Valoración &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <select name="vord"><option id="min"><=</option>
              <option id="max">>=</option></select>
              <input type="text" name="valoration" size="1" /><br /><br />
            <input type="submit" value="Buscar" />
          </form>
        </div>';
  }
  
  public function search_experts() {
    global $mysql;

    $pro = $_POST['pro'];
    $p = explode("p", substr($pro, 2));
    $ppid = $p[0];
    $pid = $p[1];

    $sql = "SELECT u.id, u.name, u.surnames, u.institution, ".
      "COUNT(u.id) AS projs, AVG(ep.valuation) AS avg ".
      "FROM users u, `experts-projects` ep, projects_packages pp ".
      "WHERE u.institution!=pp.institution ".
      "AND u.id=ep.uid ".
      "AND pp.id=$ppid AND u.type='expert' ".
      "AND u.id NOT IN (SELECT uid FROM `experts-projects` WHERE ppid=$ppid ".
      "AND pid=$pid)";

    $sql .= $_POST['name'] ? " AND u.name='{$_POST['name']}'" : "";
    $sql .= $_POST['surnames'] ?
      " AND u.surname='{$_POST['surnames']}'" : "";
    if ($_POST['keywords']) {
      $keys = split(" ", $_POST['keywords']);
      foreach ($keys as $key) $sql .= " AND u.keywords REGEXP '$key'";
    }
    $sql .= $_POST['institution'] ? 
      " AND u.institution='{$_POST['institution']}'" : "";

    $sql .= " GROUP BY ep.uid, u.id";

    if ($_POST['projs']) {
      $sql .= " HAVING (projs";
      $sql .= $_POST['pord'] == "min" ? " <= " : " >= ";
      $sql .= $_POST['projs'].")";
      if ($_POST['avg']) {
        $sql .= " AND (avg";
        $sql .= $_POST['vord'] == "min" ? " <= " : " >= ";
        $sql .= $_POST['valoration'].")";
      }
    }
    else if ($_POST['valoration']) {
      $sql .= " HAVING (avg";
      $sql .= $_POST['vord'] == "min" ? " <= " : " >= ";
      $sql .= $_POST['valoration'].")";
    }
    //echo $sql;
    $r = $mysql-> rows($sql);
    if (!count($r))
      echo '<div class="asig">Su búsqueda no produce ningún resultado</div>
          <input type="button" onclick="assign_experts(true)" value="Atrás" />';
    else {
      echo '<form action="#" method="post"
               onsubmit="assign(\''.$pro.'\'); return false;">
            <table style="width:690px">
              <tr id="trtop"><td></td><td>Nombre</td><td>Apellidos</td>
                <td>Institución</td>
                <td>Nº Prs.</td><td>Valoración</td></tr>';

      foreach ($r as $row) 
        echo '<tr><td><input type="checkbox" name="'.$row['id'].'" /></td>
        <td>'.$row['name'].'</td><td>'.$row['surnames'].
          '</td><td>'.$row['institution'].'</td><td>'.$row['projs'].
          '</td><td>'.$row['avg'].'</td></tr>';
      
      echo '</table><br><input style="margin-left:270px" type="submit"
       value="Asignar"> <input style="margin:0"
       type="button" onclick="assign_experts(true)" value="Atrás" /></form>';
    }
  }
}
?>