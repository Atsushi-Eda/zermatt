<?php
require_once('../../lib/library.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>ギャラリー管理</title>
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
      <a href="../../">TOP</a> > <a href="../">管理ページTOP</a> > ギャラリー管理
    </div>
    <?= flash_message() ?>
    <h2>ギャラリー管理</h2>
    <ul class="lists">
      <li><a href="album/">アルバム管理</a></li>
      <li><a href="aw_album/">AWアルバム管理</a></li>
      <li><a href="video/">ビデオ管理</a></li>

    </ul>
  </div>
</div>
</body>
</html>
