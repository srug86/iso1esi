<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

function evaluation_models() {
  global $_mysql;
  
  echo '
    <div id="content">
      <div id="evmods">
        <div id="buttons">
          <a href="javascript:new_model();" alt="Añadir modelo">Añadir</a>
          <a href="javascript:mod_model();" alt="Modificar modelo">Modificar</a>
          <a href="javascript:del_model();" alt="Eliminar modelo">Eliminar</a>
        </div>
        <div id="new"></div>
        <div class="title">Modelos de evaluación registrados</div>
        <table>
          <tr id="trtop">
            <td></td><td>ID</td><td>Paquete de la convocatoria</td>
            <td>Nº Proyectos</td><td>Nº Secciones</td><td>Nº Elementos</td>
          </tr>';

  $rows = $_mysql->assoc("SELECT e.id, p.name, e.sections, e.elements "
                         ."FROM eval_models e, projects_packages p "
                         ."WHERE p.id=e.cppid ORDER by e.id DESC");
  foreach ($rows as $r) {
    $num = $_mysql->
      field("SELECT count(id) FROM projects WHERE emid={$r['id']}");
    echo '<tr><td><input type="checkbox" name="'.$r['id'].'" /></td>'
      .'<td>'.$r['id'].'</td><td>'.$r['name'].'</td>'
      .'<td>'.$num.'</td><td>'.$r['sections'].'</td><td>'
      .$r['elements'].'</td></tr>';
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

function new_model($modst = "", $conv = null) {
  $type = $modst == "" ? "Nuevo" : "Modificar";
  
  echo '
          <div class="title">'.$type.' modelo de evaluación</div>
          <form id="modform" method="post" action="index.php?act=savemod">
            <div id="menu">
              <div id="convs">
                <div id="dialogs"></div>
                '.convocatories($conv).'
              </div>
              <div id="forms">
                '.forms().'
              </div>
            </div>
            <div id="modst">
              <div class="titsec">ESTRUCTURA</div>
              '.$modst.'
            </div>
          </form>
        ';
}

function modify_model() {
  global $_mysql;

  $id = $_POST['id'];
  $mod = $_mysql->assoc("SELECT cppid, structure, sections, elements "
                        ."FROM eval_models WHERE id=$id");
  $conv = $mod[0]['cppid'];
  $secs = unserialize($mod[0]['structure']);

  $nsec = 0;
  $str = '<input type="hidden" name="id" value="'.$id.'" />'
    .'<input id="sec" type="hidden" name="sec" value="'
    .($mod[0]['sections']-1).'" />'
    .'<input id="els" type="hidden" name="els" value="'
    .($mod[0]['elements']-1).'" />';
  foreach ($secs as $sec) {
    $str .= '<div id="sec'.$nsec.'" class="form"><a href="'
      .'javascript:del_form(\'sec'.$nsec.'\')"><img src="'
      .'theme/images/x-red.png" alt=""></a><p class="sec">'.($nsec+1)
      .'. <input type="text" name="sec['.$nsec.'][txt]" '
      .'value="'.$sec['txt'].'" /></p>';

    $nel = 0;
    foreach ($sec['els'] as $el) {
      $type = key($el);
      $el = $el[$type];
      
      switch ($type) {
      case "are":
        $str .= '<div id="sec'.$nsec.'el'.$nel.'" class="form"><a href="'
          .'javascript:del_form(\'sec'.$nsec.'el'.$nel.'\')"><img src="'
          .'theme/images/x-red.png" alt=""></a><br /><input type="hidden"'
          .' name="sec['.$nsec.'][els]['.$nel.']['.$type.']" /><textarea '
          .'disabled="disabled"></textarea></div>';
        break;

      case "fie":
        $str .= '<div id="sec'.$nsec.'el'.$nel.'" class="form"><a href="'
          .'javascript:del_form(\'sec'.$nsec.'el'.$nel.'\')"><img src="'
          .'theme/images/x-red.png" alt=""></a><br /><input type="text"'
          .'class="fie" name="sec['.$nsec.'][els]['.$nel.']['
          .$type.']" value="'.$el.'" /><div style="clear:both"></div></div>';
        break;

      case "lst": case "rad": case "chk":
        $str .= '<div id="sec'.$nsec.'el'.$nel.'" class="form">'
          .'<a href="javascript:del_form(\'sec'.$nsec.'el'.$nel.'\')">'
          .'<img src="theme/images/x-red.png" alt=""></a>';

        switch ($type) {
        case "lst": $str .= '<p class="txt">- Lista desplegable:</p>'; break;
        case "rad": $str .= '<p class="txt">- Radiales:</p>'; break;
        case "chk": $str .= '<p class="txt">- Cajas:</p>'; break;
        }

        foreach ($el as $i => $txt) {
          $str .= 'Opción '.($i+1).': <input type="text" name="sec['.$nsec
            .'][els]['.$nel.']['.$type.']['.$i.']" value="'.$txt.'" /><br />';
        }
        $str .= '</div>';
        break;
      }
      $nel++;
    }
    $nsec++;
    $str .= '</div>';
  }
  
  new_model($str, $conv);
}

function convocatories($conv = null) {
  global $_mysql;
  
  $str = '
        <div class="titsec">CONVOCATORIAS</div>
        <select name="conv" id="conv">
          <option value="default">Convocatorias</option>
          <option value="default">-----------------------------------</option>
        ';
  $rows = $_mysql->assoc("SELECT id, name FROM projects_packages");
  foreach ($rows as $r) {
    $selected = $r['id'] == $conv ? ' selected="selected"' : '';
    $str .= '<option value="'.$r['id'].'"'.$selected
      .'>'.$r['name'].'</option>'."\n";
  }

  $str .= '
        </select>
        <a href="javascript:view_conv()" alt="">Ver</a>';

  return $str;
}

function view_convocatory() {
  global $_mysql;
  echo $_mysql->field("SELECT convocatory FROM projects_packages "
                      ."WHERE id={$_POST['conv']}");
}

function forms() {
  return '
        <div class="titsec">FORMULARIOS</div>
        <div id="list">
          <ul>
            <li>Sección</li>
            <li>Área de texto</li>
            <li>Campo de texto</li>
            <li>
              Lista desplegable
              <select id="lst" name="lst">
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
          <br /><a href="javascript:save_model()" alt="">Guardar</a>
        </div>
        <div id="adds">
          <ul>
            <li><a href="javascript:add_form(\'sec\')" alt="">Añadir</a></li>
            <li><a href="javascript:add_form(\'are\')" alt="">Añadir</a></li>
            <li><a href="javascript:add_form(\'fie\')" alt="">Añadir</a></li>
            <li><a href="javascript:add_form(\'lst\')" alt="">Añadir</a></li>
            <li><a href="javascript:add_form(\'rad\')" alt="">Añadir</a></li>
            <li><a href="javascript:add_form(\'chk\')" alt="">Añadir</a></li>
          </ul>
        </div>
        ';
}
?>
