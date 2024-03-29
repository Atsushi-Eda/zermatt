<?php
require_once('../lib/lib_init.php');
function index_init(){
  global $pdo, $members;
  $sql = "SELECT * FROM members WHERE view = 1";
  $members = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
function edit_init(){
  global $pdo, $member;
  if(empty($_POST)){
    $sql = "SELECT * FROM members WHERE id = :id";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':id'=>isset($_GET['id'])?$_GET['id']:0));
    $member = $sth->fetch(PDO::FETCH_ASSOC);
  }else{
    if(!$_POST['id']){
      if(insertTable('members', [
        'name' => $_POST['name'],
        'password' => $_POST['password'],
        'phonetic' => $_POST['phonetic'],
        'nickname' => $_POST['nickname'],
        'grade' => $_POST['grade'],
        'gender' => $_POST['gender'],
        'position' => $_POST['position'],
        'birthmonth' => $_POST['birthmonth'],
        'birthday' => $_POST['birthday'],
        'intro_view' => $_POST['intro_view'],
        'intro' => $_POST['intro'],
        'video_id' => $_POST['video_id'],
        'video' => $_POST['video'],
        'blog' => $_POST['blog'],
        'order' => $_POST['order'],
      ])){
        $_SESSION['flash_message'] = '登録しました。';
        $update_id = $pdo->lastInsertId();
      }else{
        $_SESSION['flash_message'] = '登録に失敗しました。';
      }
    }else{
      if(updateTable('members', [
        'name' => $_POST['name'],
        'password' => $_POST['password'],
        'phonetic' => $_POST['phonetic'],
        'nickname' => $_POST['nickname'],
        'grade' => $_POST['grade'],
        'gender' => $_POST['gender'],
        'position' => $_POST['position'],
        'birthmonth' => $_POST['birthmonth'],
        'birthday' => $_POST['birthday'],
        'intro_view' => $_POST['intro_view'],
        'intro' => $_POST['intro'],
        'video_id' => $_POST['video_id'],
        'video' => $_POST['video'],
        'blog' => $_POST['blog'],
        'order' => $_POST['order'],
      ], [
        'id' => $_POST['id'],
      ])){
        $_SESSION['flash_message'] = '変更しました。';
        $update_id = $_POST["id"];
      }else{
        $_SESSION['flash_message'] = '変更に失敗しました。';
      }
    }
    if($_FILES["image"]["size"] && isset($update_id)){
      $canvas = imagecreatetruecolor($_POST["cropper_width"], $_POST["cropper_height"]);
      $imageInstance = imagecreatefromstring(file_get_contents($_FILES['image']['tmp_name']));
      $hasImageResampled = imagecopyresampled(
        $canvas,
        $imageInstance,
        0,
        0,
        $_POST["cropper_x"],
        $_POST["cropper_y"],
        $_POST["cropper_width"],
        $_POST["cropper_height"],
        $_POST["cropper_width"],
        $_POST["cropper_height"]
      );
      $hasOutputImage = imagejpeg(
        $canvas,
        "../../../img/member/".$update_id.".jpg",
        100
      );
      imagedestroy($canvas);
    }
    header('Location: http://' . ROOT_DIR . '/for_members/admin/member/');
    exit;
  }
}
function backup_init(){
  global $pdo, $backups;
  if(!isset($_POST['grade'])){
    $backups = array_filter(array_map(function($table){
      $table_name = array_values($table)[0];
      return strpos($table_name, '_') !== false ? intval(explode('_', $table_name)[1]) : false;
    }, $pdo->query("SHOW TABLES LIKE 'members%'")->fetchAll(PDO::FETCH_ASSOC)), function($grade){
      return $grade;
    });
  }else{
    $backup_table = 'members_'.$_POST['grade'];
    if(
      $pdo->prepare('CREATE TABLE IF NOT EXISTS '.$backup_table.' LIKE members')->execute() &&
      $pdo->prepare('TRUNCATE '.$backup_table)->execute() &&
      $pdo->prepare('INSERT INTO '.$backup_table.' SELECT * FROM members')->execute()
    ){
      $_SESSION['flash_message'] = 'テーブルのコピーに成功('.$backup_table.')。';
    }else{
      $_SESSION['flash_message'] = 'テーブルのコピーに失敗。';
    }
    $origin_dir = '../../../img/member/';
    $backup_dir = '../../../img/member_'.$_POST['grade'].'/';
    if(!file_exists($backup_dir)){
      mkdir($backup_dir);
    }
    foreach($pdo->query("SELECT id FROM members WHERE view = 1")->fetchAll(PDO::FETCH_ASSOC) as $id){
      $file = $id['id'].'.jpg';
      if(!file_exists($origin_dir.$file)){
        continue;
      }
      copy($origin_dir.$file, $backup_dir.$file);
    }
    header('Location: http://' . ROOT_DIR . '/for_members/admin/member/backup_check.php?grade=' . $_POST['grade']);
    exit;
  }
}
function backup_check_init(){
  global $pdo, $members, $grade, $dir;
  $grade = $_GET['grade'];
  $dir = '../../../img/member_'.$grade.'/';
  $sql = "SELECT * FROM members_".$grade." WHERE view = 1";
  $members = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
