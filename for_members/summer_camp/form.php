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
  <title>夏合宿出欠アンケート回答</title>
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
      <a href="../">TOP</a> > <a href="./">夏合宿出欠アンケートTOP</a> > アンケート回答
    </div>
    <?= flash_message() ?>
    <h2>夏合宿出欠アンケート回答</h2>
    <form id="form" method="post" action="form.php" autocomplete="off">
      <div id="participation" class="form_content required">
        <p>出欠</p>
        <div class="radios">
<?php
foreach($participation as $key => $value){
?>
          <label><input type="radio" name="participation" value="<?= h($key) ?>"><span><?= h($value) ?></span></label>
<?php
}
?>
        </div>
      </div>
<?php
if($_SESSION['user']['grade'] != (MANAGER_GRADE + 2)){
?>
      <div id="private_car_flag" class="form_content">
        <p>自家車を出せますか?</p>
        <div class="radios">
          <label><input type="radio" name="private_car_flag" value="1"><span>はい</span></label>
          <label><input type="radio" name="private_car_flag" value="0"><span>いいえ</span></label>
        </div>
      </div>
      <div id="private_car" class="form_content">
        <p>何人乗りですか?</p>
        <input type="number" name="private_car">人乗り
      </div>
      <div id="car_rental" class="form_content">
        <p>レンタカーを出せますか?</p>
        <div class="radios">
          <label><input type="radio" name="car_rental" value="1"><span>はい</span></label>
          <label><input type="radio" name="car_rental" value="0"><span>いいえ</span></label>
        </div>
      </div>
<?php
}
?>
      <div id="racket" class="form_content">
        <p>テニスラケットを何本お持ちですか?</p>
        <input type="number" name="racket">本
      </div>
      <div id="ball" class="form_content">
        <p>テニスボールを何個お持ちですか?</p>
        <input type="number" name="ball">個
      </div>
      <div id="date" class="form_content">
        <p>参加可能な日程を教えてください</p>
        <div class="checkboxs">
<?php
foreach($dates as $date){
?>
          <label><input type="checkbox" name="date[]" value="<?= h($date) ?>"><span><?= h($date) ?>日</span></label>
<?php
}
?>
        </div>
      </div>
      <div id="note" class="form_content free">
        <p id="note_free">質問などあればこちらにお願いします。</p>
        <p id="note_absent">不参加の理由を簡単に教えてください。</p>
        <p id="note_undecided">未定の理由を簡単に教えてください。</p>
        <textarea name="note"></textarea>
      </div>
      <div class="form_content">
        <input type="submit" value="回答" class="submit_button">
      </div>
    </form>
  </div>
  <?= readJs("../../js/jquery-1.11.3.min.js") ?>
  <?= readJs("../js/jquery.validationEngine.js") ?>
  <?= readJs("../js/jquery.validationEngine-ja.js") ?>
  <?= readJs("../js/validation.js") ?>
  <?= readJs("js/form.js") ?>
</div>
</body>
</html>