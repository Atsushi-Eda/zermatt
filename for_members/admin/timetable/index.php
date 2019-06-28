<?php
require_once('../../lib/library.php');
index_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>時間割</title>
  <?= readCss("../../../css/reset.css") ?>
  <?= readCss("../../css/for_members.css") ?>
  <?= readCss("css/index.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../">TOP</a> > <a href="../">管理ページTOP</a> > 時間割
    </div>
    <?= flash_message() ?>
    <h2>時間割</h2>
    <div class="links">
      <a href="./">全て</a>
<?php
foreach($grades as $grade){
?>
      <a href="./?grade=<?= h($grade['grade']) ?>"><?= h(ordSuffix($grade['grade'])) ?></a>
<?php
}
?>
    </div>
    <p class="total">
      <?= isset($_GET['grade']) ? h(ordSuffix($_GET['grade'])) : '全て' ?>
      回答:<?= h($total) ?>人
    </p>
    <table>
      <tr>
<?php
foreach($weekjp as $key => $day){
  if($key == 0) $day = "";
?>
        <th><?= h($day) ?></th>
<?php
}
?>
      </tr>
<?php
for($time=1; $time<=6; $time++){
?>
      <tr>
        <td><?= h($time) ?></td>
<?php
  for($day=1; $day<=6; $day++){
?>
        <td>
          <!--<?= h(round($timetables[(($day-1)*6+$time)]['cnt'] / $total * 100)) ?>%<br>-->
          <?= h($timetables[(($day-1)*6+$time)]['cnt']) ?>人
        </td>
<?php
  }
?>
      </tr>
<?php
}
?>
    </table>
  </div>
</div>
</body>
</html>