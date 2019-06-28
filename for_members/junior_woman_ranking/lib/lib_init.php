<?php
$candidate_grade = 45;
$sql = "SELECT id, name FROM members WHERE grade = " . $candidate_grade . " AND gender = 'female'";
$candidate_tmps = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
foreach($candidate_tmps as $candidate_tmp){
  $candidates[$candidate_tmp['id']] = $candidate_tmp['name'];
}
$count = count($candidates);
function index_init(){
  global $pdo, $ranks;
  $sql = "SELECT * FROM junior_woman_ranking WHERE voter = {$_SESSION['user']['id']} ORDER BY rank ASC";
  $ranks = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
function form_init(){
  global $pdo, $candidates, $ranks;
  foreach($candidates as $candidate_key => $candidate){
    $sql = "SELECT * FROM junior_woman_ranking WHERE voter = {$_SESSION['user']['id']} AND candidate = {$candidate_key}";
    $ranks[$candidate_key] = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  }
  if(!empty($_POST)){
    $sql = "DELETE FROM junior_woman_ranking WHERE voter = {$_SESSION['user']['id']}";
    $sth = $pdo->prepare($sql);
    $sth->execute();
    $sql = "INSERT INTO junior_woman_ranking (voter, candidate, rank, good, bad) VALUES ({$_SESSION['user']['id']}, :candidate, :rank, :good, :bad)";
    foreach($candidates as $candidate_key => $candidate){
      $sth = $pdo->prepare($sql);
      $sth->execute(array(':candidate'=>$candidate_key, ':rank'=>$_POST[$candidate_key]['rank'], ':good'=>$_POST[$candidate_key]['good'], ':bad'=>$_POST[$candidate_key]['bad']));
    }
    $_SESSION['flash_message'] = "回答しました。";
    header('Location: http://' . ROOT_DIR . '/for_members/junior_woman_ranking/');
    exit;
  }
}
function view_init(){
  global $pdo, $candidates, $ranks, $points, $count, $average, $deviation, $vote, $candidate_grade;
  $sql = "SELECT id, name FROM members WHERE grade = " . $candidate_grade . " AND gender = 'female'";
  $candidate_tmps = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  foreach($candidate_tmps as $candidate_tmp){
    $candidates[$candidate_tmp['id']] = $candidate_tmp['name'];
  }
  if(isset($_GET['grade'])){
    $sql_grade = "(0";
    foreach($_GET['grade'] as $grade){
      $sql_grade .= " OR m.grade = {$grade}";
    }
    $sql_grade .= ")";
  }else{
    $sql_grade = "1";
  }
  $sql = "SELECT COUNT(r.id) AS cnt FROM junior_woman_ranking AS r JOIN members AS m ON r.voter = m.id WHERE {$sql_grade}";
  $vote = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  foreach($candidates as $candidate_key => $candidate){
    for($rank=1; $rank<=$count; $rank++){
      $sql = "SELECT COUNT(r.id) AS cnt FROM junior_woman_ranking AS r JOIN members AS m ON r.voter = m.id WHERE r.candidate = {$candidate_key} AND r.rank = {$rank} AND {$sql_grade}";
      $ranks[$candidate_key][$rank] = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
  }
  foreach($candidates as $candidate_key => $candidate){
    $points[$candidate_key] = 0;
    for($rank=1; $rank<=$count; $rank++){
      $points[$candidate_key] += (($count - $rank) * $ranks[$candidate_key][$rank]['cnt']);
    }
  }
  arsort($points);
  $sum = 0;
  foreach($points as $member_id => $point){
     $sum += $point;
  }
  $average = $sum / $count;
  $standardDeviation = 0;
  foreach($points as $member_id => $point){
    $standardDeviation += (($point - $average) * ($point - $average)) ;
  }
  $standardDeviation = sqrt($standardDeviation / $count);
  foreach($points as $member_id => $point){
     $deviation[$member_id] = 50 + ($point - $average) / $standardDeviation *10;
  }
}
function detail_init(){
  global $pdo, $reasons, $candidates, $candidate;
  $candidate = $candidates[$_GET['candidate']];
  $sql = "SELECT * FROM junior_woman_ranking WHERE candidate = {$_GET['candidate']}";
  $reasons = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}