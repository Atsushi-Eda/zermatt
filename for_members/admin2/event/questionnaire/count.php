<?php
require_once('../../../lib/library.php');
count_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>企画参加者数</title>
  <?= readCss("../../../../css/reset.css") ?>
  <?= readCss("../../../css/for_members.css") ?>
  <?= readCss("../../../css/form.css") ?>
  <?= readCss("css/count.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../../">TOP</a> > <a href="../../">2年用管理ページTOP</a> > <a href="../">企画管理</a> > <a href="./">アンケート結果</a> > 参加者数
    </div>
    <?= flash_message() ?>
    <h2>企画参加者数</h2>
    <div id="table_wrap">
      <table>
        <thead>
          <tr>
            <th rowspan="2">企画名</th>
<?php
foreach($grades as $grade){
?>
            <th colspan="3"><?= $grade=="%" ? "全" : h(ordSuffix($grade)) ?></th>
<?php
}
?>
          </tr>
          <tr>
<?php
for($i=0; $i<count($grades); $i++){
?>
            <th>全</th>
            <th class="male">男</th>
            <th class="female">女</th>
<?php
}
?>
          </tr>
        </thead>
        <tbody>
<?php
foreach($events as $event){
?>
          <tr>
            <td><?= h($event['short_name']) ?>(<?= h($answers[$event['id']]['cnt']) ?>)</td>
<?php
  foreach($grades as $grade){
    foreach($genders as $gender){
?>
            <td class="<?= h($gender) ?>"><?= h($participations[$event['id']][$grade][$gender]['cnt']) ?></td>
<?php
    }
  }
?>
          </tr>
<?php
  if($event['after']){
?>
          <tr>
            <td><?= h($event['short_name']) ?>アフター(<?= h($answers[$event['id']]['cnt']) ?>)</td>
<?php
    foreach($grades as $grade){
      foreach($genders as $gender){
?>
            <td class="<?= h($gender) ?>"><?= h($afters[$event['id']][$grade][$gender]['cnt']) ?></td>
<?php
      }
    }
?>
          </tr>
<?php
  }
?>
<?php
}
?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>