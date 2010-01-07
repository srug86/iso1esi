<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

function is_cookied() {
  global $_uid, $_mysql, $_act, $_user;

  /* If user id doesn't exists */
  if (!$_uid && $_act != "login") {
    if (isset($_COOKIE['GDRPI'])) {
      $cookie = unserialize(stripslashes($_COOKIE['GDRPI']));
      $sql = "SELECT password, pwsalt FROM users WHERE id={$cookie['uid']}";
      $r = $_mysql->assoc($sql);
      $dbpass = sha1($r[0]['password'].$r[0]['pwsalt']);
      
      if ($cookie['pass'] == $dbpass) $_SESSION['uid'] = $_uid = $cookie['uid'];
      else {
        logout();
        die(theme_view('login'));
      }
    }
    else {
      logout();
      die(theme_view('login'));
    }
  }
}

function load_user() {
  global $_uid, $_act, $_mysql, $_user;

  if (!$_user && $_act != "login") {
    $r = $_mysql->assoc("SELECT type, name, surnames, area, phone, email, "
                      ."institution FROM users WHERE id=$_uid");
    $_SESSION['user']['type'] = $r[0]['type'];
    $_SESSION['user']['name'] = $r[0]['name'];
    $_SESSION['user']['surnames'] = $r[0]['surnames'];
    $_SESSION['user']['area'] = $r[0]['area'];
    $_SESSION['user']['phone'] = $r[0]['phone'];
    $_SESSION['user']['email'] = $r[0]['email'];
    $_SESSION['user']['institution'] = $r[0]['institution'];
    $_user = $_SESSION['user'];
  }
}

function login() {
  global $_uid, $_mysql, $_act;

  $userid = isset($_POST['userid']) ? $_POST['userid'] : null;
  $pass = isset($_POST['pass']) ? $_POST['pass'] : null;

  if ($userid && $pass) {
    $dbpass = $_mysql->field("SELECT password FROM users WHERE id=$userid");
    if ($dbpass == sha1($pass)) {
      $_SESSION['uid'] = $_uid = $userid;
      if (isset($_POST['remind'])) {
        $pwsalt = $_mysql->field("SELECT pwsalt FROM users WHERE id=$_uid");
        setcookie("GDRPI", serialize(array('uid' => $_uid,
                                           'pass' => sha1($dbpass.$pwsalt))),
                  time()+3600*24*365, '/');
      }
      header("Location: index.php");
    }
    else {
      logout();
      theme_view('login', true);
    }
  }
  else {
    logout();
    theme_view('login', true);
  }
}

function logout() {
  global $_uid, $_act;
  
  setcookie("GDRPI", $_uid, time()-3600*24*365, '/');
  session_unset();
  session_write_close();
  if ($_act == "logout") header("Location: index.php");
}
?>
