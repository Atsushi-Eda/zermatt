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
  <title>新歓合宿出欠アンケートTOP</title>
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
      <a href="../">TOP</a> > 新歓合宿出欠アンケートTOP
    </div>
    <?= flash_message() ?>
    <h2>新歓合宿出欠アンケートTOP</h2>
    <div class="box">
<?php
if(!isset($data['id'])){
?>
      <p>回答されてません。</p>
<?php
  if(time()>strtotime($form_opening_period['from']) && time()<strtotime($form_opening_period['to'])){
?>
      <p><a href="form.php">>>新歓合宿出欠アンケート回答</a></p>
<?php
  }
?>
<?php
}else{
?>
      <ul class="lists">
        <li>
          <span>出欠:</span>
          <span><?= h($participation[$data['participation']]) ?></span>
        </li>
<?php
  if($_SESSION['user']['grade'] ==  (MANAGER_GRADE + 2)){
?>
        <li>
          <span>スキーレベル:</span><br>
          <p><?= h($experience[$data['experience']]) ?></p>
        </li>
        <li>
          <span>ウェア:</span>
          <span><?= ($data['wear']) ? '持っている' : '持っていない' ?></span>
        </li>
        <li>
          <span>ゴーグル:</span>
          <span><?= ($data['goggles']) ? '持っている' : '持っていない' ?></span>
        </li>
        <li>
          <span>ニット帽:</span>
          <span><?= ($data['knit']) ? '持っている' : '持っていない' ?></span>
        </li>
        <li>
          <span>グローブ:</span>
          <span><?= ($data['gloves']) ? '持っている' : '持っていない' ?></span>
        </li>
<?php
  }
  if(!empty($data['note'])){
?>
        <li>
          <span>備考:</span>
          <p><?= h($data['note']) ?></p>
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