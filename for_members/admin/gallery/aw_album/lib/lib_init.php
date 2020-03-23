<?php
require_once('../../lib/lib_init.php');
function index_init(){
  global $pdo, $albums, $dir;
  $sql = "SELECT * FROM aw_albums WHERE view = 1 ORDER BY id DESC";
  $albums = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  $dir = '../../../../img/aw_gallery/';
}
function edit_init(){
  global $pdo, $album;
  if(empty($_POST)){
    $sql = "SELECT * FROM aw_albums WHERE id = :id";
    $sth = $pdo->prepare($sql);
    $sth->execute([':id'=>isset($_GET['id']) ? $_GET['id'] : 0]);
    $album = $sth->fetch(PDO::FETCH_ASSOC);
  }else{
    if(!$_POST['id']){
      if(insertTable('aw_albums', [
        'name' => $_POST['name'],
        'url' => $_POST['url'],
        'grade' => $_POST['grade'],
      ])){
        $_SESSION['flash_message'] = '登録しました。';
        $update_id = $pdo->lastInsertId();
      }else{
        $_SESSION['flash_message'] = '登録に失敗しました。';
      }
    }else{
      if(updateTable('aw_albums', [
        'name' => $_POST['name'],
        'url' => $_POST['url'],
        'grade' => $_POST['grade'],
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
      $dir = '../../../../img/aw_gallery/' . $update_id . '/';
      if(!file_exists($dir)){
        mkdir($dir);
      }
      if($_FILES['imgs']['size'][0]){
        array_map('unlink', glob($dir."*"));
        foreach($_FILES['imgs']['name'] as $key => $name){
          move_uploaded_file($_FILES['imgs']['tmp_name'][$key], $dir.$key.'.'.pathinfo($name, PATHINFO_EXTENSION));
        }
      }
    }
    header('Location: http://' . ROOT_DIR . '/for_members/admin/gallery/aw_album/');
    exit;
  }
}
