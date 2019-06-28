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
  <title>AWTシャツ</title>
  <?= readCss("../../../css/reset.css") ?>
  <?= readCss("../../css/for_members.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../">TOP</a> > <a href="../">管理ページTOP</a> > AWTシャツ
    </div>
    <?= flash_message() ?>
    <h2>AWTシャツ</h2>
    <p style="text-align:right">回答<?= h($count["answer"]["cnt"]) ?>/<?= h($count["all"]["cnt"]) ?></p>
    <table style="margin-bottom:20px">
      <tr>
        <th>サイズ</th>
        <th>人</th>
      </tr>
<?php
foreach($count["buy"] as $index => $value){
?>
      <tr>
        <td><?= h($index) ?></td>
        <td><?= h($value["cnt"]) ?></td>
      </tr>
<?php
}
?>
    </table>
    <table>
      <tr>
        <th>名前</th>
        <th>購入</th>
        <th>サイズ</th>
      </tr>
<?php
foreach($members as $member){
?>
      <tr>
        <td><?= h($member["name"]) ?></td>
        <td><?= h($buy[$member["buy"]]) ?></td>
        <td><?= h($sizes[$member["size"]]) ?></td>
      </tr>
<?php
}
?>
    </table>
  </div>
</div>
</body>
</html>