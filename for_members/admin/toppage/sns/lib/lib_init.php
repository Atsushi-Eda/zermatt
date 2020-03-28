<?php
require_once('../../lib/lib_init.php');
function index_init(){
  global $pdo, $snss;
  $sql = "SELECT * FROM snss ORDER BY id ASC";
  $snss = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
function edit_init(){
  global $pdo, $sns;
  if(empty($_POST)){
    $sql = "SELECT * FROM snss WHERE id = :id";
    $sth = $pdo->prepare($sql);
    $sth->execute([':id'=>isset($_GET['id']) ? $_GET['id'] : 0]);
    $sns = $sth->fetch(PDO::FETCH_ASSOC);
  }else{
    if(!$_POST['id']){
      if(insertTable('snss', [
        'name' => $_POST['name'],
        'widget' => $_POST['widget'],
        'view' => $_POST['view'],
      ])){
        $_SESSION['flash_message'] = '登録しました。';
      }else{
        $_SESSION['flash_message'] = '登録に失敗しました。';
      }
    }else{
      if(updateTable('snss', [
        'name' => $_POST['name'],
        'widget' => $_POST['widget'],
        'view' => $_POST['view'],
      ], [
        'id' => $_POST['id'],
      ])){
        $_SESSION['flash_message'] = '変更しました。';
      }else{
        $_SESSION['flash_message'] = '変更に失敗しました。';
      }
    }
    header('Location: http://' . ROOT_DIR . '/for_members/admin/toppage/sns/');
    exit;
  }
}
