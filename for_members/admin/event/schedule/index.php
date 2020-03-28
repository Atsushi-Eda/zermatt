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
  <title>企画スケジュール管理</title>
  <?= readCss("../../../../css/reset.css") ?>
  <?= readCss("../../../css/for_members.css") ?>
  <?= readCss("../../../../css/form.css") ?>
  <?= readCss("../../css/admin_table.css") ?>
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
      <a href="../../../">TOP</a> > <a href="../../">管理ページTOP</a> > <a href="../">企画管理</a> > 企画スケジュール管理
    </div>
    <?= flash_message() ?>
    <h2>企画スケジュール管理</h2>
    <p><a href="edit.php">+新規企画作成</a></p>
    <div class="form_content">
      <input type="text" id="event_name" placeholder="検索">
    </div>
    <div id="table_wrap">
      <table style="min-width: 2000px;">
        <thead>
          <tr>
            <th class="action">操作</th>
            <th class="id">ID</th>
            <th>名前</th>
            <th>短縮名</th>
            <th>日付</th>
            <th>期間</th>
            <th>告知総会</th>
            <th>2年企画</th>
            <th>出欠</th>
            <th>アフター出欠</th>
            <th>集合場所</th>
            <th>質問</th>
            <th>表示</th>
            <th>紹介文</th>
            <th>ビデオ</th>
          </tr>
        </thead>
        <tbody>
<?php
foreach($events as $event){
?>
          <tr class="event" data-name="<?= h($event['name']) ?>">
            <td><a href="edit.php?id=<?= h($event['id']) ?>">編集</a> <a href="javascript:void(0);" onclick="delete_confirm(<?= h($event['id']) ?>);">削除</a></td>
            <td><?= h($event['id']) ?></td>
            <td><?= h($event['name']) ?></td>
            <td><?= h($event['short_name']) ?></td>
            <td><?= h($event['date']) ?></td>
            <td><?= h($event['duration']) ?></td>
            <td><?= h($event['assembly']) ?></td>
            <td><?= h($event['sophomore']) ?></td>
            <td><?= h($event['questionnaire']) ?></td>
            <td><?= h($event['after']) ?></td>
            <td><?= h($event['meeting_place']) ?></td>
            <td><?= h($event['other_question']) ?></td>
            <td><?= h($event['view']) ?></td>
            <td><?= h($event['intro']) ?></td>
            <td><?= h($event['video']) ?></td>
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
  $("#event_name").keyup(function(){
    var keyword = r2h($(this).val());
    $.each($(".event"), function(i, val){
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
