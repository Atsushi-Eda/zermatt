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
  <title>新歓予約TOP</title>
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
      <a href="../">TOP</a> > 新歓予約TOP
    </div>
    <?= flash_message() ?>
    <h2>新歓予約TOP</h2>
    <div id="confirm_reservation">
      <h3>予約確認</h3>
      <div class="table_wrapper">
        <table>
          <tr>
            <th style="width:20%;">名前</th>
            <th style="width:10%;">性別</th>
            <th style="width:24%;">日時場所</th>
            <th style="width:12%;">学校</th>
            <th style="width:18%;">集合場所</th>
            <th style="width:16%;">操作</th>
          </tr>
<?php
foreach($guests as $guest){
?>
          <tr>
            <td><?= h($guest['name']) ?></td>
            <td><?= h($gender[$guest['gender']]) ?></td>
            <td><?= h(date('n/j', strtotime($schedules[$guest['schedule_id']]['date']))) ?>[<?= h($schedules[$guest['schedule_id']]['AMPM']) ?>] <?= h($schedules[$guest['schedule_id']]['place']) ?></td>
            <td><?= h($guest['school']) ?></td>
            <td><?= h($guest['meeting_place']) ?></td>
            <td>
              <a href="edit.php?id=<?= h($guest['id']) ?>">変更</a>
              <a href="javascript:void(0);" onclick="delete_confirm(<?= h($guest['id']) ?>);">取消</a>
            </td>
          </tr>
<?php
}
?>
        </table>
      </div>
    </div>
    <div id="make_reservation">
      <h3>新規予約</h3>
      <div id="schedules">
<?php
foreach($schedules as $schedule_id => $schedule){
  if(date('Y-m-d') > $schedule['date']) continue;
?>
        <div class="schedule">
          <p class="schedule_title"><?= h(date('n月j日', strtotime($schedule['date']))) ?>[<?= h($schedule['AMPM']) ?>] <?= h($schedule['place']) ?></p>
          <div class="cnt_all float_container">
            <p>
              全体:
              <?= h($cnt[$schedule_id]) ?>/<?= h($schedule['capacity']) ?>
            </p>
            <div class="bar_graph">
              <div class="occupied" style="width:<?= h($cnt[$schedule_id]/$schedule['capacity']*100) ?>%;"></div>
            </div>
          </div>
          <div class="cnt_male float_container">
            <p>
<?php
  if($cnt_male[$schedule_id] < $schedule['male']){
?>
              <a href="form.php?schedule=<?= h($schedule_id) ?>&gender=male">男性</a>:
<?php
  }else{
?>
              男性:
<?php
}
?>
              <?= h($cnt_male[$schedule_id]) ?>/<?= h($schedule['male']) ?>
            </p>
            <div class="bar_graph">
              <div class="occupied" style="width:<?= h($cnt_male[$schedule_id]/$schedule['male']*100) ?>%;"></div>
            </div>
          </div>
          <div class="cnt_female float_container">
            <p>
<?php
  if($cnt_female[$schedule_id] < $schedule['female']){
?>
              <a href="form.php?schedule=<?= h($schedule_id) ?>&gender=female">女性</a>:
<?php
  }else{
?>
              女性:
<?php
}
?>
              <?= h($cnt_female[$schedule_id]) ?>/<?= h($schedule['female']) ?>
            </p>
            <div class="bar_graph">
              <div class="occupied" style="width:<?= h($cnt_female[$schedule_id]/$schedule['female']*100) ?>%;"></div>
            </div>
          </div>
        </div>
<?php
}
?>
      </div>
    </div>
  </div>
  <?= readJs("js/index.js") ?>
</div>
</body>
</html>