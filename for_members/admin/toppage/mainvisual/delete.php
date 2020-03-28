<?php
require_once('../../../lib/library.php');
if(deleteTable('mainvisuals', [
  'id' => $_GET['id'],
])){
  $_SESSION['flash_message'] = '画像を削除しました。';
}else{
  $_SESSION['flash_message'] = '削除に失敗しました。';
}
header('Location: http://' . ROOT_DIR . '/for_members/admin/toppage/mainvisual/');
exit;
