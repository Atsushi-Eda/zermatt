<?php
require_once('../../lib/lib_init.php');
function index_init(){
  global $pdo, $events;
  $sql = "SELECT * FROM events WHERE grade = ".MANAGER_GRADE." ORDER BY id DESC";
  $events = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
function edit_init(){
  global $pdo, $event;
  if(empty($_POST)){
    $sql = "SELECT * FROM events WHERE id = :id";
    $sth = $pdo->prepare($sql);
    $sth->execute([':id'=>isset($_GET['id']) ? $_GET['id'] : 0]);
    $event = $sth->fetch(PDO::FETCH_ASSOC);
  }else{
    if(!$_POST['id']){
      if(insertTable('events', [
        'name' => $_POST['name'],
        'short_name' => $_POST['short_name'],
        'date' => $_POST['date'],
        'duration' => $_POST['duration'],
        'grade' => MANAGER_GRADE,
        'assembly' => $_POST['assembly'],
        'sophomore' => $_POST['sophomore'],
        'questionnaire' => $_POST['questionnaire'],
        'after' => $_POST['after'],
        'meeting_place' => $_POST['meeting_place'],
        'other_question' => $_POST['other_question'],
        'view' => $_POST['view'],
        'intro' => $_POST['intro'],
        'video' => $_POST['video'],
      ])){
        $_SESSION['flash_message'] = '登録しました。';
        $update_id = $pdo->lastInsertId();
      }else{
        $_SESSION['flash_message'] = '登録に失敗しました。';
      }
    }else{
      if(updateTable('events', [
        'name' => $_POST['name'],
        'short_name' => $_POST['short_name'],
        'date' => $_POST['date'],
        'duration' => $_POST['duration'],
        'grade' => MANAGER_GRADE,
        'assembly' => $_POST['assembly'],
        'sophomore' => $_POST['sophomore'],
        'questionnaire' => $_POST['questionnaire'],
        'after' => $_POST['after'],
        'meeting_place' => $_POST['meeting_place'],
        'other_question' => $_POST['other_question'],
        'view' => $_POST['view'],
        'intro' => $_POST['intro'],
        'video' => $_POST['video'],
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
      $dir = '../../../../img/event/' . $update_id . '/';
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
    header('Location: http://' . ROOT_DIR . '/for_members/admin/event/schedule/');
    exit;
  }
}
