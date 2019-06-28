<?php
require_once('../lib/library.php');
index_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>企画出欠TOP</title>
  <?= readCss("../../css/reset.css") ?>
  <?= readCss("../css/for_members.css") ?>
  <?= readCss("css/index.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../">TOP</a> > 企画出欠TOP
    </div>
    <?= flash_message() ?>
    <h2>企画出欠TOP</h2>
<?php
if(time()>strtotime($event_form_opening_period['from']) && time()<strtotime($event_form_opening_period['to'])){
?>
    <p class="to_form"><a href="form.php">>><?= h($assembly) ?>月総会告知企画出欠アンケート</a></p>
<?php
}
foreach($events as $event){
?>
      <div class="event">
        <p class="event_name">
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
        </p>
<?php
if(!isset($participations[$event['id']]['participation'])){
?>
        <p>未回答です</p>
      </div>
<?php
  continue;
}
?>
        <ul class="lists">
          <li>
            <span>出欠:</span>
            <span><?= ($participations[$event['id']]['participation']) ? '参加' : '不参加' ?></span>
          </li>
<?php
  if($event['after']){
?>
          <li>
            <span>アフター出欠:</span>
            <span><?= ($participations[$event['id']]['after']) ? '参加' : '不参加' ?></span>
          </li>
<?php
  }
  if($event['meeting_place']!==""){
?>
          <li>
            <span>集合場所:</span>
            <span><?= h($participations[$event['id']]['meeting_place']) ?></span>
          </li>
<?php
  }
  if(!empty($participations[$event['id']]['note'])){
?>
          <li>
            <span><?= $event['other_question']!=="" ? h($event['other_question']) : '備考' ?></span>
            <p><?= h($participations[$event['id']]['note']) ?></p>
          </li>
<?php
  }
?>
        </ul>
<?php
  if((time()>strtotime($event_form_opening_period['from']) && time()<strtotime($event_form_opening_period['to'])) && $event['assembly'] == $assembly){
?>
        <div class="edit_button">
          <a href="edit.php?event_id=<?= h($event['id']) ?>">変更</a>
        </div>
<?php
  }else if(date("Ymd") < date("Ymd", strtotime($event['date']))){
?>
        <p>出欠を変更する場合は、お近くの3年生までご連絡お願いします。</p>
<?php
  }
?>
      </div>
<?php
}
?>
  </div>
</div>
</body>
</html>