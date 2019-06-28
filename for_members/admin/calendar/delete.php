<?php
require_once('../../lib/library.php');
$sql = "SELECT id FROM other_events WHERE id = :id";
$sth = $pdo->prepare($sql);
$sth->execute(array(':id'=>$_GET['id']));
$id = $sth->fetch(PDO::FETCH_ASSOC);
$_SESSION['flash_message'] = '日程の取り消しに失敗しました。';
if($id){
  $sql = "DELETE FROM other_events WHERE id = {$id['id']}";
  if($pdo->query($sql)){
    $_SESSION['flash_message'] = '日程を取り消しました。';
  }
}
header('Location: http://' . ROOT_DIR . '/for_members/admin/calendar/');
exit;