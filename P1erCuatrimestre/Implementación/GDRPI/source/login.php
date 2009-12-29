<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

function loadUser() {
  global $_uid, $_mysql;
  $res = true;

  /* If user id doesn't exists */
  if (!$_uid) {
    if (isset($_COOKIE['GDRPI'])) {
      $cookie = unserialize(stripslashes($_COOKIE['GDRPI']));
      $sql = "SELECT passwd, pwsalt FROM users WHERE id={$cookie['uid']}";
      $r = $_mysql->assoc($sql);
      $dbpass = sha1($r['passwd'].$r['pwsalt']);
      
      if ($cookie['pass'] == $dbpass) $_SESSION['uid'] = $_uid = $cookie['uid'];
      else die(login());
    }
  }
}

function login() {
  global $_uid, $_mysql, $_op, $_rng;

  $userid = isset($_POST['userid']) ? $_POST['userid'] : null;
  $pass = isset($_POST['pass']) ? $_POST['pass'] : null;

  $dbpass = $_mysql->row("SELECT pass FROM users WHERE id=$userid");
  if ($dbpass == sha1($pass)) {
    $_SESSION['uid'] = $_uid = $userid;
    if (isset($_POST['remind'])) {
      $pwsalt = $_mysql->row("SELECT pwsalt FROM users WHERE id=$_uid");
      setcookie("GDRPI", serialize(array('uid' => $_uid,
                                         'pass' => sha1($dbpass.$pwsalt))),
                time()+3600*24*365, '/');
    }
  }
  else {
    logout();
    loginpage(true);
  }
}

function logout() {
  global $_uid;
  
  setcookie("GDRPI", $_uid, time()-3600*24*365, '/');
  session_unset();
  session_write_close();
}
?>
