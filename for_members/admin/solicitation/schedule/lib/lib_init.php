<?php
require_once('../../lib/lib_init.php');
function index_init(){
  global $pdo, $schedules;
  $sql = "SELECT * FROM solicitation_schedules WHERE deleted = 0 ORDER BY date ASC";
  $schedules = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
function edit_init(){
  global $pdo, $schedule;
  if(empty($_POST)){
    $sql = "SELECT * FROM solicitation_schedules WHERE id = :id";
    $sth = $pdo->prepare($sql);
    $sth->execute([':id'=>isset($_GET['id']) ? $_GET['id'] : 0]);
    $schedule = $sth->fetch(PDO::FETCH_ASSOC);
  }else{
    if(!$_POST['id']){
      if(insertTable('solicitation_schedules', [
        'date' => $_POST['date'],
        'time' => $_POST['time'],
        'AMPM' => $_POST['AMPM'],
        'place' => $_POST['place'],
        'place_category' => $_POST['place_category'],
        'price' => $_POST['price'],
        'meeting_place' => $_POST['meeting_place'],
        'meeting_time' => $_POST['meeting_time'],
        'male' => $_POST['male'],
        'female' => $_POST['female'],
      ])){
        $_SESSION['flash_message'] = '登録しました。';
      }else{
        $_SESSION['flash_message'] = '登録に失敗しました。';
      }
    }else{
      if(updateTable('solicitation_schedules', [
        'date' => $_POST['date'],
        'time' => $_POST['time'],
        'AMPM' => $_POST['AMPM'],
        'place' => $_POST['place'],
        'place_category' => $_POST['place_category'],
        'price' => $_POST['price'],
        'meeting_place' => $_POST['meeting_place'],
        'meeting_time' => $_POST['meeting_time'],
        'male' => $_POST['male'],
        'female' => $_POST['female'],
      ], [
        'id' => $_POST['id'],
      ])){
        $_SESSION['flash_message'] = '変更しました。';
      }else{
        $_SESSION['flash_message'] = '変更に失敗しました。';
      }
    }
    header('Location: http://' . ROOT_DIR . '/for_members/admin/solicitation/schedule/');
    exit;
  }
}
function edit_number_init(){
  global $pdo, $schedules, $cnt, $cnt_male, $cnt_female;
  if(isset($_POST["id"])){
    if(updateTable('solicitation_schedules', [
      'male' => $_POST['male'],
      'female' => $_POST['female'],
    ], [
      'id' => $_POST['id']
    ])){
      $_SESSION['flash_message'] = '上限を変更しました。';
    }else{
      $_SESSION['flash_message'] = '上限の変更に失敗しました。';
    }
  }
  $sql = "SELECT * FROM solicitation_schedules WHERE deleted = 0 ORDER BY date ASC, AMPM ASC";
  $schedules_tmp = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  foreach($schedules_tmp as $schedule_tmp){
    $schedules[$schedule_tmp['id']] = $schedule_tmp;
    $schedules[$schedule_tmp['id']]['capacity'] = $schedule_tmp['male'] + $schedule_tmp['female'];
  }
  foreach($schedules as $schedule_id => $schedule){
    $sql = "SELECT count(id) AS cnt FROM solicitation_guests WHERE deleted = false AND schedule_id = {$schedule_id} AND gender = :gender";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':gender'=>'male'));
    $tmp = $sth->fetch(PDO::FETCH_ASSOC);
    $cnt_male[$schedule_id] = $tmp['cnt'];
    $sth->execute(array(':gender'=>'female'));
    $tmp = $sth->fetch(PDO::FETCH_ASSOC);
    $cnt_female[$schedule_id] = $tmp['cnt'];
    $cnt[$schedule_id] = $cnt_male[$schedule_id] + $cnt_female[$schedule_id];
  }
}
