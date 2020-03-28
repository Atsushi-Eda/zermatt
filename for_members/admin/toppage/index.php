<?php
require_once('../../lib/library.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>トップページ管理</title>
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
      <a href="../../">TOP</a> > <a href="../">管理ページTOP</a> > トップページ管理
    </div>
    <?= flash_message() ?>
    <h2>トップページ管理</h2>
    <ul class="lists">
      <li><a href="password/">パスワード変更</a></li>
      <li><a href="mainvisual/">メインビジュアル管理</a></li>
      <li><a href="sns/">SNSウィジット管理</a></li>
      <li><a href="about/">サークル紹介管理</a></li>
      <li><a href="grade/">代管理</a></li>
      <li><a href="link/">リンク管理</a></li>
    </ul>
  </div>
</div>
</body>
</html>
