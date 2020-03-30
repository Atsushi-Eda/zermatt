<?php
require_once('../../lib/library.php');
view_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>トレ出欠確認</title>
  <?= readCss("../../../css/reset.css") ?>
  <?= readCss("../../css/for_members.css") ?>
  <?= readCss("../../css/form.css") ?>
  <?= readJs("css/view.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../">TOP</a> > <a href="../">管理ページTOP</a> > <a href="./">トレ管理</a> > トレ出欠確認
    </div>
    <?= flash_message() ?>
    <h2>トレ出欠確認</h2>
    <div class=form_content>
      <input type="date" name="filter_date" class="filter_date" value="<?= $filter_date ?>">以降のみ表示
    </div>
    <p class="output_excel"><a href="excel.php<?= isset($_GET['filter_date']) ? '?filter_date='.h($_GET['filter_date']) : '' ?>">&gt;&gt;エクセル出力</a></p>
    <div id="table_wrap">
      <table>
        <thead>
          <tr>
            <th>名前</th>
            <th>計</th>
<?php
foreach($dates as $date){
?>
            <th><?= h(date("n/j", strtotime($date))) ?><br>(<?= h($weekjp[date('w', strtotime($date))]) ?>)</th>
<?php
}
?>
          </tr>
        </thead>
        <tbody>
<?php
foreach($members as $member){
?>
          <tr>
            <td><?= h($member['name']) ?></td>
            <td><?= h(isset($participations[$member['id']]) ? count($participations[$member['id']]) : 0) ?></td>
<?php
  foreach($dates as $date){
?>
            <td><?= h(isset($participations[$member['id']][$date]) ? 1 : 0) ?></td>
<?php
  }
?>
          </tr>
<?php
}
?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?= readJs("../../../js/jquery-1.11.3.min.js") ?>
<?= readJs("../../js/filter_date.js") ?>
</body>
</html>
