<?php
require_once('../lib/lib_init.php');
$participation_array = [
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
  global $pdo, $members, $participations;
  $sql = "SELECT id, name, grade FROM members WHERE view = 1 ORDER BY grade ASC, id ASC";
  $members = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  foreach($members as $member){
    $sql = "SELECT * FROM summer_camp_participations WHERE member_id = {$member['id']}";
    $participations[$member['id']] = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  }
}
function excel_init(){
  global $pdo, $participations, $event, $grade_names;
  $sql = "SELECT * FROM events WHERE id = {$_GET['event_id']}";
  $event = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  $grade_names = [
    "上級生",
    "3年生",
    "2年生",
    "1年生",
  ];
  $sql_grades = [
    "m.grade < ".(MANAGER_GRADE),
    "m.grade = ".(MANAGER_GRADE),
    "m.grade = ".(MANAGER_GRADE + 1),
    "m.grade = ".(MANAGER_GRADE + 2),
  ];
  foreach($sql_grades as $key => $sql_grade){
    $sql = "SELECT m.name, p.note FROM event_participations AS p JOIN members AS m ON p.member_id = m.id WHERE p.event_id = {$_GET['event_id']} AND p.participation = 1 AND {$sql_grade} AND gender = 'male' ORDER BY m.order ASC";
    $participations[$key]['male'] = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    $sql = "SELECT m.name, p.note FROM event_participations AS p JOIN members AS m ON p.member_id = m.id WHERE p.event_id = {$_GET['event_id']} AND p.participation = 1 AND {$sql_grade} AND gender = 'female' ORDER BY m.order ASC";
    $participations[$key]['female'] = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  }
}
function edit_init(){
  global $pdo, $member, $participation;
  if(empty($_POST)){
    $sql = "SELECT * FROM members WHERE id = :id";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':id'=>$_GET['member_id']));
    $member = $sth->fetch(PDO::FETCH_ASSOC);
    $sql = "SELECT * FROM summer_camp_participations WHERE member_id = :member_id";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':member_id'=>$_GET['member_id']));
    $participation = $sth->fetch(PDO::FETCH_ASSOC);
  }else{
    $sql = "SELECT * FROM summer_camp_participations WHERE member_id = :member_id";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':member_id'=>$_POST['member_id']));
    $participation = $sth->fetch(PDO::FETCH_ASSOC);
    if(!isset($participation['id'])){
      $private_car = ($_POST['participation']==1 && $_POST['private_car_flag']==1) ? $_POST['private_car'] : 0;
      $car_rental = ($_POST['participation']==1 && !$private_car) ? $_POST['car_rental'] : NULL;
      $racket = ($_POST['participation']==1) ? $_POST['racket'] : NULL;
      $ball = ($_POST['participation']==1) ? $_POST['ball'] : NULL;
      $date = ($_POST['participation']==2) ? implode(',', $_POST['date']) : NULL;
      if(insertTable('summer_camp_participations', [
        'member_id' => $_POST['member_id'],
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
        'id' => $participation['id'],
        'member_id' => $_POST['member_id'],
      ])){
        $_SESSION['flash_message'] = '変更しました。';
      }else{
        $_SESSION['flash_message'] = '変更に失敗しました。';
      }
    }
    header('Location: http://' . ROOT_DIR . '/for_members/admin/summer_camp/');
    exit;
  }
}
