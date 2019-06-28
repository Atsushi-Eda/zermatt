<?php
require_once('../../lib/library.php');
add_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>カレンダー日程追加</title>
  <?= readCss("../../../css/reset.css") ?>
  <?= readCss("../../css/validationEngine.jquery.css") ?>
  <?= readCss("../../css/for_members.css") ?>
  <?= readCss("../../css/form.css") ?>
  <?= readCss("css/form.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../">TOP</a> > <a href="../">管理ページTOP</a> > <a href="./">カレンダー</a> > 追加
    </div>
    <?= flash_message() ?>
    <h2>カレンダー日程追加</h2>
    <form id="form" method="POST" action="add.php" autocomplete="off">
      <div class="form_content required">
        <p>タイトル</p>
        <input type="text" name="name">
      </div>
      <div class="form_content required">
        <p>日付</p>
        <input type="date" name="date">
      </div>
      <div class="form_content required">
        <p>期間</p>
        <input type="number" name="duration" value="1">日
      </div>
      <div class="form_content">
        <p>時間</p>
        <input type="time" name="start_time">~<input type="time" name="end_time">
      </div>
      <div class="form_content required">
        <p>公開範囲</p>
        <div class="radios">
          <label><input type="radio" name="view" value="1"><span>自分のみ</span></label>
          <label><input type="radio" name="view" value="2"><span>幹部のみ</span></label>
          <label><input type="radio" name="view" value="3"><span>全体</span></label>
        </div>
      </div>
      <div class="form_content">
        <input type="submit" value="登録" class="submit_button">
      </div>
    </form>
  </div>
</div>
<?= readJs("../../../js/jquery-1.11.3.min.js") ?>
<?= readJs("../../js/jquery.validationEngine.js") ?>
<?= readJs("../../js/jquery.validationEngine-ja.js") ?>
<?= readJs("../../js/validation.js") ?>
</body>
</html>