<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

function evaluation_models() {
  global $_mysql;
  
  echo '
    <div id="content">
      <div id="evmods">
        <div id="buttons">
          <a href="javascript:new_model();" alt="Añadir modelo">Añadir</a>
          <a href="#" alt="Modificar modelo">Modificar</a>
          <a href="#" alt="Eliminar modelo">Eliminar</a>
        </div>
        <div id="new">';
new_model();
echo '
        </div>
        <div class="title">Modelos de evaluación registrados</div>
        <table>
          <tr id="trtop">
            <td></td><td>ID</td><td>Paquete de la convocatoria</td>
            <td>Nº Proyectos</td><td>Nº Secciones</td><td>Nº Subsecciones</td>
          </tr>';

  $rows = $_mysql->assoc("SELECT e.id, pp.name, count(p.id) FROM eval_models e,"
                         ."projects_packages pp, projects p WHERE e.id=p.emid "
                         ."AND pp.id=e.cppid GROUP BY p.emid");
  foreach ($rows as $r) {
    echo '<tr><td><input type="checkbox" name="'.$r['id'].'" /></td>'
      .'<td>'.$r['id'].'</td><td>'.$r['name'].'</td>'
      .'<td>'.$r['count(p.id)'].'</td><td>probando</td><td>probando</td></tr>';
  }

   echo '
        </table>
      </div>
    </div>
  </div>
  <div style="clear: both"></div>
</div>
  ';
}

function new_model() {
  echo '
          <div class="title">Nuevo modelo de evaluación</div>
          <div id="menu">
            <div id="convs">
              '.convocatories().'
            </div>
            <div id="forms">
              '.forms().'
            </div>
          </div>
          <div id="modst">
            <div class="titsec">ESTRUCTURA</div>
          </div>
        ';
}

function convocatories() {
  global $_mysql;
  
  $str = '
        <div class="titsec">CONVOCATORIAS</div>
        <form action="#" method="post" onsubmit="view_conv();">
          <select name="conv" id="conv">
            <option value="default">Convocatorias</option>
            <option value="default">-----------------------------------</option>
        ';
  $rows = $_mysql->assoc("SELECT id, name FROM projects_packages");
  foreach ($rows as $r)
    $str .= '<option value="'.$r['id'].'">'.$r['name'].'</option>'."\n";

  $str .= '
          </select>
          <input type="submit" value="Ver"
                 onclick="return val_select(\'conv\')" />
        </form>';

  return $str;
}

function view_convocatory() {

}

function forms() {
  return '
        <div class="titsec">FORMULARIOS</div>
        <div id="list">
          <ul>
            <li>Sección</li>
            <li>Subsección</li>
            <li>Área de texto</li>
            <li>Campo de texto</li>
            <li>
              Lista desplegable
              <select name="lst">
                <option value="default">Nº de opciones</option>
                <option value="default">--------------</option>
                <option value="1">1</option><option value="2">2</option>
                <option value="3">3</option><option value="4">4</option>
                <option value="5">5</option><option value="6">6</option>
                <option value="7">7</option><option value="8">8</option>
                <option value="9">9</option><option value="10">10</option>
              </select>
            </li>
            <li>
              Radiales <input type="radio" checked="checked" />
              <select id="rad" name="rad">
                <option value="default">Nº de opciones</option>
                <option value="default">--------------</option>
                <option value="1">1</option><option value="2">2</option>
                <option value="3">3</option><option value="4">4</option>
                <option value="5">5</option><option value="6">6</option>
                <option value="7">7</option><option value="8">8</option>
                <option value="9">9</option><option value="10">10</option>
              </select>
            </li>
            <li>
              Cajas <input type="checkbox" checked="checked" />
              <select id="chk" name="chk">
                <option value="default">Nº de opciones</option>
                <option value="default">--------------</option>
                <option value="1">1</option><option value="2">2</option>
                <option value="3">3</option><option value="4">4</option>
                <option value="5">5</option><option value="6">6</option>
                <option value="7">7</option><option value="8">8</option>
                <option value="9">9</option><option value="10">10</option>
              </select>
            </li>
          </ul>
        </div>
        <div id="adds">
          <ul>
            <li><a href="" alt="">Añadir</a></li>
            <li><a href="" alt="">Añadir</a></li>
            <li><a href="" alt="">Añadir</a></li>
            <li><a href="" alt="">Añadir</a></li>
            <li><a href="" alt="">Añadir</a></li>
            <li><a href="" alt="">Añadir</a></li>
            <li><a href="" alt="">Añadir</a></li>
          </ul>
        </div>
        ';
}
?>
