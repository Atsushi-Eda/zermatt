<?php
set_time_limit(300);
require_once('../../lib/library.php');
backup_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>メンバー情報バックアップ</title>
  <?= readCss("../../../css/reset.css") ?>
  <?= readCss("../../css/validationEngine.jquery.css") ?>
  <?= readCss("../../css/for_members.css") ?>
  <?= readCss("../../css/form.css") ?>
  <?= readCss("css/edit.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../">TOP</a> > <a href="../">管理ページTOP</a> > <a href="./">メンバー管理</a> > メンバー情報バックアップ
    </div>
    <?= flash_message() ?>
    <h2>メンバー情報バックアップ</h2>
    <form id="form" method="POST" action="backup.php" autocomplete="off">
      <h3>新規バックアップ</h3>
      <div class="form_content required">
        <p>~代版としてバックアップ</p>
        <input type="number" name="grade">代
      </div>
      <div class="form_content">
        <input type="submit" value="登録" class="submit_button">
      </div>
    </form>
    <div id="already">
      <h3>バックアップ済み</h3>
      <ul>
<?php
foreach($backups as $backup){
?>
        <li><a href="backup_check.php?grade=<?= h($backup) ?>"><?= h($backup) ?>代版</a></li>
<?php
}
?>
      </ul>
    </div>
  </div>
  <?= readJs("../../../js/jquery-1.11.3.min.js") ?>
  <?= readJs("../../js/jquery.validationEngine.js") ?>
  <?= readJs("../../js/jquery.validationEngine-ja.js") ?>
  <?= readJs("../../js/validation.js") ?>
  <?= readJs("js/edit.js") ?>
</body>
</html>
