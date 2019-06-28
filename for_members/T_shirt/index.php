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
  <title><?= T_shirts_type ?>TシャツアンケートTOP</title>
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
      <a href="../">TOP</a> > <?= T_shirts_type ?>TシャツアンケートTOP
    </div>
    <?= flash_message() ?>
    <h2><?= T_shirts_type ?>TシャツアンケートTOP</h2>
    <div class="box">
<?php
if(!isset($data['id'])){
?>
      <p>回答されてません。</p>
<?php
  if(time()>strtotime($form_opening_period['from']) && time()<strtotime($form_opening_period['to'])){
?>
      <p><a href="form.php">>><?= T_shirts_type ?>Tシャツアンケート回答</a></p>
<?php
  }
?>
<?php
}else{
?>
      <ul class="lists">
        <li>
          <span>購入:</span>
          <span><?= h($data['buy'] ? '買う' : '買わない') ?></span>
        </li>
<?php
  if($data['buy'] == 1){
?>
        <li>
          <span>サイズ:</span>
          <span><?= h($sizes[$data['size']]) ?></span>
        </li>
<?php
  }
?>
      </ul>
<?php
  if(time()>strtotime($form_opening_period['from']) && time()<strtotime($form_opening_period['to'])){
?>
      <div class="edit_button">
        <a href="edit.php">変更</a>
      </div>
<?php
  }else{
?>
      <p>出欠を変更する場合は、お近くの3年生までご連絡お願いします。</p>
<?php
  }
?>
<?php
}
?>
    </div>
  </div>
</div>
</body>
</html>