<?php
require_once('../../lib/lib_db.php');
$term = $_POST['search'];
$sql = "SELECT name FROM members WHERE phonetic LIKE BINARY '$term%' ORDER BY phonetic";
foreach ($pdo->query($sql) as $value) {
  $data[] = $value['name'];
}
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);