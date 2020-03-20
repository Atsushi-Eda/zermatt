<?php
require_once('lib/library.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>メンバー用ページTOP</title>
  <?= readCss("../css/reset.css") ?>
  <?= readCss("css/for_members.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      TOP
    </div>
    <?= flash_message() ?>
    <h2>メンバー用ページTOP</h2>
    <ul class="lists">
      <li><a href="solicitation/">新歓予約</a></li>
      <li><a href="timetable.php">時間割</a></li>
      <li><a href="event/">企画アンケート</a></li>
      <!-- <li><a href="solicitation_camp/">新歓合宿出欠</a></li> -->
      <!-- <li><a href="summer_camp/">夏合宿出欠</a></li> -->
      <!-- <li><a href="waseda_fes_menu/">早稲田祭アンケート</a></li> -->
<?php
if($_SESSION['user']['grade'] == MANAGER_GRADE){
  ?>
      <li><a href="admin/">管理ページ</a></li>
<?php
}
if($_SESSION['user']['grade'] == (MANAGER_GRADE + 1)){
  ?>
      <li><a href="admin2/">2年用管理ページ</a></li>
<?php
}
?>
      <li><a href="change_password.php">パスワードの変更</a></li>
    </ul>
  </div>
</div>
</body>
</html>
