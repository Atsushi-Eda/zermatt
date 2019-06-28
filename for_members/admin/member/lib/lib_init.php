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
    $sth->execute(array(':id'=>$_GET['id']));
    $member = $sth->fetch(PDO::FETCH_ASSOC);
  }else{
    if(!$_POST['id']){
      $sql = "INSERT INTO members (name, password, phonetic, nickname, grade, gender, position, birthmonth, birthday, intro_view, intro, video_id, video, blog, `order`) VALUES (:name, :password, :phonetic, :nickname, :grade, :gender, :position, :birthmonth, :birthday, :intro_view, :intro, :video_id, :video, :blog, :order)";
      $sth = $pdo->prepare($sql);
      if($sth->execute(array(':name'=>$_POST['name'], ':password'=>$_POST['password'], ':phonetic'=>$_POST['phonetic'], ':nickname'=>$_POST['nickname'], ':grade'=>$_POST['grade'], ':gender'=>$_POST['gender'], ':position'=>$_POST['position'], ':birthmonth'=>$_POST['birthmonth'], ':birthday'=>$_POST['birthday'], ':intro_view'=>$_POST['intro_view'], ':intro'=>$_POST['intro'], ':video_id'=>$_POST['video_id'], ':video'=>$_POST['video'], ':blog'=>$_POST['blog'], ':order'=>$_POST['order']))){
        $_SESSION['flash_message'] = '登録しました。';
        $update_id = $pdo->lastInsertId();
      }else{
        $_SESSION['flash_message'] = '登録に失敗しました。';
      }
    }else{
      $sql = "UPDATE members SET name = :name, password = :password, phonetic = :phonetic, nickname = :nickname, grade = :grade, gender = :gender, position = :position, birthmonth = :birthmonth, birthday = :birthday, intro_view = :intro_view, intro = :intro, video_id = :video_id, video = :video, blog = :blog, `order` = :order WHERE id = :id";
      $sth = $pdo->prepare($sql);
      if($sth->execute(array(':name'=>$_POST['name'], ':password'=>$_POST['password'], ':phonetic'=>$_POST['phonetic'], ':nickname'=>$_POST['nickname'], ':grade'=>$_POST['grade'], ':gender'=>$_POST['gender'], ':position'=>$_POST['position'], ':birthmonth'=>$_POST['birthmonth'], ':birthday'=>$_POST['birthday'], ':intro_view'=>$_POST['intro_view'], ':intro'=>$_POST['intro'], ':video_id'=>$_POST['video_id'], ':video'=>$_POST['video'], ':blog'=>$_POST['blog'], ':order'=>$_POST['order'], ':id'=>$_POST['id']))){
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