<?php
$form_opening_period = array(
  'from' => '2016-11-01 00:00:00',
  'to' => '2017-08-16 17:00:00',
);
$participation = array(
  1 => "参加",
  2 => "不参加",
  3 => "後発",
);
$experience = array(
  1 => "1.足を揃えてスイスイ滑ることができる",
  2 => "2.ある程度滑ることができる",
  3 => "3.何回かしたことがあるがあまり滑れない",
  4 => "4.全くしたことがない",
);
function index_init(){
  global $pdo, $data;
  $sql = "SELECT * FROM solicitation_camp_participations WHERE member_id = {$_SESSION['user']['id']}";
  $data = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}
function form_init(){
  global $pdo, $form_opening_period;
  if(time()<strtotime($form_opening_period['from']) || time()>strtotime($form_opening_period['to'])){
    $_SESSION['flash_message'] = '回答受付期間外です。';
    header('Location: http://' . ROOT_DIR . '/for_members/solicitation_camp/');
    exit;
  }
  $sql = "SELECT * FROM solicitation_camp_participations WHERE member_id = {$_SESSION['user']['id']}";
  $data_tmp = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  if(isset($data_tmp['id'])){
    $_SESSION['flash_message'] = '回答済みです。';
    header('Location: http://' . ROOT_DIR . '/for_members/solicitation_camp/');
    exit;
  }
  if(isset($_POST['participation'])){
    $sql = "INSERT INTO solicitation_camp_participations (member_id, participation, experience, wear, goggles, knit, gloves, note) VALUES (:member_id, :participation, :experience, :wear, :goggles, :knit, :gloves, :note)";
    $sth = $pdo->prepare($sql);
    if($sth->execute(array(':member_id'=>$_SESSION['user']['id'], ':participation'=>$_POST['participation'], ':experience'=>$_POST['experience'], ':wear'=>$_POST['wear'], ':goggles'=>$_POST['goggles'], ':knit'=>$_POST['knit'], ':gloves'=>$_POST['gloves'], ':note'=>$_POST['note']))){
      $_SESSION['flash_message'] = '回答しました。';
    }else{
      $_SESSION['flash_message'] = '回答に失敗しました。';
    }
    header('Location: http://' . ROOT_DIR . '/for_members/solicitation_camp/');
    exit;
  }
}
function edit_init(){
  global $pdo, $data, $form_opening_period;
  if(time()<strtotime($form_opening_period['from']) || time()>strtotime($form_opening_period['to'])){
    $_SESSION['flash_message'] = '回答受付期間外です。';
    header('Location: http://' . ROOT_DIR . '/for_members/solicitation_camp/');
    exit;
  }
  if(!isset($_POST['id'])){
    $sql = "SELECT * FROM solicitation_camp_participations WHERE member_id = {$_SESSION['user']['id']}";
    $data = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    if(!isset($data['id'])){
      $_SESSION['flash_message'] = 'エラーが発生しました。';
      header('Location: http://' . ROOT_DIR . '/for_members/solicitation_camp/');
      exit;
    }
  }else{
    $sql = "UPDATE solicitation_camp_participations SET participation = :participation, experience = :experience, wear = :wear, goggles = :goggles, knit = :knit, gloves = :gloves, note = :note, update_time = null WHERE id = :id AND member_id = :member_id";
    $sth = $pdo->prepare($sql);
    if($sth->execute(array(':participation'=>$_POST['participation'], ':experience'=>$_POST['experience'], ':wear'=>$_POST['wear'], ':goggles'=>$_POST['goggles'], ':knit'=>$_POST['knit'], ':gloves'=>$_POST['gloves'], ':note'=>$_POST['note'], ':id'=>$_POST['id'], ':member_id'=>$_SESSION['user']['id']))){
      $_SESSION['flash_message'] = '変更しました。';
    }else{
      $_SESSION['flash_message'] = '変更に失敗しました。';
    }
    header('Location: http://' . ROOT_DIR . '/for_members/solicitation_camp/');
    exit;
  }
}