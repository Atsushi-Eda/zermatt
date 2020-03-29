<?php
require_once('../../../lib/library.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>サークル紹介管理</title>
  <?= readCss("../../../../css/reset.css") ?>
  <?= readCss("../../../css/validationEngine.jquery.css") ?>
  <?= readCss("../../../css/for_members.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../../">TOP</a> > <a href="../../">管理ページTOP</a> > <a href="../">トップページ管理</a> > サークル紹介管理
    </div>
    <?= flash_message() ?>
    <h2>サークル紹介管理</h2>
    <ul class="lists">
      <li><a href="text.php">紹介文変更</a></li>
      <li><a href="image.php">紹介写真変更</a></li>
      <li><a href="video.php">新歓ビデオ</a></li>
    </ul>
  </div>
</div>
</body>
</html>
