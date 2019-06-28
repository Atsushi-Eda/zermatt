<?php
$assembly = 10;
$event_form_opening_period = array(
  'from' => '2016-11-01 00:00:00',
  'to' => '2020-11-30 00:00:00',
);
function index_init(){
  global $pdo, $events, $participations, $assembly;
  $sql = "SELECT * FROM events WHERE questionnaire = true AND assembly <= {$assembly} ORDER BY assembly DESC, date ASC";
  $sth = $pdo->prepare($sql);
  $sth->execute();
  $events = $sth->fetchAll(PDO::FETCH_ASSOC);
  $sql = "SELECT * FROM event_participations WHERE event_id = :event_id AND member_id = :member_id";
  foreach($events as $event){
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':event_id'=>$event['id'], ':member_id'=>$_SESSION['user']['id']));
    $participations[$event['id']] = $sth->fetch(PDO::FETCH_ASSOC);
  }
}
function form_init(){
  global $pdo, $events, $assembly, $event_form_opening_period;
  if(time()<strtotime($event_form_opening_period['from']) || time()>strtotime($event_form_opening_period['to'])){
    $_SESSION['flash_message'] = '回答受付期間外です。';
    header('Location: http://' . ROOT_DIR . '/for_members/event/');
    exit;
  }
  $sql = "SELECT * FROM events WHERE assembly = :assembly AND questionnaire = true ORDER BY date ASC";
  $sth = $pdo->prepare($sql);
  $sth->execute(array(':assembly'=>$assembly));
  $events = $sth->fetchAll(PDO::FETCH_ASSOC);
  $sql = "SELECT id FROM event_participations WHERE event_id = :event_id AND member_id = :member_id";
  foreach($events as $key => $event){
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':event_id'=>$event['id'], ':member_id'=>$_SESSION['user']['id']));
    $participation = $sth->fetch(PDO::FETCH_ASSOC);
    if(isset($participation['id'])){
      unset($events[$key]);
    }
  }
  if(empty($events)){
    $_SESSION['flash_message'] = '回答済みです。';
    header('Location: http://' . ROOT_DIR . '/for_members/event/');
    exit;
  }
  if(!empty($_POST)){
    $sql = "INSERT INTO event_participations (event_id, member_id, participation, after, meeting_place, note) VALUES (:event_id, :member_id, :participation, :after, :meeting_place, :note)";
    $success_count = 0;
    foreach($events as $event){
      $sth = $pdo->prepare($sql);
      $after = ($_POST[$event['id']]['after'] == "1");
      if($sth->execute(array(':event_id'=>$event['id'], ':member_id'=>$_SESSION['user']['id'], ':participation'=>$_POST[$event['id']]['participation'], ':after'=>$after, ':meeting_place'=>$_POST[$event['id']]['meeting_place'], ':note'=>$_POST[$event['id']]['note']))){
        $success_count++;
      }
    }
    $_SESSION['flash_message'] = "{$success_count}件の登録を行いました。";
    header('Location: http://' . ROOT_DIR . '/for_members/event/');
    exit;
  }
}
function edit_init(){
  global $pdo, $event, $member, $participation, $event_form_opening_period;
  if(time()<strtotime($event_form_opening_period['from']) || time()>strtotime($event_form_opening_period['to'])){
    $_SESSION['flash_message'] = '回答受付期間外です。';
    header('Location: http://' . ROOT_DIR . '/for_members/event/');
    exit;
  }
  if(empty($_POST)){
    $sql = "SELECT * FROM events WHERE id = :id AND questionnaire = true";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':id'=>$_GET['event_id']));
    $event = $sth->fetch(PDO::FETCH_ASSOC);
    if(!isset($event['id'])){
      $_SESSION['flash_message'] = 'エラーが発生しました。';
      header('Location: http://' . ROOT_DIR . '/for_members/event/');
      exit;
    }
    $sql = "SELECT * FROM event_participations WHERE event_id = :event_id AND member_id = :member_id";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':event_id'=>$_GET['event_id'], ':member_id'=>$_SESSION['user']['id']));
    $participation = $sth->fetch(PDO::FETCH_ASSOC);
  }else{
    $sql = "SELECT * FROM event_participations WHERE event_id = :event_id AND member_id = :member_id";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':event_id'=>$_POST['event_id'], ':member_id'=>$_SESSION['user']['id']));
    $participation = $sth->fetch(PDO::FETCH_ASSOC);
    if(!isset($participation['id'])){
      $sql = "INSERT INTO event_participations (event_id, member_id, participation, after, meeting_place, note) VALUES (:event_id, :member_id, :participation, :after, :meeting_place, :note)";
      $sth = $pdo->prepare($sql);
      $after = ($_POST[$event['id']]['after'] == "1");
      if($sth->execute(array(':event_id'=>$_POST['event_id'], ':member_id'=>$_SESSION['user']['id'], ':participation'=>$_POST['participation'], ':after'=>$after, ':meeting_place'=>$_POST['meeting_place'], ':note'=>$_POST['note']))){
        $_SESSION['flash_message'] = "回答を登録しました。";
      }else{
        $_SESSION['flash_message'] = '回答の登録に失敗しました。';
      }
    }else{
      $sql = "UPDATE event_participations SET participation = :participation, after = :after, meeting_place = :meeting_place, note = :note, update_time = null WHERE event_id = :event_id AND member_id = :member_id";
      $sth = $pdo->prepare($sql);
      $after = ($_POST['after'] == "1");
      if($sth->execute(array(':participation'=>$_POST['participation'], ':after'=>$after, ':meeting_place'=>$_POST['meeting_place'], ':note'=>$_POST['note'], ':event_id'=>$_POST['event_id'], ':member_id'=>$_SESSION['user']['id']))){
        $_SESSION['flash_message'] = '回答を変更しました。';
      }else{
        $_SESSION['flash_message'] = '回答の変更に失敗しました。';
      }
    }
    header('Location: http://' . ROOT_DIR . '/for_members/event/');
    exit;
  }
}
