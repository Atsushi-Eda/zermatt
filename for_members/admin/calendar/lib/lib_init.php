<?php
require_once('../lib/lib_init.php');
function index_init(){
  global $pdo, $y, $m, $national_holidays, $events, $other_events;
  $y = date('Y');
  $m = date('n');
  if(!empty($_GET['date'])){
    $arr_date = explode('-', htmlspecialchars($_GET['date'], ENT_QUOTES));
    if(count($arr_date) == 2 and is_numeric($arr_date[0]) and is_numeric($arr_date[1])){
      $y = (int)$arr_date[0];
      $m = (int)$arr_date[1];
    }
  }
  $national_holidays = array();
  $apiKey = 'AIzaSyAhrK8MLkdyiC2nUB2oIwNPUpcHdFONEGU';
  $calendar_id = urlencode('japanese__ja@holiday.calendar.google.com');
  $start  = date($y."-".$m."-01\T00:00:00\Z");
  $finish = ($m==12) ? date(($y+1)."-01-01\T00:00:00\Z") : date($y."-".($m+1)."-01\T00:00:00\Z");
  $url = "https://www.googleapis.com/calendar/v3/calendars/{$calendar_id}/events?key={$apiKey}&timeMin={$start}&timeMax={$finish}&maxResults=50&orderBy=startTime&singleEvents=true";
  if ($results = file_get_contents($url, true)){
    $results = json_decode($results);
    foreach ($results->items as $item) {
      $date = strtotime((string) $item->start->date);
      $title = (string) $item->summary;
      $national_holidays[date('Y-m-d', $date)] = $title;
    }
    ksort($national_holidays);
  }
  $sql = "SELECT name, DATE_FORMAT(date, '%e') AS day, duration FROM events WHERE DATE_FORMAT(date, '%Y%c') = {$y}{$m}";
  $event_tmps = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  foreach($event_tmps as $event_tmp){
    for($i=0; $i<$event_tmp['duration']; $i++){
      $events[$event_tmp['day']+$i] = $event_tmp['name'];
    }
  }
  $sql = "SELECT id, name, DATE_FORMAT(date, '%e') AS day, start_time, end_time, view, member_id FROM other_events WHERE DATE_FORMAT(date, '%Y%c') = {$y}{$m}";
  $other_event_tmps = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  foreach($other_event_tmps as $key => $other_event_tmp){
    if(($other_event_tmp['view']==1 && $_SESSION['user']['id']==$other_event_tmp['member_id']) || $other_event_tmp['view']==2 || $other_event_tmp['view']==3){
      $other_events[$other_event_tmp['day']][$key]['id'] = $other_event_tmp['id'];
      $other_events[$other_event_tmp['day']][$key]['name'] = $other_event_tmp['name'];
      if(isset($other_event_tmp['start_time'])){
        $start_time_tmp = explode(':', $other_event_tmp['start_time']);
        $other_events[$other_event_tmp['day']][$key]['start_time'] = $start_time_tmp[0].':'.$start_time_tmp[1];
      }
      if(isset($other_event_tmp['end_time'])){
        $end_time_tmp = explode(':', $other_event_tmp['end_time']);
        $other_events[$other_event_tmp['day']][$key]['end_time'] = $end_time_tmp[0].':'.$end_time_tmp[1];
      }
    }
  }
}
function add_init(){
  if(isset($_POST['name'])){
    $count = 0;
    for($i=0; $i<$_POST['duration']; $i++){
      $start_time = ($_POST['start_time']=='') ? NULL : $_POST['start_time'];
      $end_time = ($_POST['end_time']=='') ? NULL : $_POST['end_time'];
      $date = date("Y-m-d", strtotime("{$_POST['date']} +{$i} day"));
      if(insertTable('other_events', [
        'name' => $_POST['name'],
        'date' => $date,
        'start_time' => $start_time,
        'end_time' => $end_time,
        'view' => $_POST['view'],
        'member_id' => $_SESSION['user']['id']
      ])){
        $count++;
      }
    }
    $_SESSION['flash_message'] = $count . '件の登録の登録を行いました。';
    header('Location: http://' . ROOT_DIR . '/for_members/admin/calendar/');
    exit;
  }
}
function edit_init(){
  global $pdo;
  if(!isset($_POST['id'])){
    if(!isset($_GET['id'])){
      $_SESSION['flash_message'] = 'エラーが発生しました。';
      header('Location: http://' . ROOT_DIR . '/for_members/admin/calendar/');
      exit;
    }
    global $other_event;
    $sql = "SELECT * FROM other_events WHERE id = :id";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':id'=>$_GET['id']));
    $other_event = $sth->fetch(PDO::FETCH_ASSOC);
  }else{
    $start_time = ($_POST['start_time']=='') ? NULL : $_POST['start_time'];
    $end_time = ($_POST['end_time']=='') ? NULL : $_POST['end_time'];
    if(updateTable('other_events', [
      'name' => $_POST['name'],
      'date' => $_POST['date'],
      'start_time' => $start_time,
      'end_time' => $end_time,
      'view' => $_POST['view'],
      'member_id' => $_SESSION['user']['id'],
    ], [
      'id'=>$_POST['id'],
    ])){
      $_SESSION['flash_message'] = '日程を変更しました。';
    }else{
      $_SESSION['flash_message'] = '日程の変更に失敗しました。';
    }
    header('Location: http://' . ROOT_DIR . '/for_members/admin/calendar/');
    exit;
  }
}
