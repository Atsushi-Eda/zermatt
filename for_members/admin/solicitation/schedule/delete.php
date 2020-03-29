<?php
require_once('../../../lib/library.php');
if(updateTable('solicitation_schedules', [
  'deleted' => 1,
], [
  'id' => $_GET['id'],
])){
  $_SESSION['flash_message'] = 'コンパを削除しました。';
}else{
  $_SESSION['flash_message'] = '削除に失敗しました。';
}
header('Location: http://' . ROOT_DIR . '/for_members/admin/solicitation/schedule/');
exit;
