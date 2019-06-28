<?php
call_user_func(function(){
  global $pdo, $oldest, $show_b1;
  $sql = "SELECT grade FROM members WHERE intro_view = true ORDER BY grade ASC";
  $tmp = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  $oldest = $tmp["grade"];
  $sql = "SELECT id FROM members WHERE intro_view = true AND grade = " . (MANAGER_GRADE + 2);
  $tmp = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  $show_b1 = isset($tmp["id"]);
});
function login_init(){
  global $pdo;
  if(isset($_POST['password'])){
    if($_POST['password']=='1234'){
      if($_POST['auto_login']){
        $sql = "INSERT INTO auto_login2 (token) VALUES (:token)";
        $sth = $pdo->prepare($sql);
        $token = sha1(uniqid(mt_rand(), true));
        $sth->execute(array(':token'=>$token));
        setcookie("token2", $token, time()+60*60*24*365);
      }
      $_SESSION['password'] = true;
      $from = isset($_SESSION['from']) ? $_SESSION['from'] : '';
      unset($_SESSION['from']);
      header('Location: http://' . ROOT_DIR . $from);
      exit;
    }
  }
}
function calendar_init(){
  global $pdo, $y, $m, $national_holidays, $birthdays, $events, $other_events;
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
  $sql = "SELECT nickname, birthday FROM members WHERE birthmonth = {$m} AND view = true";
  $birthday_tmps = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  foreach($birthday_tmps as $birthday_tmp){
    if(isset($birthdays[$birthday_tmp['birthday']])){
      $birthdays[$birthday_tmp['birthday']] .= '&' . explode('、', $birthday_tmp['nickname'])[0];
    }else{
      $birthdays[$birthday_tmp['birthday']] = explode('、', $birthday_tmp['nickname'])[0];
    }
  }
  $sql = "SELECT name, DATE_FORMAT(date, '%e') AS day, duration FROM events WHERE DATE_FORMAT(date, '%Y%c') = {$y}{$m}";
  $event_tmps = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  foreach($event_tmps as $event_tmp){
    for($i=0; $i<$event_tmp['duration']; $i++){
      $events[$event_tmp['day']+$i] = $event_tmp['name'];
    }
  }
  $sql = "SELECT name, DATE_FORMAT(date, '%e') AS day, view FROM other_events WHERE DATE_FORMAT(date, '%Y%c') = {$y}{$m}";
  $other_event_tmps = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  foreach($other_event_tmps as $other_event_tmp){
    if($other_event_tmp['view']==3){
      $other_events[$other_event_tmp['day']][] = $other_event_tmp['name'];
    }
  }
}
function solicitation_init(){
  global $pdo, $schedules, $cnt, $cnt_male, $cnt_female;
  $sql = "SELECT * FROM solicitation_schedules ORDER BY date ASC, AMPM ASC";
  $schedules_tmp = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  foreach($schedules_tmp as $schedule_tmp){
    $schedules[$schedule_tmp['id']] = $schedule_tmp;
    $schedules[$schedule_tmp['id']]['capacity'] = $schedule_tmp['male'] + $schedule_tmp['female'];
    $time_tmp = explode(':', $schedule_tmp['time']);
    $schedules[$schedule_tmp['id']]['my_time'] = $time_tmp[0] . ':' . $time_tmp[1];
    $time_tmp = explode(':', $schedule_tmp['meeting_time']);
    $schedules[$schedule_tmp['id']]['my_meeting_time'] = $time_tmp[0] . ':' . $time_tmp[1];
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
function member_init(){
  global $pdo, $member_table, $member_image, $grades, $oldest, $manager;
  $member_table = "members_" . $_GET['ver'];
  $member_image = "member_" . $_GET['ver'];
  $manager = $_GET['ver'];
  $sql = "SHOW TABLES LIKE '" . $member_table . "'";
  if(!$pdo->query($sql)->fetch(PDO::FETCH_ASSOC)){
    $member_table = "members";
    $member_image = "member";
    $manager = MANAGER_GRADE;
  }
  if($_GET['grade'] == 'b1'){
    $grades[] = $manager + 2;
  }else if($_GET['grade'] == 'b2'){
    $grades[] = $manager + 1;
  }else if($_GET['grade'] == 'b3'){
    $grades[] = $manager;
  }else if($_GET['grade'] == 'b4'){
    $grades[] = $manager - 1;
  }else if($_GET['grade'] == 'm'){
    for($i=($manager-2); $i>=$oldest; $i--){
      $grades[] = $i;
    }
  }else{
    $sql = "SELECT DISTINCT grade FROM {$member_table} WHERE intro_view = true ORDER BY grade DESC";
    foreach($pdo->query($sql) as $grade){
      $grades[] = $grade['grade'];
    }
  }
}
