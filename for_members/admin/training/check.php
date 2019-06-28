<?php
require_once('../../../lib/lib_db.php');
if($_POST['state'] == 'true'){
  $sql = "INSERT INTO training_participations (date ,member_id) VALUES (:date, :member_id)";
}else{
  $sql = "DELETE FROM training_participations WHERE date = :date AND member_id = :member_id";
}
$sth = $pdo->prepare($sql);
$data = $sth->execute(array(':date'=>$_POST['date'], ':member_id'=>$_POST['id']));
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);