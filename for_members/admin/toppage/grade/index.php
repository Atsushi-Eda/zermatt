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
  <title>代管理</title>
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
      <a href="../../../">TOP</a> > <a href="../../">管理ページTOP</a> > <a href="../">トップページ管理</a> > 代管理
    </div>
    <?= flash_message() ?>
    <h2>代管理</h2>
    <p><a href="edit.php">+代追加</a></p>
    <div id="table_wrap">
      <table style="min-width: 1000px;">
        <thead>
          <tr>
            <th class="action">操作</th>
            <th class="id">ID</th>
            <th>代</th>
            <th>色</th>
            <th>表示</th>
            <th>画像</th>
          </tr>
        </thead>
        <tbody>
<?php
foreach($grades as $grade){
?>
          <tr class="grade" data-name="<?= h($grade['name']) ?>">
            <td><a href="edit.php?id=<?= h($grade['id']) ?>">編集</a> <a href="javascript:void(0);" onclick="delete_confirm(<?= h($grade['id']) ?>);">削除</a></td>
            <td><?= h($grade['id']) ?></td>
            <td><?= h($grade['grade']) ?></td>
            <td style="color: <?= h($grade['color']) ?>;"><?= h($grade['color']) ?></td>
            <td><?= h($grade['view'] ? '表示' : '非表示') ?></td>
            <td><?= readImg("../../../../img/grade/" . $grade['grade'] . "." . $grade['image_extension']) ?></td>
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
