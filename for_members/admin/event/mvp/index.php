<?php
require_once('../../../lib/library.php');
index_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>企画MVP</title>
  <?= readCss("../../../../css/reset.css") ?>
  <?= readCss("../../../css/for_members.css") ?>
</head>
<body>
<?php
include('../../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../../index.php">TOP</a> > <a href="../../index.php">管理ページTOP</a> > <a href="../">企画管理</a> > MVP
    </div>
    <?= flash_message() ?>
    <h2>企画MVP</h2>
    <p style="text-align:right;">MAX:<?= ($max['cnt']) ?></p>
    <table>
      <tr>
        <th style="width: 25%;">順位</th>
        <th style="width: 50%;">名前</th>
        <th style="width: 25%;">回数</th>
      </tr>
<?php
foreach($counts as $key => $count){
  if($key==0){
    $rank = 1;
  }else{
    $rank = ($counts[$key-1]['cnt'] == $counts[$key]['cnt']) ? $rank : ($key+1);
  }
?>
      <tr>
        <td><?= ($rank) ?></td>
        <td><?= ($count['name']) ?></td>
        <td><?= ($count['cnt']) ?></td>
      </tr>
<?php
}
?>
    </table>
  </div>
</body>
</html>