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
  <title>新勧コンパ登録</title>
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
      <a href="../../../">TOP</a> > <a href="../../">管理ページTOP</a> > <a href="../">新勧コンパ管理</a> > <a href="./">新勧コンパスケジュール管理</a> > 新勧コンパ登録
    </div>
    <?= flash_message() ?>
    <h2>新勧コンパ登録</h2>
    <form id="form" method="POST" action="edit.php" autocomplete="off" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= h($schedule['id']) ?>">
      <div class="form_content required">
        <p>日付</p>
        <input type="date" name="date" value="<?= h($schedule['date']) ?>">
      </div>
      <div class="form_content required">
        <p>時間</p>
        <input type="time" name="time" value="<?= h($schedule['time']) ?>">
      </div>
      <div class="form_content required">
        <p>AMPM</p>
        <div class="radios">
          <label><input type="radio" name="AMPM" value="AM" <?= $schedule['AMPM'] === 'AM' ? 'checked' : '' ?>><span>AM</span></label>
          <label><input type="radio" name="AMPM" value="PM" <?= $schedule['AMPM'] === 'PM' ? 'checked' : '' ?>><span>PM</span></label>
        </div>
      </div>
      <div class="form_content required">
        <p>場所</p>
        <input type="text" name="place" value="<?= h($schedule['place']) ?>">
      </div>
      <div class="form_content required">
        <p>食べ物</p>
        <input type="text" name="place_category" value="<?= h($schedule['place_category']) ?>">
      </div>
      <div class="form_content required">
        <p>値段</p>
        <input type="number" name="price" value="<?= h($schedule['price']) ?>">円
      </div>
      <div class="form_content required">
        <p>集合場所選択肢(半角カンマ「,」区切り)</p>
        <input type="text" name="meeting_place" value="<?= h($schedule['meeting_place']) ?>">
      </div>
      <div class="form_content required">
        <p>集合時間</p>
        <input type="time" name="meeting_time" value="<?= h($schedule['meeting_time']) ?>">
      </div>
      <div class="form_content required">
        <p>男性</p>
        <input type="number" name="male" value="<?= h($schedule['male']) ?>">人
      </div>
      <div class="form_content required">
        <p>女性</p>
        <input type="number" name="female" value="<?= h($schedule['female']) ?>">人
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
</body>
</html>
