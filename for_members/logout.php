<?php
require_once('../lib/lib_dir.php');
session_start();
$_SESSION['user'] = array();
if (isset($_COOKIE["PHPSESSID"])) {
  setcookie("PHPSESSID", '', time() - 1800);
}
if (isset($_COOKIE["token"])) {
  require_once('../lib/lib_db.php');
  $sql = "DELETE FROM auto_login WHERE token = :token";
  $sth = $pdo->prepare($sql);
  $sth->execute(array(':token'=>$_COOKIE["token"]));
  setcookie("token", '', time() - 1800);
}
session_destroy();
session_start();
$_SESSION['from'] = $_GET['from'];
$_SESSION['flash_message'] = 'ログアウトしました。';
header('Location: http://' . ROOT_DIR . '/for_members/login.php');
exit;