<?php
require_once('../../../lib/lib_db.php');
require_once('../../../lib/lib_misc.php');
$state = ($_POST['state'] == 'true') ? 1 : 0;
$data = updateTable('solicitation_guests', [
  'attendance' => $state,
], [
  'id' => $_POST['id'],
]);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
