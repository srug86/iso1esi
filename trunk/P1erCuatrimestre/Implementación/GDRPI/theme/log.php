<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

function loginpage($error = false) {
  global $_uid, $_op;
  
  $error = $error ? "Usuario o contraseña incorrecto" : "";

  echo '
	<div id="error">'.$error.'</div>
	<div id="loginform">
          <form action="index.php?act=login" method="post" name="acceso">
	    <table>
	      <tr><td class="tder"><b>ID Usuario</b></td>
		<td class="tizq"><input type="text" name="userid" /></td></tr>
	      <tr><td class="tder"><b>Contraseña</b></td>
		<td class="tizq"><input type="password" name="pass" /></td></tr>
	      <tr><td colspan="2">
                  <input type="checkbox" value="1" name="remind" /> 
                  Recordarme &nbsp;&nbsp;&nbsp;
                  <input type="submit" value="Entrar" /></td></tr>
	    </table>
	  </form>
	</div>
	<div id="olvido"><a href="" alt="">¿Ha olvidado su contraseña?</a></div>
        ';
}
?>
