<?php
require_once('../../lib/lib_init.php');
function index_init(){
  global $pdo, $password;
  if(!isset($_POST['password'])){
    $password = $pdo->query('SELECT password FROM password ORDER BY id DESC LIMIT 1')->fetch(PDO::FETCH_ASSOC)['password'];
  }else{
    if(insertTable('password', [
      'password' => $_POST['password'],
    ])){
      $_SESSION['flash_message'] = 'パスワードを「'.$_POST['password'].'」に更新しました。';
    }else{
      $_SESSION['flash_message'] = 'パスワードの更新に失敗しました。';
    }
    header('Location: http://' . ROOT_DIR . '/for_members/admin/toppage/');
    exit;
  }
}
