<?php
require_once('../lib/lib_init.php');
function index_init(){
  global $pdo, $timetables, $total, $grades;
  $sql = "SELECT grade FROM members GROUP BY grade";
  $grades = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  $sql_grade = (isset($_GET['grade'])) ? 'm.grade = ' . $_GET['grade'] : 1;
  $sql = "SELECT t.member_id FROM timetables AS t JOIN members AS m ON t.member_id = m.id WHERE {$sql_grade} GROUP BY t.member_id";
  $total_tmp = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  $total = count($total_tmp);
  for($time=1; $time<=36; $time++){
    $sql = "SELECT count(t.id) AS cnt FROM timetables AS t JOIN members AS m ON t.member_id = m.id WHERE {$sql_grade} AND t.time = {$time}";
    $timetables[$time] = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  }
}