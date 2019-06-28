<?php
require_once('../lib/library.php');
edit_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>夏合宿出欠変更</title>
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
      <a href="../">TOP</a> > <a href="./">夏合宿出欠アンケートTOP</a> > 出欠変更
    </div>
    <?= flash_message() ?>
    <h2>夏合宿出欠変更</h2>
    <form id="form" method="post" action="edit.php" autocomplete="off">
      <input type="hidden" name="id" value="<?= h($data['id']) ?>">
      <div id="participation" class="form_content required">
        <p>出欠</p>
        <div class="radios">
<?php
foreach($participation as $key => $value){
?>
          <label><input type="radio" name="participation" value="<?= h($key) ?>" <?= ($data['participation']==$key) ? 'checked' : '' ?>><span><?= h($value) ?></span></label>
<?php
}
?>
        </div>
      </div>
<?php
if($_SESSION['user']['grade'] != (MANAGER_GRADE + 2)){
?>
      <div id="private_car_flag" class="form_content <?= ($data['participation']==1) ? 'required' : '' ?>">
        <p>自家車を出せますか?</p>
        <div class="radios">
          <label><input type="radio" name="private_car_flag" value="1" <?= ($data['participation']==1 && $data['private_car']) ? 'checked' : '' ?>><span>はい</span></label>
          <label><input type="radio" name="private_car_flag" value="0" <?= ($data['participation']==1 && !$data['private_car']) ? 'checked' : '' ?>><span>いいえ</span></label>
        </div>
      </div>
      <div id="private_car" class="form_content <?= ($data['participation']==1 && $data['private_car']) ? 'required' : '' ?>">
        <p>何人乗りですか?</p>
        <input type="number" name="private_car" value="<?= $data['private_car'] ? h($data['private_car']) : '' ?>">人乗り
      </div>
      <div id="car_rental" class="form_content <?= ($data['participation']==1 && !$data['private_car']) ? 'required' : '' ?>">
        <p>レンタカーを出せますか?</p>
        <div class="radios">
          <label><input type="radio" name="car_rental" value="1" <?= ($data['participation']==1 && $data['car_rental']) ? 'checked' : '' ?>><span>はい</span></label>
          <label><input type="radio" name="car_rental" value="0" <?= ($data['participation']==1 && !$data['car_rental']) ? 'checked' : '' ?>><span>いいえ</span></label>
        </div>
      </div>
<?php
}
?>
      <div id="racket" class="form_content <?= ($data['participation']==1 && $data['racket']!=NULL) ? 'required' : '' ?>">
        <p>テニスラケットを何本お持ちですか?</p>
        <input type="number" name="racket" value="<?= ($data['racket']!=NULL) ? h($data['racket']) : '' ?>">本
      </div>
      <div id="ball" class="form_content <?= ($data['participation']==1 && $data['ball']!=NULL) ? 'required' : '' ?>">
        <p>テニスボールを何個お持ちですか?</p>
        <input type="number" name="ball" value="<?= ($data['ball']!=NULL) ? h($data['ball']) : '' ?>">個
      </div>
      <div id="date" class="form_content <?= ($data['participation']==2) ? 'required' : '' ?>">
        <p>参加可能な日程を教えてください</p>
        <div class="checkboxs">
<?php
foreach($dates as $date){
?>
          <label><input type="checkbox" name="date[]" value="<?= h($date) ?>" <?= (strpos($data['date'],(string)$date)!==false) ? 'checked' : '' ?>><span><?= h($date) ?>日</span></label>
<?php
}
?>
        </div>
      </div>
      <div id="note" class="form_content <?= h($note_cls) ?>">
        <p id="note_free">質問などあればこちらにお願いします。</p>
        <p id="note_absent">不参加の理由を簡単に教えてください。</p>
        <p id="note_undecided">未定の理由を簡単に教えてください。</p>
        <textarea name="note"><?= h($data['note']) ?></textarea>
      </div>
      <div class="form_content">
        <input type="submit" value="変更" class="submit_button">
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