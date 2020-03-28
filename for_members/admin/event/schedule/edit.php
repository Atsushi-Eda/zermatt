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
  <title>企画登録</title>
  <?= readCss("../../../../css/reset.css") ?>
  <?= readCss("../../../css/validationEngine.jquery.css") ?>
  <?= readCss("../../../css/for_members.css") ?>
  <?= readCss("../../../css/form.css") ?>
  <?= readCss("../../../css/upload_image.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../../">TOP</a> > <a href="../../">管理ページTOP</a> > <a href="../">企画管理</a> > <a href="./">企画スケジュール管理</a> > 企画登録
    </div>
    <?= flash_message() ?>
    <h2>企画登録</h2>
    <form id="form" method="POST" action="edit.php" autocomplete="off" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= h($event['id']) ?>">
      <div class="form_content required">
        <p>名前</p>
        <input type="text" name="name" value="<?= h($event['name']) ?>">
      </div>
      <div class="form_content required">
        <p>短縮名</p>
        <input type="text" name="short_name" value="<?= h($event['short_name']) ?>">
      </div>
      <div class="form_content required">
        <p>日付</p>
        <input type="date" name="date" value="<?= h($event['date']) ?>">
      </div>
      <div class="form_content required">
        <p>期間</p>
        <input type="number" name="duration" value="<?= $event['duration'] ? h($event['duration']) : 1 ?>">日
      </div>
      <div class="form_content required">
        <p>告知総会</p>
        <input type="number" name="assembly" value="<?= h($event['assembly']) ?>">月
      </div>
      <div class="form_content required">
        <p>2年企画か否か</p>
        <div class="radios">
          <label><input type="radio" name="sophomore" value="1" <?= $event['sophomore'] ? 'checked' : '' ?>><span>はい</span></label>
          <label><input type="radio" name="sophomore" value="0" <?= !$event['sophomore'] ? 'checked' : '' ?>><span>いいえ</span></label>
        </div>
      </div>
      <div class="form_content required">
        <p>出欠確認</p>
        <div class="radios">
          <label><input type="radio" name="questionnaire" value="1" <?= $event['questionnaire'] ? 'checked' : '' ?>><span>あり</span></label>
          <label><input type="radio" name="questionnaire" value="0" <?= !$event['questionnaire'] ? 'checked' : '' ?>><span>なし</span></label>
        </div>
      </div>
      <div class="form_content required">
        <p>アフター出欠確認</p>
        <div class="radios">
          <label><input type="radio" name="after" value="1" <?= $event['after'] ? 'checked' : '' ?>><span>あり</span></label>
          <label><input type="radio" name="after" value="0" <?= !$event['after'] ? 'checked' : '' ?>><span>なし</span></label>
        </div>
      </div>
      <div class="form_content">
        <p>集合場所選択肢(半角カンマ「,」区切り)</p>
        <input type="text" name="meeting_place" value="<?= h($event['meeting_place']) ?>">
      </div>
      <div class="form_content">
        <p>その他の質問</p>
        <textarea name="other_question"><?= h($event['other_question']) ?></textarea>
      </div>
      <div class="form_content required">
        <p>紹介ページに表示</p>
        <div class="radios">
          <label><input type="radio" name="view" value="1" <?= $event['view'] ? 'checked' : '' ?>><span>表示</span></label>
          <label><input type="radio" name="view" value="0" <?= !$event['view'] ? 'checked' : '' ?>><span>非表示</span></label>
        </div>
      </div>
      <div class="form_content">
        <p>紹介文</p>
        <textarea name="intro"><?= h($event['intro']) ?></textarea>
      </div>
      <div class="form_content">
        <p>紹介ビデオ</p>
        <input type="text" name="video" value="<?= h($event['video']) ?>">
      </div>
      <div class="form_content">
        <p>画像</p>
        <div id="upload_image_wrapper">
<?php
$dir = "../../../../img/event/" . $event['id'] . "/";
if($event['id'] && file_exists($dir)){
  foreach(scandir($dir) as $file){
    if($file=="." || $file==".."){
      continue;
    }
?>
            <?= readImg($dir.$file, 'upload_image') ?>
<?php
  }
}
?>
        </div>
        <label class="button"><input type="file" name="imgs[]" id="upload_image_button" accept="image/*" multiple>ファイルを選択</label>
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
  <?= readJs("../../../js/upload_image.js") ?>
</body>
</html>
