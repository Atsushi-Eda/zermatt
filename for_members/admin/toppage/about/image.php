<?php
require_once('../../../lib/library.php');
image_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>紹介写真変更</title>
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
      <a href="../../../">TOP</a> > <a href="../../">管理ページTOP</a> > <a href="../">トップページ管理</a> > <a href="./">サークル紹介管理</a> > 紹介写真変更
    </div>
    <?= flash_message() ?>
    <h2>紹介写真変更</h2>
    <form id="form" method="POST" action="image.php" autocomplete="off" enctype="multipart/form-data">
      <div class="form_content">
        <p>画像</p>
        <div id="upload_image_wrapper">
<?php
foreach(scandir($dir) as $file){
  if($file=="." || $file==".."){
    continue;
  }
?>
          <?= readImg($dir.$file, 'upload_image') ?>
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
