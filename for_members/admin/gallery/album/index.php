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
  <title>アルバム管理</title>
  <?= readCss("../../../../css/reset.css") ?>
  <?= readCss("../../../css/for_members.css") ?>
  <?= readCss("../../../../css/form.css") ?>
  <?= readCss("../../css/admin_table.css") ?>
  <?= readCss("css/index.css") ?>
  <?= readJs("../../../../js/jquery-1.11.3.min.js") ?>
  <?= readJs("../../../js/rome.js") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../../">TOP</a> > <a href="../../">管理ページTOP</a> > <a href="../">ギャラリー管理</a> > アルバム管理
    </div>
    <?= flash_message() ?>
    <h2>アルバム管理</h2>
    <p><a href="edit.php">+新規アルバム作成</a></p>
    <div class="form_content">
      <input type="text" id="album_name" placeholder="検索">
    </div>
    <div id="table_wrap">
      <table style="min-width: 800px;">
        <thead>
          <tr>
            <th class="action">操作</th>
            <th class="id">ID</th>
            <th>名前</th>
            <th>URL</th>
            <th>画像</th>
          </tr>
        </thead>
        <tbody>
<?php
foreach($albums as $album){
?>
          <tr class="album" data-name="<?= h($album['name']) ?>">
            <td><a href="edit.php?id=<?= h($album['id']) ?>">編集</a> <a href="javascript:void(0);" onclick="delete_confirm(<?= h($album['id']) ?>);">削除</a></td>
            <td><?= h($album['id']) ?></td>
            <td><?= h($album['name']) ?></td>
            <td><?= h($album['url']) ?></td>
            <td>
              <div class="album_imgs">
<?php
  foreach(scandir("../../../../img/gallery/" . $album['id'] . "/") as $file){
    if($file=="." || $file==".."){
      continue;
    }
?>
                <div class="album_img"><?= readImg("../../../../img/gallery/" . $album['id'] . "/" . $file) ?></div>
<?php
  }
?>
              </div>
            </td>
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
$(function(){
  $("#album_name").keyup(function(){
    var keyword = r2h($(this).val());
    $.each($(".album"), function(i, val){
      if($(val).data("name").indexOf(keyword)!=-1){
        $(val).show();
      }else{
        $(val).hide();
      }
    });
  });
});
function delete_confirm(id){
  if(window.confirm("削除すると管理ページから元に戻せません。\n本当に削除しますか?")){
    location.href = "delete.php?id=" + id;
  }
}
</script>
</body>
</html>
