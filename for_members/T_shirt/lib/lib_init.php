<?php
define("T_shirts_type", "AW");
$form_opening_period = array(
  'from' => '2016-11-01 00:00:00',
  'to' => '2018-12-01 17:00:00',
);
$sizes = array(
  'S',
  'M',
  'L',
  'XL',
  'XXL',
);
function index_init(){
  global $pdo, $data;
  $sql = "SELECT * FROM T_shirts WHERE member_id = {$_SESSION['user']['id']}";
  $data = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}
function form_init(){
  global $pdo, $form_opening_period;
  if(time()<strtotime($form_opening_period['from']) || time()>strtotime($form_opening_period['to'])){
    $_SESSION['flash_message'] = '回答受付期間外です。';
    header('Location: http://' . ROOT_DIR . '/for_members/T_shirt/');
    exit;
  }
  $sql = "SELECT * FROM T_shirts WHERE member_id = {$_SESSION['user']['id']}";
  $data_tmp = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  if(isset($data_tmp['id'])){
    $_SESSION['flash_message'] = '回答済みです。';
    header('Location: http://' . ROOT_DIR . '/for_members/T_shirt/');
    exit;
  }
  if(isset($_POST['buy'])){
    $sql = "INSERT INTO T_shirts (member_id, buy, size) VALUES (:member_id, :buy, :size)";
    $sth = $pdo->prepare($sql);
    $size = ($_POST['buy']==1) ? $_POST['size'] : NULL;
    if($sth->execute(array(':member_id'=>$_SESSION['user']['id'], ':buy'=>$_POST['buy'], ':size'=>$size))){
      $_SESSION['flash_message'] = '回答しました。';
    }else{
      $_SESSION['flash_message'] = '回答に失敗しました。';
    }
    header('Location: http://' . ROOT_DIR . '/for_members/T_shirt/');
    exit;
  }
}
function edit_init(){
  global $pdo, $data, $form_opening_period, $note_cls;
  if(time()<strtotime($form_opening_period['from']) || time()>strtotime($form_opening_period['to'])){
    $_SESSION['flash_message'] = '回答受付期間外です。';
    header('Location: http://' . ROOT_DIR . '/for_members/T_shirt/');
    exit;
  }
  if(!isset($_POST['id'])){
    $sql = "SELECT * FROM T_shirts WHERE member_id = {$_SESSION['user']['id']}";
    $data = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    if(!isset($data['id'])){
      $_SESSION['flash_message'] = 'エラーが発生しました。';
      header('Location: http://' . ROOT_DIR . '/for_members/T_shirt/');
      exit;
    }
  }else{
    $sql = "UPDATE T_shirts SET buy = :buy, size = :size WHERE id = :id AND member_id = :member_id";
    $sth = $pdo->prepare($sql);
    $size = ($_POST['buy']==1) ? $_POST['size'] : NULL;
    if($sth->execute(array(':buy'=>$_POST['buy'], ':size'=>$size, ':id'=>$_POST['id'], ':member_id'=>$_SESSION['user']['id']))){
      $_SESSION['flash_message'] = '変更しました。';
    }else{
      $_SESSION['flash_message'] = '変更に失敗しました。';
    }
    header('Location: http://' . ROOT_DIR . '/for_members/T_shirt/');
    exit;
  }
}