<?php
session_start();
if(isset($need_pass) && $need_pass){
  if(!isset($_SESSION['password']) && isset($_COOKIE["token2"])){
    $sql = "SELECT id FROM auto_login2 WHERE token = :token";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':token'=>$_COOKIE["token2"]));
    $tmp = $sth->fetch(PDO::FETCH_ASSOC);
    $_SESSION['password'] = isset($tmp['id']);
  }
  if(!isset($_SESSION['password']) && basename($_SERVER['PHP_SELF'])!=='login.php'){
    $_SESSION['from'] = $_SERVER["SCRIPT_NAME"] . '?' . $_SERVER['QUERY_STRING'];
    header('Location: http://' . ROOT_DIR . '/login.php');
    exit;
  }
}
