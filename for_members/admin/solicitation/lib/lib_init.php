<?php
require_once('../lib/lib_init.php');
function view_init(){
  global $pdo, $guests, $schedules, $schedule_key;
  $sql = 'SELECT * FROM solicitation_schedules ORDER BY date ASC, AMPM ASC';
  $schedules = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  if(isset($_GET['schedule_id'])){
    foreach($schedules as $key => $schedule){
      if($schedule['id'] == $_GET['schedule_id']){
        $schedule_key = $key;
      }
    }
    if($_GET['schedule_id'] == 0){
      $sql_schedule = 1;
    }else{
      $sql_schedule = "g.schedule_id = ".$_GET['schedule_id'];
    }
    if($_GET['meeting_place'] == "0"){
      $sql_meeting_place = 1;
    }else{
      $sql_meeting_place = "g.meeting_place = '".$_GET['meeting_place']."'";
    }
    $sql = "SELECT g.id, g.name, g.gender, s.date, s.AMPM, s.place, g.meeting_place, g.school, g.note, m.name AS m_name, g.attendance, g.update_time FROM solicitation_guests AS g LEFT JOIN solicitation_schedules AS s ON g.schedule_id = s.id LEFT JOIN members AS m ON g.member_id = m.id WHERE g.deleted = 0 AND {$sql_schedule} AND {$sql_meeting_place} ORDER BY s.date ASC, s.AMPM ASC, g.meeting_place ASC, g.gender ASC";
    $guests = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  }
}
function edit_init(){
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
  $sql = "SELECT * FROM solicitation_schedules ORDER BY date ASC, AMPM ASC";
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
function rank_init(){
  global $pdo, $count;
  $count = array();
  $count2 = array();
  if(isset($_GET["grade"])){
    $sql_grade = "m.grade = " . $_GET["grade"];
  }else{
    $sql_grade = 1;
  }
  $sql = "SELECT count(g.id) AS cnt, m.name FROM solicitation_guests AS g INNER JOIN members AS m ON m.id = g.member_id WHERE deleted = 0 AND {$sql_grade} GROUP BY g.member_id";
  $count = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  foreach($count as $value){
    $count2[] = $value['cnt'];
  }
  array_multisort($count2, SORT_DESC, $count);
}
