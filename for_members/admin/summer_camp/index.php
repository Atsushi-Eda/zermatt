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
  <title>夏合宿参加者管理</title>
  <?= readCss("../../../css/reset.css") ?>
  <?= readCss("../../css/for_members.css") ?>
  <?= readCss("css/index.css") ?>
  <?= readJs("../../../js/jquery-1.11.3.min.js") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../">TOP</a> > <a href="../">管理ページTOP</a> > 夏合宿参加者管理
    </div>
    <?= flash_message() ?>
    <h2>夏合宿参加者管理</h2>
    <div id="result">
      <!-- <p style="padding-bottom:10px;"><a href="excel.php">>>エクセル出力</a></p> -->
      <div id="table_wrap">
        <table>
          <thead>
            <tr>
              <th width="15%">名前</th>
              <th width="10%">出欠</th>
              <th width="10%">自家車</th>
              <th width="10%">レンタ</th>
              <th width="10%">ラケット</th>
              <th width="10%">ボール</th>
              <th width="35%">備考</th>
            </tr>
          </thead>
          <tbody>
<?php
foreach($members as $member){
?>
            <tr>
              <td><a href="edit.php?member_id=<?= h($member['id']) ?>"><?= h($member['name']) ?></a></td>
<?php
  if($participations[$member['id']]['participation'] !== NULL){
    if($participations[$member['id']]['participation'] != 2){
?>
              <td><?= h($participation_array[$participations[$member['id']]['participation']]) ?></td>
<?php
    }else{
?>
              <td><?= h($participations[$member['id']]['date']) ?></td>
<?php
    }
  }else{
?>
              <td style="color:red;">未回答</td>
<?php
  }
  if($participations[$member['id']]['participation']==1 && $member['grade']!=(MANAGER_GRADE+2)){
?>
              <td><?= ($participations[$member['id']]['private_car']) ? $participations[$member['id']]['private_car'] : '×' ?></td>
              <td><?= ($participations[$member['id']]['car_rental']) ? '○' : '×' ?></td>
<?php
  }else{
?>
              <td>-</td>
              <td>-</td>
<?php
  }
  if($participations[$member['id']]['participation']==1){
?>
              <td><?= h($participations[$member['id']]['racket']) ?></td>
              <td><?= h($participations[$member['id']]['ball']) ?></td>
<?php
  }else{
?>
              <td>-</td>
              <td>-</td>
<?php
  }
?>
              <td><?= h($participations[$member['id']]['note']) ?></td>
            </tr>
<?php
}
?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</body>
</html>