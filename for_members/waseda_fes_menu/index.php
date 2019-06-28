<?php
require_once('../lib/library.php');
index_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>早稲田祭アンケートTOP</title>
  <?= readCss("../../css/reset.css") ?>
  <?= readCss("../css/for_members.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../">TOP</a> > 早稲田祭アンケートTOP
    </div>
    <?= flash_message() ?>
    <h2>早稲田祭アンケートTOP</h2>
    <div class="box">
<?php
if(!isset($data['id'])){
?>
      <div class="edit_button">
        <a href="form.php">回答</a>
      </div>
<?php
}else{
?>
      <ul class="lists">
        <li>
          <span>商品名:</span>
          <p><?= h($menus[$data['menu']]) ?></p>
        </li>
      <div class="edit_button">
        <a href="form.php">変更</a>
      </div>
<?php
}
?>
    </div>
  </div>
</div>
</body>
</html>