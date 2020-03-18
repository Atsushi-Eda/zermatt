<?php
require_once('../lib/lib_init.php');
function index_init(){
  global $pdo, $members, $participations;
  $sql = "SELECT * FROM members WHERE view = true";
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
