<?php
require_once('../../../lib/library.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>アンケート結果</title>
  <?= readCss("../../../../css/reset.css") ?>
  <?= readCss("../../../css/for_members.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../../">TOP</a> > <a href="../../">管理ページTOP</a> > <a href="../">企画管理</a> > アンケート結果
    </div>
    <?= flash_message() ?>
    <h2>アンケート結果</h2>
    <ul class="lists">
      <li><a href="view.php">詳細表示</a></li>
      <li><a href="handson.php">詳細表示(エクセル風)</a></li>
      <li><a href="count.php">参加者数</a></li>
    </ul>
  </div>
</div>
</body>
</html>
