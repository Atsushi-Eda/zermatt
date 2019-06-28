<?php
require_once('../../lib/library.php');
edit_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>夏合宿出欠変更</title>
  <?= readCss("../../../css/reset.css") ?>
  <?= readCss("../../css/validationEngine.jquery.css") ?>
  <?= readCss("../../css/for_members.css") ?>
  <?= readCss("../../css/form.css") ?>
  <?= readCss("css/form.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../">TOP</a> > <a href="../">管理ページTOP</a> > <a href="./">夏合宿参加者管理</a> > 出欠変更
    </div>
    <?= flash_message() ?>
    <h2>夏合宿出欠変更</h2>
    <form id="form" method="POST" action="edit.php" autocomplete="off">
      <h3><?= h($member['name']) ?></h3>
      <input type="hidden" name="member_id" value="<?= $_GET['member_id'] ?>">
<?php
include (!isset($participation['id'])) ? 'inc/edit_content1.php' : 'inc/edit_content2.php';
?>
      <div class="form_content">
        <input type="submit" value="回答" class="submit_button">
      </div>
    </form>
  </div>
  <?= readJs("../../../js/jquery-1.11.3.min.js") ?>
  <?= readJs("../../js/jquery.validationEngine.js") ?>
  <?= readJs("../../js/jquery.validationEngine-ja.js") ?>
  <?= readJs("../../js/validation.js") ?>
  <?= readJs("js/form.js") ?>
</body>
</html>