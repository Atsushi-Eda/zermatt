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
  <title>AWアルバム登録</title>
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
      <a href="../../../">TOP</a> > <a href="../../">管理ページTOP</a> > <a href="../">ギャラリー管理</a> > <a href="./">AWアルバム管理</a> > AWアルバム登録
    </div>
    <?= flash_message() ?>
    <h2>AWアルバム登録</h2>
    <form id="form" method="POST" action="edit.php" autocomplete="off" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= h($album['id']) ?>">
      <div class="form_content required">
        <p>名前</p>
        <input type="text" name="name" value="<?= h($album['name']) ?>">
      </div>
      <div class="form_content required">
        <p>URL</p>
        <input type="text" name="url" value="<?= h($album['url']) ?>">
      </div>
      <div class="form_content required">
        <p>代</p>
        <input type="number" name="grade" value="<?= $album['grade'] ? h($album['grade']) : (MANAGER_GRADE-1) ?>">代AW大会
      </div>
      <div class="form_content">
        <p>画像</p>
        <div id="upload_image_wrapper">
<?php
$dir = "../../../../img/aw_gallery/" . $album['id'] . "/";
if($album['id'] && file_exists($dir)){
  foreach(scandir($dir) as $file){
    if($file=="." || $file==".."){
      continue;
    }
?>
            <?= readImg($dir.$file, 'upload_image') ?>
<?php
  }
}
?>
        </div>
        <label class="button"><input type="file" name="imgs[]" id="upload_image_button" accept="image/*" multiple>ファイルを選択</label>
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
