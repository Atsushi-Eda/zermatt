<?php
require_once('../../../lib/library.php');
video_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>新勧ビデオ変更</title>
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
      <a href="../../../">TOP</a> > <a href="../../">管理ページTOP</a> > <a href="../">トップページ管理</a> > <a href="./">サークル紹介管理</a> > 新勧ビデオ変更
    </div>
    <?= flash_message() ?>
    <h2>新勧ビデオ変更</h2>
    <form id="form" method="post" action="video.php" autocomplete="off">
      <div class="form_content required">
        <p>URL</p>
        <input type="text" name="url" value="<?= h($url) ?>">
      </div>
      <div class="form_content">
        <input type="submit" value="変更" class="submit_button">
      </div>
    </form>
  </div>
  <?= readJs("../../../../js/jquery-1.11.3.min.js") ?>
  <?= readJs("../../../js/jquery.validationEngine.js") ?>
  <?= readJs("../../../js/jquery.validationEngine-ja.js") ?>
  <?= readJs("../../../js/validation.js") ?>
</div>
</body>
</html>