<?php
require_once('../lib/lib_init.php');
function edit_init(){
  global $pdo, $date, $grades, $members, $participations;
  $date = isset($_GET['date']) ? $_GET['date'] : date("Y-m-d");
  $sql = "SELECT grade FROM members WHERE view = 1 AND grade != " . MANAGER_GRADE . " GROUP BY grade";
  $grade_tmps = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  foreach($grade_tmps as $grade_tmp){
    $grades[] = $grade_tmp['grade'];
  }
  foreach($grades as $grade){
    $sql = "SELECT id, name FROM members WHERE grade = {$grade} AND view = 1 ORDER BY `order` ASC, phonetic ASC";
    $members[$grade] = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  }
  $sql = "SELECT member_id FROM training_participations WHERE date = '" . $date ."'";
  $participation_tmps = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  foreach($participation_tmps as $participation_tmp){
    $participations[$participation_tmp['member_id']] = true;
  }
}
function view_init(){
  global $pdo, $filter_date, $dates, $members, $participations;
  $filter_date = isset($_GET['date']) ? $_GET['date'] : date("Y-m-d");
  $sql = "SELECT id, name FROM members WHERE view = 1 AND grade != " . MANAGER_GRADE . " ORDER BY grade ASC, `order` ASC, phonetic ASC";
  $members = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  $sql_date = isset($_GET['date']) ? "date >= '".$_GET['date']."'" : 1;
  $sql = "SELECT DISTINCT date FROM training_participations WHERE $sql_date ORDER BY date";
  $dates = array_map(function($date){
    return $date['date'];
  }, $date_tmps = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC));
  foreach($dates as $date){
    $sql = "SELECT member_id FROM training_participations WHERE date = '" . $date ."'";
    $participation_tmps = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    foreach($participation_tmps as $participation_tmp){
      $participations[$participation_tmp['member_id']][$date] = true;
    }
  }
}
