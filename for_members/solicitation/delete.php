<?php
require_once('../lib/library.php');
$sql = "SELECT id FROM solicitation_guests WHERE id = :id AND member_id= :member_id";
$sth = $pdo->prepare($sql);
$sth->execute(array(':id'=>$_GET['id'], ':member_id'=>$_SESSION['user']['id']));
$id = $sth->fetch(PDO::FETCH_ASSOC);
$_SESSION['flash_message'] = '予約の取り消しに失敗しました。';
if($id){
  if(updateTable('solicitation_guests', [
    'deleted' => 1,
    'update_time' => null,
  ], [
    'id' => $id['id'],
  ])){
    $_SESSION['flash_message'] = '予約を取り消しました。';
  }
}
header('Location: http://' . ROOT_DIR . '/for_members/solicitation/');
exit;
