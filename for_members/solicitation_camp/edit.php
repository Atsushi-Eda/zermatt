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
  <title>新歓合宿出欠変更</title>
  <?= readCss("../../css/reset.css") ?>
  <?= readCss("../css/validationEngine.jquery.css") ?>
  <?= readCss("../css/for_members.css") ?>
  <?= readCss("../css/form.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../">TOP</a> > <a href="./">新歓合宿出欠アンケートTOP</a> > 出欠変更
    </div>
    <?= flash_message() ?>
    <h2>新歓合宿出欠変更</h2>
    <form id="form" method="post" action="edit.php" autocomplete="off">
      <input type="hidden" name="id" value="<?= h($data['id']) ?>">
      <div class="form_content type2 required">
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
if($_SESSION['user']['grade'] == (MANAGER_GRADE + 2)){
?>
      <div class="form_content type2 required">
        <p>スキーレベルについて</p>
        <div class="radios">
<?php
foreach($experience as $key => $value){
?>
          <label><input type="radio" name="experience" value="<?= h($key) ?>" <?= ($data['experience']==$key) ? 'checked' : '' ?>><span style="font-size:70%;"><?= h($value) ?></span></label><br>
<?php
}
?>
        </div>
      </div>
      <div class="form_content type2 required">
        <p>ウェアを持っていますか?</p>
        <div class="radios">
          <label><input type="radio" name="wear" value="1" <?= $data['wear'] ? 'checked' : '' ?>><span>はい</span></label>
          <label><input type="radio" name="wear" value="0" <?= !$data['wear'] ? 'checked' : '' ?>><span>いいえ</span></label>
        </div>
      </div>
      <div class="form_content type2 required">
        <p>ゴーグルを持っていますか?</p>
        <div class="radios">
          <label><input type="radio" name="goggles" value="1" <?= $data['goggles'] ? 'checked' : '' ?>><span>はい</span></label>
          <label><input type="radio" name="goggles" value="0" <?= !$data['goggles'] ? 'checked' : '' ?>><span>いいえ</span></label>
        </div>
      </div>
      <div class="form_content type2 required">
        <p>ニット帽を持っていますか?</p>
        <div class="radios">
          <label><input type="radio" name="knit" value="1" <?= $data['knit'] ? 'checked' : '' ?>><span>はい</span></label>
          <label><input type="radio" name="knit" value="0" <?= !$data['knit'] ? 'checked' : '' ?>><span>いいえ</span></label>
        </div>
      </div>
      <div class="form_content type2 required">
        <p>グローブを持っていますか?</p>
        <div class="radios">
          <label><input type="radio" name="gloves" value="1" <?= $data['gloves'] ? 'checked' : '' ?>><span>はい</span></label>
          <label><input type="radio" name="gloves" value="0" <?= !$data['gloves'] ? 'checked' : '' ?>><span>いいえ</span></label>
        </div>
      </div>
<?php
}
?>
      <div class="form_content type2">
        <p>質問などあればこちらにお願いします。</p>
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
  <?= readJs("../js/expression.js") ?>
</div>
</body>
</html>