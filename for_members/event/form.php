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
  <title><?= h($assembly) ?>月総会告知企画出欠アンケート</title>
  <?= readCss("../../css/reset.css") ?>
  <?= readCss("../css/validationEngine.jquery.css") ?>
  <?= readCss("../css/for_members.css") ?>
  <?= readCss("../css/form.css") ?>
  <?= readCss("../css/required_cnt.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../">TOP</a> > <a href="./">企画出欠TOP</a> > <?= h($assembly) ?>月総会告知企画出欠アンケート
    </div>
    <?= flash_message() ?>
    <h2><?= h($assembly) ?>月総会告知企画出欠アンケート</h2>
    <form id="form" method="post" action="form.php" autocomplete="off">
<?php
foreach($events as $event){
?>
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
        <div class="form_content required validation_trigger">
          <p>出欠</p>
          <div class="radios expression">
            <label><input type="radio" name="<?= h($event['id']) ?>[participation]" value="1"><span>参加</span></label>
            <label><input type="radio" name="<?= h($event['id']) ?>[participation]" value="0"><span>不参加</span></label>
          </div>
        </div>
<?php
  if($event['after']){
?>
        <div class="form_content validation_change">
          <p>アフター出欠</p>
          <div class="radios expression">
            <label><input type="radio" name="<?= h($event['id']) ?>[after]" value="1"><span>参加</span></label>
            <label><input type="radio" name="<?= h($event['id']) ?>[after]" value="0"><span>不参加</span></label>
          </div>
        </div>
<?php
  }
  if($event['meeting_place']!==""){
?>
        <div class="form_content validation_change">
          <p>集合場所</p>
          <div class="radios">
<?php
    foreach(explode(',',$event['meeting_place']) as $meeting_place){
?>
            <label><input type="radio" name="<?= h($event['id']) ?>[meeting_place]" value="<?= h($meeting_place) ?>"><span><?= h($meeting_place) ?></span></label>
<?php
    }
?>
          </div>
        </div>
<?php
  }
?>
        <div class="form_content">
          <p><?= $event['other_question']!=="" ? h($event['other_question']) : '備考' ?></p>
          <textarea name="<?= h($event['id']) ?>[note]"></textarea>
        </div>
      </fieldset>
<?php
}
?>
      <div class="form_content">
        <input type="submit" value="回答" class="submit_button">
      </div>
    </form>
    <div id="required_cnt_wrap">
      <p>[必須]</p>
      <p><span id="required_cnt2"></span>/<span id="required_cnt1"></span></p>
    </div>
  </div>
  <?= readJs("../../js/jquery-1.11.3.min.js") ?>
  <?= readJs("../js/jquery.validationEngine.js") ?>
  <?= readJs("../js/jquery.validationEngine-ja.js") ?>
  <?= readJs("../js/validation.js") ?>
  <?= readJs("../js/expression.js") ?>
  <?= readJs("../js/required_cnt.js") ?>
</div>
</body>
</html>