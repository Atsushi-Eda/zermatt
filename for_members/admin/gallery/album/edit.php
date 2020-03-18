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
  <title>アルバム登録</title>
  <?= readCss("../../../../css/reset.css") ?>
  <?= readCss("../../../css/validationEngine.jquery.css") ?>
  <?= readCss("../../../css/for_members.css") ?>
  <?= readCss("../../../css/form.css") ?>
  <?= readCss("css/edit.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../../">TOP</a> > <a href="../../">管理ページTOP</a> > <a href="../">ギャラリー管理</a> > <a href="./">アルバム管理</a> > アルバム登録
    </div>
    <?= flash_message() ?>
    <h2>アルバム登録</h2>
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
      <div class="form_content">
        <p>画像</p>
        <div id="album_imgs">
<?php
$dir = "../../../../img/gallery/" . $album['id'] . "/";
if($album['id'] && file_exists($dir)){
  foreach(scandir($dir) as $file){
    if($file=="." || $file==".."){
      continue;
    }
?>
            <div class="album_img"><?= readImg($dir . $file) ?></div>
<?php
  }
}
?>
        </div>
        <label class="button"><input type="file" name="imgs[]" id="img_button" accept="image/*" multiple>ファイルを選択</label>
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
  <?= readJs("js/edit.js") ?>
</body>
</html>
