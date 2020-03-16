<?php
require_once('../../lib/lib_init.php');
function view_init(){
  global $pdo, $members, $events, $event_alls, $participations;
  $sql = "SELECT id, name, phonetic, nickname FROM members WHERE view = 1 ORDER BY grade ASC, `order` ASC";
  $members = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  if(!isset($_GET['event_id']) || $_GET['event_id'] == 0){
    $sql_event = "grade = ".MANAGER_GRADE;
  }else{
    $sql_event = "id = ".$_GET['event_id'];
  }
  $sql = "SELECT * FROM events WHERE sophomore = 1 AND questionnaire = 1 AND {$sql_event} ORDER BY date DESC";
  $events = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  foreach($members as $member){
    foreach($events as $event){
      $sql = "SELECT * FROM event_participations WHERE member_id = {$member['id']} AND event_id = {$event['id']}";
      $participations[$member['id']][$event['id']] = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
  }
  $sql = "SELECT * FROM events WHERE sophomore = 1 AND questionnaire = 1 AND grade = ".MANAGER_GRADE." ORDER BY date DESC";
  $event_alls = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
function count_init(){
  global $pdo, $events, $grades, $genders, $answers, $participations, $afters;
  $sql = "SELECT * FROM events WHERE sophomore = 1 AND questionnaire = 1 ORDER BY date DESC";
  $events = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  $sql = "SELECT grade FROM members WHERE view = 1 GROUP BY grade ORDER BY grade DESC";
  $grade_tmps = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  $grades[0] = "%";
  foreach($grade_tmps as $grade_tmp){
    $grades[] = $grade_tmp['grade'];
  }
  $genders = ["%", "male", "female"];
  foreach($events as $event){
    $sql = "SELECT count(id) AS cnt FROM event_participations WHERE event_id = {$event['id']}";
    $answers[$event['id']] = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    foreach($grades as $grade){
      foreach($genders as $gender){
        $sql = "SELECT count(p.id) AS cnt FROM event_participations AS p JOIN members AS m ON p.member_id = m.id WHERE p.event_id = {$event['id']} AND p.participation = 1 AND m.grade LIKE '{$grade}' AND m.gender LIKE '{$gender}'";
        $participations[$event['id']][$grade][$gender] = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
      }
    }
    if($event['after']){
      foreach($grades as $grade){
        foreach($genders as $gender){
          $sql = "SELECT count(p.id) AS cnt FROM event_participations AS p JOIN members AS m ON p.member_id = m.id WHERE p.event_id = {$event['id']} AND p.after = 1 AND m.grade LIKE '{$grade}' AND m.gender LIKE '{$gender}'";
          $afters[$event['id']][$grade][$gender] = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        }
      }
    }
  }
}
function excel_init(){
  global $pdo, $participations, $event, $grade_names;
  $sql = "SELECT * FROM events WHERE sophomore = 1 AND id = {$_GET['event_id']}";
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
function text_init(){
  global $pdo, $text, $event;
  $sql = "SELECT short_name, after, meeting_place FROM events WHERE sophomore = 1 AND id = {$_GET['event_id']}";
  $event = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  $grade_names = [
    "上級生",
    "3年生",
    "1年生",
  ];
  $sql_grades = [
    "m.grade < ".(MANAGER_GRADE),
    "m.grade = ".(MANAGER_GRADE),
    "m.grade = ".(MANAGER_GRADE + 2),
  ];
  $text = "";
  if($event['meeting_place'] == ''){
    foreach($sql_grades as $key => $sql_grade){
      $sql = "SELECT m.nickname, m.name, m.grade, p.after FROM event_participations AS p JOIN members AS m ON p.member_id = m.id WHERE p.event_id = {$_GET['event_id']} AND p.participation = 1 AND {$sql_grade} ORDER BY m.grade ASC, m.order ASC";
      $participation_tmps[$key] = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    foreach($participation_tmps as $key => $participation_tmps2){
      foreach($participation_tmps2 as $key2 => $participation_tmp){
        $participations[$key][$key2] = $participation_tmp['nickname'] ? explode('、', $participation_tmp['nickname'])[0] : $participation_tmp['name'];
        if($participation_tmp['grade'] == MANAGER_GRADE) $participations[$key][$key2] .= "さん";
        if($event['after'] && !$participation_tmp['after']) $participations[$key][$key2] .= "(アフター×)";
      }
    }
    foreach($grade_names as $grade_key => $grade_name){
      $text .= $grade_name . "\n";
      $text .= implode("、", $participations[$grade_key]);
      if($grade_key < count($grade_names)-1) $text .= "\n\n";
    }
  }else{
    $meeting_places = array_merge(explode(',',$event['meeting_place']),array(""));
    foreach($sql_grades as $key => $sql_grade){
      $sql = "SELECT m.nickname, p.after, p.meeting_place FROM event_participations AS p JOIN members AS m ON p.member_id = m.id WHERE p.event_id = {$_GET['event_id']} AND p.participation = 1 AND {$sql_grade} ORDER BY m.grade ASC, m.order ASC";
      $participation_tmps[$key] = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    foreach($meeting_places as $place_key => $meeting_place){
      foreach($participation_tmps as $grade_key => $participation_tmps2){
        foreach($participation_tmps2 as $member_key => $participation_tmp){
          if($participation_tmp['meeting_place'] == $meeting_place){
            $participations[$place_key][$grade_key][$member_key] = $participation_tmp['nickname'];
            if($event['after'] && !$participation_tmp['after']) $participations[$key][$key2] .= "(アフター×)";
          }
        }
      }
    }
    foreach($meeting_places as $place_key => $meeting_place){
      if($meeting_place != ""){
        $text .= $meeting_place . "集合\n";
      }else{
        $text .= "集合場所未定\n";
      }
      foreach($grade_names as $grade_key => $grade_name){
        $text .= $grade_name . "\n";
        $text .= implode("、", $participations[$place_key][$grade_key]);
        if($place_key < count($meeting_places)-1 || $grade_key < count($grade_names)-1) $text .= "\n\n";
      }
    }
  }
}
function edit_init(){
  global $pdo, $event, $member, $participation;
  if(empty($_POST)){
    $sql = "SELECT * FROM events WHERE sophomore = 1 AND id = :id AND questionnaire = true";
    $sth = $pdo->prepare($sql);
    $sth->execute([':id'=>$_GET['event_id']]);
    $event = $sth->fetch(PDO::FETCH_ASSOC);
    $sql = "SELECT * FROM members WHERE id = :id";
    $sth = $pdo->prepare($sql);
    $sth->execute([':id'=>$_GET['member_id']]);
    $member = $sth->fetch(PDO::FETCH_ASSOC);
    $sql = "SELECT * FROM event_participations WHERE event_id = :event_id AND member_id = :member_id";
    $sth = $pdo->prepare($sql);
    $sth->execute([':event_id'=>$_GET['event_id'], ':member_id'=>$_GET['member_id']]);
    $participation = $sth->fetch(PDO::FETCH_ASSOC);
  }else{
    $sql = "SELECT * FROM event_participations WHERE event_id = :event_id AND member_id = :member_id";
    $sth = $pdo->prepare($sql);
    $sth->execute([':event_id'=>$_POST['event_id'], ':member_id'=>$_POST['member_id']]);
    $participation = $sth->fetch(PDO::FETCH_ASSOC);
    $after = ($_POST['after'] == "1");
    if(!isset($participation['id'])){
      if(insertTable('event_participations', [
        'event_id' => $_POST['event_id'],
        'member_id' => $_POST['member_id'],
        'participation' => $_POST['participation'],
        'after' => $after,
        'meeting_place' => $_POST['meeting_place'],
        'note' => $_POST['note'],
      ])){
        $_SESSION['flash_message'] = "回答を登録しました。";
      }else{
        $_SESSION['flash_message'] = '回答の登録に失敗しました。';
      }
    }else{
      if(updateTable('event_participations', [
        'participation' => $_POST['participation'],
        'after' => $after,
        'meeting_place' => $_POST['meeting_place'],
        'note' => $_POST['note'],
      ], [
        'event_id' => $_POST['event_id'],
        'member_id' => $_POST['member_id'],
      ])){
        $_SESSION['flash_message'] = '回答を変更しました。';
      }else{
        $_SESSION['flash_message'] = '回答の変更に失敗しました。';
      }
    }
    header('Location: http://' . ROOT_DIR . '/for_members/admin2/event/questionnaire/view.php?event_id=' . $_POST['event_id']);
    exit;
  }
}
function handson_init(){
  global $pdo, $rowHeaders, $contents, $columns;
  $sql = "SELECT id, name FROM members WHERE view = 1 ORDER BY grade ASC, `order` ASC";
  $members = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  $sql = "SELECT * FROM events WHERE questionnaire = 1 AND sophomore = 1 ORDER BY date DESC";
  $events = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  foreach($events as $event){
    $columns[] = array(
      'data' => $event['id'].'.participation',
      'title' => $event['short_name'].'出欠',
      'type' => 'numeric',
      'allowInvalid' => false
    );
    if($event['after']){
      $columns[] = array(
        'data' => $event['id'].'.after',
        'title' => $event['short_name'].'アフター',
        'type' => 'numeric',
        'allowInvalid' => false
      );
    }
    if($event['meeting_place']){
      $columns[] = array(
        'data' => $event['id'].'.meeting_place',
        'title' => $event['short_name'].'集合場所'
      );
    }
    $columns[] = array(
      'data' => $event['id'].'.note',
      'title' => $event['short_name'].'備考'
    );
  }
  foreach($members as $member){
    foreach($events as $event){
      $sql = "SELECT * FROM event_participations WHERE member_id = {$member['id']} AND event_id = {$event['id']}";
      $participation = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
      $content[$event['id']]['participation'] = $participation['participation'];
      if($event['after']){
        $content[$event['id']]['after'] = $participation['after'];
      }
      if($event['meeting_place']){
        $content[$event['id']]['meeting_place'] = $participation['meeting_place'];
      }
      $content[$event['id']]['note'] = $participation['note'];
    }
    $content['member_id'] = $member['id'];
    $rowHeaders[] = $member['name'];
    $contents[] = $content;
  }
}
