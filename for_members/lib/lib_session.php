<?php
session_start();
if(!isset($_SESSION['user']['id']) && isset($_COOKIE["token"])){
  $sql = "SELECT members.id, members.name, members.grade FROM auto_login INNER JOIN members ON auto_login.member_id = members.id WHERE auto_login.token = :token AND members.view = true";
  $sth = $pdo->prepare($sql);
  $sth->execute(array(':token'=>$_COOKIE["token"]));
  $_SESSION['user'] = $sth->fetch(PDO::FETCH_ASSOC);
}
if(!isset($_SESSION['user']['id']) && basename($_SERVER['PHP_SELF'])!=='login.php'){
  $_SESSION['from'] = $_SERVER["SCRIPT_NAME"] . '?' . $_SERVER['QUERY_STRING'];
  header('Location: http://' . ROOT_DIR . '/for_members/login.php');
  exit;
}