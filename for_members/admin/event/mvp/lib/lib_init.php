<?php
require_once('../../lib/lib_init.php');
function index_init(){
  global $pdo, $counts, $max;
  $sql = "SELECT count(p.id) AS cnt, m.name FROM event_participations AS p JOIN members AS m ON p.member_id = m.id JOIN events AS e ON p.event_id = e.id WHERE p.participation = 1 AND e.date >= '{$_GET["date"]}' AND m.grade != " . MANAGER_GRADE . " GROUP BY m.id ORDER BY cnt DESC";
  $counts = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  $sql = "SELECT count(id) AS cnt FROM events WHERE questionnaire = 1 AND date >= '{$_GET["date"]}'";
  $max = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}