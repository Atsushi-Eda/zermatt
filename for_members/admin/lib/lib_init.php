<?php
if($_SESSION['user']['grade'] != MANAGER_GRADE){
  $_SESSION['flash_message'] = 'アクセス権限がありません。';
  header('Location: http://' . ROOT_DIR . '/for_members/');
  exit;
}