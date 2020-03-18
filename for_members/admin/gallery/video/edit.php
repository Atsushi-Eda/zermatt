<?php
require_once('../../../lib/library.php');
edit_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>ビデオ登録</title>
  <?= readCss("../../../../css/reset.css") ?>
  <?= readCss("../../../css/validationEngine.jquery.css") ?>
  <?= readCss("../../../css/for_members.css") ?>
  <?= readCss("../../../css/form.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../../">TOP</a> > <a href="../../">管理ページTOP</a> > <a href="../">ギャラリー管理</a> > <a href="./">ビデオ管理</a> > ビデオ登録
    </div>
    <?= flash_message() ?>
    <h2>ビデオ登録</h2>
    <form id="form" method="POST" action="edit.php" autocomplete="off" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= h($video['id']) ?>">
      <div class="form_content required">
        <p>名前</p>
        <input type="text" name="name" value="<?= h($video['name']) ?>">
      </div>
      <div class="form_content required">
        <p>URL</p>
        <input type="text" name="url" value="<?= h($video['url']) ?>">
      </div>
      <div class="form_content">
        <input type="submit" value="登録" class="submit_button">
      </div>
    </form>
  </div>
  <?= readJs("../../../../js/jquery-1.11.3.min.js") ?>
  <?= readJs("../../../js/jquery.validationEngine.js") ?>
  <?= readJs("../../../js/jquery.validationEngine-ja.js") ?>
  <?= readJs("../../../js/validation.js") ?>
</body>
</html>
