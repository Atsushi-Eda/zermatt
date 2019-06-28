<?php
require_once('../../lib/library.php');
edit_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>カレンダー日程変更</title>
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
      <a href="../../">TOP</a> > <a href="../">管理ページTOP</a> > <a href="./">カレンダー</a> > 変更
    </div>
    <?= flash_message() ?>
    <h2>カレンダー日程変更</h2>
    <form id="form" method="POST" action="edit.php" autocomplete="off">
      <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
      <div class="form_content required">
        <p>タイトル</p>
        <input type="text" name="name" value="<?= $other_event['name'] ?>">
      </div>
      <div class="form_content required">
        <p>日付</p>
        <input type="date" name="date" value="<?= $other_event['date'] ?>">
      </div>
      <div class="form_content">
        <p>時間</p>
        <input type="time" name="start_time" value="<?= $other_event['start_time'] ?>">~<input type="time" name="end_time" value="<?= $other_event['end_time'] ?>">
      </div>
      <div class="form_content required">
        <p>公開範囲</p>
        <div class="radios">
          <label><input type="radio" name="view" value="1" <?= $other_event['view']==1 ? 'checked' : '' ?>><span>自分のみ</span></label>
          <label><input type="radio" name="view" value="2" <?= $other_event['view']==2 ? 'checked' : '' ?>><span>幹部のみ</span></label>
          <label><input type="radio" name="view" value="3" <?= $other_event['view']==3 ? 'checked' : '' ?>><span>全体</span></label>
        </div>
      </div>
      <div class="form_content">
        <input type="submit" value="登録" class="submit_button">
      </div>
    </form>
    <div class="form_content" style="text-align:center;">
      <a href="javascript:void(0);" onclick="delete_confirm(<?= h($_GET['id']) ?>);" id="delete" class="button">削除</a>
    </div>
  </div>
</div>
<?= readJs("../../../js/jquery-1.11.3.min.js") ?>
<?= readJs("../../js/jquery.validationEngine.js") ?>
<?= readJs("../../js/jquery.validationEngine-ja.js") ?>
<?= readJs("../../js/validation.js") ?>
<?= readJs("js/edit.js") ?>
</body>
</html>