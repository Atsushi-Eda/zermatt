<?php
require_once('../lib/lib_init.php');
$buy = array(
  NULL => "未回答",
  0 => "×",
  1 => "○",
);
$sizes = array(
  "S",
  "M",
  "L",
  "XL",
  "XXL",
);
function index_init(){
  global $pdo, $members, $count, $sizes;
  $sql = "SELECT m.name, t.buy, t.size FROM members AS m LEFT JOIN T_shirts AS t ON m.id = t.member_id WHERE m.view = 1 ORDER BY m.grade ASC, m.id ASC";
  $members = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  $sql = "SELECT count(id) AS cnt FROM members WHERE view = 1";
  $count["all"] = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  $sql = "SELECT count(id) AS cnt FROM T_shirts";
  $count["answer"] = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  $sql = "SELECT count(id) AS cnt FROM T_shirts WHERE buy = 1";
  $count["buy"]["all"] = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  foreach($sizes as $index => $size){
    $sql = "SELECT count(id) AS cnt FROM T_shirts WHERE buy = 1 AND size = {$index}";
    $count["buy"][$size] = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  }
}