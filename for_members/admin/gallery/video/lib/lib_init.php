<?php
require_once('../../lib/lib_init.php');
function index_init(){
  global $pdo, $videos;
  $sql = "SELECT * FROM videos WHERE view = 1 AND grade = ".MANAGER_GRADE." ORDER BY id DESC";
  $videos = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
function edit_init(){
  global $pdo, $video;
  if(empty($_POST)){
    $sql = "SELECT * FROM videos WHERE id = :id";
    $sth = $pdo->prepare($sql);
    $sth->execute([':id'=>isset($_GET['id']) ? $_GET['id'] : 0]);
    $video = $sth->fetch(PDO::FETCH_ASSOC);
  }else{
    if(!$_POST['id']){
      if(insertTable('videos', [
        'name' => $_POST['name'],
        'url' => $_POST['url'],
        'grade' => MANAGER_GRADE,
      ])){
        $_SESSION['flash_message'] = '登録しました。';
      }else{
        $_SESSION['flash_message'] = '登録に失敗しました。';
      }
    }else{
      if(updateTable('videos', [
        'name' => $_POST['name'],
        'url' => $_POST['url'],
        'grade' => MANAGER_GRADE,
      ], [
        'id' => $_POST['id'],
      ])){
        $_SESSION['flash_message'] = '変更しました。';
      }else{
        $_SESSION['flash_message'] = '変更に失敗しました。';
      }
    }
    header('Location: http://' . ROOT_DIR . '/for_members/admin/gallery/video/');
    exit;
  }
}
