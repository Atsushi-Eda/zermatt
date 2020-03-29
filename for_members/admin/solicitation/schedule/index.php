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
  <title>新勧コンパスケジュール管理</title>
  <?= readCss("../../../../css/reset.css") ?>
  <?= readCss("../../../css/for_members.css") ?>
  <?= readCss("../../../../css/form.css") ?>
  <?= readCss("../../css/admin_table.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../../">TOP</a> > <a href="../../">管理ページTOP</a> > <a href="../">新勧コンパ管理</a> > 新勧コンパスケジュール管理
    </div>
    <?= flash_message() ?>
    <h2>新勧コンパスケジュール管理</h2>
    <p><a href="edit.php">+新規新勧コンパ作成</a></p>
    <div id="table_wrap">
      <table style="min-width: 2000px;">
        <thead>
          <tr>
            <th class="action">操作</th>
            <th class="id">ID</th>
            <th>日付</th>
            <th>時間</th>
            <th>AMPM</th>
            <th>場所</th>
            <th>食べ物</th>
            <th>値段</th>
            <th>集合場所</th>
            <th>集合時間</th>
            <th>男</th>
            <th>女</th>
          </tr>
        </thead>
        <tbody>
<?php
foreach($schedules as $schedule){
?>
          <tr class="schedule" data-name="<?= h($schedule['name']) ?>">
            <td><a href="edit.php?id=<?= h($schedule['id']) ?>">編集</a> <a href="javascript:void(0);" onclick="delete_confirm(<?= h($schedule['id']) ?>);">削除</a></td>
            <td><?= h($schedule['id']) ?></td>
            <td><?= h($schedule['date']) ?></td>
            <td><?= h($schedule['time']) ?></td>
            <td><?= h($schedule['AMPM']) ?></td>
            <td><?= h($schedule['place']) ?></td>
            <td><?= h($schedule['place_category']) ?></td>
            <td><?= h($schedule['price']) ?></td>
            <td><?= h($schedule['meeting_place']) ?></td>
            <td><?= h($schedule['meeting_time']) ?></td>
            <td><?= h($schedule['male']) ?></td>
            <td><?= h($schedule['female']) ?></td>
          </tr>
<?php
}
?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script>
function delete_confirm(id){
  if(window.confirm("削除すると管理ページから元に戻せません。\n本当に削除しますか?")){
    location.href = "delete.php?id=" + id;
  }
}
</script>
</body>
</html>
