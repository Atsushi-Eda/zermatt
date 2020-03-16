<?php
require_once('../../lib/library.php');
if(updateTable('members', [
  'view' => 0,
  'intro_view' => 0,
], [
  'id' => $_GET['id'],
])){
  $_SESSION['flash_message'] = 'メンバーを削除しました。';
}else{
  $_SESSION['flash_message'] = '削除に失敗しました。';
}
header('Location: http://' . ROOT_DIR . '/for_members/admin/member/');
exit;
