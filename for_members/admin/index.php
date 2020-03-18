<?php
require_once('../lib/library.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>管理ページTOP</title>
  <?= readCss("../../css/reset.css") ?>
  <?= readCss("../css/for_members.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../">TOP</a> > 管理ページTOP
    </div>
    <?= flash_message() ?>
    <h2>管理ページTOP</h2>
    <ul class="lists">
      <li><a href="solicitation/">新歓コンパ管理</a></li>
      <li><a href="member/">メンバー管理</a></li>
      <li><a href="calendar/">カレンダー</a></li>
      <li><a href="timetable/">時間割</a></li>
      <li><a href="event/">企画管理</a></li>
      <li><a href="gallery/">ギャラリー管理</a></li>
      <!-- <li><a href="solicitation_camp/output.php">新歓合宿出欠(excel)</a></li> -->
      <!-- <li><a href="summer_camp/">夏合宿出欠</a></li> -->
      <li><a href="training/">トレ管理</a></li>
    </ul>
  </div>
</div>
</body>
</html>
