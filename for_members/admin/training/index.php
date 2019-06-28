<?php
require_once('../../lib/library.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>トレ管理</title>
  <?= readCss("../../../css/reset.css") ?>
  <?= readCss("../../css/for_members.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../">TOP</a> > <a href="../">管理ページTOP</a> > トレ管理
    </div>
    <?= flash_message() ?>
    <h2>トレ管理</h2>
    <ul class="lists">
      <li><a href="edit.php">トレ出欠登録</a></li>
      <li><a href="view.php">トレ出欠確認</a></li>
    </ul>
  </div>
</div>
</body>
</html>