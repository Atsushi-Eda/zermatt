<?php
require_once('../../../lib/library.php');
if(updateTable('albums', [
  'view' => 0,
], [
  'id' => $_GET['id'],
])){
  $_SESSION['flash_message'] = 'アルバムを削除しました。';
}else{
  $_SESSION['flash_message'] = '削除に失敗しました。';
}
header('Location: http://' . ROOT_DIR . '/for_members/admin/gallery/album/');
exit;
