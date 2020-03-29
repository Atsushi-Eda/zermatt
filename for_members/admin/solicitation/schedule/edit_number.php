<?php
require_once('../../../lib/library.php');
edit_number_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>人数調整</title>
  <?= readCss("../../../../css/reset.css") ?>
  <?= readCss("../../../css/for_members.css") ?>
  <?= readCss("../../../css/form.css") ?>
  <?= readCss("css/edit_number.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../../">TOP</a> > <a href="../../">管理ページTOP</a> > <a href="../">新歓管理</a> > 人数調整
    </div>
    <?= flash_message() ?>
    <h2>人数調整</h2>
    <div id="schedules">
<?php
foreach($schedules as $schedule_id => $schedule){
?>
        <div class="schedule">
          <form action="edit_number.php" method="POST">
            <p class="schedule_title"><?= h(date('n月j日', strtotime($schedule['date']))) ?>[<?= h($schedule['AMPM']) ?>] <?= h($schedule['place']) ?></p>
            <input type="hidden" name="id" value="<?= $schedule_id ?>">
            <div class="form_content">
              <div>全体: <?= h($cnt[$schedule_id]) ?>/<span><?= h($schedule['capacity']) ?></span></div>
              <div>男性: <?= h($cnt_male[$schedule_id]) ?>/<input type="number" name="male" value="<?= h($schedule['male']) ?>"></div>
              <div>女性: <?= h($cnt_female[$schedule_id]) ?>/<input type="number" name="female" value="<?= h($schedule['female']) ?>"></div>
            </div>
            <div class="form_content">
              <input type="submit" class="submit_button" value="変更">
            </div>
          </form>
        </div>
<?php
}
?>
    </div>
  </div>
</div>
</body>
</html>
