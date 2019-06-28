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
  <title>企画出欠変更</title>
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
      <a href="../">TOP</a> > <a href="./">企画出欠TOP</a> > 企画出欠変更
    </div>
    <?= flash_message() ?>
    <h2>企画出欠変更</h2>
    <form id="form" method="post" action="edit.php" autocomplete="off">
      <fieldset>
        <legend>
          <?= h(date("n/j", strtotime($event['date']))) ?>(<?= h($weekjp[date("w", strtotime($event['date']))]) ?>)
<?php
if($event['duration'] > 1){
?>
          ~
          <?= h(date('n/j', strtotime("{$event['date']} +{$event['duration']} day -1 day"))) ?>(<?= h($weekjp[date("w", strtotime("{$event['date']} +{$event['duration']} day -1 day"))]) ?>)
<?php
}
?>
          <?= h($event['name']) ?>
        </legend>
        <input type="hidden" name="event_id" value="<?= $_GET['event_id'] ?>">
<?php
include (!isset($participation['id'])) ? 'inc/edit_content1.php' : 'inc/edit_content2.php';
?>
      </fieldset>
      <div class="form_content">
        <input type="submit" value="回答" class="submit_button">
      </div>
    </form>
  </div>
  <?= readJs("../../js/jquery-1.11.3.min.js") ?>
  <?= readJs("../js/jquery.validationEngine.js") ?>
  <?= readJs("../js/jquery.validationEngine-ja.js") ?>
  <?= readJs("../js/validation.js") ?>
  <?= readJs("../js/expression.js") ?>
</body>
</html>