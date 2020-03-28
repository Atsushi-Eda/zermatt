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
  <title>メインビジュアル管理</title>
  <?= readCss("../../../../css/reset.css") ?>
  <?= readCss("../../../css/for_members.css") ?>
  <?= readCss("../../../../css/form.css") ?>
  <?= readCss("../../css/admin_table.css") ?>
  <?= readJs("../../../../js/jquery-1.11.3.min.js") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../../">TOP</a> > <a href="../../">管理ページTOP</a> > <a href="../">トップページ管理</a> > メインビジュアル管理
    </div>
    <?= flash_message() ?>
    <h2>メインビジュアル管理</h2>
    <p><a href="edit.php">+新規画像追加</a></p>
    <div id="table_wrap">
      <table style="min-width: 500px;">
        <thead>
          <tr>
            <th class="action">操作</th>
            <th class="id">ID</th>
            <th>表示</th>
            <th>画像</th>
          </tr>
        </thead>
        <tbody>
<?php
foreach($mainvisuals as $mainvisual){
?>
          <tr class="mainvisual" data-name="<?= h($mainvisual['name']) ?>">
            <td><a href="edit.php?id=<?= h($mainvisual['id']) ?>">編集</a> <a href="javascript:void(0);" onclick="delete_confirm(<?= h($mainvisual['id']) ?>);">削除</a></td>
            <td><?= h($mainvisual['id']) ?></td>
            <td><?= h($mainvisual['view'] ? '表示' : '非表示') ?></td>
            <td><?= readImg("../../../../img/mv/" . $mainvisual['id'] . "." . $mainvisual['extension']) ?></td>
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
  if(window.confirm("削除すると元に戻せません。\n本当に削除しますか?")){
    location.href = "delete.php?id=" + id;
  }
}
</script>
</body>
</html>
