<?php
function index_init(){
  global $pdo, $guests, $schedules, $cnt, $cnt_male, $cnt_female;
  $sql = "SELECT g.id, g.name, g.gender, s.date, s.AMPM, s.place, g.meeting_place, g.school, g.note FROM solicitation_guests AS g LEFT JOIN solicitation_schedules AS s ON g.schedule_id = s.id WHERE s.deleted = 0 AND g.deleted = 0 AND g.member_id = {$_SESSION['user']['id']} ORDER BY g.update_time DESC";
  $guests = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  $sql = "SELECT * FROM solicitation_schedules WHERE deleted = 0 ORDER BY date ASC, AMPM ASC";
  $schedules_tmp = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  foreach($schedules_tmp as $schedule_tmp){
    $schedules[$schedule_tmp['id']] = $schedule_tmp;
    $schedules[$schedule_tmp['id']]['capacity'] = $schedule_tmp['male'] + $schedule_tmp['female'];
  }
  foreach($schedules as $schedule_id => $schedule){
    $sql = "SELECT count(id) AS cnt FROM solicitation_guests WHERE deleted = 0 AND schedule_id = {$schedule_id} AND gender = :gender";
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
function form_init(){
  global $pdo;
  if(!isset($_POST['name'])){
    global $schedule, $gender;
    $sql = "SELECT * FROM solicitation_schedules WHERE id = :id AND deleted = 0";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':id'=>$_GET['schedule']));
    $schedule = $sth->fetch(PDO::FETCH_ASSOC);
    if(!isset($schedule['id']) || !isset($gender[$_GET['gender']])){
      $_SESSION['flash_message'] = 'エラーが発生しました。';
      header('Location: http://' . ROOT_DIR . '/for_members/solicitation/');
      exit;
    }
  }else{
    $sql = "SELECT count(id) AS cnt FROM solicitation_guests WHERE deleted = 0 AND schedule_id = :schedule_id AND gender = :gender";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':schedule_id'=>$_POST['schedule_id'], ':gender'=>$_POST['gender']));
    $cnt = $sth->fetch(PDO::FETCH_ASSOC);
    $sql = "SELECT male, female FROM solicitation_schedules WHERE id = :schedule_id";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':schedule_id'=>$_POST['schedule_id']));
    $capacity = $sth->fetch(PDO::FETCH_ASSOC);
    if($cnt['cnt'] >= $capacity[$_POST['gender']]){
      $_SESSION['flash_message'] = '予約に失敗しました。人数制限を超えています。';
    }else{
      if(insertTable('solicitation_guests', [
        'schedule_id' => $_POST['schedule_id'],
        'meeting_place' => $_POST['meeting_place'],
        'name' => $_POST['name'],
        'gender' => $_POST['gender'],
        'school' => $_POST['school'],
        'note' => $_POST['note'],
        'member_id' => $_SESSION['user']['id']
      ])){
        $_SESSION['flash_message'] = '予約しました。';
      }else{
        $_SESSION['flash_message'] = '予約に失敗しました。';
      }
    }
    header('Location: http://' . ROOT_DIR . '/for_members/solicitation/');
    exit;
  }
}
function edit_init(){
  global $pdo;
  if(!isset($_POST['name'])){
    global $schedule, $guest, $gender;
    $sql = "SELECT * FROM solicitation_guests WHERE deleted = 0 AND id = :id AND member_id = :member_id";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':id'=>$_GET['id'], ':member_id'=>$_SESSION['user']['id']));
    $guest = $sth->fetch(PDO::FETCH_ASSOC);
    $sql = "SELECT * FROM solicitation_schedules WHERE id = :id AND deleted = 0";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':id'=>$guest['schedule_id']));
    $schedule = $sth->fetch(PDO::FETCH_ASSOC);
    if(!isset($schedule['id'])){
      $_SESSION['flash_message'] = 'エラーが発生しました。';
      header('Location: http://' . ROOT_DIR . '/for_members/solicitation/');
      exit;
    }
  }else{
    if(updateTable('solicitation_guests', [
      'meeting_place' => $_POST['meeting_place'],
      'name' => $_POST['name'],
      'school' => $_POST['school'],
      'note' => $_POST['note'],
    ], [
      'id' => $_POST['id'],
      'member_id' => $_SESSION['user']['id'],
      ]
    )){
      $_SESSION['flash_message'] = '予約を変更しました。';
    }else{
      $_SESSION['flash_message'] = '予約の変更に失敗しました。';
    }
    header('Location: http://' . ROOT_DIR . '/for_members/solicitation/');
    exit;
  }
}
