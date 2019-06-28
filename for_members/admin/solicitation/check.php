<?php
require_once('../../../lib/lib_db.php');
$state = ($_POST['state'] == 'true') ? 1 : 0;
$sql = "UPDATE solicitation_guests SET attendance = :state WHERE id = :id";
$sth = $pdo->prepare($sql);
$data = $sth->execute(array(':state'=>$state, ':id'=>$_POST['id']));
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);