<?php
function menu_init(){
  global $pdo, $menu_grades;
  $grades = array_reduce(
    $pdo->query("SELECT * FROM grades WHERE view = 1 ORDER BY grade ASC")->fetchAll(PDO::FETCH_ASSOC),
    function($grades, $grade){
      $grades[$grade['grade']] = $grade;
      return $grades;
    },
    []
  );
  $menu_grades[] = [
    'label' => ordSuffix(MANAGER_GRADE).'(3年生幹部)',
    'image' => MANAGER_GRADE.'.'.$grades[MANAGER_GRADE]['image_extension'],
    'tag' => 'b3',
  ];
  if(in_array(MANAGER_GRADE+2, array_keys($grades))){
    $menu_grades[] = [
      'label' => ordSuffix(MANAGER_GRADE+2).'(1年生)',
      'image' => (MANAGER_GRADE+2).'.'.$grades[MANAGER_GRADE+2]['image_extension'],
      'tag' => 'b1',
    ];
  }
  $menu_grades[] = [
    'label' => ordSuffix(MANAGER_GRADE+1).'(2年生)',
    'image' => (MANAGER_GRADE+1).'.'.$grades[MANAGER_GRADE+1]['image_extension'],
    'tag' => 'b2',
  ];
  $menu_grades[] = [
    'label' => ordSuffix(MANAGER_GRADE-1).'(4年生)',
    'image' => (MANAGER_GRADE-1).'.'.$grades[MANAGER_GRADE-1]['image_extension'],
    'tag' => 'b4',
  ];
  $menu_grades[] = [
    'label' => ordSuffix(array_keys($grades)[0]).'~'.ordSuffix(MANAGER_GRADE-2).'(上級生)',
    'image' => (MANAGER_GRADE-2).'.'.$grades[MANAGER_GRADE-2]['image_extension'],
    'tag' => 'm',
  ];
}
function login_init(){
  global $pdo;
  if(isset($_POST['password'])){
    if($_POST['password']==$pdo->query('SELECT password FROM password ORDER BY id DESC LIMIT 1')->fetch(PDO::FETCH_ASSOC)['password']){
      if($_POST['auto_login']){
        $token = sha1(uniqid(mt_rand(), true));
        insertTable('auto_login2', [
          'token' => $token,
        ]);
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
function index_init(){
  global $pdo, $mainvisuals, $snss, $circle_introduction, $solicitation_video, $link_categories, $links;
  $mainvisuals = array_map(function($mainvisual){
    return $mainvisual['id'].'.'.$mainvisual['extension'];
  }, $pdo->query("SELECT * FROM mainvisuals WHERE view = 1 ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC));
  $snss = $pdo->query("SELECT * FROM snss WHERE view = 1")->fetchAll(PDO::FETCH_ASSOC);
  $circle_introduction = $pdo->query('SELECT text FROM circle_introduction ORDER BY id DESC LIMIT 1')->fetch(PDO::FETCH_ASSOC)['text'];
  $solicitation_video = $pdo->query('SELECT url FROM solicitation_video ORDER BY id DESC LIMIT 1')->fetch(PDO::FETCH_ASSOC)['url'];
  $link_categories = array_map(function($link_category_tmp){
    return $link_category_tmp['category'];
  }, $pdo->query("SELECT DISTINCT category FROM links WHERE view = 1")->fetchAll(PDO::FETCH_ASSOC));
  $links = array_reduce($link_categories, function($links, $link_category) use ($pdo) {
    $links[$link_category] = $pdo->query("SELECT * FROM links WHERE view = 1 AND category = '".$link_category."'")->fetchAll(PDO::FETCH_ASSOC);
    return $links;
  }, []);
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
  $sql = "SELECT nickname, birthday FROM members WHERE birthmonth = {$m} AND view = 1";
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
  $member_table = "members_" . (isset($_GET['ver']) ? $_GET['ver'] : '');
  $member_image = "member_" . (isset($_GET['ver']) ? $_GET['ver'] : '');
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
    $sql = "SELECT DISTINCT grade FROM {$member_table} WHERE intro_view = 1 ORDER BY grade DESC";
    foreach($pdo->query($sql) as $grade){
      $grades[] = $grade['grade'];
    }
  }
}
