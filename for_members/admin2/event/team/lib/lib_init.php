<?php
require_once('../../lib/lib_init.php');
require_once('lib/lib_misc.php');
function index_init(){
  global $pdo, $teams, $team_members, $events, $event, $disagreement;
  $sql = "SELECT * FROM events WHERE sophomore = 1 AND questionnaire = 1 ORDER BY date DESC";
  $events = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  if(isset($_GET['event_id'])){
    $sql = "SELECT short_name FROM events WHERE sophomore = 1 AND id = {$_GET['event_id']}";
    $event = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    $sql = "SELECT member_id FROM event_participations WHERE participation = 1 AND event_id = {$_GET['event_id']} ORDER BY member_id ASC";
    $participants1 = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    $sql = "SELECT member_id FROM event_teams WHERE event_id = {$_GET['event_id']} ORDER BY member_id ASC";
    $participants2 = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    $disagreement = ($participants1 !== $participants2);
    $sql = "SELECT team FROM event_teams WHERE event_id = {$_GET['event_id']} ORDER BY team DESC";
    $team_tmp = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    $teams = $team_tmp['team'];
    $sql_grades = array(
      "m.grade = ".(MANAGER_GRADE + 1),
      "m.grade < ".(MANAGER_GRADE),
      "m.grade = ".(MANAGER_GRADE),
      "m.grade = ".(MANAGER_GRADE + 2),
    );
    foreach($sql_grades as $grade => $sql_grade){
      for($team=1; $team<=$teams; $team++){
        $sql = "SELECT m.id, m.name, m.gender, t.leader FROM event_participations AS p LEFT JOIN event_teams AS t ON p.event_id = t.event_id AND p.member_id = t.member_id JOIN members AS m ON p.member_id = m.id WHERE p.event_id = {$_GET['event_id']} AND p.participation = 1 AND t.team = {$team} AND {$sql_grade} ORDER BY t.leader DESC, m.grade ASC, m.gender DESC, m.order ASC";
        $team_members[$team][$grade] = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
      }
    }
  }
}
function edit_init(){
  global $pdo, $participants, $event, $teams, $past_events, $past_members, $count;
  if(!isset($_POST['event_id'])){
    if(!isset($_GET['event_id'])){
      $_SESSION['flash_message'] = 'エラーが発生しました。';
      header('Location: http://' . ROOT_DIR . '/for_members/admin2/event/team/');
      exit;
    }
    $sql = "SELECT name, date FROM events WHERE sophomore = 1 AND id = {$_GET['event_id']}";
    $event = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    $sql = "SELECT team FROM event_teams WHERE event_id = {$_GET['event_id']} ORDER BY team DESC";
    $team_tmp = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    $teams = $team_tmp['team'];
    $sql = "SELECT m.id, m.name, m.grade, m.gender FROM event_participations AS p LEFT JOIN event_teams AS t ON p.event_id = t.event_id AND p.member_id = t.member_id JOIN members AS m ON p.member_id = m.id WHERE p.event_id = {$_GET['event_id']} AND p.participation = 1 AND t.id IS NULL";
    $participants[0] = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    for($team=1; $team<=$teams; $team++){
      $sql = "SELECT m.id, m.name, m.grade, m.gender, t.leader FROM event_participations AS p LEFT JOIN event_teams AS t ON p.event_id = t.event_id AND p.member_id = t.member_id JOIN members AS m ON p.member_id = m.id WHERE p.event_id = {$_GET['event_id']} AND p.participation = 1 AND t.team = {$team}";
      $participants[$team] = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    $sql = "SELECT member_id FROM event_participations WHERE event_id = {$_GET['event_id']} ORDER BY member_id ASC";
    foreach($pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC) as $participant){
      $sql = "SELECT e.id, e.short_name, t.team FROM event_teams AS t JOIN events AS e ON t.event_id = e.id WHERE e.sophomore = 1 AND t.member_id = {$participant['member_id']} AND e.date < CAST('{$event['date']}' AS DATE) ORDER BY e.date DESC LIMIT 2";
      $past_events[$participant['member_id']] = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
      foreach($past_events[$participant['member_id']] as $past_event){
        $sql = "SELECT m.id, m.name FROM event_teams AS t JOIN members AS m ON t.member_id = m.id WHERE t.event_id = {$past_event['id']} AND team = {$past_event['team']} ORDER BY m.id ASC";
        $past_members[$participant['member_id']][$past_event['id']] = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
      }
    }
    $sql_grades = array(
      1,
      "m.grade = ".(MANAGER_GRADE + 1),
      "m.grade < ".(MANAGER_GRADE),
      "m.grade = ".(MANAGER_GRADE),
      "m.grade = ".(MANAGER_GRADE + 2),
    );
    $sql_genders = array(
      1,
      "m.gender = 'male'",
      "m.gender = 'female'",
    );
    foreach($sql_grades as $grade_key => $sql_grade){
      foreach($sql_genders as $gender_key => $sql_gender){
        $sql = "SELECT COUNT(p.id) AS cnt FROM event_participations AS p JOIN members AS m ON p.member_id = m.id WHERE p.event_id = {$_GET['event_id']} AND p.participation = 1 AND {$sql_grade} AND {$sql_gender}";
        $count[$grade_key][$gender_key] = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
      }
    }
  }else{
    $sql = "DELETE FROM event_teams WHERE event_id = :event_id";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':event_id'=>$_POST['event_id']));
    foreach($_POST['member'] as $member_id => $team){
      if($team != ''){
        if($team != ''){
          insertTable('event_teams', [
            'event_id' => $_POST['event_id'],
            'team' => $team,
            'leader' => $_POST['leader'][$member_id] ? 1 : 0,
            'member_id' => $member_id,
          ]);
        }
      }
    }
    $_SESSION['flash_message'] = '班分けを登録しました。';
    header('Location: http://' . ROOT_DIR . '/for_members/admin2/event/team/?event_id=' . $_POST['event_id']);
    exit;
  }
}
