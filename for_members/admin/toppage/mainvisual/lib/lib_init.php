<?php
require_once('../../lib/lib_init.php');
function index_init(){
  global $pdo, $mainvisuals;
  $sql = "SELECT * FROM mainvisuals ORDER BY id DESC";
  $mainvisuals = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
function edit_init(){
  global $pdo, $mainvisual;
  if(empty($_POST)){
    $sql = "SELECT * FROM mainvisuals WHERE id = :id";
    $sth = $pdo->prepare($sql);
    $sth->execute([':id'=>isset($_GET['id']) ? $_GET['id'] : 0]);
    $mainvisual = $sth->fetch(PDO::FETCH_ASSOC);
  }else{
    if(!$_POST['id']){
      if(insertTable('mainvisuals', [
        'extension' => '',
        'view' => $_POST['view'],
      ])){
        $_SESSION['flash_message'] = '登録しました。';
        $update_id = $pdo->lastInsertId();
      }else{
        $_SESSION['flash_message'] = '登録に失敗しました。';
      }
    }else{
      if(updateTable('mainvisuals', [
        'view' => $_POST['view'],
      ], [
        'id' => $_POST['id'],
      ])){
        $_SESSION['flash_message'] = '変更しました。';
        $update_id = $_POST["id"];
      }else{
        $_SESSION['flash_message'] = '変更に失敗しました。';
      }
    }
    if(isset($update_id)){
      if($_FILES['img']['size']){
        $file = $_FILES['img']['tmp_name'];
        $filename = $_FILES['img']['name'];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        move_uploaded_file($file, '../../../../img/mv/'.$update_id.'.'.$extension);
        updateTable('mainvisuals', [
          'extension' => $extension,
        ], [
          'id' => $update_id,
        ]);
      }
    }
    header('Location: http://' . ROOT_DIR . '/for_members/admin/toppage/mainvisual/');
    exit;
  }
}
