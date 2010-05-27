<?php
class LoginOut {
  public function login() {
    global $_uid, $mysql, $_act;
  
    $userid = isset($_POST['userid']) ? $_POST['userid'] : null;
    $pass = isset($_POST['pass']) ? $_POST['pass'] : null;
  
    if (intval($userid) && $pass) {
      $dbpass = $mysql->field("SELECT password FROM users WHERE id=$userid");
      if ($dbpass == sha1($pass)) {
        $_SESSION['user'] = $user = new User($userid);
        //$_SESSION['uid'] = $_uid = $userid;
        if (isset($_POST['remind'])) {
          $pwsalt = $mysql->field("SELECT pwsalt FROM users WHERE id=$userid");
          setcookie("GDRPI", serialize(array('uid' => $userid,
                                             'pass' => sha1($dbpass.$pwsalt))),
                    time()+3600*24*365, '/');
        }
        header("Location: ./");
      }
      else {
        LoginOut::logout();
        die(login_form($error = true));
      }
    }
    else {
      LoginOut::logout();
      die(login_form($error = true));
    }
  }
  
  public function logout() {
    global $_uid, $_act;
    
    setcookie("GDRPI", $_uid, time()-3600*24*365, '/');
    session_unset();
    session_write_close();
    if ($_act == "logout") header("Location: ./");
  }
  
  public function is_cookied() {
    global $mysql, $user, $_act, $_uid;
  
    /* If user id doesn't exists */
    if (!$_uid && $_act != "login") {
      if (isset($_COOKIE['GDRPI'])) {
        $cookie = unserialize(stripslashes($_COOKIE['GDRPI']));
        $sql = "SELECT password, pwsalt FROM users WHERE id={$cookie['uid']}";
        $r = $mysql->row($sql);
        $dbpass = sha1($r['password'].$r['pwsalt']);
        
        if ($cookie['pass'] == $dbpass) {
          $_SESSION['user'] = $user = new User($cookie['uid']);
          //$_SESSION['uid'] = $_uid = $cookie['uid'];
        }
        else {
          LoginOut::logout();
          die(login_form());
        }
      }
      else {
        LoginOut::logout();
        die(login_form());
      }
    }
  }
}  
?>