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
  <title>新歓予約変更</title>
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
      <a href="../">TOP</a> > <a href="./">新歓予約TOP</a> > 新歓予約変更
    </div>
    <?= flash_message() ?>
    <h2>新歓予約変更</h2>
    <form id="form" method="post" action="edit.php" autocomplete="off">
      <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
      <div class="form_content">
        <p>日時会場</p>
        <input type="text" value="<?= h(date('n月j日', strtotime($schedule['date']))) ?>[<?= h($schedule['AMPM']) ?>] <?= h($schedule['place']) ?>" readonly>
      </div>
      <div class="form_content required">
        <p>名前</p>
        <input type="text" name="name" value="<?= $guest['name'] ?>">
      </div>
      <div class="form_content">
        <p>性別</p>
        <div class="radios">
          <label><input type="radio" disabled <?= $guest['gender']=='male' ? 'checked' : '' ?>><span>男性</span></label>
          <label><input type="radio" disabled <?= $guest['gender']=='female' ? 'checked' : '' ?>><span>女性</span></label>
        </div>
      </div>
      <div class="form_content required">
        <p>学校</p>
        <div class="radios">
          <label><input type="radio" name="school" value="理系" <?= $guest['school']=='理系' ? 'checked' : '' ?>><span>理系</span></label>
          <label><input type="radio" name="school" value="文系" <?= $guest['school']=='文系' ? 'checked' : '' ?>><span>文系</span></label>
          <label><input type="radio" name="school" value="学女" <?= $guest['school']=='学女' ? 'checked' : '' ?>><span>学女</span></label>
          <label><input type="radio" name="school" value="本女" <?= $guest['school']=='本女' ? 'checked' : '' ?>><span>本女</span></label>
          <label><input type="radio" name="school" value="その他" <?= $guest['school']=='その他' ? 'checked' : '' ?>><span>その他</span></label>
        </div>
      </div>
      <div class="form_content required">
        <p>集合場所</p>
        <div class="radios">
<?php
foreach(array_merge(explode(',',$schedule['meeting_place']),array('その他')) as $meeting_place){
?>
          <label><input type="radio" name="meeting_place" value="<?= h($meeting_place) ?>" <?= $meeting_place==$guest['meeting_place'] ? 'checked' : '' ?>><span><?= h($meeting_place) ?></span></label>
<?php
}
?>
        </div>
      </div>
      <div class="form_content">
        <p>メモ</p>
        <textarea name="note"><?= $guest['note'] ?></textarea>
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
</div>
</body>
</html>