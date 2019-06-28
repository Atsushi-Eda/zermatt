<?php
require_once('../lib/library.php');
form_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>早稲田祭アンケート回答</title>
  <?= readCss("../../css/reset.css") ?>
  <?= readCss("../css/validationEngine.jquery.css") ?>
  <?= readCss("../css/for_members.css") ?>
  <?= readCss("../css/form.css") ?>
  <?= readCss("css/form.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../">TOP</a> > <a href="./">早稲田祭アンケートTOP</a> > アンケート回答
    </div>
    <?= flash_message() ?>
    <h2>早稲田祭アンケート回答</h2>
    <form id="form" method="post" action="form.php" autocomplete="off">
      <div class="form_content required">
        <p>商品名</p>
        <div class="radios">
<?php
foreach($menus as $key => $menu){
?>
          <label><input type="radio" name="menu" value="<?= h($key) ?>"><span><?= h($menu) ?></span></label>
<?php
}
?>
        </div>
      </div>
      <div class="form_content">
        <input type="submit" value="回答" class="submit_button">
      </div>
    </form>
    <div>
      <h3>概要</h3>
<?php
foreach($menus as $key => $menu){
?>
      <div style="padding:10px 0;">
        <p style="font-weight:bold;"><?= h($menu) ?></p>
        <p>テーマ:<?= h($menu_details[$key]) ?></p>
        <p>レシピ:<?= h($recipes[$key]) ?></p>
      </div>
<?php
}
?>
    </div>
  </div>
  <?= readJs("../../js/jquery-1.11.3.min.js") ?>
  <?= readJs("../js/jquery.validationEngine.js") ?>
  <?= readJs("../js/jquery.validationEngine-ja.js") ?>
  <?= readJs("../js/validation.js") ?>
</div>
</body>
</html>