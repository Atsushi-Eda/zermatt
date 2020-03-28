<?php
require_once('../../lib/lib_init.php');
function index_init(){
  global $pdo, $links;
  $sql = "SELECT * FROM links ORDER BY id ASC";
  $links = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
function edit_init(){
  global $pdo, $link;
  if(empty($_POST)){
    $sql = "SELECT * FROM links WHERE id = :id";
    $sth = $pdo->prepare($sql);
    $sth->execute([':id'=>isset($_GET['id']) ? $_GET['id'] : 0]);
    $link = $sth->fetch(PDO::FETCH_ASSOC);
  }else{
    if(!$_POST['id']){
      if(insertTable('links', [
        'category' => $_POST['category'],
        'name' => $_POST['name'],
        'url' => $_POST['url'],
        'view' => $_POST['view'],
      ])){
        $_SESSION['flash_message'] = '登録しました。';
      }else{
        $_SESSION['flash_message'] = '登録に失敗しました。';
      }
    }else{
      if(updateTable('links', [
        'category' => $_POST['category'],
        'name' => $_POST['name'],
        'url' => $_POST['url'],
        'view' => $_POST['view'],
      ], [
        'id' => $_POST['id'],
      ])){
        $_SESSION['flash_message'] = '変更しました。';
      }else{
        $_SESSION['flash_message'] = '変更に失敗しました。';
      }
    }
    header('Location: http://' . ROOT_DIR . '/for_members/admin/toppage/link/');
    exit;
  }
}
