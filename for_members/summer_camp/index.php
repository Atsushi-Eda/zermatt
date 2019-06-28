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
  <title>夏合宿出欠アンケートTOP</title>
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
      <a href="../">TOP</a> > 夏合宿出欠アンケートTOP
    </div>
    <?= flash_message() ?>
    <h2>夏合宿出欠アンケートTOP</h2>
    <div class="box">
<?php
if(!isset($data['id'])){
?>
      <p>回答されてません。</p>
<?php
  if(time()>strtotime($form_opening_period['from']) && time()<strtotime($form_opening_period['to'])){
?>
      <p><a href="form.php">>>夏合宿出欠アンケート回答</a></p>
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
  if($data['participation'] == 1){
    if($_SESSION['user']['grade'] != (MANAGER_GRADE + 2)){
?>
        <li>
          <span>自家車:</span>
          <span><?= ($data['private_car']) ? $data['private_car'].'人乗り' : '出せない' ?></span>
        </li>
<?php
      if(!$data['private_car']){
?>
        <li>
          <span>レンタカー:</span>
          <span><?= ($data['car_rental']) ? '出せる' : '出せない' ?></span>
        </li>
<?php
      }
    }
?>
        <li>
          <span>テニスラケット:</span>
          <span><?= h($data['racket']) ?>本</span>
        </li>
        <li>
          <span>テニスボール:</span>
          <span><?= h($data['ball']) ?>個</span>
        </li>
<?php
  }
  if($data['participation'] == 2){
?>
        <li>
          <span>参加可能日:</span>
          <span><?= $data['date'] ?></span>
        </li>
<?php
  }
  if(!empty($data['note'])){
?>
        <li>
<?php
    if($data['participation'] == 3){
?>
          <span>不参加理由:</span>
<?php
    }else if($data['participation'] == 4){
?>
          <span>未定理由:</span>
<?php
    }else{
?>
          <span>備考:</span>
<?php
    }
?>
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