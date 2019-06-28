<?php
require_once('../../lib/library.php');
$sql = "UPDATE members SET view = false, intro_view = false WHERE id = {$_GET['id']}";
if($pdo->query($sql)){
  $_SESSION['flash_message'] = 'メンバーを削除しました。';
}else{
  $_SESSION['flash_message'] = '削除に失敗しました。';
}
header('Location: http://' . ROOT_DIR . '/for_members/admin/member/');
exit;