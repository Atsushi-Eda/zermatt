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
  <title>メインビジュアル画像登録</title>
  <?= readCss("../../../../css/reset.css") ?>
  <?= readCss("../../../css/validationEngine.jquery.css") ?>
  <?= readCss("../../../css/for_members.css") ?>
  <?= readCss("../../../css/form.css") ?>
  <?= readCss("../../../css/upload_image.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../../">TOP</a> > <a href="../../">管理ページTOP</a> > <a href="../">トップページ管理</a> > <a href="./">メインビジュアル管理</a> > メインビジュアル画像登録
    </div>
    <?= flash_message() ?>
    <h2>メインビジュアル画像登録</h2>
    <form id="form" method="POST" action="edit.php" autocomplete="off" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= h($mainvisual['id']) ?>">
      <div class="form_content required">
        <p>表示</p>
        <div class="radios">
          <label><input type="radio" name="view" value="1" <?= $mainvisual['view'] ? 'checked' : '' ?>><span>表示</span></label>
          <label><input type="radio" name="view" value="0" <?= !$mainvisual['view'] ? 'checked' : '' ?>><span>非表示</span></label>
        </div>
      </div>
      <div class="form_content">
        <p>画像</p>
        <div id="upload_image_wrapper">
<?php
$file = "../../../../img/mv/" . $mainvisual['id'] . "." . $mainvisual['extension'];
if($mainvisual['id'] && file_exists($file)){
?>
          <?= readImg($file, 'upload_image') ?>
<?php
}
?>
        </div>
        <label class="button"><input type="file" name="img" id="upload_image_button" accept="image/*">ファイルを選択</label>
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
  <?= readJs("../../../js/upload_image.js") ?>
</body>
</html>
