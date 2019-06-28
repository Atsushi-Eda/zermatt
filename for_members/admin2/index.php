<?php
require_once('../lib/library.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>2年用管理ページTOP</title>
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
      <a href="../">TOP</a> > 2年用管理ページTOP
    </div>
    <?= flash_message() ?>
    <h2>管理ページTOP</h2>
    <ul class="lists">
      <li><a href="event/">企画管理</a></li>
    </ul>
  </div>
</div>
</body>
</html>