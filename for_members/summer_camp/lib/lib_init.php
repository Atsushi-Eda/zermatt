<?php
$form_opening_period = [
  'from' => '2016-11-01 00:00:00',
  'to' => '2017-06-16 17:00:00',
];
$participation = [
  1 => "参加",
  2 => "途中参加or途中帰宅",
  3 => "不参加",
  4 => "未定",
];
$dates = [
  7,
  8,
  9,
  10,
];
function index_init(){
  global $pdo, $data;
  $sql = "SELECT * FROM summer_camp_participations WHERE member_id = {$_SESSION['user']['id']}";
  $data = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}
function form_init(){
  global $pdo, $form_opening_period;
  if(time()<strtotime($form_opening_period['from']) || time()>strtotime($form_opening_period['to'])){
    $_SESSION['flash_message'] = '回答受付期間外です。';
    header('Location: http://' . ROOT_DIR . '/for_members/summer_camp/');
    exit;
  }
  $sql = "SELECT * FROM summer_camp_participations WHERE member_id = {$_SESSION['user']['id']}";
  $data_tmp = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  if(isset($data_tmp['id'])){
    $_SESSION['flash_message'] = '回答済みです。';
    header('Location: http://' . ROOT_DIR . '/for_members/summer_camp/');
    exit;
  }
  if(isset($_POST['participation'])){
    $private_car = ($_POST['participation']==1 && $_POST['private_car_flag']==1) ? $_POST['private_car'] : 0;
    $car_rental = ($_POST['participation']==1 && !$private_car) ? $_POST['car_rental'] : NULL;
    $racket = ($_POST['participation']==1) ? $_POST['racket'] : NULL;
    $ball = ($_POST['participation']==1) ? $_POST['ball'] : NULL;
    $date = ($_POST['participation']==2) ? implode(',', $_POST['date']) : NULL;
    if(insertTable('summer_camp_participations', [
      'member_id' => $_SESSION['user']['id'],
      'participation' => $_POST['participation'],
      'private_car' => $private_car,
      'car_rental' => $car_rental,
      'racket' => $racket,
      'ball' => $ball,
      'date' => $date,
      'note' => $_POST['note'],
    ])){
      $_SESSION['flash_message'] = '回答しました。';
    }else{
      $_SESSION['flash_message'] = '回答に失敗しました。';
    }
    header('Location: http://' . ROOT_DIR . '/for_members/summer_camp/');
    exit;
  }
}
function edit_init(){
  global $pdo, $data, $form_opening_period, $note_cls;
  if(time()<strtotime($form_opening_period['from']) || time()>strtotime($form_opening_period['to'])){
    $_SESSION['flash_message'] = '回答受付期間外です。';
    header('Location: http://' . ROOT_DIR . '/for_members/summer_camp/');
    exit;
  }
  if(!isset($_POST['id'])){
    $sql = "SELECT * FROM summer_camp_participations WHERE member_id = {$_SESSION['user']['id']}";
    $data = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    if(!isset($data['id'])){
      $_SESSION['flash_message'] = 'エラーが発生しました。';
      header('Location: http://' . ROOT_DIR . '/for_members/summer_camp/');
      exit;
    }
    if($data['participation']==3){
      $note_cls = 'absent required';
    }else if($data['participation']==3){
      $note_cls = 'undecided required';
    }else{
      $note_cls = 'free';
    }
  }else{
    $private_car = ($_POST['participation']==1 && $_POST['private_car_flag']==1) ? $_POST['private_car'] : NULL;
    $car_rental = ($_POST['participation']==1 && !$private_car) ? $_POST['car_rental'] : NULL;
    $racket = ($_POST['participation']==1) ? $_POST['racket'] : NULL;
    $ball = ($_POST['participation']==1) ? $_POST['ball'] : NULL;
    $date = ($_POST['participation']==2) ? implode(',', $_POST['date']) : NULL;
    if(updateTable('summer_camp_participations', [
      'participation' => $_POST['participation'],
      'private_car' => $private_car,
      'car_rental' => $car_rental,
      'racket' => $racket,
      'ball' => $ball,
      'date' => $date,
      'note' => $_POST['note'],
    ], [
      'id' => $_POST['id'],
      'member_id' => $_SESSION['user']['id'],
    ])){
      $_SESSION['flash_message'] = '変更しました。';
    }else{
      $_SESSION['flash_message'] = '変更に失敗しました。';
    }
    header('Location: http://' . ROOT_DIR . '/for_members/summer_camp/');
    exit;
  }
}
