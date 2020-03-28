<?php
require_once('../../lib/lib_init.php');
function text_init(){
  global $pdo, $text;
  if(!isset($_POST['text'])){
    $text = $pdo->query('SELECT text FROM circle_introduction ORDER BY id DESC LIMIT 1')->fetch(PDO::FETCH_ASSOC)['text'];
  }else{
    if(insertTable('circle_introduction', [
      'text' => $_POST['text'],
    ])){
      $_SESSION['flash_message'] = '紹介文を更新しました。';
    }else{
      $_SESSION['flash_message'] = '紹介文の更新に失敗しました。';
    }
    header('Location: http://' . ROOT_DIR . '/for_members/admin/toppage/about/');
    exit;
  }
}
function video_init(){
  global $pdo, $url;
  if(!isset($_POST['url'])){
    $url = $pdo->query('SELECT url FROM solicitation_video ORDER BY id DESC LIMIT 1')->fetch(PDO::FETCH_ASSOC)['url'];
  }else{
    if(insertTable('solicitation_video', [
      'url' => $_POST['url'],
    ])){
      $_SESSION['flash_message'] = '紹介文を更新しました。';
    }else{
      $_SESSION['flash_message'] = '紹介文の更新に失敗しました。';
    }
    header('Location: http://' . ROOT_DIR . '/for_members/admin/toppage/about/');
    exit;
  }
}
function image_init(){
  global $dir;
  $dir = '../../../../img/about/';
  if(!empty($_FILES) && $_FILES['img']['size']){
    $file = $_FILES['img']['tmp_name'];
    $filename = $_FILES['img']['name'];
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    array_map('unlink', glob($dir."*"));
    if(move_uploaded_file($file, $dir.'about.'.$extension)){
      $_SESSION['flash_message'] = '紹介写真を更新しました。';
    }else{
      $_SESSION['flash_message'] = '紹介写真の更新に失敗しました。';
    }
    header('Location: http://' . ROOT_DIR . '/for_members/admin/toppage/about/');
    exit;
  }
}
