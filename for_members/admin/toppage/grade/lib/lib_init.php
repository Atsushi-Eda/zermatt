<?php
require_once('../../lib/lib_init.php');
function index_init(){
  global $pdo, $grades;
  $sql = "SELECT * FROM grades ORDER BY id DESC";
  $grades = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
function edit_init(){
  global $pdo, $grade;
  if(empty($_POST)){
    $sql = "SELECT * FROM grades WHERE id = :id";
    $sth = $pdo->prepare($sql);
    $sth->execute([':id'=>isset($_GET['id']) ? $_GET['id'] : 0]);
    $grade = $sth->fetch(PDO::FETCH_ASSOC);
  }else{
    if(!$_POST['id']){
      if(insertTable('grades', [
        'grade' => $_POST['grade'],
        'color' => $_POST['color'],
        'image_extension' => '',
        'view' => $_POST['view'],
      ])){
        $_SESSION['flash_message'] = '登録しました。';
        $update_id = $pdo->lastInsertId();
      }else{
        $_SESSION['flash_message'] = '登録に失敗しました。';
      }
    }else{
      if(updateTable('grades', [
        'grade' => $_POST['grade'],
        'color' => $_POST['color'],
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
        move_uploaded_file($file, '../../../../img/grade/'.$_POST['grade'].'.'.$extension);
        updateTable('grades', [
          'image_extension' => $extension,
        ], [
          'id' => $update_id,
        ]);
      }
    }
    header('Location: http://' . ROOT_DIR . '/for_members/admin/toppage/grade/');
    exit;
  }
}
